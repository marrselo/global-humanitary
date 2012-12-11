<?php

class Admin_NosotrosController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();        
    }
    public function indexAction()
    {           
        $form = new Application_Form_NosotrosForm();
        $entityNosotros = new  Application_Entity_Nosotros();
        
        if($this->_request->isPost()){
            if($form->isValid($this->getAllParams())){
                $data['_tituloNosotros'] = $form->getElement('tituloNosotros')->getValue();
                $data['_descripcionNosotros'] = $form->getElement('descripcionNosotros')->getValue();
                $entityNosotros->setProperties($data);
                $entityNosotros->insertNosotros();
                $this->_flashMessenger->addMessage('el registro se efecto correctamente');
                $this->_redirect('/admin/nosotros');
            }
        }
        $nosotrosValue = $entityNosotros->getNosotros();
        $form->getElement('tituloNosotros')->setValue($nosotrosValue['nosotros_titulo']);
        $form->getElement('descripcionNosotros')->setValue($nosotrosValue['nosotros_descripcion']);
        $this->view->form = $form;
        $this->view->message = $this->_flashMessenger->getMessages();
    } 
    
    
}

