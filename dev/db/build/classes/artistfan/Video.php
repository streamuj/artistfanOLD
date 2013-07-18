<?php
/**  
 * Skeleton subclass for representing a row from the 'video' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Video extends BaseVideo {

    /**
     * Get video by Id
     * @param int $id
     * @param int $user_id - User Id
     * @return array
     */
    public static function GetVideoInfo( $id, $user_id = 0, $artist_info = 0 )
    {

    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Deleted', 'Status','Featured','PayMore', 'VideoLength', 'VideoCount', 'VideoType'))
    	->filterById( $id );
        if ($user_id)
        {
            $video = $video->filterByUserId($user_id);
        }
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');
		
        $video = $video->findOne();
        if($artist_info && !empty($video))
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
        return $video;
    }
	
	    public static function GetVideoInfoForArtist( $id, $user_id = 0, $artist_info = 0 )
		{


    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Deleted', 'Status','Featured','PayMore', 'VideoLength', 'VideoCount', 'VideoType'))
    	->filterById( $id );
        if ($user_id)
        {
            $video = $video->filterByUserId($user_id);
        }
	//	$Videodate	=	date('Y-m-d', getEstTime());		
//		$video = $video->filterByVideoDate($Videodate, '<=');
		
        $video = $video->findOne();
        if($artist_info && !empty($video))
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
        return $video;
    		
		}
	
	
	
	
	
	
    /**
     * Get list of video by title
     * @param int $user_id - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetVideoListByTitleCount( $title )
    {		 
		$Videodate	=	date('Y-m-d', getEstTime());		
        $sql = sprintf('SELECT count(v.id) as Count
                FROM video v  
				INNER JOIN user u ON (u.Id = v.user_id AND u.blocked=0)
                WHERE v.deleted = 0 AND v.status=2 AND v.video_date <= "'.$Videodate.'"');
				 
			$searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
					$cond = ' v.title LIKE "%'.$key.'%" ';
					
					$keywordSrch[] = $cond;
				}
				$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
						
			}
			$sql .= $searchCond ;

        $video = Query::GetOne( $sql );
        return $video['Count'];
				
	}	
		 
    public static function GetVideoListByTitle($title, $start = 0, $limit = 0, $u_id = 0)
    {		 
	 	 $Videodate	=	date('Y-m-d', getEstTime());			
         $sql = sprintf('SELECT v.id as Id, v.title AS Title, v.video AS Video, v.video_preview as VideoPreview, v.from_yt AS FromYt, v.status AS Status, u.Id as UserId, u.band_name AS BandName, u.first_name as FirstName, u.last_name as LastName, u.Name AS Name, u.Avatar AS Avatar
                FROM video v  
				INNER JOIN user u ON (u.Id = v.user_id AND u.blocked=0)
                WHERE v.deleted = 0 AND v.status=2 AND v.video_date <= "'.$Videodate.'"');
				 
			$searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
					$cond = ' v.title LIKE "%'.$key.'%" ';
					
					$keywordSrch[] = $cond;
				}
				$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
						
			}
			$sql .= $searchCond .' ORDER BY v.title ASC';
			
						 
			if($limit)
			{
				 	$sql .= ' LIMIT '.$start.', '.$limit.' ';
			}
			
            $video = Query::GetAll( $sql );
			foreach($video as &$item){
				$item['category'] = 'Video';
				$item['artist'] = $item['BandName'] ? $item['BandName'] : $item['FirstName'].' '.$item['LastName'];
				if($u_id && $u_id == $item['UserId'])
				{
					$item['link'] = "/artist/video/$item[Id]";
				}
				else
				{
					$item['link'] = "/u/{$item[Name]}/video/$item[Id]";
				}
				$ajaxMode = _v('ajaxMode', 0);
				if(strlen($item['Title']) > 30 && $ajaxMode) {
					$item['Title'] = substr($item['Title'], 0, 30);
				}
				if($item['FromYt']){
					$item['image'] = 'http://i2.ytimg.com/vi/{$item[Video]}/default.jpg';
				} else {
					$item['image'] = '/files/video/thumbnail/'.$item['UserId'].'/s_'.$item['Video'].'.jpg';
				}
			}			
        return $video;
				
	}	
	
	public static function GetFeaturedVideo($limit)
	{
		$Videodate	=	date('Y-m-d', getEstTime());			
		$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Video', 'VideoPreview', 'Pdate', 'FromYt', 'Status', 'u.Name'))
			        ->leftJoin('User u')
					->withColumn('u.Name', 'Name')
                    ->filterByFeatured(1)
					->orderBy('Pdate', 'DESC')
                    ->limit($limit)
					->filterByVideoDate($Videodate, '<=')
                    ->find()->toArray();
					
	  return $video;
	}

    /**
     * Get video status by Id
     * @param int $id
     * @return int
     */
    public static function GetVideoStatus( $id )
    {
    	$video = VideoQuery::create()->select(array('Status'))
    	->filterById( $id );
        return $video->findOne();
    }

    /**
     * Get list of video
     * @param int $user_id - user ID
     * @return array
     */
    public static function GetUserRelatedVideoList( $user_id, $active = 1, $page = 0, $items_on_page = 0)
	{
			$result = array('rcnt' => 0);
		$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status'))
    	->filterByUserId( $user_id )->filterByDeleted(0);
		
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');
		
      
	    if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }	


			
         $video = $video->orderByPdate('DESC')->find()->toArray();
		
		 // $result['list'] = $video;
		 $result['rcnt'] = count($video);	
		  $result['list'] = $video;		 	 
        return $result;		
	
	}	 
    public static function GetUserVideoList( $user_id, $active = 1, $page = 0, $items_on_page = 0)
    {
		$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status'))
    	->filterByUserId( $user_id )->filterByDeleted(0);
      
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');
	  
	    if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }		
         $video = $video->orderByPdate('DESC')->find()->toArray();
		
		 // $result['list'] = $video;
		  
        return $video;		
	}
    /**
     * Get list of video
     * @param int $user_id - user ID
     * @return array
     */
	public static function GetVideoRelatedListAlongPaggination( $user_id, $active = 1, $video_type = 1, $page = 0, $items_on_page = 0,  $mCache = '' )
	{
	
		$result = array('rcnt' => 0, 'list' => array());
        //get from cache
        /*
		if (!empty($mCache))
        {
            $video = $mCache->get('video_onwall' . $user_id, 12*3600);
            if (!empty($video))
            {
                return @unserialize($video);
            }
        }*/
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore', 'VideoCount', 'VideoType', 'VideoDate'))
    	->filterByUserId( $user_id )->filterByDeleted(0);

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(USER_ARTIST);
        }
		if($video_type == 1)
		{
			$video_type =array(1,3);
		}		
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');
		
		$video = $video->filterByVideoType($video_type, Criteria::IN);		
		
		$result['rcnt'] = $video -> count();
		
	    if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);			 
        }
		
		
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('video_onwall' . $user_id, serialize($video), 12*3600);
        }
		
		 $video = $video->orderByPdate('DESC')->find()->toArray();
		 
		
		 $result['list'] = $video;
		  foreach($result['list'] as &$vId){
			 $vPurchase = VideoPurchase::Get($_SESSION['system_uid'],$vId['Id']);
			 $vId['purchase'] = $vPurchase;			  			 
		  }
		 
		  
		  
        return $result;
    
	} 
    public static function GetVideoListCount( $user_id, $active = 1, $mCache = '' )
    {
		$Videodate	=	date('Y-m-d', getEstTime());		
		$sql = 'SELECT count(id) as cnt FROM video  WHERE user_id = '.$user_id. ' AND active = '.$active.' AND status = 2 AND deleted = 0 AND video_date <= "'.$Videodate.'"';
	    $all = Query::GetOne($sql);
        return $all['cnt'];
				
	}	
    public static function GetVideoList( $user_id, $active = 1, $page = 0, $items_on_page = 0, $mCache = '', $video_type = 1 )
    {
		$result = array('rcnt' => 0, 'list' => array());
        //get from cache
        
		if (!empty($mCache))
        {
            $video = $mCache->get('video_onwall' . $user_id, 12*3600);
            if (!empty($video))
            {
                return @unserialize($video);
            }
        }
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore','VideoLength', 'VideoCount'))
    	->filterByUserId( $user_id )->filterByDeleted(0);

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(USER_ARTIST);
        }
		if($video_type == 1)
		{
			$video_type =array(1,3);
		}		
		if($video_type)
		{
			$video = $video->filterByVideoType($video_type, Criteria::IN);
		}
		
		//$Videodate	=	date('Y-m-d', getEstTime());		
		//$video = $video->filterByVideoDate($Videodate, '<=');
		
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('video_onwall' . $user_id, serialize($video), 12*3600);
        }
		
		 $result['rcnt'] = $video -> count();
		 
        if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }

         $video = $video->orderByPdate('DESC')->find()->toArray();
		
		  $result['list'] = $video;
		  
		  foreach($result['list'] as &$vId){
			 $vPurchase = VideoPurchase::Get($_SESSION['system_uid'],$vId['Id']);
			 $vId['purchase'] = $vPurchase;			  			 
		  }
	  	//deb($result);
        return $result;
    }
	
    /**
     * Get list of video with purchase status
     * @param int $user_id - user ID
     * @return array
     */
    public static function GetVideoListWithPurchase( $user_id, $user_id_purchase, $active = 1, $page = 0, $items_on_page = 0 )
    {
		$result = array('rcnt' => 0, 'list' => array());
		
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status', 'VideoPurchase.Id','PayMore', 'VideoPurchase.IsDelete'))
    	->leftJoinVideoPurchase()
        ->addJoinCondition('VideoPurchase', 'VideoPurchase.UserId = ?', $user_id_purchase)
		//->withColumn('VideoPurchase.IsDelete', 'VPurcahseIsDelete')
        ->filterByUserId( $user_id )		
        ->filterByDeleted(0);
//		->where('VideoPurchase.IsDelete!=0');

		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');


        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(2);
        }
		 $result['rcnt'] = $video -> count();

        if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }
        $video = $video->orderByPdate('DESC')->find()->toArray();
		
		$result['list'] = $video;
		
		return $result;
    }


    public static function GetPurchasedVideoListCount( $user_id_purchase, $active = 1 )
    {
        $video = VideoQuery::create()->select(array('Id'))
        ->leftJoin('User u')
        ->rightJoinVideoPurchase()
        ->where('VideoPurchase.IsDelete = 0 AND VideoPurchase.UserId = '. $user_id_purchase);

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(2);
			$video = $video->filterByDeleted(0);
        }
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');

        $list =  $video->find()->toArray();

        return count($list);     
    }
	    
    /**
     * Get only purchased list of videos
     * @param int $user_id_purchase - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetPurchasedVideoList( $user_id_purchase, $active = 1, $page = 0, $items_on_page = 0 )
    {
        $video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview',
        'Pdate', 'Active', 'FromYt', 'Status', 'VideoCount', 'VideoLength', 'VideoPurchase.Id', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
        ->leftJoin('User u')
		->withColumn('u.FirstName', 'FirstName')
  	    ->withColumn('u.LastName', 'LastName')
        ->withColumn('u.BandName', 'BandName')
		->withColumn('u.Name', 'Name')
        ->rightJoinVideoPurchase()
        ->where('VideoPurchase.IsDelete = 0 AND VideoPurchase.UserId = '. $user_id_purchase);
        //->addJoinCondition('VideoPurchase', 'VideoPurchase.UserId = '. $user_id_purchase);
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(2);
			$video = $video->filterByDeleted(0);
        }
		
		

        if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        $list =  $video->orderByPdate('DESC')->find()->toArray();

        return $list;     
    }

    /**
     * Delete artist's video
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserContent( $user_id )
    {
        //VideoQuery::create()->select(array('Id'))->filterByUserId($user_id)->update(array('Deleted' => 1));
        return true;
    }

    /**
     * Get video list for admin panel
     * @return array
     */
    public function AdminVideoList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Video', 'VideoPreview', 'Pdate', 'Featured', 'Price', 'Active', 'FromYt',
                        'Deleted', 'Status', 'VideoCount','u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Email'))
                -> leftJoin('User u');

        if($filter)
        {
            $video = $video->where($filter);
        }
        $result['rcnt'] = $video -> count();
		
        $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);

        $video = $video->orderByPdate('DESC')->find()->toArray();
        $result['list'] = $video;

        return $result;
    }


 public function AdminExportVideoList($filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Video', 'VideoPreview', 'Pdate', 'Featured', 'Price', 'Active', 'FromYt',
                        'Deleted', 'Status', 'VideoCount','u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Email'))
                -> leftJoin('User u');

        if($filter)
        {
            $video = $video->where($filter);
        }
   
        $video = $video->orderByPdate('DESC')->find()->toArray();
        $result['list'] = $video;

        return $result;
    }


    /**
     * Delete video
     * @param array $video
     * @return bool
     */
    public static function DeleteVideo( &$video )
    {
        if(!empty($video))
        {
            if(!$video['FromYt'])
            {
                if($video['Status'] == 2)
                {
                    //delete files
                    if(!empty($video['Video']) && file_exists(BPATH . MakeUserDir('files/video/u', $video['UserId']) . '/' . $video['Video']))
                    {
                        unlink(BPATH . MakeUserDir('files/video/u', $video['UserId']) . '/' . $video['Video']);
                    }
                    if(!empty($video['VideoPreview']) && file_exists(BPATH . MakeUserDir('files/video/u', $video['UserId']) . '/' . $video['VideoPreview']))
                    {
                        unlink(BPATH . MakeUserDir('files/video/u', $video['UserId']) . '/' . $video['VideoPreview']);
                    }

                    if(!empty($video['Video']) && file_exists(BPATH . MakeUserDir('files/video/thumbnail', $video['UserId']) . '/s_' . $video['Video'] . '.jpg'))
                    {
                        unlink(BPATH . MakeUserDir('files/video/thumbnail', $video['UserId']) . '/s_' . $video['Video'] . '.jpg');
                    }
                    if(!empty($video['Video']) && file_exists(BPATH . MakeUserDir('files/video/thumbnail', $video['UserId']) . '/x_' . $video['Video'] . '.jpg'))
                    {
                        unlink(BPATH . MakeUserDir('files/video/thumbnail', $video['UserId']) . '/x_' . $video['Video'] . '.jpg');
                    }
                }
            }
            VideoQuery::create()->select(array('Id'))->filterById($video['Id'])->delete();
        }
        
        return true;
    }
	
	 /**
     * update Admin user video featured
     *
     */
	
	
	public static function UpdateFeaturedVideo($video_id, $update)
    {
		$sql = 'UPDATE video SET featured = '.$update.', pdate = '.DBDATE.'  WHERE id = ' .(int)$video_id;
		$res = Query::Execute($sql);
		return $res;
    }


    /**
     * Get Admin user video count
     *
     */
    public static function AdminVideoCount($id, $status, $mCache = '')
    {
		 //get from cache
        if (!empty($mCache))
        {
            $all = $mCache->get('admin_video_count_onwall' . $id, 12*3600);
            if (!empty($all))
            {
                return @unserialize($all);
            }
        }
			
		if($status == 2)
        $sql = 'SELECT count(vp.id) as count, sum(vp.price) as price FROM  video_purchase vp LEFT JOIN video v ON vp.video_id = v.id  WHERE v.user_id = '.$id;
		else
		$sql = 'SELECT count(vp.id) as count, sum(vp.price) as price FROM  video_purchase vp WHERE vp.user_id = '.$id;
		
        $all = Query::GetOne($sql);
        
		//save to cache
        if (!empty($mCache))
        {
            $mCache->set('admin_video_count_onwall' . $id, serialize($all), 12*3600);
        }
				
        return $all;
    }
	//if Arrtist delete the video,update column deleted as 1
	public static function DeleteVideoByArtist($video_id)
    {
		$sql = 'UPDATE video SET deleted = 1, pdate = '.DBDATE.'  WHERE id = ' .(int)$video_id;
		$res = Query::Execute($sql);
		return $res;
    }		
	
	
	public static function videoCount($video_id)
	{
		$sql = 'SELECT video_count FROM video WHERE id ='.(int)$video_id;
		$res = Query::GetOne($sql);
		if($res)
		{
			$count = $res['video_count'] + 1;
			$sql ='UPDATE video SET video_count ='.$count.' WHERE id ='.(int)$video_id;
			$res = Query::Execute($sql);
		    return $res;
		}
			
	}

 public static function GetUsrVideoList( $user_id, $active = 1, $video_type = 1)
    {
		//$result = array('rcnt' => 0, 'list' => array());
				
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore','VideoLength', 'VideoCount', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name' ))
		->leftJoin('User u')
    	->filterByUserId( $user_id )->filterByDeleted(0);

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(USER_ARTIST);
        }
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');
		
		if($video_type == 1)
		{
			$video_type =array(1,3);
		}		
		if($video_type)
		{
			$video = $video->filterByVideoType($video_type, Criteria::IN);			
		}
				
         $video = $video->orderByPdate('DESC')->find()->toArray();
		
		// $result['list'] = $video;
		  
        return $video;
    }
	
