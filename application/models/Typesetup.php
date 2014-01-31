<?php

class Application_Model_Typesetup
{
    protected $_idSetupType;
    protected $_name;
    
    public function getId() {
        return $this->_idSetupType;
    }
    public function setId($data) {
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
}

