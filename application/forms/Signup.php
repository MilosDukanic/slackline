<?php

class Application_Form_Signup extends Zend_Form
{

    public function init()
    {
        $this->setAction('/Authorization/registration')->setMethod('post');
        $this->setAttrib('class','dialog-form');
        $this->setAttrib('name','signupForm');
	$this->setDecorators(array('FormElements'));
        $this->setAttrib('enctype', 'multipart/form-data');

        $fullName=new Zend_Form_Element_Text('fullName');
        $fullName->setAttrib('class','span12');
        $fullName->setRequired(true);
        $fullName->addValidator('regex',false,array('/^[A-Z][a-z]{2,15}\s[A-Z][a-z]{2,15}$/'))->addErrorMessage('Not good format!!');
        $fullName->setAttrib('placeholder','My full name');
        $fullName->setAttrib('pattern','[A-Z][a-z]{2,15}\s[A-Z][a-z]{2,15}');
        $fullName->setAttrib('required','required');
        
        $username=new Zend_Form_Element_Text('username');
        $username->class='span12';
        $username->setRequired(true);
        $username->addValidator('regex',false,array('/^[A-Za-z\!\#\@\$\d]{5,}$/'))->addErrorMessage('Not good format!!');
        $username->setAttrib('placeholder','Choose username');
        $username->setAttrib('pattern','[A-Za-z\!\#\@\$\d]{5,}');
        $username->setAttrib('required','required');
        
        $email=new Zend_Form_Element_Text('email');
        $email->class='span12';
        $email->setRequired(true);
        $email->addValidator('EmailAddress');
        $email->setAttrib('placeholder','Email address');
        $email->setAttrib('pattern','[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})');
        $email->setAttrib('required','required');
        
        $password=new Zend_Form_Element_Password('password');
        $password->class='span12';
        $password->setRequired(true);
        $password->addValidator('regex',false,array('/^[A-Za-z\!\#\@\$\d]{5,}$/'));
        $password->setAttrib('placeholder','My secret password');
        $password->setAttrib('pattern','[A-Za-z\!\#\@\$\d]{5,}');
        $password->setAttrib('required','required');
        
        $rePassword=new Zend_Form_Element_Password('rePassword');
        $rePassword->class='span12';
        $rePassword->setRequired(true);
        $rePassword->addValidator('regex',false,array('/^[A-Za-z\!\#\@\$\d]{5,}$/'));
        $rePassword->setAttrib('placeholder','Retype password');
        $rePassword->setAttrib('pattern','[A-Za-z\!\#\@\$\d]{5,}');
        $password->setAttrib('required','required');
        
        $element = new Zend_Form_Element_File('photo');
        $element->setLabel('Photo');
        $element->addValidator('Count', false, 1);
        $element->addValidator('Size', false, 102400);
        $element->addValidator('Extension', false, 'jpg,png,gif');
        
        #$rememberMe= '<label class="checkbox"><input type="checkbox">Subscribe for news feed</label>';
        
        $submit=new Zend_Form_Element_Submit('signup');
        $submit->setLabel('Sign up');
        $submit->class='btn btn-primary';

        $this->addElement($fullName);
        $this->addElement($username);
        $this->addElement($email);
        $this->addElement($password);
        $this->addElement($rePassword);
        //$this->addElement($element, 'foo');
        $this->addElement($submit);
        
        $this->setElementDecorators(array(
            'ViewHelper',
            array(array('data'=>'HtmlTag'),array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
        ));
        $this->setDecorators(array('FormElements',
            array('HtmlTag',array('tag'=>'table')),'Form'
            ));
    }


}

