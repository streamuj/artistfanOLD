<?php
/**
 * Простой класс для работы с Memcached
 */
class Model_Memcached
{

    private $_connected = false;
    private $_Memcache = null;
    public $servers = array(); // you can add more servers by adding their hostname and port to this array. if port is default (11211), it can be omitted.

    public function __construct($servers = array())
    {
        if (!empty($servers))
        {
            $this->servers = $servers;
            $this->_connect();
        }
        /**
         * задержка для Memcached
         */
        define('MEMQ_TTL', 0);
    }

    /**
     * Connect to the memcached server(s)
     */
    public function _connect()
    {
        if (!defined('CLEAR_CACHE'))
            if (defined('CAT_DISABLE_CACHE')
                || !is_array($this->servers)
                || 0 == count($this->servers)
            )
            {
                return false;
            }

        $this->_Memcache = new Memcache();
        // several servers - use addServer
        foreach ($this->servers as $server)
        {
            $parts = explode(':', $server);

            $host = $parts[0];
            $port = isset($parts[1]) ? $parts[1] : 11211; // default port

            if ($this->_Memcache->addServer($host, $port))
            {
                $this->_connected = true;
            }
        }

        return $this->_connected;
    }

    /**
     * Set a value in the cache
     *
     * Expiration time is one hour if not set
     */
    public function set($key, $var, $expires = 360)
    {
        if (defined('DISABLE_CACHE') || !$this->_connected)
        {
            return false;
        }

        if (!is_numeric($expires))
        {
            $expires = strtotime($expires);
        }
        if ($expires < 1)
        {
            $expires = 1; // don't allow caching infinitely
        }

        return $this->_Memcache->set($key, $var, 0, time() + $expires);
    }

    public function set_arr($key, $arr, $expires = 360)
    {
        $arr = serialize($arr);
        return
                $this->set($key, $arr, $expires);
    }

    public function get_arr($key, &$ret)
    {
        if ($data = $this->get($key))
        {
            if (strlen($data) > 0)
                $ret = unserialize($data);
            return true;
        }
        else
            return false;
    }

    /**
     * Get a value from cache
     */
    public function get($key)
    {
        if (defined('DISABLE_CACHE') || !$this->_connected)
        {
            return false;
        }

        return $this->_Memcache->get($key);
    }

    /**
     * Remove value from cache
     */
    public function delete($key)
    {
        if (defined('DISABLE_CACHE') || !$this->_connected)
        {
            return false;
        }

        return $this->_Memcache->delete($key, 0);
    }


    public function Flush()
    {
        return $this->_Memcache->flush();
    }


    public function is_empty($queue)
    {
        $head = $this->_Memcache->get($queue . "_head");
        $tail = $this->_Memcache->get($queue . "_tail");

        if ($head >= $tail || $head === FALSE || $tail === FALSE)
            return TRUE;
        else
            return FALSE;
    }


    public function dequeue($queue, $after_id = FALSE, $till_id = FALSE)
    {

        $head = $this->_Memcache->get($queue . "_head");
        $tail = $this->_Memcache->get($queue . "_tail");

        if ($head === FALSE || $tail === FALSE)
        {
            return FALSE;
        }

        $ret = $this->_Memcache->get($queue . "_" . $head);

        //echo $head.' -- '.$tail.' '.$ret.' <br />';

        if ($head == $tail)
        {
            $this->_Memcache->delete($queue . "_head", 0);
            $this->_Memcache->delete($queue . "_tail", 0);
        }

        if ($ret != FALSE)
        {
            $this->_Memcache->increment($queue . "_head");
            $this->_Memcache->delete($queue . "_" . $head, 0);
        }
        return $ret;

    }


    public function enqueue($queue, $item)
    {

        $id = $this->_Memcache->increment($queue . "_tail");
        if ($id === FALSE)
        {
            if ($this->_Memcache->add($queue . "_tail", 1, MEMQ_TTL) === FALSE)
            {
                $id = $this->_Memcache->increment($queue . "_tail");
                if ($id === FALSE)
                    return FALSE;
            }
            else
            {
                $id = 1;
                $this->_Memcache->add($queue . "_head", $id, MEMQ_TTL);
            }
        }

        if ($this->_Memcache->add($queue . "_" . $id, $item, MEMQ_TTL) === FALSE)
            return FALSE;

        return $id;
    }

}

?>
