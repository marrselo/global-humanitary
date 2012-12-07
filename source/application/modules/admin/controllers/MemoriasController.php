<?php

class Admin_MemoriasController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $entityMemorias = new Application_Entity_Memorias();
        $this->view->listingMemorias = $entityMemorias->listMemorias();
        $this->view->message = $this->_flashMessenger->getMessages();
    } 
    public function insertAction(){
        $form = new Application_Form_AdminMemoriasForm();
        $entityMemorias = new Application_Entity_Memorias();
        
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $form->getElement('imagen')->getValue();
                $data['_titulo'] = $form->getElement('titulo')->getValue();
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityMemorias->setProperties($data);
                $entityMemorias->insertMemorias();
                $this->_flashMessenger->addMessage('el registro se efecto correctamente');
                $this->_redirect('/admin/memorias');
            }
        }
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    public function editAction(){
        $form = new Application_Form_AdminMemoriasForm();
        $entityMemorias = new Application_Entity_Memorias();
        $entityMemorias->identifiEntity($this->_getParam('id'));
        $this->view->img = $entityMemorias->getPropertie('_imagen');
        $values['nombre'] = $entityMemorias->getPropertie('_nombre');
        $values['titulo'] = $entityMemorias->getPropertie('_titulo');
        $values['descripcion'] = $entityMemorias->getPropertie('_descripcion');
        $values['publico'] = $entityMemorias->getPropertie('_publico');
        $form->populate($values);
        $form->getElement('imagen')->setRequired(false);
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $form->getElement('imagen')->getValue();
                $data['_titulo'] = $form->getElement('titulo')->getValue();
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityMemorias->setProperties($data);
                $entityMemorias->updateMemorias();
                $this->_flashMessenger->addMessage('el registro se actualizo correctamente');
                $this->_redirect('/admin/memorias');
            }
        }
        
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    function despublicarAction(){
        $entityMemorias = new Application_Entity_Memorias();
        $entityMemorias->identifiEntity($this->_getParam('id'));
        $entityMemorias->unpublicMemoria();
        $this->_redirect('/admin/memorias');
    }
    function publicarAction(){
        $entityMemorias = new Application_Entity_Memorias();
        $entityMemorias->identifiEntity($this->_getParam('id'));
        $entityMemorias->publicMemoria();
        $this->_redirect('/admin/memorias');
    }
    function uporderAction(){
        $entityMemorias = new Application_Entity_Memorias();
        $entityMemorias->identifiEntity($this->_getParam('id'));
        $entityMemorias->upOrder();
        $this->_redirect('/admin/memorias');
    }
    function lowerorderAction(){
        $entityMemorias = new Application_Entity_Memorias();
        $entityMemorias->identifiEntity($this->_getParam('id'));
        $entityMemorias->lowerOrder();
        $this->_redirect('/admin/memorias');
    }
    
    
}

