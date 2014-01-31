<?php

class Application_Model_Donetrick
{
    protected $_idDoneTrick;
    protected $_idUser;
    protected $_username;
    protected $_trickName;
    protected $_idTrick;
    
    public function getId() {
        return $this->_idDoneTrick;
    }
    public function setId($data) {
        $this->_idDoneTrick=$data;
        return $this;
    }
    public function getUser() {
        return $this->_idUser;
    }
    public function setUser($data) {
        $this->_idUser=$data;
        return $this;
    }
    public function getUsername() {
        return $this->_username;
    }
    public function setUsername($data) {
        $this->_username=$data;
        return $this;
    }
    public function getTrick() {
        return $this->_idTrick;
    }
    public function setTrick($data) {
        $this->_idTrick=$data;
        return $this;
    }
    public function getTrickName() {
        return $this->_trickName;
    }
    public function setTrickName($data) {
        $this->_trickName=$data;
        return $this;
    }
}

