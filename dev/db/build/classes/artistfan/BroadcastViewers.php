<?php



/**
 * Skeleton subclass for representing a row from the 'broadcast_viewers' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class BroadcastViewers extends BaseBroadcastViewers {
     
    /**
     * Get count of viewers of event
     * @param string $event_id
     * @return int
     */
    public static function GetCount( $event_id )
    {
        $time = mktime() - 3*60; //3 minutes ago
        $count = BroadcastViewersQuery::create()->select(array('Id'))
                ->filterByEventId($event_id)->filterByUdate($time, Criteria::GREATER_EQUAL)->count();

        //return
        return $count;
    }

    public static function GetListViewers( $event_id, $limit = 10, $page = 1)
    {
        $result = array('list' => array(), 'count' => 0);
        //all viewers
        $time = mktime() - 3*60; //3 minutes ago
        $list = BroadcastViewersQuery::create()->select(array('Id'))
                ->filterByEventId($event_id)->filterByUdate($time, Criteria::GREATER_EQUAL);
        $result['count'] = $list->count();

        
        $list = $list->leftJoin('User u')->withColumn('u.Name', 'Name')
		->withColumn('u.Avatar', 'Avatar')
		->withColumn('CONCAT(u.FirstName, " ", u.LastName)', 'DisplayName')
		->withColumn('u.BandName', 'BandName')
        ->orderByPdate('ASC');
        /*$list = $list->limit($limit*$page);*/
		$list = $list->find()->toArray();
		foreach($list as &$item) {
			$item['Name'] = ($item['BandName'] ? $item['BandName'] : $item['DisplayName']);
			$item['Name'] = substr($item['Name'], 0, 20);
		}
        $result['list'] = $list;
        return $result;
    }
	
    public static function GetListViewersReport( $user_id, $event_id =0, $limit = 10, $page = 1)
    {
		$viewers =array();
		$sql = sprintf('SELECT bv.id AS Id, bv.pdate AS Pdate, ep.price AS Price, u.name AS Name, u.email AS Email, sourceEvent.title AS Title 			
			,(select name from user where id = sourceEvent.user_id ) as EventOwner,count(ep.event_id) as Count ,(ep.price * count(ep.event_id)) as Total
			,ep.event_id as EId,sourceEvent.user_id as UserId		
			FROM  broadcast_viewers AS bv 
			LEFT JOIN broadcast_flows AS bf ON bf.flow=bv.event_id 
			LEFT JOIN event_purchase AS ep ON (bf.event_id=ep.event_id AND ep.user_id=bv.user_id)
			LEFT JOIN event AS sourceEvent ON sourceEvent.id = ep.event_id 			
			LEFT JOIN user AS u ON u.id=bv.user_id 
			
			WHERE bf.user_id = "'.$user_id.'" ');

		if($event_id)
		{
			$sql .= sprintf(' AND bf.event_id ="'.$event_id.'"');
		}
		$sql .= sprintf(' GROUP BY ep.event_id DESC ORDER BY `bv`.`Pdate`  DESC');

		$viewers['list'] = Query::GetAll($sql);

       	return $viewers;
    }
    public static function ViewersReportList($user_id, $event_id)
    {
	$viewers =array();
		$sql = sprintf('SELECT bv.id AS Id, bv.pdate AS Pdate, ep.price AS Price, u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.name AS Name, u.email AS Email, sourceEvent.title AS Title,(select name from user where id = sourceEvent.user_id ) as EventOwner, ep.event_id as EId, sourceEvent.price * 0.7 as OriginalPrice
			FROM  broadcast_viewers AS bv 
			LEFT JOIN broadcast_flows AS bf ON bf.flow=bv.event_id 
			LEFT JOIN event_purchase AS ep ON (bf.event_id=ep.event_id AND ep.user_id=bv.user_id)
			LEFT JOIN event AS sourceEvent ON sourceEvent.id = ep.event_id 			
			LEFT JOIN user AS u ON u.id=bv.user_id 			
			WHERE bf.user_id = "'.$user_id.'" AND ep.event_id = "'.$event_id.'" GROUP BY ep.event_id ORDER BY ep.event_id  DESC ');
		$viewers['list'] = Query::GetAll($sql);	
       	return $viewers;
    }

	public static function GetAllEventViewersReport( $user_id )
    {
		$sql =sprintf('SELECT DISTINCT(bf.event_id) AS EventId, e.title AS Title, e.event_date AS EventDate, e.price AS Price, 
	
		(SELECT count(bv.id) as cnt FROM  broadcast_viewers AS bv 
			LEFT JOIN broadcast_flows AS bf ON bf.flow=bv.event_id 
			LEFT JOIN event_purchase AS ep ON (bf.event_id=ep.event_id AND ep.user_id=bv.user_id)
			LEFT JOIN user AS u ON u.id=bv.user_id 			
			WHERE bf.user_id ="'.$user_id.'" AND bf.event_id=e.id AND bf.status=2) AS Viewers,
	    
		(SELECT sum(ep.price) AS TPrice FROM  broadcast_viewers AS bv 
			LEFT JOIN broadcast_flows AS bf ON bf.flow=bv.event_id 
			LEFT JOIN event_purchase AS ep ON (bf.event_id=ep.event_id AND ep.user_id=bv.user_id)
			LEFT JOIN user AS u ON u.id=bv.user_id 			
			WHERE bf.user_id ="'.$user_id.'" AND bf.event_id=e.id AND bf.status=2) AS TPrice
			
		FROM broadcast_flows AS bf LEFT JOIN event AS e ON e.id=bf.event_id WHERE bf.status=2 AND bf.user_id ="'.$user_id.'"');
			
		$viewers = Query::GetAll($sql);
	
       	return $viewers;
    }		

					

    /**
     * Add viewer
     * @param string $event_id
     * @param int $user_id
     * @return bool
     */
    public static function AddViewer( $event_id, $user_id )
    {
        //check if that user already see this event
        $vq = BroadcastViewersQuery::create()->select(array('Id'))->filterByEventId($event_id)->filterByUserId($user_id);
        $vi = $vq -> count();
        if(!empty($vi))
        {
            //update last time
            $vq -> update(array('Udate' => mktime()));
        }
        else
        {
            $viewer = new BroadcastViewers();
            $viewer->setEventId($event_id);
            $viewer->setUserId($user_id);
            $viewer->setPdate(mktime());
            $viewer->setUdate(mktime());
            $viewer->save();
        }
        return true;
    }

    public static function UpdateViewer( $event_id, $user_id )
    {
        BroadcastViewersQuery::create()->select(array('Id'))->filterByEventId($event_id)->filterByUserId($user_id)
                -> update(array('Udate' => mktime()));
        return true;
    }


} // BroadcastViewers
