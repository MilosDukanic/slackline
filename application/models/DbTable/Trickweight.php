<?php

class Application_Model_DbTable_Trickweight extends Zend_Db_Table_Abstract
{
    protected $_name = 'trickweight';
    protected $_primary = 'idTrickWeight';
    protected $_dependentTables=array('Application_Model_DbTable_Trickweightmark');
}

