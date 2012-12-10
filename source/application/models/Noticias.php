<?php

class Application_Model_Noticias
{
    protected $_tableNoticias; 
    
    function __construct()
    {
        $this->_tableNoticias = new Application_Model_DbTable_Noticias();
    }
    
    public function getNoticia($idNoticia){
        $smt = $this->_tableNoticias
                ->select()
                ->where('noticia_id=?',$idNoticia)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listNoticias()
    {
        $smt = $this->_tableNoticias->select()->order('miembros_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }

     public static function nroPublicHome()
    {        
        $objNotices = new Application_Model_DbTable_Noticias();    
        $smt = $objNotices->getAdapter()->select()
            ->from(array('P'=>$objNotices->getName()),
                new Zend_Db_Expr('count(*) as nroHome'))
            ->where('noticias_home=?',1)
            ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result['nroHome'];
    }
    public function insertar($data)
    {
        $this->_tableNoticias->insert($data);        
        return $this->_tableNoticias->getAdapter()->lastInsertId();    
    }
    public function getNoticiasHome(){
      $smt = $this->_tableNoticias
                ->getAdapter()
                ->select()
                ->from(array('tp'=>$this->_tableNoticias->getName()),array(
                    'tp.noticias_id',
                    'tp.noticias_slug',
                    'tp.noticias_descripcion_corta',
                    'tp.noticias_titulo',
                    'tp.noticias_subtitulo',                    
                    'tp.noticias_descripcion',
                    'tp.noticias_publico',                    
                    'tp.noticias_home',
                    'tp.noticias_imagen',
                    'tp.noticias_fecha_creacion'                    
                ))                
                ->where('tp.noticias_publico =?',1)                
                ->order('tp.noticias_fecha_creacion desc')                
                ->query()
                ;
       $result=$smt->fetchAll();
       $smt->closeCursor();
       return $result;
    }
    public function eliminarNoticia($idNoticia){
        $where=$this->_tableNoticias->getAdapter()->quoteInto('noticias_id=?',$idNoticia);
        $this->_tableNoticias->delete($where);
    }
    public function actualizarNoticia($idNoticia,$data)
    {        
        $where=$this->_tableNoticias->getAdapter()->quoteInto('noticias_id =?',$idNoticia);        
        $this->_tableNoticias->update($data,$where);
    }
    
}
