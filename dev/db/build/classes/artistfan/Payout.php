<?php
/**
 * Skeleton subclass for representing a row from the 'payout' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */ 
class Payout extends BasePayout
{
     /**
      * Payout statuses:
      * 0 - pending
      * 1 - complete
      * 3 - canceled
      */

 
    /**
     * Payout money for artist
     */ 
    public static function PayoutMoney($user_id, $type, $method, $money, $balance, $user_from = 0, $status = 0, $descr = array(), $pinfo_id = 0)
    {
        //add payout query
        $mPm = new Payout();
        $mPm->setUserId($user_id);
        $mPm->setUserFrom($user_from);
        $mPm->setPtype($type);
        $mPm->setMethod($method);
        $mPm->setMoney($money);
        $mPm->setBalance($balance);
        $mPm->setPdate(mktime());
        $mPm->setStatus($status);
        $mPm->setDescription(!empty($descr) ? serialize($descr) : '');
        $mPm->setPaymentInfoId($pinfo_id);
        $mPm->save();

        return $mPm->getId();
    }

    public static function UpdatePayout($id, $update)
    {
        PayoutQuery::create()->select('Id')->filterById($id)->update($update);
    }

    public static function CancelPayout($id)
    {
        PayoutQuery::create()->select('Id')->filterById($id)->update(array('Status' => 3));
    }

    public static function ChangePayoutStatus($id, $status,$desc)
    {
        PayoutQuery::create()->select('Id')->filterById($id)->update(array('Status' => $status,'Description' => $desc));
    }

