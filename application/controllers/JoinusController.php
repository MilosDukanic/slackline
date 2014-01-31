<?php

class JoinusController extends Zend_Controller_Action
{
    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaJoinus.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Join us');
        $autentification= Zend_Auth::getInstance();
        $menu= new Application_Model_MenuMapper();
        if($autentification->hasIdentity()){
             $this->_redirect('/profile/index/user/'.$korisnik->username);
        }
        $result = $menu->fetchAll(0);
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
            if($k=='Join us'){
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
        $loginForm= new Application_Form_Login();
        $this->view->formLogin= $loginForm;
        $signupForm= new Application_Form_Signup();
        $this->view->formSignup= $signupForm;
        
        $this->view->message=$this->getParam('message');
    }


}

