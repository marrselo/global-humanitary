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
       $objBanner = new Application_Model_Banner();
       $orden = $objBanner->getOrden();
       
       $form  = new Application_Form_AdminBannerForm();
       $form->setDecorators(array(array('ViewScript',
            array('viewScript'=>'forms/_formBanner.phtml'))));
      
      if ($this->_request->isPost()){
        $params = $this->_getAllParams();
         if($form->isValid($params)){             
             $filter = new Core_Utils_SeoUrl(); 
             $extn = pathinfo($form->imagen->getFileName(),PATHINFO_EXTENSION);          
             $nameFile = $filter->filter(trim($params['titulo']),'-',0);
             $nameFile = $nameFile.'-'.date('Ymdhis');
             $dataBanner = array('banner_nombre'=>$nameFile,
                 'banner_img'=>$nameFile.$extn,
                 'banner_orden'=>$orden['banner_orden']+1);
             $objBanner->saveBanner($dataBanner);
             $form->imagen->addFilter('Rename',array('target' 
                  => $form->imagen->getDestination().'/'.$nameFile.$extn)); 
             $form->imagen->receive();
//             if($form->imagen->receive()){                                            
//             }else{
//                 Zend_Debug::dump($form->getMessages());
//                 exit();
//             }
          }        
        }    
        $this->view->banner = Application_Entity_Queries::getBanner($toAdmin=true);
        $this->view->form = $form;
    }
}