// latest Video
	
public static function GetLatestVideo($user_id, $active = 1)
	{
	
		$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore','VideoLength', 'VideoCount', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name' ))
			->leftJoin('User u')
			->filterByUserId( $user_id )->filterByDeleted(0);

			$Videodate	=	date('Y-m-d', getEstTime());		
			$video = $video->filterByVideoDate($Videodate, '<=');
	
			if ($active)
			{
				$video = $video->filterByActive( $active );
				$video = $video->filterByStatus(USER_ARTIST);
			}
	        $date = mktime() - 3*3600;			
			$video = $video->filterByVideoDate(date("Y-m-d H:i:s", $date), Criteria::LESS_EQUAL);
//			SELECT *  FROM `video` WHERE `video_date` <= NOW()
//im here 
			$video = $video->orderByPdate('DESC')->findOne();
			
			return $video;
	
	}

	public static function GetVideoForHomeList($u_id)
	{		
			$Videodate	=	date('Y-m-d', getEstTime());		
			$sql = 'SELECT id as Id, video as Video, from_yt as FromYt, status as Status, title as Title, user_id as UserId, video_count as VideoCount			 
			FROM video 	
			WHERE deleted = 0 AND active =1 AND id NOT IN(SELECT DISTINCT(video_id) FROM home WHERE  video_id!=0) AND user_id='.$u_id.' AND video_date <= "'.$Videodate.'" ';	

	        $res = Query::GetAll( $sql );
			return $res;
	}

    public static function GetNewReleaseVideoList( $active = 1, $page = 0, $items_on_page = 0, $mCache = '', $user_id = 0)
    {
		$result = array();
        //get from cache
        
/*		if (!empty($mCache))
        {
            $video = $mCache->get('nr_video_onexplore' . $user_id, 12*3600);
            if (!empty($video))
            {
                return @unserialize($video);
            }
        }*/
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore','VideoLength', 'VideoCount'))
    	->leftJoin('User u')
		->withColumn('u.FirstName', 'FirstName')
		->withColumn('u.LastName', 'LastName')
		->withColumn('u.BandName', 'BandName')	
		->withColumn('u.Name', 'Name')	
	//	->withColumn('Id', 'VideoId')	
		->filterByDeleted(0);
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(USER_ARTIST);
        }
		
		$dstart = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
        $dend = mktime(0, 0, 0, date('m')-1, date('d'), date('Y'));

		$video = $video->filterByPdate($dstart, Criteria::LESS_EQUAL);
        $video = $video->filterByPdate($dend, Criteria::GREATER_EQUAL);
		
		// $result['rcnt'] = $video -> count();
		 
        if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }
        //save to cache
