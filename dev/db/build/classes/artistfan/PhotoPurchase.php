<?php



/**
 * Skeleton subclass for representing a row from the 'photo_purchase' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */  
class PhotoPurchase extends BasePhotoPurchase {

 public static function Purchase($user_id, $music_id, $price, $all_album = 0, $is_delete = 0)
    {
		
        $mPurchase = new PhotoPurchase();
        $mPurchase->setUserId($user_id);
        $mPurchase->setPhotoId($music_id);
        $mPurchase->setWithAllAlbum($all_album);
        $mPurchase->setPrice($price);
		$mPurchase->setIsDelete($is_delete);
        $mPurchase->setPdate(mktime());
        $t = $mPurchase->save();

		
        return true;
    }
	
    public static function  Get( $user_id, $photo_id )
    {
	
		$sql = "SELECT * FROM  `photo` INNER JOIN photo_purchase ON photo.id = photo_purchase.photo_id WHERE photo_purchase.photo_id = $photo_id AND photo_purchase.user_id	= $user_id";
		$res = Query::GetOne( $sql );
	
		return $res;	
       
    }
	
	
} // PhotoPurchase
