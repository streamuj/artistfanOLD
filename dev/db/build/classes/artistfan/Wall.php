<?php
/**
 * Skeleton subclass for representing a row from the 'wall' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Wall extends BaseWall {

    /**
     * Add message to wall
     */ 
	 
    public static function Add( $user_id, $user_id_from, $mesg, $image, $video, $timeline = 0, $mCache = '', $link = 0 )
    {
	    $mesg = makeTextAsHyperLink($mesg);
		$mesg = addslashes($mesg);
	    $sql = 'INSERT INTO wall (user_id, user_id_from, mesg, pdate, photo, video, cdate,timeline,link) 
                VALUES('.$user_id.', '.$user_id_from.', "'.$mesg.'", '.mktime().', "'.$image.'", "'.$video.'", 
				'.mktime().','.$timeline.',"'.$link.'")';
        Query::Execute($sql);
        //save to cache
			$WallId = Query::GetOne('SELECT max(id) as lastid FROM wall WHERE user_id = ' . $user_id);
            $WallId = $WallId['lastid'];
		
        if (!empty($mCache))
        {
            $id = Query::GetOne('SELECT max(id) as lastid FROM wall WHERE user_id = ' . $user_id);
            $id = $id['lastid'];
            $mCache->set($user_id. '_wall_post_last', $id, mktime());
        }
        return $WallId;
    }
    
    /**
     * Get messages list
     *
     */
    public static function GetList( $user_id, $after_id = 0, $before_id = 0, $items_count = 0 )
    {
        //all cnt
        $sql = 'SELECT count(id) as cnt FROM wall WHERE user_id = '.(int)$user_id;
        $all = Query::GetOne($sql);
        $all = $all['cnt'];
        
        $sql = 'SELECT SQL_CALC_FOUND_ROWS DISTINCT w.Id, w.user_id AS Uid, w.user_id_from AS UfId, w.Mesg, w.Pdate,  
                u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar,
				w.photo as Photo, w.video as Video, w.cdate, w.timeline as Timeline,
				CONCAT(uto.first_name, " ", uto.last_name) as ArtistName, uto.band_name as ArtistBand,
				(select count(cmt_id) from comment where cmt_refer_id=w.Id  ) as totalComments , w.link AS Link		
                FROM wall w 
                LEFT JOIN user u ON (u.Id = w.user_id_from)
				LEFT JOIN user uto ON (uto.Id = w.user_id)
				LEFT JOIN comment ON w.Id = cmt_refer_id AND cmt_refer_type = '.WALL.' AND cmt_user_id = '.(int)$user_id.'
                WHERE (w.user_id = '.(int)$user_id.' OR cmt_user_id = '.(int)$user_id.')';
        
        //Get messages after some ID - for update
        if ($after_id)
        {
            $sql .= ' AND w.cdate > '.$after_id.' ORDER BY cdate  DESC';
        }        
        elseif ($before_id)
        {
            //get messages before some ID - for get history and pagging
            $sql .= ' AND w.cdate < '.$before_id.' ORDER BY cdate DESC';
            if ($items_count)
            {
                $sql .= ' LIMIT '.$items_count;
            }
        }
        else
        {
            $sql .= ' ORDER BY cdate DESC';
            if ($items_count)
            {
                $sql .= ' LIMIT '.$items_count;
            }
            
        }
        //return 
        $res = Query::GetAll( $sql );
        foreach ($res as &$v)
        {
            $v['Pdate'] = wallTime( $v['Pdate']);//wallTime( $v['Pdate']);
			$v['commentList'] = Comment::GetCommentList( WALL, $v['Id'],$start=0,$limit=5);	
        }
        unset($v);
        if (!empty($res[0]))
        {
            $res[0]['cnt'] = Query::GetCount();
            $res[0]['cnt_all'] = $all;
        }
        return $res;
    }

    /**
     * Get featured messages count
     *
     */
	 
    public static function GetFeaturedCount()
    {
        $sql = 'SELECT count(u.id) as cnt FROM wall w LEFT JOIN user u ON (u.Id = w.user_id_from AND u.Id = w.user_id) WHERE u.featured = 1';
        $all = Query::GetOne($sql);
        return $all['cnt'];
    }
    /**
     * Get featured messages count
     *
     */
    public static function GetWallList( $user_id)
    {
        $sql = sprintf('SELECT id AS Id, mesg AS Mesg,photo AS Photo,video AS Video FROM wall WHERE user_id = "'.$user_id.'"  AND video !="" ');
	  	 $wall = Query::GetAll($sql);
       	 return $wall;
    }
    /**
     * Get featured messages count
     *
     */
    public static function GetWallById( $wall_id ,$start=0,$limit=0 )
    {
//        $sql = sprintf('SELECT id AS Id, mesg AS Mesg,photo AS Photo,video AS Video,pdate AS Pdate FROM wall WHERE id = "'.$wall_id.'" ');
		
		/*$sql = sprintf('SELECT w.Id AS Id, w.user_id AS Uid, w.user_id_from AS UfId, w.Mesg AS Mesg, w.Pdate AS Pdate,  
          u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar, w.photo AS Photo, w.video AS Video,
		  SELECT count(cmt_id) as totalComments  FROM `comment` where cmt_refer_id = w.Id
                FROM wall w 
                LEFT JOIN user u ON (u.Id = w.user_id)
                WHERE w.id = '.(int)$wall_id);
				*/
		$sql = sprintf('SELECT w.Id AS Id, w.user_id AS Uid, w.user_id_from AS UfId, w.Mesg AS Mesg, w.Pdate AS Pdate,  
          u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar, w.photo AS Photo, w.video AS Video, IFNULL(totalComments, 0) AS totalComments
                FROM wall w 
				LEFT JOIN (select count(cmt_id) AS totalComments, cmt_refer_id from comment group by cmt_refer_id) 
					AS cmnCount ON cmt_refer_id = w.Id
                LEFT JOIN user u ON (u.Id = w.user_id)
                WHERE w.id = '.(int)$wall_id) ;
				
	  	$wall = Query::GetOne($sql);		
		if($wall['Pdate'])
        {
            $wall['Pdate'] = wallTime( $wall['Pdate']);
			
        }
      //  unset($v);
		if(!empty($limit)){ $seemore = $limit;	}else{$seemore = 5;}							
		$wall['commentList'] = Comment::GetCommentList( WALL, $wall['Id'],$start=0,$seemore);	

        return $wall;
    }		

    /**
     * Get featured messages list
     *
     */
    public static function GetFeaturedList( $after_id = 0, $page = 0, $items_count = 0)
    {   
        $sql = 'SELECT w.Id, w.Mesg, w.Pdate, w.photo as Photo,
                u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar
                FROM wall w
                LEFT JOIN user u ON (u.Id = w.user_id_from AND u.Id = w.user_id)
                WHERE u.featured = 1';

        //Get messages after some ID - for update
        if ($after_id)
        {
            $sql .= ' AND w.id > '.$after_id;
        }
        
        $sql .= ' ORDER BY w.id DESC';
        if ($items_count)
        {
            $sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count;
        }

        //return
        $res = Query::GetAll( $sql );
        foreach ($res as &$v)
        {
            $v['Pdate'] = wallTime( $v['Pdate']);
        }
        unset($v);
        return $res;
    }

    /**
     * Get news feed list
     *
     */
    public static function GetNewsFeed( $user_ids, $after_id = 0, $before_id = 0, $items_count = 0, $usr_id = 0)
    {
        //all cnt
        $sql = 'SELECT count(id) as cnt FROM wall WHERE user_id IN ('. implode(',', $user_ids) . ') AND user_id = user_id_from';
        $all = Query::GetOne($sql);
        $all = $all['cnt'];
	

          $sql = 'SELECT SQL_CALC_FOUND_ROWS DISTINCT w.Id, w.Mesg, w.Pdate, w.photo as Photo, w.video as Video,
                u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar, u.Status as Status, w.cdate,
				(select count(cmt_id) from comment where cmt_refer_id=w.Id  ) as totalComments,w.link as Link								
                FROM wall w
                LEFT JOIN user u ON (u.Id = w.user_id_from)';
		
		if(in_array($usr_id, $user_ids))
		{
			$sql .= ' LEFT JOIN comment ON w.Id = cmt_refer_id AND cmt_refer_type = '.WALL.' AND cmt_user_id = '.(int)$usr_id.'
                WHERE (w.user_id = w.user_id_from OR w.user_id = cmt_user_id) AND (w.user_id IN ('. implode(',', $user_ids) . ') OR cmt_user_id = '.(int)$usr_id.')';			
		}
		else
		{
			$sql .= ' WHERE w.user_id = w.user_id_from  AND w.user_id IN ('. implode(',', $user_ids) . ')';
		}			
				
        //Get messages after some ID - for update
        if ($after_id)
        {
            $sql .= ' AND w.cdate > '.$after_id.' ORDER BY cdate  DESC';
        }
        elseif ($before_id)
        {
            //get messages before some ID - for get history and pagging
            $sql .= ' AND w.cdate < '.$before_id.' ORDER BY cdate  DESC';
            if ($items_count)
            {
                $sql .= ' LIMIT '.$items_count;
            }
        }
        else
        {
            $sql .= ' ORDER BY w.cdate  DESC';
            if ($items_count)
            {
                $sql .= ' LIMIT '.$items_count;
            }

        }


        //return
        $res = Query::GetAll( $sql );
        foreach ($res as &$v)
        {
            $v['Pdate'] = wallTime( $v['Pdate']);//wallTime( $v['Pdate']);
			$v['commentList'] = Comment::GetCommentList( WALL, $v['Id'],$start=0,$limit=5);	
        }
        unset($v);
        if (!empty($res[0]))
        {
            $res[0]['cnt'] = Query::GetCount();
            $res[0]['cnt_all'] = $all;
        }

        return $res;
    }

    /**
     * Get log list for artist wall
     *
     */
    public static function GetLogList( $user_id, $ids, $log_last_id)
    {
        $log = array();
        if(count($ids) > 0)
        {
            $sql = 'SELECT l.id as Id, l.action AS Action, l.Pdate, l.Money as Money, l.Data, l.wall_id,
                u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar
                FROM shopping_log l
                LEFT JOIN user u ON (u.Id = l.user_id)
                WHERE l.artist_id = '.(int)$user_id;
            if($log_last_id)
            {
                $sql .= ' AND l.id > ' . $log_last_id;
            }
            else
            {
                $sql .= ' AND l.wall_id IN (' . implode(',', $ids) . ')';
            }
            $sql .= ' ORDER BY l.id DESC';
            $res = Query::GetAll( $sql );
            foreach($res as $v)
            {
                if(empty($log[$v['wall_id']]))
                {
                    $log[$v['wall_id']] = array();
                }
                $v['Data'] = unserialize($v['Data']);
                $v['Title'] = !empty($v['Data']['Title']) ? $v['Data']['Title'] : '';
                $log[$v['wall_id']][] = $v;
            }
            unset($res);
            unset($v);
        }

        return $log;
    }

    /**
     * Get last artist wall message id
     * @param $user_id
     * @return int
     */
    public static function GetLastId( $user_id )
    {
        $last = WallQuery::create()->select(array('Id'))->filterByUserId($user_id)->orderById('DESC')->findOne();
        if(!empty($last))
        {
            return $last;
        }
        return 0;
    }

    /**
     * Delete user wall
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserWall($user_id)
    {
        WallQuery::create()->select(array('Id')) -> filterByUserId($user_id) -> delete();
        WallQuery::create()->select(array('Id')) -> filterByUserIdFrom($user_id) -> delete();
        return true;
    }
	
	public static function DeleteWall($id)
	{
		 WallQuery::create()->select(array('Id')) -> filterById($id) -> delete();
	}

	
	public static function UpdateWallTime($wallId)
	{
		WallQuery::create()->select(array('Id'))->filterById($wallId)
               -> update(array('Cdate' => mktime()));
        return true;
    }
	
	public static function DeleteAwatorWall($image)
	{
		 $sql	= "DELETE FROM wall WHERE photo = 'files/images/avatars/m_".$image."'";
		 $res = Query::Execute($sql);
         return $res;
		
	}
	

} // Wall
