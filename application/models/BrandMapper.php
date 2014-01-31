<?php

class Application_Model_BrandMapper
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
            $this->setDbTable('Application_Model_DbTable_Brand');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Brand $brand){
        $data=array(
                  'idBrand'=>$brand->getId(),
                  'name'=>$brand->getName(),
                  'brandImg'=>$brand->getImg()
        ); 
        
        if(null===($idBrand=$brand->getId())){
            unset($data['idBrand']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$brand->getImg()){
                unset($data['brandImg']);
            }
            $this->getDbTable()->update($data,array('idBrand=?'=>$idBrand));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $brand=new Application_Model_Brand();
            $brand->setId($row->idBrand)->setName($row->name)->setImg($row->brandImg);
            $Items[]=$brand;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchRow("idBrand=".$id);
        $Item=array();
        foreach ($resultSet as $row){
            $brand=new Application_Model_Brand();
            $brand->setId($row->idBrand)->setName($row->name)->setImg($row->brandImg);
            $Item[]=$brand;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idBrand='.$id);
    }
}

