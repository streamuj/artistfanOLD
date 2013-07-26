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
    	      'Location', 'EventDate', 'Code', 'TicketUrl','Pdate', 'Deleted','EventPhoto', 'Duration', 'EventApp'))
    	       ->filterById($id);
        if ($user_id)
        {
        	$event = $event->filterByUserId($user_id);
        }
        if($artist_info)
        {
            $event = $event->leftJoin('User u')->withColumn('u.Name', 'Name')->withColumn('u.BandName', 'BandName')
                    ->withColumn('u.FirstName', 'FirstName')->withColumn('u.LastName', 'LastName')->withColumn('u.Email', 'Email');
        }
        return $event->findOne();
    }
	
	/*Get Featured event*/
	
	public static function GetFeaturedEvent($limit)
    {
    	$event = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
    	      'Location', 'EventDate', 'Code', 'TicketUrl','Pdate', 'Deleted','EventPhoto', 'Duration'))
    	       ->orderBy('EventDate', 'ASC')
			   ->limit($limit)
               ->find()->toArray();
		return $event;		   
    }
	 public static function GetEventListByTitleCount($title )
    {
		$sql = 'SELECT event_date
		
		FROM event
		INNER JOIN user u ON (u.Id = event.user_id AND u.blocked=0)
		WHERE event_app = 1 AND event.status < 4 ';
		$searchCond = '';
		if(trim($title)){
			$keywords = preg_split('/[\s,]+/', $title);
			$keywordSrch = array();
			foreach($keywords as $key)
			{
				$cond = ' event.title LIKE "%'.$key.'%" ';
				
				$keywordSrch[] = $cond;
			}
			$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
					
		}
		$sql .= $searchCond ;

        $events = Query::GetAll( $sql );
		
		foreach($events  as $key => &$val)
		{
			if(strtotime($val['event_date']) < getEstTime())
			{
				unset($events[$key]);
			}
		}
			
	    return count($events);
	}

	
	 public static function GetEventListByTitle($title, $start = 0, $limit = 0, $u_id = 0)
    {
		$sql = 'SELECT event.title as Title, event.id as EventId, event_photo as Image, event_date, u.Id as UserId, u.Name AS Name,  
		u.band_name AS BandName, u.first_name as FirstName, u.last_name as LastName 
		FROM event
		INNER JOIN user u ON (u.Id = event.user_id AND u.blocked=0)
		WHERE event_app = 1 AND event.status < 4 ';
		$searchCond = '';
		if(trim($title)){
			$keywords = preg_split('/[\s,]+/', $title);
			$keywordSrch = array();
			foreach($keywords as $key)
			{
				$cond = ' event.title LIKE "%'.$key.'%" ';
				
				$keywordSrch[] = $cond;
			}
			$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
					
		}
		$sql .= $searchCond .' ORDER BY event_date DESC';
		if($limit) {
			$sql .= ' LIMIT '.$start.', '.$limit;
		}
        $events = Query::GetAll( $sql );

		foreach($events as $key => &$item){
			$item['category'] = 'Event';
			$item['artist'] = $item['BandName'] ? $item['BandName'] : $item['FirstName'].' '.$item['LastName'];
			if($u_id && $u_id == $item['UserId'])
			{
				$item['link'] = "/artist/events/".$item['EventId'];
			}
			else
			{
				$item['link'] = '/u/'.$item['Name'].'/events/'.$item['EventId'];
			}

			

			$item['image'] = '/files/photo/thumbs/'.$item['UserId'].'/'.$item['Image'];
			if(strtotime($item['event_date']) < getEstTime()){
				unset($events[$key]);
			}
			$ajaxMode = _v('ajaxMode', 0);
			if(strlen($item['Title']) > 30 && $ajaxMode) {
				$item['Title'] = substr($item['Title'], 0, 30);
			}
			
		}	
	
        return $events;
		
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
    public function EventsCount( $user_id, $periods = array(), $event_app ='', $all = '', $status = array() , $getAllPeriods = '' )
    {
        $events = EventQuery::create() ->select('Id', 'Status');
		
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }
		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
		{
			$events = $events->filterByEventDate($periods['to'], '<');
		}
		
		if($event_app)
		{
			$events = $events->filterByEventApp($event_app);	
		}	
		$events = $events->filterByDeleted(0);
		
		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}
		if(!empty($status))
        {
            $events = $events->filterByStatus($status, Criteria::IN);
        }
		
        return $events->count();
    }
	public static function FelowArtistEventListCount($fan_id, $artist_ids, $periods = array(), $types = array(), $statuses = array(), $getAllPeriods = '' )
	{
		if(!$artist_ids){
			return false;
		}
		$events = EventQuery::create()->select(array('Id'))
                -> leftJoin('User u')
                ->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$fan_id);
        

       if ($artist_ids)
        {
            $events = $events->filterByUserId( $artist_ids);
        }
        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
		{
			$events = $events->filterByEventDate($periods['to'], '<');
		}
		
		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}
		
        if(!empty($types))
        {
            $events = $events->filterByEventType($types, Criteria::IN);
        }
        if(!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
/*		if(!$all)
		{
		//deb("3132");
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}*/
		
        $events = $events->filterByEventApp(EVENT_APPROVED);
		
        $events = $events->filterByDeleted(0);
		
        $events = $events->find()->toArray();
		
		return count($events);

	}	
	public static function FelowArtistEventList($fan_id, $artist_ids, $page = 1, $items_on_page = 0, $periods = array(), $types = array(), $statuses = array(), $mCache = '' , $getAllPeriods = '')
	{	
		
		if(!$artist_ids){
			return false;
		}
		
		 //get from cache
        if (!empty($mCache))
        {
            $events = $mCache->get('events_onwall' . $fan_id, 12*3600);
            if (!empty($events))
            {
                return @unserialize($events);
            }
        }        
		$events = EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Location', 'EventDate',
                        'Status', 'Deleted', 'Name', 'Duration','EventPhoto', 'u.Name'))
                -> leftJoin('User u')
				->withColumn('u.FirstName', 'FirstName')
				->withColumn('u.LastName', 'LastName')
				->withColumn('u.BandName', 'BandName')
				->withColumn('u.Name', 'Name')																
				->leftJoin('EventPurchase')->addJoinCondition('EventPurchase', 'EventPurchase.UserId = ' . (int)$fan_id)
				->withColumn('IFNULL(EventPurchase.EventId, 0)', 'EventPurchase');
        

       if ($artist_ids)
        {
            $events = $events->filterByUserId( $artist_ids);
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }
		
		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
		{
			$events = $events->filterByEventDate($periods['to'], '<');
		}
		
		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}
		
        if(!empty($types))
        {
            $events = $events->filterByEventType($types, Criteria::IN);
        }
        if(!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
        $events = $events->filterByEventApp(EVENT_APPROVED);
		
        $events = $events->filterByDeleted(0)->orderByEventDate('ASC');
	
		//$result['rcnt'] = $events->count(); 
		
        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
		
        $events = $events->find()->toArray();
		$start = ($page - 1) * $items_on_page;
		foreach($events as &$event){
			$event['siNo'] = ++$start;
		}
        
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('events_onwall' . $fan_id, serialize($events), 12*3600);
        }
		//$result = $events;
		
        return $events;
		
	}

