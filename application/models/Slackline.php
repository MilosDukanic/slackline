<?php

class Application_Model_Slackline
{
    protected $_idSlackline;
    protected $_idBrand;
    protected $_idRating;
    protected $_ratingImg;
    protected $_ratingAlt;
    protected $_model;
    protected $_description;
    protected $_image;
    protected $_width;
    protected $_length;
    protected $_forImg;
    protected $_price;
    protected $_plus;
    protected $_minus;
    protected $_video;
    
    public function getId() {
        return $this->_idSlackline;
    }
    public function setId($data) {
        $this->_idSlackline=$data;
        return $this;
    }
    public function getIdBrand() {
        return $this->_idBrand;
    }
    public function setIdRating($data) {
        $this->_idRating=$data;
        return $this;
    }
    public function getIdRating() {
        return $this->_idRating;
    }
    public function setIdBrand($data) {
        $this->_idBrand=$data;
        return $this;
    }
    public function getRatingImg() {
        return $this->_ratingImg;
    }
    public function setRatingImg($data) {
        $this->_ratingImg=$data;
        return $this;
    }
    public function getRatingAlt() {
        return $this->_ratingAlt;
    }
    public function setRatingAlt($data) {
        $this->_ratingAlt=$data;
        return $this;
    }
    public function getModel() {
        return $this->_model;
    }
    public function setModel($data) {
        $this->_model=$data;
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
    public function getWidth() {
        return $this->_width;
    }
    public function setWidth($data) {
        $this->_width=$data;
        return $this;
    }
    public function getLength() {
        return $this->_length;
    }
    public function setLength($data) {
        $this->_length=$data;
        return $this;
    }
    public function getForImg() {
        return $this->_forImg;
    }
    public function setForImg($data) {
        $this->_forImg=$data;
        return $this;
    }
    public function getPrice() {
        return $this->_price;
    }
    public function setPrice($data) {
        $this->_price=$data;
        return $this;
    }
    public function getPlus() {
        return $this->_plus;
    }
    public function setPlus($data) {
        $this->_plus=$data;
        return $this;
    }
    public function getMinus() {
        return $this->_minus;
    }
    public function setMinus($data) {
        $this->_minus=$data;
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

