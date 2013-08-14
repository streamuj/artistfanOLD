<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);

$siteDir = dirname(dirname(__FILE__));

//init config
include_once $siteDir.'/dev/config/main.php';

error_reporting(E_ALL);

//init functions
include_once BPATH .'libs/functions.php';

$currentDir = dirname(__FILE__).DS;

define('CLASS_PATH', 'dev/');
ini_set("include_path", ini_get('include_path').PATH_SEPARATOR. BPATH . CLASS_PATH);
require_once BPATH.'libs/Propel/lib/Propel.php';
set_include_path(BPATH . "dev/db/build/classes" . PATH_SEPARATOR . get_include_path());
include_once BPATH.'dev/db/Query.class.php';

require_once(BPATH . "dev/db/build/conf/artistfan-conf.php");

Propel::init(BPATH . "dev/db/build/conf/artistfan-conf.php");
require_once($currentDir.'cronSetting.php');