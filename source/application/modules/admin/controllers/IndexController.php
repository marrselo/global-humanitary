<?php

class Admin_IndexController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        
        $this->view->banner = Application_Entity_Queries::getBanner();               
<<<<<<< HEAD
         
         
=======
>>>>>>> fd4d8d8f3a787879364ca0ed18b237db1d6f43ac
    } 
    public function deleteAction()
    {
        
    }
    
}

