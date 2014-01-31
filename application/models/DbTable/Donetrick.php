<?php

class Application_Model_DbTable_Donetrick extends Zend_Db_Table_Abstract
{
    protected $_name = 'donetrick';
    protected $_primary = 'idDoneTrick';
    protected $_referenceMap=array(
            'User'=>array(
                'coTricktypelumns'=>array('idUser'),
                'refTableClass'=>'Application_Model_DbTable_User',
                'refColumns'=>array('idUser')
            ),
            'Trick'=>array(
               'columns'=>array('idTrick'),
               'refTableClass'=>'Application_Model_DbTable_Trick',
               'refColumns'=>array('idTrick')
            ),
    );
}

