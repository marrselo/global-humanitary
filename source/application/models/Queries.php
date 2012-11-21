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
    function __construct() {
        $this->_tableNoticias = new Application_Model_DbTable_Noticias();
        $this->_tableBanner = new Application_Model_DbTable_Banner();
        $this->_tableProyectos = new Application_Model_DbTable_Proyectos();
        $this->_tableProyectosImagen = new Application_Model_DbTable_ProyectosImagen();
        $this->_tableMemorias = new Application_Model_DbTable_Memorias();
        $this->_tableMiembros = new Application_Model_DbTable_Miembros();
    }
    public function getUltimasNoticias($limit=0){
        $result = $this->_tableNoticias
                ->select()
                ->where('noticias_publico =?',1)
                ->order('noticias_fecha_creacion desc')
                ;
        if((int)$limit>0){
            $result = $result->limit($limit);
        }
        
        return $result->query()->fetchAll();
    }
    
    public function getBanner(){
        $result = $this->_tableBanner
                ->select()
                ->where('banner_publico =?',1)
                ->order('banner_orden desc')
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
                ->limit(1);
        return $result->query()->fetchAll();
    }

}

?>
