<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Querys
 *
 * @author Laptop
 */
class Application_Entity_Nosotros extends Core_Entity {

    //put your code here
    protected $_tituloNosotros;
    protected $_descripcionNosotros;
    private $_modelNosotros;

    function __construct() {
        $this->_modelNosotros = new Application_Model_Nosotros();
    }

    static function getNosotros() {        
        $model = new Application_Model_Nosotros();
        return $model->getNosotros();
    }

    function insertNosotros() {
        $data['nosotros_titulo'] = $this->_tituloNosotros;
        $data['nosotros_descripcion'] = $this->_descripcionNosotros;
        $data['nosotros_date'] = date("Y-m-d H:i:s");
        return $this->_modelNosotros->insertNosotros($data);
    }

}

?>
