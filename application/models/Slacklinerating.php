<?php

class Application_Model_Slacklinerating
{
    protected $_idSlacklineRating;
    protected $_name;
    protected $_ratingImg;
    protected $_ratingAlt;
    
    
    public function getId() {
        return $this->_idSlacklineRating;
    }
    public function setId($data) {
        $this->_idSlacklineRating=$data;
        return $this;
    }
    public function getName() {
        return $this->_name;
    }
    public function setName($data) {
        $this->_name=$data;
        return $this;
    }
    public function getImg() {
        return $this->_ratingImg;
    }
    public function setImg($data) {
        $this->_ratingImg=$data;
        return $this;
    }
    public function getAlt() {
        return $this->_ratingAlt;
    }
    public function setAlt($data) {
        $this->_ratingAlt=$data;
        return $this;
    }
}

