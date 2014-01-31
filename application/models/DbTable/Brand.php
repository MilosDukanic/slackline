<?php

class Application_Model_DbTable_Brand extends Zend_Db_Table_Abstract
{
    protected $_name = 'brand';
    protected $_primary = 'idBrand';
    protected $_dependentTables=array('Application_Model_DbTable_Slackline');
}

