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
class Application_Entity_Memorias extends Core_Entity {

    //put your code here
    protected $_id;
    protected $_nombre;
    protected $_imagen;
    protected $_titulo;
    protected $_descripcion;
    protected $_orden;
    protected $_publico;
    private $_modelMemorias;

    function __construct() {
        $this->_modelMemorias = new Application_Model_Memorias();
    }

    static function listMemorias() {
        $model = new Application_Model_Memorias();
        return $model->listMemorias();
    }
    
    public function identifiEntity($idMemoria){
        if($data = $this->_modelMemorias->getMemoria($idMemoria)){
            $this->_id = $data['memorias_id'];
            $this->_nombre = $data['memorias_nombre'];
            $this->_imagen = $data['memorias_imagen'];
            $this->_titulo = $data['memorias_titulo'];
            $this->_descripcion = $data['memorias_descripcion'];
            $this->_orden = $data['memorias_orden'];
            $this->_publico = $data['memorias_publico'];
            return true;
        }else{
            return false;
        }
    }
    
    public function setArrayDb(){
        $data['memorias_id'] = $this->_id;
        $data['memorias_nombre'] = $this->_nombre;
        $data['memorias_imagen'] = $this->_imagen;
        $data['memorias_titulo'] = $this->_titulo;
        $data['memorias_descripcion'] = $this->_descripcion;
        $data['memorias_orden'] = $this->_orden;
        $data['memorias_publico'] = $this->_publico;
        return $this->cleanArray($data);
    }
    
    public function updateMemorias(){
        $data = $this->setArrayDb();
        if($data['memorias_imagen']!=''){
            $dataAnt = $this->_modelMemorias->getMemoria($this->_id);
        }
        if($this->_modelMemorias->updateMemorias($data, $this->_id)){
            if($data['memorias_imagen']!=''){
                $this->deleteImagen($dataAnt['memorias_imagen']);
            }
            return true;
        }else{
            return false;
        }
        
    }

    public function upOrder(){
        if($this->_orden>1){
            $data = $this->_modelMemorias->getMemoriasForOrden($this->_orden-1);
            $entityMemoria = new Application_Entity_Memorias();
            $dataEntity['_id'] = $data['memorias_id'];
            $dataEntity['_orden'] = $data['memorias_orden']+1;
            $entityMemoria->setProperties($dataEntity);
            $entityMemoria->updateMemorias();
            $this->_orden = ($this->_orden-1);
            $this->updateMemorias();
        }
    }
    
    public function lowerOrder(){
        $lastOrdenMemoria = $this->_modelMemorias->getOrdenlastMemorias();
        if($this->_orden<$lastOrdenMemoria){
            $data = $this->_modelMemorias->getMemoriasForOrden($this->_orden+1);
            $entityMemoria = new Application_Entity_Memorias();
            $dataEntity['_id'] = $data['memorias_id'];
            $dataEntity['_orden'] = $data['memorias_orden']-1;
            $entityMemoria->setProperties($dataEntity);
            $entityMemoria->updateMemorias();
            $this->_orden = ($this->_orden+1);
            $this->updateMemorias();
        }
    }
    public function unpublicMemoria(){
        $this->_publico = '0';
        $this->updateMemorias();
    }
    private function getSigOrden(){
        $num = (int)$this->_modelMemorias->getOrdenlastMemorias();
        return ($num+1);
    }
    public function publicMemoria(){
        $this->_publico=1;
        $this->updateMemorias();
    }
    
    public function insertNosotros() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelMemorias->insertMemorias($this->setArrayDb());
    }
    public function deleteImagen($imagen){
        unlink(APPLICATION_PATH.'/../public/dinamic/memorias/'.$imagen);
    }
}

?>
