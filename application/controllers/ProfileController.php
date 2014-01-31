<?php

class ProfileController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $this->view->render('addCode/_menu.phtml');
        $this->view->render('addCode/_topAreaProfile.phtml');
    }

    public function init()
    {
        $this->view->headTitle()->prepend('Profile');
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
            if($k=='Profile'){
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
        if ($this->getParam('user')== NULL) {
            $this->_helper->redirector('index', 'index');
        }
        $autentification= Zend_Auth::getInstance();
        $user = $this->getParam('user');
        $this->view->headTitle()->prepend(ucfirst($user));
                
        $userInfo= new Application_Model_User();
        $userInfoMapper= new Application_Model_UserMapper();
        $userInfo= $userInfoMapper->fetchOne($user);
        if($userInfo== NULL || $userInfo[0]->getActive()==0){
            $this->_helper->redirector('index', 'index');
        }
        foreach ($userInfo as $value) {
            $idUser=$value->getId();
        }
        $this->view->userBasicInfo=$userInfo;
        
        $userInfoAdd= new Application_Model_Useradd();
        $userInfoAddMapper= new Application_Model_UseraddMapper();
        $userInfoAdd= $userInfoAddMapper->fetchOne($idUser);
        $this->view->userAditionalInfo=$userInfoAdd;
        
        $doneTricks= new Application_Model_Donetrick();
        $doneTricksMapper= new Application_Model_DonetrickMapper();
        $doneTricks= $doneTricksMapper->fetchAllForUser($user);
        $this->view->doneTricks=$doneTricks;
        
        $undoneTricks= new Application_Model_Trick();
        $undoneTricks= $doneTricksMapper->fetchUndone($user);
        $this->view->undoneTricks=$undoneTricks;
        
        if($autentification->hasIdentity()){
            $guest=$autentification->getIdentity();
            if($guest->username!=$user){
                $this->_helper->viewRenderer('profile');
            }
            $this->view->guest=$guest;
        }
        else{
            $this->_helper->viewRenderer('profile');
        }
    }

    public function savebasicAction()
    {
        $request=$this->getRequest();
        $autentification= Zend_Auth::getInstance();
        if(!$request->isPost() || !$autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        
        $rola=3;
        $user= new Application_Model_User();
        $userMapper= new Application_Model_UserMapper();
        $imageArray=  explode('/', $_POST['img']);
        $image=$imageArray[count($imageArray)-1];
        $user->setId($_POST['idUser'])->setRole($rola)->setName($_POST['fullName'])->setUsername($_POST['username'])->setEmail($_POST['email'])->setPrivacy($_POST['privacy'])->setActive(1)->setImg($image)->setPassword($_POST['password']);
        $userMapper->save($user);
        echo "Changes are saved!";
    }

    public function saveaditionalAction()
    {
        $request=$this->getRequest();
        $autentification= Zend_Auth::getInstance();
        if(!$request->isPost() || !$autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout()->disableLayout();
        $user= new Application_Model_Useradd();
        $userMapper= new Application_Model_UseraddMapper();
        if($_POST['idUserAdd']!=0){
            $user->setIdTable($_POST['idUserAdd']);
        }
        if($_POST['phoneNumber']!=""){
            $user->setPhone($_POST['phoneNumber']);
        }
        if($_POST['facebook']!=""){
            $user->setFacebook($_POST['facebook']);
        }
        if($_POST['twitter']!=""){
            $user->setTwitter($_POST['twitter']);
        }
        if($_POST['dateOfBirth']!=""){
            $dateOfBirth=explode('-', $_POST['dateOfBirth']);
            $dateOfBirth=mktime(0, 0, 0, $dateOfBirth[1], $dateOfBirth[2], $dateOfBirth[0]);
            $user->setBirth($dateOfBirth);
        }
        if($_POST['slackingFrom']!=""){
            $slackingFrom=explode('-', $_POST['slackingFrom']);
            $slackingFrom=mktime(0, 0, 0, $slackingFrom[1], $slackingFrom[2], $slackingFrom[0]);
            $user->setSlacklingFrom($slackingFrom);
        }
        
        $user->setId($_POST['idUser'])->setPrivacy($_POST['privacy']);
        $userMapper->save($user);
    }

    public function changepicturelAction()
    {
        $request=  $this->getRequest();
        $autentification= Zend_Auth::getInstance();
        if(!$request->isPost() || !$autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        else{
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\users\\profile\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('profilePicture');
            $extension=explode('.', $fileName);
            $ext=$extension[count($extension)-1];

            $newFileName=$_POST['username'].'.'.$ext;
            $upload->addFilter('Rename',array('target'=>$newFileName));
            $upload->addValidator('Extension',false,array('jpg','jpeg','png','gif'));
            $upload->setOptions(array('useByteString'=>FALSE));
            if($upload->receive()){
                $user= new Application_Model_User();
                $userMapper= new Application_Model_UserMapper();
                $user->setId($_POST['id']);
                $user->setImg($newFileName);
                $userMapper->savePicture($user);
            }
            $this->_helper->redirector('index', 'profile');
        }
    }


}







