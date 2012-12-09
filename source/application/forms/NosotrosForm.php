<?php
class Application_Form_NosotrosForm extends Zend_Form {
    
    function init() {
        parent::init();
        $this->setMethod('Post');
        
        $this->addElement(
                new Zend_Form_Element_Text('tituloNosotros',
                        array('required' => true))
                );
        
        $this->addElement(
                new Zend_Form_Element_Textarea('descripcionNosotros',
                        array('required' => true))
                );
        $this->addElement(
                new Zend_Form_Element_Hidden('idNosotros',
                        array('required' => true))
                );
        $this->addElement(new Zend_Form_Element_Submit('Enviar'));
        foreach($this->getElements() as $element) {
            $element->removeDecorator('DtDdWrapper');
            $element->removeDecorator('Label');
            $element->removeDecorator('HtmlTag');
        }  
        
    }
    
}

