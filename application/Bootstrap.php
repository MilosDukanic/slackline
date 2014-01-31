<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initPlaceholders(){
        $this->bootstrap('view');
        $view= $this->getResource('view');
        $view->headTitle('SlackLife SRB')->setSeparator(' - ');
    }
    protected function _initMenu(){
        $this->bootstrap('view');
        $view=  $this->getResource('view');
        $view->placeholder('menu')->setPrefix("<nav><ul class='nav nav-pills flexnav' id='flexnav' data-breakpoint='800'>")->setPostfix("</ul></nav>");
    }
}

