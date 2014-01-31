<?php

class Application_Model_UserMapper
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
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_User $user){
            $data=array(
                'idUser'=>$user->getId(),
                'idRoles'=>$user->getRole(),
                'fullName'=>$user->getName(),
                'username'=>$user->getUsername(),
                'email'=>$user->getEmail(),
                'userImg'=>$user->getImg(),
                'password'=>md5($user->getPassword()),
                'active'=>$user->getActive(),
                'code'=>$user->getCode(),
                'privacy'=>$user->getPrivacy()
            );
        if(null===($idUser=$user->getId())){
            unset($data['idUser']);
            $this->getDbTable()->insert($data);
        }else{
            if($user->getPassword()=== NULL){
                unset($data['password']);
            }
            if($user->getImg()=== NULL){
                unset($data['userImg']);
            }
            $this->getDbTable()->update($data,array('idUser=?'=>$idUser));
        }
    }
    public function savePicture(Application_Model_User $user){
        $data=array('userImg'=>$user->getImg());
        $idUser=$user->getId();
        $this->getDbTable()->update($data,array('idUser=?'=>$idUser));
    }
    public function fetchAll($filters){
        $resultSet=$this->getDbTable()->fetchAll($filters);
        $Items=array();
        foreach ($resultSet as $row){
            $user=new Application_Model_User();
            $user->setId($row->idUser)->setRole($row->idRoles)->setName($row->fullName)->setUsername($row->username)->setEmail($row->email)->setPassword($row->password)->setImg($row->userImg)->setActive($row->active)->setCode($row->code)->setPrivacy($row->privacy);
            $Items[]=$user;
        }
        return $Items;
    }
    public function fetchOne($id){
        $resultSet=$this->getDbTable()->fetchAll("idUser='$id' OR username='$id'");
        $Item=array();
        foreach ($resultSet as $row){
            $user=new Application_Model_User();
            $user->setId($row->idUser)->setRole($row->idRoles)->setName($row->fullName)->setUsername($row->username)->setEmail($row->email)->setPassword($row->password)->setImg($row->userImg)->setActive($row->active)->setCode($row->code)->setPrivacy($row->privacy);
            $Item[]=$user;
        }
        return $Item;
    }
    public function login($email,$password) {
        $resultSet=$this->getDbTable()->fetchRow("email='$email' AND password='$password'");
        $Item=array();
        if(count($resultSet)){
            foreach ($resultSet as $row){
                $user=new Application_Model_User();
                $user->setId($row->idUser)->setRole($row->idRole)->setName($row->fullName)->setUsername($row->username)->setEmail($row->email)->setPassword($row->password)->setImg($row->userImg)->setActive($row->active)->setCode($row->code)->setPrivacy($row->privacy);
                $Item[]=$user;
            }
            return $Item;
        }
        else {
            return FALSE;
        }
    }
    public function delete($id){
        $this->getDbTable()->delete('idUser='.$id);
    }
}

