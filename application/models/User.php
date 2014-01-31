<?php

class Application_Model_User
{
     protected $_idUser;
     protected $_idRole;
     protected $_fullName;
     protected $_username;
     protected $_password;
     protected $_email;
     protected $_userImg;
     protected $_active;
     protected $_code;
     protected $_privacy;
     
    public function getId() {
        return $this->_idUser;
    }
    public function setId($data) {
        $this->_idUser=$data;
        return $this;
    }
    public function getRole() {
        return $this->_idRole;
    }
    public function setRole($data) {
        $this->_idRole=$data;
        return $this;
    }
    public function getName() {
        return $this->_fullName;
    }
    public function setName($data) {
        $this->_fullName=$data;
        return $this;
    }
    public function getUsername() {
        return $this->_username;
    }
    public function setUsername($data) {
        $this->_username=$data;
        return $this;
    }
    public function getPassword() {
        return $this->_password;
    }
    public function setPassword($data) {
        $this->_password=$data;
        return $this;
    }
    public function getEmail() {
        return $this->_email;
    }
    public function setEmail($data) {
        $this->_email=$data;
        return $this;
    }
    public function getImg() {
        return $this->_userImg;
    }
    public function setImg($data) {
        $this->_userImg=$data;
        return $this;
    }
    public function getActive() {
        return $this->_active;
    }
    public function setActive($data) {
        $this->_active=$data;
        return $this;
    }
    public function getCode() {
        return $this->_code;
    }
    public function setCode($data) {
        $this->_code=$data;
        return $this;
    }
    public function getPrivacy() {
        return $this->_privacy;
    }
    public function setPrivacy($data) {
        $this->_privacy=$data;
        return $this;
    }
}

