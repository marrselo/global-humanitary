<?php

// Define path to application directory

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
    protected static $_ini = array('routes.ini', 'private.ini','images.ini');

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

        $applicationini = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", APPLICATION_ENV);

        $options = $applicationini->toArray();
                
        foreach (self::$_ini as $value) {
            $iniFile = APPLICATION_PATH . self::$_pathConfig . $value;
            if (is_readable($iniFile)) {
                $config = new Zend_Config_Ini($iniFile);
                $options = $application->mergeOptions($options,
                    $config->toArray());
            }
        }

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
    $application->run();
}