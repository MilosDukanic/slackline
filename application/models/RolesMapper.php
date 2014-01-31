<?php

class Application_Model_RolesMapper
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
            $this->setDbTable('Application_Model_DbTable_Roles');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Roles $roles){
        $data=array(
                  'idRoles'=>$roles->getId(),
                  'name'=>$roles->getName(),
        );
        if(null===($idRole=$roles->getId())){
            unset($data['idRole']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idRoles=?'=>$idRole));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $role=new Application_Model_Roles();
            $role->setId($row->idRoles)->setName($row->name);
            $Items[]=$role;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idRoles=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $role=new Application_Model_Roles();
            $role->setId($row->idRoles)->setName($row->name);
            $Item[]=$role;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idRoles='.$id);
    }
}

