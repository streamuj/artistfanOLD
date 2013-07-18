<?php
/**
 * Skeleton subclass for representing a row from the 'photo' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */  
class Photo extends BasePhoto {
 
    /**
     * Get photo by Id
     * @param int $id
     * @return array
     */
 	  
    public static function GetPhoto( $id )
    {
				
        $photo = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image' , 'Slide' , 'Price',  'IsCover', 'Pdate', 'WallId'))
                ->filterById($id)->findOne();
        return $photo;
    }
	
    public static function BuyPhoto( $id )
    {
        $buyphoto = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image' ,  'Slide'  , 'Price', 'IsCover', 'Pdate'))
                ->filterById($id)->findOne();								
        return $buyphoto;
    }	

    /**
     * Get photo list
     * @param int $user_id
     * @param int $album_id
     * @return array
     */
	 
    public static function GetPhotoList( $user_id, $album_id , $page = 0 , $items_on_page = 0 )
    {
		$list = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image',  'Slide' , 'Price', 'IsCover', 'Pdate','WallId'))
          				->filterByUserId($user_id)->filterByAlbumId($album_id);
	    if ($items_on_page)
        {
            $list = $list->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);			 
        }	
        $list = $list->orderByPdate('DESC')->find()->toArray();
		$start = ($page - 1) * $items_on_page;		
						
		return $list;
		
    }
	
    /**
     * Get User Photos 
     * @param int $user_id
     * @return array
     */
    public static function GetUserPhotosCount( $user_id )
    {
        $sql = 'SELECT count(id) as cnt FROM photo WHERE user_id = '.$user_id;
        $all = Query::GetOne($sql);
        return $all['cnt'];
	}	 
	
    public static function GetUserPhotos($user_id, $page = 0, $items_on_page = 0)
    {

        $list = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image',  'Slide' , 'Price', 'IsCover', 'Pdate'))
                ->filterByUserId($user_id);

	    if ($items_on_page)
        {
            $list = $list->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
			 
        }	
        $list = $list->orderByPdate('DESC')->find()->toArray();

		return $list;
		
    }
	
	 
    /**
     * Add photo
     * @param int $user_id
     * @param int $album_id
     * @param string $image
     * @param string $title
     * @param string $photo_date
     * @return int
     */
    public static function AddPhoto( $user_id, $album_id, $image, $slide = '', $price,  $title = '', $photo_date = '', $is_cover = 0,$link = '', $is_new = 0)
    {
       
	  
	    $photo = new Photo();
        $photo->setUserId($user_id);
        $photo->setAlbumId($album_id);
        $photo->setImage($image);
        $photo->setTitle($title);
		$photo->setSlide($slide);
		$photo->setPrice($price);
        $photo->setIsCover($is_cover);
        $photo->setPhotoDate(!empty($photo_date) ? $photo_date : date('Y-m-d'));
        $photo->setPdate(mktime());
        $photo->setLink($link);
        $photo->setIsNew($is_new);				
        $photo->save();
        return $photo->getId();
    }	
	
	public static function UpdatePhotoWallId($photoId, $wallId)
	{
		$sql = "UPDATE photo SET wall_id = $wallId WHERE id=$photoId";
		Query::Execute($sql);
		return true;
	}

    /**
     * Edit photo
     * @param int $id
     * @param array $update
     * @return true
     */
    public static function EditPhoto( $id, $update)
    {
        PhotoQuery::create()->select(array('Id'))->filterById($id)->update($update);
        return true;
    }

	public static function EditPhotoName($id, $title)
    {
		
        PhotoQuery::create()->select(array('Id'))->filterById($id)->update(array('Title' => $title));
        return true;
    }
    /**
     * Make photo cover of album
     * @param int $id
     * @param int $album_id
     * @return true
     */
    public static function MakeCover( $id, $album_id )
    {
        PhotoQuery::create()->select(array('Id'))->filterByAlbumId($album_id)->update(array('IsCover' => 0));
        PhotoQuery::create()->select(array('Id'))->filterById($id)->update(array('IsCover' => 1));
        return true;
    }

    /**
     * Remove photo
     * @param int $id
     * @return true
     */
    public static function Remove( $id )
    {
        PhotoQuery::create()->select(array('Id'))->filterById($id)->delete();
        return true;
    }

    /**
     * Get prev and next photos ids in album
     * @param int $album_id
     * @param int $current_id
     * @return array
     */
    public static function GetPrevNext( $album_id, $current_id )
    {
        $result = array('prev' => 0, 'next' => 0);
        //all albums photos ids
        $list = PhotoQuery::create()->select(array('Id'))
                ->filterByAlbumId($album_id)->orderByPhotoDate('ASC')->find()->toArray();
        foreach($list as $k=>$v)
        {
            if($v == $current_id)
            {
                $result['prev'] = !empty($list[$k-1]) ? $list[$k-1] : 0;
                $result['next'] = !empty($list[$k+1]) ? $list[$k+1] : 0;
                break;
            }
        }
        return $result;
    }
	// buy photo 
public static function GetPhotoListWithPurchase($artist_id, $user_id_purchase, $Photo_id = 0, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0)
    {	  	  
	
		$sql = "SELECT * FROM `photo_purchase` where user_id = $user_id_purchase and photo_id = $Photo_id";			  
		$result 		= Query::GetAll( $sql );	   		
		// to get the photo purchase details 
		 return $result;	    	
	
	}

