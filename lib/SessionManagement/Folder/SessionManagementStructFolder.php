<?php
/**
 * File for class SessionManagementStructFolder
 * @package SessionManagement
 * @subpackage Structs
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for SessionManagementStructFolder originally named Folder
 * Meta informations extracted from the WSDL
 * - from schema : {@link http://demo.hosted.panopto.com/Panopto/PublicAPI/4.6/SessionManagement.svc?xsd=xsd3}
 * @package SessionManagement
 * @subpackage Structs
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-01-19
 */
class SessionManagementStructFolder extends SessionManagementStructFolderBase
{
    /**
     * The ExternalId
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * - nillable : true
     * @var string
     */
    public $ExternalId;
    /**
     * Constructor method for Folder
     * @see parent::__construct()
     * @param string $_externalId
     * @return SessionManagementStructFolder
     */
    public function __construct($_externalId = NULL)
    {
        SessionManagementWsdlClass::__construct(array('ExternalId'=>$_externalId),false);
    }
    /**
     * Get ExternalId value
     * @return string|null
     */
    public function getExternalId()
    {
        return $this->ExternalId;
    }
    /**
     * Set ExternalId value
     * @param string $_externalId the ExternalId
     * @return string
     */
    public function setExternalId($_externalId)
    {
        return ($this->ExternalId = $_externalId);
    }
    /**
     * Method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @see SessionManagementWsdlClass::__set_state()
     * @uses SessionManagementWsdlClass::__set_state()
     * @param array $_array the exported values
     * @return SessionManagementStructFolder
     */
    public static function __set_state(array $_array,$_className = __CLASS__)
    {
        return parent::__set_state($_array,$_className);
    }
    /**
     * Method returning the class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return __CLASS__;
    }
}
