<?php

class Core_Controller_ActionAdmin extends Core_Controller_Action {
    
    protected $_submenu;
    
    
    
    public function init() {
        $this->_helper->layout->setLayout('layout-admin');
        parent::init();
        
    }
    
    public function preDispatch()
    {
        $controller = $this->getRequest()->getControllerName();
        
        $menu=$this->getMenu();
        unset($menu[$controller]);          
        switch ($controller){
            case 'imagenes' : 
                $items = array('img'=>'/icons/mainnav/other.png',
                    'url'=>'/admin/imagenes','titulo'=>'Albúm Fotos');
                break;
            case 'memorias' :
                $items=array('img'=>'/icons/mainnav/statistics.png',
                    'url'=>'/admin/memorias','titulo'=>'Memorias');
                break;
            case 'miembros' :
                $items=array('img'=>'/icons/mainnav/ui.png','url'=>'/admin/miembros',
                    'titulo'=>'Miembros');
                break;
            case 'nosotros' : 
                $items= array('img'=>'/icons/mainnav/forms.png','url'=>'/admin/nosotros',
                'titulo'=>'Nosotros');
                break;
            case 'home' :
                $items=array('img'=>'/icons/mainnav/dashboard.png','url'=>'/admin/home',
                'titulo'=>'Home');
                break;
            case 'videos' :
                $items=array('img'=>'/icons/mainnav/dashboard.png','url'=>'/admin/videos',
                'titulo'=>'Videos');
                break;
            case 'wallpaper' :
                $items=array('img'=>'/icons/mainnav/tables.png','url'=>'/admin/wallpaper',
                'titulo'=>'Fondos Escritorio');
                break;
            case 'unete' :
                $items=array('img'=>'/icons/mainnav/messages.png','url'=>'admin/unete',
                'titulo'=>'Únete');
                break;
            default:
                $this->_redirect('/');
        }       
        $elemento=array($controller=>$items);
        array_unshift($menu,$elemento);
        $this->view->menu=$menu;
    }
    function getMenu()
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
           'nosotros'=>
            array('img'=>'/icons/mainnav/forms.png','url'=>'/admin/nosotros',
                'titulo'=>'Nosotros'),
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
        return $menu;
    }
}