<?php

class TricksController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaTricks.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Tricks');
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
            if($k=='Tricks'){
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
        $type= new Application_Model_TricktypeMapper();
        $resultType=$type->fetchAll('1=1');
        $linkoviType=array();
        
        foreach ($resultType as $value){
            $linkoviType[]="<li><a href='".$this->view->url(array('controller'=>'tricks','action'=>'type','type'=>strtolower($value->getName())),null,TRUE)."'>".$value->getName()."</a></li>";
        }
        
        $this->view->type=  $linkoviType;
        
        $weight= new Application_Model_TrickweightMapper();
        $resultWeight=$weight->fetchAll('1=1');
        $linkoviWeight=array();
        foreach ($resultWeight as $value){
            $linkoviWeight[]="<li><a href='tricks/weight/".strtolower($value->getName())."'>".$value->getName()."</a></li>";
        }
        
        $this->view->weight=  $linkoviWeight;
        
        $trick= new Application_Model_TrickMapper();
        $this->view->tricks=$trick->fetchRandom(8);
    }

    public function typeAction()
    {
        $typeUrl="empty";
        if ($this->getParam('type')!=NULL) {
            $typeUrl = $this->getParam('type');
            $this->view->headTitle()->prepend(ucfirst($typeUrl));
        }
        else {
            $this->view->headTitle()->prepend('Type');
        }
        $type= new Application_Model_TricktypeMapper();
        $resultType=$type->fetchAll('1=1');
        $linkoviType=array();
        foreach ($resultType as $value){
            $linkoviType[]="<li><a href='".$this->view->url(array('controller'=>'tricks','action'=>'type','type'=>strtolower($value->getName())),null,TRUE)."'>".$value->getName()."</a></li>";
        }
        $this->view->type=  $linkoviType;
        $weight= new Application_Model_TrickweightMapper();
        $resultWeight=$weight->fetchAll('1=1');
        $linkoviWeight=array();
        foreach ($resultWeight as $value){
            $linkoviWeight[]="<li><a href='".$this->view->url(array('controller'=>'tricks','action'=>'weight','type'=>strtolower($value->getName())),null,TRUE)."'>".$value->getName()."</a></li>";
        }
        $this->view->weight=  $linkoviWeight;
        $trick= new Application_Model_TrickMapper();
        $this->view->tricks = $trick->fetchByType($typeUrl);
    }

    public function weightAction()
    {
        $typeUrl="empty";
        if ($this->getParam('type')!=NULL) {
            $typeUrl = $this->getParam('type');
            $this->view->headTitle()->prepend(ucfirst($typeUrl));
        }
        else {
            $this->view->headTitle()->prepend('Weight');
        }
        $type= new Application_Model_TricktypeMapper();
        $resultType=$type->fetchAll('1=1');
        $linkoviType=array();
        foreach ($resultType as $value){
            $linkoviType[]="<li><a href='".$this->view->url(array('controller'=>'tricks','action'=>'type','type'=>strtolower($value->getName())),null,TRUE)."'>".$value->getName()."</a></li>";
        }
        $this->view->type=  $linkoviType;
        $weight= new Application_Model_TrickweightMapper();
        $resultWeight=$weight->fetchAll('1=1');
        $linkoviWeight=array();
        foreach ($resultWeight as $value){
            $linkoviWeight[]="<li><a href='".$this->view->url(array('controller'=>'tricks','action'=>'weight','type'=>strtolower($value->getName())),null,TRUE)."'>".$value->getName()."</a></li>";
        }
        $this->view->weight=  $linkoviWeight;
        $trick= new Application_Model_TrickMapper();
        $this->view->tricks = $trick->fetchByWeight($typeUrl);
    }


}





