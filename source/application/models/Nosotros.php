<?php
/**
 * Description of Queries
 *
 * @author Laptop
 */
class Application_Model_Nosotros extends Core_Model {

    //put your code here
    private $_tableNosotros;
    
    function __construct() {
        $this->_tableNosotros = new Application_Model_DbTable_Nosotros();
    }
    public function getNosotros(){
        return $this->_tableNosotros
                ->select()
                ->limit(1)
                ->order('nosotros_id desc')
                ->query()
                ->fetch();
    }
    public function insertNosotros($data){
        if($this->_tableNosotros->insert($data)){
            return $this->_tableNosotros
                    ->getAdapter()
                    ->lastInsertId();
        }else{
            return false;
        }
    }
    /**
     * @param int $idNosotros id de tabla nosotros
     * @param array $data data a actualizar
     */
    public function updateNosotros($idNosotros,$data)
    {
        $where=$this->_tableNosotros->getAdapter()->quoteInto('nosotros_id =?',$idNosotros);        
        $this->_tableNosotros->update($data,$where);
    }

}

?>
