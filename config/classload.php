<?php session_start();
 require_once 'config.php';
    /*** nullify any existing autoloads ***/
    spl_autoload_register(null, false);

    /*** class Loader ***/
    function classLoader($class)
    {
        $filename = $class.'.class.php';
        $file ='../model/' . $filename;
		//die($file);
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }

    /*** register the loader functions ***/
    spl_autoload_register('classLoader');

?>