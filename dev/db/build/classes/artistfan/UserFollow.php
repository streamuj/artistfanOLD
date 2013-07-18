<?php



/**
 * Skeleton subclass for representing a row from the 'user_follow' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class UserFollow extends BaseUserFollow {

    /**
     * Check follow status
     * @param $user_id - fan
     * @param $user_id_follow - artist
     * @return array
     */  
    public static function GetFollow($user_id, $user_id_follow) 
    {
		$fellow1	=	UserFollowQuery::create()->select(array('Id')) 
                ->filterByUserId($user_id)
                ->filterByUserIdFollow($user_id_follow)
                ->findOne();
		$fellow2	=	UserFollowQuery::create()->select(array('Id'))
                ->filterByUserId($user_id_follow)
                ->filterByUserIdFollow($user_id)
                ->findOne();
		if($fellow1)
		{
		$fellow	=	$fellow1;
		}
		if($fellow2)
		{
		$fellow	=	$fellow2;
		}
		return $fellow;
	}
	public static function GetFollowOthers($user_id, $user_id_follow)
	{
	return 		UserFollowQuery::create()->select(array('Id'))
                ->filterByUserId($user_id)
                ->filterByUserIdFollow($user_id_follow)
                ->findOne();

	}

    public static function ChangeRating($user_id, $user_id_follow, $action)
    {
        $follow = UserFollowQuery::create()->select(array('Id', 'FanRating'))
                -> filterByUserId($user_id)
                -> filterByUserIdFollow($user_id_follow)
                -> findOne();
        if(!empty($follow))
        {
            $rates = UserFollow::Rates();
            if(!empty($rates[$action]))
            {
                UserFollowQuery::create()->select(array('Id'))->filterById($follow['Id'])
                        ->update(array('FanRating' => $follow['FanRating'] + $rates[$action]));
            }
        }
        return true;
    }


    public static function GetFollowList( $user_id, $status = 2, $limit = 0 )
    {
        $list = UserFollowQuery::create()->select(array('Id', 'UserIdFollow', 'FanRating', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Avatar', 'u.IsOnline'))
                    ->leftJoin('UserToK u')
                    ->where('u.email_confirmed=1 AND u.status = ' . $status)
                    ->filterByUserId($user_id)
                    -> limit($limit)
					->find()->toArray();
		
        return $list;
    }
	public static function UserFollowRemove($id)
	{
		if($id)
		{
		$qry	=	"DELETE FROM user_follow WHERE id = ".$id.";";
		$res 	= Query::Execute($qry);		
		return $res;
		}
	
	}
    public static function GetUserListByNameCount( $title, $status )
    {
	
         $sql = 'SELECT count(id) as Count
                FROM user 
                WHERE status = "'.$status.'" 
				AND blocked = 0 
				AND email_confirmed = 1 ';
				
			 $searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
				 	$cond = ' name LIKE "%'.$key.'%" OR band_name LIKE "%'.$key.'%" ';		
					
					$keywordSrch[] = $cond;
			
				}
				$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
						
			}
			$sql .= $searchCond ;
			
            $user = Query::GetOne( $sql );
			
        return $user['Count'];
	}	
    public static function GetUserListByName($title, $status, $start = 0, $limit = 0, $u_id = 0)
    {
         $sql = 'SELECT id as Id, band_name AS BandName, name AS Name, first_name AS FirstName, last_name AS LastName, avatar AS Avatar
                FROM user 
                WHERE status = "'.$status.'" 
				AND blocked = 0 
				AND email_confirmed = 1 ';
				
			 $searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
				 	$cond = ' name LIKE "%'.$key.'%" OR band_name LIKE "%'.$key.'%" ';		
					
					$keywordSrch[] = $cond;
			
				}
				$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
						
			}
			$sql .= $searchCond .' ORDER BY first_name ASC';
			
						 
			if($limit)
			{
				 	$sql .= ' LIMIT '.$start.', '.$limit.' ';  //sprintf(,	 mysql_real_escape_string(), mysql_real_escape_string($limit));
			}

            $user = Query::GetAll( $sql );
			foreach($user as &$item)
			{
				$item['category'] = ($status == 2) ? 'Artist':'Fan';


				if($u_id && $u_id == $item['UserId'])
				{
					$item['link'] = "/";
				}
				else
				{
					$item['link'] = "/u/{$item[Name]}";
				}

				
				$item['Title'] = $item['BandName'] ? $item['BandName'] : $item['FirstName'].' '.$item['LastName'];
				$ajaxMode = _v('ajaxMode', 0);
				if(strlen($item['Title']) > 30 && $ajaxMode) {
					$item['Title'] = substr($item['Title'], 0, 30);
				}
				$item['image'] = $item['Avatar'] ? '/files/images/avatars/m_'.$item['Avatar'] : '/si/ph/user-190x120.jpg';
			}
        return $user;							 
	}	
	

    public static function GetFollowListByCities( $user_id, $status = 1 )
    {	
	    $sql = sprintf('SELECT COUNT(location) as FanCount, user.id as Id, location as Location, country as Country, gender as Gender
				FROM user 
				INNER JOIN  user_follow ON (user_id = user.id OR user_id_follow = user.id)					
				WHERE 1 ');
		
		if ($status)
        {
            $sql .= sprintf(' AND user.status=' . $status);
        }
		
		$sql .= sprintf(' AND user.id != '.$user_id.' AND user.blocked = 0 AND user.email_confirmed =1 
					AND (user_id_follow = '.$user_id.'  OR user_id = '.$user_id.') GROUP BY location');
					

	  	 $user = Query::GetAll($sql);
       	 return $user;
    }

    public static function GetFollowTopList( $user_id, $location = '', $country = '', $page = 0, $items_on_page = 0 )
    {
        $users = UserFollowQuery::create()->select(array('Id', 'UserIdFollow', 'FanRating'))
                ->leftJoin('UserFromK u')
                ->withColumn('u.Name', 'Name')
                ->withColumn('u.FirstName', 'FirstName')
                ->withColumn('u.LastName', 'LastName')
                ->withColumn('u.Email', 'Email')
                ->withColumn('u.Dob', 'Dob')
                ->withColumn('u.Gender', 'Gender')
                ->withColumn('u.Country', 'Country')
                ->withColumn('u.Location', 'Location')				
                ->withColumn('u.Avatar', 'Avatar')
                ->withColumn('u.Status', 'Status')				
				
                ->orderByFanRating('DESC')
                ->filterByUserIdFollow($user_id);
		if($country == '1')
		{
			$country = '';
		}
		if($location && $country)
        {
            $users = $users->where("u.Location LIKE '" . $location . "' AND u.Country = '" . $country . "'");
        }
        elseif($country )
        {
            $users = $users->where("u.Country = '" . $country . "'");
        }
        elseif($location)
        {
            $users = $users->where("u.Location LIKE '" . $location . "'");
        }		


        if ($items_on_page)
        {
            $users = $users->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }
  	    $users = $users->where("u.Status = 1");
        $users = $users->find()->toArray();
        return $users;
    }

    public static function GetFollowIds( $user_id, $status = 0 )
    {
        $ids = UserFollowQuery::create()->select(array('UserIdFollow'))
                    ->filterByUserId($user_id);
        if($status)
        {
            $ids = $ids->join('UserToK u')->where('u.status = ' . $status);
        }
        $ids = $ids->find()->toArray();
        return $ids;
    }

    /**
     * @static
     * @param $user_id
     * @return array
     */
    public static function GetFollowersIds($user_id)
    {
        $users = UserFollowQuery::create()->select(array('UserId'))
                ->leftJoin('UserFromK u')
                ->where('u.email_confirmed = 1')				
                ->filterByUserIdFollow($user_id);

        return $users->find()->toArray();
    }
    
    /**
     * Get followers count
     * @param $user_id
     * @return int
     */
    public static function GetFollowersCount($user_id, $location = '', $mCache = '')
    {
        //get from cache
        if (!empty($mCache))
        {
            $count = $mCache->get('count_followers' . $user_id, 3600);
            if (is_numeric($count))
            {
                return $count;
            }
        }
        $count = UserFollowQuery::create()->select('Id')
                        ->filterByUserIdFollow($user_id);
        if($location)
        {
            $count->leftJoin('UserFromK u')->where("u.Location LIKE '" . $location . "'");
        }

        $count = $count->count();

        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('count_followers' . $user_id, $count, 3600);
        }

        return $count;
    }
    /**
     * Get followers count
     * @param $user_id
     * @return int
     */
    public static function GetFansFollowersCount($user_id, $status = 2, $mCache = '')
    {
        //get from cache
        if (!empty($mCache))
        {
            $count = $mCache->get('count_fans' . $user_id, 3600);
            if (is_numeric($count))
            {
                return $count;
            }
        }
        $count = UserFollowQuery::create()->select('Id')
                    ->leftJoin('UserToK u')
                    ->where('u.email_confirmed=1 AND u.status = ' . $status)
                    ->filterByUserId($user_id);

        $count = $count->count();

        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('count_fans' . $user_id, $count, 3600);
        }

        return $count;
    }	

    /**
     * Get followers countries count
     * @param $user_id
     * @return int
     */
    public static function GetFollowersCountriesCount($user_id)
    {
        $count = UserFollowQuery::create()->select('UserIdFollow')
                        ->leftJoin('UserFromK u')
                        ->withColumn('count(DISTINCT u.Country)', 'Cnt')
                        ->filterByUserIdFollow($user_id)
                        ->find()->toArray();
        if(!empty($count))
        {
            $count = $count[0];
            return $count['Cnt'];
        }
        return 0;
    }


    /**
     * @static
     * @param $user_id
     * @return array
     */
    public static function GetFollowersList($user_id, $page = 0, $items_on_page = 0)
    {
        $users = UserFollowQuery::create()->select(array('Id', 'UserIdFollow', 'u.Name',
                'u.FirstName', 'u.LastName', 'u.Email', 'u.Dob', 'u.Gender', 'u.Country', 'u.Location', 'u.Avatar', 'u.IsOnline','u.Status'))
                ->leftJoin('UserFromK u')
                ->where('u.email_confirmed = 1')				
                ->filterByUserIdFollow($user_id);
		if ($items_on_page)
        {
            $users = $users->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        return $users->find()->toArray();
    }

    /**
     * @static
     * @param $user_id
     * @return array
     */
	 
    public static function GetFollowersUserList($user_id, $status = 0, $page = 0, $items_count = 0, $fan_ids =0,  $location ='', $country ='', $music_genre = '',  $state ='', $gender = '-1' )
    {
	
	    $sql = sprintf('SELECT user.id as Id, user_follow.id as FollowId, first_name as FirstName, last_name as LastName, band_name as BandName, name as Name, email as Email, avatar as Avatar, is_online as IsOnline, status as Status, location as Location, gender as Gender, dob as Dob, country as Country, state as State, genres as Genres 
				FROM user 
				INNER JOIN  user_follow ON (user_id = user.id OR user_id_follow = user.id)					
				WHERE 1 ');
		
		if ($status)
        {
            $sql .= sprintf(' AND user.status=' . $status);
        }
		
		$sql .= sprintf(' AND user.id != '.$user_id.' AND user.blocked = 0 AND user.email_confirmed =1 
					AND (user_id_follow = '.$user_id.'  OR user_id = '.$user_id.') ');
					

		if($fan_ids)
		{
			$sql .=sprintf(' AND user.id IN ('.$fan_ids.')');	 
		}
        
		if($country )
        {
			$sql .=sprintf(' AND user.country ="'.$country.'" ');
        }
        if($location)
        {
			$sql .=sprintf(' AND user.location LIKE "'.$location.'" ');
        }
		if($music_genre )
        {
			$sql .=sprintf(' AND user.genres REGEXP "[[:<:]]'.$music_genre.'[[:>:]]" ');
        }
        if($state)
        {
			$sql .=sprintf(' AND user.state = "'.$state.'" ');
        }
        if($gender != -1)
		{
			$gender  = ($gender==3)?0:$gender;			
			$sql .=sprintf(' AND user.gender ="'.$gender.'" ');
        }		
		
		$sql .=sprintf(' ORDER BY name ASC');
					
		if ($items_count)
        {
            $sql .= sprintf(' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count);
        }
//deb($sql);
	  	 $user = Query::GetAll($sql);
       	 return $user;
    }
	
  /**
     * @static
     * @param $user_id
     * @return array
     */
    public static function GetFollowersUserListCount($user_id, $status = 0, $fan_ids =0,  $location ='', $country ='')
    {
	
	    $sql = sprintf('SELECT COUNT(*) as cnt
				FROM user 
				INNER JOIN  user_follow ON (user_id = user.id OR user_id_follow = user.id)					
				WHERE 1 ');
		
		if ($status)
        {
            $sql .= sprintf(' AND user.status=' . $status);
        }
		
		$sql .= sprintf(' AND user.id != '.$user_id.' AND user.blocked = 0 AND user.email_confirmed =1 
					AND (user_id_follow = '.$user_id.'  OR user_id = '.$user_id.') ');
					

		if($fan_ids)
		{
			$sql .=sprintf(' AND user_follow.id IN ('.$fan_ids.')');	 
		}
        
		if($country )
        {
			$sql .=sprintf(' AND user.country ="'.$country.'" ');
        }
        if($location)
        {
			$sql .=sprintf(' AND user.location LIKE "'.$location.'" ');
        }

		$all = Query::GetOne($sql);
        $all = $all['cnt'];
		return $all;		
    }
  /**
     * @static
     * @param $user_id
     * @return array
     */
    public static function GetFollowersUserListIds($user_id, $status = 0)
    {
	
	    $sql = sprintf('SELECT user.id as Id
				FROM user 
				INNER JOIN  user_follow ON (user_id = user.id OR user_id_follow = user.id)					
				WHERE 1 ');
		
		if ($status)
        {
            $sql .= sprintf(' AND user.status=' . $status);
        }
		
		$sql .= sprintf(' AND user.id != '.$user_id.' AND user.blocked = 0 AND user.email_confirmed =1 
					AND (user_id_follow = '.$user_id.'  OR user_id = '.$user_id.') ');	

		
		$users = Query::GetAll( $sql );		
        return $users;
    }
    /**
     * @static
     * @param $user_id
     * @return array
     */
    public static function GetFollowersUserCount($user_id, $status = 2)
    {
	
	    $sql = sprintf('SELECT COUNT(*) as cnt
				FROM user 
				INNER JOIN  user_follow ON (user_id = user.id OR user_id_follow = user.id)					
				WHERE user.status='.$status.' AND user.id != '.$user_id.' AND user.blocked = 0 AND user.email_confirmed =1 
					AND (user_id_follow = '.$user_id.'  OR user_id = '.$user_id.')');

		$all = Query::GetOne($sql);
        $all = $all['cnt'];
		return $all;
    }	
	//Filter Fans from Artist Tools
	
    public static function GetFilterFansList($user_id, $fan_ids, $location, $country )
    {
		$sql = "SELECT uf.id as Id, uf.user_id_follow as UserIdFollow, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.email as Email, u.dob as Dob, u.gender 	 as Gender, u.country as Country, u.location as Location, u.avatar as Avatar FROM user_follow as uf LEFT JOIN user as u ON uf.id = u.id WHERE 1";
		
		$sql .=" AND uf.user_id_follow = ".$user_id." AND uf.id IN (".$fan_ids.")";		

		$users = Query::GetAll( $sql );
		
        return $users;
    }
	
    /**
     * Delete user's follow
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserFollows( $user_id )
    {
        UserFollowQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        UserFollowQuery::create()->select(array('Id'))->filterByUserIdFollow($user_id)->delete();
        return true;
    }

    public static function Rates()
    {
        $rates = array(
            'add_track' => 3,
            'buy_track' => 4,
            'add_album' => 7,
            'buy_album' => 10,
            'add_video' => 3,
            'buy_video' => 4,
            'attend_event' => 3,
            'buy_access' => 5,
            'add_access' => 3
        );
        return $rates;
    }

} // UserFollow
