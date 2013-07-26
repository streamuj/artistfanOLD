<?php

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class User extends BaseUser
{

    /**
     * Get user by Id
     * @static
     * @param $user_id
     */
    public static function GetUser($user_id, $check = 0)
    {
        $user = UserQuery::create()->Select(array('Id', 'Email', 'Status', 'Pass', 'FirstName', 'LastName', 'BandName', 'Name', 'Blocked', 'BlockReason',
            'Avatar', 'Location', 'About', 'Wallet', 'WalletBlock', 'IsOnline', 'AltEmail', 'UserPhone'));
		
        if($check == 0)
        {
            $user = $user->filterByBlocked(0)->filterByEmailConfirmed(1);
        }
        $user = $user->filterById($user_id)
                ->findOne();		
        return $user;
    }
	
	
    public static function GetphotoUser($user_id, $check = 0)
    {
		
		$sql	=	"SELECT * FROM `user` where id = $user_id";
	    $user = Query::GetOne( $sql );       
        return $user;
    }	
	
    /**
     * Get user full info by Id
     * @static
     * @param $user_id
     */
    public static function GetUserFullInfo($user_id)
    {
        return UserQuery::create()->select(array('Id', 'Email', 'Status', 'EmailConfirmed','Pass', 'FirstName', 'LastName', 'BandName', 'Name', 'Blocked', 'BlockReason',
            'Avatar', 'Country', 'Location', 'Zip', 'HideLoc', 'About', 'Likes', 'Dob', 'Gender', 'Ip', 'LastLogin', 'LastReload', 'RegDate',
            'YearsActive', 'Genres', 'Members', 'Website', 'Bio', 'RecordLabel', 'RecordLabelLink', 'Wallet', 'WalletBlock', 'Featured', 'IsOnline', 'AltEmail', 'UserPhone'))
                ->filterById($user_id)
                ->findOne();
    }
    
    public static function GetUserByLogin($user_name)
    {
        return UserQuery::create()->Select(array('Id', 'Email', 'Status', 'Pass', 'FirstName', 'LastName', 'BandName', 'Name', 'Blocked', 'BlockReason',
            'Avatar', 'Location', 'About', 'Wallet', 'IsOnline', 'AltEmail', 'UserPhone'))
                ->filterByBlocked(0)
                ->filterByEmailConfirmed(1)
                ->filterByName($user_name)
                ->findOne();
    }
    

    public static function GetUserName($user_id)
    {
        return UserQuery::create()->Select(array('FirstName', 'LastName', 'Name', 'BandName', 'Status', 'Location'))
                ->filterById($user_id)
                ->findOne();
    }

    public static function GetUsersNames($user_ids)
    {
        $users = array();
        $res = UserQuery::create()->Select(array('Id', 'FirstName', 'LastName', 'Name', 'BandName', 'Avatar','Location', 'Status'))
                ->filterById($user_ids, Criteria::IN)
                ->find()->toArray();
        foreach($res as $item)
        {
            $users[$item['Id']] = $item;
        }
        return $users;
    }

    public static function GetFeaturedArtists($limit)
    {
        $artists = UserQuery::create()->select(array('Id', 'FirstName', 'LastName', 'BandName', 'Name', 'Avatar', 'Location'))
					->filterByAvatar('', Criteria::NOT_EQUAL)
                   	->filterByStatus(USER_ARTIST)
					->filterByEmailConfirmed(1)
					->orderBy('RegDate', 'DESC')
                    ->limit($limit)
                    ->find()->toArray();
        return $artists;
    }

    /**
     * Get count artists
     * @param char $alpha
     * @return int
     */
    public static function ArtistsCount($alpha = '')
    {
        $cnt = UserQuery::create()->select(array('Id'))
                    ->filterByStatus(2)->filterByEmailConfirmed(1);
        if($alpha != '' && $alpha != 'num')
        {
            $cnt = $cnt -> where("((user.band_name LIKE '" . $alpha . "%')
                        OR ((user.band_name = '' OR user.band_name IS NULL) AND user.first_name LIKE '" . $alpha . "%'))");
        }
        else if($alpha == 'num')
        {
            $cnt = $cnt -> where("((user.band_name != '' AND user.band_name IS NOT NULL AND user.band_name NOT RLIKE '^[a-zA-Z]')
                        OR ((user.band_name = '' OR user.band_name IS NULL) AND user.first_name NOT RLIKE '^[a-zA-Z]'))");
        }
        $cnt = $cnt -> count();
        return $cnt;
    }

    /**
     * Get alphabetical artists list
     * @param int $page
     * @param int $items_on_page
     */
    public static function GetArtistsList($alpha, $page, $items_on_page )
    {
        $artists = UserQuery::create()->select(array('Id', 'FirstName', 'LastName', 'BandName', 'Name', 'Avatar', 'Genres', 'Location'))
                    ->withColumn("CASE
                        WHEN user.band_name != '' AND user.band_name IS NOT NULL THEN user.band_name
                        ELSE CONCAT(user.first_name, user.last_name)
                        END", 'Sortname')
                    ->filterByStatus(2)->filterByEmailConfirmed(1);
        if($alpha != '' && $alpha != 'num')
        {
            $artists = $artists -> where("((user.band_name LIKE '" . $alpha . "%')
                        OR ((user.band_name = '' OR user.band_name IS NULL) AND user.first_name LIKE '" . $alpha . "%'))");
        }
        else if($alpha == 'num')
        {
            $artists = $artists -> where("((user.band_name != '' AND user.band_name IS NOT NULL AND user.band_name NOT RLIKE '^[a-zA-Z]')
                        OR ((user.band_name = '' OR user.band_name IS NULL) AND user.first_name NOT RLIKE '^[a-zA-Z]'))");
        }
        $artists = $artists->setOffset(($page-1)*$items_on_page)->limit($items_on_page)
                    ->orderBy('Sortname', 'ASC')
                    ->find()->toArray();
        return $artists;
    }

    public static function UpdateWallet( $user_id, $wallet, $wallet_block = NULL )
    {
		
        $update = array('Wallet' => $wallet);
        if(!is_null($wallet_block))
        {
            $update['WalletBlock'] = $wallet_block;
        }
        UserQuery::create()->select('Id')->filterById($user_id)->update($update);
        return true;
    }

    public static function GetBalance( $user_id )
    {
        return UserQuery::create()->select('Wallet')->filterById($user_id)->findOne();
    }

    public static function UpdateUser( $user_id, $update = array() )
    {
        if(!empty($update))
        {
            UserQuery::create()->select('Id')->filterById($user_id)->update($update);
        }
        return true;
    }

    public static function DeleteUser( $user_id )
    {
        UserQuery::create()->select('Id')->filterById($user_id)->delete();
        return true;
    }

    public static function GetGenresList()
    {
        /*
		$genres_list = array(1=>'Alternative & Punk',
                             2=>'Books & Spoken',
                             3=>'Blues',
                             4=>'Children’s Music',
                             5=>'Classical',
                             6=>'Country',
                             7=>'Easy Listening',
                             8=>'Dance',
                             9=>'Electronic',
                             10=>'Folk',
                             11=>'Gospel & Religious',
                             12=>'Hip Hop/Rap',
                             13=>'Jazz',
                             14=>'Latin',
                             15=>'Metal',
                             16=>'New Age',
                             17=>'Pop',
                             18=>'Reggae',
                             19=>'R&B',
                             20=>'Rock',
                             21=>'World');
							 */
		$genres_list = array(20=>'Rock', 17=>'Pop',	9=>'Electronic', 12=>'Hip Hop',	6=>'Country', 13=>'Jazz', 5=>'Classical', 18=>'Reggae',  19=>'R&B', 15=>'Metal', 11=>'Gospel', 10=>'Folk', 14=>'Latin', 8=>'Dance', 1=>'Punk', 3=>'Blues', 16=>'New Age', 21=>'World',  2=>'Spoken Word', 22=>'Caribbean', 23=>'Other');
        return $genres_list;                     
    }

    /**
     * Get users list (for admin panel)
     * @static
     * @param int $status
     */
    public static  function GetUsersList( $status, $page = '', $items_on_page = '', $filters = '' )
    {
        $result = array('rcnt' => 0, 'list' => array());
        $users = UserQuery::create()->select(array('Id', 'Email', 'EmailConfirmed', 'FirstName', 'LastName', 'BandName', 'Name', 'Avatar', 'Genres', 'Dob', 'Gender', 'Location', 'Blocked', 'UserPhone'))
                -> withColumn("CASE
                        WHEN user.band_name != '' AND user.band_name IS NOT NULL THEN user.band_name
                        ELSE CONCAT(user.first_name, user.last_name)
                        END", 'Sortname')
                 ->filterByStatus($status);
        if(!empty($filters))
        {
            $users = $users->where($filters);
        }
        $result['rcnt'] = $users -> count();
		
		if($items_on_page)
		{
	        $users = $users->setOffset(($page-1)*$items_on_page)->limit($items_on_page);
		}
         
		  $users = $users->orderBy('Sortname', 'ASC')->find()->toArray();

			$result['list'] = $users;
        return $result;
    }


	/*
	 *
	 * Get user chat status
	 *
	 **/
	 
	public static function CheckUserOnline($userId)
	{
		
		$sql = "SELECT id, last_login as lastlogin, is_online FROM user WHERE is_online = 1 AND id = ".(int)$userId." LIMIT 0, 1";
		$res = Query::GetOne($sql);
		return $res;
		
	}
	
	/*Get online users */
	function getOnlineUsers($userId = 0, $showOnline = false)
	{
		if($userId){
			$friendJoin = "INNER JOIN user_follow ON (user_id = ".(int)$userId." OR user_id_follow = ".(int)$userId.") 
						   AND (user_id = user.id OR user_id_follow = user.id) AND user.id != ".(int)$userId;
		}

		$qry = "SELECT user.id, band_name, name, avatar, is_online AS online FROM user 
				{$friendJoin}
				{$joinType} WHERE is_online = ".STATUS_LOGGED_IN." AND blocked = 0";

		$res = Query::GetAll($sql);
		return $res;
	}
	
	/*function getUsersListFull(){
	
		$sql = "SELECT id, reg_date FROM user WHERE id NOT IN (SELECT user_id FROM photo_album WHERE title = 'Banner Images')";
		$res = Query::GetAll($sql);
		return $res;
	}*/


} // User
