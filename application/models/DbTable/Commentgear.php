<?php

class Application_Model_DbTable_Commentgear extends Zend_Db_Table_Abstract
{

    protected $_name = 'commentgear';
    protected $_primary = 'idCommentGear';
    protected $_referenceMap=array(
            'User'=>array(
                'columns'=>array('idUser'),
                'refTableClass'=>'Application_Model_DbTable_User',
                'refColumns'=>array('idUser')
            ),
            'Gear'=>array(
               'columns'=>array('idGear'),
               'refTableClass'=>'Application_Model_DbTable_Gear',
               'refColumns'=>array('idGear')
            ),
       );

}

