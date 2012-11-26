<?php

class Application_Model_Memorias
{
    protected $_tableMemorias; 
    
    function __construct()
    {
        $this->_tableMemorias = new Application_Model_DbTable_Memorias();
    }
    
    public function getMemoria($idMemoria){
        $smt = $this->_tableMemorias
                ->select()
                ->where('memorias_id=?', $idMemoria)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listMemorias()
    {
        $smt = $this->_tableMemorias->select()->order('memorias_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
    public function insertMemorias($data){
        if($this->_tableMemorias->insert($data)){
            return $this->_tableMemorias->getAdapter()->lastInsertId();
        }else{
            false;
        }
    }
    public function getMemoriasForOrden($orden){
        $smt = $this->_tableMemorias
                ->select()
                ->where('memorias_orden=?', $orden)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function getOrdenlastMemorias(){
        $sql = $this->_tableMemorias->select()
                ->from($this->_tableMemorias->getName(),'memorias_orden')
                ->where('memorias_orden >= 0')
                ->order('memorias_orden desc')
                ->limit(1);
        return $this->_tableMemorias->getAdapter()->fetchOne($sql);
    }
    public function updateMemorias($data,$idMemoria){
        $where = $this->_tableMemorias->getAdapter()->quoteInto('memorias_id=?', $idMemoria);
        return $this->_tableMemorias->update($data, $where);
    }
    
}

