<?php



/**
 * Skeleton subclass for representing a row from the 'home_category' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class HomeCategory extends BaseHomeCategory {

	public static function GetHomeCategory($parent_id, $recent ='')
	{		
			$sql = 'SELECT  
			hc_id as CatId, hc_name as CatName, hc_type as CatType, hc_parent as Parent, hc_order as CatOrder, hc_status as CatStatus, hc_text as CatText			 
			FROM home_category			
			WHERE 1 AND hc_parent='.$parent_id;
			
			if($recent)
			{
				$sql .= ' AND hc_id NOT IN('.$recent.')';
			}
			
			$sql .= ' ORDER BY hc_order ASC';
						
	        $res = Query::GetAll( $sql );
			return $res;
	}	
	public static function GetCategoryInfoById($catId)
	{		
			$sql = 'SELECT  
			hc_id as CatId, hc_name as CatName, hc_type as CatType, hc_parent as Parent, hc_order as CatOrder, hc_status as CatStatus, hc_text as CatText
			 
			FROM home_category			
			WHERE hc_id='.$catId.'';	
			
	        $res = Query::GetOne( $sql );
			return $res['CatName'];
	}
	
	public static function GetCategoryCount($catId)
	{		
			$sql = 'SELECT count(hc_id) as cnt
			FROM home_category			
			WHERE hc_id='.$catId.'';	
			
	        $res = Query::GetOne( $sql );

			return $res['cnt'];
	}
			
	public static function UpdateCatName($catId, $cName)
	{
		HomeCategoryQuery::create()->select(array('Id'))->filterByHcId($catId)
               -> update(array('HcName' => $cName));
        return true;
    }	
	public static function UpdateCatOrder($catId, $cat_order)
	{
		HomeCategoryQuery::create()->select(array('Id'))->filterByHcId($catId)
               -> update(array('HcOrder' => $cat_order));
        return true;
    }	

    /**
     * Delete event
     * @param int $id
     * @return bool
     */
    public static function DeleteCat( $id )
    {
        HomeCategoryQuery::create()->select(array('HcId'))->filterByHcId($id)->delete();
        return true;
    }
		
} // HomeCategory
