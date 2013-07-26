<?php



/**
 * Skeleton subclass for representing a row from the 'invite_api' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class InviteApi extends BaseInviteApi {

	public static function CheckInviteApi($email, $type)
	{
		 $checkRes = InviteApiQuery::create()->select(array('IaId'))
			->filterByIaEmail($email)
			->filterByIaType($type)					
       		->findone();

        return $checkRes;
	}
/*	function checkInviteType($eType=0) 
	{
		$params = $this->params;
		if(!$eType) 
		{
			$eType = $params['client'];
		}
		$qry = 'select op_id from open_invite op_userid where op_userid = %d and op_type = "%s"';
		
		$qry = $this->db->prepareQuery($qry, $params['userId'], $eType);
		
		$rslt =  $this->db->getSingleRow($qry);
		
		if($rslt)
			return $rslt['op_id'];
		else
			return false;
		
		$all = Query::GetAll($sql);
		return $all;
					
	}*/
	

} // InviteApi
