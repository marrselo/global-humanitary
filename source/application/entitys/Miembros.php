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
class Application_Entity_Miembros extends Core_Entity {

    //put your code here
    protected $_id;
    protected $_nombre;
    protected $_apellidos;
    protected $_imagen;
    protected $_resumen;
    protected $_cargo;
    protected $_orden;
    protected $_publico;
    private $_modelMiembros;

    function __construct() {
        $this->_modelMiembros = new Application_Model_Miembros();
    }

    static function listMiembros() {
        $model = new Application_Model_Miembros();
        return $model->listMiembros();
    }
    
    public function identifiEntity($idMiembro){
        if($data = $this->_modelMiembros->getMiembro($idMiembro)){
            $this->_id = $data['miembros_id'];
            $this->_nombre = $data['miembros_nombre'];
            $this->_apellidos = $data['miembros_apellidos'];
            $this->_imagen = $data['miembros_imagen'];
            $this->_cargo = $data['miembros_cargo'];
            $this->_resumen = $data['miembros_resumen'];
            $this->_orden = $data['miembros_orden'];
            $this->_publico = $data['miembros_publico'];
            return true;
        }else{
            return false;
        }
    }
    
    public function setArrayDb(){
        $data['miembros_id'] = $this->_id;
        $data['miembros_nombre'] = $this->_nombre;
        $data['miembros_apellidos'] = $this->_apellidos;
        $data['miembros_imagen'] = $this->_imagen;
        $data['miembros_cargo'] = $this->_cargo;
        $data['miembros_resumen'] = $this->_resumen;
        $data['miembros_orden'] = $this->_orden;
        $data['miembros_publico'] = $this->_publico;
        return $this->cleanArray($data);
    }
    
    public function updateMiembros(){
        $data = $this->setArrayDb();
        if($data['miembros_imagen']!=''){
            $dataAnt = $this->_modelMiembros->getMiembro($this->_id);
        }
        if($this->_modelMiembros->updateMiembros($data, $this->_id)){
            if($data['miembros_imagen']!=''){
                $this->deleteImagen($dataAnt['miembros_imagen']);
            }
            return true;
        }else{
            return false;
        }
        
    }

    public function upOrder(){
        if($this->_orden>1){
            $data = $this->_modelMiembros->getMiembrosForOrden($this->_orden-1);
            $entityMiembro = new Application_Entity_Miembros();
            $dataEntity['_id'] = $data['miembros_id'];
            $dataEntity['_orden'] = $data['miembros_orden']+1;
            $entityMiembro->setProperties($dataEntity);
            $entityMiembro->updateMiembros();
            $this->_orden = ($this->_orden-1);
            $this->updateMiembros();
        }
    }
    
    public function lowerOrder(){
        $lastOrdenMiembro = $this->_modelMiembros->getOrdenlastMiembros();
        if($this->_orden<$lastOrdenMiembro){
            $data = $this->_modelMiembros->getMiembrosForOrden($this->_orden+1);
            $entityMiembro = new Application_Entity_Miembros();
            $dataEntity['_id'] = $data['miembros_id'];
            $dataEntity['_orden'] = $data['miembros_orden']-1;
            $entityMiembro->setProperties($dataEntity);
            $entityMiembro->updateMiembros();
            $this->_orden = ($this->_orden+1);
            $this->updateMiembros();
        }
    }
    public function unpublicMiembro(){
        $this->_publico = '0';
        $this->updateMiembros();
    }
    private function getSigOrden(){
        $num = (int)$this->_modelMiembros->getOrdenlastMiembros();
        return ($num+1);
    }
    public function publicMiembro(){
        $this->_publico=1;
        $this->updateMiembros();
    }
    
    public function insertNosotros() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelMiembros->insertMiembros($this->setArrayDb());
    }
    public function deleteImagen($imagen){
        unlink(APPLICATION_PATH.'/../public/dinamic/miembros/'.$imagen);
    }
}

?>
