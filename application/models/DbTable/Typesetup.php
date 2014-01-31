<?php

class Application_Model_DbTable_Typesetup extends Zend_Db_Table_Abstract
{
    protected $_name = 'typesetup';
    protected $_primary = 'idTypeSetup';
    protected $_dependentTables=array('Application_Model_DbTable_Setup');
}

