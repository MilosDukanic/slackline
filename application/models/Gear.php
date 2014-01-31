<?php

class Application_Model_Gear
{
    protected $_idGear;
    protected $_name;
    protected $_description;
    protected $_specification;
    protected $_image;
    
    public function getId() {
        return $this->_idGear;
    }
    public function setId($data) {
        $this->_idGear=$data;
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
    
    public function getSpecification() {
        return $this->_specification;
    }
    public function setSpecification($data) {
        $this->_specification=$data;
        return $this;
    }
    
    public function getImage() {
        return $this->_image;
    }
    public function setImage($data) {
        $this->_image=$data;
        return $this;
    }
}

