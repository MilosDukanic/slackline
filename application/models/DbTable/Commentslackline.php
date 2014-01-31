<?php

class Application_Model_DbTable_Commentslackline extends Zend_Db_Table_Abstract
{
    protected $_name = 'commentslackline';
    protected $_primary = 'idCommentSlackline';
    protected $_referenceMap=array(
            'User'=>array(
                'columns'=>array('idUser'),
                'refTableClass'=>'Application_Model_DbTable_User',
                'refColumns'=>array('idUser')
            ),
            'Slackline'=>array(
               'columns'=>array('idSlackline'),
               'refTableClass'=>'Application_Model_DbTable_Slackline',
               'refColumns'=>array('idSlackline')
            ),
    );
}

