<?php


 
/**
 * Skeleton subclass for representing a row from the 'comment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Comment extends BaseComment {
	 public static function Add( $userId, $referType, $referId, $mesg)
    {
		$mesg = makeTextAsHyperLink($mesg);
		$cmt = new Comment();
        $cmt->setCmtUserId($userId);
        $cmt->setCmtReferType($referType);
		$cmt->setCmtReferId($referId);
		$cmt->setCmtMessage($mesg);
        $cmt->setCmtDate(mktime());
        $cmt->save();
		return $cmt->getPrimaryKey();
	}
	
	public static function GetCommentList($referType, $referId, $start=0, $limit=0, $cmntId = 0)
	{
		$sql = 'SELECT cmt_id, cmt_user_id, cmt_refer_type, cmt_refer_id, cmt_message, cmt_date,
				u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar				
                FROM comment c
                LEFT JOIN user u ON (u.Id = c.cmt_user_id)
                WHERE c.cmt_refer_type = '.(int)$referType.
				' AND c.cmt_refer_id='. (int)$referId;
		if($cmntId){
			$sql .= ' AND cmt_id < '. $cmntId;
		}		
		if($limit) {
			$sql .= ' ORDER BY cmt_date DESC';
			$sql .= " limit {$start} , {$limit}";
		} else {
			$sql .= ' ORDER BY cmt_date ASC';
		}
		$res = Query::GetAll( $sql );
        foreach ($res as &$v) {
            $v['cdate'] = wallTime( $v['cmt_date']);
        }
		if($limit){
			krsort($res);
		}
		//deb($sql);
		return $res;
	}
	
	public static function getComment($commentId,$start,$limit)
	{
		$sql = 'SELECT cmt_id, cmt_user_id, cmt_refer_type, cmt_refer_id, cmt_message, cmt_date,
				u.band_name AS BandName, u.first_name AS FirstName, u.last_name AS LastName, u.Name AS Name, u.Avatar AS Avatar
                FROM comment c
                LEFT JOIN user u ON (u.Id = c.cmt_user_id)
                WHERE c.cmt_id = '.(int)$commentId.' ORDER BY  cmt_id DESC ';
		if($_REQUEST['ajaxMode'])
		{
		}else{			
		$sql .= "LIMIT {$start}, {$limit}";
			}
		$res = Query::GetAll( $sql );

        foreach ($res as &$v) {
		
		$res[0]['cdate'] = wallTime($v['cmt_date']);
        }
				
		return $res;
	}
	
	public static function deleteComment($commentId)
	{
		$sql = 'DELETE FROM comment WHERE cmt_id = ' .(int)$commentId;
		$res = Query::Execute($sql);
        return $res;
	
	}

} // Comment
