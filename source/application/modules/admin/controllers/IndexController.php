<?php

class Admin_IndexController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        
        $this->view->banner = Application_Entity_Queries::getBanner();               
    } 
    
}

