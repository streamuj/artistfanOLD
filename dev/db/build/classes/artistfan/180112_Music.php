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
    public static function GetMusicListByTitle($title, $start = 0, $limit = 0)
    {
         $sql = sprintf('SELECT m.id as Id, m.title AS Title, m.track AS Track, m.track_preview as TrackPreview, u.band_name AS BandName, u.Name AS Name, u.Avatar AS Avatar
                FROM music m  
				LEFT JOIN user u ON (u.Id = m.user_id)
                WHERE m.deleted = 0 ');
				 
			 $searchCond = '';
			if(trim($title)){
				$keywords = preg_split('/[\s,]+/', $title);
				$keywordSrch = array();
				foreach($keywords as $key)
				{
					$cond = ' m.title LIKE "%'.$key.'%" ';									
					
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
			$sql .= $searchCond .' ORDER BY m.id DESC';
			
						 
			if($limit)
			{
				 	$sql .= ' LIMIT '.$start.', '.$limit.' '; //sprintf(' LIMIT %d, %d',	 mysql_real_escape_string($start), mysql_real_escape_string($limit));
			}
            $music = Query::GetAll( $sql );
							
        return $music;							 
	}
    /**
     * Get list of tracks
     * @param int $user_id - user ID
     * @param int $album_id - album ID (-1 - show all)
     * @return array
     */
    public static function GetMusicList($user_id, $album_id = 0, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0, $mCache = '')
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
	
	public static function GetMusicAlbumWithPurchase($artist_id,$album_id)
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
        $music = MusicQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'Pdate', 'Active', 'Deleted', 'TrackLength', 'TrackPreviewLength', 'MusicPurchase.Id', 'MusicPurchase.WithAllAlbum','PayMore'))
                ->leftJoinMusicPurchase()
                ->addJoinCondition('MusicPurchase', 'MusicPurchase.UserId = ' . $fan_id)
                ->filterByUserId($artist_id)
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
                    'Pdate', 'Active', 'Deleted', 'MusicPurchase.Id', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Genres'))
                ->leftJoin('User u')
                ->rightJoinMusicPurchase()
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

}

// Music
