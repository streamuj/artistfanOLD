<?php
/**
 * Session class
 * User: ssergy
 * Date: 09.12.11
 * Time: 17:31
 *
 */

class Security_Session
{
    public function __construct()
    {
        // Session config and initialization
        session_save_path(BPATH . 'files/sessions');
        session_name(SESSION_NAME);

        //session_set_cookie_params(900, '/', '.'.DOMAIN, true);

        ini_set('session.use_trans_sid', '0');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_domain', '.' . DOMAIN);

        if (!empty($_REQUEST[SESSION_NAME]))
        {
            session_id($_REQUEST[SESSION_NAME]);
        }

        session_start(); // Start session

        if (isset($_COOKIE[SESSION_NAME]))
        {
            setcookie(SESSION_NAME, $_COOKIE[SESSION_NAME], mktime() + 180000, PATH_ROOT, '.' . DOMAIN);
        }
    }


    /**
     * Get item from session
     * @param $var
     * @return value or bool
     */
    public function Get($var)
    {
        if (isset($_SESSION[$var]))
        {
            return $_SESSION[$var];
        }
        else
        {
            return false;
        }
    }


    /**
     * Save item to session
     * @param $var
     * @param $val
     * @return bool
     */
    public function Set($var, $val)
    {
        $_SESSION[$var] = $val;
        return true;
    }


    /**
     * Delete session
     * @param $var
     * @return bool
     */
    public function Del($var)
    {
        if (isset($_SESSION[$var]))
        {
            unset($_SESSION[$var]);
        }
        return true;
    }


    public function SetCookie($var, $val, $time = 0)
    {
        $time = empty($time) ? mktime() + 365 * 24 * 3600 : $time;

        setcookie($var, $val, $time, PATH_ROOT, '.' . DOMAIN);
    }

    public function GetCookie($var)
    {
        return isset($_COOKIE[$var]) ? $_COOKIE[$var] : '';
    }


    public function DelCookie($var)
    {
        setcookie($var, 0, mktime() - 60, PATH_ROOT, '.' . DOMAIN);
    }
}
