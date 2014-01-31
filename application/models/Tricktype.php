<?php

class Application_Model_Tricktype
{
    protected $_idTrickType;
    protected $_name;
    protected $_trickTypeImg;
    
    public function getId() {
        return $this->_idTrickType;
    }
    public function setId($data) {
        $this->_idTrickType=$data;
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
        return $this->_trickTypeImg;
    }
    public function setImg($data) {
        $this->_trickTypeImg=$data;
        return $this;
    }
}

