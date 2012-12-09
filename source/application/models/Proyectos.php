<?php
/**
 * 
 * @author marrselo
 */
class Application_Model_Proyectos extends  Core_Model
{
    public function __construct()
    {
        $this->_tableProyectos = new Application_Model_DbTable_Proyectos;
    }
    
    public function listaProyectos()
    {
        $smt = $this->_tableProyectos->select()
            ->from($this->_tableProyectos->getName())
            ->query();            
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result;
    }
}

