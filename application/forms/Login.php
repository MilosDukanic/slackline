<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setAction('/Authorization/login')->setMethod('post');
        $this->setAttrib('class','dialog-form');
        $this->setAttrib('name','loginForm');

        $username=new Zend_Form_Element_Text('email');
        $username->class='span12';
        $username->setRequired(true);
        $username->addValidator('EmailAddress');
        $username->setAttrib('placeholder','email@domain.com');
        $username->setAttrib('pattern','[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})');
        $username->setAttrib('required','required');
        
        $password=new Zend_Form_Element_Password('password');
        $password->class='span12';
        $password->setRequired(true);
        $password->addValidator('regex',false,array('/^[A-Za-z\!\#\@\$\d]{5,}$/'));
        $password->setAttrib('placeholder','My secret password');
        $password->setAttrib('pattern','[A-Za-z\!\#\@\$\d]{5,}');
        $password->setAttrib('required','required');
        
        $rememberMe = new Zend_Form_Element_Checkbox('remember_me');
        $rememberMe->setDecorators(array(
           array('ViewHelper'),
           array('Errors', array('tag' => 'div', 'class' => 'error')),
           array('Label', array('tag' => 'label')),
           array('HtmlTag', array('tag' => 'div', 'class' => 'checkbox')),
        ));

        #$rememberMe= '<label class="checkbox"><input type="checkbox">Remember me</label>';
        
        $submit=new Zend_Form_Element_Submit('login');
        $submit->setLabel('Sign in');
        $submit->class='btn btn-primary';

        $this->addElement($username);
        $this->addElement($password);
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

