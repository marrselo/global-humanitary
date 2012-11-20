<?php

class Admin_HomeController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {                   
        
    } 
    public function bannerAction()
    {
       //$this->_helper->layout()->disableLayout();      
       $this->view->banner = Application_Entity_Queries::getBanner();
       $form  = new Application_Form_AdminBannerForm();
       $form->setDecorators(array(array('ViewScript',
            array('viewScript'=>'forms/_formBanner.phtml'))));
      $this->view->form = $form;  
       
    }
    
}

