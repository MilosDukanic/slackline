<?php

class Application_Model_SlacklineratingMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable){
        if(is_string($dbTable)){
            $dbTable=new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_Abstract){
            throw new Exception("Unknown table geteway");
        }
        $this->_dbTable=$dbTable;
        return $this;
    }
    public function getDbTable(){
        if (null == $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Slacklinerating');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Slacklinerating $slacklineRating){
        $data=array(
                  'idSlacklineRating'=>$slacklineRating->getId(),
                  'name'=>$slacklineRating->getName(),
                  'ratingImg'=>$slacklineRating->getImg(),
                  'ratingAlt'=>$slacklineRating->getAlt()
        );
        if(null===($idSlacklineRating=$slacklineRating->getId())){
            unset($data['idSlacklineRating']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$slacklineRating->getImg()){
                unset($data['ratingImg']);
            }
            $this->getDbTable()->update($data,array('idSlacklineRating=?'=>$idSlacklineRating));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $slacklineRating=new Application_Model_Slacklinerating();
            $slacklineRating->setId($row->idSlacklineRating)->setName($row->name)->setImg($row->ratingImg)->setAlt($row->ratingAlt);
            $Items[]=$slacklineRating;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idSlacklineRating=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $slacklineRating=new Application_Model_Slacklinerating();
            $slacklineRating->setId($row->idSlacklineRating)->setName($row->name)->setImg($row->ratingImg)->setAlt($row->ratingAlt);
            $Item[]=$slacklineRating;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idSlacklineRating='.$id);
    }
}

