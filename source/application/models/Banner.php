<?php
class Application_Model_Banner  extends Core_Model
{
    protected $_tableBanner; 
    
    public function __construct()
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
    public function getOrden()
    {
        $smt = $this->_tableBanner->getAdapter()->select()
            ->from(array('B'=>$this->_tableBanner->getName()),
                'banner_orden')
            ->order('banner_orden desc')
            ->limit(1)
            ->query();
        $result = $smt->fetch();
        $smt->closeCursor();
        return $result;
    }
    
    public function listBannerAdmin()
    {
       $smt = $this->_tableBanner->getAdapter()->select()
            ->from(array('B'=>$this->_tableBanner->getName()),
                  array('banner_orden','banner_id','banner_link','banner_publico',
                   'banner_orden',  
                   'fecha'=> new Zend_Db_Expr(
                       DATE_FORMAT('B.', '%W %M %Y')))
                )
            ->order('banner_orden desc')            
            ->query();
        $result = $smt->fetchAll();
        $smt->closeCursor();
        return $result; 
    }    
    public function saveBanner($data){
        $this->_tableBanner->insert($data);        
        return   $this->_tableBanner->getAdapter()->lastInsertId();        
    }
    
    public function publishBanner($idBanner)
    {        
        $where=$this->_tableBanner->getAdapter()->quoteInto('banner_id =?',$idBanner);
        $data= array('banner_publico'=>1);
        $this->_tableBanner->update($data,$where);
    }
    public function unpublishBanner($idBanner)
    {
        $where=$this->_tableBanner->getAdapter()->quoteInto('banner_id =?',$idBanner);
        $data=array('banner_publico'=>1);
        $this->_tableBanner->update($data,$where);
    }
                
    
}

