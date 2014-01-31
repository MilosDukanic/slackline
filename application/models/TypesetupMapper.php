<?php

class Application_Model_TypesetupMapper
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
            $this->setDbTable('Application_Model_DbTable_Typesetup');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Typesetup $trickType){
        $data=array(
                  'idTypeSetup'=>$trickType->getId(),
                  'name'=>$trickType->getName(),
        );
        if(null===($idTrickType=$trickType->getId())){
            unset($data['idTypeSetup']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idTypeSetup=?'=>$idTrickType));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $typeSetup=new Application_Model_Typesetup();
            $typeSetup->setId($row->idTypeSetup)->setName($row->name);
            $Items[]=$typeSetup;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idTypeSetup=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $typeSetup=new Application_Model_Typesetup();
            $typeSetup->setId($row->idTypeSetup)->setName($row->name);
            $Item[]=$typeSetup;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idTypeSetup='.$id);
    }
}

