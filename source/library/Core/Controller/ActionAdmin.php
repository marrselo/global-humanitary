<?php

class Core_Controller_ActionAdmin extends Core_Controller_Action {
                    
    protected $_identity;
    public function init() {
        parent::init();
        $this->_helper->layout->setLayout('layout-admin');        
    }
    
    public function preDispatch()
    {        
        $this->_identity = Zend_Auth::getInstance()->getIdentity();
        
        $controller = $this->getRequest()->getControllerName();        
        $action=$this->getRequest()->getActionName();                
        $this->view->menu=$this->getMenu($controller);
        $this->view->submenu=$this->getSubmenu($controller,$action);        
        $this->view->controller=$controller;
        $this->view->action=$action;        
        $this->permisos();
    }
    function permisos()
    {
        $auth = Zend_Auth::getInstance();
        $controller=$this->_request->getControllerName();
        if ($auth->hasIdentity()) {        
            
        }else{
            if ($controller!='index') {
            $this->_redirect('/admin');
            }
        }
        
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
            'newsroom'=>
            array('img'=>'/icons/mainnav/ui.png','url'=>'/admin/newsroom',
                'titulo'=>'Sala de Prensa'),
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
        if(isset($menu[$controller])){
            $activeMenu = $menu[$controller];
            unset($menu[$controller]);              
            $elemento=array($controller=>$activeMenu);            
            array_unshift($menu,$elemento);                
        }
        
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
                    array('url'=>'/admin/'.$controller.'/miembros','titulo'=>'Nuestro Equipo')
                    );
                if($action=='edit'){                    
                    $submenu['edit'] =
                    array('url'=>'/admin/'.$controller.'/miembros','titulo'=>'Editar Miembro Equipo')
                    ;
                }
                if($action=='insert'){                    
                    $submenu['insert'] =
                    array('url'=>'/admin/'.$controller.'/miembros','titulo'=>'Nuevo Miembro Equipo')
                    ;
                }                   
                break;
            case 'newsroom' :
                $submenu = array(
                    'notices'=>
                    array('url'=>'/admin/'.$controller.'/noticias','titulo'=>'Noticias'));
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
    public function auth($usuario,$password)
    {
                  
            $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
            $authAdapter
                ->setTableName('user_admin')
                ->setIdentityColumn('user_admin_user')
                ->setCredentialColumn('user_admin_password')
                ->setIdentity($usuario)
                ->setCredential($password);
            $select = $authAdapter->getDbSelect();
            $select->where('user_admin_activo = 1');             
            $result = Zend_Auth::getInstance()->authenticate($authAdapter);
            if ($result->isValid()) {                
                $storage = Zend_Auth::getInstance()->getStorage();
                $bddResultRow = $authAdapter->getResultRowObject();
                $storage->write($bddResultRow);
                $msj = 'Bienvenido Usuario '.$result->getIdentity();
                $this->_flashMessenger->success($msj);
                $this->_identity = Zend_Auth::getInstance()->getIdentity();                
                $return = true;
            } else {
                switch ($result->getCode()) {
                    case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                        $msj = 'El usuario no existe';
                        break;
                    case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                        $msj = 'Password incorrecto';
                        break;
                    default:
                        $msj='Datos incorrectos';
                        break;
                }
               $this->_flashMessenger->warning($msj);
                $return = false;
            }
             
             return $return;
    }
}