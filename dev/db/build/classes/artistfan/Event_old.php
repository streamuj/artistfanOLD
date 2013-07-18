<?php



/**
 * Skeleton subclass for representing a row from the 'event' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Event extends BaseEvent {

    /**
     * Get event by Id
     * @param int $id - Event ID
     * @param int $user_id - User Id
     * @param int $artist_info - 1 or 0
     **/
    public static function GetEvent( $id, $user_id = 0, $artist_info = 0 )
    {
    	$event = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
    	      'Location', 'EventDate', 'Code', 'Pdate', 'Deleted'))
    	       ->filterById($id);
        if ($user_id)
        {
        	$event = $event->filterByUserId($user_id);
        }
        if($artist_info)
        {
            $event = $event->leftJoin('User u')->withColumn('u.Name', 'Name')->withColumn('u.BandName', 'BandName')
                    ->withColumn('u.FirstName', 'FirstName')->withColumn('u.LastName', 'LastName');
        }
        return $event->findOne();
    }

    /**
     * Get event by Code
     * @param int $code - Event Code
     **/
    public static function GetEventByCode( $code, $user_info = 0 )
    {
    	$event = EventQuery::create() ->select(array('Id'))
    	       ->filterByCode($code);
        if($user_info)
        {
            $event = $event->withColumn('user_id', 'UserId');
        }
        $event = $event->findOne();

        return $event;
    }


    /**
     * Get events count 
     * @param int $user_id - User ID
     */ 
    public function EventsCount( $user_id, $periods = array() )
    {
        $events = EventQuery::create() ->select('Id');
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        return $events->count();
    }

     
    /**
     * Get events list 
     * @param int $user_id - User ID
     */ 
    public static function EventsList( $user_id, $page = 0, $items_on_page = 0, $periods = array(), $types = array(), $statuses = array(), $mCache = '' )
    {
        //get from cache
        if (!empty($mCache))
        {
            $events = $mCache->get('events_onwall' . $user_id, 12*3600);
            if (!empty($events))
            {
                return @unserialize($events);
            }
        }
        
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'Pdate', 'Deleted'));
        
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }
        if(!empty($types))
        {
            $events = $events->filterByEventType($types, Criteria::IN);
        }
        if(!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
        
        $events=$events->filterByDeleted(0)->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
        $events = $events->find()->toArray();
        
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('events_onwall' . $user_id, serialize($events), 12*3600);
        }

        return $events;
    }

    /**
     * Get attend and purchase events count
     * @param int $user_id
     * @param int $user_attend_id
     * @param array $periods
     */
    public function EventsAttendAndPurchasedCount( $user_id, $user_attend_id, $periods = array() )
    {
        $events = EventQuery::create() ->select('Id')
                ->leftJoin('EventAttend')->addJoinCondition('EventAttend', 'EventAttend.UserId = ' . (int)$user_attend_id)
                ->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$user_attend_id)
                ->where('(EventAttend.UserId = ' . (int)$user_attend_id . ' OR ' . 'EventPurchase.UserId = ' . (int)$user_attend_id . ')');
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        return $events->count();
    }

    /**
     * Get attend and purchase events list
     * @param int $user_id - User ID
     * @param int $user_attend_id
     * @param int $page
     * @param int $items_on_page
     * @param array $periods
     */
    public static function EventsAttendAndPurchasedList( $user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $statuses = array() )
    {
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'Pdate', 'Deleted', 'EventAttend.Id', 'EventPurchase.Id'))
                ->leftJoin('EventAttend')->addJoinCondition('EventAttend', 'EventAttend.UserId = ' . (int)$user_attend_id)
                ->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$user_attend_id)
                ->where('(EventAttend.UserId = ' . (int)$user_attend_id . ' OR ' . 'EventPurchase.UserId = ' . (int)$user_attend_id . ')');
				
				

        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }

        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }
        return $events->find()->toArray();
    }

    /**
     * Get events list with attend and purchase
     * @param int $user_id - User ID
     */
    public static function EventsWithAttendAndPurchasedList( $user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $statuses = array() )
    {
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'Pdate', 'Deleted'/*, 'EventAttend.Id', 'EventPurchase.Id'*/))
                /*->leftJoinEventAttend()
                ->addJoinCondition('EventAttend', 'EventAttend.UserId = '. $user_attend_id)
                ->leftJoinEventPurchase()
                ->addJoinCondition('EventPurchase', 'EventPurchase.UserId = '. $user_attend_id)*/
                ->filterByDeleted(0);





        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }
        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }

        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }

        $events = $events->find()->toArray();

        $ids = array();
        foreach($events as $item)
        {
            $ids[] = $item['Id'];
        }
        unset($item);
        if(!empty($ids))
        {
            $ae = EventAttendQuery::create()->select(array('Id', 'EventId'))
                    ->filterByUserId($user_attend_id)->filterByEventId($ids, Criteria::IN)
                    ->find()->toArray();
            $attended =array();
            foreach($ae as $item)
            {
                $attended[$item['EventId']] = $item['Id'];
            }
            unset($item);
            unset($ae);
            $pe = EventPurchaseQuery::create()->select(array('Id', 'EventId'))
                    ->filterByUserId($user_attend_id)->filterByEventId($ids, Criteria::IN)
                    ->find()->toArray();
            $purchased =array();
            foreach($pe as $item)
            {
                $purchased[$item['EventId']] = $item['Id'];
            }
            unset($item);
            unset($pe);
            foreach($events as &$item)
            {
                $item['EventAttend.Id'] = !empty($attended[$item['Id']]) ? $attended[$item['Id']] : 0;
                $item['EventPurchase.Id'] = !empty($purchased[$item['Id']]) ? $purchased[$item['Id']] : 0;
            }
            unset($item);
            unset($attended);
            unset($purchased);
        }
        return $events;
    }

    /**
     * Get events to close
     */
    public static function EventsToCloseList( $limit = 1 )
    {
        $date = mktime() - 3*3600;

        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Price', 'Status', 'EventDate', 'Code'))
                -> filterByStatus(3, Criteria::LESS_THAN)
                -> filterByEventDate(date("Y-m-d H:i:s", $date), Criteria::LESS_EQUAL)
                -> filterByEventType(1, Criteria::NOT_EQUAL)
                -> limit($limit) -> find() -> toArray();

        return $events;
    }

    /**
     * Delete artist's events
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserContent( $user_id )
    {
        //EventQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Get events list for admin panel
     * @return array
     */
    public function AdminEventList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $events = EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Location', 'EventDate',
                        'Status', 'Deleted', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
                -> leftJoin('User u');

        if($filter)
        {
            $events = $events->where($filter);
        }
        $result['rcnt'] = $events -> count();
        $events = $events->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);

        $events = $events->orderByPdate('DESC')->find()->toArray();

        $result['list'] = $events;

        return $result;
    }

    /**
     * Delete event
     * @param int $id
     * @return bool
     */
    public static function DeleteEvent( $id )
    {
        EventQuery::create()->select(array('Id'))->filterById($id)->delete();
        return true;
    }

    /**
     * Get list of finished events with paurchased access by user $user_purchase_id
     * @param int $user_purchase_id
     * @return array
     */
    public static function FinishedEventsPurchasedList( $user_purchase_id)
    {
        $events = EventPurchaseQuery::create() ->select(array('EventId'))
                -> filterByUserId($user_purchase_id);
        
        return $events->find()->toArray();
    }

    public static function GetPeriod( $type )
    {
        $from = 0;
        $to   = 0;
        switch ($type)
        {
            //today
            case 'td':
                //from today 00:00 to today 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $to   = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
                break;
            //this weekend
            case 'twd':
                //from this saturday 00:00 to sunday 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) + (6-date("w"))*24*3600;
                $to   = $from + 2*24*3600 - 1;
                break;
            //this week
            case 'tw':
                //first day of week (from sunday 00:00  to sunday 23:59)
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - date("w")*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //next week
            case 'nw':
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - date("w")*24*3600 + 7*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //this month
            case 'tm':
                $from = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $to   = mktime(0, 0, 0, date("m")+1, 1, date("Y")) - 1;
                break;

            //next month
            case 'nm':
                $from = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
                $to = mktime(0, 0, 0, date("m") + 2, 1, date("Y")) - 1;
                break;
        }
        return array( 'from' => $from ? date("Y-m-d H:i:s", $from) : '', 'to' => $to ? date("Y-m-d H:i:s", $to) : '' );
    }

} // Event

