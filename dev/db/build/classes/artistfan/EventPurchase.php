<?php



/**
 * Skeleton subclass for representing a row from the 'event_purchase' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class EventPurchase extends BaseEventPurchase {

    public static function Get( $user_id, $event_id )
    {
        return EventPurchaseQuery::create()->select(array('Id', 'Pdate', 'Price', 'Code'))
            ->filterByUserId($user_id)
            ->filterByEventId($event_id)
            ->findOne();
    }

    /**
     * Purchase event access
     * @static
     * @param $user_id
     * @param $event_id
     * @return boolean true
     */
    public static function Purchase($user_id, $event_id, $price)
    {
        $mPurchase = new EventPurchase();
        $mPurchase->setUserId($user_id);
        $mPurchase->setEventId($event_id);
        $mPurchase->setPrice($price);
        $mPurchase->setCode(self::GenerateAccessCode($price));
        $mPurchase->setPdate(mktime());
        $mPurchase->save();
        return true;
    }

    public static function GenerateAccessCode($price)
    {
        $code = 'free';
        if($price > 0)
        {
            $code = substr(md5(mktime() . rand(11, 99)), 0, 10);
        }
        return $code;
    }

    public static function GetEventPurchased($event_id)
    {
        $list = EventPurchaseQuery::create()->select(array('UserId', 'EventId', 'Price'))
                -> filterByEventId($event_id)
                -> find() -> toArray();
        return $list;
    }

    public static function GetEventSum($event_id)
    {
        $sumpurchase = EventPurchaseQuery::create()->select(array('EventId'))
                -> withColumn('SUM(EventPurchase.Price)', 'sum')
                -> filterByEventId($event_id)
                -> findOne();
        if(!empty($sumpurchase))
        {
            return $sumpurchase['sum'];
        }
        return 0;
    }

    /**
     * Delete fan's purchase
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserPurchase( $user_id )
    {
        EventPurchaseQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Delete event purchase
     * @param int $id - event id
     * @return bool
     */
    public static function DeleteEventPurchase( $id )
    {
        EventPurchaseQuery::create() -> select(array('Id'))
                -> filterByEventId($id)
                -> delete();
        return true;
    }
} // EventPurchase
