<?php

class Default_IndexController extends Core_Controller_Action       
{
    public function indexAction()
    {           
       
       $params = $this->_getAllParams();
       Zend_Debug::dump($params); 
       
   } 
}