<?php



/**
 * Skeleton subclass for representing a row from the 'event' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Event extends BaseEvent {

    /**
     * Get event by Id
     * @param int $id - Event ID
     * @param int $user_id - User Id
     * @param int $artist_info - 1 or 0
     **/
    public static function GetEvent( $id, $user_id = 0, $artist_info = 0 )
    {
    	$event = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
    	      'Location', 'EventDate', 'Code', 'TicketUrl','Pdate', 'Deleted'))
    	       ->filterById($id);
        if ($user_id)
        {
        	$event = $event->filterByUserId($user_id);
        }
        if($artist_info)
        {
            $event = $event->leftJoin('User u')->withColumn('u.Name', 'Name')->withColumn('u.BandName', 'BandName')
                    ->withColumn('u.FirstName', 'FirstName')->withColumn('u.LastName', 'LastName');
        }
        return $event->findOne();
    }

    /**
     * Get event by Code
     * @param int $code - Event Code
     **/
    public static function GetEventByCode( $code, $user_info = 0 )
    {
    	$event = EventQuery::create() ->select(array('Id'))
    	       ->filterByCode($code);
        if($user_info)
        {
            $event = $event->withColumn('user_id', 'UserId');
        }
        $event = $event->findOne();

        return $event;
    }


    /**
     * Get events count 
     * @param int $user_id - User ID
     */ 
    public function EventsCount( $user_id, $periods = array() )
    {
        $events = EventQuery::create() ->select('Id');
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        return $events->count();
    }

     
    /**
     * Get events list 
     * @param int $user_id - User ID
     */ 
    public static function EventsList( $user_id, $page = 0, $items_on_page = 0, $periods = array(), $types = array(), $statuses = array(), $mCache = '' )
    {
        //get from cache
        if (!empty($mCache))
        {
            $events = $mCache->get('events_onwall' . $user_id, 12*3600);
            if (!empty($events))
            {
                return @unserialize($events);
            }
        }
        
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'TicketUrl', 'Pdate', 'Deleted'));
        
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }
        if(!empty($types))
        {
            $events = $events->filterByEventType($types, Criteria::IN);
        }
        if(!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
        
        $events=$events->filterByDeleted(0)->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
        $events = $events->find()->toArray();
        
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('events_onwall' . $user_id, serialize($events), 12*3600);
        }

        return $events;
    }

    /**
     * Get attend and purchase events count
     * @param int $user_id
     * @param int $user_attend_id
     * @param array $periods
     */
    public function EventsAttendAndPurchasedCount( $user_id, $user_attend_id, $periods = array() )
    {
        $events = EventQuery::create() ->select('Id')
                ->leftJoin('EventAttend')->addJoinCondition('EventAttend', 'EventAttend.UserId = ' . (int)$user_attend_id)
                ->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$user_attend_id)
                ->where('(EventAttend.UserId = ' . (int)$user_attend_id . ' OR ' . 'EventPurchase.UserId = ' . (int)$user_attend_id . ')');
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        return $events->count();
    }

    /**
     * Get attend and purchase events list
     * @param int $user_id - User ID
     * @param int $user_attend_id
     * @param int $page
     * @param int $items_on_page
     * @param array $periods
     */
    public static function EventsAttendAndPurchasedList( $user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $statuses = array() )
    {
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'TicketUrl','Pdate', 'Deleted', 'EventAttend.Id', 'EventPurchase.Id'))
                ->leftJoin('EventAttend')->addJoinCondition('EventAttend', 'EventAttend.UserId = ' . (int)$user_attend_id)
                ->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$user_attend_id)
                ->where('(EventAttend.UserId = ' . (int)$user_attend_id . ' OR ' . 'EventPurchase.UserId = ' . (int)$user_attend_id . ')');

        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }

        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }
        return $events->find()->toArray();
    }

    /**
     * Get events list with attend and purchase
     * @param int $user_id - User ID
     */
    public static function EventsWithAttendAndPurchasedList( $user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $statuses = array() )
    {
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'TicketUrl' ,'Pdate', 'Deleted'/*, 'EventAttend.Id', 'EventPurchase.Id'*/))
                /*->leftJoinEventAttend()
                ->addJoinCondition('EventAttend', 'EventAttend.UserId = '. $user_attend_id)
                ->leftJoinEventPurchase()
                ->addJoinCondition('EventPurchase', 'EventPurchase.UserId = '. $user_attend_id)*/
                ->filterByDeleted(0);

        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }
        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }

        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }

        $events = $events->find()->toArray();

        $ids = array();
        foreach($events as $item)
        {
            $ids[] = $item['Id'];
        }
        unset($item);
        if(!empty($ids))
        {
            $ae = EventAttendQuery::create()->select(array('Id', 'EventId'))
                    ->filterByUserId($user_attend_id)->filterByEventId($ids, Criteria::IN)
                    ->find()->toArray();
            $attended =array();
            foreach($ae as $item)
            {
                $attended[$item['EventId']] = $item['Id'];
            }
            unset($item);
            unset($ae);
            $pe = EventPurchaseQuery::create()->select(array('Id', 'EventId'))
                    ->filterByUserId($user_attend_id)->filterByEventId($ids, Criteria::IN)
                    ->find()->toArray();
            $purchased =array();
            foreach($pe as $item)
            {
                $purchased[$item['EventId']] = $item['Id'];
            }
            unset($item);
            unset($pe);
            foreach($events as &$item)
            {
                $item['EventAttend.Id'] = !empty($attended[$item['Id']]) ? $attended[$item['Id']] : 0;
                $item['EventPurchase.Id'] = !empty($purchased[$item['Id']]) ? $purchased[$item['Id']] : 0;
            }
            unset($item);
            unset($attended);
            unset($purchased);
        }
        return $events;
    }

    /**
     * Get events to close
     */
    public static function EventsToCloseList( $limit = 1 )
    {
        $date = mktime() - 3*3600;

        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Price', 'Status', 'EventDate', 'Code'))
                -> filterByStatus(3, Criteria::LESS_THAN)
                -> filterByEventDate(date("Y-m-d H:i:s", $date), Criteria::LESS_EQUAL)
                -> filterByEventType(1, Criteria::NOT_EQUAL)
                -> limit($limit) -> find() -> toArray();

        return $events;
    }

    /**
     * Delete artist's events
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserContent( $user_id )
    {
        //EventQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Get events list for admin panel
     * @return array
     */
    public function AdminEventList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $events = EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Location', 'EventDate',
                        'Status', 'Deleted', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
                -> leftJoin('User u');

        if($filter)
        {
            $events = $events->where($filter);
        }
        $result['rcnt'] = $events -> count();
        $events = $events->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);

        $events = $events->orderByPdate('DESC')->find()->toArray();

        $result['list'] = $events;

        return $result;
    }

    /**
     * Delete event
     * @param int $id
     * @return bool
     */
    public static function DeleteEvent( $id )
    {
        EventQuery::create()->select(array('Id'))->filterById($id)->delete();
        return true;
    }

    /**
     * Get list of finished events with paurchased access by user $user_purchase_id
     * @param int $user_purchase_id
     * @return array
     */
    public static function FinishedEventsPurchasedList( $user_purchase_id)
    {
        $events = EventPurchaseQuery::create() ->select(array('EventId'))
                -> filterByUserId($user_purchase_id);
        
        return $events->find()->toArray();
    }

    public static function GetPeriod( $type )
    {
        $from = 0;
        $to   = 0;
        switch ($type)
        {
            //today
            case 'td':
                //from today 00:00 to today 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $to   = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
                break;
            //this weekend
            case 'twd':
                //from this saturday 00:00 to sunday 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) + (6-date("w"))*24*3600;
                $to   = $from + 2*24*3600 - 1;
                break;
            //this week
            case 'tw':
                //first day of week (from sunday 00:00  to sunday 23:59)
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - date("w")*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //next week
            case 'nw':
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y")) - date("w")*24*3600 + 7*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //this month
            case 'tm':
                $from = mktime(0, 0, 0, date("m"), 1, date("Y"));
                $to   = mktime(0, 0, 0, date("m")+1, 1, date("Y")) - 1;
                break;

            //next month
            case 'nm':
                $from = mktime(0, 0, 0, date("m") + 1, 1, date("Y"));
                $to = mktime(0, 0, 0, date("m") + 2, 1, date("Y")) - 1;
                break;
        }
        return array( 'from' => $from ? date("Y-m-d H:i:s", $from) : '', 'to' => $to ? date("Y-m-d H:i:s", $to) : '' );
    }

} // Event

