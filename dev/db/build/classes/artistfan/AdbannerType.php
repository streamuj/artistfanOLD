<?php



/**
 * Skeleton subclass for representing a row from the 'adbanner_type' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class AdbannerType extends BaseAdbannerType 
{

	/**
     * Get count 
     * 
     */ 
	 
	public static function GetBannerType()
    {
 
		$sqltopbanner		 = "SELECT count('adb_type') as topBanner FROM `adbanner` where adb_type = 1";
		$sqltopbannercount	 =	Query::GetAll($sqltopbanner);

		if($sqltopbannercount[0]['topBanner']<1)
		{
		 $where = '1';
		 
		}
		else
		{
		
				$sqlcenterbanner		 = "SELECT count('adb_type') as Banner FROM `adbanner` where adb_type = 3";
				$sqlcenterbannercount	 =	Query::GetAll($sqlcenterbanner);	
				if($sqlcenterbannercount[0]['Banner']<3)
				{
				 $where = '3';
				 
				}
				$sqlrightbanner		 = "SELECT count('adb_type') as rightBanner FROM `adbanner` where adb_type = 2";
				$sqlrightbannercount	 =	Query::GetAll($sqlrightbanner);
				if($sqlrightbannercount[0]['rightBanner']<1)
				{
				 $where = '2';		
				}
		
		}
	
	$sql = 'SELECT adbt_id, adbt_name FROM adbanner_type WHERE adbt_id in('.$where.')';
//	deb($sql);


		if(empty($where))
		{
		$all = false;
		}
		else
		{
		$all = Query::GetAll($sql);
		}
        return $all;
    }
	
} // AdbannerType
