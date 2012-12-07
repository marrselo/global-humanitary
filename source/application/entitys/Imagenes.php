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
class Application_Entity_Imagenes extends Core_Entity {

    //put your code here
    protected $_id;
    protected $_imagen;
    protected $_nombre;
    protected $_orden;
    protected $_publico;
    protected $_descripcion;
    private $_modelImagenes;

    function __construct() {
        $this->_modelImagenes = new Application_Model_Imagenes();
    }

    static function listImagenes() {
        $model = new Application_Model_Imagenes();
        return $model->listImagenes();
    }
    
    public function identifiEntity($idImagen){
        if($data = $this->_modelImagenes->getImagen($idImagen)){
            $this->_id = $data['imagenes_id'];
            $this->_imagen = $data['imagenes_imagen'];
            $this->_nombre = $data['imagenes_nombre'];
            $this->_orden = $data['imagenes_orden'];
            $this->_publico = $data['imagenes_publico'];
            $this->_descripcion = $data['imagenes_descripcion'];
            return true;
        }else{
            return false;
        }
    }
    
    public function setArrayDb(){
        $data['imagenes_id'] = $this->_id;
        $data['imagenes_imagen'] = $this->_imagen;
        $data['imagenes_nombre'] = $this->_nombre;
        $data['imagenes_orden'] = $this->_orden;
        $data['imagenes_publico'] = $this->_publico;
        $data['imagenes_descripcion'] = $this->_descripcion;
        return $this->cleanArray($data);
    }
    
    public function updateImagenes(){
        $data = $this->setArrayDb();
        $dataAnt =array();
        if($data['imagenes_imagen']!=''){
            $dataAnt = $this->_modelImagenes->getImagen($this->_id);
        }
        if($this->_modelImagenes->updateImagenes($data, $this->_id)){
            if(!empty($dataAnt)){
                unlink(APPLICATION_PATH.'/../public/dinamic/imagenes/'.$dataAnt['imagenes_imagen']);
            }
           return true;
        }else{
            return false;
        }
    }
    
    public function upOrder(){
        if($this->_orden>1){
            $data = $this->_modelImagenes->getImagenesForOrden($this->_orden-1);
            $entityImagene = new Application_Entity_Imagenes();
            $dataEntity['_id'] = $data['imagenes_id'];
            $dataEntity['_orden'] = $data['imagenes_orden']+1;
            $entityImagene->setProperties($dataEntity);
            $entityImagene->updateImagenes();
            $this->_orden = ($this->_orden-1);
            $this->updateImagenes();
        }
    }
    
    public function lowerOrder(){
        $lastOrdenImagene = $this->_modelImagenes->getOrdenlastImagenes();
        if($this->_orden<$lastOrdenImagene){
            $data = $this->_modelImagenes->getImagenesForOrden($this->_orden+1);
            $entityImagene = new Application_Entity_Imagenes();
            $dataEntity['_id'] = $data['imagenes_id'];
            $dataEntity['_orden'] = $data['imagenes_orden']-1;
            $entityImagene->setProperties($dataEntity);
            $entityImagene->updateImagenes();
            $this->_orden = ($this->_orden+1);
            $this->updateImagenes();
        }
    }
    public function unpublicImagene(){
        $this->_publico = '0';
        $this->updateImagenes();
    }
    private function getSigOrden(){
        $num = (int)$this->_modelImagenes->getOrdenlastImagenes();
        return ($num+1);
    }
    public function publicImagene(){
        $this->_publico=1;
        $this->updateImagenes();
    }
    
    public function insertImagenes() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelImagenes->insertImagenes($this->setArrayDb());
    }
    
}

?>
