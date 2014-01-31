<?php

class GearController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaGear.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Gear');
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
            if($k=='Gear'){
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
        $mapperSlackline=new Application_Model_SlacklineMapper();
        $this->view->slacklines=$mapperSlackline->fetchAll();
        $mapperGear=new Application_Model_GearMapper();
        $this->view->gear=$mapperGear->fetchAll('1=1');
        
    }

    public function slacklineAction()
    {
        $typeUrl='empty';
        if ($this->getParam('type')!=NULL) {
            $typeUrl = $this->getParam('type');
            $this->view->headTitle()->prepend(ucfirst($typeUrl));
        }
        else {
            $this->view->headTitle()->prepend('Type');
        }
        $mapperSlackline=new Application_Model_SlacklineMapper();
        $this->view->slackline=$mapperSlackline->fetchOne($typeUrl);
        $this->view->slacklineModel=$typeUrl;
        $commentMapper= new Application_Model_CommentslacklineMapper();
        $this->view->comments=$commentMapper->fetchAll($typeUrl);
        $autentification= Zend_Auth::getInstance();
        if($autentification->hasIdentity()){
            $user=$autentification->getIdentity();
            $this->view->isLoged=$user->idUser;
        }
    }


}



