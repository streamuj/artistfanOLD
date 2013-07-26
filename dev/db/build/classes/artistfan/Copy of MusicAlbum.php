<?php

/**
 * Skeleton subclass for representing a row from the 'music_album' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
 
class MusicAlbum extends BaseMusicAlbum {
    /**
     * Get album by Id
     */
    public static function GetAlbum( $id, $artist_info = 0, $add_info = 0, $user_id = 0 , $trackList = 0)
    {
	
    	$album = MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'Image', 'Price', 'DateRelease', 'Pdate', 'Active', 'Deleted', 'Featured','AlbumPayMore','Genre','Label','IsSingle'))
    	->filterById( $id );
		
        if($artist_info)
        {
            $album = $album->join('User u')->withColumn('u.BandName', 'BandName')->withColumn('u.FirstName', 'FirstName')->withColumn('u.LastName', 'LastName')->withColumn('u.Name', 'Name')->withColumn('u.Genres', 'Genres');
        }
        $album = $album->findOne();
        if(!empty($album))
        {
            $album['Band'] = !empty($album['BandName']) ? $album['BandName'] : (!empty($album['FirstName']) && !empty($album['LastName']) ? $album['FirstName'] . ' ' . $album['LastName'] : '');
            $album['Name'] = !empty($album['Name']) ? $album['Name'] : '';
            if(!empty($album['Genres']))
            {
                $genres_list = User::GetGenresList();
                $genres = '';
                $album['Genres'] = make_array_keys_1(explode(',', $album['Genres']));
                $tmp = array();
                foreach($album['Genres'] as $key => $item)
                {
                    $tmp[] = $genres_list[$key];
                }
                $album['Genres'] = implode(',', $tmp);
            }
            else
            {
                $album['Genres'] = '';
            }
			
			if($trackList)
			{
				  $album['TrackList'] = Music::GetTrackListByalbumId($album['Id'], $album['UserId']);	
			}

            if($add_info)
            {
                $info = MusicQuery::create()->select(array('AlbumId'))
                        ->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')
                        ->filterByActive(1)
                        ->filterByDeleted(0)
                        ->filterByAlbumId($id)
                        ->find()->toArray();
                if(!empty($info))
                {
                    $info = $info[0];
                    $album['Tracks'] = !empty($info['cnt']) ? $info['cnt'] : 0;
                    $album['TracksPrice'] = !empty($info['sum']) ? $info['sum'] : 0;
                    $album['Savings'] = ($album['Price'] < $album['TracksPrice']) ? round($album['TracksPrice'] - $album['Price'], 2) : 0;
                }
            }

/*            if ($album['Image'])
            {
                $album['xImage'] = 'files/images/' . MakeDirName($album['UserId']) . 'x_' . substr($album['Image'], 2);
                $album['Image'] = 'files/images/' . MakeDirName($album['UserId']) . $album['Image'];
            }*/
        }
		if($user_id)
		{
				$album['Fellow'] = UserFollow::GetFollow( $user_id, $album['UserId']);	
				
				$album['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
							 ->filterByUserId($user_id)
							 ->filterByWithAllAlbum($id)
							 ->findOne();	
		}			
		
        return $album;
    }
	
	public static function GetAlbumPriceByTrack($albumId)
	{
		$qry = 'SELECT sum(price) as totalPrice FROM music WHERE deleted = 0 AND album_id = '. $albumId;
		$rslt = Query::GetOne($qry);
		return $rslt['totalPrice'];
	}
	
	public static function UpdateAlbumPrice($albumId)
	{
		$totalPrice = MusicAlbum::GetAlbumPriceByTrack($albumId);
		MusicAlbumQuery::create()->select(array('Id'))->filterById($albumId)->update(array('Price' => $totalPrice));
		return true;
	}

    public static function GetAlbumsNames($albums_ids)
    {
        $albums = array();
        $res = MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Image', 'Deleted'))
                ->filterById($albums_ids, Criteria::IN)
                ->find()->toArray();
        foreach($res as $item)
        {
            $albums[$item['Id']] = $item;
        }
        return $albums;
    }

    /**
     * Get list of featured albums
     * @return array
     */
    public static function GetFeaturedAlbums( $limit = 6 )
    {
        $albums = MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Image'))
                ->join('User u')
                ->withColumn('u.BandName', 'BandName')
                ->withColumn('u.FirstName', 'FirstName')
                ->withColumn('u.LastName', 'LastName')
                ->withColumn('u.Name', 'Name')
                ->filterByFeatured(1)
                ->filterByActive(1)
                ->filterByDeleted(0)
                ->orderByPdate('DESC')
                ->limit($limit)->find()->toArray();
        foreach($albums as &$item)
        {
            if ($item['Image'])
            {
                $item['Image'] = 'files/images/' . MakeDirName($item['UserId']) . $item['Image'];
            }
        }
        unset($item);
        return $albums;
    }


    /**
     * Get list of albums
     * @param int $user_id - user ID
     * @return array
     */
	 
    public static function GetAlbumList( $user_id, $page = 0, $items_on_page = 0, $active = 1, $add_info = 0, $puchaseInfo = 0, $trackList = 0)
    {
			
    	$albums =  MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'Image', 'Price', 'DateRelease', 'Pdate', 'Active', 'Deleted','AlbumPayMore','Genre','Label','IsSingle'))    	
		->filterByUserId( $user_id )->filterByDeleted(0);
	
        if ($active)
        {
            $albums = $albums->filterByActive( $active );	
        }
		
		if ($items_on_page)
        {
            $albums = $albums->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
		
        $albums = $albums->orderByDateRelease('DESC')->find()->toArray();
		
		$start = ($page - 1) * $items_on_page;
		
		if($puchaseInfo)
		{
			$purInfo = array();
			 foreach($albums as $item)
			  {
					$albums['WithAllAlbum'] .= MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
							 ->filterByUserId($puchaseInfo)
							 ->filterByWithAllAlbum($item['Id'])
							 ->find()->toArray();
					
			   }
		}
		
        if($add_info)
        {
            //count tracks in album and price savings
            $ids_albums = array();
            foreach($albums as $item)
            {
                if(!in_array($item['Id'], $ids_albums))
                {
                    $ids_albums[] = $item['Id'];
                }
            }
            unset($item);
            if(count($ids_albums) > 0)
            {
                $music = MusicQuery::create()->select(array('AlbumId'))
                    ->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')->groupBy('AlbumId')
                    ->filterByAlbumId( $ids_albums, Criteria::IN )->filterByActive(1)->filterByDeleted(0)->find()->toArray();
                $add_info = array();
                foreach($music as $item)
                {
                    $add_info[$item['AlbumId']] = $item;
                }
                unset($music);
                unset($item);
            }
        }
		
		if($trackList)
		{
			foreach ($albums as &$v)
			{
				
				$v['TrackList'] = Music::GetMusicList($v['UserId'], $v['Id'], 0);	
			}
		
		}
	
        foreach ($albums as &$v)
        {
            $v['Tracks'] = !empty($add_info[$v['Id']]['cnt']) ? $add_info[$v['Id']]['cnt'] : 0;
            $v['TracksPrice'] = !empty($add_info[$v['Id']]['sum']) ? $add_info[$v['Id']]['sum'] : 0;
            $v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
			
		}
		
		
        return $albums;
    }
    /**
     * Get list of albums
     * @param int $user_id - user ID
     * @return array
     */
	 
    public static function GetRecentAlbumList( $active = 1, $page = 1, $items_on_page = 0, $add_info = 0, $mCache = '', $user_id = 0 )
    {
	    //get from cache        
		if (!empty($mCache))
        {
            $albums = $mCache->get('r_album_onexplore' . $user_id, 12*3600);
            if (!empty($albums))
            {
                return @unserialize($albums);
            }
        }
			
    	$albums =  MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'Image', 'Price', 'DateRelease', 'Pdate', 'Active', 'Deleted','AlbumPayMore','Genre','Label','IsSingle'))    	
    	->leftJoin('User u')
		->withColumn('u.FirstName', 'FirstName')
		->withColumn('u.LastName', 'LastName')
		->withColumn('u.BandName', 'BandName')	
		->withColumn('u.Name', 'Name')
		->filterByDeleted(0);
		
        if ($active)
        {
            $albums = $albums->filterByActive( $active );	
        }
		  
        $dstart = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
        $dend = mktime(0, 0, 0, date('m')-1, date('d'), date('Y'));

		$albums = $albums->filterByPdate($dstart, Criteria::LESS_EQUAL);
        $albums = $albums->filterByPdate($dend, Criteria::GREATER_EQUAL);
        
		if ($items_on_page)
        {
            $albums = $albums->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }
		
        $albums = $albums->find()->toArray();

        if($add_info)
        {
            //count tracks in album and price savings
            $ids_albums = array();
            foreach($albums as $item)
            {
                if(!in_array($item['Id'], $ids_albums))
                {
                    $ids_albums[] = $item['Id'];
                }
            }
            unset($item);
            if(count($ids_albums) > 0)
            {
                $music = MusicQuery::create()->select(array('AlbumId'))
                    ->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')->groupBy('AlbumId')
                    ->filterByAlbumId( $ids_albums, Criteria::IN )->filterByActive(1)->filterByDeleted(0)->where('Status = 0')->find()->toArray();
               
			    $add_info = array();
                foreach($music as $item)
                {
                    $add_info[$item['AlbumId']] = $item;
                }
                unset($music);
                unset($item);
            }
        }
	
        foreach ($albums as &$v)
        {				 
            $v['Tracks'] = !empty($add_info[$v['Id']]['cnt']) ? $add_info[$v['Id']]['cnt'] : 0;
            $v['TracksPrice'] = !empty($add_info[$v['Id']]['sum']) ? $add_info[$v['Id']]['sum'] : 0;
            $v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
			if($user_id)
			{
				$v['Fellow'] = UserFollow::GetFollow( $user_id, $v['UserId']);	
				
				$v['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
							 ->filterByUserId($user_id)
							 ->filterByWithAllAlbum($v['Id'])
							 ->findOne();	
			}	
		}
		
		foreach($albums  as $key => &$val)
		{
			if(!$val['Tracks'])
			{
				unset($albums[$key]);
			}
		}
		
				
	   //save to cache
        if (!empty($mCache))
        {
            $mCache->set('r_album_onexplore' . $user_id, serialize($albums), 12*3600);
        }
		
        return $albums;
    }
    /**
     * Delete artist's music albums
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserContent( $user_id )
    {
        //MusicAlbumQuery::create()->select(array('Id'))->filterByUserId($user_id)->update(array('Deleted' => 1));
        return true;
    }

    /**
     * Get albums list for admin panel
     * @return array
     */
    public function AdminAlbumsList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $albums = MusicAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'DateRelease', 'Image', 'Price', 'Active', 'Featured',
                        'Deleted', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
                -> leftJoin('Music m')
                -> withColumn('Count(m.Id)', 'cnt')
                -> groupBy('MusicAlbum.Id')
                -> leftJoin('User u');

        if($filter)
        {
            $albums = $albums->where($filter);
        }
        $result['rcnt'] = $albums -> count();
        $albums = $albums->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);

        $albums = $albums->orderByPdate('DESC')->find()->toArray();
        foreach($albums as &$album)
        {
            $album['Image'] = !empty($album['Image']) ? 'files/images/' . MakeDirName($album['UserId']) . 'x_' . substr($album['Image'], 2) : '';
        }
        unset($track);
        $result['list'] = $albums;

        return $result;
    }

    /**
     * Add to / remove from featured albums list
     * @param int $id
     * @param int $status
     * @return bool
     */
    public static function ChangeFeaturedStatus($id, $status)
    {
        MusicAlbumQuery::create()->select('Id')->filterById($id)->update(array('Featured' => $status));
        return true;
    }

    /**
     * Get album tracks
     * @param $album_id
     * @return array
     */
    public static function GetAlbumTracks( $album_id )
    {
        $tracks = MusicQuery::create()->select(array('Id', 'UserId', 'Track', 'TrackPreview', 'TrackLength', 'TrackPreviewLength', 'Genre', 'Price', 'Title'))->filterByAlbumId($album_id) ->filterByDeleted(0)->find()->toArray();
        foreach($tracks as &$track)
        {
            if (!empty($track['Track']))
            {
                $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            }
            if (!empty($track['TrackPreview']))
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
        }
        return $tracks;
    }

    /**
     * Delete album
     * @param array $album
     * @return bool
     */
    public static function DeleteAlbum( &$album )
    {
        //delete album cover
        if(!empty($album['xImage']) && file_exists(BPATH . $album['xImage']))
        {
            unlink(BPATH . $album['xImage']);
        }
        if(!empty($album['Image']) && file_exists(BPATH . $album['Image']))
        {
            unlink(BPATH . $album['Image']);
        }
        MusicAlbumQuery::create()->select(array('Id'))->filterById($album['Id'])->delete();
        return true;
    }
	public static function GetMusicAlbumForHomeList($u_id)
	{		
			$sql = 'SELECT id as Id, image as Image, price as Price, title as Title, user_id as UserId			 
			FROM music_album 	
			WHERE deleted = 0 AND active =1 AND id NOT IN(SELECT DISTINCT(music_album_id) FROM home WHERE  music_album_id!=0) AND user_id='.$u_id.'';	

	        $res = Query::GetAll( $sql );
		
			$ids_albums = array();
			foreach($res as $item)
			{
					if(!in_array($item['Id'], $ids_albums))
					{
						$ids_albums[] = $item['Id'];
					}
			}
			unset($item);
			
			if(count($ids_albums) > 0)
			{
					$music = MusicQuery::create()->select(array('AlbumId'))
						->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')->groupBy('AlbumId')
						->filterByAlbumId( $ids_albums, Criteria::IN )->filterByActive(1)->filterByDeleted(0)->where('Status = 0')->find()->toArray();
					$add_info = array();
					foreach($music as $item)
					{
						$add_info[$item['AlbumId']] = $item;
					}
					unset($music);
					unset($item);
			 }
			 
			foreach ($res as &$v)
			{
				$v['Tracks'] = !empty($add_info[$v['Id']]['cnt']) ? $add_info[$v['Id']]['cnt'] : 0;
			}
/*echo "<pre>";				
print_r($res);
echo "<hr>";*/
			
			foreach($res  as $key => &$val)
			{
				if(!$val['Tracks'])
				{
					unset($res[$key]);
				}
			}
//deb($res);					
		return $res;
	}
	public static function GetBestSellerAlbumList($items_count, $mCache = '', $user_id = 0)
	{	
	        //get from cache
        
		if (!empty($mCache))
        {
            $bs_album = $mCache->get('bs_album_onexplore' . $user_id, 12*3600);
            if (!empty($bs_album))
            {
                return @unserialize($bs_album);
            }
        }
			
			$sql ='SELECT mp.with_all_album as Id, count(mp.with_all_album) as count, ma.price AS Price, ma.user_id as UserId, ma.image as Image, ma.title as Title, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName 			 			
			FROM music_purchase as mp 
			LEFT JOIN music_album as ma ON mp.with_all_album=ma.id 
			LEFT JOIN user as u ON ma.user_id=u.id 			
			WHERE ma.deleted = 0 AND ma.active =1 AND mp.music_id = 0 group by mp.with_all_album order by count desc, mp.with_all_album desc';
            
		if ($items_count)
        {
             $sql .= ' LIMIT '.$items_count;
        }
			
	    $bs_album = Query::GetAll( $sql );
					
        //count tracks in album and price savings
        $ids_albums = array();
       	foreach($bs_album as $item)
        {
                if(!in_array($item['Id'], $ids_albums))
                {
                    $ids_albums[] = $item['Id'];
                }
        }
        unset($item);
        if(count($ids_albums) > 0)
        {
                $music = MusicQuery::create()->select(array('AlbumId'))
                    ->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')->groupBy('AlbumId')
                    ->filterByAlbumId( $ids_albums, Criteria::IN )->filterByActive(1)->filterByDeleted(0)->where('Status = 0')->find()->toArray();
                $add_info = array();
                foreach($music as $item)
                {
                    $add_info[$item['AlbumId']] = $item;
                }
                unset($music);
                unset($item);
         }
						
        foreach ($bs_album as &$v)
        {
            $v['Tracks'] = !empty($add_info[$v['Id']]['cnt']) ? $add_info[$v['Id']]['cnt'] : 0;
            $v['TracksPrice'] = !empty($add_info[$v['Id']]['sum']) ? $add_info[$v['Id']]['sum'] : 0;
            $v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
			if($user_id)
			{
					$v['Fellow'] = UserFollow::GetFollow( $user_id, $v['UserId']);	
					
					$v['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
								 ->filterByUserId($user_id)
								 ->filterByWithAllAlbum($v['Id'])
								 ->findOne();	
			}			
		}
		foreach($bs_album  as $key => &$val)
		{
			if(!$val['Tracks'])
			{
				unset($bs_album[$key]);
			}
		}
		
		
	   //save to cache
        if (!empty($mCache))
        {
            $mCache->set('bs_album_onexplore' . $user_id, serialize($bs_album), 12*3600);
        }
						
		return $bs_album;
	}
	public static function GetHotSinglesAlbumList($items_count, $mCache = '', $user_id = 0)
	{	
	        //get from cache
        
		if (!empty($mCache))
        {
            $hs_album = $mCache->get('hs_track_onexplore' . $user_id, 12*3600);
            if (!empty($bs_album))
            {
                return @unserialize($bs_album);
            }
        }
			
			$sql ='SELECT mp.with_all_album as Id, count(mp.with_all_album) as count, m.price AS Price, m.user_id as UserId, ma.image as Image, ma.title as Title, m.album_id as AlbumId, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName 			 			
			FROM music_purchase as mp 
			LEFT JOIN music as m ON mp.with_all_album=m.album_id 	 
			LEFT JOIN music_album as ma ON m.album_id=ma.id 
			
			LEFT JOIN user as u ON ma.user_id=u.id 			
			WHERE m.deleted = 0 AND m.active =1 AND ma.is_single =1 group by mp.music_id order by count desc, mp.with_all_album desc';
            
		if ($items_count)
        {
             $sql .= ' LIMIT '.$items_count;
        }

	    $hs_album = Query::GetAll( $sql );


		$ids_albums = array();
		foreach($hs_album as $item)
		{
				if(!in_array($item['Id'], $ids_albums))
				{
					$ids_albums[] = $item['Id'];
				}
		}
		unset($item);
		
		if(count($ids_albums) > 0)
		{
				$music = MusicQuery::create()->select(array('AlbumId'))
					->withColumn('SUM(Music.Price)', 'sum')->withColumn('COUNT(Music.Id)', 'cnt')->groupBy('AlbumId')
					->filterByAlbumId( $ids_albums, Criteria::IN )->filterByActive(1)->filterByDeleted(0)->where('Status = 0')->find()->toArray();
				$add_info = array();
				foreach($music as $item)
				{
					$add_info[$item['AlbumId']] = $item;
				}
				unset($music);
				unset($item);
		 }
			 
			       
	   foreach ($hs_album as &$v)
        {
            $v['Tracks'] = !empty($add_info[$v['Id']]['cnt']) ? $add_info[$v['Id']]['cnt'] : 0;
            $v['TracksPrice'] = !empty($add_info[$v['Id']]['sum']) ? $add_info[$v['Id']]['sum'] : 0;
            $v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
			if($user_id)
			{
					$v['Fellow'] = UserFollow::GetFollow( $user_id, $v['UserId']);	
					
					$v['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
								 ->filterByUserId($user_id)
								 ->filterByWithAllAlbum($v['Id'])
								 ->findOne();	
			}			
		}
		foreach($hs_album  as $key => &$val)
		{
			if(!$val['Tracks'])
			{
				unset($hs_album[$key]);
			}
		}							


	   //save to cache
        if (!empty($mCache))
        {
            $mCache->set('hs_track_onexplore' . $user_id, serialize($hs_album), 12*3600);
        }
						
		return $hs_album;
	}
	
	
	
	public static function GetArtistAlbumList($artistUserId, $LoginUserId,  $page = 0, $items_count = 0, $trackList = 0)
    {	
	    
		 $sql = 'SELECT  DISTINCT ma.id AS Id, ma.title AS Title, ma.descr AS Descr, ma.date_release AS DateRelease, ma.image AS Image, ma.price AS Price,  ma.genre AS Genre, ma.label AS Label,  ma.is_single AS IsSingle, ma.album_pay_more AS AlbumPayMore,  user.id AS UserId, user.first_name AS FirstName, user.last_name AS LastName, user.band_name AS BandName, user.name AS Name, music_purchase.with_all_album as purchased, totalTrack 
					 FROM music_album AS ma 
					 LEFT JOIN music_purchase ON with_all_album = ma.id and music_purchase.user_id = '.$LoginUserId.' 
					 LEFT JOIN (select count(music.id) AS totalTrack, album_id FROM music WHERE music.status = 0 AND music.deleted = 0 GROUP BY album_id) 
					 music_track on music_track.album_id = ma.id
					 LEFT JOIN user ON user.id = ma.user_id 
					 WHERE ma.user_id = '.$artistUserId.' AND ma.deleted = 0 AND ma.active = 1';
	   
	     
		if ($items_count)
        {
             $sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count;
        }
        $all = Query::GetAll($sql);
		if($trackList)
		{
			foreach($all  as &$v)
			{
					$v['TrackList'] = Music::GetMusicListWithPurchase($artistUserId, $LoginUserId, $v['Id'], 1);
			}
		
		}
		
		if($all)
		{
        	return $all;
		}else{
			return false;
		}
	}
	
	public static function GetAlbumCount($user_id, $active = 1)
	{
		$albums =  MusicAlbumQuery::create()->select(array('Id'))->filterByUserId( $user_id )->filterByDeleted(0);
		if ($active)
        {
            $albums = $albums->filterByActive( $active );	
        }
		
        $albums = $albums->find()->toArray();
		$albums = count($albums);
		return $albums;
	}
	
	public static function GetCountofFreeTrack($albumId)
	{
		$sql = 'SELECT COUNT(price) AS FreeTrack FROM music WHERE album_id = '.$albumId.' AND price = 0 AND deleted =0';
		$freeTrack = Query::GetOne($sql);
		return $freeTrack;
	}
	
	public static function checkAlbumNameExist($userId , $title)
	{
		$sql = 'SELECT title FROM music_album WHERE user_id ='.$userId.' AND deleted =0';
		$machedTitle = Query::GetAll($sql);
		foreach($machedTitle as $item)
        {
				$machedIterm = ($item['title'] == $title);
				if($machedIterm)
				{
					return 1;
				}
		}
	
	}
		
	
	
	
	
} // MusicAlbum
