<?php

class Application_Model_TrickweightMapper
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
            $this->setDbTable('Application_Model_DbTable_Trickweight');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Trickweight $trickWeight){
        $data=array(
                  'idTrickWeight'=>$trickWeight->getId(),
                  'name'=>$trickWeight->getName()
        );
        if(null===($idTrickType=$trickWeight->getId())){
            unset($data['idTrickWeight']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idTrickWeight=?'=>$idTrickType));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $trickType=new Application_Model_Trickweight();
            $trickType->setId($row->idTrickWeight)->setName($row->name);
            $Items[]=$trickType;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idTrickWeight=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $trickType=new Application_Model_Trickweight();
            $trickType->setId($row->idTrickWeight)->setName($row->name);
            $Item[]=$trickType;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idTrickWeight='.$id);
    }

}

