<?php


class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initView()
    {
        
        
        $this->bootstrap('layout');        
        $layout = $this->getResource('layout');
        //Zend_Debug::dump($layout);exit;
        $v = $layout->getView();
        
        //Zend_Debug::dump($v);exit;
        $v->addHelperPath('Core/View/Helper', 'Core_View_Helper');
        //Zend_Debug::dump($v);exit;
        $config = Zend_Registry::get('config');
        //Zend_Debug::dump($config['app']); exit;
        
        //Definiendo Constante para Partials
        defined('STATIC_URL')
            || define('STATIC_URL', $config['app']['staticUrl']);
        defined('IMG_URL')
            || define('IMG_URL', $config['app']['imgUrl']);
        defined('SITE_URL')
            || define('SITE_URL', $config['app']['siteUrl']);
        defined('SITE_TEMP')
            || define('SITE_TEMP',$config['app']['elementTemp']);
                
        $doctypeHelper = new Zend_View_Helper_Doctype();                
        $doctypeHelper->doctype(Zend_View_Helper_Doctype::XHTML1_STRICT);
        $v->headTitle($config['resources']['view']['title'])->setSeparator(' | ');
        $v->headMeta()->appendHttpEquiv('Content-Type',
            'text/html; charset=utf-8');
        $v->headMeta()->appendName("author", "Global Humanitary");
        $v->headMeta()->setName("language", "es");
        $v->headMeta()->appendName("description",
            "Ayuda a los mas necesitados");
        $v->headMeta()->appendName("keywords",
            "ayuda.");        
        $v->headLink()->appendStylesheet($v->S('/css/estilo.css'));
        $v->headLink()->appendStylesheet($v->S(
                '/css/ie7.css', 'screen', 'lt IE 8'
            )
        );
//        $v->headLink(array(
//            'rel' => 'shortcut icon', 'href' => $v->S('/imagenes/favicon.ico')
//            )
//        );
        $v->headScript()->appendFile($v->S('/js/jquery-1.8.2.min.js'));
        $v->headScript()->appendFile($v->S('/js/jquery.cycle.all.js'));
        $js = sprintf("var urls = {siteUrl : '%s'}", $config['app']['siteUrl']);
        $v->headScript()->appendScript($js);
        $v->headLink()->appendAlternate($v->S('/humans.txt'), 'text/plain',
            'author', '');        
    }

    public function _initRegistries()
    {        
        //$config = Zend_Registry::get('config');
       /// Zend_Debug::dump($config); exit;
        
//        $this->_executeResource('cachemanager');        
//        $cacheManager = $this->getResource('cachemanager');
//        Zend_Debug::dump($cacheManager); exit;
//        $a = $cacheManager->getCache($config['app']['cache']);
//        Zend_Debug::dump($a); exit;
//        Zend_Registry::set('cache',
//            $cacheManager->getCache(
//                $config['app']['cache']
//            )
//        );
        
        $multidb = $this->getPluginResource('multidb');
        Zend_Registry::set('multidb', $multidb);
       // Zend_Debug::dump($multidb); exit;

//        $this->_executeResource('log');
//        $log = $this->getResource('log');
//        Zend_Registry::set('log', $log);
    }

    public function _initActionHelpers()
    {
//        Zend_Controller_Action_HelperBroker::addHelper(
//            new App_Controller_Action_Helper_Auth()
//        );
//        Zend_Controller_Action_HelperBroker::addHelper(
//            new App_Controller_Action_Helper_Security()
//        );
        Zend_Controller_Action_HelperBroker::addHelper(
            new Core_Controller_Action_Helper_Mail()
        );
        
    }

    public function _initTranslate()
    {
        $translator = new Zend_Translate(
                Zend_Translate::AN_ARRAY,
                APPLICATION_PATH . '/configs/languages/',
                'es',
                array('scan' => Zend_Translate::LOCALE_DIRECTORY)
        );
        
        Zend_Validate_Abstract::setDefaultTranslator($translator);        
    }

//    protected function _initZFDebug()
//    {
//        if ('local' == APPLICATION_ENV) {
//            $options = array('plugins' => array(
//                    'Variables',
//                    'File' => array('base_path' => APPLICATION_PATH),
//                    'Memory',
//                    'Time',
//                    'Registry',
//                    'Exception'
//                ));
//
//            if ($this->hasPluginResource('multidb')) {
//                $this->bootstrap('multidb');
//                $db = $this->bootstrap('multidb')->
//                        getResource('multidb')->getDb('globalhumanitariaperu');
//                $options['plugins']['Database']['adapter'] = $db;
//            }
//
//            if ($this->hasPluginResource('cache')) {
//                $this->bootstrap('cache');
//                $cache = $this - getPluginResource('cache')->getDbAdapter();
//                $options['plugins']['Cache']['backend'] = $cache->getBackend();
//            }
//
//            $debug = new ZFDebug_Controller_Plugin_Debug($options);
//
//            $this->bootstrap('frontController');
//            $frontController = $this->getResource('frontController');
//            $frontController->registerPlugin($debug);
//        }
//    }

}

