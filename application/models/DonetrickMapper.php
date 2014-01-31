<?php

class Application_Model_DonetrickMapper
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
            $this->setDbTable('Application_Model_DbTable_Donetrick');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Donetrick $doneTrick){
        $data=array(
                  'idDoneTrick'=>$doneTrick->getId(),
                  'idUser'=>$doneTrick->getUser(),
                  'idTrick'=>$doneTrick->getTrick()
        );
        if(null===($idDoneTrick=$doneTrick->getId())){
            unset($data['idTrickType']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idDoneTrick=?'=>$idDoneTrick));
        }
    }
    public function fetchAll(){
        $statement="SELECT *"
                . "FROM donetrick dt "
                . "INNER JOIN user u ON dt.idUser=u.idUser "
                . "INNER JOIN trick t ON dt.idTrick=t.idTrick";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Item=array();
        foreach ($resultSet as $row){
            $doneTrick=new Application_Model_Donetrick();
            $doneTrick->setId($row['idDoneTrick'])->setUser($row['idUser'])->setTrick($row['idTrick'])->setUsername($row['username'])->setTrickName($row['name']);
            $Item[]=$doneTrick;
        }
        return $Item;
    }
    public function fetchAllForUser($user){
        $statement="SELECT *"
                . "FROM donetrick dt "
                . "INNER JOIN user u ON dt.idUser=u.idUser "
                . "INNER JOIN trick t ON dt.idTrick=t.idTrick "
                . "WHERE u.idUser='$user' OR u.username='$user' ;";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Item=array();
        foreach ($resultSet as $row){
            $doneTrick=new Application_Model_Donetrick();
            $doneTrick->setId($row['idDoneTrick'])->setUser($row['idUser'])->setTrick($row['idTrick'])->setUsername($row['username'])->setTrickName($row['name']);
            $Item[]=$doneTrick;
        }
        return $Item;
    }
    public function fetchOne($id){
        $statement="SELECT *"
                . "FROM donetrick dt "
                . "INNER JOIN user u ON dt.idUser=u.idUser "
                . "INNER JOIN trick t ON dt.idTrick=t.idTrick "
                . "WHERE dt.idDoneTrick=$id";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Item=array();
        foreach ($resultSet as $row){
            $doneTrick=new Application_Model_Donetrick();
            $doneTrick->setId($row['idDoneTrick'])->setUser($row['idUser'])->setTrick($row['idTrick'])->setUsername($row['username'])->setTrickName($row['name']);
            $Item[]=$doneTrick;
        }
        return $Item;
    }
    public function fetchUndone($user){
//        $statement="SELECT *"
//                . "FROM donetrick dt "
//                . "INNER JOIN user u ON dt.idUser=u.idUser "
//                . "INNER JOIN trick t ON dt.idTrick=t.idTrick "
//                . "WHERE dt.idDoneTrick NOT IN "
//                . "(SELECT dt.idTrick FROM donetrick dt INNER JOIN user u ON dt.idUser=u.idUser WHERE u.idUser!='$user' OR u.username!='$user')";
        $statement="SELECT * FROM trick WHERE idTrick NOT IN(SELECT dt.idTrick FROM donetrick dt INNER JOIN user u ON dt.idUser=u.idUser WHERE u.idUser!='$user' OR u.username!='$user')";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Item=array();
        foreach ($resultSet as $row){
            $undoneTrick=new Application_Model_Trick();
            //$undoneTrick->setId($row['idDoneTrick'])->setUser($row['idUser'])->setTrick($row['idTrick'])->setUsername($row['username'])->setTrickName($row['name']);
            $undoneTrick->setId($row['idTrick'])->setName($row['name']);
            $Item[]=$undoneTrick;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete("idDoneTrick=$id");
    }
}

