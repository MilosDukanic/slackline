<?php

class Application_Model_MenuMapper
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
            $this->setDbTable('Application_Model_DbTable_Menu');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Menu $menu){
        $data=array(
                  'idMenu'=>$menu->getId(),
                  'text'=>$menu->getText(),
                  'href'=>$menu->getHref(),
                  'position'=>$menu->getPosition(),
                  'rola'=>$menu->getRole(),
                  'action'=>$menu->getAction()
        );
        if(null===($idMenu=$menu->getId())){
            unset($data['idMenu']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idMenu=?'=>$idMenu));
        }
    }
    public function fetchAll($filters){
        if($filters == '0'){
            $statemant = "rola=0";
        }elseif ($filters == '4') {
            $statemant = "href!='joinus' AND (rola=0 OR rola=4)";
        }elseif($filters=='3' || $filters=='2'){
            $statemant = "href!='joinus' AND (rola=0 OR rola=4 OR rola=3)";
        }else{
            $statemant = "href!='joinus' AND (rola=0 OR rola=4 OR rola=1)";
        }
        $resultSet=$this->getDbTable()->fetchAll($statemant);
        $menuItems=array();
        foreach ($resultSet as $row){
            $menuItem=new Application_Model_Menu();
            $menuItem->setId($row->idMenu)->setText($row->text)->setHref($row->href)->setPosition($row->position)->setRole($row->rola)->setAction($row->action);
            $menuItems[]=$menuItem;
        }
        return $menuItems;
    }
    public function fetchOne($filters){
        if($filters == '0'){
            $statemant = "rola=0";
        }elseif ($filters == '4') {
            $statemant = "href!='joinus' AND (rola=0 OR rola=4)";
        }elseif($filters=='3' || $filters=='2'){
            $statemant = "href!='joinus' AND (rola=0 OR rola=4 OR rola=3)";
        }else{
            $statemant = "href!='joinus' AND (rola=0 OR rola=4 OR rola=1)";
        }
        $resultSet=$this->getDbTable()->fetchAll($statemant);
        $resultSet=$this->getDbTable()->fetchAll($statemant);
        $menuItems=array();
        foreach ($resultSet as $row){
            $menuItem=new Application_Model_Menu();
            $menuItem->setId($row->idMenu)->setText($row->text)->setHref($row->href)->setPosition($row->position)->setRole($row->rola)->setAction($row->action);
            $menuItems[]=$menuItem;
        }
        return $menuItems;
    }
    public function fetchOneAdmin($id){
           
        $resultSet=$this->getDbTable()->fetchAll('idMenu='.$id);
        $menuItems=array();
        foreach ($resultSet as $row){
            $menuItem=new Application_Model_Menu();
            $menuItem->setId($row->idMenu)->setText($row->text)->setHref($row->href)->setPosition($row->position)->setRole($row->rola)->setAction($row->action);
            $menuItems[]=$menuItem;
        }
        return $menuItems;
    }
    public function delete($idMenu){
        $this->getDbTable()->delete('idMenu='.$idMenu);
    }

}