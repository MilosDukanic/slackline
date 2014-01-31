<?php

class Application_Model_Trickweightmark
{
    protected $_idTrickWeightMark;
    protected $_idTrickWeight;
    protected $_name;
    public function getId() {
        return $this->_idTrickWeightMark;
    }
    public function setId($data) {
        $this->_idTrickWeightMark=$data;
        return $this;
    }
    public function getIdWeight() {
        return $this->_idTrickWeight;
    }
    public function setIdWeight($data) {
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

