<?php

class Application_Model_DbTable_Gear extends Zend_Db_Table_Abstract
{

    protected $_name = 'gear';
    protected $_primary = 'idGear';
    protected $_dependentTables=array('Application_Model_DbTable_Commentgear');

}

