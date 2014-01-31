<?php

class Application_Model_TricktypeMapper
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
            $this->setDbTable('Application_Model_DbTable_Tricktype');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Tricktype $trickType){
        $data=array(
                  'idTrickType'=>$trickType->getId(),
                  'name'=>$trickType->getName(),
                  'trickTypeImg'=>$trickType->getImg()
        );
        if(null===($idTrickType=$trickType->getId())){
            unset($data['idTrickType']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$trickType->getImg()){
                unset($data['trickTypeImg']);
            }
            $this->getDbTable()->update($data,array('idTrickType=?'=>$idTrickType));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $trickType=new Application_Model_Tricktype();
            $trickType->setId($row->idTrickType)->setName($row->name)->setImg($row->trickTypeImg);
            $Items[]=$trickType;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idTrickType=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $trickType=new Application_Model_Tricktype();
            $trickType->setId($row->idTrickType)->setName($row->name)->setImg($row->trickTypeImg);
            $Item[]=$trickType;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idTrickType='.$id);
    }

}

