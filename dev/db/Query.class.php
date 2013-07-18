<?php
/**
 * Class for run simple queries in Propel
 * User: ssergy
 * Date: 01.06.11
 * Time: 11:38
 * 
 */
 
class Query 
{
    /**
     * Run sql query && get all items
     * @static
     * @return void
     */
    public static function GetAll( $sql )
    {
        $con = Propel::getConnection(UserPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $list = array();
        while ($v = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $list[] = $v;
        }
        $stmt->closeCursor();
        return $list;
    }

    /**
     * Return count of rows after SQL_CALC_FOUND_ROWS
     * @static
     * @param $sql
     * @return int
     */
    public static function GetCount()
    {
        $sql = 'SELECT FOUND_ROWS() AS rcnt';
        $con = Propel::getConnection(UserPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $rcnt = $stmt->fetch(PDO::FETCH_ASSOC);
        $rcnt = $rcnt['rcnt'];
        $stmt->closeCursor();

        return $rcnt;
    }

    /**
     * Execute query
     * @static
     * @param $sql
     * @return bool
     */
    public static function Execute( $sql )
    {
        $con = Propel::getConnection(UserPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }

     /**
     * Run sql query && get only one item
     * @static
     * @return void
     */
    public static function GetOne( $sql )
    {
        $con = Propel::getConnection(UserPeer::DATABASE_NAME);
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $v = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $v;
    }


}
