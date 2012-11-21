<?php
/**
 * Table Banner
 * 
 * @author marrselo
 */
class Application_Model_DbTable_Banner extends Core_Db_Table
{
    protected  $_name = "banner";
    protected  $_primary = "banner_id";
    const IS_PUBLIC = 1;
    const NO_PUBLIC = 0; 

}

