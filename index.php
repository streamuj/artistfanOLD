<?php
/**
 * Main project index
 * User: ssergy
 * Date: 05.12.2011
 * Time: 23:57:12
 *
 */

error_reporting(2047);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

//init config
include_once 'dev/config/main.php';

//init functions
include_once 'libs/functions.php';

//init path
if (!defined("PATH_SEPARATOR"))
{
    define("PATH_SEPARATOR", getenv("COMSPEC") ? ";" : ":");
}

define('CLASS_PATH', '/dev/');
ini_set("include_path", ini_get('include_path').PATH_SEPARATOR. PATH_SEPARATOR . BPATH . CLASS_PATH);

//init Main part
include_once 'ctrl/Base.class.php';
include_once 'ctrl/Init.class.php';

$gInit = new Init();
$gInit->Run();
?>