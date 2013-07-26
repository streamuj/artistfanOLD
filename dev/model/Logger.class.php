<?php
/**
 *  Logger class 
 */
 
class Logger
{
    public static function Log( $msg, $global_path = '' )
    {
        $path = ($global_path ? $global_path : BPATH)  . 'files/log.txt';
        
        $file = fopen($path, 'a');
        flock($file, LOCK_EX);
        fputs($file, date('Y-m-d H:i:s') . '] ' . @$_SESSION['system_uid']
               . ' ' . @$_SERVER['REMOTE_ADDR'] . '@' .  @$_SESSION['system_login']
               . ' ' . $msg . "\n");
        fclose($file);
    }

    public static function Clear( $global_path = '' )
    {
        $path = ($global_path ? $global_path : BPATH) . 'files/log.txt';

        if (file_exists($path))
        {
            @unlink( $path );
        }
    }

}
?>