public static function GetCheckPurchasedPhoto($Photo_id,$user_id_purchase)
    {
		$sql = "SELECT * FROM `photo_purchase` where user_id = $user_id_purchase and photo_id = $Photo_id";			  
		$res	=	Query::GetAll( $sql );	 
		return  $res;		
	}
	
	/**
	 * Get slider photos
	 * @param int $user_id
	 */
	  public static function GetSliderList($user_id, $status = '')
		{
		  $sql  = "SELECT *  FROM photo where user_id = $user_id AND slide != 0 ORDER BY id DESC";
			  if($status == 1)
			  {
			   $sql = $sql." LIMIT 0,1";
			  }
			  else
			  {
			   $sql = $sql." LIMIT 0,5";
			  }
			  $res  = Query::GetAll( $sql );  
			  return $res;
		  
		}
    /**
     * Get photo list
     * @param int $user_id
     * @param int $album_id
     * @return array
     */
	 
    public static function GetPhotosListFromAlbum( $user_id, $album_id)
    {						
		$sql	=	"SELECT p.id as Id, p.user_id as UserId, p.title as Title, p.album_id as AlbumId, p.photo_date as PhotoDate, p.image as Image, p.slide as Slide, p.price as Price, p.is_cover as IsCover, p.pdate as Pdate, ifnull(purchased, 0) as purchased
from photo as p
left join (select 1 as purchased, photo_id FROM photo_purchase where user_id = '".$_SESSION['system_uid']."') as pp 
on pp.photo_id = p.id where p.user_id = '".mysql_escape_string($user_id)."' AND p.album_id ='".mysql_escape_string($album_id)."'";	
		$res  =	Query::GetAll( $sql );												
		return $res;
		
    }	
    /**
     * Get Admin user photo count
     *
     */
    public static function AdminPhotoCount($id, $status,  $mCache = '')
    {
		 //get from cache
        if (!empty($mCache))
        {
            $all = $mCache->get('admin_photo_count_onwall' . $id, 12*3600);
            if (!empty($all))
            {
                return @unserialize($all);
            }
        }	
		if($status == 2)
        $sql = 'SELECT count(pp.id) as count, sum(pp.price) as price FROM  photo_purchase pp LEFT JOIN photo p ON pp.photo_id = p.id  WHERE p.user_id = '.$id;
		else
		$sql = 'SELECT count(pp.id) as count, sum(pp.price) as price FROM  photo_purchase pp WHERE pp.user_id = '.$id;
		
        $all = Query::GetOne($sql);
		//save to cache
        if (!empty($mCache))
        {
            $mCache->set('admin_photo_count_onwall' . $id, serialize($all), 12*3600);
        }		
        return $all;
    }
    public static function PhotoCounts($id)
	{
		$sql =	'SELECT count(id) as AllPhotos,id as Id,user_id as UserId,title as Title,album_id as AlbumId,pdate as Pdate,image as Image, slide as Slider,is_cover as Cover FROM `photo` where user_id = '.$id.''; 			
        $all = Query::GetAll($sql);		
		return $all[0];
	}		
    public static function ShowPhotoAll($user_id,$page = 0, $items_on_page = 0)
	{
        $list = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image',  'Slide' , 'Price', 'IsCover', 'Pdate'))
                ->filterByUserId($user_id);
	    if ($items_on_page)
        {
            $list = $list->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);			 
        }	
        $list = $list->orderByPdate('DESC')->find()->toArray();
		$start = ($page - 1) * $items_on_page;		
		return $list;		
    }
	
	// Get Max of Photo Id
	
	public static function GetMaxPhotoId($albumId){
	
		$sql ='SELECT max(id) as id FROM photo WHERE album_id='.$albumId;
		$id = Query::GetOne($sql);	
		return $id;
	}
	
	public static function GetMaxProfilePhotoId($title, $user_id)
	{
		$sql ='SELECT max(id) as id FROM photo WHERE title="'.$title.'" AND user_id = '.$user_id;
		$id = Query::GetOne($sql);	
		return $id;
	}	
	public static function GetMaxBannerAlbumId($title, $user_id)
	{
		$sql ='SELECT max(id) as id FROM photo_album WHERE title="'.$title.'" AND user_id = '.$user_id;
		$id = Query::GetOne($sql);	
		return $id;
	}
		
	public static function GetCountAllPhotoAlbum($u_id)
	{	
		$sql =	'SELECT count(id) as CountAlbum FROM photo_album where user_id = '.$u_id; 					
        $all = Query::GetOne($sql);		
		
		
		$sql =	'SELECT count(id) as CountPhoto FROM photo where user_id = '.$u_id; 			
		$allc= Query::GetOne($sql);	
		
		$count = array('CountAlbum'=> $all['CountAlbum'], 'CountPhoto' =>  $allc['CountPhoto']);
		
		return $count;
 		
	}
	
	
	public static function GetWallPhotoDetails($u_id)
	{	
		$sql =	'SELECT * FROM photo where wall_id = '.$u_id; 					
        $all = Query::GetOne($sql);		
		return $all;
	}
	
	
	
	
} // Photo
