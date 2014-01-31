<?php

class Application_Model_Commentgear
{
    protected $_idComment;
    protected $_idGear;
    protected $_gear;
    protected $_user;
    protected $_idUser;
    protected $_text;
    protected $_date;
    public function getId() {
        return $this->_idComment;
    }
    public function setId($data) {
        $this->_idComment=$data;
        return $this;
    }
    public function getGear() {
        return $this->_idGear;
    }
    public function setGear($data) {
        $this->_idGear=$data;
        return $this;
    }
    public function getGearName() {
        return $this->_gear;
    }
    public function setGearName($data) {
        $this->_gear=$data;
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
        return $this->_user;
    }
    public function setUsername($data) {
        $this->_user=$data;
        return $this;
    }
    public function getText() {
        return $this->_text;
    }
    public function setText($data) {
        $this->_text=$data;
        return $this;
    }
    public function getDate() {
        return $this->_date;
    }
    public function setDate($data) {
        $this->_date=$data;
        return $this;
    }
}

