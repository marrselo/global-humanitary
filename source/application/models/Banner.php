<?php

class Application_Model_Banner 
{
    protected $_tableBanner; 
    
    function __construct()
    {
        $this->_tableBanner = new Application_Model_DbTable_Banner();
    }
    
    /**
     * Lista de Banner
     */
    public function listBanner()
    {
        $smt = $this->_tableBanner->select()
            ->from($this->_tableBanner->getName())
            ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
}