/*        if (!empty($mCache))
        {
            $mCache->set('nr_video_onexplore' . $user_id, serialize($video), 12*3600);
        }*/		

         $video = $video->orderByPdate('DESC')->find()->toArray();
		
		  $result = $video;

        return $result;
    }

    public static function GetMostViewedVideoList( $active = 1, $page = 0, $items_on_page = 0, $mCache = '', $user_id = 0 )
    {
		$result = array();
        //get from cache
        
/*		if (!empty($mCache))
        {
            $video = $mCache->get('nr_video_onexplore' . $user_id, 12*3600);
            if (!empty($video))
            {
                return @unserialize($video);
            }
        }*/
    	$video = VideoQuery::create()->select(array('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'FromYt', 'Status','PayMore','VideoLength', 'VideoCount'))    	
    	->leftJoin('User u')
		->withColumn('u.FirstName', 'FirstName')
		->withColumn('u.LastName', 'LastName')
		->withColumn('u.BandName', 'BandName')				
		->withColumn('u.Name', 'Name')
		->filterByDeleted(0);
		$Videodate	=	date('Y-m-d', getEstTime());		
		$video = $video->filterByVideoDate($Videodate, '<=');

        if ($active)
        {
            $video = $video->filterByActive( $active );
            $video = $video->filterByStatus(USER_ARTIST);
        }

		// $result['rcnt'] = $video -> count();
		 
        if ($items_on_page)
        {
            $video = $video->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }
        //save to cache
/*        if (!empty($mCache))
        {
            $mCache->set('nr_video_onexplore' . $user_id, serialize($video), 12*3600);
        }*/		

         $video = $video->orderByVideoCount('DESC')->find()->toArray();
		
		  $result = $video;

        return $result;
    }
			

} // Video
