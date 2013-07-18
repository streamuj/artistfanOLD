<?php
/**
 * Base Dispatcher class
 *
 * @package    Hotels
 * @version    1.0
 * @since      01.02.2009
 * @copyright  2009 FiveDev
 * @link       http://fivedev.ru
 */
class Security_Dispatch
{
    public $mAdmp;
    public $mType;
    public $mModule;
    public $mWhat;




    public function __construct()
    {

    }


    public function __get($name)
    {

        if (isset($this->$name))
        {
            return $this->$name;
        }
        else
        {
            $r = 0;
            return $r;
        }
    }


    /**
     * make path from some url, ex: /security/users/showlist/
     *
     * @param string $std
     * @return bool true
     */
    public function Dispatch()
    {
        $std = $_SERVER['REQUEST_URI'];

        if (!empty($std))
        {
            $std = substr($std, 1, strlen($std));
        }

        $s = '';
        if (!empty($std))
        {
            $std = str_replace('&', '?', $std);
            if (0 < strpos('_' . $std, '?'))
            {
                $std = substr($std, 0, strpos($std, '?'));
            }

            $ul = explode('/', $std);
            $k = 0;
            for ($i = 0; $i < count($ul); $i++)
            {
                if ($ul[$i] == 'siteadmin')
                {
                    $this->mAdmp = 1;
                    continue;
                }
                elseif (!empty($ul[$i]) && preg_match('/^[0-9a-z]+$/i', $ul[$i]))
                {
                    switch ($k)
                    {
                        case 0:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this->mType = $ul[$i];
                            break;

                        case 1:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this->mModule = $ul[$i];
                            break;

                        case 2:
                            $ul[$i][0] = strtoupper($ul[$i][0]);
                            $this->mWhat = $ul[$i];
                            break;
                    }
                }
                if (2 < $k)
                {
                    break;
                }
                $k++;
            }
        }

        if (!empty($_REQUEST['type']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['type']))
        {
            $_REQUEST['type'][0] = strtoupper($_REQUEST['type'][0]);
            $this->mType = $_REQUEST['type'];

            if (!empty($_REQUEST['mod']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['mod']))
            {
                $_REQUEST['mod'][0] = strtoupper($_REQUEST['mod'][0]);

                $this->mModule = $_REQUEST['mod'];
                if (!empty($_REQUEST['what']) && preg_match('/^[0-9a-z]+$/i', $_REQUEST['what']))
                {
                    $_REQUEST['what'][0] = strtoupper($_REQUEST['what'][0]);
                    $this->mWhat = $_REQUEST['what'];
                }
            }
        }
        return $s;
    }


    /**
     * Init class
     * @param $glObj
     * @return bool
     */
    public function Start(&$glObj)
    {
        //Show module
        $start = 0;
        if ($this->mType && $this->mModule)
        {
            if (file_exists(BPATH . CLASS_PATH . 'ctrl/' . $this->mType . '/' . $this->mModule . '.class.php')
               || (defined('GL_PATH') && file_exists(GL_PATH . CLASS_PATH . 'ctrl/' . $this->mType . '/' . $this->mModule . '.class.php'))
               )
            {
                /** init module - if exits */
                include_once 'ctrl/' . $this->mType . '/' . $this->mModule . '.class.php';

                $v = $this->mType . '_' . $this->mModule;
                $moCur = new $v($glObj);

                if (!$this->mWhat || !method_exists($moCur, $this->mWhat))
                {
                    if(!$this->mWhat)
                    {
                        $what = $this->mAdmp ? 'Indexadmin' : 'Index';
                    }
                    else
                    {
                        //include_once 'ctrl/Base/Index.class.php';
                        //$moCur = new Base_Index($glObj);
                        $what = 'NotFound';
                    }
                    if (!method_exists($moCur, $what))
                    {
                        $what = 'NotFound';
                    }
                }
                else
                {
                    $what = $this->mWhat;
                }
                if ($what)
                {
                    $moCur->$what();
                }
                return true;
            }
        }

        if (!$start)
        {
            include_once 'ctrl/Base/Index.class.php';
            $moCur = new Base_Index( $glObj );
            $what = $this->mAdmp ? 'Indexadmin' : 'Index';
            if($this->mType || $this->mModule || (!empty($_SERVER['REQUEST_URI']) && substr($_SERVER['REQUEST_URI'], 1) != '' && substr($_SERVER['REQUEST_URI'], 1, 1) != '?'))
            {
                $what = 'NotFound';
            }
            if (!method_exists($moCur, $what))
            {
                $what = '';
            }
            
            if ($what)
            {
                $moCur->$what();
            }
        }

        return false;
    }


    /**
     * Dispatch console command
     * @param $args
     * @return void
     */
    public function DispatchConsole($args)
    {
        list($key, $val) = each($args);
        
        if (strpos($key, ':'))
        {
            $items = explode(':', ToLower($key));
            if (2 == count($items) && !empty($items[0]) && !empty($items[1]))
            {
                $this->mType = 'Base';
                $items[0][0] = strtoupper( $items[0][0] );
                $this->mModule = $items[0];
                $this->mWhat = $items[1];
            }
        }
        return true;
    }




}