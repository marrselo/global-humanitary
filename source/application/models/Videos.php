<?php

class Application_Model_Videos
{
    protected $_tableVideos; 
    
    function __construct()
    {
        $this->_tableVideos = new Application_Model_DbTable_Videos();
    }
    
    public function getVideo($idMemoria){
        $smt = $this->_tableVideos
                ->select()
                ->where('videos_id=?', $idMemoria)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listVideos()
    {
        $smt = $this->_tableVideos->select()->order('videos_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
    public function insertVideos($data){
        if($this->_tableVideos->insert($data)){
            return $this->_tableVideos->getAdapter()->lastInsertId();
        }else{
            false;
        }
    }
    public function getVideosForOrden($orden){
        $smt = $this->_tableVideos
                ->select()
                ->where('videos_orden=?', $orden)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function getOrdenlastVideos(){
        $sql = $this->_tableVideos->select()
                ->from($this->_tableVideos->getName(),'videos_orden')
                ->where('videos_orden >= 0')
                ->order('videos_orden desc')
                ->limit(1);
        return $this->_tableVideos->getAdapter()->fetchOne($sql);
    }
    public function updateVideos($data,$idMemoria){
        $where = $this->_tableVideos->getAdapter()->quoteInto('videos_id=?', $idMemoria);
        return $this->_tableVideos->update($data, $where);
    }
    
}

