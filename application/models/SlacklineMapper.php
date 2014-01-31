<?php

class Application_Model_SlacklineMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable){
        if(is_string($dbTable)){
            $dbTable=new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_Abstract){
            throw new Exception("Unknown table geteway");
        }
        $this->_dbTable=$dbTable;
        return $this;
    }
    public function getDbTable(){
        if (null == $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Slackline');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Slackline $slackline){
        $data=array(
                  'idSlackline'=>$slackline->getId(),
                  'idBrand'=>$slackline->getIdBrand(),
                  'idRating'=>$slackline->getIdRating(),
                  'model'=>$slackline->getModel(),
                  'description'=>$slackline->getDescription(),
                  'slacklineImg'=>$slackline->getImage(),
                  'width'=>$slackline->getWidth(),
                  'length'=>$slackline->getLength(),
                  'forImg'=>$slackline->getForImg(),
                  'price'=>$slackline->getPrice(),
                  'plus'=>$slackline->getPlus(),
                  'minus'=>$slackline->getMinus(),
                  'video'=>$slackline->getVideo()
        );
        if(null===($idSlackline=$slackline->getId())){
            unset($data['idSlackline']);
            $this->getDbTable()->insert($data);
        }else{
            if(null===$slackline->getImage()){
                unset($data['slacklineImg']);
            }
            if(null===$slackline->getForImg()){
                unset($data['forImg']);
            }
            $this->getDbTable()->update($data,array('idSlackline=?'=>$idSlackline));
        }
    }
    public function fetchAll(){
        $statement="SELECT * "
                . "FROM slackline s "
                . "INNER JOIN slacklinerating sr ON s.idRating=sr.idSlacklineRating "
                . "INNER JOIN brand b ON s.idBrand=b.idBrand";
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $slackline=new Application_Model_Slackline();
            $slackline->setId($row['idSlackline'])->setIdBrand($row['name'])->setRatingImg($row['ratingImg'])->setRatingAlt($row['ratingAlt'])->setModel($row['model'])->setImage($row['slacklineImg'])->setWidth($row['width'])->setLength($row['length'])->setForImg($row['forImg'])->setPrice($row['price']);
            $Items[]=$slackline;
        }
        return $Items;
    }
    public function fetchOne($model){
        if($model=='empty'){
            $statement="SELECT * "
                    . "FROM slackline s "
                    . "INNER JOIN slacklinerating sr ON s.idRating=sr.idSlacklineRating "
                    . "INNER JOIN brand b ON s.idBrand=b.idBrand;";
        }
        else{
            $statement="SELECT * "
                    . "FROM slackline s "
                    . "INNER JOIN slacklinerating sr ON s.idRating=sr.idSlacklineRating "
                    . "INNER JOIN brand b ON s.idBrand=b.idBrand "
                    . "WHERE s.model='$model' OR s.idSlackline='$model';";
        }
        $db=  Zend_Db_Table::getDefaultAdapter();
        $resultSet=$db->query($statement)->fetchAll();
        $Items=array();
        foreach ($resultSet as $row){
            $slackline=new Application_Model_Slackline();
            $slackline->setId($row['idSlackline'])->setIdRating($row['idRating'])->setIdBrand($row['name'])->setRatingImg($row['ratingImg'])->setRatingAlt($row['ratingAlt'])->setModel($row['model'])->setImage($row['slacklineImg'])->setWidth($row['width'])->setLength($row['length'])->setForImg($row['forImg'])->setPrice($row['price'])->setPlus($row['plus'])->setMinus($row['minus'])->setVideo($row['video'])->setDescription($row['description']);
            $Items[]=$slackline;
        }
        return $Items;
    }
    public function delete($id){
        $this->getDbTable()->delete('idSlackline='.$id);
    }

}