    public static function GetOne($id, $user_id = 0)
    {
        $payout = PayoutQuery::create()->select(array('Id', 'UserId', 'Method', 'Ptype', 'Money', 'Balance', 'Pdate', 'Status', 'UserFrom',
                'Description', 'PaymentInfoId', 'u.Email', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Status'))
                    -> leftJoin('User u');
        if($user_id)
        {
            $payout = $payout->filterByUserId($user_id);
        }
        $payout = $payout->filterById($id)->findOne();
        $payout['Description'] = !empty($payout['Description']) ? @unserialize($payout['Description']) : array();
        return $payout;
    }

    /**
     * Get payments list
     * @return array()
     */
    public function PaymentsList($user_id, $status = -1, $sort = '', $user_from = -1, $page = 0, $items_on_page = 0, $from_info = 0, $to_info = 0, $trans_his = 0)
    {


        $payouts = PayoutQuery::create()->select(array('Id', 'Method', 'Ptype', 'Money', 'Balance', 'Pdate', 'Status', 'UserFrom',
                        'Description', 'PaymentInfoId'))
                        ->filterByUserId($user_id);

        if ($status != -1)
        {
            $payouts = $payouts->filterByStatus($status);
        }

        //check payment type - In or Out
        if ($user_from != -1)
        {
            $payouts = $payouts->where($user_from ? 'user_from <> 0' : 'user_from = 0');
        }

        if ($items_on_page)
        {
            $payouts = $payouts->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        }

        switch ($sort)
        {
            case 'dta':
                $payouts = $payouts->orderByPdate('ASC');
                break;
            case 'pd':
                $payouts = $payouts->orderByMoney('ASC');
                break;
            case 'pdd':
                $payouts = $payouts->orderByMoney('DESC');
                break;
            case 'bd':
                $payouts = $payouts->orderByBalance('ASC');
                break;
            case 'bdd':
                $payouts = $payouts->orderByBalance('DESC');
                break;
            default:
                $payouts = $payouts->orderByPdate('DESC');
                break;
        }
        $payouts = $payouts->find()->toArray();

        foreach($payouts as &$item)
        {
            $item['Description'] = !empty($item['Description']) ? @unserialize($item['Description']) : array();
        }
        unset($item);

        if($from_info)
        {
            $from_ids = array();
            foreach($payouts as &$item)
            {
				
                if(!empty($item['UserFrom']) && !in_array($item['UserFrom'], $from_ids))
                {
                    $from_ids[] = $item['UserFrom'];
                }
            }
            if(count($from_ids) > 0)
            {
                $users_from = User::GetUsersNames($from_ids);
                foreach($payouts as &$item)
                {
                    $item['From'] = !empty($item['UserFrom']) && !empty($users_from[$item['UserFrom']]) ? $users_from[$item['UserFrom']] : array();
                }
                unset($item);
                unset($users_from);
            }
        }

        if($to_info)
        {
            $to_ids = array();
            foreach($payouts as $item)
            {
                if(!empty($item['Description']['user_id']) && !in_array($item['Description']['user_id'], $to_ids))
                {
                    $to_ids[] = $item['Description']['user_id'];
                }
            }
            if(count($to_ids) > 0)
            {
                $users_to = User::GetUsersNames($to_ids);
                foreach($payouts as &$item)
                {
                    $item['To'] = !empty($item['Description']['user_id']) && !empty($users_to[$item['Description']['user_id']]) ? $users_to[$item['Description']['user_id']] : array();
                }
                unset($item);
                unset($users_to);
            }
        }
		if($trans_his)
		{
			foreach($payouts  as $key => &$val)
			{
				if( $val['Description']['id'] == '')
				{
					unset($payouts[$key]);
				}
			}
		}
		//deb($payouts);
        return $payouts;
    }

    /**
     * Get payments count
     */
    public function PaymentsCount($user_id, $status = -1, $user_from = -1)
    {
        $payouts = PayoutQuery::create()->select(array('Id'))
                        ->filterByUserId($user_id);

        if ($status != -1)
        {
            $payouts = $payouts->filterByStatus($status);
        }

        //check payment type - In or Out
        if ($user_from != -1)
        {
            $payouts = $payouts->where($user_from ? 'user_from <> 0' : 'user_from = 0');
        }

        return $payouts->count();
    }

    /**
     * Delete user's payments
     * @param $user_id
     * @return bool
     */
    public static function DeleteUserPayments( $user_id )
    {
        PayoutQuery::create()->select(array('Id'))->filterByUserId($user_id)->delete();
        return true;
    }

    /**
     * Get payments list for admin panel
     * @return array()
     */
    public function AdminPaymentsList($page, $items_on_page, $filter = '')
    {
        $result = array('rcnt' => 0, 'list' => array());
        $payouts = PayoutQuery::create()->select(array('Id', 'UserId', 'Method', 'Ptype', 'Money', 'Balance', 'Pdate', 'Status', 'UserFrom',
                        'Description', 'PaymentInfoId', 'u.FirstName', 'u.LastName', 'u.BandName', 'u.Name', 'u.Status'))
                    -> leftJoin('User u');
        
        if($filter)
        {
            $payouts = $payouts->where($filter);
        }
        $result['rcnt'] = $payouts -> count();
        $payouts = $payouts->setOffset((($page - 1) * $items_on_page))->limit($items_on_page);
        

        $payouts = $payouts->orderByPdate('DESC')->find()->toArray();

        foreach($payouts as &$item)
        {
            $item['Description'] = !empty($item['Description']) ? @unserialize($item['Description']) : array();
        }
        unset($item);

        $from_ids = array();
        $to_ids = array();
        foreach($payouts as $item)
        {
            if(!empty($item['UserFrom']) && $item['UserFrom'] != $item['UserId'] && !in_array($item['UserFrom'], $from_ids))
            {
                $from_ids[] = $item['UserFrom'];
            }
            if(!empty($item['Description']['user_id']) && !in_array($item['Description']['user_id'], $to_ids))
            {
                $to_ids[] = $item['Description']['user_id'];
            }
        }
        if(count($from_ids) > 0)
        {
            $users_from = User::GetUsersNames($from_ids);
        }
        if(count($to_ids) > 0)
        {
            $users_to = User::GetUsersNames($to_ids);
        }
        foreach($payouts as &$item)
        {
            if($item['UserFrom'] != $item['UserId'])
            {
                $item['From'] = !empty($item['UserFrom']) && !empty($users_from[$item['UserFrom']]) ? $users_from[$item['UserFrom']] : array();
            }
            $item['To'] = !empty($item['Description']['user_id']) && !empty($users_to[$item['Description']['user_id']]) ? $users_to[$item['Description']['user_id']] : array();
        }
        unset($item);
        unset($users_from);
        unset($users_to);

        $result['list'] = $payouts;
		
        return $result;
    }

    public static function MethodsList()
    {
        $methods = array(
            1 => 'Method 1',
            2 => 'Method 2',
            3 => 'Method 3'
        );

        return $methods;
    }

    public static function StatusesList()
    {
        $statuses = array(
            0 => 'pending',
            1 => 'completed',
            2 => 'error',
            3 => 'cancelled',
            4 => 'return'
            );
        return $statuses;
    }


    public static function Admin_PurchaseInsert($pc_type_name,$pc_type_id,$pc_price,$pc_description,$pc_user_id,$pc_artist_id)
    {	
	$sql = "INSERT INTO purchase (`pc_id`, `pc_type_name`, `pc_type_id`, `pc_price`, `pc_description`, `pc_date`,`pc_user_id`,`pc_artist_id`) 
	VALUES (NULL, '$pc_type_name', '$pc_type_id', '$pc_price', '$pc_description', '".mktime()."','$pc_user_id','$pc_artist_id');";
	$result =  Query::Execute($sql);
	return $result;	
	}
	

    public static function Admin_PurchaseShow()						
    {	
	$sql 	= "SELECT pc_id, pc_type_name, pc_type_id, pc_price, pc_description, pc_date, pc_user_id, pc_artist_id,user.id,user.wallet as Wallet  ,user.first_name as Name,user.status as Type FROM user  INNER JOIN purchase  ON user.id=purchase.pc_user_id OR user.id=purchase.pc_artist_id where user.status = 2 ORDER BY `purchase`.`pc_id`  DESC";
	$result =  Query::GetAll($sql);		
	return $result;	
	}
	

	
	

	

}

// Payout
