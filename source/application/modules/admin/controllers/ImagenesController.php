<?php

class Admin_ImagenesController extends Core_Controller_ActionAdmin {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        $entityImagenes = new Application_Entity_Imagenes();
        $this->view->listingImagenes = $entityImagenes->listImagenes();
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    public function insertAction() {
        $form = new Application_Form_AdminImagenesForm();
        $entityImagenes = new Application_Entity_Imagenes();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                $filter = new Core_SeoUrl();
                $extension = pathinfo($form->getElement('imagen')->getFileName(), PATHINFO_EXTENSION);
                $nameImg = mt_rand(10, 999) . '_' . urlencode($filter->urlFriendly($form->getElement('nombre')->getValue(), '-'));
                $element = $form->getElement('imagen');
                $element->addFilter(
                        'Rename', array(
                    'target' =>
                    $element->getDestination() . '/' . $nameImg . '.' . $extension
                        )
                );
                $element->receive();


                $data['_imagen'] = $nameImg . '.' . $extension;
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityImagenes->setProperties($data);
                $entityImagenes->insertImagenes();
                $this->_flashMessenger->addMessage('el registro se efecto correctamente');
                $this->_redirect('/admin/imagenes');
            }
        }
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    public function editAction() {
        $form = new Application_Form_AdminImagenesForm();
        $entityImagenes = new Application_Entity_Imagenes();
        $entityImagenes->identifiEntity($this->_getParam('id'));
        $this->view->img = $entityImagenes->getPropertie('_imagen');
        $values['nombre'] = $entityImagenes->getPropertie('_nombre');
        $values['titulo'] = $entityImagenes->getPropertie('_titulo');
        $values['descripcion'] = $entityImagenes->getPropertie('_descripcion');
        $values['publico'] = $entityImagenes->getPropertie('_publico');
        $form->populate($values);
        $form->getElement('imagen')->setRequired(false);
        if ($this->_request->isPost()) {
            if ($form->isValid($this->getAllParams())) {
                 $filter = new Core_SeoUrl();
                $extension = pathinfo($form->getElement('imagen')->getFileName(), PATHINFO_EXTENSION);
                $nameImg = mt_rand(10, 999) . '_' . urlencode($filter->urlFriendly($form->getElement('nombre')->getValue(), '-'));
                $element = $form->getElement('imagen');
                $element->addFilter(
                        'Rename', array(
                    'target' =>
                    $element->getDestination() . '/' . $nameImg . '.' . $extension
                        )
                );
                $element->receive();
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $extension==''?'':($nameImg . '.' . $extension);
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityImagenes->setProperties($data);
                $entityImagenes->updateImagenes();
                $this->_flashMessenger->addMessage('el registro se actualizo correctamente');
                $this->_redirect('/admin/imagenes');
            }
        }

        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    function despublicarAction() {
        $entityImagenes = new Application_Entity_Imagenes();
        $entityImagenes->identifiEntity($this->_getParam('id'));
        $entityImagenes->unpublicVideo();
        $this->_redirect('/admin/imagenes');
    }

    function publicarAction() {
        $entityImagenes = new Application_Entity_Imagenes();
        $entityImagenes->identifiEntity($this->_getParam('id'));
        $entityImagenes->publicVideo();
        $this->_redirect('/admin/imagenes');
    }

    function uporderAction() {
        $entityImagenes = new Application_Entity_Imagenes();
        $entityImagenes->identifiEntity($this->_getParam('id'));
        $entityImagenes->upOrder();
        $this->_redirect('/admin/imagenes');
    }

    function lowerorderAction() {
        $entityImagenes = new Application_Entity_Imagenes();
        $entityImagenes->identifiEntity($this->_getParam('id'));
        $entityImagenes->lowerOrder();
        $this->_redirect('/admin/imagenes');
    }

}

