<?php

class Admin_WallpaperController extends Core_Controller_ActionAdmin {

    public function init() {
        parent::init();
         if(!isset($this->session->_identity)) $this->_redirect ('/admin');
    }

    public function indexAction() {
        $entityWallpaper = new Application_Entity_Wallpaper();
        $this->view->listingWallpaper = $entityWallpaper->listWallpaper();
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    public function insertAction() {
        $form = new Application_Form_AdminWallpaperForm();
        $entityWallpaper = new Application_Entity_Wallpaper();

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
                $entityWallpaper->setProperties($data);
                $entityWallpaper->insertWallpaper();
                $this->_flashMessenger->addMessage('el registro se efecto correctamente');
                $this->_redirect('/admin/wallpaper');
            }
        }
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    public function editAction() {
        $form = new Application_Form_AdminWallpaperForm();
        $entityWallpaper = new Application_Entity_Wallpaper();
        $entityWallpaper->identifiEntity($this->_getParam('id'));
        $this->view->img = $entityWallpaper->getPropertie('_imagen');
        $values['nombre'] = $entityWallpaper->getPropertie('_nombre');
        $values['titulo'] = $entityWallpaper->getPropertie('_titulo');
        $values['descripcion'] = $entityWallpaper->getPropertie('_descripcion');
        $values['publico'] = $entityWallpaper->getPropertie('_publico');
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
                $entityWallpaper->setProperties($data);
                $entityWallpaper->updateWallpaper();
                $this->_flashMessenger->addMessage('el registro se actualizo correctamente');
                $this->_redirect('/admin/wallpaper');
            }
        }

        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }

    function despublicarAction() {
        $entityWallpaper = new Application_Entity_Wallpaper();
        $entityWallpaper->identifiEntity($this->_getParam('id'));
        $entityWallpaper->unpublicVideo();
        $this->_redirect('/admin/wallpaper');
    }

    function publicarAction() {
        $entityWallpaper = new Application_Entity_Wallpaper();
        $entityWallpaper->identifiEntity($this->_getParam('id'));
        $entityWallpaper->publicVideo();
        $this->_redirect('/admin/wallpaper');
    }

    function uporderAction() {
        $entityWallpaper = new Application_Entity_Wallpaper();
        $entityWallpaper->identifiEntity($this->_getParam('id'));
        $entityWallpaper->upOrder();
        $this->_redirect('/admin/wallpaper');
    }

    function lowerorderAction() {
        $entityWallpaper = new Application_Entity_Wallpaper();
        $entityWallpaper->identifiEntity($this->_getParam('id'));
        $entityWallpaper->lowerOrder();
        $this->_redirect('/admin/wallpaper');
    }

}

