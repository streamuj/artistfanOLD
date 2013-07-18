<?php



/**
 * Skeleton subclass for representing a row from the 'invitation' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Invitation extends BaseInvitation {
	
	public static function CheckFbInvitationDetail($apiId, $invFbid)
	{
		 $checkRes = InvitationQuery::create()->select(array('InvId'))
			->filterByInvInvitee($apiId)
			->filterByInvFbid($invFbid)					
       		->findone();

        return $checkRes;
	}
	public static function CheckTwInvitationDetail($apiId, $invTwid)
	{
		 $checkRes = InvitationQuery::create()->select(array('InvId'))
			->filterByInvInvitee($apiId)
			->filterByInvTwid($invTwid)					
       		->findone();

        return $checkRes;
	}
		
	
	public function CheckFbInvitationFollower( $userId )
	{	
		$sql = 'SELECT ivt.inv_id as ivtId FROM invitation as ivt
			LEFT JOIN user as u ON ivt.inv_fbid =u.fb_id
			LEFT JOIN user_follow as uf ON (u.id=uf.user_id OR u.id=uf.user_id_follow) WHERE u.id='.$userId.' AND (uf.user_id!='.$userId.' OR uf.user_id_follow!='.$userId.')';
        
		$invFollower = Query::GetOne($sql);

        return $invFollower['ivtId'];
	}
	public function CheckTwInvitationFollower( $userId )
	{	
		$sql = 'SELECT ivt.inv_id as ivtId FROM invitation as ivt
			LEFT JOIN user as u ON ivt.inv_twid =u.tw_id
			LEFT JOIN user_follow as uf ON (u.id=uf.user_id OR u.id=uf.user_id_follow) WHERE u.id='.$userId.' AND (uf.user_id!='.$userId.' OR uf.user_id_follow!='.$userId.')';
        
		$invFollower = Query::GetOne($sql);

        return $invFollower['ivtId'];
	}	
	public function getFbInviter( $userId )
	{	
		$sql = 'SELECT ivt.inv_inviter as ivtId FROM invitation as ivt
			LEFT JOIN user as u ON ivt.inv_fbid =u.fb_id WHERE u.id='.$userId;//.' AND (uf.user_id!='.$userId.' OR uf.user_id_follow!='.$userId.')';
        
		$invFollower = Query::GetOne($sql);

        return $invFollower['ivtId'];
	}
	public function getTwInviter( $userId )
	{	
		$sql = 'SELECT ivt.inv_inviter as ivtId FROM invitation as ivt
			LEFT JOIN user as u ON ivt.inv_twid =u.tw_id WHERE u.id='.$userId;//.' AND (uf.user_id!='.$userId.' OR uf.user_id_follow!='.$userId.')';
        
		$invFollower = Query::GetOne($sql);

        return $invFollower['ivtId'];
	}		

} // Invitation
