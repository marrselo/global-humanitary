<?php

class Core_Controller_Action extends Zend_Controller_Action {

    /**
     *
     * @var Zend_Form_Element_Hash
     */
    protected $_hash = null;
    
    /**
     *
     * @var App_Controller_Action_Helper_FlashMessengerCustom
     */
    protected $_flashMessenger;

    public function init() {
        // $this->_session = new Zend_Session_Namespace('sessionGeneral');
        $this->_flashMessenger = new Core_Controller_Action_Helper_FlashMessengerCustom();
        $this->_layout = Zend_Layout::getMvcInstance();
        parent::init();
    
    }

    /**
     * Pre-dispatch routines
     * Asignar variables de entorno
     *
     * @return void
     */
    public function preDispatch() {
        parent::preDispatch();
        
        $config = $this->getConfig();
        
        $this->config = $this->getConfig();
        //Zend_Debug::dump($this->config);exit;
        //$this->log = $this->getLog();
        
        //$this->cache = $this->getCache();
        $this->siteUrl = $this->config['app']['siteUrl'];
        
        $this->view->assign('siteUrl', $config['app']['siteUrl']);       
       
/*
        if (APPLICATION_ENV != 'production') {
            $sep = sprintf('[%s]', strtoupper(substr(APPLICATION_ENV, 0, 3)));
            $titleStack = $this->view->headTitle()->getContainer()->getValue();
            if (!is_array($titleStack) || (is_array($titleStack) && isset($titleStack[0]) && $titleStack[0] != $sep) ){
                $this->view->headTitle()->prepend($sep);
            }
        }*/
    }
    
    /**
     * Post-dispatch routines
     * Asignar variables de entorno
     *
     * @return void
     */
    public function postDispatch() {
        parent::postDispatch();
        
//        if (APPLICATION_ENV != 'production') {
//            $sep = sprintf('[%s]', strtoupper(substr(APPLICATION_ENV, 0, 3)));
//            $titleStack = $this->view->headTitle()->getContainer()->getValue();
//            if (!is_array($titleStack) || (is_array($titleStack) && isset($titleStack[0]) && $titleStack[0] != $sep) ){
//                $this->view->headTitle()->prepend($sep);
//            }
//        }
        
    }


    /**
     * Retorna la instancia personalizada de FlashMessenger
     * Forma de uso:
     * $this->getMessenger()->info('Mensaje de información');
     * $this->getMessenger()->success('Mensaje de información');
     * $this->getMessenger()->error('Mensaje de información');
     *
     * @return App_Controller_Action_Helper_FlashMessengerCustom
     */
    public function getMessenger() {
        return $this->_flashMessenger;
    }
    /**
     *
     * @see Zend/Controller/Zend_Controller_Action::getRequest()
     * @return Zend_Controller_Request_Http
     */
    public function getRequest() {
        return parent::getRequest();
    }

    /**
     * Retorna un objeto Zend_Config con los parámetros de la aplicación
     *
     * @return Zend_Config
     */
    public function getConfig() {
        return Zend_Registry::get('config');
    }

    /**
     * Retorna el objeto cache de la aplicación
     *
     * @return Zend_Cache_Core
     */
    public function getCache() {
        return Zend_Registry::get('cache');
    }

    /**
     * Retorna el adaptador
     *
     * @return Zend_Db_Adapter_Abstract
     */
    public function getAdapter() {
        return Zend_Registry::get('db');
    }

    /**
     * Retorna el objeto Zend_Log de la aplicación
     *
     * @return Zend_Log
     */
    public function getLog() {
        return Zend_Registry::get('log');
    }

    public function getSession() {
        $session = new Zend_Session_Namespace();
        return $session;
    }
    
    public function __call($methodName, $args) {
        $this->_forward('error404');
    }
        
   

}