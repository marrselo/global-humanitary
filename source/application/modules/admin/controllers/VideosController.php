<?php

class Admin_VideosController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $entityVideos = new Application_Entity_Videos();
        $this->view->listingVideos = $entityVideos->listVideos();
        $this->view->message = $this->_flashMessenger->getMessages();
    } 
    public function insertAction(){
        $form = new Application_Form_AdminVideosForm();
        $entityVideos = new Application_Entity_Videos();
        
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $filter = new Core_SeoUrl();
                $extensionImg = pathinfo($form->getElement('imagen')->getFileName(), PATHINFO_EXTENSION);
                $nameImg = mt_rand(10,999) . '_'. urlencode($filter->urlFriendly($form->getElement('titulo')->getValue(),'-'));
                $element = $form->getElement('imagen');
                $element->addFilter(
                        'Rename',
                        array(
                            'target' => 
                            $element->getDestination() .'/'. $nameImg.'.'.$extensionImg
                            )
                        );
                $element->receive();
                
                $extension = pathinfo($form->getElement('file')->getFileName(), PATHINFO_EXTENSION);
                $file = mt_rand(10,999) . '_'. urlencode($filter->urlFriendly($form->getElement('titulo')->getValue(),'-'));
                $element = $form->getElement('file');
                $element->addFilter(
                        'Rename',
                        array(
                            'target' => 
                            $element->getDestination() .'/'. $file.'.'.$extension 
                            )
                        );
                $element->receive();
                
                $data['_imagen'] = $nameImg.'.'.$extensionImg;
                $data['_titulo'] = $form->getElement('titulo')->getValue();
                $data['_link'] = $file.'.'.$extension ;
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityVideos->setProperties($data);
                $entityVideos->insertVideos();
                $this->_flashMessenger->addMessage('el registro se efecto correctamente');
                $this->_redirect('/admin/videos');
            }
        }
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    public function editAction(){
        $form = new Application_Form_AdminVideosForm();
        $entityVideos = new Application_Entity_Videos();
        $entityVideos->identifiEntity($this->_getParam('id'));
        $this->view->img = $entityVideos->getPropertie('_imagen');
        $values['nombre'] = $entityVideos->getPropertie('_nombre');
        $values['titulo'] = $entityVideos->getPropertie('_titulo');
        $values['descripcion'] = $entityVideos->getPropertie('_descripcion');
        $values['publico'] = $entityVideos->getPropertie('_publico');
        $form->populate($values);
        $form->getElement('imagen')->setRequired(false);
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                
                $data['_nombre'] = $form->getElement('nombre')->getValue();
                $data['_imagen'] = $form->getElement('imagen')->getValue();
                $data['_titulo'] = $form->getElement('titulo')->getValue();
                $data['_descripcion'] = $form->getElement('descripcion')->getValue();
                $data['_publico'] = $form->getElement('publico')->getValue();
                $entityVideos->setProperties($data);
                $entityVideos->updateVideos();
                $this->_flashMessenger->addMessage('el registro se actualizo correctamente');
                $this->_redirect('/admin/videos');
            }
        }
        
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    }
    function despublicarAction(){
        $entityVideos = new Application_Entity_Videos();
        $entityVideos->identifiEntity($this->_getParam('id'));
        $entityVideos->unpublicVideo();
        $this->_redirect('/admin/videos');
    }
    function publicarAction(){
        $entityVideos = new Application_Entity_Videos();
        $entityVideos->identifiEntity($this->_getParam('id'));
        $entityVideos->publicVideo();
        $this->_redirect('/admin/videos');
    }
    function uporderAction(){
        $entityVideos = new Application_Entity_Videos();
        $entityVideos->identifiEntity($this->_getParam('id'));
        $entityVideos->upOrder();
        $this->_redirect('/admin/videos');
    }
    function lowerorderAction(){
        $entityVideos = new Application_Entity_Videos();
        $entityVideos->identifiEntity($this->_getParam('id'));
        $entityVideos->lowerOrder();
        $this->_redirect('/admin/videos');
    }
    
    
}

