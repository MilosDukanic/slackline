<?php

class Application_Model_DbTable_Tricktype extends Zend_Db_Table_Abstract
{

    protected $_name = 'tricktype';
    protected $_primary = 'idTrickType';
    protected $_dependentTables=array('Application_Model_DbTable_Trick');
    
}

