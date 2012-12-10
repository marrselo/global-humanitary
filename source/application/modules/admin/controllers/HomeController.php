<?php

class Admin_HomeController extends Core_Controller_ActionAdmin       
{
    public function init() {
        parent::init();       
    }
    public function indexAction()
    {                   
        $this->_redirect('/admin/home/banner');
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
             $nameFile = $nameFile.'-'.date('mdis');
             $dataBanner = array('banner_nombre'=>$params['titulo'],
                 'banner_img'=>$nameFile.'.'.$extn,
                 'banner_orden'=>$orden['banner_orden']+1);
             $objBanner->saveBanner($dataBanner);
             $form->imagen->addFilter('Rename',array('target' 
                  => $form->imagen->getDestination().'/'.$nameFile.'.'.$extn)); 
             $form->imagen->receive();
//             if($form->imagen->receive()){                                            
//             }else{
//                 Zend_Debug::dump($form->getMessages());
//                 exit();
//             }
          }        
        }    
        
        $this->view->banner = $objBanner->listBannerAdmin();        
        $this->view->form = $form;
        
    }
    
    public function publishBannerAction()
    {        
        $idBanner = $this->_getParam('id',0);
        $objBanner= new Application_Model_Banner();
        
        if(empty($idBanner)){
            $this->_redirect('admin/home/banner');
        }
        $objBanner->publishBanner($idBanner);
        $this->_redirect('/admin/home/banner');        
    }
    
    public function unpublishBannerAction()
    {
        $idBanner = $this->_getParam('id',0);
        $objBanner= new Application_Model_Banner();
        
        if(empty($idBanner)){
            $this->_redirect('admin/home/banner');
        }
        $objBanner->unpublishBanner($idBanner);
        $this->_redirect('/admin/home/banner');        
    }
    
    public function deleteBannerAction(){
        $idBanner = $this->_getParam('id',0);
        $objBanner= new Application_Model_Banner();        
        if(empty($idBanner)){
            $this->_redirect('admin/home/banner');
        }
        $objBanner->deleteBanner($idBanner);
        $this->_redirect('/admin/home/banner');        
        
    }
    
    public function projectsAction()
    {
           
       $form=new Application_Form_AdminProyectoForm();
       $form->setDecorators(array(array('ViewScript',
            array('viewScript'=>'forms/_formProyectos.phtml'))));       
       if ($this->_request->isPost()){
           $params = $this->_getAllParams();
           if($form->isValid($params)){   
               try{                   
                   
                   $filter = new Core_Utils_SeoUrl(); 
                   $extn = pathinfo($form->imagen->getFileName(),PATHINFO_EXTENSION);          
                   $params['proyectos_slug'] = $filter->filter(trim($params['titulo']),'-',0);                   
                   $params['nameImagen']=$params['proyectos_slug'].'-'.date('s').'.'.$extn;  
                   $form->imagen->addFilter('Rename',array('target' 
                         => $form->imagen->getDestination().'/'.$params['nameImagen'])); 
                   $form->imagen->receive();
                    if($form->imagen->receive()){                                            
                    }else{
                        $this->_flashMessenger->error('La imagen ya existe, o es demasiado grande,
                             no se efectuo el registro');
                        $this->_redirect('/admin/home/projects');
                    }
                   Application_Entity_Proyectos::insertProyecto($params);
                   $this->_flashMessenger->success('el registro se efectuo correctamente');
                    $this->_redirect('/admin/home/projects');
               }catch(Exception $e){
                   $this->_flashMessenger->error('Ouch! Error inesperado intente de nuevo');
                   $this->_redirect('/admin/home/projects');
               }                              
           }else{
               $form->getMessages();
               $this->_flashMessenger->error('Error faltan datos');
               foreach($form->getMessages() as $value=> $index){
                   $msj=  each($index);
                   $this->_flashMessenger->warning(strtoupper($value).'=> '.$msj[1]);                
               }               
               $this->_redirect('/admin/home/projects');
           }
         
       }
       $this->view->form=$form;
       $this->view->listprojects=Application_Entity_Proyectos::listProjectHome();          
    }
    
    public function deleteProjectAction()
    {
        $idProject=$this->_getParam('id',0);
        try{
            Application_Entity_Proyectos::deleteProject($idProject);
            $this->_flashMessenger->success('Registro eliminado');
        }catch(Exception $e){
            $this->_flashMessenger->error('Ouch! ocurrio un problema intentelo de nuevo');
        }
        $this->_redirect('/admin/home/projects');
    }
    public function publishHomeProjectAction()
    {
        $idProject=$this->_getParam('id',0);
        $result=Application_Entity_Proyectos::publishProjectHome($idProject);
        if($result){$msj='Proyecto publicado en el home';}
        else{$msj='Ya tiene 4 proyectos publicados, elimine 1 e intente de nuevo';}
        $this->_flashMessenger->success();
        $this->_redirect('/admin/home/projects');
        
        
    }
    public function unpublishHomeProjectAction(){
        $idProject=$this->_getParam('id',0);
        Application_Entity_Proyectos::unpublishProjectHome($idProject);
        $this->_flashMessenger->success('Se retiro publicación en el home');
        $this->_redirect('/admin/home/projects');
    }
}

