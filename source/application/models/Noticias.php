<?php

class Application_Model_Noticias
{
    protected $_tableNoticias; 
    
    function __construct()
    {
        $this->_tableNoticias = new Application_Model_DbTable_Noticias();
    }
    
    public function getNoticia($idMiembro){
        $smt = $this->_tableNoticias
                ->select()
                ->where('noticia_id=?', $idMiembro)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listNoticia()
    {
        $smt = $this->_tableNoticias->select()->order('miembros_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
    public function insertMiembros($data){
        if($this->_tableMiembros->insert($data)){
            return $this->_tableMiembros->getAdapter()->lastInsertId();
        }else{
            false;
        }
    }
    public function getMiembrosForOrden($orden){
        $smt = $this->_tableMiembros
                ->select()
                ->where('miembros_orden=?', $orden)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function getOrdenlastMiembros(){
        $sql = $this->_tableMiembros->select()
                ->from($this->_tableMiembros->getName(),'miembros_orden')
                ->where('miembros_orden >= 0')
                ->order('miembros_orden desc')
                ->limit(1);
        return $this->_tableMiembros->getAdapter()->fetchOne($sql);
    }
    public function updateMiembros($data,$idMiembro){
        $where = $this->_tableMiembros->getAdapter()->quoteInto('miembros_id=?', $idMiembro);
        return $this->_tableMiembros->update($data, $where);
    }
    
}
