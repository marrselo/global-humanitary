<?php
/**
 * Entidad de proyectos
 *
 * @author Marcelo Carranza
 */
class Application_Entity_Noticias extends Core_Entity {

    //put your code here
    protected $_id;    
    protected $_publicHome;
    protected $_modelNoticia;

    /**
     * 
     */
    function __construct() {
        $this->_modelProyecto = new Application_Model_Noticias();
        $$this->_publicHome = 1;
        
    }       
    public static function  insertNoticia($data)
    {
        $objNoticia=new Application_Model_Noticias();
        $nroPublicHome = $objNoticia->nroPublicHome();
        $publicHome=($nroPublicHome>=2)? '0' : '1' ;
        
        $shortDescription=substr($data['descripcion'],0,50);
        $dataNotice=array('noticias_titulo'=>$data['titulo'],
             'noticias_subtitulo'=>$data['subtitulo'],
             'noticias_descripcion'=>$data['descripcion'],
             'noticias_fecha_creacion'=>date('Y-m-d H:i:s'),
             'noticias_descripcion_corta'=>$shortDescription,
             'noticias_imagen'=>$data['nameImagen'],
             'noticias_publico'=>1,
             'noticias_home'=>$publicHome,
             );       
            $data['idProyecto']=$objNoticia->insertar($dataNotice);            
            return '';              
    }
    public static function listNoticesHomeAdmin()
    {        
        $objNotice=new Application_Model_Noticias();
        return $objNotice->getNoticiasHome();
    }
    
    public static function deleteNotice($idNoticia){
        
        $objNotice=new Application_Model_Noticias();        
        $objNotice->eliminarNoticia($idNoticia);
    }
    
    public static function publishNoticiatHome($idNoticia)
    {
        $objNotice=new Application_Model_Noticias();
        $nroPublicHome = $objNotice->nroPublicHome();
        
        if($nroPublicHome>=2){           
            return false;
        }else{ 
            
            $data=array('noticias_home'=>'1');
            $objNotice->actualizarNoticia($idNoticia,$data);
            return true;
        }
    }
    public static function unpublishProjectHome($idNotice)
    {
        $objNotice=new Application_Model_Noticias();
        $data=array('noticias_home'=>'0');
        $objNotice->actualizarNoticia($idNotice,$data);
    }
    
    private function getSigOrden(){
        $num = (int)$this->_modelImagenes->getOrdenlastImagenes();
        return ($num+1);
    }        
    
    public function insertImagenes() {
        $this->_orden = $this->getSigOrden();
        return $this->_modelImagenes->insertImagenes($this->setArrayDb());
    }
    
}

?>
