<?php
/**
 * Skeleton subclass for representing a row from the 'music' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Music extends BaseMusic
{

    /**
     * Get track by Id
     * @param int $id
     * @param int $album_info (1 - get album image)
     * @param int $artist_info (1 - get artist name)
     * @return array 
     */	  
    public static function GetMusic($id, $album_info = 0, $artist_info = 0)
    { 
		       $track = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'Status', 'UpcCode'));
					
        if ($artist_info)
        {
            $track = $track->join('User u')->withColumn('u.BandName', 'BandName')->withColumn('u.FirstName', 'FirstName')->withColumn('u.LastName', 'LastName')->withColumn('u.Name', 'Name')->withColumn('u.Genres', 'Genres');
        }
        $track = $track->filterById($id)->findOne();
	

		
        if(!empty($track))
        {
            if ($album_info && $track['AlbumId'])
            {
                $album = MusicAlbumQuery::create()->select(array('Id', 'Title', 'Image', 'Price', 'Deleted', 'Active'))
                                ->leftJoin('Music m')
                                ->withColumn('COUNT(m.Id)', 'cnt')
                                ->withColumn('SUM(m.Price)', 'sum')
                                ->filterById($track['AlbumId'])->findOne();


                $track['Image'] = !empty($album['Image']) ? 'files/images/' . MakeDirName($track['UserId']) . 'x_' . substr($album['Image'], 2) : '';
                $track['PlayerImage'] = !empty($album['Image']) ? 'files/track/images/' . $track['UserId'] . '/m_' . $album['Image'] : '';				
                $track['AlbumTitle'] = !empty($album['Title']) ? $album['Title'] : '';
                $track['AlbumPrice'] = !empty($album['Price']) ? $album['Price'] : 0;
                $track['AlbumTracks'] = !empty($album['cnt']) ? $album['cnt'] : 0;
                $track['AlbumSavings'] = !empty($album['sum']) && $album['sum'] > $track['AlbumPrice'] ? round($album['sum'] - $track['AlbumPrice'], 2) : 0;
                $track['AlbumDeleted'] = !empty($album['Deleted']) ? 1 : 0;
                $track['AlbumActive'] = !empty($album['Active']) ? 1 : 0;
            }
            $track['Name'] = !empty($track['Name']) ? $track['Name'] : '';
            if (!empty($track['BandName']))
            {
                $track['Band'] = $track['BandName'];
            }
            else if (!empty($track['FirstName']) && !empty($track['LastName']))
            {
                $track['Band'] = $track['FirstName'] . ' ' . $track['LastName'];
            }

            if (!empty($track['Genres']))
            {
                $genres_list = User::GetGenresList();
				
                $genres = '';
				$track['Genres'] = make_array_keys_1(explode(',', $track['Genres']));
				$tmp = array();
                foreach ($track['Genres'] as $key => $item)
                {
                    $tmp[] = $genres_list[$key];
					
                }
             $track['Genres'] = implode(',', $tmp);
			if(!empty($track['Genre']))
				{
				
					$track['Genre'];

				}			 
						
            }
            else
            {
                $track['Genres'] = '';
            }
            if (!empty($track['Track']))
            {
                $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            }
            if (!empty($track['TrackPreview']))
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
        }
		
        return $track;
    }
	
	/**
	 * Get Music Information by file
	 * @param string $fileName
	 * @params string $userId
	 */
	 
	 function getMusicByFile($file, $userId=0)
	 {
	 	$track = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'Status', 'UpcCode'))->filterByTrack($file);
		if($userId){
			$track = $track->filterByUserId($userId);
		}
		$track = $track->findOne();
		 if (!empty($track['Track']))
		{
			$track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
		}
		if (!empty($track['TrackPreview']))
		{
			$track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
		}
		return $track;	
	 }

	
	/**
     * Get video status by Id
     * @param int $id
     * @return int
     */
    public static function GetMusicStatus( $id )
    {
    	$music = MusicQuery::create()->select(array('Status'))
    	->filterById( $id );
        return $music->findOne();
    }

    /**
     * Get list of tracks by title
     * @param int $user_id - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetMusicListByTitleCount($title )
    {

         $sql = sprintf('SELECT count(m.id) as Count
                FROM music as m  
				INNER JOIN music_album as ma ON (ma.id = m.album_id AND ma.deleted =0 AND m.deleted =0)
				INNER JOIN user as u ON (u.Id = m.user_id AND u.blocked=0 AND u.email_confirmed = 1)
                WHERE m.deleted = 0 AND m.status = 0');
				 
		 $searchCond = '';
		 if(trim($title))
		 {
			$keywords = preg_split('/[\s,]+/', $title);
			$keywordSrch = array();
			foreach($keywords as $key)
			{
				$cond = '( m.title LIKE "%'.$key.'%" OR ma.title LIKE "%'.$key.'%" )';									
				
				$args = preg_match_all('/%s/', $cond, $matches);
				
				if($args > 0)
				{
					$argsArray = array_fill(1, $args, $key);						
				}
				$keywordSrch[] = $cond;
		
			}
			$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
					
		}
		$sql .= $searchCond ;
			
		$music = Query::GetOne( $sql );
			
        return $music['Count'];							 
		
	} 
    public static function GetMusicListByTitle($title, $start = 0, $limit = 0 , $u_id = 0)
    {
         $sql = sprintf('SELECT m.id as Id,ma.id as AlbumId,ma.image as Image, m.title AS Title, m.track AS Track, m.track_preview as TrackPreview,u.id as UserId, u.band_name AS BandName, u.first_name as FirstName, u.last_name as LastName, u.Name AS Name, u.Avatar AS Avatar
                FROM music as m  
				INNER JOIN music_album as ma ON (ma.id = m.album_id AND ma.deleted =0 AND m.deleted =0)
				INNER JOIN user as u ON (u.Id = m.user_id AND u.blocked=0 AND u.email_confirmed = 1)
                WHERE m.deleted = 0 AND m.status = 0');
				 
			 $searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
					$cond = '( m.title LIKE "%'.$key.'%" OR ma.title LIKE "%'.$key.'%" )';									
					
					$args = preg_match_all('/%s/', $cond, $matches);
					
					if($args > 0)
					{
						$argsArray = array_fill(1, $args, $key);						
					}
					//$cond = sprintf($cond, mysql_real_escape_string($key),mysql_real_escape_string($key) );
					$keywordSrch[] = $cond;
			
				}
				$searchCond = ' AND (' . implode (' OR ', $keywordSrch) . ')';
						
			}
			$sql .= $searchCond .' ORDER BY m.title ASC';
			

			if($limit)
			{
				 	$sql .= ' LIMIT '.$start.', '.$limit.' '; //sprintf(' LIMIT %d, %d',	 mysql_real_escape_string($start), mysql_real_escape_string($limit));
			}
            $music = Query::GetAll( $sql );
			foreach($music as &$item){
				$item['category'] = 'Music';
				$item['artist'] = $item['BandName'] ? $item['BandName'] : $item['FirstName'].' '.$item['LastName'];
				if($u_id && $u_id == $item['UserId'])
				{
					$item['link'] = "/artist/music/$item[AlbumId]";
				}
				else
				{
					$item['link'] = "/u/$item[Name]/music/$item[AlbumId]";
				}
				$item['image'] = $item['Image'] ? ('/'.TRACK_IMG_PATH.'/'.$item['UserId'].'/m_'.$item['Image']) : '/i/ph/album-96x96.png';
				$ajaxMode = _v('ajaxMode', 0);
				if(strlen($item['Title']) > 30 && $ajaxMode) {
					$item['Title'] = substr($item['Title'], 0, 30);
				}
			}
							
        return $music;							 
	}
    /**
     * Get list of tracks
     * @param int $user_id - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetMusicListCount($user_id, $album_id = 0, $active = 1, $mCache = '')
    {
	    //get from cache
        if (!empty($mCache))
        {
            $all = $mCache->get('music_count_onwall' . $user_id, 12*3600);
            if (!empty($all))
            {
                return @unserialize($all);
            }
        }
		
        $sql = 'SELECT count(id) as cnt FROM music WHERE user_id = '.(int)$user_id;
		
		if (-1 != $album_id)
        {
			$sql .=' AND album_id ='.$album_id;
        }

        if ($active)
        {
			$sql  .=' AND active ='.$active;
        }
		$sql  .=' AND deleted = 0';

        $all = Query::GetOne($sql);
		
        $all = $all['cnt'];
		//save to cache
        if (!empty($mCache))
        {
            $mCache->set('music_count_onwall' . $user_id, serialize($all), 12*3600);
        }
				
		return  $all;
	
	}	 
	
    public static function GetMusicList($user_id, $album_id = 0, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0, $mCache = '', $status = 0)
    {
        //get from cache
        if (!empty($mCache))
        {
            $music = $mCache->get('music_onwall' . $user_id, 12*3600);
            if (!empty($music))
            {
                return @unserialize($music);
            }
        }
        $music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'Status'))
                       ->filterByUserId($user_id)->filterByDeleted(0);
					 
					  

        if (-1 != $album_id)
        {
            $music = $music->filterByAlbumId($album_id);
        }

        if ($active)
        {
            $music = $music->filterByActive($active);
        }
		if($status)
		{
			$music = $music->filterByStatus(0, Criteria::IN);
		}

        if ($items_on_page)
        {
            $music = $music->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        $list = $music->orderByDateRelease('DESC')->find()->toArray();

        if ($album_info)
        {
            //album image for each track
            $ids_album = array();
            foreach ($list as $track)
            {
                if ($track['AlbumId'] && !in_array($track['AlbumId'], $ids_album))
                {
                    $ids_album[] = $track['AlbumId'];
                }
            }
            unset($track);
            if (count($ids_album) > 0)
            {
                $albums = MusicAlbumQuery::create()->select(array('Id', 'Image'))
                                ->filterById($ids_album, Criteria::IN)->find()->toArray();
                $albums_list = array();
                foreach ($albums as $item)
                {
                    $albums_list[$item['Id']] = $item['Image'];
                }
                unset($albums);
            }
            unset($ids_album);
        }

        if ($artist_info)
        {
            //artist info for each track
            $ids_artists = array();
            foreach ($list as $track)
            {
                if (!in_array($track['UserId'], $ids_artists))
                {
                    $ids_artists[] = $track['UserId'];
                }
            }
            unset($track);
            if (count($ids_artists) > 0)
            {
                $artists = UserQuery::create()->select(array('Id', 'Name', 'FirstName', 'LastName', 'BandName', 'Genres'))
                                ->filterById($ids_artists, Criteria::IN)->find()->toArray();

                $artists_list = array();
                $genres_list = User::GetGenresList();
                foreach ($artists as $item)
                {
                    $genres = '';
                    if (!empty($item['Genres']))
                    {
                        $item['Genres'] = make_array_keys_1(explode(',', $item['Genres']));
                        $tmp = array();
                        foreach ($item['Genres'] as $key => $item)
                        {
                            $tmp[] = $genres_list[$key];
                        }
                        $genres = implode(',', $tmp);
                    }
                    $artists_list[$item['Id']] = array(
                        'Name' => $item['Name'],
                        'Band' => !empty($item['BandName']) ? $item['BandName'] : $item['FirstName'] . ' ' . $item['LastName'],
                        'Genres' => $genres);
                }
			$a_name = $artists;
                unset($artists);
            }
            unset($ids_artists);
        }

        foreach ($list as &$track)
        {
            $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            if ($track['TrackPreview'])
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
			
            $track['Image'] = !empty($albums_list[$track['AlbumId']]) ? 'files/images/' . MakeDirName($track['UserId']) . $albums_list[$track['AlbumId']] : '';
		    $track['Profile_data_Images'] = !empty($albums_list[$track['AlbumId']]) ? 'files/track/images/' . $track['UserId'] .'/m_'. $albums_list[$track['AlbumId']] : '';			
			//$track['Image'] = 'files/images/' . MakeDirName($track['UserId']) . $album['Image'];
            $track['Artist'] = !empty($artists_list[$track['UserId']]) ? $artists_list[$track['UserId']] : array();
    		$track['ArtistName'] =$a_name[0]['Name'];
			
        }

        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('music_onwall' . $user_id, serialize($list), 12*3600);
        }

        return $list;
    }
	
	public static function GetMusicAlbumWithPurchase($artist_id, $album_id)
	{
	 	$qry	=	"SELECT * FROM `music_purchase` where user_id = $artist_id  AND  with_all_album = $album_id";
		$res = Query::GetAll($qry);		
		return $res;
	}

    /**
     * Get list of tracks with purchase status
     * @param int $user_id - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
	
    public static function GetMusicListWithPurchase($artist_id, $fan_id, $album_id = 0, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0)
    {
		
        $music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'MusicPurchase.Id', 'MusicPurchase.WithAllAlbum','PayMore', 'Status'))
                ->leftJoinMusicPurchase()
                ->addJoinCondition('MusicPurchase', 'MusicPurchase.UserId = ' . $fan_id)
                ->filterByUserId($artist_id)
				->filterByStatus(0)
                ->filterByDeleted(0);

        if (-1 != $album_id)
        {
            $music = $music->filterByAlbumId($album_id);
        }

        if ($active)
        {
            $music = $music->filterByActive($active);
        }

        if ($items_on_page)
        {
            $music = $music->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        $list = $music->orderByDateRelease('DESC')->find()->toArray();


        if ($album_info)
        {
            //album image for each track
            $ids_album = array();
            foreach ($list as $track)
            {
                if ($track['AlbumId'] && !in_array($track['AlbumId'], $ids_album))
                {
                    $ids_album[] = $track['AlbumId'];
                }
            }
            unset($track);
            if (count($ids_album) > 0)
            {
                $albums = MusicAlbumQuery::create()->select(array('Id', 'Image'))
                                ->filterById($ids_album, Criteria::IN)->find()->toArray();

                $albums_list = array();
                foreach ($albums as $item)
                {
                    $albums_list[$item['Id']] = $item['Image'];
                }
                unset($albums);
            }
            unset($ids_album);
        }

        if ($artist_info)
        {
            //artist info for each track
            $ids_artists = array();
            foreach ($list as $track)
            {
                if (!in_array($track['UserId'], $ids_artists))
                {
                    $ids_artists[] = $track['UserId'];
                }
            }
            unset($track);
            if (count($ids_artists) > 0)
            {
                $artists = UserQuery::create()->select(array('Id', 'Name', 'FirstName', 'LastName', 'BandName', 'Genres'))
                                ->filterById($ids_artists, Criteria::IN)->find()->toArray();
                $artists_list = array();
                $genres_list = User::GetGenresList();
                foreach ($artists as $item)
                {
                    $genres = '';
                    if (!empty($item['Genres']))
                    {
                        $item['Genres'] = make_array_keys_1(explode(',', $item['Genres']));
                        $tmp = array();
                        foreach ($item['Genres'] as $key => $item1)
                        {
                            $tmp[] = $genres_list[$key];
                        }
                        $genres = implode(',', $tmp);
                    }
                    $artists_list[$item['Id']] = array(
                        'Name' => $item['Name'],
                        'Band' => !empty($item['BandName']) ? $item['BandName'] : $item['FirstName'] . ' ' . $item['LastName'],
                        'Genres' => $genres);
                }
                unset($artists);
            }
            unset($ids_artists);
        }

        foreach ($list as &$track)
        {
            $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            if ($track['TrackPreview'])
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
            $track['Image'] = !empty($albums_list[$track['AlbumId']]) ? 'files/images/' . MakeDirName($track['UserId']) . 'x_' . substr($albums_list[$track['AlbumId']], 2) : '';
            $track['Artist'] = !empty($artists_list[$track['UserId']]) ? $artists_list[$track['UserId']] : array();
        }
        return $list;
    }

    /**
     * Get only purchased list of tracks
     * @param int $user_id_purchase - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetPurchasedMusicList($user_id_purchase, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0)
    {	
			$music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'TrackLength', 'TrackPreviewLength',
                    'Pdate', 'Active', 'Deleted', 'MusicPurchase.Id', 'MusicPurchase.WithAllAlbum', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Genres'))
                ->leftJoin('User u')
                ->rightJoinMusicPurchase()
			    ->withColumn('MusicPurchase.WithAllAlbum', 'WithAllAlbum')
                ->where('MusicPurchase.IsDelete = 0 AND MusicPurchase.UserId = ' . $user_id_purchase);				
//                ->filterByDeleted(0);
        //->addJoinCondition('MusicPurchase', 'MusicPurchase.UserId = '. $user_id_purchase);
		if ($active)
        {
            $music = $music->filterByActive($active);
        }

        if ($items_on_page)
        {
            $music = $music->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        $list = $music->orderByDateRelease('DESC')->find()->toArray();
		

        if ($album_info)
        {
            //album info for each track
            $ids_album = array();
            foreach ($list as $track)
            {
                if ($track['AlbumId'] && !in_array($track['AlbumId'], $ids_album))
                {
                    $ids_album[] = $track['AlbumId'];
                }
            }
            unset($track);
            if (count($ids_album) > 0)
            {
                $albums = MusicAlbumQuery::create()->select(array('Id', 'Image', 'Title', 'Price', 'Deleted', 'Active'))
                                ->leftJoin('Music m')
                                ->withColumn('COUNT(m.Id)', 'cnt')
                                ->withColumn('SUM(m.Price)', 'sum')
                                ->groupBy('MusicAlbum.Id')
                                ->filterById($ids_album, Criteria::IN)->find()->toArray();
                $albums_list = array();
                foreach ($albums as $item)
                {
                    $item['Savings'] = (!empty($item['sum']) && $item['sum'] > $item['Price']) ? round($item['sum'] - $item['Price'], 2) : 0;
                    $albums_list[$item['Id']] = $item;
                }
                unset($albums);
            }
            unset($ids_album);
        }
        $genres_list = User::GetGenresList();
        foreach ($list as &$track)
        {
            $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            if ($track['TrackPreview'])
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
            $genres = '';
            if (!empty($track['u.Genres']))
            {
                $track['u.Genres'] = make_array_keys_1(explode(',', $track['u.Genres']));
                $tmp = array();
                foreach ($track['u.Genres'] as $key => $item)
                {
                    $tmp[] = $genres_list[$key];
                }
                $genres = implode(',', $tmp);
            }
            $track['Genres'] = $genres;
            $track['Band'] = !empty($track['u.BandName']) ? $track['u.BandName'] : $track['u.FirstName'] . ' ' . $track['u.LastName'];
            $track['Name'] = $track['u.Name'];
            $track['Image'] = !empty($albums_list[$track['AlbumId']]['Image']) ? 'files/images/' . MakeDirName($track['UserId']) . 'x_' . substr($albums_list[$track['AlbumId']]['Image'], 2) : '';
            $track['AlbumTitle'] = !empty($albums_list[$track['AlbumId']]['Title']) ? $albums_list[$track['AlbumId']]['Title'] : '';
            $track['AlbumPrice'] = !empty($albums_list[$track['AlbumId']]['Price']) ? $albums_list[$track['AlbumId']]['Price'] : 0;
            $track['AlbumTracks'] = !empty($albums_list[$track['AlbumId']]['cnt']) ? $albums_list[$track['AlbumId']]['cnt'] : 0;
            $track['AlbumSavings'] = !empty($albums_list[$track['AlbumId']]['Savings']) ? $albums_list[$track['AlbumId']]['Savings'] : 0;
            $track['AlbumDeleted'] = !empty($albums_list[$track['AlbumId']]['Deleted']) ? 1 : 0;
            $track['AlbumActive'] = !empty($albums_list[$track['AlbumId']]['Active']) ? 1 : 0;
        }	
        return $list;
    }

    /**
     * Delete artist's music
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserContent( $user_id )
    {
        //MusicQuery::create()->select(array('Id'))->filterByUserId($user_id)->update(array('Deleted' => 1));
        return true;
    }

    /**
     * Delete music track
     * @param array $track
     * @return bool
     */
    public static function DeleteMusicTrack( &$track )
    {
        if(!empty($track))
        {
            //delete files
            if(!empty($track['Track']) && file_exists(BPATH . $track['Track']))
            {
                unlink(BPATH . $track['Track']);
            }
            if(!empty($track['TrackPreview']) && file_exists(BPATH . $track['TrackPreview']))
            {
                unlink(BPATH . $track['TrackPreview']);
            }
            MusicQuery::create()->select(array('Id'))->filterById($track['Id'])->delete();
        }
        return true;
    }

    /**
     * Get music tracks list for admin panel
     * @return array
     */
	public function GetAlbumIdByMusicPurchaseId($id)
		{
		$sql = 'SELECT with_all_album AS AlbumId FROM `music_purchase` where id = '.$id;		
        $all = Query::GetAll($sql);
        return $all[0];
		}
	
	public function GetPurchasedAlbumIdByMusicPurchaseId($id)
	{
		$sql = 'SELECT  with_all_album AS AlbumId FROM `music_purchase` where id = '.$id.' GROUP BY with_all_album';
        $all = Query::GetAll($sql);
        return $all[0];
	}
	public function GetPurchasedAlbumIdByUserId($id)
	{
		$sql = 'SELECT  with_all_album AS AlbumId FROM `music_purchase` where user_id = '.$id.' GROUP BY with_all_album';
        $all = Query::GetAll($sql);
		return $all;
	}	
		
	public function ShowAlbumsByMusicPurchaseId($userId, $page = 0, $items_on_page = 0, $id=0, $trackList=0)
	{
		
		/*$sql = 'SELECT *, music_album.id AS albumId, user.first_name AS FirstName, user.last_name AS LastName, user.band_name AS BandName, user.name AS Name,  
		IFNULL(totalTracks, 0) AS totalTracks FROM music_album
		LEFT JOIN (SELECT COUNT(music_purchase.id) AS totalTracks, with_all_album as album_id  
			FROM music_purchase 
			INNER JOIN music on music_id = music.id
			WHERE music_purchase.user_id = '.$userId.' GROUP BY with_all_album) mp on mp.album_id = music_album.id 
		LEFT JOIN user ON user.id = music_album.user_id 
		WHERE music_album.id IN('.$id.')';*/
		//			
		//deb($sql);

		$sql = 'SELECT *, music_album.id AS albumId, user.first_name AS FirstName, user.last_name AS LastName, user.band_name AS BandName, user.name AS Name 
			FROM music_album
		INNER JOIN (SELECT with_all_album as album_id FROM music_purchase 
			WHERE music_purchase.user_id = '.$userId.' GROUP BY with_all_album) mp on mp.album_id = music_album.id 
		INNER JOIN user ON user.id = music_album.user_id AND email_confirmed = 1 AND blocked=0';
		
				
		$cnt = Query::GetAll($sql);
		$res['cnt'] = count($cnt);
		if ($items_on_page)
        {
            $sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        }
        $all = Query::GetAll($sql);
		
		//deb($all);
		if($trackList)
		{
			foreach($all  as &$v)
			{				
				$v['TrackList'] = Music::GetPurchaseMusicTrackByAlbumId($v['albumId'], $userId, 1, $v['totalTracks']);
				$v['totalTracks'] = count($v['TrackList']);
			}
		
		}
		
		if($all)
		{
			$res['music'] = $all;
			//deb($res['music']);
        	return $res;
		}else{
			return false;
		}
	}
		
    public function AdminMusicList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'Track', 'TrackPreview', 'Genre', 'DateRelease', 'Price', 'Active',
                        'Deleted', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name'))
                -> leftJoin('MusicAlbum a')
                -> withColumn('a.Image', 'Image')
                -> withColumn('a.Title', 'AlbumTitle')
                -> leftJoin('User u');

        if($filter)
        {
            $music = $music->where($filter);
        }
        $result['rcnt'] = $music -> count();
        $music = $music->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);

        $music = $music->orderByPdate('DESC')->find()->toArray();

        foreach($music as &$track)
        {
            $track['Image'] = !empty($track['Image']) ? 'files/images/' . MakeDirName($track['UserId']) . 'x_' . substr($track['Image'], 2) : '';
            if (!empty($track['Track']))
            {
                $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            }
            if (!empty($track['TrackPreview']))
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
        }
        unset($track);
        $result['list'] = $music;

        return $result;
    }
    /**
     * Get Admin user music count
     *
     */
    public static function AdminMusicCount($id, $status,  $mCache = '')
    {
		 //get from cache
        if (!empty($mCache))
        {
            $all = $mCache->get('admin_music_count_onwall' . $id, 12*3600);
            if (!empty($all))
            {
                return @unserialize($all);
            }
        }	
		if($status == 2)
        $sql = 'SELECT count(mp.id) as count, sum(mp.price) as price FROM  music_purchase mp LEFT JOIN music m ON mp.music_id = m.id  WHERE m.user_id = '.$id;
		else
		$sql = 'SELECT count(mp.id) as count, sum(mp.price) as price FROM  music_purchase mp WHERE mp.user_id = '.$id;
		
        $all = Query::GetOne($sql);
		//save to cache
        if (!empty($mCache))
        {
            $mCache->set('admin_music_count_onwall' . $id, serialize($all), 12*3600);
        }		
        return $all;
    }
	
    public static function GetTrackByAlbumId($id)
	{
		$sql	=	"SELECT * FROM `music` where album_id = ".$id."";
		$all 	= 	Query::GetAll($sql);
		return $all;
	}
	
	public static function GetPurchaseMusicTrackByAlbumId($albumId, $UserId, $active=0, $getAlbum=1)
	{
		/*$sql = 'SELECT m.id AS MusicId, m.user_id AS UserId, m.title AS Title, m.album_id AS AlbumId, m.genre AS Genre, m.date_release As DateRelease, m.label AS Label, m.price AS Price, m.track AS Track, m.track_preview AS TrackPreview, m.track_length As TrackLength, m.track_preview_length AS TrackPreviewLength, m.pdate As Pdate, m.active As Active, m.status AS Status, m.upc_code AS UpcCode, m.pay_more AS PayMore, ma.id AS MusicAlbumTableId, mp.music_id, mp.user_id FROM music_album as ma 
			    LEFT JOIN music as m ON ma.id = m.album_id 
				LEFT JOIN music_purchase as mp ON m.id=mp.music_id  
				 WHERE ma.id='.$albumId.' AND mp.user_id ='.$UserId;
				 , mp.music_id, mp.user_id
				 */
				if($getAlbum){
					$mpJoin = ' LEFT JOIN music_purchase as mp ON m.id=mp.music_id  ';
				}
			$sql = 'SELECT DISTINCT m.id AS MusicId, m.user_id AS UserId, m.title AS Title, m.album_id AS AlbumId, m.genre AS Genre, m.date_release As DateRelease, m.label AS Label, m.price AS Price, m.track AS Track, m.track_preview AS TrackPreview, m.track_length As TrackLength, m.track_preview_length AS TrackPreviewLength, m.pdate As Pdate, m.active As Active, m.status AS Status, m.upc_code AS UpcCode, m.pay_more AS PayMore, ma.id AS MusicAlbumTableId 
			FROM music_album as ma 
			LEFT JOIN music as m ON ma.id = m.album_id 
			LEFT JOIN music_purchase as mp ON m.id=mp.music_id 
			LEFT JOIN music_purchase album ON album.music_id = 0 AND album.with_all_album = m.album_id
			WHERE ma.deleted=0 AND ma.id='.$albumId;
				
		$all = Query::GetAll($sql);

		return $all;
	}
	
	
	
	public static function GetArtistMusicListByAlbum($user_id, $album_id = 0, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0, $mCache = '')
    {
		
        //get from cache
        if (!empty($mCache))
        {
            $music = $mCache->get('music_onwall' . $user_id, 12*3600);
            if (!empty($music))
            {
                return @unserialize($music);
            }
        }
        $music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'Status'))
                       ->filterByUserId($user_id)->filterByDeleted(0);
					 
		if ($album_id)
        {
            $music = $music->filterByAlbumId($album_id);
        }

        if ($items_on_page)
        {
            $music = $music->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        $list = $music->orderByDateRelease('DESC')->find()->toArray();
        if ($album_info)
        {
            //album image for each track
            $ids_album = array();
            foreach ($list as $track)
            {
                if ($track['AlbumId'] && !in_array($track['AlbumId'], $ids_album))
                {
                    $ids_album[] = $track['AlbumId'];
                }
            }
            unset($track);
            if (count($ids_album) > 0)
            {
                $albums = MusicAlbumQuery::create()->select(array('Id', 'Image'))
                                ->filterById($ids_album, Criteria::IN)->find()->toArray();
                $albums_list = array();
                foreach ($albums as $item)
                {
                    $albums_list[$item['Id']] = $item['Image'];
                }
                unset($albums);
            }
            unset($ids_album);
        }

        if ($artist_info)
        {
            //artist info for each track
            $ids_artists = array();
            foreach ($list as $track)
            {
                if (!in_array($track['UserId'], $ids_artists))
                {
                    $ids_artists[] = $track['UserId'];
                }
            }
            unset($track);
            if (count($ids_artists) > 0)
            {
                $artists = UserQuery::create()->select(array('Id', 'Name', 'FirstName', 'LastName', 'BandName', 'Genres'))
                                ->filterById($ids_artists, Criteria::IN)->find()->toArray();

                $artists_list = array();
                $genres_list = User::GetGenresList();
                foreach ($artists as $item)
                {
                    $genres = '';
                    if (!empty($item['Genres']))
                    {
                        $item['Genres'] = make_array_keys_1(explode(',', $item['Genres']));
                        $tmp = array();
                        foreach ($item['Genres'] as $key => $item)
                        {
                            $tmp[] = $genres_list[$key];
                        }
                        $genres = implode(',', $tmp);
                    }
                    $artists_list[$item['Id']] = array(
                        'Name' => $item['Name'],
                        'Band' => !empty($item['BandName']) ? $item['BandName'] : $item['FirstName'] . ' ' . $item['LastName'],
                        'Genres' => $genres);
                }
			$a_name = $artists;
                unset($artists);
            }
            unset($ids_artists);
        }

        foreach ($list as &$track)
        {
            $track['Track'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['Track'];
            if ($track['TrackPreview'])
            {
                $track['TrackPreview'] = MakeUserDir('files/track/u', $track['UserId']) . '/' . $track['TrackPreview'];
            }
			
            $track['Image'] = !empty($albums_list[$track['AlbumId']]) ? 'files/images/' . MakeDirName($track['UserId']) . $albums_list[$track['AlbumId']] : '';
		    $track['Profile_data_Images'] = !empty($albums_list[$track['AlbumId']]) ? 'files/track/images/' . $track['UserId'] .'/m_'. $albums_list[$track['AlbumId']] : '';			
			//$track['Image'] = 'files/images/' . MakeDirName($track['UserId']) . $album['Image'];
            $track['Artist'] = !empty($artists_list[$track['UserId']]) ? $artists_list[$track['UserId']] : array();
    		$track['ArtistName'] =$a_name[0]['Name'];
			
        }
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('music_onwall' . $user_id, serialize($list), 12*3600);
        }

        return $list;
    }
		

}

// Music
