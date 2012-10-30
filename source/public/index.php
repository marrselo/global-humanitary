<?php

// Define path to application directory
ini_set('session.auto_start', 0);
error_reporting(E_ALL);
date_default_timezone_set('America/Lima');
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(__DIR__ . '/../application'));


defined('APPLICATION_PUBLIC')
    || define('APPLICATION_PUBLIC', realpath(__DIR__ . '/'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR,
        array(
        realpath(APPLICATION_PATH . '/../library'),
        get_include_path(),
    )));


/** Zend_Application */
require_once 'Zend/Application.php';

class index
{
    /**     
     * 
     * @var Zend_Application
     */
    protected $_application = null;

    /**
     * 
     * @var Boolean
     */
     public static $_runBoostrap = true;

    /**
     *
     * @var array
     */
    protected static $_ini = array('routes.ini','images.ini','private.ini',);

    /**
     *
     * @var string
     */
    protected static $_pathConfig = '/configs/';

    /**
     * 
     * @return Zend_Application
     */
    public static function getApplication()
    {
        $application = new Zend_Application(
                APPLICATION_ENV
        );
        //Zend_Debug::dump($application); exit;
        $applicationini = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", APPLICATION_ENV);
        //Zend_Debug::dump($applicationini);exit;
        $options = $applicationini->toArray();
        //Zend_Debug::dump($options);exit;
        //Zend_Debug::dump(self::$_ini); exit;
        foreach (self::$_ini as $value) {
            $iniFile = APPLICATION_PATH . self::$_pathConfig . $value;
            
            if (is_readable($iniFile)) {
                $config = new Zend_Config_Ini($iniFile);
                $options = $application->mergeOptions($options,
                    $config->toArray());
            } else {
            throw new Zend_Exception('error en la configuracion de los .ini');
            }
        }        
        Zend_Registry::set('config',$options);       
        $application->setOptions($options);           
        return $application;
    }

    public static function getIni()
    {
        return self::$_ini;
    }

    public static function getPath()
    {
        return self::$_pathConfig;
    }

}
if (Index::$_runBoostrap && !defined('CONSOLE')) {
    
    $application = Index::getApplication()->bootstrap();
    
    //Zend_Debug::dump($application); exit;
    $application->run();
    echo "al fin "; 
}
