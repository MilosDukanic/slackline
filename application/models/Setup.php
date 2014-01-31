<?php

class Application_Model_Setup
{
    protected $_idSetup;
    protected $_idSetupType;
    protected $_name;
    protected $_for;
    protected $_needed;
    protected $_warning;
    protected $_description;
    protected $_image;
    protected $_video;
    protected $_divId;
    
    public function getId() {
        return $this->_idSetup;
    }
    public function setId($data) {
        $this->_idSetup=$data;
        return $this;
    }
    public function getType() {
        return $this->_idSetupType;
    }
    public function setType($data) {
        $this->_idSetupType=$data;
        return $this;
    }
    public function getName() {
        return $this->_name;
    }
    public function setName($data) {
        $this->_name=$data;
        return $this;
    }
    public function getFor() {
        return $this->_for;
    }
    public function setFor($data) {
        $this->_for=$data;
        return $this;
    }
    public function getNeeded() {
        return $this->_needed;
    }
    public function setNeeded($data) {
        $this->_needed=$data;
        return $this;
    }
    public function getWarning() {
        return $this->_warning;
    }
    public function setWarning($data) {
        $this->_warning=$data;
        return $this;
    }
    public function getDescription() {
        return $this->_description;
    }
    public function setDescription($data) {
        $this->_description=$data;
        return $this;
    }
    public function getImg() {
        return $this->_image;
    }
    public function setImg($data) {
        $this->_image=$data;
        return $this;
    }
    public function getVideo() {
        return $this->_video;
    }
    public function setVideo($data) {
        $this->_video=$data;
        return $this;
    }
    public function getDivId() {
        return $this->_divId;
    }
    public function setDivId($data) {
        $this->_divId=$data;
        return $this;
    }
}

