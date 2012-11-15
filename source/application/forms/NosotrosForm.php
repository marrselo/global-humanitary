<?php
class Application_Form_NosotrosForm extends Zend_Form {
    
    function init() {
        parent::init();
        $this->setMethod('Post');
        
        $this->addElement(
                new Zend_Form_Element_Text('tituloNosotros',
                        array(
                            'required' => true,
                            'label' => 'Titulo Nosotros',
                            ))
                );
        
        $this->addElement(
                new Zend_Form_Element_Textarea('descripcionNosotros',
                        array(
                            'required' => true,
                            'label' => 'Descripcion Nosotros',
                            ))
                );
        $this->addElement(new Zend_Form_Element_Submit('Enviar'));
        
    }
    
}

