<?php



/**
 * Skeleton subclass for representing a row from the 'broadcast_flows' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class BroadcastFlows extends BaseBroadcastFlows {
    /**
     * Add flow
     * @param int $user_id
     * @param string $flow 
     * @param int $event_id
     * @return bool
     */
    public static function AddFlow( $user_id, $flow, $event_id = 0 )
    {
        $flw = new BroadcastFlows();
        $flw->setEventId($event_id);
        $flw->setUserId($user_id);
        $flw->setFlow($flow);
        $flw->setPdate(mktime());
        $flw->save();
        
        return true;
    }

    /**
     * Get latest flow of event
     * @param int $user_id
     * @param int $event_id
     * @param int $status (0 - opened, 1 - closed, 2 -downloaded)
     * @return string
     */
    public static function GetEventLatestFlow( $user_id, $event_id = 0, $status = -1, $used = 0, $event_flow = 0 )
    {
	//deb("in side flow func");
        $flow = BroadcastFlowsQuery::create()->select(array('Flow'))->filterByUserId($user_id);
		
		if($event_id)
		{
			$flow = $flow->filterByEventId($event_id);
		}
		if($event_flow)
		{
			$flow = $flow->filterByFlow($event_flow);
		}
				
        if($status != -1)
        {
            $flow = $flow->filterByStatus($status);
        }
		if($used)
		{
		 	$flow = $flow->where('used != 0');
		}
		
        $flow = $flow->orderByPdate('ASC')->findOne();
		
		$res = $flow;
		return $res;
    }

    /**
     * Get latest flow of event
     * @param int $user_id
     * @param int $event_id
     * @param int $status (0 - opened, 1 - closed, 2 -downloaded)
     * @return string
     */
    public static function GetOneEventFlow( $flow )
    {
        $flow = BroadcastFlowsQuery::create()->select(array('Pdate'))->filterByStatus(0)->filterByFlow($flow);

        return $flow->findOne();
    }
	
    /**
     * Get time from start broadcast
     * @param int $user_id
     * @param int $event_id
     * @return string
     */
    public static function GetEventFirstFlowDate( $user_id, $event_id = 0 )
    {
	    $time = 0;
        $first_flow = BroadcastFlowsQuery::create()->select(array('Pdate'))->filterByEventId($event_id)->filterByUserId($user_id)
                ->filterByUsed(0, '<>')->orderByPdate('ASC')->findOne();

		if(!empty($first_flow))
        {
            $time = $first_flow;
        }
		
        return $time;
    }
    
	/**
     * Get time from start broadcast
     * @param int $user_id
     * @param int $event_id
     * @return string
     */
    public static function GetEventFirstFlowUsed( $user_id, $event_id = 0 )
    {
	    $time = 0;
        $first_flow = BroadcastFlowsQuery::create()->select(array('Used'))->filterByEventId($event_id)->filterByUserId($user_id)
                ->filterByUsed(0, '<>')->orderByPdate('ASC')->findOne();

		if(!empty($first_flow))
        {
            $time = $first_flow;
        }
		
        return $time;
    }
		

    /**
     * Get flows count of event
     * @param int $user_id
     * @param int $event_id
     * @return int
     */
    public static function GetEventFlowsCount( $user_id, $event_id = 0 )
    {
        $count = BroadcastFlowsQuery::create()->select(array('Id'))->filterByEventId($event_id)->filterByUserId($user_id)
                ->filterByUsed(0, '<>')
                -> count();
        return $count;
    }


    /**
     * close all event flows on finish event
     * @param int $event_id
     * @return bool
     */
    public static function CloseEventFlows( $event_id )
    {
        BroadcastFlowsQuery::create()->select(array('Id'))->filterByEventId($event_id)
                ->filterByStatus(0)-> update(array('Status' => BROADCAST_CLOSED));
        return true;
    }
	
	public static function CloseEventByFlow( $flow )
	{
		BroadcastFlowsQuery::create()->select(array('Id'))->filterByFlow($flow)
                ->filterByStatus(0)-> update(array('Status' => BROADCAST_CLOSED));
        return true;
	}

    /**
     * Get closed flows list for download its recordings
     * @return array
     */
    public static function GetClosedFlows($limit)
    {
        $time = mktime(date('H')-1, date('i'), date('s'), date("m"), date("d"), date("Y"));//3 hours ago
        $flows = BroadcastFlowsQuery::create()->select(array('Id', 'Flow', 'EventId', 'UserId', 'Status', 'Pdate'))
                ->where('used > 0 AND status !='.BROADCAST_DOWNLOADED.' AND (status = '.BROADCAST_CLOSED.' OR pdate <= ' . $time . ')')->limit($limit)->find()->toArray();
        return $flows;
    }

    /**
     * Set flow is downloaded
     * @param int $flow_id
     * @return bool
     */
    public static function SetDownloadedFlow( $flow_id )
    {
        BroadcastFlowsQuery::create()->select(array('Id'))->filterById($flow_id)
                -> filterByStatus(BROADCAST_CLOSED)
				-> update(array('Status' => BROADCAST_DOWNLOADED));
        return true;
    }

    public static function SetErrorFlow( $flow_id )
    {
        BroadcastFlowsQuery::create()->select(array('Id'))->filterById($flow_id)
                -> update(array('Status' => BROADCAST_DOWNLOAD_ERROR));
        return true;
    }
} // BroadcastFlows
