<?php
/**
 * Init controller
 * User: ssergy
 * Date: 10.01.2011
 * Time: 19:22:44
 *
 */

class Init extends Base
{

    public function __construct()
    {
        parent :: __construct(array());
    }


    public function Run()
    {
        //init Session
        require_once 'ctrl/Security/Session.class.php';
        $mSession = new Security_Session();
        $this->SetClass('mSession', $mSession);

        //init Cache
        /*
        require_once 'libs/Cache/Memcached.class.php';
        $mCache = new Model_Memcached(unserialize(MEMCACHE_SERVER));
        $this->SetClass('mCache', $mCache);
        */
        require_once 'libs/Cache/Filecache.class.php';
        $mCache = new Model_Filecache();
        $this->SetClass('mCache', $mCache);
        
        //init Propel ORM
        require_once 'libs/Propel/lib/Propel.php';
        if (DEBUG)
        {
            //init system logger
            require_once 'model/Logger.class.php';
            Logger::Clear();

            //init propel logger
            require_once 'dev/db/PropelLogger.class.php';
            $mLogger = new PropelLogger();
            Propel::setLogger($mLogger);
        }
        Propel::init(BPATH . "dev/db/build/conf/artistfan-conf.php");
        if (DEBUG)
        {
            //set propel logger params
            $allMethods = array(
              'PropelPDO::__construct',       // logs connection opening
              'PropelPDO::__destruct',        // logs connection close
              'PropelPDO::exec',              // logs a query
              'PropelPDO::query',             // logs a query
              //'PropelPDO::prepare',           // logs the preparation of a statement
              //'PropelPDO::beginTransaction',  // logs a transaction begin
              //'PropelPDO::commit',            // logs a transaction commit
              //'PropelPDO::rollBack',          // logs a transaction rollBack (watch out for the capital 'B')
              'DebugPDOStatement::execute',   // logs a query from a prepared statement
              //'DebugPDOStatement::bindValue'  // logs the value and type for each bind
            );
            $config = Propel::getConfiguration(PropelConfiguration::TYPE_OBJECT);
            $config->setParameter('debugpdo.logging.methods', $allMethods, false);
        }
        Propel::getConnection()->useDebug(DEBUG ? true : false);
        set_include_path(BPATH . "dev/db/build/classes" . PATH_SEPARATOR . get_include_path());
        include_once 'dev/db/Query.class.php';


        //init Smarty
        require 'libs/Smarty/Smarty.class.php';
        $mSmarty                  = new Smarty();
        $mSmarty -> compile_check = true;
        $mSmarty -> debugging     = false;//DEBUG ? true : false;
		if($skin = $mSession->Get('theme')) {
			$mSmarty -> setTemplateDir('dev/'. $skin);
		} else {
        	$mSmarty -> setTemplateDir('dev/skin');
		}
        $mSmarty -> setCompileDir('files/templ/');
        $mSmarty -> setCacheDir('files/cache/');
        $mSmarty -> setConfigDir('dev/templates/conf/');
        $mSmarty -> error_reporting  = E_ALL & ~E_NOTICE/* & ~E_WARNING*/;
        $mSmarty -> setPluginsDir( array(
                'plugins',
                'libs/Smarty/plugins',
                'dev/skin/plugins'
        ));
		
		$mSmarty->assign('SUB_DOMAIN', SUB_DOMAIN);
        $this->SetClass('mSmarty', $mSmarty);
        // init Users
        require_once 'ctrl/Security/User.class.php';
        $mUser = new Security_User( $mSession );
        $mUser->CheckAuth();
        // init other user  
        $mUser->InitOtherUser();
        $this->SetClass('mUser', $mUser);

        $mSmarty->assign('FbApiId', FACEBOOK_API_ID);
        $mSmarty->assign('DOMAIN', DOMAIN);
		
		if (!get_magic_quotes_gpc()) {
			//$mesg = addslashes($mesg);
			array_walk_recursive($_REQUEST, 'addBackSlashes');
		 }
		 

        //start current controller
        require_once 'ctrl/Security/Dispatch.class.php';
        $moDispatch = new Security_Dispatch();
        $moDispatch->Dispatch();
        $moDispatch->Start($this->mlObj);
    }


    /**
     * Run console app
     * @return void
     *
     * Run console
     * console/index.php --classname:methodname
     */
    public function RunConsole()
    {
        //get arguments
        include_once 'dev/ctrl/Security/Console.class.php';
        $args = Security_Console::ParseArgs($_SERVER['argv']);

        //init Memcached
        /*
        require_once GL_PATH.'libs/Memcached.class.php';
        $mCache = new Model_Memcached(unserialize(MEMCACHE_SERVER));
        $this->SetClass('mCache', $mCache);
        */

        //init Propel ORM
        require_once 'libs/Propel/lib/Propel.php';
        if (DEBUG)
        {
            //init system logger
            require_once 'model/Logger.class.php';
            Logger::Clear( $this->GetRootPath() );

            //init propel logger
            require_once 'dev/db/PropelLogger.class.php';
            $mLogger = new PropelLogger( $this->GetRootPath() );
            Propel::setLogger($mLogger);
        }
        Propel::init($this->GetRootPath() . "dev/db/build/conf/artistfan-conf.php");
        if (DEBUG)
        {
            //set propel logger params
            $allMethods = array(
                'PropelPDO::__construct', // logs connection opening
                'PropelPDO::__destruct', // logs connection close
                'PropelPDO::exec', // logs a query
                'PropelPDO::query', // logs a query
                //'PropelPDO::prepare',           // logs the preparation of a statement
                //'PropelPDO::beginTransaction',  // logs a transaction begin
                //'PropelPDO::commit',            // logs a transaction commit
                //'PropelPDO::rollBack',          // logs a transaction rollBack (watch out for the capital 'B')
                'DebugPDOStatement::execute', // logs a query from a prepared statement
                //'DebugPDOStatement::bindValue'  // logs the value and type for each bind
            );
            $config = Propel::getConfiguration(PropelConfiguration::TYPE_OBJECT);
            $config->setParameter('debugpdo.logging.methods', $allMethods, false);
        }
        Propel::getConnection()->useDebug(DEBUG ? true : false);
        set_include_path($this->GetRootPath() . "dev/db/build/classes" . PATH_SEPARATOR . get_include_path());
        include_once 'dev/db/Query.class.php';

        //start current controller
        include_once 'ctrl/Security/Dispatch.class.php';
        $moDispatch = new Security_Dispatch();
        $moDispatch->DispatchConsole( $args );
        $moDispatch->Start( $this->mlObj );
    }

}
?>