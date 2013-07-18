<?php


/**
 * Base class that represents a row from the 'adbanner' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdbanner extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'AdbannerPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AdbannerPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the adb_id field.
	 * @var        int
	 */
	protected $adb_id;

	/**
	 * The value for the adb_cat_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $adb_cat_id;

	/**
	 * The value for the adb_image field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $adb_image;

	/**
	 * The value for the adb_type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $adb_type;

	/**
	 * The value for the adb_new field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $adb_new;

	/**
	 * The value for the adb_link field.
	 * @var        string
	 */
	protected $adb_link;

	/**
	 * The value for the adb_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $adb_status;

	/**
	 * The value for the created_on field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $created_on;

	/**
	 * The value for the created_by field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $created_by;

	/**
	 * The value for the modified_on field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $modified_on;

	/**
	 * The value for the modified_by field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $modified_by;

	/**
	 * The value for the adb_order field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $adb_order;

	/**
	 * The value for the adb_page field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $adb_page;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->adb_cat_id = 0;
		$this->adb_image = '';
		$this->adb_type = 0;
		$this->adb_new = 0;
		$this->adb_status = 0;
		$this->created_on = 0;
		$this->created_by = 0;
		$this->modified_on = 0;
		$this->modified_by = 0;
		$this->adb_order = 0;
		$this->adb_page = '';
	}

	/**
	 * Initializes internal state of BaseAdbanner object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [adb_id] column value.
	 * 
	 * @return     int
	 */
	public function getAdbId()
	{
		return $this->adb_id;
	}

	/**
	 * Get the [adb_cat_id] column value.
	 * 
	 * @return     int
	 */
	public function getAdbCatId()
	{
		return $this->adb_cat_id;
	}

	/**
	 * Get the [adb_image] column value.
	 * 
	 * @return     string
	 */
	public function getAdbImage()
	{
		return $this->adb_image;
	}

	/**
	 * Get the [adb_type] column value.
	 * 
	 * @return     int
	 */
	public function getAdbType()
	{
		return $this->adb_type;
	}

	/**
	 * Get the [adb_new] column value.
	 * 
	 * @return     int
	 */
	public function getAdbNew()
	{
		return $this->adb_new;
	}

	/**
	 * Get the [adb_link] column value.
	 * 
	 * @return     string
	 */
	public function getAdbLink()
	{
		return $this->adb_link;
	}

	/**
	 * Get the [adb_status] column value.
	 * 
	 * @return     int
	 */
	public function getAdbStatus()
	{
		return $this->adb_status;
	}

	/**
	 * Get the [created_on] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedOn()
	{
		return $this->created_on;
	}

	/**
	 * Get the [created_by] column value.
	 * 
	 * @return     int
	 */
	public function getCreatedBy()
	{
		return $this->created_by;
	}

	/**
	 * Get the [modified_on] column value.
	 * 
	 * @return     int
	 */
	public function getModifiedOn()
	{
		return $this->modified_on;
	}

	/**
	 * Get the [modified_by] column value.
	 * 
	 * @return     int
	 */
	public function getModifiedBy()
	{
		return $this->modified_by;
	}

	/**
	 * Get the [adb_order] column value.
	 * 
	 * @return     int
	 */
	public function getAdbOrder()
	{
		return $this->adb_order;
	}

	/**
	 * Get the [adb_page] column value.
	 * 
	 * @return     string
	 */
	public function getAdbPage()
	{
		return $this->adb_page;
	}

	/**
	 * Set the value of [adb_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_id !== $v) {
			$this->adb_id = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_ID;
		}

		return $this;
	} // setAdbId()

	/**
	 * Set the value of [adb_cat_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbCatId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_cat_id !== $v) {
			$this->adb_cat_id = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_CAT_ID;
		}

		return $this;
	} // setAdbCatId()

	/**
	 * Set the value of [adb_image] column.
	 * 
	 * @param      string $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->adb_image !== $v) {
			$this->adb_image = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_IMAGE;
		}

		return $this;
	} // setAdbImage()

	/**
	 * Set the value of [adb_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_type !== $v) {
			$this->adb_type = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_TYPE;
		}

		return $this;
	} // setAdbType()

	/**
	 * Set the value of [adb_new] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbNew($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_new !== $v) {
			$this->adb_new = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_NEW;
		}

		return $this;
	} // setAdbNew()

	/**
	 * Set the value of [adb_link] column.
	 * 
	 * @param      string $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->adb_link !== $v) {
			$this->adb_link = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_LINK;
		}

		return $this;
	} // setAdbLink()

	/**
	 * Set the value of [adb_status] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_status !== $v) {
			$this->adb_status = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_STATUS;
		}

		return $this;
	} // setAdbStatus()

	/**
	 * Set the value of [created_on] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setCreatedOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->created_on !== $v) {
			$this->created_on = $v;
			$this->modifiedColumns[] = AdbannerPeer::CREATED_ON;
		}

		return $this;
	} // setCreatedOn()

	/**
	 * Set the value of [created_by] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setCreatedBy($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = AdbannerPeer::CREATED_BY;
		}

		return $this;
	} // setCreatedBy()

	/**
	 * Set the value of [modified_on] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setModifiedOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->modified_on !== $v) {
			$this->modified_on = $v;
			$this->modifiedColumns[] = AdbannerPeer::MODIFIED_ON;
		}

		return $this;
	} // setModifiedOn()

	/**
	 * Set the value of [modified_by] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setModifiedBy($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->modified_by !== $v) {
			$this->modified_by = $v;
			$this->modifiedColumns[] = AdbannerPeer::MODIFIED_BY;
		}

		return $this;
	} // setModifiedBy()

	/**
	 * Set the value of [adb_order] column.
	 * 
	 * @param      int $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->adb_order !== $v) {
			$this->adb_order = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_ORDER;
		}

		return $this;
	} // setAdbOrder()

	/**
	 * Set the value of [adb_page] column.
	 * 
	 * @param      string $v new value
	 * @return     Adbanner The current object (for fluent API support)
	 */
	public function setAdbPage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->adb_page !== $v) {
			$this->adb_page = $v;
			$this->modifiedColumns[] = AdbannerPeer::ADB_PAGE;
		}

		return $this;
	} // setAdbPage()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			if ($this->adb_cat_id !== 0) {
				return false;
			}

			if ($this->adb_image !== '') {
				return false;
			}

			if ($this->adb_type !== 0) {
				return false;
			}

			if ($this->adb_new !== 0) {
				return false;
			}

			if ($this->adb_status !== 0) {
				return false;
			}

			if ($this->created_on !== 0) {
				return false;
			}

			if ($this->created_by !== 0) {
				return false;
			}

			if ($this->modified_on !== 0) {
				return false;
			}

			if ($this->modified_by !== 0) {
				return false;
			}

			if ($this->adb_order !== 0) {
				return false;
			}

			if ($this->adb_page !== '') {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->adb_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->adb_cat_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->adb_image = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->adb_type = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->adb_new = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->adb_link = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->adb_status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->created_on = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->created_by = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->modified_on = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->modified_by = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->adb_order = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->adb_page = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 13; // 13 = AdbannerPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Adbanner object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AdbannerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = AdbannerQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(AdbannerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				AdbannerPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = AdbannerPeer::ADB_ID;
		if (null !== $this->adb_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . AdbannerPeer::ADB_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(AdbannerPeer::ADB_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_ID`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_CAT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_CAT_ID`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_IMAGE)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_IMAGE`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_TYPE`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_NEW)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_NEW`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_LINK)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_LINK`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_STATUS`';
		}
		if ($this->isColumnModified(AdbannerPeer::CREATED_ON)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_ON`';
		}
		if ($this->isColumnModified(AdbannerPeer::CREATED_BY)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_BY`';
		}
		if ($this->isColumnModified(AdbannerPeer::MODIFIED_ON)) {
			$modifiedColumns[':p' . $index++]  = '`MODIFIED_ON`';
		}
		if ($this->isColumnModified(AdbannerPeer::MODIFIED_BY)) {
			$modifiedColumns[':p' . $index++]  = '`MODIFIED_BY`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_ORDER)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_ORDER`';
		}
		if ($this->isColumnModified(AdbannerPeer::ADB_PAGE)) {
			$modifiedColumns[':p' . $index++]  = '`ADB_PAGE`';
		}

		$sql = sprintf(
			'INSERT INTO `adbanner` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ADB_ID`':
						$stmt->bindValue($identifier, $this->adb_id, PDO::PARAM_INT);
						break;
					case '`ADB_CAT_ID`':
						$stmt->bindValue($identifier, $this->adb_cat_id, PDO::PARAM_INT);
						break;
					case '`ADB_IMAGE`':
						$stmt->bindValue($identifier, $this->adb_image, PDO::PARAM_STR);
						break;
					case '`ADB_TYPE`':
						$stmt->bindValue($identifier, $this->adb_type, PDO::PARAM_INT);
						break;
					case '`ADB_NEW`':
						$stmt->bindValue($identifier, $this->adb_new, PDO::PARAM_INT);
						break;
					case '`ADB_LINK`':
						$stmt->bindValue($identifier, $this->adb_link, PDO::PARAM_STR);
						break;
					case '`ADB_STATUS`':
						$stmt->bindValue($identifier, $this->adb_status, PDO::PARAM_INT);
						break;
					case '`CREATED_ON`':
						$stmt->bindValue($identifier, $this->created_on, PDO::PARAM_INT);
						break;
					case '`CREATED_BY`':
						$stmt->bindValue($identifier, $this->created_by, PDO::PARAM_INT);
						break;
					case '`MODIFIED_ON`':
						$stmt->bindValue($identifier, $this->modified_on, PDO::PARAM_INT);
						break;
					case '`MODIFIED_BY`':
						$stmt->bindValue($identifier, $this->modified_by, PDO::PARAM_INT);
						break;
					case '`ADB_ORDER`':
						$stmt->bindValue($identifier, $this->adb_order, PDO::PARAM_INT);
						break;
					case '`ADB_PAGE`':
						$stmt->bindValue($identifier, $this->adb_page, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setAdbId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = AdbannerPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdbannerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getAdbId();
				break;
			case 1:
				return $this->getAdbCatId();
				break;
			case 2:
				return $this->getAdbImage();
				break;
			case 3:
				return $this->getAdbType();
				break;
			case 4:
				return $this->getAdbNew();
				break;
			case 5:
				return $this->getAdbLink();
				break;
			case 6:
				return $this->getAdbStatus();
				break;
			case 7:
				return $this->getCreatedOn();
				break;
			case 8:
				return $this->getCreatedBy();
				break;
			case 9:
				return $this->getModifiedOn();
				break;
			case 10:
				return $this->getModifiedBy();
				break;
			case 11:
				return $this->getAdbOrder();
				break;
			case 12:
				return $this->getAdbPage();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
	{
		if (isset($alreadyDumpedObjects['Adbanner'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Adbanner'][$this->getPrimaryKey()] = true;
		$keys = AdbannerPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getAdbId(),
			$keys[1] => $this->getAdbCatId(),
			$keys[2] => $this->getAdbImage(),
			$keys[3] => $this->getAdbType(),
			$keys[4] => $this->getAdbNew(),
			$keys[5] => $this->getAdbLink(),
			$keys[6] => $this->getAdbStatus(),
			$keys[7] => $this->getCreatedOn(),
			$keys[8] => $this->getCreatedBy(),
			$keys[9] => $this->getModifiedOn(),
			$keys[10] => $this->getModifiedBy(),
			$keys[11] => $this->getAdbOrder(),
			$keys[12] => $this->getAdbPage(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AdbannerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setAdbId($value);
				break;
			case 1:
				$this->setAdbCatId($value);
				break;
			case 2:
				$this->setAdbImage($value);
				break;
			case 3:
				$this->setAdbType($value);
				break;
			case 4:
				$this->setAdbNew($value);
				break;
			case 5:
				$this->setAdbLink($value);
				break;
			case 6:
				$this->setAdbStatus($value);
				break;
			case 7:
				$this->setCreatedOn($value);
				break;
			case 8:
				$this->setCreatedBy($value);
				break;
			case 9:
				$this->setModifiedOn($value);
				break;
			case 10:
				$this->setModifiedBy($value);
				break;
			case 11:
				$this->setAdbOrder($value);
				break;
			case 12:
				$this->setAdbPage($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AdbannerPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setAdbId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAdbCatId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAdbImage($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAdbType($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAdbNew($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAdbLink($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAdbStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedOn($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedBy($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setModifiedOn($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setModifiedBy($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setAdbOrder($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setAdbPage($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AdbannerPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdbannerPeer::ADB_ID)) $criteria->add(AdbannerPeer::ADB_ID, $this->adb_id);
		if ($this->isColumnModified(AdbannerPeer::ADB_CAT_ID)) $criteria->add(AdbannerPeer::ADB_CAT_ID, $this->adb_cat_id);
		if ($this->isColumnModified(AdbannerPeer::ADB_IMAGE)) $criteria->add(AdbannerPeer::ADB_IMAGE, $this->adb_image);
		if ($this->isColumnModified(AdbannerPeer::ADB_TYPE)) $criteria->add(AdbannerPeer::ADB_TYPE, $this->adb_type);
		if ($this->isColumnModified(AdbannerPeer::ADB_NEW)) $criteria->add(AdbannerPeer::ADB_NEW, $this->adb_new);
		if ($this->isColumnModified(AdbannerPeer::ADB_LINK)) $criteria->add(AdbannerPeer::ADB_LINK, $this->adb_link);
		if ($this->isColumnModified(AdbannerPeer::ADB_STATUS)) $criteria->add(AdbannerPeer::ADB_STATUS, $this->adb_status);
		if ($this->isColumnModified(AdbannerPeer::CREATED_ON)) $criteria->add(AdbannerPeer::CREATED_ON, $this->created_on);
		if ($this->isColumnModified(AdbannerPeer::CREATED_BY)) $criteria->add(AdbannerPeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(AdbannerPeer::MODIFIED_ON)) $criteria->add(AdbannerPeer::MODIFIED_ON, $this->modified_on);
		if ($this->isColumnModified(AdbannerPeer::MODIFIED_BY)) $criteria->add(AdbannerPeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(AdbannerPeer::ADB_ORDER)) $criteria->add(AdbannerPeer::ADB_ORDER, $this->adb_order);
		if ($this->isColumnModified(AdbannerPeer::ADB_PAGE)) $criteria->add(AdbannerPeer::ADB_PAGE, $this->adb_page);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AdbannerPeer::DATABASE_NAME);
		$criteria->add(AdbannerPeer::ADB_ID, $this->adb_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getAdbId();
	}

	/**
	 * Generic method to set the primary key (adb_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setAdbId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getAdbId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Adbanner (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setAdbCatId($this->getAdbCatId());
		$copyObj->setAdbImage($this->getAdbImage());
		$copyObj->setAdbType($this->getAdbType());
		$copyObj->setAdbNew($this->getAdbNew());
		$copyObj->setAdbLink($this->getAdbLink());
		$copyObj->setAdbStatus($this->getAdbStatus());
		$copyObj->setCreatedOn($this->getCreatedOn());
		$copyObj->setCreatedBy($this->getCreatedBy());
		$copyObj->setModifiedOn($this->getModifiedOn());
		$copyObj->setModifiedBy($this->getModifiedBy());
		$copyObj->setAdbOrder($this->getAdbOrder());
		$copyObj->setAdbPage($this->getAdbPage());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setAdbId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Adbanner Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     AdbannerPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AdbannerPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->adb_id = null;
		$this->adb_cat_id = null;
		$this->adb_image = null;
		$this->adb_type = null;
		$this->adb_new = null;
		$this->adb_link = null;
		$this->adb_status = null;
		$this->created_on = null;
		$this->created_by = null;
		$this->modified_on = null;
		$this->modified_by = null;
		$this->adb_order = null;
		$this->adb_page = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(AdbannerPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseAdbanner
