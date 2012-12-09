<?php

class Core_Controller_ActionAdmin extends Core_Controller_Action {
                    
    public function init() {
        $this->_helper->layout->setLayout('layout-admin');
        parent::init();
        
    }
    
    public function preDispatch()
    {
        $controller = $this->getRequest()->getControllerName();
        $action=$this->getRequest()->getActionName();                
        $this->view->menu=$this->getMenu($controller);
        $this->view->submenu=$this->getSubmenu($controller,$action);        
        $this->view->controller=$controller;
        $this->view->action=$action;
    }
    
    function getMenu($controller)
    {
        $menu = array(
            'imagenes'=>
             array('img'=>'/icons/mainnav/other.png','url'=>'/admin/imagenes',
                 'titulo'=>'Albúm Fotos'),
            'memorias'=>
            array('img'=>'/icons/mainnav/statistics.png','url'=>'/admin/memorias',
                'titulo'=>'Memorias'),
            'miembros'=>
            array('img'=>'/icons/mainnav/ui.png','url'=>'/admin/miembros',
                'titulo'=>'Miembros'),
           'quienes-somos'=>
            array('img'=>'/icons/mainnav/forms.png','url'=>'/admin/quienes-somos',
                'titulo'=>'Quienes Somos'),
            'home'=> 
            array('img'=>'/icons/mainnav/dashboard.png','url'=>'/admin/home',
                'titulo'=>'Home'),
            'videos'=>
            array('img'=>'/icons/mainnav/dashboard.png','url'=>'/admin/videos',
                'titulo'=>'Videos'),
            'wallpaper'=>
            array('img'=>'/icons/mainnav/tables.png','url'=>'/admin/wallpaper',
                'titulo'=>'Fondos Escritorio'),
            'unete'=>
            array('img'=>'/icons/mainnav/messages.png','url'=>'admin/unete',
                'titulo'=>'Únete')
            );
        $activeMenu = $menu[$controller];
        unset($menu[$controller]);              
        $elemento=array($controller=>$activeMenu);
        array_unshift($menu,$elemento);                
        return $menu;
    }
    
    public function getSubmenu($controller,$action)
    {
        $submenu=array();
        switch($controller){
            case 'home' :
                $submenu = array(
                    'banner'=>
                    array('url'=>'/admin/'.$controller.'/banner','titulo'=>'Banner'),
                    'projects'=>
                    array('url'=>'/admin/'.$controller.'/projects','titulo'=>'Proyectos'),
                    'notices'=>
                    array('url'=>'/admin/'.$controller.'/notices','titulo'=>'Noticias'),
                    'collaborates'=>
                    array('url'=>'/admin/'.$controller.'/collaborates','titulo'=>'Colabora')
                    );
                break;
            case 'miembros' :
                $submenu = array(
                    'index'=>
                    array('url'=>'/admin/'.$controller.'/','titulo'=>'Gestion de Miembros'));
                break;
            case 'memorias' :
                $submenu = array(
                    'index'=>
                    array('url'=>'/admin/'.$controller.'/','titulo'=>'Memorias'));
                break;
            case 'quienes-somos' :
                $submenu = array(
                    'index'=>
                    array('url'=>'/admin/'.$controller.'/','titulo'=>'Nosotros'),
                    'miembros'=>
                    array('url'=>'/admin/'.$controller.'/miembros','titulo'=>'Nuestro Equipo'));
                break;
            
            
        }
        if(isset($submenu[$action]) ){
            $submenuActive=$submenu[$action];
            $elemento=array($action=>$submenuActive);            
            unset($submenu[$action]);
            array_unshift($submenu,$elemento);
        }
        return $submenu;
    }            
}