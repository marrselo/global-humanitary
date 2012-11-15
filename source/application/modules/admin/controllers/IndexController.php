<?php

class Admin_IndexController extends Core_Controller_Action       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $this->_helper->layout->setLayout('layout-admin');
        $this->view->banner = Application_Entity_Queries::getBanner();               
         
         
    } 
    public function deleteAction()
    {
        
    }
    
}

