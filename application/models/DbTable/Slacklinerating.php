<?php

class Application_Model_DbTable_Slacklinerating extends Zend_Db_Table_Abstract
{

    protected $_name = 'slacklinerating';
    protected $_primary = 'idSlacklineRating';
    protected $_dependentTables=array('Application_Model_DbTable_Slackline');

}

