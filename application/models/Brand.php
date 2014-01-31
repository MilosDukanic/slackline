<?php

class Application_Model_Brand
{
    protected $_idBrand;
    protected $_name;
    protected $_brandImg;
    
    public function getId() {
        return $this->_idBrand;
    }
    public function setId($data) {
        $this->_idBrand=$data;
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
        return $this->_brandImg;
    }
    public function setImg($data) {
        $this->_brandImg=$data;
        return $this;
    }
}

