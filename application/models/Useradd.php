<?php

class Application_Model_Useradd
{
    protected $_id;
    protected $_idUser;
    protected $_phoneNumber;
    protected $_twitter;
    protected $_facebook;
    protected $_dateOfBirth;
    protected $_slacklingFrom;
    protected $_privacy;
     
    public function getIdTable() {
        return $this->_id;
    }
    public function setIdTable($data) {
        $this->_id=$data;
        return $this;
    }
    public function getId() {
        return $this->_idUser;
    }
    public function setId($data) {
        $this->_idUser=$data;
        return $this;
    }
    public function getPhone() {
        return $this->_phoneNumber;
    }
    public function setPhone($data) {
        $this->_phoneNumber=$data;
        return $this;
    }
    public function getTwitter() {
        return $this->_twitter;
    }
    public function setTwitter($data) {
        $this->_twitter=$data;
        return $this;
    }
    public function getFacebook() {
        return $this->_facebook;
    }
    public function setFacebook($data) {
        $this->_facebook=$data;
        return $this;
    }
    public function getBirth() {
        return $this->_dateOfBirth;
    }
    public function setBirth($data) {
        $this->_dateOfBirth=$data;
        return $this;
    }
    public function getSlacklingFrom() {
        return $this->_slacklingFrom;
    }
    public function setSlacklingFrom($data) {
        $this->_slacklingFrom=$data;
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

