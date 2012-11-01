<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Queries
 *
 * @author Laptop
 */
class Application_Model_Queries extends Core_Model {

    //put your code here
    private $_tableNoticias;
    private $_tableBanner;
    function __construct() {
        $this->_tableNoticias = new Application_Model_DbTable_Noticias();
        $this->_tableBanner = new Application_Model_DbTable_Banner();
    }
    public function getUltimasNoticias($limit=0){
        $result = $this->_tableNoticias
                ->select()
                ->where('noticias_publico =?',1)
                ->order('noticias_fecha_creacion desc')
                ;
        if((int)$limit>0){
            $result = $result->limit($limit);
        }
        
        return $result->query()->fetchAll();
    }
    public function getBanner(){
        $result = $this->_tableBanner
                ->select()
                ->where('banner_publico =?',1)
                ->order('banner_orden desc')
                ;
        return $result->query()->fetchAll();
    }

}

?>
