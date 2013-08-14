<?php



/**
 * Skeleton subclass for representing a row from the 'video_purchase' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class VideoPurchase extends BaseVideoPurchase
{

    public static function  Get($user_id, $video_id)
    {
        return VideoPurchaseQuery::create()->select(array('Id', 'Pdate'))
                ->filterByUserId($user_id)
                ->filterByVideoId($video_id)
                ->findOne();
    }


    /**
     * Purchase music track
     * @static
     * @param $user_id
     * @param $music_id
     * @param $price
     * @return boolean true
     */
    public static function Purchase($user_id, $music_id, $price, $is_delete = 0)
    {
        $mPurchase = new VideoPurchase();
        $mPurchase->setUserId($user_id);
        $mPurchase->setVideoId($music_id);
        $mPurchase->setPrice($price);
		 $mPurchase->setIsDelete($is_delete);
        $mPurchase->setPdate(mktime());
        $mPurchase->save();
        return true;
    }


    public static function GetPurchaseList($user_id)
    {
        return VideoQuery::create()->select(array('Id', 'Video', 'Title'))
                ->leftJoin('User u')
                ->rightJoin('VideoPurchase mp')
                ->where('mp.user_id = ' . (int)$user_id)
                ->find()->toArray();
    }

    /**
     * Delete fan's purchase
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserPurchase( $user_id )
    {
        VideoPurchaseQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Delete video purchase
     * @param int $id - video id
     * @return bool
     */
    public static function DeleteVideoPurchase( $id )
    {
        VideoPurchaseQuery::create() -> select(array('Id'))
                -> filterByVideoId($id)
                -> delete();
        return true;
    }
    public static function PurchaseDeleteUpdate($user_id, $video_ids)
    {
        VideoPurchaseQuery::create() -> select(array('Id'))
                -> filterByUserId($user_id) -> filterByVideoId($video_ids, Criteria::IN)
                -> update(array('IsDelete' => 1));
        return true;
    }	

} // VideoPurchase
