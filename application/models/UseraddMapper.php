<?php

class Application_Model_UseraddMapper
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
            $this->setDbTable('Application_Model_DbTable_Useradd');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Useradd $user){
        $data=array(
                  'idUserAdd'=>$user->getIdTable(),
                  'idUser'=>$user->getId(),
                  'phoneNumber'=>$user->getPhone(),
                  'facebook'=>$user->getFacebook(),
                  'twitter'=>$user->getTwitter(),
                  'dateOfBirth'=>$user->getBirth(),
                  'slackingFrom'=>$user->getSlacklingFrom(),
                  'privacy'=>$user->getPrivacy()
        );
            if($user->getPhone()=== NULL){
                $data['phoneNumber']='';
            }
            if($user->getFacebook()=== NULL){
                $data['facebook']='';
            }
            if($user->getTwitter()=== NULL){
                $data['twitter']='';
            }
            if($user->getBirth()=== NULL){
                $data['dateOfBirth']='';
            }
            if($user->getSlacklingFrom()=== NULL){
                $data['slackingFrom']='';
            }
        if(NULL===($idUserAdd=$user->getIdTable())){
            unset($data['idUserAdd']);
            if($user->getPrivacy()=== NULL){
                $data['privacy']='1';
            }
            $this->getDbTable()->insert($data);
        }else{
            if($user->getPrivacy()=== NULL){
                unset($data['privacy']);
            }
            $this->getDbTable()->update($data,array('idUserAdd=?'=>$idUserAdd));
        }
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $user=new Application_Model_Useradd();
            $user->setIdTable($row->idUserAdd)->setId($row->idUser)->setPhone($row->phoneNumber)->setFacebook($row->facebook)->setTwitter($row->twitter)->setBirth($row->dateOfBirth)->setSlacklingFrom($row->slackingFrom)->setPrivacy($row->privacy);
            $Items[]=$user;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idUser=$id");
        $Item=array();
        foreach ($resultSet as $row){
            $user=new Application_Model_Useradd();
            $user->setIdTable($row->idUserAdd)->setId($row->idUser)->setPhone($row->phoneNumber)->setFacebook($row->facebook)->setTwitter($row->twitter)->setBirth($row->dateOfBirth)->setSlacklingFrom($row->slackingFrom)->setPrivacy($row->privacy);
            $Item[]=$user;
        }
        return $Item;
    }
    public function delete($id){
        $this->getDbTable()->delete('idUser='.$id);
    }
}

