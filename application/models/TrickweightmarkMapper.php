<?php

class Application_Model_TrickweightmarkMapper
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
            $this->setDbTable('Application_Model_DbTable_Trickweightmark');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Trickweightmark $trickWeightMark){
        $data=array(
                  'idTrickWeightMark'=>$trickWeightMark->getId(),
                  'idTrickWeight'=>$trickWeightMark->getIdWeight(),
                  'name'=>$trickWeightMark->getName()
        );
        if(null===($idTrickWeightMark=$trickWeightMark->getId())){
            unset($data['idTrickWeightMark']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idTrickWeightMark=?'=>$idTrickWeightMark));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $trickWeightMark=new Application_Model_Trickweightmark();
            $trickWeightMark->setId($row->idTrickWeightMark)->setIdWeight($row->idTrickWeight)->setName($row->name);
            $Items[]=$trickWeightMark;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idTrickWeightMark=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $trickWeightMark=new Application_Model_Trickweightmark();
            $trickWeightMark->setId($row->idTrickWeightMark)->setIdWeight($row->idTrickWeight)->setName($row->name);
            $Item[]=$trickWeightMark;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idTrickWeightMark='.$id);
    }
}

