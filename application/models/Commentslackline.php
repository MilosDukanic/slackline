<?php

class Application_Model_Commentslackline
{
    protected $_idComment;
    protected $_idSlackline;
    protected $_idUser;
    protected $_userImg;
    protected $_slackline;
    protected $_username;
    protected $_text;
    protected $_date;
    public function getId() {
        return $this->_idComment;
    }
    public function setId($data) {
        $this->_idComment=$data;
        return $this;
    }
    public function getSlackline() {
        return $this->_idSlackline;
    }
    public function setSlackline($data) {
        $this->_idSlackline=$data;
        return $this;
    }
    public function getSlacklineModel() {
        return $this->_slackline;
    }
    public function setSlacklineModel($data) {
        $this->_slackline=$data;
        return $this;
    }
    public function getUser() {
        return $this->_idUser;
    }
    public function setUser($data) {
        $this->_idUser=$data;
        return $this;
    }
    public function getUserImg() {
        return $this->_userImg;
    }
    public function setUserImg($data) {
        $this->_userImg=$data;
        return $this;
    }
    public function getUsername() {
        return $this->_username;
    }
    public function setUsername($data) {
        $this->_username=$data;
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

