<?php

class Application_Model_GearMapper
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
            $this->setDbTable('Application_Model_DbTable_Gear');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Gear $gear){
        $data=array(
                  'idGear'=>$gear->getId(),
                  'name'=>$gear->getName(),
                  'description'=>$gear->getDescription(),
                  'specification'=>$gear->getSpecification(),
                  'gearImg'=>$gear->getImage()
        );
        if(null===($idGear=$gear->getId())){
            unset($data['idGear']);
            
            $this->getDbTable()->insert($data);
        }else{
            if(null===$gear->getImage()){
                unset($data['gearImg']);
            }
            $this->getDbTable()->update($data,array('idGear=?'=>$idGear));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $gear=new Application_Model_Gear();
            $gear->setId($row->idGear)->setName($row->name)->setDescription($row->description)->setSpecification($row->specification)->setImage($row->gearImg);
            $Items[]=$gear;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idGear=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $gear=new Application_Model_Gear();
            $gear->setId($row->idGear)->setName($row->name)->setDescription($row->description)->setSpecification($row->specification)->setImage($row->gearImg);
            $Item[]=$gear;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idGear='.$id);
    }

}

