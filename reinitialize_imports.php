<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * the reinitialize imports logic for Panopto
 *
 * @package block_panopto
 * @copyright  Panopto 2009 - 2016 /With contributions from Spenser Jones (sjones@ambrose.edu)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir . '/formslib.php');
require_once('lib/panopto_data.php');

class panopto_reinitialize_imports_form extends moodleform {

    /**
     * @var string $title
     */
    protected $title = '';

    /**
     * @var string $description
     */
    protected $description = '';

    /**
     * Defines a Panopto reinitialize import form
     */
    public function definition() {
        global $DB;

        $mform = & $this->_form;

        $this->add_action_buttons(true, get_string('begin_reinitializing_imports', 'block_panopto'));
    }

}

require_login();

function reinitialize_all_imports() {
    global $DB;

    // TODO: Check moodle standards on constanst strings.
    $NO_COURSE_EXISTS = "NO_COURSE_EXISTS";
    $INVALID_PANOPTO_DATA = "INVALID_PANOPTO_DATA";

    $courseimports = $DB->get_records(
        'block_panopto_importmap',
        null,
        null,
        'import_moodle_id,target_moodle_id'
    );

    $coursepanoptoarray = array();

    foreach ($courseimports as $courseimport) {

        if (!isset($coursepanoptoarray[$courseimport->target_moodle_id])) {
            $targetpanopto = new panopto_data($courseimport->target_moodle_id);

            $targetmoodlecourse = $DB->get_record('course', array('id' => $courseimport->target_moodle_id));

            $targetcourseexists = isset($targetmoodlecourse) && $targetmoodlecourse !== false;
            $hasvalidpanoptodata = isset($targetpanopto->servername) && !empty($targetpanopto->servername) &&
                                           isset($targetpanopto->applicationkey) && !empty($targetpanopto->applicationkey);

            if ($targetcourseexists && $hasvalidpanoptodata) {
                $coursepanoptoarray[$courseimport->target_moodle_id] = $targetpanopto;
            } else {
                $coursepanoptoarray[$courseimport->target_moodle_id] = !$targetcourseexists ? $NO_COURSE_EXISTS : $INVALID_PANOPTO_DATA;
                \panopto_data::delete_panopto_relation($courseimport->target_moodle_id, true);
            }
        }


        $targetpanopto = $coursepanoptoarray[$courseimport->target_moodle_id];
        $targetpanoptodata = null;
        $importresult = null;

        if ($targetpanopto !== $NO_COURSE_EXISTS &&
            $targetpanopto !== $INVALID_PANOPTO_DATA) {

            $targetpanoptodata = $targetpanopto->get_provisioning_info();

            $importresult = $targetpanopto->init_and_sync_import($courseimport->import_moodle_id);
        }

        include('views/imported_course.html.php');
        flush();
    }
}

$context = context_system::instance();

$PAGE->set_context($context);

$returnurl = optional_param('return_url', $CFG->wwwroot . '/admin/settings.php?section=blocksettingpanopto', PARAM_LOCALURL);

$urlparams['return_url'] = $returnurl;

$PAGE->set_url('/blocks/panopto/reinitialize_imports.php', $urlparams);
$PAGE->set_pagelayout('base');

$mform = new panopto_reinitialize_imports_form($PAGE->url);

if ($mform->is_cancelled()) {
    redirect(new moodle_url($returnurl));
} else if ($mform->get_data()) {
    $importitle = get_string('block_global_reinitialize_all_imports', 'block_panopto');
    $PAGE->set_pagelayout('base');
    $PAGE->set_title($importitle);
    $PAGE->set_heading($importitle);

    // System context.
    require_capability('block/panopto:provision_multiple', $context);

    $manageblocks = new moodle_url('/admin/blocks.php');
    $panoptosettings = new moodle_url('/admin/settings.php?section=blocksettingpanopto');
    $PAGE->navbar->add(get_string('blocks'), $manageblocks);
    $PAGE->navbar->add(get_string('pluginname', 'block_panopto'), $panoptosettings);

    $PAGE->navbar->add($importitle, new moodle_url($PAGE->url));

    echo $OUTPUT->header();

    reinitialize_all_imports();

    echo $OUTPUT->footer();
} else {
    $mform->display();
}

/* End of file reinitialize_imports.php */
