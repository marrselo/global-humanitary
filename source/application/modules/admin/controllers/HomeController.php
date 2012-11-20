<?php

class Admin_HomeController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();
    }
    public function indexAction()
    {                   
        
    } 
    public function bannerAction()
    {
       //$this->_helper->layout()->disableLayout();      
       $this->view->banner = Application_Entity_Queries::getBanner();
       $form  = new Application_Form_AdminBannerForm();
       $form->setDecorators(array(array('ViewScript',
            array('viewScript'=>'forms/_formBanner.phtml'))));
      $this->view->form = $form;
      if ($this->_request->isPost()){
        $params = $this->_getAllParams();
         if($form->isValid($params)){
             Zend_Debug::dump($params);
             $filter = new Core_Utils_SeoUrl(); 
             $extn = pathinfo($form->imagen->getFileName(),PATHINFO_EXTENSION);             
             $nameFile = $filter->filter(trim($params['titulo']),'-',0);
            // $dataBanner = array()
             $form->imagen->addFilter('Rename',array('target' 
                  => $form->imagen->getDestination().'/'.$nameFile.$extn)); 
             $form->imagen->receive();
             if( $form->imagen->receive()){
                 echo "recibio CSM";
             
//             
//             if (!$adapter->receive()) {
//                $messages = $adapter->getMessages();
//                $code = 0;
//            }
//              $this->redimencionarBanner($form->imagen->getDestination().'/'.$nameFile.'-'.$idBanner.'.'.$extn);
//              $data = array('imagen'=>$nameFile.'-'.$idBanner.'.'.$extn);
//              $this->_banner->actualizarBanner($idBanner,$data);
//              $this->_redirect('/admin/admin-web');
              
             }else{
                 Zend_Debug::dump($form->getMessages());
                 exit();
             }
          }        
    }
    
}

