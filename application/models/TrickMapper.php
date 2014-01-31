<?php

class Application_Model_TrickMapper
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
            $this->setDbTable('Application_Model_DbTable_Trick');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Trick $trick){
        $data=array(
                  'idTrick'=>$trick->getId(),
                  'idTrickType'=>$trick->getIdType(),
                  'idTrickWeightMark'=>$trick->getIdMark(),
                  'name'=>$trick->getName(),
                  'description'=>$trick->getDescription(),
                  'trickImg'=>$trick->getImage(),
                  'video'=>$trick->getVideo()
        );
        if(null===($idTrick=$trick->getId())){
            unset($data['idTrick']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$trick->getImage()){
                unset($data['trickImg']);
            }
            $this->getDbTable()->update($data,array('idTrick=?'=>$idTrick));
        }
    }
    public function fetchRandom($howMuch=4){
        $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight "
                . "ORDER BY RAND() "
                . "LIMIT $howMuch";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $trick=new Application_Model_Trick();
            $trick->setId($row['idTrick'])->setIdType($row['typeName'])->setIdMark($row['idMark'])->setName($row['name'])->setDescription($row['description'])->setImage($row['img'])->setVideo($row['video'])->setMarkLink($row['mark'])->setTypeImg($row['typeImg']);
            $Items[]=$trick;
        }
        return $Items;
    }
    public function fetchByType($type){
        if($type=='empty'){
        $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight;";
        }
        else{
            $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight "
                . "WHERE tt.name='".ucfirst($type)."';";
        }
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $trick=new Application_Model_Trick();
            $trick->setId($row['idTrick'])->setIdType($row['typeName'])->setIdMark($row['idMark'])->setName($row['name'])->setDescription($row['description'])->setImage($row['img'])->setVideo($row['video'])->setMarkLink($row['mark'])->setTypeImg($row['typeImg']);
            $Items[]=$trick;
        }
        return $Items;
    }
    public function fetchByWeight($type){
        if($type=='empty'){
         $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight ;";
        }
        else {
            $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight "
                . "WHERE tw.name='".ucfirst($type)."';";
        }
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $trick=new Application_Model_Trick();
            $trick->setId($row['idTrick'])->setIdType($row['typeName'])->setIdMark($row['idMark'])->setName($row['name'])->setDescription($row['description'])->setImage($row['img'])->setVideo($row['video'])->setMarkLink($row['mark'])->setTypeImg($row['typeImg']);
            $Items[]=$trick;
        }
        return $Items;
    }
    public function fetchAll(){
        $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight ";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $trick=new Application_Model_Trick();
            $trick->setId($row['idTrick'])->setIdType($row['typeName'])->setIdMark($row['idMark'])->setName($row['name'])->setDescription($row['description'])->setImage($row['img'])->setVideo($row['video'])->setMarkLink($row['mark'])->setTypeImg($row['typeImg']);
            $Items[]=$trick;
        }
        return $Items;
    }
    public function fetchOne($id){
        $statement="SELECT t.idTrick,tt.name AS typeName,twm.name AS idMark,t.name AS name,t.description AS description,t.trickImg AS img,t.video AS video,tw.name as mark,tt.trickTypeImg as typeImg "
                . "FROM trick AS t "
                . "INNER JOIN tricktype AS tt ON t.idTrickType=tt.idTrickType "
                . "INNER JOIN trickweightmark AS twm ON t.idTrickWeightMark=twm.idTrickWeightMark "
                . "INNER JOIN trickweight AS tw ON twm.idTrickWeight=tw.idTrickWeight "
                . "WHERE t.idTrick='$id' OR t.name='$id';";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $trick=new Application_Model_Trick();
            $trick->setId($row['idTrick'])->setIdType($row['typeName'])->setIdMark($row['idMark'])->setName($row['name'])->setDescription($row['description'])->setImage($row['img'])->setVideo($row['video'])->setMarkLink($row['mark'])->setTypeImg($row['typeImg']);
            $Items[]=$trick;
        }
        return $Items;
    }
    public function delete($id){
        $this->getDbTable()->delete('idTrick='.$id);
    }


}

