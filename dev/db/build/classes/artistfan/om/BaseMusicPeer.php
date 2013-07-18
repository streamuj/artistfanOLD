<?php


/**
 * Base static class for performing query and update operations on the 'music' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'artistfan';

	/** the table name for this class */
	const TABLE_NAME = 'music';

	/** the related Propel class for this table */
	const OM_CLASS = 'Music';

	/** the related TableMap class for this table */
	const TM_CLASS = 'MusicTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 18;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 18;

	/** the column name for the ID field */
	const ID = 'music.ID';

	/** the column name for the USER_ID field */
	const USER_ID = 'music.USER_ID';

	/** the column name for the TITLE field */
	const TITLE = 'music.TITLE';

	/** the column name for the ALBUM_ID field */
	const ALBUM_ID = 'music.ALBUM_ID';

	/** the column name for the GENRE field */
	const GENRE = 'music.GENRE';

	/** the column name for the DATE_RELEASE field */
	const DATE_RELEASE = 'music.DATE_RELEASE';

	/** the column name for the LABEL field */
	const LABEL = 'music.LABEL';

	/** the column name for the PRICE field */
	const PRICE = 'music.PRICE';

	/** the column name for the TRACK field */
	const TRACK = 'music.TRACK';

	/** the column name for the TRACK_PREVIEW field */
	const TRACK_PREVIEW = 'music.TRACK_PREVIEW';

	/** the column name for the TRACK_LENGTH field */
	const TRACK_LENGTH = 'music.TRACK_LENGTH';

	/** the column name for the TRACK_PREVIEW_LENGTH field */
	const TRACK_PREVIEW_LENGTH = 'music.TRACK_PREVIEW_LENGTH';

	/** the column name for the PDATE field */
	const PDATE = 'music.PDATE';

	/** the column name for the ACTIVE field */
	const ACTIVE = 'music.ACTIVE';

	/** the column name for the DELETED field */
	const DELETED = 'music.DELETED';
	
	/** the column name for the STATUS field */
	const STATUS = 'music.STATUS';
	
	/** the column name for the UPC_CODE field */
	const UPC_CODE = 'music.UPC_CODE';
	
	/** the column name for the PAY_MORE field */
	const PAY_MORE = 'music.PAY_MORE';
	
	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of Music objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Music[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'Title', 'AlbumId', 'Genre', 'DateRelease', 'Label', 'Price', 'Track', 'TrackPreview', 'TrackLength', 'TrackPreviewLength', 'Pdate', 'Active', 'Deleted', 'Status', 'UpcCode', 'PayMore', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'userId', 'title', 'albumId', 'genre', 'dateRelease', 'label', 'price', 'track', 'trackPreview', 'trackLength', 'trackPreviewLength', 'pdate', 'active', 'deleted', 'status', 'upcCode', 'payMore', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::USER_ID, self::TITLE, self::ALBUM_ID, self::GENRE, self::DATE_RELEASE, self::LABEL, self::PRICE, self::TRACK, self::TRACK_PREVIEW, self::TRACK_LENGTH, self::TRACK_PREVIEW_LENGTH, self::PDATE, self::ACTIVE, self::DELETED, self::STATUS, self::UPC_CODE, self::PAY_MORE, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'USER_ID', 'TITLE', 'ALBUM_ID', 'GENRE', 'DATE_RELEASE', 'LABEL', 'PRICE', 'TRACK', 'TRACK_PREVIEW', 'TRACK_LENGTH', 'TRACK_PREVIEW_LENGTH', 'PDATE', 'ACTIVE', 'DELETED', 'STATUS', 'UPC_CODE', 'PAY_MORE', ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'title', 'album_id', 'genre', 'date_release', 'label', 'price', 'track', 'track_preview', 'track_length', 'track_preview_length', 'pdate', 'active', 'deleted', 'status', 'upc_code', 'pay_more', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'Title' => 2, 'AlbumId' => 3, 'Genre' => 4, 'DateRelease' => 5, 'Label' => 6, 'Price' => 7, 'Track' => 8, 'TrackPreview' => 9, 'TrackLength' => 10, 'TrackPreviewLength' => 11, 'Pdate' => 12, 'Active' => 13, 'Deleted' => 14, 'Status' => 15, 'UpcCode' => 16, 'PayMore' => 17, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'userId' => 1, 'title' => 2, 'albumId' => 3, 'genre' => 4, 'dateRelease' => 5, 'label' => 6, 'price' => 7, 'track' => 8, 'trackPreview' => 9, 'trackLength' => 10, 'trackPreviewLength' => 11, 'pdate' => 12, 'active' => 13, 'deleted' => 14, 'status' =>15, 'upcCode' => 16, 'payMore' => 17, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::USER_ID => 1, self::TITLE => 2, self::ALBUM_ID => 3, self::GENRE => 4, self::DATE_RELEASE => 5, self::LABEL => 6, self::PRICE => 7, self::TRACK => 8, self::TRACK_PREVIEW => 9, self::TRACK_LENGTH => 10, self::TRACK_PREVIEW_LENGTH => 11, self::PDATE => 12, self::ACTIVE => 13, self::DELETED => 14, self::STATUS => 15, self::UPC_CODE => 16, self::PAY_MORE => 17, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'USER_ID' => 1, 'TITLE' => 2, 'ALBUM_ID' => 3, 'GENRE' => 4, 'DATE_RELEASE' => 5, 'LABEL' => 6, 'PRICE' => 7, 'TRACK' => 8, 'TRACK_PREVIEW' => 9, 'TRACK_LENGTH' => 10, 'TRACK_PREVIEW_LENGTH' => 11, 'PDATE' => 12, 'ACTIVE' => 13, 'DELETED' => 14, 'STATUS' => 15, 'UPC_CODE' => 16, 'PAY_MORE' => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'title' => 2, 'album_id' => 3, 'genre' => 4, 'date_release' => 5, 'label' => 6, 'price' => 7, 'track' => 8, 'track_preview' => 9, 'track_length' => 10, 'track_preview_length' => 11, 'pdate' => 12, 'active' => 13, 'deleted' => 14, 'status' => 15, 'upc_code' => 16, 'pay_more' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16)
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
	 * @param      string $column The column name for current table. (i.e. MusicPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MusicPeer::TABLE_NAME.'.', $alias.'.', $column);
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
			$criteria->addSelectColumn(MusicPeer::ID);
			$criteria->addSelectColumn(MusicPeer::USER_ID);
			$criteria->addSelectColumn(MusicPeer::TITLE);
			$criteria->addSelectColumn(MusicPeer::ALBUM_ID);
			$criteria->addSelectColumn(MusicPeer::GENRE);
			$criteria->addSelectColumn(MusicPeer::DATE_RELEASE);
			$criteria->addSelectColumn(MusicPeer::LABEL);
			$criteria->addSelectColumn(MusicPeer::PRICE);
			$criteria->addSelectColumn(MusicPeer::TRACK);
			$criteria->addSelectColumn(MusicPeer::TRACK_PREVIEW);
			$criteria->addSelectColumn(MusicPeer::TRACK_LENGTH);
			$criteria->addSelectColumn(MusicPeer::TRACK_PREVIEW_LENGTH);
			$criteria->addSelectColumn(MusicPeer::PDATE);
			$criteria->addSelectColumn(MusicPeer::ACTIVE);
			$criteria->addSelectColumn(MusicPeer::DELETED);
			$criteria->addSelectColumn(MusicPeer::STATUS);
			$criteria->addSelectColumn(MusicPeer::UPC_CODE);
			$criteria->addSelectColumn(MusicPeer::PAY_MORE);
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.USER_ID');
			$criteria->addSelectColumn($alias . '.TITLE');
			$criteria->addSelectColumn($alias . '.ALBUM_ID');
			$criteria->addSelectColumn($alias . '.GENRE');
			$criteria->addSelectColumn($alias . '.DATE_RELEASE');
			$criteria->addSelectColumn($alias . '.LABEL');
			$criteria->addSelectColumn($alias . '.PRICE');
			$criteria->addSelectColumn($alias . '.TRACK');
			$criteria->addSelectColumn($alias . '.TRACK_PREVIEW');
			$criteria->addSelectColumn($alias . '.TRACK_LENGTH');
			$criteria->addSelectColumn($alias . '.TRACK_PREVIEW_LENGTH');
			$criteria->addSelectColumn($alias . '.PDATE');
			$criteria->addSelectColumn($alias . '.ACTIVE');
			$criteria->addSelectColumn($alias . '.DELETED');
			$criteria->addSelectColumn($alias . '.STATUS');
			$criteria->addSelectColumn($alias . '.UPC_CODE');
			$criteria->addSelectColumn($alias . '.PAY_MORE');
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
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Music
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MusicPeer::doSelect($critcopy, $con);
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
		return MusicPeer::populateObjects(MusicPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			MusicPeer::addSelectColumns($criteria);
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
	 * @param      Music $value A Music object.
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
	 * @param      mixed $value A Music object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Music) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Music object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Music Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to music
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
		$cls = MusicPeer::getOMClass();
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = MusicPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				MusicPeer::addInstanceToPool($obj, $key);
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
	 * @return     array (Music object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = MusicPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = MusicPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + MusicPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = MusicPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			MusicPeer::addInstanceToPool($obj, $key);
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
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related MusicAlbum table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMusicAlbum(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related MusicPurchase table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMusicPurchase(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

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
	 * Selects a collection of Music objects pre-filled with their User objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
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

		MusicPeer::addSelectColumns($criteria);
		$startcol = MusicPeer::NUM_HYDRATE_COLUMNS;
		UserPeer::addSelectColumns($criteria);

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Music) to $obj2 (User)
				$obj2->addMusic($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Music objects pre-filled with their MusicAlbum objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMusicAlbum(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MusicPeer::addSelectColumns($criteria);
		$startcol = MusicPeer::NUM_HYDRATE_COLUMNS;
		MusicAlbumPeer::addSelectColumns($criteria);

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = MusicAlbumPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = MusicAlbumPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = MusicAlbumPeer::getOMClass();

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					MusicAlbumPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Music) to $obj2 (MusicAlbum)
				$obj2->addMusic($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Music objects pre-filled with their MusicPurchase objects.
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMusicPurchase(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MusicPeer::addSelectColumns($criteria);
		$startcol = MusicPeer::NUM_HYDRATE_COLUMNS;
		MusicPurchasePeer::addSelectColumns($criteria);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = MusicPurchasePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = MusicPurchasePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$cls = MusicPurchasePeer::getOMClass();

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					MusicPurchasePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Music) to $obj2 (MusicPurchase)
				// one to one relationship
				$obj1->setMusicPurchase($obj2);

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
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

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
	 * Selects a collection of Music objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
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

		MusicPeer::addSelectColumns($criteria);
		$startcol2 = MusicPeer::NUM_HYDRATE_COLUMNS;

		UserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

		MusicAlbumPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + MusicAlbumPeer::NUM_HYDRATE_COLUMNS;

		MusicPurchasePeer::addSelectColumns($criteria);
		$startcol5 = $startcol4 + MusicPurchasePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Music) to the collection in $obj2 (User)
				$obj2->addMusic($obj1);
			} // if joined row not null

			// Add objects for joined MusicAlbum rows

			$key3 = MusicAlbumPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = MusicAlbumPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$cls = MusicAlbumPeer::getOMClass();

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MusicAlbumPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Music) to the collection in $obj3 (MusicAlbum)
				$obj3->addMusic($obj1);
			} // if joined row not null

			// Add objects for joined MusicPurchase rows

			$key4 = MusicPurchasePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = MusicPurchasePeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$cls = MusicPurchasePeer::getOMClass();

					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					MusicPurchasePeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (Music) to the collection in $obj4 (MusicPurchase)
				$obj1->setMusicPurchase($obj4);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
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
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related MusicAlbum table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMusicAlbum(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related MusicPurchase table
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMusicPurchase(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(MusicPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			MusicPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY should not affect count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

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
	 * Selects a collection of Music objects pre-filled with all related objects except User.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUser(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MusicPeer::addSelectColumns($criteria);
		$startcol2 = MusicPeer::NUM_HYDRATE_COLUMNS;

		MusicAlbumPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + MusicAlbumPeer::NUM_HYDRATE_COLUMNS;

		MusicPurchasePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + MusicPurchasePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined MusicAlbum rows

				$key2 = MusicAlbumPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = MusicAlbumPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$cls = MusicAlbumPeer::getOMClass();

					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					MusicAlbumPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Music) to the collection in $obj2 (MusicAlbum)
				$obj2->addMusic($obj1);

			} // if joined row is not null

				// Add objects for joined MusicPurchase rows

				$key3 = MusicPurchasePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = MusicPurchasePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = MusicPurchasePeer::getOMClass();

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MusicPurchasePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Music) to the collection in $obj3 (MusicPurchase)
				$obj1->setMusicPurchase($obj3);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Music objects pre-filled with all related objects except MusicAlbum.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMusicAlbum(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MusicPeer::addSelectColumns($criteria);
		$startcol2 = MusicPeer::NUM_HYDRATE_COLUMNS;

		UserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

		MusicPurchasePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + MusicPurchasePeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ID, MusicPurchasePeer::MUSIC_ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (Music) to the collection in $obj2 (User)
				$obj2->addMusic($obj1);

			} // if joined row is not null

				// Add objects for joined MusicPurchase rows

				$key3 = MusicPurchasePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = MusicPurchasePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = MusicPurchasePeer::getOMClass();

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MusicPurchasePeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Music) to the collection in $obj3 (MusicPurchase)
				$obj1->setMusicPurchase($obj3);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Music objects pre-filled with all related objects except MusicPurchase.
	 *
	 * @param      Criteria  $criteria
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Music objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMusicPurchase(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$criteria = clone $criteria;

		// Set the correct dbName if it has not been overridden
		// $criteria->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($criteria->getDbName() == Propel::getDefaultDB()) {
			$criteria->setDbName(self::DATABASE_NAME);
		}

		MusicPeer::addSelectColumns($criteria);
		$startcol2 = MusicPeer::NUM_HYDRATE_COLUMNS;

		UserPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + UserPeer::NUM_HYDRATE_COLUMNS;

		MusicAlbumPeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + MusicAlbumPeer::NUM_HYDRATE_COLUMNS;

		$criteria->addJoin(MusicPeer::USER_ID, UserPeer::ID, $join_behavior);

		$criteria->addJoin(MusicPeer::ALBUM_ID, MusicAlbumPeer::ID, $join_behavior);


		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = MusicPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = MusicPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$cls = MusicPeer::getOMClass();

				$obj1 = new $cls();
				$obj1->hydrate($row);
				MusicPeer::addInstanceToPool($obj1, $key1);
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
				} // if $obj2 already loaded

				// Add the $obj1 (Music) to the collection in $obj2 (User)
				$obj2->addMusic($obj1);

			} // if joined row is not null

				// Add objects for joined MusicAlbum rows

				$key3 = MusicAlbumPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = MusicAlbumPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$cls = MusicAlbumPeer::getOMClass();

					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MusicAlbumPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Music) to the collection in $obj3 (MusicAlbum)
				$obj3->addMusic($obj1);

			} // if joined row is not null

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
	  $dbMap = Propel::getDatabaseMap(BaseMusicPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseMusicPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new MusicTableMap());
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
		return MusicPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a Music or Criteria object.
	 *
	 * @param      mixed $values Criteria or Music object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Music object
		}

		if ($criteria->containsKey(MusicPeer::ID) && $criteria->keyContainsValue(MusicPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.MusicPeer::ID.')');
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
	 * Performs an UPDATE on the database, given a Music or Criteria object.
	 *
	 * @param      mixed $values Criteria or Music object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(MusicPeer::ID);
			$value = $criteria->remove(MusicPeer::ID);
			if ($value) {
				$selectCriteria->add(MusicPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(MusicPeer::TABLE_NAME);
			}

		} else { // $values is Music object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the music table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(MusicPeer::TABLE_NAME, $con, MusicPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			MusicPeer::clearInstancePool();
			MusicPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a Music or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Music object or primary key or array of primary keys
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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			MusicPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Music) { // it's a model object
			// invalidate the cache for this single object
			MusicPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MusicPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				MusicPeer::removeInstanceFromPool($singleval);
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
			MusicPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Music object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Music $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MusicPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MusicPeer::TABLE_NAME);

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

		return BasePeer::doValidate(MusicPeer::DATABASE_NAME, MusicPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Music
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = MusicPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(MusicPeer::DATABASE_NAME);
		$criteria->add(MusicPeer::ID, $pk);

		$v = MusicPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(MusicPeer::DATABASE_NAME);
			$criteria->add(MusicPeer::ID, $pks, Criteria::IN);
			$objs = MusicPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseMusicPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseMusicPeer::buildTableMap();
