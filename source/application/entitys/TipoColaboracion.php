<?php
/**
 * Entidad de Colaboracion
 *
 * @author Marcelo Carranza
 */
class Application_Entity_Noticias extends Core_Entity {

    //put your code here
    protected $_id;    
    protected $_publicHome;
    protected $_modelTipoColaboracion;

    /**
     * 
     */
    function __construct() {
        $this->_modelTipoColaboracion = new Application_Model_TipoColaboracion();
        $$this->_publicHome = 1;
        
    }       
    public static function  insertNoticia($data)
    {
        $objTipoColaboracion=new Application_Model_TipoColaboracion();
        $nroPublicHome = $objTipoColaboracion->nroPublicHome();
        $publicHome=($nroPublicHome>=2)? '0' : '1' ;
        
        $shortDescription=substr($data['descripcion'],0,50);
        $dataNotice=array('tipo_colaboracion_titulo'=>$data['titulo'],
             'tipo_colaboracion_subtitulo'=>$data['subtitulo'],
             'tipo_colaboracion_descripcion'=>$data['descripcion'],
             'fecha_creacion'=>date('Y-m-d H:i:s'),
             'tipo_colaboracion_descripcion_corta'=>$shortDescription,
             'tipo_colaboracion_img'=>$data['nameImagen'],
             'tipo_colaboracion_publico'=>1,
             'tipo_colaboracion_home'=>$publicHome,
             );       
            $data['idProyecto']=$objTipoColaboracion->insertar($dataNotice);            
            return '';              
    }
    public static function listNoticesHomeAdmin()
    {        
        $objTipoColaboracion=new Application_Model_TipoColaboracion();
        return $objTipoColaboracion->getNoticiasHome();
    }
    
    public static function deleteColaboracion($idNoticia){
        
        $objTipoColaboracion=new Application_Model_TipoColaboracion();        
        $objTipoColaboracion->eliminarNoticia($idNoticia);
    }
    
    public static function publishColaboracionHome($idNoticia)
    {
        $objTipoColaboracion=new Application_Model_TipoColaboracion();
        $nroPublicHome = $objTipoColaboracion->nroPublicHome();
        
        if($nroPublicHome>=2){           
            return false;
        }else{ 
            
            $data=array('tipo_colaboracion_home'=>'1');
            $objTipoColaboracion->actualizarColaboracion($idNoticia,$data);
            return true;
        }
    }
    public static function unpublishProjectHome($idNotice)
    {
        $objTipoColaboracion=new Application_Model_TipoColaboracion();
        $data=array('tipo_colaboracion_home'=>'0');
        $objTipoColaboracion->actualizarColaboracion($idNotice,$data);
    }    

}

?>
