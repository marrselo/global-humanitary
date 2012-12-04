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
class Application_Entity_Videos extends Core_Entity {

    //put your code here
    protected $_id;
    protected $_link;
    protected $_imagen;
    protected $_titulo;
    protected $_orden;
    protected $_publico;
    protected $_descripcion;
    private $_modelVideos;

    function __construct() {
        $this->_modelVideos = new Application_Model_Videos();
    }

    static function listVideos() {
        $model = new Application_Model_Videos();
        return $model->listVideos();
    }
    
    public function identifiEntity($idVideo){
        if($data = $this->_modelVideos->getVideo($idVideo)){
            $this->_id = $data['videos_id'];
            $this->_link = $data['videos_link'];
            $this->_imagen = $data['videos_imagen'];
            $this->_titulo = $data['videos_titulo'];
            $this->_orden = $data['videos_orden'];
            $this->_publico = $data['videos_publico'];
            $this->_descripcion = $data['videos_descripcion'];
            return true;
        }else{
            return false;
        }
    }
    
    public function setArrayDb(){
        $data['videos_id'] = $this->_id;
        $data['videos_link'] = $this->_link;
        $data['videos_imagen'] = $this->_imagen;
        $data['videos_titulo'] = $this->_titulo;
        $data['videos_orden'] = $this->_orden;
        $data['videos_publico'] = $this->_publico;
        $data['videos_descripcion'] = $this->_descripcion;
        return $this->cleanArray($data);
    }
    
    public function updateVideos(){
        $data = $this->setArrayDb();
        if($data['videos_imagen']!=''){
            $dataAnt = $this->_modelVideos->getVideo($this->_id);
        }
        if($this->_modelVideos->updateVideos($data, $this->_id)){
           return true;
        }else{
            return false;
        }
        
    }

    public function upOrder(){
        if($this->_orden>1){
            $data = $this->_modelVideos->getVideosForOrden($this->_orden-1);
            $entityVideo = new Application_Entity_Videos();
            $dataEntity['_id'] = $data['videos_id'];
            $dataEntity['_orden'] = $data['videos_orden']+1;
            $entityVideo->setProperties($dataEntity);
            $entityVideo->updateVideos();
            $this->_orden = ($this->_orden-1);
            $this->updateVideos();
        }
    }
    
    public function lowerOrder(){
        $lastOrdenVideo = $this->_modelVideos->getOrdenlastVideos();
        if($this->_orden<$lastOrdenVideo){
            $data = $this->_modelVideos->getVideosForOrden($this->_orden+1);
            $entityVideo = new Application_Entity_Videos();
            $dataEntity['_id'] = $data['videos_id'];
            $dataEntity['_orden'] = $data['videos_orden']-1;
            $entityVideo->setProperties($dataEntity);
            $entityVideo->updateVideos();
            $this->_orden = ($this->_orden+1);
            $this->updateVideos();
        }
    }
    public function unpublicVideo(){
        $this->_publico = '0';
        $this->updateVideos();
    }
    private function getSigOrden(){
        $num = (int)$this->_modelVideos->getOrdenlastVideos();
        return ($num+1);
    }
    public function publicVideo(){
        $this->_publico=1;
        $this->updateVideos();
    }
    
    public function insertVideos() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelVideos->insertVideos($this->setArrayDb());
    }
}

?>
