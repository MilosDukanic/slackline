<?php

class Application_Model_CommentslacklineMapper
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
            $this->setDbTable('Application_Model_DbTable_Commentslackline');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Commentslackline $comment){
        $data=array(
                  'idCommentSlackline'=>$comment->getId(),
                  'idSlackline'=>$comment->getSlackline(),
                  'idUser'=>$comment->getUser(),
                  'text'=>$comment->getText(),
                  'date'=>$comment->getDate()
        );
        if(null===($idComment=$comment->getId())){
            unset($data['idCommentSlackline']);
            $this->getDbTable()->insert($data);
        }else{
            $this->getDbTable()->update($data,array('idCommentSlackline=?'=>$idComment));
        }
    }
    public function fetchAll($model){
        $statement="SELECT *"
                . "FROM commentslackline cs "
                . "INNER JOIN user u ON cs.idUser=u.idUser "
                . "INNER JOIN slackline s ON cs.idSlackline=s.idSlackline "
                . "WHERE s.model='$model';";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $comment=new Application_Model_Commentslackline();
            $comment->setId($row['idCommentSlackline'])->setUsername($row['username'])->setSlackline($row['idSlackline'])->setSlacklineModel($row['model'])->setUser($row['idUser'])->setText($row['text'])->setDate($row['date'])->setUserImg($row['userImg']);
            $Items[]=$comment;
        }
        return $Items;
    }
    public function fetchOne($id){
        $statement="SELECT *"
                . "FROM commentslackline cs "
                . "INNER JOIN user u ON cs.idUser=u.idUser "
                . "INNER JOIN slackline s ON cs.idSlackline=s.idSlackline "
                . "WHERE cs.idCommentSlackline=$id;";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $comment=new Application_Model_Commentslackline();
            $comment->setId($row['idCommentSlackline'])->setUsername($row['username'])->setSlackline($row['idSlackline'])->setSlacklineModel($row['model'])->setUser($row['idUser'])->setText($row['text'])->setDate($row['date']);
            $Items[]=$comment;
        }
        return $Items;
    }
    public function delete($id){
        $this->getDbTable()->delete('idCommentSlackline='.$id);
    }
}

