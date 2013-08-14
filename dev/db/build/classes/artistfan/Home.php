<?php



/**
 * Skeleton subclass for representing a row from the 'home' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Home extends BaseHome { 

	public static function getArtistList($page = '', $items_on_page = '', $category = '', $recent = '')
	{		
			$sql = 'SELECT  DISTINCT(h.artist_id),h.home_id as Id, h.artist_id as ArtistId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category,  hc.hc_name as CategoryName, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName, u.avatar as Avatar 
			FROM home as h 
			INNER JOIN user as u ON u.id = h.artist_id AND u.blocked = 0 AND u.email_confirmed = 1
			INNER JOIN home_category as hc ON h.home_cat=hc.hc_id 
			WHERE h.artist_id !=0 ';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}			
			elseif($recent)
			{
				$sql .= ' AND h.home_cat !='.$recent;
			}
									
			$sql .= ' ORDER BY h.home_order ASC';
						
			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}					
			
	        $res = Query::GetAll( $sql );
			return $res;			
	}
	public static function getArtistCount($category = '')
	{		
			$sql = 'SELECT  count(h.home_id) as cnt FROM home as h  INNER JOIN user as u ON u.id = h.artist_id AND u.blocked = 0 AND u.email_confirmed = 1
			WHERE h.artist_id !=0 ';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
			
	        $all = Query::GetOne($sql);
	        return $all['cnt'];
	}
		
	public static function getVideoList($page = '', $items_on_page = '', $category = '', $recent ='')
	{		
			$sql = 'SELECT  h.home_id as Id, h.video_id as VideoId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category, hc.hc_name as CategoryName, v.video as Video, v.from_yt as FromYt, v.status as Status, v.title as Title, v.user_id as UserId, v.video_count as VideoCount, h.image_path as Slide, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName 
			FROM home as h 			
			INNER JOIN video as v ON h.video_id=v.id 
			INNER JOIN user as u ON v.user_id=u.id AND u.blocked = 0 AND u.email_confirmed = 1
			INNER JOIN home_category as hc ON h.home_cat=hc.hc_id 
			WHERE h.video_id !=0 AND v.deleted = 0 '; 			
						
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
			elseif($recent)
			{
				$sql .= ' AND h.home_cat !='.$recent;
			}			
			
			$sql .= ' ORDER BY h.home_order ASC';
			
			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}					
						
			
	        $res = Query::GetAll( $sql );
			return $res;
	}
	public static function getVideoCount($category = '')
	{		
			$sql = 'SELECT  count(h.home_id) as cnt FROM home as h  			
			INNER JOIN video as v ON h.video_id=v.id 
			WHERE h.video_id !=0 AND v.deleted = 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}			
	
	        $all = Query::GetOne($sql);
	        return $all['cnt'];
	}	
	public static function getEventList($page = '', $items_on_page = '', $category = '', $recent ='')
	{		
			$sql = 'SELECT  h.home_id as Id, h.event_id as EventId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category,  hc.hc_name as CategoryName, e.event_date as EventDate,e.price as Price, e.title as Title, e.location as Location, e.descr as Descr, e.event_photo as EventPhoto,e.user_id as UserId, u.Name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName ,u.status as Status			
			FROM home as h 			
			INNER JOIN event as e ON h.event_id=e.id 
			INNER JOIN user as u ON e.user_id=u.id 	AND u.blocked = 0 AND u.email_confirmed = 1
			LEFT JOIN home_category as hc ON h.home_cat=hc.hc_id 				
			WHERE h.event_id !=0 AND e.deleted = 0 AND e.status < 3  AND e.event_date >"'.date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y"))).'" ';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
			elseif($recent)
			{
				$sql .= ' AND h.home_cat !='.$recent;
			}			
			
			$sql .= ' ORDER BY h.home_order ASC';

			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}	
//deb($sql);
	        $res = Query::GetAll( $sql );			
			return $res;
	}
	public static function getEventCount($category = '')
	{		
			$sql = 'SELECT  count(h.home_id) as cnt FROM home as h  	
			INNER JOIN event as e ON h.event_id=e.id 
			WHERE h.event_id !=0 AND e.deleted = 0 AND e.status < 3 AND e.event_date >"'.date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y"))).'"';

			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
				
	        $all = Query::GetOne($sql);
	        return $all['cnt'];
	}	
	public static function getMusicList($page = '', $items_on_page = '', $category = '')
	{		
			$sql = 'SELECT  h.home_id as Id, h.music_album_id as AlbumId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category, hc.hc_name as CategoryName,  m.user_id as UserId, m.image as Image,m.title as Title 			
			FROM home as h 		
			INNER JOIN  music as m ON h.music_id=m.id 
			INNER JOIN home_category as hc ON h.home_cat=hc.hc_id 
			WHERE h.music_id !=0  AND m.deleted = 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
						
			$sql .=' ORDER BY h.home_order ASC';			
						
			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}	
									
			$res = Query::Execute($sql);
			return $res;
	}
	public static function getMusicCount($category = '')
	{		
			$sql = 'SELECT  count(h.home_id) as cnt FROM home as h  
			LEFT JOIN  music as m ON h.music_id=m.id 
			WHERE h.music_id !=0 AND m.deleted = 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}			

	        $all = Query::GetOne($sql);
	        return $all['cnt'];
	}	
	public static function getMusicAlbumListCount( $category = '' )
	{
		$sql = 'SELECT  count(ma.id) as cnt		
			FROM home as h 			
			INNER JOIN  music_album as ma ON h.music_album_id=ma.id 
			INNER JOIN user as u ON ma.user_id=u.id AND u.blocked = 0 AND u.email_confirmed = 1	
			INNER JOIN home_category as hc ON h.home_cat=hc.hc_id
			LEFT JOIN (SELECT SUM(m.price) AS TracksPrice, count(m.id) as Tracks,  album_id from music as m WHERE m.status = 0  GROUP BY m.album_id ) as summary ON summary.album_id = ma.id 
			WHERE h.music_album_id !=0  AND ma.deleted = 0 AND ma.active = 1 AND IFNULL(Tracks, 0)  > 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
		
		$albums = Query::GetOne($sql);

        return $albums['cnt'];
		
	}
	public static function getMusicAlbumList($page = '', $items_on_page = '', $category = '', $user_id = 0)
	{		

	$sql = 'SELECT  ma.id as MusicAlbumId,ma.price AS Price,h.home_id as Id, h.music_album_id as AlbumId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category, hc.hc_name as CategoryName,  ma.id as AlbumId, ma.user_id as UserId, ma.image as Image, h.image_path as Slide, ma.title as Title, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName, IFNULL(TracksPrice, 0) as TracksPrice,  IFNULL(Tracks, 0) as Tracks 			
			FROM home as h 			
			INNER JOIN  music_album as ma ON h.music_album_id=ma.id 
			INNER JOIN user as u ON ma.user_id=u.id AND u.blocked = 0 AND u.email_confirmed = 1		
			INNER JOIN home_category as hc ON h.home_cat=hc.hc_id 
			LEFT JOIN (SELECT SUM(m.price) AS TracksPrice, count(m.id) as Tracks,  album_id from music as m WHERE m.status = 0 GROUP BY m.album_id ) as summary ON summary.album_id = ma.id 
			WHERE h.music_album_id !=0  AND ma.deleted = 0 AND ma.active = 1 AND IFNULL(Tracks, 0)  > 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
			
						
			$sql .=' ORDER BY h.home_order ASC';
			

			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}						

	        $res = Query::GetAll( $sql );

		   foreach ($res as &$v)
			{
				//$v['Tracks'] = !empty($add_info[$v['MusicAlbumId']]['cnt']) ? $add_info[$v['MusicAlbumId']]['cnt'] : 0;
				//$v['TracksPrice'] = !empty($add_info[$v['MusicAlbumId']]['sum']) ? $add_info[$v['MusicAlbumId']]['sum'] : 0;
				$v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
				
				if($user_id)
				{
						$v['Fellow'] = UserFollow::GetFollow( $user_id, $v['UserId']);	
						
						$v['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
									 ->filterByUserId($user_id)
									 ->filterByWithAllAlbum($v['MusicAlbumId'])
									 ->findOne();	
				}			
			}
	
		return $res;
	/*
			$sql = 'SELECT  ma.id as MusicAlbumId,ma.price AS Price,h.home_id as Id, h.music_album_id as AlbumId, h.link as Link, h.home_order as HomeOrder, h.cdate as AddedData, h.home_cat as Category, hc.hc_name as CategoryName,  ma.id as AlbumId, ma.user_id as UserId, ma.image as Image, h.image_path as Slide, ma.title as Title, u.name as Name, u.first_name as FirstName, u.last_name as LastName, u.band_name as BandName 			
			FROM home as h 			
			LEFT JOIN  music_album as ma ON h.music_album_id=ma.id 
			INNER JOIN user as u ON ma.user_id=u.id 		
			LEFT JOIN home_category as hc ON h.home_cat=hc.hc_id 	
			WHERE h.music_album_id !=0  AND ma.deleted = 0 AND ma.active = 1';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
			
						
			$sql .=' ORDER BY h.home_order ASC';
			

			if ($items_on_page)
        	{
            	$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_on_page : '0') . ', ' . $items_on_page;
        	}						

	        $res = Query::GetAll( $sql );


			$ids_albums = array();
			foreach($res as $item)
			{
					if(!in_array($item['MusicAlbumId'], $ids_albums))
					{
						$ids_albums[] = $item['MusicAlbumId'];
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
				$v['Tracks'] = !empty($add_info[$v['MusicAlbumId']]['cnt']) ? $add_info[$v['MusicAlbumId']]['cnt'] : 0;
				$v['TracksPrice'] = !empty($add_info[$v['MusicAlbumId']]['sum']) ? $add_info[$v['MusicAlbumId']]['sum'] : 0;
				$v['Savings'] = ($v['Price'] < $v['TracksPrice']) ? round($v['TracksPrice'] - $v['Price'], 2) : 0;
				
				if($user_id)
				{
						$v['Fellow'] = UserFollow::GetFollow( $user_id, $v['UserId']);	
						
						$v['Purchase'] = MusicPurchaseQuery::create()->select(array('WithAllAlbum'))
									 ->filterByUserId($user_id)
									 ->filterByWithAllAlbum($v['MusicAlbumId'])
									 ->findOne();	
				}			
			}

		foreach($res  as $key => &$val)
		{
			if(!$val['Tracks'])
			{
				unset($res[$key]);
			}
		}					

		return $res;*/
	}
		
	public static function getMusicAlbumCount($category = '')
	{		
			$sql = 'SELECT  count(h.home_id) as cnt FROM home as h  

			INNER JOIN  music_album as ma ON h.music_album_id=ma.id 
			WHERE h.music_album_id !=0 AND ma.deleted = 0';
			
			if($category)
			{
				$sql .= ' AND h.home_cat ='.$category;
			}
						
	        $all = Query::GetOne($sql);
	        return $all['cnt'];
	}				
	
	public static function SaveHomePageArtist( $id, $link, $home_order = 0,  $home_cat, $cdate = 0)
	{		
			$sql = 'INSERT INTO home (artist_id, link, home_order, home_cat, cdate) VALUES ('.$id.', "'.$link.'", '.$home_order.', '.$home_cat.', '.$cdate.')';		
			$res = Query::Execute($sql);
			return $res;
	}
	public static function SaveHomePageVideo( $id, $link, $home_order = 0, $home_cat, $cdate = 0, $image ='')
	{		
			$sql = 'INSERT INTO home (video_id, link, home_order, home_cat, cdate, image_path) VALUES ('.$id.', "'.$link.'", '.$home_order.', '.$home_cat.', '.$cdate.', "'.$image.'")';	
			
			$res = Query::Execute($sql);
			return $res;
	}
	public static function SaveHomePageEvent( $id, $link, $home_order = 0,  $home_cat, $cdate = 0)
	{		
			$sql = 'INSERT INTO home (event_id, link, home_order, home_cat, cdate) VALUES ('.$id.', "'.$link.'", '.$home_order.', '.$home_cat.', '.$cdate.')';		
			$res = Query::Execute($sql);
			return $res;
	}	
	public static function SaveHomePageMusicAlbum( $id, $link, $home_order = 0,  $home_cat, $cdate = 0, $image = '')
	{		
			$sql = 'INSERT INTO home (music_album_id, link, home_order, home_cat, cdate, image_path) VALUES ('.$id.', "'.$link.'", '.$home_order.', '.$home_cat.', '.$cdate.', "'.$image.'")';		
			$res = Query::Execute($sql);
			return $res;
	}
    public static function DeleteLink( $id )
    {
		$sql = 'DELETE FROM home WHERE home_id ='.$id;
		$res = Query::Execute($sql);
		return $res;
    }
		
    public static function SaveHomeOrder( $id, $h_order )
    {
		$sql = 'UPDATE home SET home_order ='.$h_order.' WHERE home_id ='.$id;
		$res = Query::Execute($sql);
		return $res;
    }		
    /**
     * Get last artist wall message id
     * @param $user_id
     * @return int
     */
    public static function GetLastId( $link_type )
    {
		$sql = 'SELECT max(home_order) as last_id FROM home WHERE '.$link_type.' != 0';

        $all = Query::GetOne($sql);
        return $all['last_id'];
    }	
			
} // Home
