<?php



/**
 * Skeleton subclass for representing a row from the 'shopping_log' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class ShoppingLog extends BaseShoppingLog {

    /**
     * Add record to shopping log
     * @param int $artist_id
     * @param int $user_id
     * @param string $action
     * @param array $data
     */ 
    public static function LogAdd( $artist_id, $user_id, $action, $data = array(), $mCache = '' )
    {
        $mShoppingLog = new ShoppingLog();
        $mShoppingLog->setUserId($user_id);
        $mShoppingLog->setArtistId($artist_id);
        $mShoppingLog->setAction($action);
        $mShoppingLog->setData(serialize($data));
		
        switch($action)
        {
            case 'buy_track':
                $mShoppingLog->setMoney($data['Price']);
                $mShoppingLog->setMusicId($data['Id']);
                break;
            case 'buy_album':
                $mShoppingLog->setMoney($data['Price']);
                $mShoppingLog->setAlbumId($data['Id']);
                break;
            case 'buy_video':
                $mShoppingLog->setMoney($data['Price']);
                $mShoppingLog->setVideoId($data['Id']);
                break;
            case 'buy_photo':
				$mShoppingLog->setMoney($data['Price']);
//                $mShoppingLog->setPhotoId($data['Id']);
                break;
			case 'follow':

                break;
            case 'unfollow':

                break;
            case 'buy_access':
                $mShoppingLog->setMoney($data['Price']);
                $mShoppingLog->setEventId($data['Id']);
                break;
        }
        $wall_last_id = Wall::GetLastId($artist_id);
        
		$mShoppingLog->setWallId($wall_last_id);
        $mShoppingLog->setPdate(time());
        $mShoppingLog->save();
		
        $id = $mShoppingLog->getId();
        //save to cache
        if (!empty($mCache))
        {
            $mCache->set($artist_id. '_wall_log_last', $id, 30*24*60*60);
        }
    }

    /**
     * Get incoming sum credits for today
     * @param int $user_id
     * @return float
     */
    public static function GetPointsForToday( $user_id )
    {
        $dstart = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $dend = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
		
        $sum = ShoppingLogQuery::create()->select(array('ArtistId'))
                ->withColumn('SUM(Money)', 'sum')
                ->filterByArtistId($user_id)
                ->filterByPdate($dstart, Criteria::GREATER_EQUAL)
                ->filterByPdate($dend, Criteria::LESS_EQUAL)
                ->findOne();
        if(!empty($sum['sum']))
        {
            return round($sum['sum'], 2);
        }
        return 0;
    }

    /**
     * Delete shopping log
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserLog( $user_id )
    {
        ShoppingLogQuery::create()->select(array('Id'))->filterByArtistId($user_id)->delete();
        ShoppingLogQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Delete shopping log related to specified content
     * @param string $content_type
     * @param array $ids
     * @return bool
     */
    public static function DeleteLog( $content_type, $ids )
    {
        $fordelete = ShoppingLogQuery::create()->select(array('Id'));
        switch ($content_type)
        {
            case 'track':
                $fordelete = $fordelete -> filterByMusicId($ids, Criteria::IN);
                break;
            case 'album':
                $fordelete = $fordelete -> filterByAlbumId($ids, Criteria::IN);
                break;
            case 'video':
                $fordelete = $fordelete -> filterByVideoId($ids, Criteria::IN);
                break;
            case 'event':
                $fordelete = $fordelete -> filterByEventId($ids, Criteria::IN);
                break;
        }
        $fordelete->delete();
        return true;
    }

} // ShoppingLog