/*	public static function FelowArtistEventCount($fan_id, $artist_ids, $periods = array(), $types = array(), $statuses = array() )
	{	

        $events = EventQuery::create() ->select('Id');
		

       if ($artist_ids)
        {
            $events = $events->filterByUserId( $artist_ids);
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
        $events = $events->filterByEventApp(EVENT_APPROVED)->filterByDeleted(0);
		
		return $events->count();
	}*/


     public static function EventsListCount( $user_id, $periods = array(), $status = array())
    {
		
		$sql = sprintf('SELECT count(id) as cnt FROM event WHERE 1');
		
		if ($user_id)
        {
			$sql .=' AND user_id = '.$user_id;
		}
        if (!empty($periods['from']))
        {
	  		$sql .=' AND event_date >= "'.$periods['from'].'"';
        }

        if (!empty($periods['to']))
        {
			$sql .=' AND event_date < "'.$periods['to'].'" ';
        }
	     if(!empty($status))
        {
			$sql .=' AND status IN('.$status.')';
        }
		$all = Query::GetOne($sql);
		return $all['cnt'];		
	}    
    /**
     * Get events list 
     * @param int $user_id - User ID
     */ 
    public static function EventsList( $user_id, $page = 0, $items_on_page = 0, $periods = array(), $types = array(), $statuses = array(), $mCache = '',  $event_app = '', $home_id =array(), $all = '', $getAllPeriods = '')
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
		$events = '';        
		$events = EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Location', 'EventDate',
                        'Status', 'Deleted', 'EventApp', 'EventPhoto', 'u.Name', 'u.BandName', 'Duration'))
                -> leftJoin('User u')
                	
				->withColumn('u.Name', 'Name');			   
        
        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }
		if (!empty($periods['from']))
		{
		   $events = $events->filterByEventDate($periods['from'], '>=');
		}	

		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
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
		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}			
		if($event_app)
		{
			$events = $events->filterByEventApp($event_app);	
		}
		//$home_id =array(83,82);
		if($home_id)
		{
			$events = $events->filterById($home_id, Criteria::NOT_IN);	
		}		
		
		$events = $events->filterByDeleted(0)->orderByEventDate('ASC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
        $events = $events->find()->toArray();
		$start = ($page - 1) * $items_on_page;
		foreach($events as &$event){
			$event['siNo'] = ++$start;
		}        
       //save to cache
        if (!empty($mCache))
        {
            $mCache->set('events_onwall' . $user_id, serialize($events), 12*3600);
        }

        return $events;
    }
	
	/**
		*Live Events
		
	*/

	public function GetLiveEventList($periods = array(), $limit)
	{
		
		$events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate', 'Code', 'TicketUrl', 'Pdate', 'Deleted','EventPhoto', 'u.Name', 'Duration'))
			        ->leftJoin('User u')
					->withColumn('u.Name', 'Name');
					        
        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }
		$events = $events->filterByEventApp(EVENT_APPROVED);
		
		if ($limit)
        {
            $events = $events ->limit($limit); 
        }
		 $events = $events->find()->toArray();
		 
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
			$events = $events->filterByEventApp(EVENT_APPROVED);

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
    public static function EventsAttendAndPurchasedList( $user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $types = array(), $statuses = array() )
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
        if(!empty($types))
        {
            $events = $events->filterByEventType($types, Criteria::IN);
        }
        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }
		$events = $events->find()->toArray();
		
		$start = ($page - 1) * $items_on_page;
		foreach($events as &$event){
			$event['siNo'] = ++$start;
		}
        return $events;
    }

    /**
     * Get events list with attend and purchase
     * @param int $user_id - User ID
     */
