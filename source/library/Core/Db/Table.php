<?php

/**
 * Operaciones Grales
 *
 * @author Nazart
 */
class Core_Db_Table  extends Zend_Db_Table
{

    function insert(array $data)
    {
       return parent::insert($data);
    }
    
    function update(array $data, $where)
    {
        return parent::update($data, $where);
    }

    function delete($where)
    {
        return parent::delete($where);
    }
    
    public function getName() {
        return $this->_name;
    }
    
    public function getCols(){
        return $this->_getCols();
    }
    
    
}
