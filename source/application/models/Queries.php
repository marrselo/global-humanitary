<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Queries
 *
 * @author Laptop
 */
class Application_Model_Queries extends Core_Model {

    //put your code here
    private $_tableNoticias;
    private $_tableBanner;
    private $_tableProyectos;
    private $_tableProyectosImagen;
    private $_tableMemorias;
    private $_tableMiembros;
    private $_tableImagenes;
    private $_tableWallpaper;
    private $_tableVideos;
    function __construct() {
        $this->_tableNoticias = new Application_Model_DbTable_Noticias();
        $this->_tableBanner = new Application_Model_DbTable_Banner();
        $this->_tableProyectos = new Application_Model_DbTable_Proyectos();
        $this->_tableProyectosImagen = new Application_Model_DbTable_ProyectosImagen();
        $this->_tableMemorias = new Application_Model_DbTable_Memorias();
        $this->_tableMiembros = new Application_Model_DbTable_Miembros();
        $this->_tableImagenes = new Application_Model_DbTable_Imagenes();
        $this->_tableWallpaper = new Application_Model_DbTable_Wallpaper();
        $this->_tableVideos = new Application_Model_DbTable_Videos();
    }
    public function getUltimasNoticias($limit=0){
        $result = $this->_tableNoticias
                ->select()
                ->where('noticias_home =?',1)
                ->order('noticias_fecha_creacion desc')
                ;
        if((int)$limit>0){
            $result = $result->limit($limit);
        }
        
        return $result->query()->fetchAll();
    }
    
    /*
     * @param bool $toAdmin 
     */
    public function getBanner($toAdmin=true){
        $result = $this->_tableBanner
                ->select();
        if(!$toAdmin){
            $result->where('banner_publico =?',1);
        }                
            $result->order('banner_orden desc')
            ;        
        return $result->query()->fetchAll();
        
    }
    
    public function listingMemorias(){
        $result = $this->_tableMemorias
                ->select()
                ->where('memorias_publico =?',1)
                ->order('memorias_orden asc');
        return $result->query()->fetchAll();
    }
    public function listingMiembros(){
        $result = $this->_tableMiembros
                ->select()
                ->where('miembros_publico =?',1)
                ->order('miembros_orden asc');
        return $result->query()->fetchAll();
    }
    public function listingImagenes(){
        $result = $this->_tableImagenes
                ->select()
                ->where('imagenes_publico =?',1)
                ->order('imagenes_orden asc');
        return $result->query()->fetchAll();
    }
    public function listingWallpaper(){
        $result = $this->_tableWallpaper
                ->select()
                ->where('wallpaper_publico =?',1)
                ->order('wallpaper_orden asc');
        return $result->query()->fetchAll();
    }
    public function listingVideos(){
        $result = $this->_tableVideos
                ->select()
                ->where('videos_publico =?',1)
                ->order('videos_orden asc');
        return $result->query()->fetchAll();
    }
    
    public function getProyectosHome(){
        $result = $this->_tableProyectos
                ->getAdapter()
                ->select()
                ->from(array('tp'=>$this->_tableProyectos->getName()),array(
                    'tp.proyectos_id',
                    'tp.proyectos_slug',
                    'tp.proyectos_descripcion_corta',
                    'tp.proyectos_nombre',
                    'tp.proyectos_subtitulo',
                    'tp.proyectos_orden',
                    'tp.proyectos_descripcion',
                    'tp.proyectos_publico',
                    'tp.proyectos_estado_id',
                    'tp.proyectos_home',
                    'imagen' => new Zend_Db_Expr("GROUP_CONCAT(DISTINCT tpi.proyectos_imagen_nombre SEPARATOR '|')"),
                ))
                ->joinLeft(array('tpi'=>$this->_tableProyectosImagen->getName()), 
                        'tpi.proyectos_id=tp.proyectos_id','')
                ->where('tp.proyectos_publico =?',1)
                ->where('tp.proyectos_home =?',1)
                ->order('tp.proyectos_orden asc')
                ->group('tp.proyectos_id')
                ->limit(2)
                ;
        return $result->query()->fetchAll();
    }
    public function getUltimoProyectoEncursoHome(){
        $result = $this->_tableProyectos
                ->getAdapter()
                ->select()
                ->from(array('tp'=>$this->_tableProyectos->getName()),array(
                    'tp.proyectos_id',
                    'tp.proyectos_slug',
                    'tp.proyectos_descripcion_corta',
                    'tp.proyectos_nombre',
                    'tp.proyectos_subtitulo',
                    'tp.proyectos_orden',
                    'tp.proyectos_descripcion',
                    'tp.proyectos_publico',
                    'tp.proyectos_estado_id',
                    'tp.proyectos_home',
                    'imagen' =>'tpi.proyectos_imagen_nombre'
                ))
                ->joinLeft(array('tpi'=>$this->_tableProyectosImagen->getName()), 
                        'tpi.proyectos_id=tp.proyectos_id','')
                ->where('tp.proyectos_publico =?',1)
                ->where('tp.proyectos_home =?',1)
                ->where( 'tp.proyectos_estado_id=?',2)
                ->order('tp.proyectos_orden asc')
                ->group('tp.proyectos_id')
                ->limit(1)
                ;
        return $result->query()->fetch();
    }

}

?>
