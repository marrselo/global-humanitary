<?php

class Application_Form_AdminColaboraForm extends Zend_Form
{
        public function init() {
            $this->setMethod('post');
            $this->setAttrib('enctype', 'multipart/form-data');
            $this->addElement(new Zend_Form_Element_Text('titulo',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_Text('subtitulo',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_Hidden('id'));
            $this->addElement(new Zend_Form_Element_Textarea('descripcion',
                                  array('required'=>true)));
            $this->addElement(new Zend_Form_Element_File('imagen'));
            $this->addElement(new Zend_Form_Element_File('file'));             
            $this->getElement('imagen')->setLabel('imagen')
                ->setDestination(ROOT_IMG_DINAMIC.'/noticias')                
                ->addValidator('Size', false, 1002400) // 1 mega
                ->addValidator('Extension', true, 'jpg,png,gif,jpeg')// only JPEG, PNG, and GIFs
                ->setRequired(true);
            
            $this->getElement('file')
                ->setDestination(ROOT_IMG_DINAMIC.'/colabora/files')                
                ->addValidator('Size', false, 3002400) // 3 megas
                ->addValidator('Extension', true, 'doc,docx,pdf')
                ->setRequired(true);  
            
            $this->getElement('imagen')->setAttribs(
                array('class'=>'fileInput'));
            $this->getElement('file')->setAttribs(
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