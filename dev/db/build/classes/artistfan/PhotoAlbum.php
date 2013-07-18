<?php



/**
 * Skeleton subclass for representing a row from the 'photo_album' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class PhotoAlbum extends BasePhotoAlbum {
    /**
     * Get photo album by Id
     * @param int $id
     * @return array
     */
    public static function GetAlbum( $id  )
    {
	//deb($id);
        $album = PhotoAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Pdate'))
                ->leftJoinPhoto()
                ->addJoinCondition('Photo', 'Photo.IsCover = 1')
                ->withColumn('Photo.Image', 'Cover')
                ->filterById($id)->findOne();
        return $album;
    }
 	

    /**
     * Get user's photo albums list
     * @param int $user_id
     * @return array
     */
    public static function GetAlbumList( $user_id, $with_cover = 1, $with_counts = 1, $page = 0, $items_on_page = 0 )
    {
			
        $list = PhotoAlbumQuery::create()->select(array('Id', 'UserId', 'Title', 'Pdate'))
                ->filterByUserId($user_id);
		if ($items_on_page)
        {
            $list = $list->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page); 
        }				
		$list = $list->find()->toArray();	
		$start = ($page - 1) * $items_on_page;
			
        if($with_cover)
        {
            $cvr = array();
            $covers = PhotoQuery::create()->select(array('AlbumId', 'Image'))
                    ->filterByUserId($user_id)
                    ->filterByIsCover(1)
                    ->find()->toArray();
            if(!empty($covers))
            {
                foreach($covers as $item)
                {
				   //$cvr[$item['AlbumId']] = $item['Image'];
					//$cvr[$item['AlbumId']] = waterMark($stamp='stamp.jpg',$item['Image']);
	

				 	$cvr[$item['AlbumId']] = $item['Image'];
                }
			
                unset($covers);
                unset($item);
            }
            foreach($list as &$item)
            {
                $item['Cover'] = !empty($cvr[$item['Id']]) ? $cvr[$item['Id']] : '';
            }
            unset($item);
            unset($cvr);
        }

        if($with_counts)
        {
            //count photos in each album
            $cnt = array();
            $counts = PhotoQuery::create()->select(array('AlbumId'))
                    ->withColumn('Count(Photo.Id)', 'cnt')
                    ->groupBy('Photo.AlbumId')
                    ->filterByUserId($user_id)
                    ->find()->toArray();
            if(!empty($counts))
            {
                foreach($counts as $item)
                {
                    $cnt[$item['AlbumId']] = $item['cnt'];
                }
                unset($counts);
                unset($item);
            }
            foreach($list as &$item)
            {
                $item['CountPhotos'] = !empty($cnt[$item['Id']]) ? $cnt[$item['Id']] : 0;			
						
            }
            unset($item);
            unset($cnt);
        }
        return $list;
    }

    /**
     * Add new photo album
     * @param int $user_id
     * @param string $title
     * @return int
     */
    public static function AddAlbum($user_id, $title)
    {
        $pAlbum = new PhotoAlbum();
        $pAlbum->setUserId($user_id);
        $pAlbum->setTitle($title);
        $pAlbum->setPdate(mktime());
        $pAlbum->save();
        return $pAlbum->getId();
    }
	
    public static function UpdateDateAlbum($album_id)
    {
        PhotoAlbumQuery::create()->select(array('Id'))->filterById($album_id)->update(array('Pdate' => mktime()));
        return true;
    }
	

    /**
     * Edit photo album
     * @param int $album_id
     * @param string $title
     * @return true
     */
    public static function EditAlbum($album_id, $title)
    {
        PhotoAlbumQuery::create()->select(array('Id'))->filterById($album_id)->update(array('Title' => $title));
        return true;
    }

    /**
     * Remove photo album with all photos
     * @param int $id
     * @return true
     */
    public static function Remove( $id )
    {
        PhotoQuery::create()->select(array('Id'))->filterByAlbumId($id)->delete();
        PhotoAlbumQuery::create()->select(array('Id'))->filterById($id)->delete();
        return true;
    }

    /**
     * Get count photos in album by album Id
     * @param int $album_id
     * @return int
     */
    public static function GetAlbumCountPhotos( $album_id )
    {
        $count = PhotoQuery::create()->select(array('Id'))
                ->filterByAlbumId($album_id)->count();
        return $count;
    }

    /**
     * Make single photo album cover
     * @param int $album_id
     * @return true
     */
    public static function MakeSinglePhotoCover($album_id)
    {
        PhotoQuery::create()->select(array('Id'))->filterByAlbumId($album_id)->update(array('IsCover' => 1));
        return true;
    }
	
	public static function getProfilePictureAlbum($user_id)
	{		
		$sql = "select id FROM photo_album WHERE user_id=".$user_id." AND title='".PROFILE_PICTURES."' ";
		$res = Query::GetOne($sql);
		return $res['id'];	
	}
	
	public static function getexistalbumbytitle($title)
	{
		$sql 	= "SELECT id FROM `photo_album` where title = '".$title."'";
		$res = Query::GetOne($sql);		
		return $res['id'];		
	}
	
} // PhotoAlbum
