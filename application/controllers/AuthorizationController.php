<?php

class AuthorizationController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        $this->_helper->redirector('index', 'index');
    }

    public function registrationAction()
    {
        $request=  $this->getRequest();
        $autentification= Zend_Auth::getInstance();
        if(!$request->isPost() || !isset($_POST['fullName']) || !isset($_POST['username']) || !isset($_POST['email']) || !isset($_POST['password']) || $autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        $name=$_POST['fullName'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password= md5($_POST['password']);
        $userImage="default.gif";
        $code=  sha1(md5($username));
        if($username=="" || $email=="" || $password==""){
            $this->_helper->redirector('index', 'index');
        }
        $user= new Application_Model_User();
        
        $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\users\\profile\\';
        $upload= new Zend_File_Transfer_Adapter_Http();
        $upload->setDestination($fileDirectory);
        $fileName=$upload->getFileName('profilePicture');
        $object=new Application_Model_Tricktype();
        $objectMapper= new Application_Model_TricktypeMapper();
        if ($fileName != NULL) {
            $extension=explode('.', $fileName);
            $ext=$extension[count($extension)-1];
            $newFileName=  strtolower($username).'.'.$ext;
            $upload->addFilter('Rename',array('target'=>$newFileName));
            $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
            $upload->setOptions(array('useByteString'=>FALSE));
            if($upload->receive()){
                $object->setImg($newFileName);
                $userImage=$newFileName;
            }
        }
        $user->setRole('4')->setName($name)->setUsername($username)->setPassword($password)->setEmail($email)->setImg($userImage)->setActive('0')->setCode($code)->setPrivacy(1);
        
        $userMapper= new Application_Model_UserMapper();
        $userMapper->save($user);
        $message="Please check your mail to activate account.";
        $this->_redirect('/index/index/msg/'.$message);
    }

    public function loginAction()
    {
        $request=  $this->getRequest();
        $autentification= Zend_Auth::getInstance();
        if(!$request->isPost() || !isset($_POST['email']) || !isset($_POST['password']) || $autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        $email=$_POST['email'];
        $password= md5($_POST['password']);
        $auth= Zend_Auth::getInstance();
        $user= new Application_Model_DbTable_User();
        $authAdapter= new Zend_Auth_Adapter_DbTable($user->getAdapter(),'user');
        $authAdapter->setIdentityColumn('email')->setCredentialColumn('password');
        $authAdapter->setIdentity($email)->setCredential($password);
        $result=$auth->authenticate($authAdapter);
        echo $_POST['password'];
        if($result->isValid()){
            $session= new Zend_Auth_Storage_Session();
            $data=$authAdapter->getResultRowObject(null,'lozinka');
            $session->write($data);
            $this->_redirect('/profile/index/user/'.$data->username);
        }
        $this->_redirect('/joinus/index/message/login');
        
    }

    public function logoutAction()
    {
        $autentification= Zend_Auth::getInstance();
        if($autentification->hasIdentity()){
            Zend_Session::destroy( true );
        }
        $this->_helper->redirector('index', 'index');
    }


}







