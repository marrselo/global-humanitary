<?php

class Application_Model_TipoColaboracion
{
    protected $_tableTipoColaboracion; 
    
    function __construct()
    {
        $this->_tableTipoColaboracion = 
            new $this->_Application_Model_DbTable_TipoColaboracion();
    }
    
    public function getNoticia($idTipoColaboracion){
        $smt = $this->_tableTipoColaboracion
                ->select()
                ->where('tipo_colaboracion_id=?',$idTipoColaboracion)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listTipoColaboracion()
    {
        $smt = $this->_tableTipoColaboracion->select()->order('miembros_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }

     public static function nroPublicHome()
    {        
        $objTipoColaboracion = new $this->_Application_Model_DbTable_TipoColaboracion();    
        $smt = $objTipoColaboracion->getAdapter()->select()
            ->from(array('P'=>$objTipoColaboracion->getName()),
                new Zend_Db_Expr('count(*) as nroHome'))
            ->where('tipo_colaboracion_home=?',1)
            ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result['nroHome'];
    }
    public function insertar($data)
    {
        $this->_tableTipoColaboracion->insert($data);        
        return $this->_tableTipoColaboracion->getAdapter()->lastInsertId();    
    }
    public function getColaboracionHome(){
      $smt = $this->_tableTipoColaboracion
                ->getAdapter()
                ->select()
                ->from(array('tp'=>$this->_tableTipoColaboracion->getName()),array(
                    'tp.tipo_colaboracion_id',                    
                    'tp.tipo_colaboracion_orden',
                    'tp.tipo_colaboracion_titulo',
                    'tp.tipo_colaboracion_subtitulo',                    
                    'tp.tipo_colaboracion_descripcion',
                    'tp.tipo_colaboracion_publico',                    
                    'tp.tipo_colaboracion_home',
                    'tp.tipo_colaboracion_img',
                    'tp.fecha_creacion'                    
                ))                
                ->where('tp.tipo_colaboracion_publico =?',1)                
                ->order('tp.fecha_creacion desc')                
                ->query()
                ;
       $result=$smt->fetchAll();
       $smt->closeCursor();
       return $result;
    }
    public function eliminarColaboracion($idTipoColaboracion){
        $where=$this->_tableTipoColaboracion->getAdapter()
            ->quoteInto('tipo_colaboracion_id=?',$idTipoColaboracion);
        $this->_tableTipoColaboracion->delete($where);
    }
    public function actualizarColaboracion($idTipoColaboracion,$data)
    {        
        $where=$this->_tableTipoColaboracion->getAdapter()
            ->quoteInto('tipo_colaboracion_id =?',$idTipoColaboracion);        
        $this->_tableTipoColaboracion->update($data,$where);
    }
    
}
