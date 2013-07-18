<?php



/**
 * Skeleton subclass for representing a row from the 'payment_info' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class PaymentInfo extends BasePaymentInfo {

    /**
     * Add payment template
     * @param int $user_id
     * @param string $code
     * @param string $acc_number
     * @param string $name
     * @param int $acc_type
     * @return int
     */
    public static function AddPaymentInfo($user_id, $code, $acc_number, $name, $acc_type )
    {
        //search saved payment info
        $id = PaymentInfoQuery::create()->select(array('Id'))->filterByUserId($user_id)
                ->filterByRoutingCode($code, ' LIKE BINARY ')
                ->filterByAccountNumber($acc_number, ' LIKE BINARY ')
                ->filterByHolderName($name, ' LIKE BINARY ')
                ->filterByAccountType($acc_type, ' LIKE BINARY ')				
				->findOne();
				
        if(!empty($id))
        {
            PaymentInfoQuery::create()->select(array('Id'))->filterById($id)->update(array('Pdate' => mktime()));
            return $id;
        }
        //add new payment info
        $mPm = new PaymentInfo();
        $mPm->setUserId($user_id);
        $mPm->setRoutingCode($code);
        $mPm->setAccountNumber($acc_number);
        $mPm->setHolderName($name);
        $mPm->setAccountType($acc_type);
        $mPm->setPdate(mktime());
        $mPm->save();

        return $mPm->getId();
    }
	
	public static function AddAddressPaymentInfo($user_id, $mail_name, $mail_add1, $mail_add2, $mail_city, $mail_state, $mail_zip)
	{
		$id = PaymentInfoQuery::create()->select(array('Id'))->filterByUserId($user_id)
				->filterByMailName($mail_name, ' LIKE BINARY ')
                ->filterByMailAdd1($mail_add1, ' LIKE BINARY ')
                ->filterByMailAdd2($mail_add2, ' LIKE BINARY ')
                ->filterByMailCity($mail_city, ' LIKE BINARY ')
				->filterByMailState($mail_state, ' LIKE BINARY ')				
				->filterByMailZip($mail_zip, ' LIKE BINARY ')
				->findOne();
		if(!empty($id))
        {
            PaymentInfoQuery::create()->select(array('Id'))->filterById($id)->update(array('Pdate' => mktime()));
            return $id;
        }
		//add new payment info
        $mPm = new PaymentInfo();
        $mPm->setUserId($user_id);
        $mPm->setMailName($mail_name);
        $mPm->setMailAdd1($mail_add1);
        $mPm->setMailAdd2($mail_add2);
        $mPm->setMailCity($mail_city);
		$mPm->setMailState($mail_state);
		$mPm->setMailZip($mail_zip);
        $mPm->setPdate(mktime());
        $mPm->save();
		return $mPm->getId();
	}
	
	public static function AddPaypalIdPaymentInfo($user_id, $paypal_id)
	{
		$id = PaymentInfoQuery::create()->select(array('Id'))->filterByUserId($user_id)
				->filterByMailName($paypal_id, ' LIKE BINARY ')
				->findOne();
		if(!empty($id))
        {
            PaymentInfoQuery::create()->select(array('Id'))->filterById($id)->update(array('Pdate' => mktime()));
            return $id;
        }
		//add new payment info
        $mPm = new PaymentInfo();
        $mPm->setUserId($user_id);
        $mPm->setPaypalId($paypal_id);
        $mPm->setPdate(mktime());
        $mPm->save();
		return $mPm->getId();
	}
		

    /**
     * Return last saved payment info
     * @param int $user_id
     * @return array
     */
    public static function GetLastPaymentInfo($user_id)
    {
        $result = PaymentInfoQuery::create()->select(array('Id', 'UserId', 'RoutingCode', 'AccountNumber', 'HolderName', 'AccountType', 'MailName', 'MailAdd1', 'MailAdd2', 'MailCity', 'MailState', 'MailZip', 'PaypalId'))
                ->filterByUserId($user_id)
				-> filterByRoutingCode("", Criteria::NOT_EQUAL)
				->orderByPdate('DESC')->findOne();

        return $result;
    }
    /**
     * Return last saved payment info
     * @param int $user_id
     * @return array
     */
    public static function GetLastAddressPaymentInfo($user_id)
    {
        $result = PaymentInfoQuery::create()->select(array('Id', 'UserId', 'RoutingCode', 'AccountNumber', 'HolderName', 'AccountType', 'MailName', 'MailAdd1', 'MailAdd2', 'MailCity', 'MailState', 'MailZip', 'PaypalId'))
                ->filterByUserId($user_id)
				-> filterByMailName("", Criteria::NOT_EQUAL)
				->orderByPdate('DESC')->findOne();

        return $result;
    }
    /**
     * Return last saved payment info
     * @param int $user_id
     * @return array
     */
    public static function GetLastPaypalIdPaymentInfo($user_id)
    {
        $result = PaymentInfoQuery::create()->select(array('Id', 'UserId', 'PaypalId'))
                ->filterByUserId($user_id)
				-> filterByPaypalId("", Criteria::NOT_EQUAL)
				->orderByPdate('DESC')->findOne();

        return $result;
    }
			

    /**
     * Return payments info by ids
     * @param array $ids
     * @return array
     */
    public static function GetListPaymentInfo($ids)
    {
        $list = PaymentInfoQuery::create()->select(array('Id', 'UserId', 'RoutingCode', 'AccountNumber', 'HolderName', 'AccountType', 'MailName', 'MailAdd1', 'MailAdd2', 'MailCity', 'MailState', 'MailZip', 'PaypalId'))
                ->filterById($ids, Criteria::IN)->find()->toArray();

        return $list;
    }

    public static function AccountTypesList()
    {
        $types = array(
            1 => 'Business checking',
            2 => 'Individual checking',
            3 => 'Business savings',
            4 => 'Individual savings'
        );
        return $types;
    }
} // PaymentInfo
