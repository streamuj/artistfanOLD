<?php



/**
 * Skeleton subclass for representing a row from the 'state' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class State extends BaseState {

	 
	public static function GetStates()
    {
        $sql = 'SELECT * FROM State';
        $all = Query::GetAll($sql);
        return $all;
    }

} // State