public static function EventsWithAttendAndPurchasedList($user_id, $user_attend_id, $page = 0, $items_on_page = 0, $periods = array(), $statuses = array(), $event_app ='' ,$getAllPeriods = '' )
    {
	
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Status',
              'Location', 'EventDate','EventPhoto','Duration','Code', 'TicketUrl' ,'Pdate', 'Deleted', 'EventAttend.Id', 'EventPurchase.Id','u.Name','u.BandName'))
			  -> leftJoin('User u')
                ->leftJoinEventAttend()
                ->addJoinCondition('EventAttend', 'EventAttend.UserId = '. $user_attend_id)
                ->leftJoinEventPurchase()
                ->addJoinCondition('EventPurchase', 'EventPurchase.UserId = '. $user_attend_id)
                ->filterByDeleted(0);

        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }
		
		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
		{
			$events = $events->filterByEventDate($periods['to'], '<');
		}

		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}

        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
		if($event_app)
		{
			$events = $events->filterByEventApp($event_app);	
		}
        $events=$events->orderByEventDate('ASC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }

        $events = $events->find()->toArray();


		
		$start = ($page - 1) * $items_on_page;
		foreach($events as &$event){
			$event['siNo'] = ++$start;
		}
//		debq();
		/*
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
			
        }*/
		
        return $events;
    }
    public static function EventsWithAttendAndPurchasedListCount( $user_id, $user_attend_id, $periods = array(), $statuses = array(), $event_app ='',$getAllPeriods='' )
    {
	

        $events = EventQuery::create() ->select(array('Id'))
			  -> leftJoin('User u')
                ->leftJoinEventAttend()
                ->addJoinCondition('EventAttend', 'EventAttend.UserId = '. $user_attend_id)
                ->leftJoinEventPurchase()
                ->addJoinCondition('EventPurchase', 'EventPurchase.UserId = '. $user_attend_id)
                ->filterByDeleted(0);

        if ($user_id)
        {
            $events = $events->filterByUserId( $user_id );
        }

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }
		if(strtolower($getAllPeriods)=='pa') 
		{
			$events = $events->filterByStatus(array(4), Criteria::IN);
		}
		elseif (!empty($periods['to']))
		{
			$events = $events->filterByEventDate($periods['to'], '<');
		}

		if(strtolower($getAllPeriods)!='pa')
		{
			 $events = $events->filterByStatus(array(3,4), Criteria::NOT_IN);	
		}
		
        if (!empty($statuses))
        {
            $events = $events->filterByStatus($statuses, Criteria::IN);
        }
		if($event_app)
		{
			$events = $events->filterByEventApp($event_app);	
		}
		
		$events = $events->find()->toArray();
		return count($events);	
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
    public function AdminEventList($page, $items_on_page, $filter = '', $event_app = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $events = EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType', 'Price', 'Location', 'EventDate',
                        'Status', 'Deleted', 'EventApp', 'Duration', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
                -> leftJoin('User u');

        if($filter)
        {
            $events = $events->where($filter);
        }
		$events = $events->filterByEventApp($event_app);

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
			case 'le':
                //from today 00:00 to today 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $to   = mktime(47, 59, 59, date("m"), date("d"), date("Y"));
                break;
			case 'up':
                //from today 00:00 to next 30 days
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $to   = mktime(47, 59, 59, date("m")+2, date("d"), date("Y"));				
                break;	
			case 'pa':
                //from today 00:00 to next 30 days				
                $from = mktime(47, 59, 59, date("m")-3, date("d"), date("Y"));
                $to   = mktime(0, 0, 0, date("m"), date("d"), date("Y"));								
                break;	
				
			default:
                //from today 00:00 to next 30 days
                //$from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));				
                $to   = mktime(47, 59, 59, date("m")+2, date("d"), date("Y"));				
                break;	
										
        }
        return array( 'from' => $from ? date("Y-m-d H:i:s", $from) : '', 'to' => $to ? date("Y-m-d H:i:s", $to) : '' );
    }

    public static function GetPeriodFromNow( $type )
    {
	
        $from = 0;
        $to   = 0;
        switch ($type)
        {
            //today
            case 'td':
                //from today 00:00 to today 23:59
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $to   = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
                break;
            //this weekend
            case 'twd':
                //from this saturday 00:00 to sunday 23:59
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")) + (6-date("w"))*24*3600;
                $to   = $from + 2*24*3600 - 1;
                break;
            //this week
            case 'tw':
                //first day of week (from sunday 00:00  to sunday 23:59)
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")) - date("w")*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //next week
            case 'nw':
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")) - date("w")*24*3600 + 7*24*3600;
                $to   = $from + 7*24*3600 - 1;
                break;

            //this month
            case 'tm':
                $from = mktime(date("H"), date("i"), date("s"), date("m"), 1, date("Y"));
                $to   = mktime(0, 0, 0, date("m")+1, 1, date("Y")) - 1;
                break;

            //next month
            case 'nm':
                $from = mktime(date("H"), date("i"), date("s"), date("m") + 1, 1, date("Y"));
                $to = mktime(0, 0, 0, date("m") + 2, 1, date("Y")) - 1;
                break;
			case 'le':
                //from today 00:00 to today 23:59
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $to   = mktime(47, 59, 59, date("m"), date("d"), date("Y"));
                break;
			case 'up':
                //from today 00:00 to next 30 days
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $to   = mktime(47, 59, 59, date("m")+2, date("d"), date("Y"));				
                break;	
			case 'pa':
                //from today 00:00 to next 30 days				
                $from = mktime(47, 59, 59, date("m")-3, date("d"), date("Y"));
                $to   = mktime(0, 0, 0, date("m"), date("d"), date("Y"));								
                break;	
				
			default:
                //from today 00:00 to next 30 days
                //$from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $from = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));				
                $to   = mktime(47, 59, 59, date("m")+2, date("d"), date("Y"));				
                break;	
										
        }
        return array( 'from' => $from ? date("Y-m-d H:i:s", $from) : '', 'to' => $to ? date("Y-m-d H:i:s", $to) : '' );
    }	
	
	 public static function GetDate( $type )
	 {
	 	$from = 0;
        $to   = 0;
	 	switch ($type)
        {
			case 'le':
                //from today 00:00 to today 23:59
                $from = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $to   = mktime(125, 125, 125, date("m"), date("d"), date("Y"));
                break;
		 
		}
		 return array( 'from' => $from ? date("Y-m-d H:i:s", $from) : '', 'to' => $to ? date("Y-m-d H:i:s", $to) : '' );
	 }
    /**
     * Get Admin user event count
     *
     */
    public static function AdminEventCount($id, $status, $mCache = '')
    {
		 //get from cache
        if (!empty($mCache))
        {
            $all = $mCache->get('admin_event_count_onwall' . $id, 12*3600);
            if (!empty($all))
            {
                return @unserialize($all);
            }
        }	
		if($status == 2)
        $sql = 'SELECT count(ep.id) as count, sum(ep.price) as price FROM  event_purchase ep LEFT JOIN event e ON ep.event_id = e.id  WHERE e.user_id = '.$id;
		else
		$sql = 'SELECT count(ep.id) as count, sum(ep.price) as price FROM  event_purchase ep WHERE ep.user_id = '.$id;
		
        $all = Query::GetOne($sql);
		//save to cache
        if (!empty($mCache))
        {
            $mCache->set('admin_event_count_onwall' . $id, serialize($all), 12*3600);
        }		
        return $all;
    }	
	
	public static function genresEventList($genresId,  $iterm_count = 0, $periods = array(), $mCache = '',$getAllPeriods = '')
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
			$events = ''; 
	
		    $sql ='SELECT e.duration AS Duration  ,e.id AS Id, e.user_id AS UserId, e.title AS Title, e.descr AS Descr, e.event_type AS EventType, e.location AS Location, e.price AS Price, e.event_date AS EventDate, e.code AS Code, e.ticket_url  AS TicketUrl, e.pdate AS Pdate, e.status AS Status, e.event_photo AS EventPhoto, e.event_app AS EventApp,u.name,u.band_name,u.first_name,u.last_name,u.status	 
			 FROM event as e
				   LEFT JOIN user AS u ON u.id = e.user_id WHERE e.deleted = 0 AND e.event_app=1 and e.status <= 2'; 
			if($genresId)
			{	   
				$sql .=' AND u.genres REGEXP "[[:<:]]'.$genresId.'[[:>:]]"';
			}
			 
			if (!empty($periods['from']))
        	{		  
			  $sql .=' AND e.event_date >= "'.$periods['from'].'"';
        	}
			if(strtolower($getAllPeriods)!='up') {
			if (!empty($periods['to']))
			{
			  $sql .=' AND e.event_date < "'.$periods['to'].'"';
			}	
			}
			if ($iterm_count)
            {
                $sql .= ' LIMIT '.$iterm_count;
            }		
		   $events = Query::GetAll($sql);
		   //save to cache
			if (!empty($mCache))
			{
				$mCache->set('events_onwall' . $user_id, serialize($events), 12*3600);
			}
			return $events;
								
	}
	public static function FinishEventNotBroadcasted($user_id)
	{
		$sql = '';		
		//Calculate time 1 hour before of current EST time
		$estTime = mktime(date('H', getEstTime())-1, date('i', getEstTime()), date('s', getEstTime()), date('m', getEstTime()), date('d', getEstTime()), date('Y', getEstTime()) );
				
		$sql = sprintf('UPDATE event set status=4 WHERE user_id IN('.$user_id.') AND event_date < "'.date('Y-m-d H:i:s', $estTime).'" AND status IN(1,2)');
	  	$events = Query::Execute($sql);
	  	
       	return $events;
		 		
	}	

} // Event
