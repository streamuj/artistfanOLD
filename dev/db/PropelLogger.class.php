<?php
/**
 * Propel custom logger
 * User: ssergy
 * Date: 06.03.12
 * Time: 10:07
 *
 */

class PropelLogger implements BasicLogger
{
    private $mGlobalPath = '';

    public function __construct( $global_path = '' )
    {
        $this->mGlobalPath = $global_path;
    }

    public function emergency($m)
    {
        $this->log($m, Propel::LOG_EMERG);
    }

    public function alert($m)
    {
        $this->log($m, Propel::LOG_ALERT);
    }

    public function crit($m)
    {
        $this->log($m, Propel::LOG_CRIT);
    }

    public function err($m)
    {
        $this->log($m, Propel::LOG_ERR);
    }

    public function warning($m)
    {
        $this->log($m, Propel::LOG_WARNING);
    }

    public function notice($m)
    {
        $this->log($m, Propel::LOG_NOTICE);
    }

    public function info($m)
    {
        $this->log($m, Propel::LOG_INFO);
    }

    public function debug($m)
    {
        $this->log($m, Propel::LOG_DEBUG);
    }

    public function log($message, $priority = null)
    {
        Logger::Log( $this->priorityToColor($priority).'::'.$message, $this->mGlobalPath );
    }

    private function priorityToColor($priority)
    {
        switch ($priority)
        {
            case Propel::LOG_EMERG:
            case Propel::LOG_ALERT:
            case Propel::LOG_CRIT:
            case Propel::LOG_ERR:
                return 'red';
                break;
            case Propel::LOG_WARNING:
                return 'orange';
                break;
            case Propel::LOG_NOTICE:
                return 'green';
                break;
            case Propel::LOG_INFO:
                return 'blue';
                break;
            case Propel::LOG_DEBUG:
                return 'grey';
                break;
        }
    }
}
?>
