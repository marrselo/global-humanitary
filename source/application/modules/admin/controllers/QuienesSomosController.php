<?php

class Admin_QuienesSomosController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {           
        $form = new Application_Form_NosotrosForm();
        $entityNosotros = new  Application_Entity_Nosotros();        
        if($this->_request->isPost()){
            $modelNosotros = new Application_Model_Nosotros();
            if($form->isValid($this->getAllParams())){                
                $data['nosotros_titulo'] = $form->getElement('tituloNosotros')->getValue();
                $data['nosotros_descripcion'] = $form->getElement('descripcionNosotros')->getValue();
                $idNosotros = $form->getElement('idNosotros')->getValue();                
                $modelNosotros->updateNosotros($idNosotros,$data);
                $this->_flashMessenger->success('Actualización exitosa');            
                $this->_redirect('/admin/quienes-somos');
            }
        }
        $nosotrosValue = $entityNosotros->getNosotros();
        $form->getElement('tituloNosotros')->setValue($nosotrosValue['nosotros_titulo']);
        $form->getElement('descripcionNosotros')->setValue($nosotrosValue['nosotros_descripcion']);
        $form->getElement('idNosotros')->setValue($nosotrosValue['nosotros_id']);        
        $form->setDecorators(array(array('ViewScript',array('viewScript'=>'forms/_formNosotros.phtml'))));
        $this->view->form = $form;                
    } 
    
    public function nuestroEquipoAction()
    {
        
    }
    
    
}

