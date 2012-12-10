<?php
/**
 * 
 * @author marrselo
 */
class Application_Model_Proyectos extends  Core_Model
{
    protected $_tableProyectos;
    protected $_tableProyectoImagen;
    public function __construct()
    {
        $this->_tableProyectos = new Application_Model_DbTable_Proyectos;
        $this->_tableProyectoImagen=new  Application_Model_DbTable_ProyectosImagen();
    }
    
    public function listaProyectos()
    {
        $smt = $this->_tableProyectos->select()
            ->from($this->_tableProyectos->getName())
            ->query();            
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
        
    public static function nroPublicHome()
    {        
        $objProjects = new Application_Model_DbTable_Proyectos();    
        $smt = $objProjects->getAdapter()->select()
            ->from(array('P'=>$objProjects->getName()),
                new Zend_Db_Expr('count(*) as nroHome'))
            ->where('proyectos_home=?',1)
            ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result['nroHome'];
    }
    public function insertar($data)
    {
        $this->_tableProyectos->insert($data);        
        return $this->_tableProyectos->getAdapter()->lastInsertId();    
    }
    public function getProyectosHome(){
       $smt = $this->_tableProyectos
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
                    'tp.fecha_creacion',
                    'imagen' => new Zend_Db_Expr("GROUP_CONCAT(DISTINCT tpi.proyectos_imagen_nombre SEPARATOR '|')"),
                ))
                ->joinLeft(array('tpi'=>$this->_tableProyectoImagen->getName()), 
                        'tpi.proyectos_id=tp.proyectos_id','')
                ->where('tp.proyectos_publico =?',1)                
                ->order('tp.proyectos_orden asc')
                ->group('tp.proyectos_id')
                ->query();
       $result=$smt->fetchAll();
       $smt->closeCursor();
       return $result;
    }
    public function eliminarProyecto($idProyecto){
        $where=$this->_tableProyectos->getAdapter()->quoteInto('proyectos_id=?',$idProyecto);
        $this->_tableProyectos->delete($where);
    }
    public function actualizarProyecto($idProyecto,$data)
    {        
        $where=$this->_tableProyectos->getAdapter()->quoteInto('proyectos_id =?',$idProyecto);        
        $this->_tableProyectos->update($data,$where);
    }
}

