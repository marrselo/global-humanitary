<?php

class Default_SalaDePrensaController extends Core_Controller_ActionDefault {

    public function init() {
        parent::init();
        $this->view->navigationLeft = new Zend_Navigation($this->getNavLeft());
    }

    public function indexAction() {
        
    }
    public function imagenesAction() {
        $this->view->imagenes = Application_Entity_Queries::listingImagenes();
    }
    public function videosAction() {
        $this->view->videos = Application_Entity_Queries::listingVideos();
    }
    public function fondosEscritorioAction() {
        $this->view->wallpaper = Application_Entity_Queries::listingWallpaper();
    }

    public function getNavLeft() {
        return array(
            array(
                'label' => 'Imágenes',
                'module' => 'default',
                'controller' => 'descarga',
                'action' => 'imagenes',
            ),
            array(
                'label' => 'Videos',
                'module' => 'default',
                'controller' => 'descarga',
                'action' => 'videos',
            ),
            array(
                'label' => 'Fondos de Escritorio',
                'module' => 'default',
                'controller' => 'descarga',
                'action' => 'fondos-escritorio',
            )
        );
    }

}

