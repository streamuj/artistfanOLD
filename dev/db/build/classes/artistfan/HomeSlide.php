<?php



/**
 * Skeleton subclass for representing a row from the 'home_slide' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class HomeSlide extends BaseHomeSlide {


	/**
     * Get count
     *
     */ 
	 
	public static function GetCount()
    {
        $sql = 'SELECT count(hs_id) as cnt FROM home_slide';
        $all = Query::GetOne($sql);
        return $all['cnt'];
    }
	
	
	public static function GetHomePageSlideImageList($after_id = 0, $page = 0, $items_count = 0 )
    {
				
		$sql = 'SELECT * FROM home_slide WHERE hs_status = 0  ORDER BY  hs_order ASC LIMIT 0,5';        			
		$res = Query::GetAll($sql);
		return $res;
        
    }
	
	public static function GetHomePageImageName($id)
    {
				
		$sql = 'SELECT hs_image FROM home_slide WHERE hs_id = ' .(int)$id;   		    			
		$res = Query::GetOne($sql);
		return $res;
        
    }
	
	
	public static function GetSlideList($after_id = 0, $page = 0, $items_count = 0 )
    {
				
		$sql = 'SELECT * FROM home_slide';
		
		//Get messages after some ID - for update
        if ($after_id)
        {
            $sql .= ' AND hs_id > '.$after_id;
        }
               
        $sql .= ' ORDER BY  hs_order ASC';
        if ($items_count)
        {
            $sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count;
			
        }
			
		$res = Query::GetAll($sql);
		
		return $res;
        
    }

	public static function AddPhoto($image, $order = 0, $status = 0, $Link, $date, $id, $is_new)
	{
	
		
			$sql = 'INSERT INTO home_slide (hs_image, hs_order, hs_status, hs_link, created_on, created_by, hs_new) VALUES ("'.$image.'", '.$order.', '.$status.', "'.$Link.'",'.$date.', '.$id.', '.$is_new.')';
			$res = Query::Execute($sql);
			return $res;
	}
	
	
	 /*
	* Hide or activate ads
	*/
	
	 public static function updateBannerActiveStatus( $id, $date, $uid)
	 {
	 	//deb($uid);
	 	$sql = 'UPDATE home_slide SET  hs_status = 0, modified_on = '.$date.', modified_by ='.$uid.'  WHERE hs_id = ' .(int)$id;
		/*$sql = 'UPDATE home_slide SET  modified_on = '.$date.' WHERE hs_id = ' .(int)$id;
		$sql = 'UPDATE home_slide SET  modified_by ='.$uid.' WHERE hs_id = ' .(int)$id;*/
		$res = Query::Execute($sql);
		return $res;
		
	 }
	
	 /*
	* Hide or activate ads
	*/
	
	public static function updateBannerDeactiveStatus( $id, $date, $uid )
	{
		$sql = 'UPDATE home_slide SET  hs_status = 1, modified_on = '.$date.', modified_by ='.$uid.' WHERE hs_id = ' .(int)$id;
		$res = Query::Execute($sql);
		return $res;
	}
	
	 /*
	* Home Slide Link Update
	*/
	
	 public static function updateHomeSlideLink( $id, $date, $uid, $link)
	 {
	 	//deb($uid);
	 	$sql = 'UPDATE home_slide SET   hs_link = '.$link.', modified_on = '.$date.', modified_by ='.$uid.'  WHERE hs_id = ' .(int)$id;
		/*$sql = 'UPDATE home_slide SET  modified_on = '.$date.' WHERE hs_id = ' .(int)$id;
		$sql = 'UPDATE home_slide SET  modified_by ='.$uid.' WHERE hs_id = ' .(int)$id;*/
		$res = Query::Execute($sql);
		return $res;
		
	 }	
	
	 /**
     * Delete page
     * @param int $id
     * @return bool
     */
	 
    public static function DeleteSlide($id)
    {
        $sql = 'DELETE FROM home_slide WHERE hs_id = ' .(int)$id;
		$res = Query::Execute($sql);
        return $res;
    }    


} // HomeSlide
