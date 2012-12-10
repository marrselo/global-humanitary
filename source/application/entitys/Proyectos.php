<?php
/**
 * Entidad de proyectos
 *
 * @author Marcelo Carranza
 */
class Application_Entity_Proyectos extends Core_Entity {

    //put your code here
    protected $_id;    
    protected $_publicHome;
    protected $_modelProyecto;

    /**
     * 
     */
    function __construct() {
        $this->_modelProyecto = new Application_Model_Proyectos();
        $$this->_publicHome = 1;
        
    }       
    public static function  insertProyecto($data)
    {
        $objProyecto=new Application_Model_Proyectos();
        $nroPublicHome = $objProyecto->nroPublicHome();
        $publicHome=($nroPublicHome>=4)? '0' : '1' ;
        $realizado=(!empty($data['realizado']))? '1' : '2' ;
        $shortDescription=substr($data['descripcion'],0,50);
        $dataProject=array('proyectos_nombre'=>$data['titulo'],
             'proyectos_subtitulo'=>$data['subtitulo'],
             'proyectos_descripcion'=>$data['descripcion'],
             'fecha_creacion'=>date('Y-m-d H:i:s'),
             'proyectos_descripcion_corta'=>$shortDescription,
             'proyectos_publico'=>1,
             'proyectos_home'=>$publicHome,
             'proyectos_estado_id'=>"$realizado");       
            $data['idProyecto']=$objProyecto->insertar($dataProject);
            if(isset($data['idProyecto'])){
                $modelProyectoImagen=new Application_Model_ProyectosImagen();                
                $dataImagen['proyectos_imagen_nombre']=$data['nameImagen'];
                $dataImagen['proyectos_id']=$data['idProyecto'];
                $modelProyectoImagen->insertar($dataImagen);        
                return $data['idProyecto'];
            }
            return '';
      
        
    }
    
    public static function insertOnePictureProyecto($dataProject)
    {
        $modelProyectoImagen=new Application_Model_ProyectosImagen();
        $data['proyectos_imagen_nombre']=$dataProject['nameImagen'];
        $data['proyectos_id']=$dataProject['idImagen'];
        $modelProyectoImagen->insertar($data);
    }
    public static function listProjectHome()
    {        
        $objProyecto=new Application_Model_Proyectos();
        return $objProyecto->getProyectosHome();
    }
    
    public static function deleteProject($idProject){
        $objProjectPicture=new Application_Model_ProyectosImagen();
        $objProject=new Application_Model_Proyectos();
        $objProjectPicture->eliminarProyectoImagen($idProject);
        $objProject->eliminarProyecto($idProject);
    }
    
    public static function publishProjectHome($idProject)
    {
        $objProject=new Application_Model_Proyectos();
        $nroPublicHome = $objProject->nroPublicHome();
        if($nroPublicHome>=4){
            return false;
        }else{ 
            $data=array('proyectos_home'=>1);
            try{return true;
            $objProject->actualizarProyecto($idProject,$data);
            }  catch (Exception $e){
                Zend_Debug::dump($e);
                                exit();
               return false;
            }
            
        }
    }
    public static function unpublishProjectHome($idProject)
    {
        $objProject=new Application_Model_Proyectos();
        $data=array('proyectos_home'=>'0');
        $objProject->actualizarProyecto($idProject,$data);
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
