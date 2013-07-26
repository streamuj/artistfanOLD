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
				
        $photo = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image' , 'Slide' , 'Price',  'IsCover', 'Pdate'))
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
    public static function GetPhotoList( $user_id, $album_id)
    {
<<<<<<< .mine
		$photo = new Photo();
=======
>>>>>>> .r516
        $list = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image',  'Slide' , 'Price', 'IsCover', 'Pdate'))
                ->filterByUserId($user_id)->filterByAlbumId($album_id);
				
		return $list;
		
    }
    /**
     * Get User Photos 
     * @param int $user_id
     * @return array
     */
    public static function GetUserPhotos( $user_id)
    {
        $list = PhotoQuery::create()->select(array('Id', 'UserId', 'Title', 'AlbumId', 'PhotoDate', 'Image',  'Slide' , 'Price', 'IsCover', 'Pdate'))
                ->filterByUserId($user_id)
				->orderByPhotoDate('ASC')
				->find()->toArray();
				
<<<<<<< .mine
				
       /* if ($album_id)
        {
            $list = $photo->filterByAlbumId($album_id);
        }	
				*/	
=======
>>>>>>> .r516
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
    public static function AddPhoto( $user_id, $album_id, $image, $slide = '', $price,  $title = '', $photo_date = '', $is_cover = 0)
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
        $photo->save();
        return $photo->getId();
    }

    /**
     * Edit photo
     * @param int $id
     * @param array $update
     * @return true
     */
    public static function EditPhoto( $id, $update )
    {
        PhotoQuery::create()->select(array('Id'))->filterById($id)->update($update);
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
public static function GetPhotoListWithPurchase($user_id, $user_id_purchase, $album_id = 0, $active = 1, $page = 0, $items_on_page = 0, $album_info = 0, $artist_info = 0)
    {
       
			   
//	   $sql		=		"SELECT user_id,title,album_id,photo_date,image,slide,price,is_cover,pdate FROM photo LEFT JOIN photo_purchase ON photo.user_id = photo_purchase.user_id where photo_purchase.user_id = $user_id_purchase ";
		//to get the photo from the album 
	//  $sql		=		"SELECT * FROM `photo` INNER JOIN photo_album ON photo_album.id = photo.album_id where photo.id = $album_id";
//	  $sql	=	"SELECT * FROM  `photo` INNER JOIN photo_purchase ON photo.id = photo_purchase.photo_id WHERE photo_purchase.user_id = $user_id;";			  	  
		$sql	= "SELECT * FROM `photo` where id = $album_id";
	    $result 		= Query::GetAll( $sql );	   		

		// to get the photo purchase details 
		

		  return $result;
	    	
	
	}

public static function GetCheckPurchasedPhoto($id)
    {
		$sql	=	"SELECT *  FROM `photo_purchase` where photo_id = $id";
		$res	=	Query::GetAll( $sql );	 	
		return  $result;		
	}
	
} // Photo
