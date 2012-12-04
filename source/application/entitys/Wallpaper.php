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
class Application_Entity_Wallpaper extends Core_Entity {

    //put your code here
    protected $_id;
    protected $_imagen;
    protected $_nombre;
    protected $_orden;
    protected $_publico;
    protected $_descripcion;
    private $_modelWallpaper;

    function __construct() {
        $this->_modelWallpaper = new Application_Model_Wallpaper();
    }

    static function listWallpaper() {
        $model = new Application_Model_Wallpaper();
        return $model->listWallpaper();
    }
    
    public function identifiEntity($idWallpaper){
        if($data = $this->_modelWallpaper->getWallpaper($idWallpaper)){
            $this->_id = $data['wallpaper_id'];
            $this->_imagen = $data['wallpaper_imagen'];
            $this->_nombre = $data['wallpaper_nombre'];
            $this->_orden = $data['wallpaper_orden'];
            $this->_publico = $data['wallpaper_publico'];
            $this->_descripcion = $data['wallpaper_descripcion'];
            return true;
        }else{
            return false;
        }
    }
    
    public function setArrayDb(){
        $data['wallpaper_id'] = $this->_id;
        $data['wallpaper_imagen'] = $this->_imagen;
        $data['wallpaper_nombre'] = $this->_nombre;
        $data['wallpaper_orden'] = $this->_orden;
        $data['wallpaper_publico'] = $this->_publico;
        $data['wallpaper_descripcion'] = $this->_descripcion;
        return $this->cleanArray($data);
    }
    
    public function updateWallpaper(){
        $data = $this->setArrayDb();
        $dataAnt =array();
        if($data['wallpaper_imagen']!=''){
            $dataAnt = $this->_modelWallpaper->getWallpaper($this->_id);
        }
        if($this->_modelWallpaper->updateWallpaper($data, $this->_id)){
            if(!empty($dataAnt)){
                unlink(APPLICATION_PATH.'/../public/dinamic/wallpaper/'.$dataAnt['wallpaper_imagen']);
            }
           return true;
        }else{
            return false;
        }
    }
    
    public function upOrder(){
        if($this->_orden>1){
            $data = $this->_modelWallpaper->getWallpaperForOrden($this->_orden-1);
            $entityImagene = new Application_Entity_Wallpaper();
            $dataEntity['_id'] = $data['wallpaper_id'];
            $dataEntity['_orden'] = $data['wallpaper_orden']+1;
            $entityImagene->setProperties($dataEntity);
            $entityImagene->updateWallpaper();
            $this->_orden = ($this->_orden-1);
            $this->updateWallpaper();
        }
    }
    
    public function lowerOrder(){
        $lastOrdenImagene = $this->_modelWallpaper->getOrdenlastWallpaper();
        if($this->_orden<$lastOrdenImagene){
            $data = $this->_modelWallpaper->getWallpaperForOrden($this->_orden+1);
            $entityImagene = new Application_Entity_Wallpaper();
            $dataEntity['_id'] = $data['wallpaper_id'];
            $dataEntity['_orden'] = $data['wallpaper_orden']-1;
            $entityImagene->setProperties($dataEntity);
            $entityImagene->updateWallpaper();
            $this->_orden = ($this->_orden+1);
            $this->updateWallpaper();
        }
    }
    public function unpublicImagene(){
        $this->_publico = '0';
        $this->updateWallpaper();
    }
    private function getSigOrden(){
        $num = (int)$this->_modelWallpaper->getOrdenlastWallpaper();
        return ($num+1);
    }
    public function publicImagene(){
        $this->_publico=1;
        $this->updateWallpaper();
    }
    
    public function insertWallpaper() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelWallpaper->insertWallpaper($this->setArrayDb());
    }
    
}

?>
