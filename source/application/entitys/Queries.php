<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Querys
 *
 * @author Laptop
 */
class Application_Entity_Queries {
    //put your code here
    
    static function getUltimasNoticias($limit=''){
      $model = new Application_Model_Queries();
      return $model->getUltimasNoticias($limit);
    }
    
    static function getBanner($toAdmin=false)
    {        
      $model = new Application_Model_Queries();
      return $model->getBanner($toAdmin);
    }
    static function getProyectosHome(){
      $model = new Application_Model_Queries();
      return $model->getProyectosHome();
    }
}

?>
