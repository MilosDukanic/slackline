<?php

class Application_Model_DbTable_Setup extends Zend_Db_Table_Abstract
{
    protected $_name = 'setup';
    protected $_primary = 'idSetup';
    protected $_referenceMap=array(
            'Typesetup'=>array(
                'columns'=>array('idTypeSetup'),
                'refTableClass'=>'Application_Model_DbTable_Typesetup',
                'refColumns'=>array('idTypeSetup')
            )
       );
}

