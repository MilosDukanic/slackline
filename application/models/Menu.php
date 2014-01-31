<?php

class Application_Model_Menu
{
    protected $_idMenu;
    protected $_text;
    protected $_href;
    protected $_position;
    protected $_role;
    protected $_action;


    public function setId($data){
        $this->_idMenu=$data;
        return $this;
    }
    public function getId(){
        return $this->_idMenu;
    } 
    public function setText($data){
        $this->_text=$data;
        return $this;
    }
    public function getText(){
        return $this->_text;
    }
    public function setHref($data){
        $this->_href=$data;
        return $this;
    }
    public function getHref(){
        return $this->_href;
    }
    public function setPosition($data){
        $this->_position=$data;
        return $this;
    }
    public function getPosition(){
        return $this->_position;
    }
    public function setRole($data){
        $this->_role=$data;
        return $this;
    }
    public function getRole(){
        return $this->_role;
    }
    public function setAction($data){
        $this->_action=$data;
        return $this;
    }
    public function getAction(){
        return $this->_action;
    }
}

