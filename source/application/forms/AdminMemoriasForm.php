<?php

class Application_Form_AdminMemoriasForm extends Zend_Form
{
        public function init() {
            parent::init();
            $this->setMethod('post');
            $this->setAttrib('enctype', 'multipart/form-data');
            
            $this->addElement(new Zend_Form_Element_Text('nombre',
                                  array('required'=>true,
                                        'label'=>'Titulo')));
            
            $this->addElement(new Zend_Form_Element_File('imagen')); 
            
            $this->addElement(new Zend_Form_Element_Text('titulo',
                array('label'=>'Titulo : '), array('validators' => 
                                  array('alnum', array('stringLength', false, array(4,100))))
                      ));
            
            $this->addElement(new Zend_Form_Element_Text('descripcion',
                array('label'=>'Descripción : '), array('validators' => 
                                  array('alnum', array('stringLength', false, array(4,100))))
                      ));
            $this->addElement(new Zend_Form_Element_Checkbox('publico',
                                  array('label'=>'Estado Activado : ')));
            $this->getElement('publico')->setValue('1');
            $this->getElement('publico')->setRequired();
            $this->getElement('imagen')->setLabel('imagen')
                ->setDestination(APPLICATION_PATH.'/../public/dinamic/memorias')
                ->addValidator('Count', false, 1)     // ensure only 1 file
                ->addValidator('Size', false, 102400) // limit to 100K
                ->addValidator('Extension', true, 'jpg,png,gif')// only JPEG, PNG, and GIFs
                ->setRequired(true);
            $this->addElement(new Zend_Form_Element_Submit('Guardar'));  
        }

            
}