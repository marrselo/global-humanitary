<?php

class Admin_NewsroomController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {
        $this->_redirect('/admin/newsroom/notices');
    }
    public function noticesAction()
    {           
        $objProjects = new Application_Model_Proyectos();
        $this->view->listprojects=$objProjects->listaProyectos();
    } 
    
    public function miembrosAction()
    {
        $entityMiembros = new Application_Entity_Miembros();
        $this->view->listingMiembros = $entityMiembros->listMiembros();
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    public function insertAction(){
        $form = new Application_Form_AdminMiembrosForm();
        $entityMiembros = new Application_Entity_Miembros();
        
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $form->getElement('imagen')->getValue();
                $data['_apellidos'] = $form->getElement('apellidos')->getValue();
                $data['_cargo'] = $form->getElement('cargo')->getValue();
                $data['_apellidos'] = $form->getElement('apellidos')->getValue();
                $data['_resumen'] = $form->getElement('resumen')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityMiembros->setProperties($data);
                $entityMiembros->insertNosotros();
                $this->_flashMessenger->success('el registro se efecto correctamente');
                $this->_redirect('/admin/quienes-somos/miembros');
            }
        }
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    public function editAction(){
        $form = new Application_Form_AdminMiembrosForm();
        $entityMiembros = new Application_Entity_Miembros();
        $entityMiembros->identifiEntity($this->_getParam('id'));
        $this->view->img = $entityMiembros->getPropertie('_imagen');
        $values['nombre'] = $entityMiembros->getPropertie('_nombre');
        $values['apellidos'] = $entityMiembros->getPropertie('_apellidos');
        $values['cargo'] = $entityMiembros->getPropertie('_cargo');
        $values['resumen'] = $entityMiembros->getPropertie('_resumen');
        $values['publico'] = $entityMiembros->getPropertie('_publico');
        $form->populate($values);
        $form->getElement('imagen')->setRequired(false);
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $form->getElement('imagen')->getValue();
                $data['_apellidos'] = $form->getElement('apellidos')->getValue();
                $data['_cargo'] = $form->getElement('cargo')->getValue();
                $data['_resumen'] = $form->getElement('resumen')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityMiembros->setProperties($data);
                $entityMiembros->updateMiembros();
                $this->_flashMessenger->addMessage('el registro se actualizo correctamente');
                $this->_redirect('/admin/quienes-somos/miembros');
            }
        }        
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    function despublicarAction(){
        $entityMiembros = new Application_Entity_Miembros();
        $entityMiembros->identifiEntity($this->_getParam('id'));
        $entityMiembros->unpublicMiembro();
        $this->_redirect('/admin/miembros');
    }
    function publicarAction(){
        $entityMiembros = new Application_Entity_Miembros();
        $entityMiembros->identifiEntity($this->_getParam('id'));
        $entityMiembros->publicMiembro();
        $this->_redirect('/admin/miembros');
    }
    function uporderAction(){
        $entityMiembros = new Application_Entity_Miembros();
        $entityMiembros->identifiEntity($this->_getParam('id'));
        $entityMiembros->upOrder();
        $this->_redirect('/admin/miembros');
    }
    function lowerorderAction(){
        $entityMiembros = new Application_Entity_Miembros();
        $entityMiembros->identifiEntity($this->_getParam('id'));
        $entityMiembros->lowerOrder();
        $this->_redirect('/admin/miembros');
    }
    
}

