<?php

class Application_Model_Trickweight
{
    protected $_idTrickWeight;
    protected $_name;
    
    public function getId() {
        return $this->_idTrickWeight;
    }
    public function setId($data) {
        $this->_idTrickWeight=$data;
        return $this;
    }
    public function getName() {
        return $this->_name;
    }
    public function setName($data) {
        $this->_name=$data;
        return $this;
    }
}

