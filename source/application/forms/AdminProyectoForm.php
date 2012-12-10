<?php

class Application_Form_AdminProyectoForm extends Zend_Form
{
        public function init() {
            $this->setMethod('post');
            $this->setAttrib('enctype', 'multipart/form-data');
            $this->addElement(new Zend_Form_Element_Text('titulo',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_Text('subtitulo',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_Hidden('idProyecto'));
            $this->addElement(new Zend_Form_Element_Textarea('descripcion',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_File('imagen')); 
            $this->addElement(new Zend_Form_Element_Checkbox('realizado',
                array('checkedValue')));
            $this->getElement('realizado')->setValue('1');
            
            $this->getElement('imagen')->setLabel('imagen')
                ->setDestination(ROOT_IMG_DINAMIC.'/proyectos/imagen')                
                ->addValidator('Size', false, 1002400) // limit to 100K
                ->addValidator('Extension', true, 'jpg,png,gif,jpeg')// only JPEG, PNG, and GIFs
                ->setRequired(true);
            
            $this->getElement('imagen')->setAttribs(
                array('class'=>'fileInput'));
            
            $this->getElement('titulo')->setAttribs(
                array('placeholder'=>'Ingrese titulo Proyecto'));
            $this->getElement('subtitulo')->setAttribs(
                array('placeholder'=>'Ingrese subtitulo'));
            $this->getElement('descripcion')->setAttribs(
                array('placeholder'=>'Ingrese text','class'=>'auto'
                    ,'rows'=>'8','cols'=>''));                        
            foreach($this->getElements() as $element) {
            $element->removeDecorator('DtDdWrapper');
            $element->removeDecorator('Label');
            $element->removeDecorator('HtmlTag');
            }              
            $this->addElement(new Zend_Form_Element_Submit('Guardar'));      
            
        }

            
}