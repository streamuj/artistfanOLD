<?php
/**
 * Return current flow name by event id (base flow name)
 * if current flow is not set or updated earlier than 60 seconds ago return '0'
 * require parameter-flag to define - to update time in cache or do not
 */
//init config
include_once 'dev/config/main.php';
//cache class
require_once 'libs/Cache/Filecache.class.php';
$mCache = new Model_Filecache();

$event_id = isset($_REQUEST['id']) ? trim(strip_tags($_REQUEST['id'])) : '';
$flow = '0';

if(!empty($event_id))
{
    /*if ($event_id[0]=='u')
    {
        $event_id = substr($event_id, 1);
    }*/
    $cache = $mCache->get('broadcast_' . $event_id, 4 * 3600); //get from cache current flow and last time
    if(!empty($cache))
    {
        $cache = unserialize($cache);
        $flow = $cache['flow'];
        $time = $cache['time'];
		$recording = $cache['recording'];
    }
    if(!empty($flow) && !empty($time) && $time > mktime()-60 && !empty($_REQUEST['tm']))
    {
        $mCache->set('broadcast_' . $event_id, serialize(array('flow' => $flow, 'recording'=>$recording, 'time' => mktime())), 4 * 3600);
    }
}
echo $flow;
exit();