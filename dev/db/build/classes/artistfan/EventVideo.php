<?php



/**
 * Skeleton subclass for representing a row from the 'event_video' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class EventVideo extends BaseEventVideo {
    /**
     * Add downloaded recording of broadcast
     * @param int $user_id
     * @param int $event_id
     * @param int $video
     * @param int $pdate (create video date)
     * @return bool
     */
    public static function Add( $video, $user_id, $event_id, $pdate)
    {
		if(EventVideo::checkVideoExist($video)){
			return true;
		}
        $order = EventVideo::GetEventVideoCount($user_id, $event_id);
        $order++;
        $ve = new EventVideo();
        $ve->setEventId($event_id);
        $ve->setUserId($user_id);
        $ve->setVideo($video);
        $ve->setOrder($order);
        $ve->setPdate($pdate);
        $ve->save();

        return true;
    }
	
	public static function checkVideoExist($video)
	{
		$count = EventVideoQuery::create()->select(array('Id'))->filterByVideo($video)->count();
		return $count;
	}

    /**
     * Return count of videos files of event
     * @param int $user_id
     * @param int $event_id
     * @return int
     */
    public static function GetEventVideoCount( $user_id, $event_id )
    {
        $count = EventVideoQuery::create()->select(array('Id'))->filterByEventId($event_id)->filterByUserId($user_id)
                -> count();
        return $count;
    }

    /**
     * Return count of event recordings
     * @param int $user_id
     * @return int
     */
    public static function GetEventsRecordingsCount( $user_id )
    {
		$dend = mktime(0, 0, 0, date('m'), date('d')-30, date('Y'));
    
	    $count = EventVideoQuery::create()->select(array('Id'))->filterByUserId($user_id)
                ->filterByPdate($dend, Criteria::GREATER_EQUAL)-> count();
    
	    return $count;
    }

    /**
     * Get list of broadcast recordings
     * @param int $user_id
     * @param array $events_ids
     * @param int $items_on_page
     * @param int $page
     * @return array
     */
    public static function GetListEventsRecordings( $user_id = 0, $event_ids = array(), $items_on_page = 0, $page = 0)
    {
        $list = EventVideoQuery::create()->select(array('Id', 'EventId', 'UserId', 'Video', 'Order', 'Pdate', 'e.Title', 'e.EventDate'))
                ->leftJoin('Event e');
        if($user_id)
        {
            $list = $list->filterByUserId($user_id);
        }
        if(!empty($event_ids))
        {
            $list = $list->filterByEventId($event_ids, Criteria::IN);
        }
		//recorded from past 30 days
        $dend = mktime(0, 0, 0, date('m'), date('d')-30, date('Y'));
	    $list = $list->filterByPdate($dend, Criteria::GREATER_EQUAL);
				
        if($items_on_page)
        {
            $list = $list->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }
        $list = $list->orderBy('e.EventDate', 'DESC')->orderBy('Order', 'ASC')
                ->find()->toArray();
        return $list;
    }

    /**
     * Get video files list of one broadcast event
     * @param int $event_id
     * @return array
     */
    public static function GetListEventVideo( $event_id )
    {
        $list = EventVideoQuery::create()->select(array('Id', 'EventId', 'UserId', 'Video', 'Order', 'Pdate'))
                ->filterByEventId($event_id)
                ->orderBy('Order', 'ASC')
                ->find()->toArray();

        return $list;
    }
	
	public static function GetEventVideoById($id, $user_id=0)
	{
		$list = EventVideoQuery::create()->select(array('Id', 'EventId', 'UserId', 'Video', 'Order', 'Pdate', 'e.Title', 'e.EventDate'))
                ->leftJoin('Event e')
                ->filterById($id);
				
		if($user_id)
        {
            $list = $list->filterByUserId($user_id);
        }
        $list = $list->findOne();

        return $list;
	}

    /**
     * Get broadcast recording by Id
     * @param int $id
     * @param int $artist_info
     * @return array
     */
    public static function Get($id, $artist_info = 0)
    {
        $video = EventVideoQuery::create()->select(array('Id', 'EventId', 'UserId', 'Video', 'Order', 'Pdate'))
                ->innerJoin('Event e')
                ->withColumn('e.Title', 'Title')
                ->filterById($id)->findOne();
        if(!empty($video))
        {
            /*$video['Video'] = 'http://' . INFLUXIS_FTP_HOST . '/video/' . $video['UserId'] . '/' . $video['Video'];*/
            if($video['Order'] > 1)
            {
                $video['Title'] = $video['Title'] . ' - Part ' . $video['Order'];
            }
            if(!empty($artist_info))
            {
                $artist = User::GetUserName($video['UserId']);
                if(!empty($artist))
                {
                    $video['FirstName'] = $artist['FirstName'];
                    $video['LastName'] = $artist['LastName'];
                    $video['Name'] = $artist['Name'];
                    $video['BandName'] = $artist['BandName'];
                }
            }
        }
        return $video;
    }

} // EventVideo
