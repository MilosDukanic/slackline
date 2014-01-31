<?php

class Application_Model_Roles
{
     protected $_idRole;
     protected $_name;
     
    public function getId() {
        return $this->_idRole;
    }
    public function setId($data) {
        $this->_idRole=$data;
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

