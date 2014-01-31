<?php

class Application_Model_DbTable_Trickweightmark extends Zend_Db_Table_Abstract
{

    protected $_name = 'trickweightmark';
    protected $_primary = 'idTrickWeightMark';
    protected $_dependentTables=array('Application_Model_DbTable_Trick');
    protected $_referenceMap=array(
           'Trickweight'=>array(
               'columns'=>array('idTrickWeight'),
               'refTableClass'=>'Application_Model_DbTable_Trickweight',
               'refColumns'=>array('idTrickWeight')
           )
       );
    
}

