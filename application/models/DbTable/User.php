<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';
    protected $_primary = 'idUser';
    protected $_dependentTables=array('Application_Model_DbTable_Donetrick','Application_Model_DbTable_Commentgear','Application_Model_DbTable_Commentslackline','Application_Model_DbTable_Useradd');
    protected $_referenceMap=array(
        'Roles'=>array(
            'columns'=>array('idRoles'),
            'refTableClass'=>'Application_Model_DbTable_Roles',
            'refColumns'=>array('idRoles')
        ),
    );
}

