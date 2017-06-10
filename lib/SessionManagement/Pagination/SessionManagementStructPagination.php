<?php
/**
 * File for class SessionManagementStructPagination
 * @package SessionManagement
 * @subpackage Structs
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-01-19
 */
/**
 * This class stands for SessionManagementStructPagination originally named Pagination
 * Meta informations extracted from the WSDL
 * - from schema : {@link http://demo.hosted.panopto.com/Panopto/PublicAPI/4.6/SessionManagement.svc?xsd=xsd2}
 * @package SessionManagement
 * @subpackage Structs
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20150429-01
 * @date 2017-01-19
 */
class SessionManagementStructPagination extends SessionManagementWsdlClass
{
    /**
     * The MaxNumberResults
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * @var int
     */
    public $MaxNumberResults;
    /**
     * The PageNumber
     * Meta informations extracted from the WSDL
     * - minOccurs : 0
     * @var int
     */
    public $PageNumber;
    /**
     * Constructor method for Pagination
     * @see parent::__construct()
     * @param int $_maxNumberResults
     * @param int $_pageNumber
     * @return SessionManagementStructPagination
     */
    public function __construct($_maxNumberResults = NULL,$_pageNumber = NULL)
    {
        parent::__construct(array('MaxNumberResults'=>$_maxNumberResults,'PageNumber'=>$_pageNumber),false);
    }
    /**
     * Get MaxNumberResults value
     * @return int|null
     */
    public function getMaxNumberResults()
    {
        return $this->MaxNumberResults;
    }
    /**
     * Set MaxNumberResults value
     * @param int $_maxNumberResults the MaxNumberResults
     * @return int
     */
    public function setMaxNumberResults($_maxNumberResults)
    {
        return ($this->MaxNumberResults = $_maxNumberResults);
    }
    /**
     * Get PageNumber value
     * @return int|null
     */
    public function getPageNumber()
    {
        return $this->PageNumber;
    }
    /**
     * Set PageNumber value
     * @param int $_pageNumber the PageNumber
     * @return int
     */
    public function setPageNumber($_pageNumber)
    {
        return ($this->PageNumber = $_pageNumber);
    }
    /**
     * Method called when an object has been exported with var_export() functions
     * It allows to return an object instantiated with the values
     * @see SessionManagementWsdlClass::__set_state()
     * @uses SessionManagementWsdlClass::__set_state()
     * @param array $_array the exported values
     * @return SessionManagementStructPagination
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
