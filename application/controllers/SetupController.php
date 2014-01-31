<?php

class SetupController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaSetup.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Setup');
        $autentification= Zend_Auth::getInstance();
        $menu= new Application_Model_MenuMapper();
        if($autentification->hasIdentity()){
            $user=new Application_Model_User();
            $user=$autentification->getIdentity();
            $result = $menu->fetchAll($user->idRoles);
        
        }
        else{
            $result = $menu->fetchAll(0);
        }
        $urls=array();
        $linkovi=array();
        foreach ($result as $value) {
            if($value->getText()=='Profile'){
                $urls[$value->getText()]= $this->view->url(array('controller'=>$value->getHref(),'action'=>$value->getAction(),'user'=>$user->username),null,TRUE); 
                continue;
            }
           $urls[$value->getText()]= $this->view->url(array('controller'=>$value->getHref(),'action'=>$value->getAction()),null,TRUE); 
        }
        foreach($urls as $k=>$v){
            if($k=='Setup'){
                $linkovi[]='<li class="active"><a href="'.$v.'">'.$k.'</a></li>';
            }
            else {
                $linkovi[]='<li><a href="'.$v.'">'.$k.'</a></li>';
            }
        }
        foreach($linkovi as $link){
            $this->view->placeholder('menu')->append($link);
        }
    }

    public function indexAction()
    {
        $menuLeft= new Application_Model_TypesetupMapper();
        $result=$menuLeft->fetchAll('1=1');
        $linkovi=array();
        foreach ($result as $value){
            $subMenuLeft= new Application_Model_SetupMapper();
            $res=$subMenuLeft->fetchAll('idTypeSetup='.$value->getId());
            $linkovi[]="<li><a href='setup/".strtolower($value->getName())."'>".$value->getName()."</a><ul class='green_circle'>";
            foreach ($res as $val){
                $linkovi[]="<li><a href='setup/".strtolower($value->getName())."#".$val->getDivId()."'>".$val->getName()."</a></li>";
            }
            $linkovi[].="</ul></li>";
        }
        $this->view->linkovi=  $linkovi;
    }

    public function indoorAction()
    {
        $this->view->headTitle()->prepend('Indoor');
        $setups= new Application_Model_SetupMapper();
        $elements=$setups->fetchAll('idTypeSetup=1');
        $this->view->elements=$elements;
        $menuLeft= new Application_Model_TypesetupMapper();
        $result=$menuLeft->fetchAll('1=1');
        $linkovi=array();
        foreach ($result as $value){
            $subMenuLeft= new Application_Model_SetupMapper();
            $res=$subMenuLeft->fetchAll('idTypeSetup='.$value->getId());
            $linkovi[]="<li><a href='".strtolower($value->getName())."'>".$value->getName()."</a><ul>";
            foreach ($res as $val){
                $linkovi[]="<li><a href='".strtolower($value->getName())."#".$val->getDivId()."'>".$val->getName()."</a></li>";
            }
            $linkovi[].="</ul></li>";
        }
        $this->view->linkovi=  $linkovi;
    }

    public function outdoorAction()
    {
        $this->view->headTitle()->prepend('Outdoor');
        $setups= new Application_Model_SetupMapper();
        $elements=$setups->fetchAll('idTypeSetup=2');
        $this->view->elements=$elements;
        $menuLeft= new Application_Model_TypesetupMapper();
        $result=$menuLeft->fetchAll('1=1');
        $linkovi=array();
        foreach ($result as $value){
            $subMenuLeft= new Application_Model_SetupMapper();
            $res=$subMenuLeft->fetchAll('idTypeSetup='.$value->getId());
            $linkovi[]="<li><a href='".strtolower($value->getName())."'>".$value->getName()."</a><ul>";
            foreach ($res as $val){
                $linkovi[]="<li><a href='".strtolower($value->getName())."#".$val->getDivId()."'>".$val->getName()."</a></li>";
            }
            $linkovi[].="</ul></li>";
        }
        $this->view->linkovi=  $linkovi;
    }

    public function aframeAction()
    {
        $this->view->headTitle()->prepend('A frame');
        $setups= new Application_Model_SetupMapper();
        $elements=$setups->fetchAll('idTypeSetup=3');
        $this->view->elements=$elements;
        $menuLeft= new Application_Model_TypesetupMapper();
        $result=$menuLeft->fetchAll('1=1');
        $linkovi=array();
        foreach ($result as $value){
            $subMenuLeft= new Application_Model_SetupMapper();
            $res=$subMenuLeft->fetchAll('idTypeSetup='.$value->getId());
            $linkovi[]="<li><a href='".strtolower($value->getName())."'>".$value->getName()."</a><ul>";
            foreach ($res as $val){
                $linkovi[]="<li><a href='".strtolower($value->getName())."#".$val->getDivId()."'>".$val->getName()."</a></li>";
            }
            $linkovi[].="</ul></li>";
        }
        $this->view->linkovi=  $linkovi;
    }


}







