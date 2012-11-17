<?php

class Default_IndexController extends Core_Controller_ActionDefault       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $this->view->noticias = Application_Entity_Queries::getUltimasNoticias(2);
        $this->view->banner = Application_Entity_Queries::getBanner();
        $this->view->proyectosHome = Application_Entity_Queries::getProyectosHome();
    } 
}

