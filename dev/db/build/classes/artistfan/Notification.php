<?php



/**
 * Skeleton subclass for representing a row from the 'notification' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Notification extends BaseNotification {


    public static function Add( $wall_id, $comment_id, $mesg, $user_id, $mCache = '' )
    {
	    //$mesg = makeTextAsHyperLink($mesg);
		$time	=	mktime();		
		$sql = "INSERT INTO notification (na_id, na_wall_id, na_comment_id, na_message, na_user_id, na_status, na_date) VALUES (NULL, '".$wall_id."', '".$comment_id."', '".$mesg."', '".$user_id."', '0', '".$time."');";
		Query::Execute($sql);
		return true;
	}
	public static function DeleteWall($wall_id)
	{
		$sql	=	"DELETE FROM notification WHERE na_wall_id = ".$wall_id.";";
		Query::Execute($sql);
		return true;	
	}
	 
    public static function GetFollowersid( $wall_id, $comment_id, $mesg, $user_id, $mCache = '' )
    {
	    //$mesg = makeTextAsHyperLink($mesg);
		$time	=	mktime();		
		//$sql 	= "SELECT IF(user_id=".$user_id." ,0,user_id_follow )as User_id ,user_id_follow as Follower_Id FROM `user_follow` where user_id = ".$user_id." or user_id_follow = ".$user_id."";
		$sql 	=	"SELECT user_id as Follower_Id FROM `user_follow` where user_id_follow = ".$user_id."";
		$res	=	Query::GetAll($sql);
		return $res;
	}
	
	public static function ShowNotification_Wall($id)
	{
	$sql	=	"SELECT na_wall_id,wall.timeline,na_status as status, na_date as CreatedDate, na_comment_id,  mesg, uf.Name as from_name, uf.first_name as from_first_name,uf.avatar as from_image,
ut.Name as to_name, ut.first_name as to_first_name,ut.avatar as to_image
 FROM `notification`
LEFT JOIN wall ON wall.id = na_wall_id
LEFT JOIN user as uf on uf.id = wall.user_id_from 
LEFT JOIN user as ut on ut.id = wall.user_id
WHERE `na_user_id` = ".$id."  and na_status!=1 ORDER BY na_wall_id  DESC";	
		$res	=	Query::GetAll($sql);
		foreach($res as $results)
		{
			if($results['na_wall_id']!=0)
				{
				$result[]	=	$results;	
				}
		} 		
		return $result;	
	
	}

	public static function ShowNotification_Comment($id)
	{
		 $sql	="SELECT cmt_id,cmt_message as CommentMessage, mesg as WallMessage ,cmt_date as CommentDate , cmt_user_id as FromId , f2.name as From_Name,f2.first_name as From_FirstName,f2.last_name as From_LastName,f2.avatar as From_Image,t1.avatar as To_Image ,t1.name as To_Name,t1.first_name as To_FirstName , t1.last_name as To_LastName,na_status as status   FROM `notification`
LEFT JOIN comment on cmt_id = na_comment_id 
LEFT JOIN wall on id  = cmt_refer_id 
LEFT JOIN user as t1 on t1.id  = na_user_id 
LEFT JOIN user as f2 on f2.id  = cmt_user_id 
where na_user_id = ".$id." and na_status!=1  ORDER BY `comment`.`cmt_id`  DESC ";

		$res	=	Query::GetAll($sql);
		foreach($res as $results)
		{
			if($results['CommentMessage']!='')
				{
				$result[]	=	$results;	
				}
		}		

		return $result;	
	
	}
	public static function ShowNotification_Buy($id)
	{

	$sql	="SELECT * FROM `notification` 
LEFT JOIN wall on id = na_wall_id
LEFT JOIN user as f2 on f2.id  = na_user_id 
where na_user_id = ".$id." and na_status!=1   and timeline !=0 ORDER BY `notification`.`na_id`  DESC ";


		$res	=	Query::GetAll($sql);
		foreach($res as $results)
		{
		}		

		return $res;	
	} 
	public static function ChangeStatusWall($id)
	{
	
		$sql	=	"SELECT na_id,na_wall_id,na_status as status, na_date as CreatedDate, na_comment_id,  mesg, uf.Name as from_name, uf.first_name as from_first_name,
 ut.Name as to_name, ut.first_name as to_first_name
 FROM `notification`
LEFT JOIN wall ON wall.id = na_wall_id
LEFT JOIN user as uf on uf.id = wall.user_id_from 
LEFT JOIN user as ut on ut.id = wall.user_id
WHERE `na_user_id` = ".$id."  and na_status!=1 ORDER BY na_wall_id  DESC";	

		$res	=	Query::GetAll($sql);
		foreach($res as $results)
		{
			if($results['na_wall_id']!=0 && $results['na_id']!='' )
				{
				$result[]	=	$results;
				Query::Execute("UPDATE notification SET na_status = '1' WHERE na_id = ".$results['na_id'].";");					
				}
		} 		
		return $result;	
	
	
	}
	public static function ChangeStatusComment($id)
	{	
	$sql	="SELECT na_id,cmt_id,cmt_message as CommentMessage, mesg as WallMessage ,cmt_date  as CommentDate , cmt_user_id as FromId , f2.name as From_Name,f2.first_name as From_FirstName,f2.last_name as From_LastName,t1.name as To_Name,t1.first_name as To_FirstName , t1.last_name as To_LastName,na_status as status   FROM `notification`
LEFT JOIN comment on cmt_id = na_comment_id 
LEFT JOIN wall on id  = cmt_refer_id 
LEFT JOIN user as t1 on t1.id  = na_user_id 
LEFT JOIN user as f2 on f2.id  = cmt_user_id 
where na_user_id = ".$id." and na_status!=1  ORDER BY `comment`.`cmt_id`  DESC ";
		$res	=	Query::GetAll($sql);
		foreach($res as $results)
		{
			if($results['CommentMessage']!='' &&  $results['na_id']!='')
				{
				$result[]	=	$results;	
				Query::Execute("UPDATE notification SET na_status = '1' WHERE na_id = ".$results['na_id'].";");
				
				}
		}		

	}
	
	
	//
	


} // Notification
