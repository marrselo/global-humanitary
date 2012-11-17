<?php

class Default_QuienesSomosController extends Core_Controller_ActionDefault       
{
    public function init() {
        parent::init();
        $this->view->navigationLeft = new Zend_Navigation($this->getNavLeft());
    }
    public function indexAction()
    {           
        $entityNosotros = new  Application_Entity_Nosotros();
        $this->view->nosotrosValue = $entityNosotros->getNosotros();
        
    } 
    public function visionMisionAction()
    {           
        
    } 
    public function historiaAction()
    {           
        
    } 
    public function principiosActuacionAction()
    {           
        
    } 
    public function memoriasAction()
    {           
        
    } 
    public function nuestroEquipoAction()
    {           
        
    } 
    
    public function getNavLeft(){
        return array(
        array(
            'label' => 'La Historia',
            'module' => 'default',
            'controller' => 'quienes-somos',
            'action' => 'historia',
        ),
        array(
            'label' => 'Vision y Mision',
            'module' => 'default',
            'controller' => 'quienes-somos',
            'action' => 'vision-mision',
        ),
        array(
            'label' => 'Principios de actuacion',
            'module' => 'default',
            'controller' => 'quienes-somos',
            'action' => 'principios-actuacion',
        ),
        array(
            'label' => 'Memorias',
            'module' => 'default',
            'controller' => 'quienes-somos',
            'action' => 'memorias',
        ),
        array(
            'label' => 'Nuestro Equipo',
            'module' => 'default',
            'controller' => 'quienes-somos',
            'action' => 'nuestro-equipo',
        ),
 
    );
        
    
}
}

