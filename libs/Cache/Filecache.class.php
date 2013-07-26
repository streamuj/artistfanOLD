<?php
class Model_Filecache
{
    private $mTime = 180;//Cache life time in seconds
    private $mPath;

    public function __construct($cache_path = '')
    {
        if (!empty($cache_path))
        {
            $this -> mPath = $cache_path;
            
        }
        else
        {
            $this -> mPath = BPATH . 'files/';
        }
        if (!file_exists($this -> mPath . "scache/"))
        {
            mkdir($this -> mPath . 'scache');
            chmod($this -> mPath . 'scache', 0777);
        }
    }

    public function get($block, $lifetime = 0)
    {
        $lifetime = ($lifetime ? $lifetime : $this -> mTime);
        $res = '';
        if (file_exists($this -> mPath . "scache/" . $block . '.cache'))
        {
            $stat = stat($this -> mPath . "scache/" . $block . '.cache');
            if ($stat[9] > (mktime() - $lifetime))
            {
                $res = @file_get_contents($this -> mPath . "scache/" . $block . '.cache');
            }
        }
        return $res;
    }/** Get */


    public function set($block, $btext, $lifetime = 0)
    {
        $fw=fopen($this -> mPath . "scache/" . $block . '.cache', "wt");
        flock($fw, LOCK_EX);
        fputs($fw, $btext);
        fclose($fw);
        return true;
    }/** Set */
}
?>