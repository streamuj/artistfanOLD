<?php



/**
 * Skeleton subclass for representing a row from the 'event_attend' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class EventAttend extends BaseEventAttend {

    public static function Get( $user_id, $event_id )
    {
        return EventAttendQuery::create()->select(array('Id', 'Pdate'))
            ->filterByUserId($user_id)
            ->filterByEventId($event_id)
            ->findOne();
    }

    /**
     * Add event to fan's event list
     * @static
     * @param $user_id
     * @param $event_id
     * @return boolean true
     */
    public static function Attend($user_id, $event_id)
    {
        $mAttend = new EventAttend();
        $mAttend->setUserId($user_id);
        $mAttend->setEventId($event_id);
        $mAttend->setPdate(mktime());
        $mAttend->save();
        return true;
    }

    /**
     * Remove event from fan's event list
     * @static
     * @param $user_id
     * @param $event_id
     * @return boolean true
     */
    public static function Remove($user_id, $event_id)
    {
        EventAttendQuery::create()->select(array('Id'))
                ->filterByUserId($user_id)
                ->filterByEventId($event_id)
                ->delete();
        return true;
    }

    public static function GetAttendList($user_id)
    {
        return EventQuery::create()->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType',
              'Location', 'EventDate', 'Pdate'))
                ->rightJoin('EventAttend at')
                ->where('at.user_id = ' . (int)$user_id)
                ->find()->toArray();
    }

    /**
     * Get events from fan's list count
     * @param int $user_id - User ID
     */
    public function EventsAttendCount( $user_id_attend, $periods = array() )
    {
        $events = EventQuery::create() ->select('Id')->rightJoin('EventAttend at')->where('at.user_id = ' . (int)$user_id_attend);
        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        return $events->count();
    }

    /**
     * Get events from fan's list
     * @param int $user_id - User ID
     */
    public static function EventsAttendList( $user_id_attend, $page = 0, $items_on_page = 0, $periods = array() )
    {
        $events = EventQuery::create() ->select(array('Id', 'UserId', 'Title', 'Descr', 'EventType',
              'Location', 'EventDate', 'Pdate'))->rightJoin('EventAttend at')->where('at.user_id = ' . (int)$user_id_attend);

        if (!empty($periods['from']))
        {
           $events = $events->filterByEventDate($periods['from'], '>=');
        }

        if (!empty($periods['to']))
        {
            $events = $events->filterByEventDate($periods['to'], '<');
        }

        $events=$events->orderByEventDate('DESC');

        if ($items_on_page)
        {
            $events = $events->setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page);
        }
        return $events->find()->toArray();
    }

    /**
     * Delete fan's purchase
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserPurchase( $user_id )
    {
        EventsAttendQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Delete event attend
     * @param int $id - event id
     * @return bool
     */
    public static function DeleteEventAttend( $id )
    {
        EventAttendQuery::create() -> select(array('Id'))
                -> filterByEventId($id)
                -> delete();
        return true;
    }
} // EventAttend
