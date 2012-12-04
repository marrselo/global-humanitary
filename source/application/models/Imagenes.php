<?php

class Application_Model_Imagenes
{
    protected $_tableImagenes; 
    
    function __construct()
    {
        $this->_tableImagenes = new Application_Model_DbTable_Imagenes();
    }
    
    public function getImagen($idImagen){
        $smt = $this->_tableImagenes
                ->select()
                ->where('imagenes_id=?', $idImagen)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listImagenes()
    {
        $smt = $this->_tableImagenes->select()->order('imagenes_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
    public function insertImagenes($data){
        if($this->_tableImagenes->insert($data)){
            return $this->_tableImagenes->getAdapter()->lastInsertId();
        }else{
            false;
        }
    }
    public function getImagenesForOrden($orden){
        $smt = $this->_tableImagenes
                ->select()
                ->where('imagenes_orden=?', $orden)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function getOrdenlastImagenes(){
        $sql = $this->_tableImagenes->select()
                ->from($this->_tableImagenes->getName(),'imagenes_orden')
                ->where('imagenes_orden >= 0')
                ->order('imagenes_orden desc')
                ->limit(1);
        return $this->_tableImagenes->getAdapter()->fetchOne($sql);
    }
    public function updateImagenes($data,$idImagene){
        $where = $this->_tableImagenes->getAdapter()->quoteInto('imagenes_id=?', $idImagene);
        return $this->_tableImagenes->update($data, $where);
    }
    
}

