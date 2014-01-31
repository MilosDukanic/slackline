<?php

class Application_Model_DbTable_Trick extends Zend_Db_Table_Abstract
{
    protected $_name = 'trick';
    protected $_primary = 'idTrick';
    protected $_dependentTables=array('Application_Model_DbTable_Donetrick');
    protected $_referenceMap=array(
            'Tricktype'=>array(
                'columns'=>array('idTricType'),
                'refTableClass'=>'Application_Model_DbTable_Tricktype',
                'refColumns'=>array('idTrickType')
            ),
            'Trickweightmark'=>array(
               'columns'=>array('idTrickWeightMark'),
               'refTableClass'=>'Application_Model_DbTable_Trickweightmark',
               'refColumns'=>array('idTrickWeightMark')
            ),
       );
}

