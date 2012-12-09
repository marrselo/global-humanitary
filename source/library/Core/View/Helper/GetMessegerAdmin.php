<?php

/**
 * S view Helpers is a Loader for Static files
 * providing ability to read prefix from config 
 * and suffix a versioning query string 
 *
 * @author eanaya
 */
class Core_View_Helper_GetMessegerAdmin extends Zend_View_Helper_Abstract {

    /**
     * @param  String
     * @return string
     */
    public function getMessegerAdmin() {

        $message = new Core_Controller_Action_Helper_FlashMessengerCustom();
        $array = $message->getMessages();
        $arrayClass = array(
            'info' => 'nNote nInformation',
            'success' => 'nNote nSuccess',
            'warning' => 'nNote nWarning',
            'error' => 'nNote nFailure');
        if (count($array) > 0) {
            echo '<div class="box-content alerts">';
            
            foreach ($array as $index) {
                echo'<div class="' . $arrayClass[$index->level] . '">';          
                echo '<p>'.$index->message . '</p>';
                echo'</div>';
            }
            echo '</div>';
        }
    }

}