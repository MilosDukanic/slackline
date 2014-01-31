<?php

class AdministrationController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaAdministration.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Administration');
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
            if($k=='Administration'){
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
        // action body
    }

    public function addAction()
    {
        $request=  $this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $menu= new Application_Model_Menu();
        $menuMapper= new Application_Model_MenuMapper();
        $menu=$menuMapper->fetchAll('true');
        $this->view->menu=$menu;
        
        $trickType= new Application_Model_Tricktype();
        $trickTypeMapper= new Application_Model_TricktypeMapper();
        $trickType=$trickTypeMapper->fetchAll('true');
        $this->view->trickType=$trickType;
        
        $trickWeight= new Application_Model_Trickweight();
        $trickWeightMapper= new Application_Model_TrickweightMapper();
        $trickWeight=$trickWeightMapper->fetchAll('true');
        $this->view->trickWeight=$trickWeight;
        
        $trick= new Application_Model_Trick();
        $trickMapper= new Application_Model_TrickMapper();
        $trick=$trickMapper->fetchAll('true');
        $this->view->trick=$trick;
        
        $trickWeightMark= new Application_Model_Trickweightmark();
        $trickWeightMarkMapper= new Application_Model_TrickweightmarkMapper();
        $trickWeightMark=$trickWeightMarkMapper->fetchAll('true');
        $this->view->trickWeightMark=$trickWeightMark;
        
        $gear= new Application_Model_Gear();
        $gearMapper= new Application_Model_GearMapper();
        $gear=$gearMapper->fetchAll('true');
        $this->view->gear=$gear;
        
        $slackline= new Application_Model_Slackline();
        $slacklineMapper= new Application_Model_SlacklineMapper();
        $slackline=$slacklineMapper->fetchAll();
        $this->view->slackline=$slackline;
        
        $setup= new Application_Model_Setup();
        $setupMapper= new Application_Model_SetupMapper();
        $setup=$setupMapper->fetchAll('true');
        $this->view->setup=$setup;
        
        $setupType= new Application_Model_Typesetup();
        $setupTypeMapper= new Application_Model_TypesetupMapper();
        $setupType=$setupTypeMapper->fetchAll('true');
        $this->view->setupType=$setupType;
        
        $rating= new Application_Model_Slacklinerating();
        $ratingMapper= new Application_Model_SlacklineratingMapper();
        $rating=$ratingMapper->fetchAll('true');
        $this->view->rating=$rating;
        
        $brand= new Application_Model_Brand();
        $brandMapper= new Application_Model_BrandMapper();
        $brand=$brandMapper->fetchAll('true');
        $this->view->brand=$brand;
        
        $roles= new Application_Model_Roles();
        $rolesMapper= new Application_Model_RolesMapper();
        $roles=$rolesMapper->fetchAll('true');
        $this->view->roles=$roles;
        
        $gearComments= new Application_Model_Commentgear();
        $gearCommentsMapper= new Application_Model_CommentgearMapper();
        $gearComments=$gearCommentsMapper->fetchAll('true');
        $this->view->gearComments=$gearComments;
        
        $slacklineComments= new Application_Model_Commentslackline();
        $slacklineCommentsMapper= new Application_Model_CommentslacklineMapper();
        $slacklineComments=$slacklineCommentsMapper->fetchAll('true');
        $this->view->slacklineComments=$slacklineComments;
        
        $users= new Application_Model_User();
        $usersMapper= new Application_Model_UserMapper();
        $users=$usersMapper->fetchAll('true');
        $this->view->users=$users;
        
        $doneTricks= new Application_Model_Donetrick();
        $doneTricksMapper= new Application_Model_DonetrickMapper();
        $doneTricks=$doneTricksMapper->fetchAll();
        $this->view->doneTricks=$doneTricks;
    }

    public function removeAction()
    {
        $request=  $this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        $menu= new Application_Model_Menu();
        $menuMapper= new Application_Model_MenuMapper();
        $menu=$menuMapper->fetchAll('true');
        $this->view->menu=$menu;
        
        $trickType= new Application_Model_Tricktype();
        $trickTypeMapper= new Application_Model_TricktypeMapper();
        $trickType=$trickTypeMapper->fetchAll('true');
        $this->view->trickType=$trickType;
        
        $trickWeight= new Application_Model_Trickweight();
        $trickWeightMapper= new Application_Model_TrickweightMapper();
        $trickWeight=$trickWeightMapper->fetchAll('true');
        $this->view->trickWeight=$trickWeight;
        
        $trick= new Application_Model_Trick();
        $trickMapper= new Application_Model_TrickMapper();
        $trick=$trickMapper->fetchAll('true');
        $this->view->trick=$trick;
        
        $trickWeightMark= new Application_Model_Trickweightmark();
        $trickWeightMarkMapper= new Application_Model_TrickweightmarkMapper();
        $trickWeightMark=$trickWeightMarkMapper->fetchAll('true');
        $this->view->trickWeightMark=$trickWeightMark;
        
        $gear= new Application_Model_Gear();
        $gearMapper= new Application_Model_GearMapper();
        $gear=$gearMapper->fetchAll('true');
        $this->view->gear=$gear;
        
        $slackline= new Application_Model_Slackline();
        $slacklineMapper= new Application_Model_SlacklineMapper();
        $slackline=$slacklineMapper->fetchAll();
        $this->view->slackline=$slackline;
        
        $setup= new Application_Model_Setup();
        $setupMapper= new Application_Model_SetupMapper();
        $setup=$setupMapper->fetchAll('true');
        $this->view->setup=$setup;
        
        $setupType= new Application_Model_Typesetup();
        $setupTypeMapper= new Application_Model_TypesetupMapper();
        $setupType=$setupTypeMapper->fetchAll('true');
        $this->view->setupType=$setupType;
        
        $rating= new Application_Model_Slacklinerating();
        $ratingMapper= new Application_Model_SlacklineratingMapper();
        $rating=$ratingMapper->fetchAll('true');
        $this->view->rating=$rating;
        
        $brand= new Application_Model_Brand();
        $brandMapper= new Application_Model_BrandMapper();
        $brand=$brandMapper->fetchAll('true');
        $this->view->brand=$brand;
        
        $doneTricks= new Application_Model_Donetrick();
        $doneTricksMapper= new Application_Model_DonetrickMapper();
        $doneTricks=$doneTricksMapper->fetchAll();
        $this->view->doneTricks=$doneTricks;
        
        $roles= new Application_Model_Roles();
        $rolesMapper= new Application_Model_RolesMapper();
        $roles=$rolesMapper->fetchAll('true');
        $this->view->roles=$roles;
        
        $gearComments= new Application_Model_Commentgear();
        $gearCommentsMapper= new Application_Model_CommentgearMapper();
        $gearComments=$gearCommentsMapper->fetchAll('true');
        $this->view->gearComments=$gearComments;
        
        $slacklineComments= new Application_Model_Commentslackline();
        $slacklineCommentsMapper= new Application_Model_CommentslacklineMapper();
        $slacklineComments=$slacklineCommentsMapper->fetchAll('true');
        $this->view->slacklineComments=$slacklineComments;
        
        $users= new Application_Model_User();
        $usersMapper= new Application_Model_UserMapper();
        $users=$usersMapper->fetchAll('true');
        $this->view->users=$users;
    }

    public function userAction()
    {
        $request=  $this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        
        
        $users= new Application_Model_User();
        $usersMapper= new Application_Model_UserMapper();
        $users=$usersMapper->fetchAll('true');
        $this->view->users=$users;
        
        $roles= new Application_Model_Roles();
        $rolesMapper= new Application_Model_RolesMapper();
        $roles=$rolesMapper->fetchAll('true');
        $this->view->roles=$roles;
    }


}







