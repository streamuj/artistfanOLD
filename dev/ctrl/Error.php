<?php
/**
 * Init controller
 * User: ssergy
 * Date: 10.01.2011
 * Time: 19:22:44
 *
 */

class Error
{

    public function __construct()
    {
        
    }
    public function Insert($url, $mesg)
    {
		$errDate = date('Y-m-d H:i:s', getEstTime());
		$mesg = addslashes(strip_tags($mesg));
		$url = addslashes(strip_tags($url));
     	$sql = 'INSERT INTO error_log (err_date, err_url, err_mesg) VALUES ("'.$errDate.'","'.$url.'","'.$mesg.'")';
		Query::Execute($sql);
    }
	public static function getErrors($fromDate='', $toDate='', $page = 1, $items_count = 0 )
	{
		$sql = 'SELECT * FROM error_log';
		$cond = array();
		if($fromDate){
			$cond[] = ' DATE(err_date) >="'.$fromDate.'"';
		}
		if($toDate){
			$cond[] = ' DATE(err_date) <="'.$toDate.'"';
		}
		if($cond){
			$sql .= ' WHERE '.implode(' AND ', $cond);
		}
		
		$sql .= ' ORDER BY err_id';
				
		if($items_count)
		{
			$sql .= ' LIMIT ' . ($page > 0 ? ($page-1)*$items_count : '0') . ', ' . $items_count;
		}

		//deb($sql);
		$result = Query::GetAll($sql);
		
		$start = ($page - 1) * $items_count;
		foreach($result as &$event){
			$event['siNo'] = ++$start;
		}
				
		return $result;
	}
	public static function getErrorsCount($fromDate='', $toDate='' )
	{
		$sql = 'SELECT count(*) as cnt FROM error_log';
		$cond = array();
		if($fromDate){
			$cond[] = ' DATE(err_date) >="'.$fromDate.'"';
		}
		if($toDate){
			$cond[] = ' DATE(err_date) <="'.$toDate.'"';
		}
		if($cond){
			$sql .= ' WHERE '.implode(' AND ', $cond);
		}
		
		$result = Query::GetOne($sql);
		return $result['cnt'];
	}	
	
}
?>