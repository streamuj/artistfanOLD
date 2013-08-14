<?php


/**
 * Base static class for performing query and update operations on the 'adbanner' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdbannerPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'artistfan';

	/** the table name for this class */
	const TABLE_NAME = 'adbanner';

	/** the related Propel class for this table */
	const OM_CLASS = 'Adbanner';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'artistfan.Adbanner';

	/** the related TableMap class for this table */
	const TM_CLASS = 'AdbannerTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 13;

	/** the column name for the ADB_ID field */
	const ADB_ID = 'adbanner.ADB_ID';

	/** the column name for the ADB_CAT_ID field */
	const ADB_CAT_ID = 'adbanner.ADB_CAT_ID';

	/** the column name for the ADB_IMAGE field */
	const ADB_IMAGE = 'adbanner.ADB_IMAGE';

	/** the column name for the ADB_TYPE field */
	const ADB_TYPE = 'adbanner.ADB_TYPE';

	/** the column name for the ADB_NEW field */
	const ADB_NEW = 'adbanner.ADB_NEW';

	/** the column name for the ADB_LINK field */
	const ADB_LINK = 'adbanner.ADB_LINK';

	/** the column name for the ADB_STATUS field */
	const ADB_STATUS = 'adbanner.ADB_STATUS';

	/** the column name for the CREATED_ON field */
	const CREATED_ON = 'adbanner.CREATED_ON';

	/** the column name for the CREATED_BY field */
	const CREATED_BY = 'adbanner.CREATED_BY';

	/** the column name for the MODIFIED_ON field */
	const MODIFIED_ON = 'adbanner.MODIFIED_ON';

	/** the column name for the MODIFIED_BY field */
	const MODIFIED_BY = 'adbanner.MODIFIED_BY';

	/** the column name for the ADB_ORDER field */
	const ADB_ORDER = 'adbanner.ADB_ORDER';

	/** the column name for the ADB_PAGE field */
	const ADB_PAGE = 'adbanner.ADB_PAGE';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of Adbanner objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Adbanner[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('AdbId', 'AdbCatId', 'AdbImage', 'AdbType', 'AdbNew', 'AdbLink', 'AdbStatus', 'CreatedOn', 'CreatedBy', 'ModifiedOn', 'ModifiedBy', 'AdbOrder', 'AdbPage', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('adbId', 'adbCatId', 'adbImage', 'adbType', 'adbNew', 'adbLink', 'adbStatus', 'createdOn', 'createdBy', 'modifiedOn', 'modifiedBy', 'adbOrder', 'adbPage', ),
		BasePeer::TYPE_COLNAME => array (self::ADB_ID, self::ADB_CAT_ID, self::ADB_IMAGE, self::ADB_TYPE, self::ADB_NEW, self::ADB_LINK, self::ADB_STATUS, self::CREATED_ON, self::CREATED_BY, self::MODIFIED_ON, self::MODIFIED_BY, self::ADB_ORDER, self::ADB_PAGE, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ADB_ID', 'ADB_CAT_ID', 'ADB_IMAGE', 'ADB_TYPE', 'ADB_NEW', 'ADB_LINK', 'ADB_STATUS', 'CREATED_ON', 'CREATED_BY', 'MODIFIED_ON', 'MODIFIED_BY', 'ADB_ORDER', 'ADB_PAGE', ),
		BasePeer::TYPE_FIELDNAME => array ('adb_id', 'adb_cat_id', 'adb_image', 'adb_type', 'adb_new', 'adb_link', 'adb_status', 'created_on', 'created_by', 'modified_on', 'modified_by', 'adb_order', 'adb_page', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('AdbId' => 0, 'AdbCatId' => 1, 'AdbImage' => 2, 'AdbType' => 3, 'AdbNew' => 4, 'AdbLink' => 5, 'AdbStatus' => 6, 'CreatedOn' => 7, 'CreatedBy' => 8, 'ModifiedOn' => 9, 'ModifiedBy' => 10, 'AdbOrder' => 11, 'AdbPage' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('adbId' => 0, 'adbCatId' => 1, 'adbImage' => 2, 'adbType' => 3, 'adbNew' => 4, 'adbLink' => 5, 'adbStatus' => 6, 'createdOn' => 7, 'createdBy' => 8, 'modifiedOn' => 9, 'modifiedBy' => 10, 'adbOrder' => 11, 'adbPage' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::ADB_ID => 0, self::ADB_CAT_ID => 1, self::ADB_IMAGE => 2, self::ADB_TYPE => 3, self::ADB_NEW => 4, self::ADB_LINK => 5, self::ADB_STATUS => 6, self::CREATED_ON => 7, self::CREATED_BY => 8, self::MODIFIED_ON => 9, self::MODIFIED_BY => 10, self::ADB_ORDER => 11, self::ADB_PAGE => 12, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ADB_ID' => 0, 'ADB_CAT_ID' => 1, 'ADB_IMAGE' => 2, 'ADB_TYPE' => 3, 'ADB_NEW' => 4, 'ADB_LINK' => 5, 'ADB_STATUS' => 6, 'CREATED_ON' => 7, 'CREATED_BY' => 8, 'MODIFIED_ON' => 9, 'MODIFIED_BY' => 10, 'ADB_ORDER' => 11, 'ADB_PAGE' => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('adb_id' => 0, 'adb_cat_id' => 1, 'adb_image' => 2, 'adb_type' => 3, 'adb_new' => 4, 'adb_link' => 5, 'adb_status' => 6, 'created_on' => 7, 'created_by' => 8, 'modified_on' => 9, 'modified_by' => 10, 'adb_order' => 11, 'adb_page' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
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
	 * @param      string $column The column name for current table. (i.e. AdbannerPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AdbannerPeer::TABLE_NAME.'.', $alias.'.', $column);
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
			$criteria->addSelectColumn(AdbannerPeer::ADB_ID);
			$criteria->addSelectColumn(AdbannerPeer::ADB_CAT_ID);
			$criteria->addSelectColumn(AdbannerPeer::ADB_IMAGE);
			$criteria->addSelectColumn(AdbannerPeer::ADB_TYPE);
			$criteria->addSelectColumn(AdbannerPeer::ADB_NEW);
			$criteria->addSelectColumn(AdbannerPeer::ADB_LINK);
			$criteria->addSelectColumn(AdbannerPeer::ADB_STATUS);
			$criteria->addSelectColumn(AdbannerPeer::CREATED_ON);
			$criteria->addSelectColumn(AdbannerPeer::CREATED_BY);
			$criteria->addSelectColumn(AdbannerPeer::MODIFIED_ON);
			$criteria->addSelectColumn(AdbannerPeer::MODIFIED_BY);
			$criteria->addSelectColumn(AdbannerPeer::ADB_ORDER);
			$criteria->addSelectColumn(AdbannerPeer::ADB_PAGE);
		} else {
			$criteria->addSelectColumn($alias . '.ADB_ID');
			$criteria->addSelectColumn($alias . '.ADB_CAT_ID');
			$criteria->addSelectColumn($alias . '.ADB_IMAGE');
			$criteria->addSelectColumn($alias . '.ADB_TYPE');
			$criteria->addSelectColumn($alias . '.ADB_NEW');
			$criteria->addSelectColumn($alias . '.ADB_LINK');
			$criteria->addSelectColumn($alias . '.ADB_STATUS');
			$criteria->addSelectColumn($alias . '.CREATED_ON');
			$criteria->addSelectColumn($alias . '.CREATED_BY');
			$criteria->addSelectColumn($alias . '.MODIFIED_ON');
			$criteria->addSelectColumn($alias . '.MODIFIED_BY');
			$criteria->addSelectColumn($alias . '.ADB_ORDER');
			$criteria->addSelectColumn($alias . '.ADB_PAGE');
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
		$criteria->setPrimaryTableName(AdbannerPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AdbannerPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Adbanner
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AdbannerPeer::doSelect($critcopy, $con);
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
		return AdbannerPeer::populateObjects(AdbannerPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AdbannerPeer::addSelectColumns($criteria);
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
	 * @param      Adbanner $value A Adbanner object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getAdbId();
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
	 * @param      mixed $value A Adbanner object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Adbanner) {
				$key = (string) $value->getAdbId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Adbanner object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Adbanner Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
	 * Method to invalidate the instance pool of all tables related to adbanner
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
		$cls = AdbannerPeer::getOMClass(false);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AdbannerPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AdbannerPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AdbannerPeer::addInstanceToPool($obj, $key);
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
	 * @return     array (Adbanner object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = AdbannerPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = AdbannerPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + AdbannerPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = AdbannerPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			AdbannerPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
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
	  $dbMap = Propel::getDatabaseMap(BaseAdbannerPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseAdbannerPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new AdbannerTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * If $withPrefix is true, the returned path
	 * uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @param      boolean $withPrefix Whether or not to return the path with the class name
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass($withPrefix = true)
	{
		return $withPrefix ? AdbannerPeer::CLASS_DEFAULT : AdbannerPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a Adbanner or Criteria object.
	 *
	 * @param      mixed $values Criteria or Adbanner object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Adbanner object
		}

		if ($criteria->containsKey(AdbannerPeer::ADB_ID) && $criteria->keyContainsValue(AdbannerPeer::ADB_ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdbannerPeer::ADB_ID.')');
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
	 * Performs an UPDATE on the database, given a Adbanner or Criteria object.
	 *
	 * @param      mixed $values Criteria or Adbanner object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(AdbannerPeer::ADB_ID);
			$value = $criteria->remove(AdbannerPeer::ADB_ID);
			if ($value) {
				$selectCriteria->add(AdbannerPeer::ADB_ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(AdbannerPeer::TABLE_NAME);
			}

		} else { // $values is Adbanner object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the adbanner table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AdbannerPeer::TABLE_NAME, $con, AdbannerPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			AdbannerPeer::clearInstancePool();
			AdbannerPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a Adbanner or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Adbanner object or primary key or array of primary keys
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
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			AdbannerPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Adbanner) { // it's a model object
			// invalidate the cache for this single object
			AdbannerPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AdbannerPeer::ADB_ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				AdbannerPeer::removeInstanceFromPool($singleval);
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
			AdbannerPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Adbanner object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Adbanner $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AdbannerPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AdbannerPeer::TABLE_NAME);

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

		return BasePeer::doValidate(AdbannerPeer::DATABASE_NAME, AdbannerPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Adbanner
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AdbannerPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AdbannerPeer::DATABASE_NAME);
		$criteria->add(AdbannerPeer::ADB_ID, $pk);

		$v = AdbannerPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AdbannerPeer::DATABASE_NAME);
			$criteria->add(AdbannerPeer::ADB_ID, $pks, Criteria::IN);
			$objs = AdbannerPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseAdbannerPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseAdbannerPeer::buildTableMap();

