<?php

class Admin_IndexController extends Core_Controller_Action       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        
//        $this->view->noticias = Application_Entity_Queries::getUltimasNoticias(2);
//        $this->view->banner = Application_Entity_Queries::getBanner();
//        $this->view->proyectosHome = Application_Entity_Queries::getProyectosHome();
        
         $this->_helper->layout->setLayout('layout-admin');

    } 
}

