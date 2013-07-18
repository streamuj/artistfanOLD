<?php



/**
 * Skeleton subclass for representing a row from the 'invite_detail' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class InviteDetail extends BaseInviteDetail {

    public static function GetFBFriendsList( $page =1, $items_on_page =0, $user, $search ='')
    {
		$sql = 'SELECT ind.id AS Id, ind.id_api_id AS IdApiId, ind.id_name AS IdName, ind.id_email AS IdEmail, ind.id_fbid AS IdFbid, ind.cdate AS Cdate, ind.mdate AS Mdate, ia.ia_user_id AS IaUserId, u.status AS Status,u.id AS UserId,u.name AS Name, uf.id AS UFollow, itn.inv_id AS Invited FROM  invite_detail as ind 
				LEFT JOIN invite_api as ia ON ia.ia_id	 = ind.id_api_id
				LEFT JOIN  invitation as itn ON itn.inv_fbid = ind.id_fbid								
				LEFT JOIN user as u ON u.fb_id	 = ind.id_fbid
				LEFT JOIN user_follow as uf ON ((uf.user_id = u.id OR uf.user_id_follow = u.id) AND (uf.user_id ='.$user.' OR uf.user_id_follow ='.$user.'))
				WHERE 1 ';
		
		if($user)
		{	
			$sql .= ' AND ia.ia_user_id = '.$user;
		}
		if($search)
		{
			$sql .=' AND ind.id_name LIKE "%'.$search.'%" ';	
		}	
		
		$sql .=' ORDER BY ind.id_name ASC';

		$rcnt = Query::GetAll($sql);
		$friends['rcnt'] =count($rcnt);

		if($items_on_page)
		{
			$sql .= ' LIMIT '. ($page > 1 ? ($page-1) * 10:0) . ', ' . $items_on_page;
		}

		$friends['list'] = Query::GetAll($sql);

		return $friends;
	}
    public static function GetTwitterFriendsList( $page =1, $items_on_page =0, $user, $search ='')
    {
		$sql = 'SELECT ind.id AS Id, ind.id_api_id AS IdApiId, ind.id_name AS IdName, ind.id_email AS IdEmail, ind.id_twid AS IdTwid, ind.id_image AS IdImage, ind.cdate AS Cdate, ind.mdate AS Mdate, ia.ia_user_id AS IaUserId, u.status AS Status,u.id AS UserId,u.name AS Name, uf.id AS UFollow, itn.inv_id AS Invited FROM  invite_detail as ind 
				LEFT JOIN invite_api as ia ON ia.ia_id	 = ind.id_api_id
				LEFT JOIN  invitation as itn ON itn.inv_twid = ind.id_twid								
				LEFT JOIN user as u ON u.tw_id	 = ind.id_twid
				LEFT JOIN user_follow as uf ON ((uf.user_id = u.id OR uf.user_id_follow = u.id) AND (uf.user_id ='.$user.' OR uf.user_id_follow ='.$user.'))
				WHERE 1 ';
		
		if($user)
		{	
			$sql .= ' AND ia.ia_user_id = '.$user;
		}
		if($search)
		{
			$sql .=' AND ind.id_name LIKE "%'.$search.'%" ';	
		}	
		
		$sql .=' ORDER BY ind.id_name ASC';

		$rcnt = Query::GetAll($sql);
		$friends['rcnt'] =count($rcnt);

		if($items_on_page)
		{
			$sql .= ' LIMIT '. ($page > 1 ? ($page-1) * 10:0) . ', ' . $items_on_page;
		}

		$friends['list'] = Query::GetAll($sql);

		return $friends;
	}	
	
	public static function CheckFBInviterDetail($apiId, $friendId)
	{
		 $checkRes = InviteDetailQuery::create()->select(array('Id'))
			->filterByIdApiId($apiId)
			->filterByIdFbid($friendId)					
       		->findone();

        return $checkRes;
	}
	public static function CheckTwInviterDetail($apiId, $friendId)
	{
		 $checkRes = InviteDetailQuery::create()->select(array('Id'))
			->filterByIdApiId($apiId)
			->filterByIdTwid($friendId)					
       		->findone();

        return $checkRes;
	}
		
	
} // InviteDetail
