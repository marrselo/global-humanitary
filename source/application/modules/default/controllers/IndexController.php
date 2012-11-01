<?php

class Default_IndexController extends Core_Controller_Action       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $this->view->noticias = Application_Entity_Queries::getUltimasNoticias(2);
        $this->view->banner = Application_Entity_Queries::getBanner();
    } 
}

