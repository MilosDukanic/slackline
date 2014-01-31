<?php

class Application_Model_DbTable_Useradd extends Zend_Db_Table_Abstract
{

    protected $_name = 'useradd';
    protected $_primary = 'idUserAdd';
    protected $_referenceMap=array(
        'User'=>array(
            'columns'=>array('idUser'),
            'refTableClass'=>'Application_Model_DbTable_User',
            'refColumns'=>array('idUser')
        ),
    );

}

