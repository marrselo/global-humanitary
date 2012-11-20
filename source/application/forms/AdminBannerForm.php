<?php

class Application_Form_AdminBannerForm extends Zend_Form
{
        public function init() {
            $this->setMethod('post');
            $this->setAttrib('enctype', 'multipart/form-data');
            $this->addElement(new Zend_Form_Element_Text('titulo',
                                  array('required'=>true,
                                        'label'=>'Titulo')));
            $this->addElement(new Zend_Form_Element_File('imagen')); 
                        
            
            $this->getElement('imagen')->setLabel('imagen')
                ->setDestination(ROOT_IMG_DINAMIC.'/banner')
                ->addValidator('Count', false, 1)     // ensure only 1 file
                ->addValidator('Size', false, 102400) // limit to 100K
                ->addValidator('Extension', true, 'jpg,png,gif')// only JPEG, PNG, and GIFs
                ->setRequired(true);
            
            $this->getElement('imagen')->setAttribs(
                array('class'=>'fileInput','id'=>'fileInput'));
            
            $this->getElement('titulo')->setAttribs(
                array('placeholder'=>'Ingrese titulo imagen'));
            
            $this->getElement('titulo')->removeDecorator('label');
            $this->getElement('titulo')->removeDecorator('htmlTag');
            $this->getElement('imagen')->removeDecorator('label');
            $this->getElement('imagen')->removeDecorator('htmlTag');
            
            $this->addElement(new Zend_Form_Element_Submit('Guardar'));      
            
        }

            
}