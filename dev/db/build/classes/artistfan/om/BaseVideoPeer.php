<?php


/**
 * Base static class for performing query and update operations on the 'video' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseVideoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'artistfan';

	/** the table name for this class */
	const TABLE_NAME = 'video';

	/** the related Propel class for this table */
	const OM_CLASS = 'Video';

	/** the related TableMap class for this table */
	const TM_CLASS = 'VideoTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 18;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 14;

	/** the column name for the ID field */
	const ID = 'video.ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'video.USER_ID';

	/** the column name for the TITLE field */
	const TITLE = 'video.TITLE';

	/** the column name for the PRICE field */
	const PRICE = 'video.PRICE';

	/** the column name for the VIDEO field */
	const VIDEO = 'video.VIDEO';

	/** the column name for the VIDEO_PREVIEW field */
	const VIDEO_PREVIEW = 'video.VIDEO_PREVIEW';

	/** the column name for the PDATE field */
	const PDATE = 'video.PDATE';

	/** the column name for the ACTIVE field */
	const ACTIVE = 'video.ACTIVE';

	/** the column name for the DELETED field */
	const DELETED = 'video.DELETED';

	/** the column name for the FROM_YT field */
	const FROM_YT = 'video.FROM_YT';

	/** the column name for the STATUS field */
	const STATUS = 'video.STATUS';
	
	/** the column name for the FEATURED field */
	const FEATURED = 'video.FEATURED';
	
	/** the column name for the PAY_MORE field */
	const PAY_MORE = 'video.PAY_MORE';

	/** the column name for the VIDEO_LENGTH field */
	const VIDEO_LENGTH = 'video.VIDEO_LENGTH';
	
	/** the column name for the VIDEO_COUNT field */
	const VIDEO_COUNT = 'video.VIDEO_COUNT';

	/** the column name for the VIDEO_TYPE field */
	const VIDEO_TYPE = 'video.VIDEO_TYPE';
	
	/** the column name for the VIDEO_DATE field */
	const VIDEO_DATE = 'video.VIDEO_DATE';

	/** the column name for the VIDEO_IMAGE field */
	const VIDEO_IMAGE = 'video.VIDEO_IMAGE';

	/** the column name for the EMAIL_SENT field */
	const EMAIL_SENT = 'video.EMAIL_SENT';
	
	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of Video objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Video[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'Title', 'Price', 'Video', 'VideoPreview', 'Pdate', 'Active', 'Deleted', 'FromYt', 'Status', 'Featured', 'PayMore', 'VideoLength', 'VideoCount', 'VideoType', 'VideoDate', 'VideoImage', 'EmailSent', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'title', 'price', 'video', 'videoPreview', 'pdate', 'active', 'deleted', 'fromYt', 'status', 'featured', 'payMore', 'videoLength', 'videoCount', 'videoType', 'videoDate', 'videoImage', 'emailSent', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::TITLE, self::PRICE, self::VIDEO, self::VIDEO_PREVIEW, self::PDATE, self::ACTIVE, self::DELETED, self::FROM_YT, self::STATUS, self::FEATURED, self::PAY_MORE, self::VIDEO_LENGTH, self::VIDEO_COUNT, self::VIDEO_TYPE, self::VIDEO_DATE, self::VIDEO_IMAGE, self::EMAIL_SENT,),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'USER_ID', 'TITLE', 'PRICE', 'VIDEO', 'VIDEO_PREVIEW', 'PDATE', 'ACTIVE', 'DELETED', 'FROM_YT', 'STATUS', 'FEATURED', 'PAY_MORE', 'VIDEO_LENGTH', 'VIDEO_COUNT', 'VIDEO_TYPE', 'VIDEO_DATE', 'VIDEO_IMAGE', 'EMAIL_SENT',),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'title', 'price', 'video', 'video_preview', 'pdate', 'active', 'deleted', 'from_yt', 'status', 'featured','pay_more', 'video_length', 'video_count', 'video_type',  'video_date', 'video_image', 'email_sent', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18,)
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'Title' => 2, 'Price' => 3, 'Video' => 4, 'VideoPreview' => 5, 'Pdate' => 6, 'Active' => 7, 'Deleted' => 8, 'FromYt' => 9, 'Status' => 10, 'Featured' => 11, 'PayMore' => 12, 'VideoLength' => 13, 'VideoCount' => 14, 'VideoType' => 15,'VideoDate' => 16, 'VideoImage' => 17, 'EmailSent' => 18,),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'title' => 2, 'price' => 3, 'video' => 4, 'videoPreview' => 5, 'pdate' => 6, 'active' => 7, 'deleted' => 8, 'fromYt' => 9, 'status' => 10, 'featured' => 11, 'payMore' => 12, 'videoLength' => 13, 'videoCount' => 14, 'videoType' => 15, 'videoDate' => 16, 'videoImage' => 17, 'emailSent' => 18,  ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::TITLE => 2, self::PRICE => 3, self::VIDEO => 4, self::VIDEO_PREVIEW => 5, self::PDATE => 6, self::ACTIVE => 7, self::DELETED => 8, self::FROM_YT => 9, self::STATUS => 10,  self::FEATURED => 11, self::PAY_MORE => 12, self::VIDEO_LENGTH => 13, self::VIDEO_COUNT => 14,  self::VIDEO_TYPE => 15, self::VIDEO_DATE => 16, self::VIDEO_IMAGE => 17, self::EMAIL_SENT => 18,),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'USER_ID' => 1, 'TITLE' => 2, 'PRICE' => 3, 'VIDEO' => 4, 'VIDEO_PREVIEW' => 5, 'PDATE' => 6, 'ACTIVE' => 7, 'DELETED' => 8, 'FROM_YT' => 9, 'STATUS' => 10, 'FEATURED' => 11, 'PAY_MORE' => 12, 'VIDEO_LENGTH' => 13, 'VIDEO_COUNT' => 14, 'VIDEO_TYPE' => 15,  'VIDEO_DATE' => 16, 'VIDEO_IMAGE' => 17, 'EMAIL_SENT' => 18,  ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'title' => 2, 'price' => 3, 'video' => 4, 'video_preview' => 5, 'pdate' => 6, 'active' => 7, 'deleted' => 8, 'from_yt' => 9, 'status' => 10, 'featured' => 11, 'pay_more' => 12, 'video_length' => 13, 'video_count' => 14, 'video_type' => 15,  'video_date' => 16, 'video_image' => 17, 'email_sent' => 18,),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18,)
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. VideoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(VideoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(VideoPeer::ID);
			$criteria->addSelectColumn(VideoPeer::USER_ID);
			$criteria->addSelectColumn(VideoPeer::TITLE);
			$criteria->addSelectColumn(VideoPeer::PRICE);
			$criteria->addSelectColumn(VideoPeer::VIDEO);
			$criteria->addSelectColumn(VideoPeer::VIDEO_PREVIEW);
			$criteria->addSelectColumn(VideoPeer::PDATE);
			$criteria->addSelectColumn(VideoPeer::ACTIVE);
			$criteria->addSelectColumn(VideoPeer::DELETED);
			$criteria->addSelectColumn(VideoPeer::FROM_YT);
			$criteria->addSelectColumn(VideoPeer::STATUS);
			$criteria->addSelectColumn(VideoPeer::FEATURED);
			$criteria->addSelectColumn(VideoPeer::PAY_MORE);
			$criteria->addSelectColumn(VideoPeer::VIDEO_LENGTH);
			$criteria->addSelectColumn(VideoPeer::VIDEO_COUNT);
			$criteria->addSelectColumn(VideoPeer::VIDEO_TYPE);
			$criteria->addSelectColumn(VideoPeer::VIDEO_DATE);
			$criteria->addSelectColumn(VideoPeer::VIDEO_IMAGE);
			$criteria->addSelectColumn(VideoPeer::EMAIL_SENT);
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.USER_ID');
			$criteria->addSelectColumn($alias . '.TITLE');
			$criteria->addSelectColumn($alias . '.PRICE');
			$criteria->addSelectColumn($alias . '.VIDEO');
			$criteria->addSelectColumn($alias . '.VIDEO_PREVIEW');
			$criteria->addSelectColumn($alias . '.PDATE');
			$criteria->addSelectColumn($alias . '.ACTIVE');
			$criteria->addSelectColumn($alias . '.DELETED');
			$criteria->addSelectColumn($alias . '.FROM_YT');
			$criteria->addSelectColumn($alias . '.STATUS');
			$criteria->addSelectColumn($alias . '.FEATURED');
			$criteria->addSelectColumn($alias . '.PAY_MORE');
			$criteria->addSelectColumn($alias . '.VIDEO_LENGTH');
			$criteria->addSelectColumn($alias . '.VIDEO_COUNT');
			$criteria->addSelectColumn($alias . '.VIDEO_TYPE');
			$criteria->addSelectColumn($alias . '.VIDEO_DATE');
			$criteria->addSelectColumn($alias . '.VIDEO_IMAGE');
			$criteria->addSelectColumn($alias . '.EMAIL_SENT');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VideoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VideoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Selects one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Video
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = VideoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Selects several row from the DB.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return VideoPeer::populateObjects(VideoPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			VideoPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Video $value A Video object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Video object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Video) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Video object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Video Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to video
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * Retrieves the primary key from the DB resultset row
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return (int) $row[$startcol];
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = VideoPeer::getOMClass();
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = VideoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = VideoPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				VideoPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (Video object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = VideoPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = VideoPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + VideoPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = VideoPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			VideoPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}


	/**
	 * Returns the number of rows matching criteria, joining the related User table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VideoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VideoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(VideoPeer::USER_ID, UserPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of Video objects pre-filled with their User objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Video objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		VideoPeer::addSelectColumns($criteria);
		$startcol = VideoPeer::NUM_HYDRATE_COLUMNS;
		UserPeer::addSelectColumns($criteria);

		$criteria->addJoin(VideoPeer::USER_ID, UserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = VideoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = VideoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = VideoPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				VideoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = UserPeer::getOMClass();

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UserPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Video) to $obj2 (User)
				$obj2->addVideo($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(VideoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			VideoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(VideoPeer::USER_ID, UserPeer::ID, $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of Video objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Video objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		VideoPeer::addSelectColumns($criteria);
		$startcol2 = VideoPeer::NUM_HYDRATE_COLUMNS;

		UserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(VideoPeer::USER_ID, UserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = VideoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = VideoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = VideoPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				VideoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined User rows

			$key2 = UserPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = UserPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = UserPeer::getOMClass();

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UserPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Video) to the collection in $obj2 (User)
				$obj2->addVideo($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseVideoPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseVideoPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new VideoTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 *
	 * @return     string ClassName
	 */
	public static function getOMClass()
	{
		return VideoPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a Video or Criteria object.
	 *
	 * @param      mixed $values Criteria or Video object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Video object
		}

		if ($criteria->containsKey(VideoPeer::ID) && $criteria->keyContainsValue(VideoPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.VideoPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Performs an UPDATE on the database, given a Video or Criteria object.
	 *
	 * @param      mixed $values Criteria or Video object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(VideoPeer::ID);
			$value = $criteria->remove(VideoPeer::ID);
			if ($value) {
				$selectCriteria->add(VideoPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(VideoPeer::TABLE_NAME);
			}

		} else { // $values is Video object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the video table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(VideoPeer::TABLE_NAME, $con, VideoPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			VideoPeer::clearInstancePool();
			VideoPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a Video or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Video object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			VideoPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Video) { // it's a model object
			// invalidate the cache for this single object
			VideoPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(VideoPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				VideoPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			VideoPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Video object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Video $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(VideoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(VideoPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(VideoPeer::DATABASE_NAME, VideoPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Video
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = VideoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(VideoPeer::DATABASE_NAME);
		$criteria->add(VideoPeer::ID, $pk);

		$v = VideoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(VideoPeer::DATABASE_NAME);
			$criteria->add(VideoPeer::ID, $pks, Criteria::IN);
			$objs = VideoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	public function filterByVideoDate($videoDate = null, $comparison = null)
	{
		if (is_array($videoDate)) {
			$useMinMax = false;
			if (isset($videoDate['min'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($videoDate['max'])) {
				$this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_DATE, $videoDate, $comparison);
	}
public function filterByVideoImage($videoImage = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($videoImage)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $videoImage)) {
				$videoImage = str_replace('*', '%', $videoImage);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(VideoPeer::VIDEO_IMAGE, $videoImage, $comparison);
	}
	
	

} // BaseVideoPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseVideoPeer::buildTableMap();

