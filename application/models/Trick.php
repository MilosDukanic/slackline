<?php

class Application_Model_Trick
{
    protected $_idTrick;
    protected $_idTrickType;
    protected $_TrickTypeImg;
    protected $_idTrickWeightMark;
    protected $_trickWeightMarkLink;
    protected $_name;
    protected $_description;
    protected $_image;
    protected $_video;
    
    public function getId() {
        return $this->_idTrick;
    }
    public function setId($data) {
        $this->_idTrick=$data;
        return $this;
    }
    
    public function getIdType() {
        return $this->_idTrickType;
    }
    public function setIdType($data) {
        $this->_idTrickType=$data;
        return $this;
    }
    
    public function getTypeImg() {
        return $this->_TrickTypeImg;
    }
    public function setTypeImg($data) {
        $this->_TrickTypeImg=$data;
        return $this;
    }
    
    public function getIdMark() {
        return $this->_idTrickWeightMark;
    }
    public function setIdMark($data) {
        $this->_idTrickWeightMark=$data;
        return $this;
    }
    
    public function getMarkLink() {
        return $this->_trickWeightMarkLink;
    }
    public function setMarkLink($data) {
        $this->_trickWeightMarkLink=$data;
        return $this;
    }
    
    public function getName() {
        return $this->_name;
    }
    public function setName($data) {
        $this->_name=$data;
        return $this;
    }
    
    public function getDescription() {
        return $this->_description;
    }
    public function setDescription($data) {
        $this->_description=$data;
        return $this;
    }
    
    public function getImage() {
        return $this->_image;
    }
    public function setImage($data) {
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

}

