<?php

class Application_Model_DbTable_Slackline extends Zend_Db_Table_Abstract
{
    protected $_name = 'slackline';
    protected $_primary = 'idSlackline';
    protected $_dependentTables=array('Application_Model_DbTable_Commentslackline');
    protected $_referenceMap=array(
            'Brand'=>array(
                'coTricktypelumns'=>array('idBrand'),
                'refTableClass'=>'Application_Model_DbTable_Brand',
                'refColumns'=>array('idBrand')
            ),
            'Slacklinerating'=>array(
               'columns'=>array('idSlacklineRating'),
               'refTableClass'=>'Application_Model_DbTable_Slacklinerating',
               'refColumns'=>array('idSlacklineRating')
            ),
       );
}

