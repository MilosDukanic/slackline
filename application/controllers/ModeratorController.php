<?php

class ModeratorController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaModify.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Modify');
        $autentification= Zend_Auth::getInstance();
        $menu= new Application_Model_MenuMapper();
        if($autentification->hasIdentity()){
            $user=$autentification->getIdentity();
            $result = $menu->fetchAll($user->idRoles);
        }
        else{
            $this->_helper->redirector('index', 'index');
        }
        if(!$autentification->hasIdentity() || $user->idRoles>3){
            $this->_helper->redirector('index', 'index');
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
            if($k=='Modify'){
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
        $autentification= Zend_Auth::getInstance();
        $user=$autentification->getIdentity();
        
        $this->view->rola=$user->idRoles;
    }

    public function addAction()
    {
        $request=$this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $trick= new Application_Model_Tricktype();
        $trickMapper= new Application_Model_TricktypeMapper();
        $trick=$trickMapper->fetchAll('true');
        $this->view->types=$trick;
        
        $trickMark= new Application_Model_Trickweightmark();
        $trickMarkMapper= new Application_Model_TrickweightmarkMapper();
        $trickMark= $trickMarkMapper->fetchAll('true');
        $this->view->marks=$trickMark;
        
        $brand = new Application_Model_Brand();
        $brandMapper= new Application_Model_BrandMapper();
        $brand= $brandMapper->fetchAll('true');
        $this->view->brands=$brand;
        
        $rating = new Application_Model_Slacklinerating();
        $brandMapper= new Application_Model_SlacklineratingMapper();
        $rating= $brandMapper->fetchAll('true');
        $this->view->rating=$rating;
        
        $setup = new Application_Model_Typesetup();
        $setupMapper= new Application_Model_TypesetupMapper();
        $setup= $setupMapper->fetchAll('true');
        $this->view->setup=$setup;
    }

    public function editAction()
    {
        $request=$this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $trick= new Application_Model_Trick();
        $trickMapper= new Application_Model_TrickMapper();
        $trick=$trickMapper->fetchAll();
        $this->view->trick=$trick;
        
        $trickType= new Application_Model_Tricktype();
        $trickTypeMapper= new Application_Model_TricktypeMapper();
        $trickType=$trickTypeMapper->fetchAll('true');
        $this->view->trickType=$trickType;
        
        $trickWeightMark= new Application_Model_Trickweightmark();
        $trickWeightMarkMapper= new Application_Model_TrickweightmarkMapper();
        $trickWeightMark=$trickWeightMarkMapper->fetchAll('true');
        $this->view->trickWeightMark=$trickWeightMark;
        
        $brand= new Application_Model_Brand();
        $brandMapper= new Application_Model_BrandMapper();
        $brand=$brandMapper->fetchAll('true');
        $this->view->brand=$brand;
        
        $rating= new Application_Model_Slacklinerating();
        $ratingMapper= new Application_Model_SlacklineratingMapper();
        $rating=$ratingMapper->fetchAll('true');
        $this->view->rating=$rating;
        
        $gear= new Application_Model_Gear();
        $gearMapper= new Application_Model_GearMapper();
        $gear=$gearMapper->fetchAll('true');
        $this->view->kit=$gear;
        
        $slackline= new Application_Model_Slackline();
        $slacklineMapper= new Application_Model_SlacklineMapper();
        $slackline=$slacklineMapper->fetchAll('true');
        $this->view->slackline=$slackline;
         
        $setup= new Application_Model_Setup();
        $setupMapper= new Application_Model_SetupMapper();
        $setup=$setupMapper->fetchAll('true');
        $this->view->setup=$setup;
         
        $typeSetup= new Application_Model_Typesetup();
        $typeSetupMapper= new Application_Model_TypesetupMapper();
        $typeSetup=$typeSetupMapper->fetchAll('true');
        $this->view->typeSetup=$typeSetup;
        
        
    }

    public function deleteAction()
    {
        $request=$this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $trick= new Application_Model_Trick();
        $trickMapper= new Application_Model_TrickMapper();
        $trick=$trickMapper->fetchAll();
        $this->view->trick=$trick;
        
        $gear= new Application_Model_Gear();
        $gearMapper= new Application_Model_GearMapper();
        $gear=$gearMapper->fetchAll('true');
        $this->view->kit=$gear;
        
        $slackline= new Application_Model_Slackline();
        $slacklineMapper= new Application_Model_SlacklineMapper();
        $slackline=$slacklineMapper->fetchAll('true');
        $this->view->slackline=$slackline;
         
        $setup= new Application_Model_Setup();
        $setupMapper= new Application_Model_SetupMapper();
        $setup=$setupMapper->fetchAll('true');
        $this->view->setup=$setup;
    }

    public function usersAction()
    {
        $request=$this->getRequest();
        $autentification= Zend_Auth::getInstance();
        $guest=$autentification->getIdentity();
        if(!$request->isPost() || $guest->idRoles!=2){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $user= new Application_Model_User();
        $userMapper= new Application_Model_UserMapper();
        $user=$userMapper->fetchAll('true');
        $this->view->users=$user;
        
        $role= new Application_Model_Roles();
        $roleMapper= new Application_Model_RolesMapper();
        $role=$roleMapper->fetchAll('true');
        $this->view->roles=$role;
    }


}









