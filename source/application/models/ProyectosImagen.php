<?php
/**
 * 
 * 
 * @author marrselo
 */
class Application_Model_ProyectosImagen 
{
    protected $_tableProyectosImagen;
    public function __construct()
    {
        $this->_tableProyectosImagen=new Application_Model_DbTable_ProyectosImagen();        
    }
    
    public function insertar($data)
    {
        $this->_tableProyectosImagen->insert($data);                
    }
    public function eliminarProyectoImagen($idProject){
        $where=$this->_tableProyectosImagen->getAdapter()->quoteInto('proyectos_id',$idProject);
        $this->_tableProyectosImagen->delete($where);
    }
}

