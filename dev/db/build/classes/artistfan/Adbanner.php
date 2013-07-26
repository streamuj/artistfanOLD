<?php

/**
 * Skeleton subclass for representing a row from the 'adbanner' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Adbanner extends BaseAdbanner {
	
	
	/**
     * Get count
     *
     */ 
	 
	public static function GetCount()
    {
        $sql = 'SELECT count(adb_id) as cnt FROM adbanner INNER JOIN adbanner_type ON adbt_id = adb_type';
        $all = Query::GetOne($sql);
        return $all['cnt'];
    }
	 
	 /**
     * Get adbanner list
     * @param string $alias
     * @param int $active
     * @return array
     */
	 
	 
    public static function getBannerList( $after_id = 0, $page = 0, $items_count = 0 )
    {
				
		$sql = 'SELECT adb_id, adb_link, adb_image, adb_new, adb_status, adbt_name FROM adbanner 
				INNER JOIN adbanner_type ON adbt_id = adb_type';
		
		//Get messages after some ID - for update
        if ($after_id)
        {
            $sql .= ' AND adb_id > '.$after_id;
        }
        
        $sql .= ' ORDER BY adb_id ASC';
        if ($items_count)
        {
            $sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count;
			
        }
		
		
		$res = Query::GetAll($sql);
		
		return $res;
        
    }
	
	
	// add add banner
	public static function AddBanner( $image, $type = 0, $link)
	{
		$sql = 'INSERT INTO adbanner (adb_image, adb_type, adb_link) VALUES ("'.$image.'", '.$type.', "'.$link.'")';
		$res = Query::Execute($sql);
		return $res;
	}

	//Edit Banner
	public static function EditBanner( $image, $type = 0, $link, $id)
	{
		$sql = 'UPDATE adbanner SET adb_link = "'.$link.'",adb_image ="'.$image.'",	adb_type = '.$type.' WHERE adb_id = '.$id.'';
		$res = Query::Execute($sql);
		return $res;
	}

	
	

   /*
	* Hide or activate ads
	*/
	
	 public static function updateBannerActiveStatus( $id )
	 {
	 	$sql = 'UPDATE adbanner SET adb_status = 0 WHERE adb_id = ' .(int)$id;
		$res = Query::Execute($sql);
		return $res;
		
	 }
	
	public static function updateBannerDeactiveStatus( $id )
	{
		$sql = 'UPDATE adbanner SET adb_status = 1 WHERE adb_id = ' .(int)$id;
		
		$res = Query::Execute($sql);
		return $res;
	}
	
	/* Delete Add Banner */
	
	public static function DeleteBanner($id)
	{
		$sql = 'DELETE FROM adbanner WHERE adb_id = ' .(int)$id;
		$res = Query::Execute($sql);
        return $res;	
	}
	

	public function getBannerByType($id)
	{
		 $sql	=	"SELECT * FROM `adbanner` where adb_status = 1  and adb_type  = $id";
		 $result = Query::GetAll($sql);

		 return $result;
	}	
	
	
	
} // Adbanner
