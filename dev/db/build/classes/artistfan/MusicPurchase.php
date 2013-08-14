<?php


/**
 * Skeleton subclass for representing a row from the 'music_purchase' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class MusicPurchase extends BaseMusicPurchase {


    public static function  Get( $user_id, $music_id )
    {
        return MusicPurchaseQuery::create()->select(array('Id', 'Pdate', 'WithAllAlbum'))
            ->filterByUserId($user_id)
            ->filterByMusicId($music_id)
            ->findOne();
    }
	
	public static function GetAlbum($user_id, $album_id)
	{
		return MusicPurchaseQuery::create()->select(array('Id', 'Pdate', 'WithAllAlbum'))
            ->filterByUserId($user_id)
            ->filterByWithAllAlbum($album_id)
			->filterByMusicId(0)
            ->findOne();
	}


    /**
     * Purchase music track
     * @static
     * @param $user_id
     * @param $music_id
     * @param $price
     * @param $all_album
     * @return boolean true
     */
    public static function Purchase($user_id, $music_id, $price, $all_album = 0, $is_delete = 0)
    {
        $mPurchase = new MusicPurchase();
        $mPurchase->setUserId($user_id);
        $mPurchase->setMusicId($music_id);
        $mPurchase->setWithAllAlbum($all_album);
        $mPurchase->setPrice($price);
		$mPurchase->setIsDelete($is_delete);
        $mPurchase->setPdate(mktime());
        $mPurchase->save();
        return true;
    }


    public static function GetPurchaseList($user_id)
    {
        return MusicQuery::create()->select(array('Id', 'Track', 'Title', 'WithAllAlbum'))
                ->leftJoin('User u')
                ->rightJoin('MusicPurchase mp')
                ->where('mp.user_id = u'.(int)$user_id)
                ->find()->toArray();
    }

    /**
     * Update purchase music track (by purchase album)
     * @static
     * @param $user_id
     * @param $music_ids
     * @return boolean true
     */
    public static function PurchaseUpdate($user_id, $music_ids, $albumId)
    {
        MusicPurchaseQuery::create() -> select(array('Id'))
                -> filterByUserId($user_id) -> filterByMusicId($music_ids, Criteria::IN)
                -> update(array('WithAllAlbum' => $albumId));
        return true;
    }

    /**
     * Delete music purchase
     * @param array $ids - track's ids
     * @return bool
     */
    public static function DeleteMusicPurchase( $ids )
    {
        MusicPurchaseQuery::create() -> select(array('Id'))
                -> filterByMusicId($ids, Criteria::IN)
                -> delete();
        return true;
    }

    public static function PurchaseDeleteUpdate($user_id, $music_ids)
    {
        MusicPurchaseQuery::create() -> select(array('Id'))
                -> filterByUserId($user_id) -> filterByMusicId($music_ids, Criteria::IN)
                -> update(array('IsDelete' => 1));
        return true;
    }	

    /**
     * Delete fan's purchase
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserPurchase( $user_id )
    {
        MusicPurchaseQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

	public static function GetPurchasedMusicList($user_id)
	{
		$sql	=	"SELECT * FROM `music_purchase` where user_id = ".$user_id."";
		//deb($sql);
		$all 	= 	Query::GetAll($sql);
		return $all;
	}
	
	
} // MusicPurchase
