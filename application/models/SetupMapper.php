<?php

class Application_Model_SetupMapper
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
            $this->setDbTable('Application_Model_DbTable_Setup');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Setup $setup){
        $data=array(
                  'idSetup'=>$setup->getId(),
                  'idTypeSetup'=>$setup->getType(),
                  'name'=>$setup->getName(),
                  'forSetup'=>$setup->getFor(),
                  'needed'=>$setup->getNeeded(),
                  'warning'=>$setup->getWarning(),
                  'description'=>$setup->getDescription(),
                  'setupImg'=>$setup->getImg(),
                  'video'=>$setup->getVideo(),
                  'divId'=>$setup->getDivId()
        );
        if(null===($idSetup=$setup->getId())){
            unset($data['idSetup']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$setup->getImg()){
                unset($data['setupImg']);
            }
            $this->getDbTable()->update($data,array('idSetup=?'=>$idSetup));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $setup=new Application_Model_Setup();
            $setup->setId($row->idSetup)->setType($row->idTypeSetup)->setName($row->name)->setFor($row->forSetup)->setNeeded($row->needed)->setWarning($row->warning)->setDescription($row->description)->setImg($row->setupImg)->setVideo($row->video)->setDivId($row->divId);
            $Items[]=$setup;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idSetup=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $setup=new Application_Model_Setup();
            $setup->setId($row->idSetup)->setType($row->idTypeSetup)->setName($row->name)->setFor($row->forSetup)->setNeeded($row->needed)->setWarning($row->warning)->setDescription($row->description)->setImg($row->setupImg)->setVideo($row->video)->setDivId($row->divId);
            $Item[]=$setup;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idSetup='.$id);
    }
}

