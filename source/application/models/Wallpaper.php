<?php

class Application_Model_Wallpaper
{
    protected $_tableWallpaper; 
    
    function __construct()
    {
        $this->_tableWallpaper = new Application_Model_DbTable_Wallpaper();
    }
    
    public function getWallpaper($idWallpaper){
        $smt = $this->_tableWallpaper
                ->select()
                ->where('wallpaper_id=?', $idWallpaper)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function listWallpaper()
    {
        $smt = $this->_tableWallpaper->select()->order('wallpaper_orden asc')->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
    public function insertWallpaper($data){
        if($this->_tableWallpaper->insert($data)){
            return $this->_tableWallpaper->getAdapter()->lastInsertId();
        }else{
            false;
        }
    }
    public function getWallpaperForOrden($orden){
        $smt = $this->_tableWallpaper
                ->select()
                ->where('wallpaper_orden=?', $orden)
                ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    public function getOrdenlastWallpaper(){
        $sql = $this->_tableWallpaper->select()
                ->from($this->_tableWallpaper->getName(),'wallpaper_orden')
                ->where('wallpaper_orden >= 0')
                ->order('wallpaper_orden desc')
                ->limit(1);
        return $this->_tableWallpaper->getAdapter()->fetchOne($sql);
    }
    public function updateWallpaper($data,$idWallpapere){
        $where = $this->_tableWallpaper->getAdapter()->quoteInto('wallpaper_id=?', $idWallpapere);
        return $this->_tableWallpaper->update($data, $where);
    }
    
}

