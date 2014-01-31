<?php

class Application_Model_CommentgearMapper
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
            $this->setDbTable('Application_Model_DbTable_Commentgear');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Commentgear $comment){
        $data=array(
                  'idCommentGear'=>$comment->getId(),
                  'idGear'=>$comment->getGear(),
                  'idUser'=>$comment->getUser(),
                  'text'=>$comment->getText(),
                  'date'=>$comment->getDate()
        );
        if(null===($idCommentGear=$comment->getId())){
            unset($data['idCommentGear']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idCommentGear=?'=>$idCommentGear));
        }
    }
    public function fetchAll($filters){
        $statement="SELECT *"
                . "FROM commentgear c "
                . "INNER JOIN user u ON c.idUser=u.idUser "
                . "INNER JOIN gear g ON c.idGear=g.idGear;";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        foreach ($resultSet as $row){
            $comment=new Application_Model_Commentgear();
            $comment->setId($row['idCommentGear'])->setUsername($row['username'])->setGear($row['idGear'])->setGearName($row['name'])->setUser($row['idUser'])->setText($row['text'])->setDate($row['date']);
            $Items[]=$comment;
        }
        return $Items;
    }
    public function fetchOne($id){
        $statement="SELECT *"
                . "FROM commentgear c "
                . "INNER JOIN user u ON c.idUser=u.idUser "
                . "INNER JOIN gear g ON c.idGear=g.idGear "
                . "WHERE c.idCommentGear=$id;";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        foreach ($resultSet as $row){
            $comment=new Application_Model_Commentgear();
            $comment->setId($row['idCommentGear'])->setUsername($row['username'])->setGear($row['idGear'])->setGearName($row['name'])->setUser($row['idUser'])->setText($row['text'])->setDate($row['date']);
            $Items[]=$comment;
        }
        return $Items;
    }
    public function delete($id){
        $this->getDbTable()->delete('idCommentGear='.$id);
    }
}

