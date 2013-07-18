<?php


/**
 * Base class that represents a row from the 'home_slide' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHomeSlide extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'HomeSlidePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HomeSlidePeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the hs_id field.
	 * @var        int
	 */
	protected $hs_id;

	/**
	 * The value for the hs_image field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $hs_image;

	/**
	 * The value for the hs_order field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hs_order;

	/**
	 * The value for the hs_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hs_status;

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
	 * The value for the hs_link field.
	 * @var        string
	 */
	protected $hs_link;

	/**
	 * The value for the hs_new field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hs_new;
	
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
		$this->hs_image = '';
		$this->hs_order = 0;
		$this->hs_status = 0;
		$this->created_on = 0;
		$this->created_by = 0;
		$this->modified_on = 0;
		$this->modified_by = 0;
		$this->hs_new = 0;

	}

	/**
	 * Initializes internal state of BaseHomeSlide object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [hs_id] column value.
	 * 
	 * @return     int
	 */
	public function getHsId()
	{
		return $this->hs_id;
	}

	/**
	 * Get the [hs_image] column value.
	 * 
	 * @return     string
	 */
	public function getHsImage()
	{
		return $this->hs_image;
	}

	/**
	 * Get the [hs_order] column value.
	 * 
	 * @return     int
	 */
	public function getHsOrder()
	{
		return $this->hs_order;
	}

	/**
	 * Get the [hs_status] column value.
	 * 
	 * @return     int
	 */
	public function getHsStatus()
	{
		return $this->hs_status;
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
	 * Get the [hs_link] column value.
	 * 
	 * @return     string
	 */
	public function getHsLink()
	{
		return $this->hs_link;
	}
	/**
	 * Get the [hs_new] column value.
	 * 
	 * @return     int
	 */
	public function getHsNew()
	{
		return $this->hs_new;
	}

	/**
	 * Set the value of [hs_id] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hs_id !== $v) {
			$this->hs_id = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_ID;
		}

		return $this;
	} // setHsId()

	/**
	 * Set the value of [hs_image] column.
	 * 
	 * @param      string $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hs_image !== $v) {
			$this->hs_image = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_IMAGE;
		}

		return $this;
	} // setHsImage()

	/**
	 * Set the value of [hs_order] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hs_order !== $v) {
			$this->hs_order = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_ORDER;
		}

		return $this;
	} // setHsOrder()

	/**
	 * Set the value of [hs_status] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hs_status !== $v) {
			$this->hs_status = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_STATUS;
		}

		return $this;
	} // setHsStatus()

	/**
	 * Set the value of [created_on] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setCreatedOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->created_on !== $v) {
			$this->created_on = $v;
			$this->modifiedColumns[] = HomeSlidePeer::CREATED_ON;
		}

		return $this;
	} // setCreatedOn()

	/**
	 * Set the value of [created_by] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setCreatedBy($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->created_by !== $v) {
			$this->created_by = $v;
			$this->modifiedColumns[] = HomeSlidePeer::CREATED_BY;
		}

		return $this;
	} // setCreatedBy()

	/**
	 * Set the value of [modified_on] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setModifiedOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->modified_on !== $v) {
			$this->modified_on = $v;
			$this->modifiedColumns[] = HomeSlidePeer::MODIFIED_ON;
		}

		return $this;
	} // setModifiedOn()

	/**
	 * Set the value of [modified_by] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setModifiedBy($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->modified_by !== $v) {
			$this->modified_by = $v;
			$this->modifiedColumns[] = HomeSlidePeer::MODIFIED_BY;
		}

		return $this;
	} // setModifiedBy()

	/**
	 * Set the value of [hs_link] column.
	 * 
	 * @param      string $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hs_link !== $v) {
			$this->hs_link = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_LINK;
		}

		return $this;
	} // setHsLink()


	/**
	 * Set the value of [hs_new] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeSlide The current object (for fluent API support)
	 */
	public function setHsNew($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hs_new !== $v) {
			$this->hs_new = $v;
			$this->modifiedColumns[] = HomeSlidePeer::HS_NEW;
		}

		return $this;
	} // setHsNew()

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
			if ($this->hs_image !== '') {
				return false;
			}

			if ($this->hs_order !== 0) {
				return false;
			}

			if ($this->hs_status !== 0) {
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

			if ($this->hs_new !== 0) {
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

			$this->hs_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->hs_image = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->hs_order = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->hs_status = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->created_on = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->created_by = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->modified_on = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->modified_by = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->hs_link = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->hs_new = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;

			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 9; // 9 = HomeSlidePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating HomeSlide object", $e);
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
			$con = Propel::getConnection(HomeSlidePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HomeSlidePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(HomeSlidePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = HomeSlideQuery::create()
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
			$con = Propel::getConnection(HomeSlidePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				HomeSlidePeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = HomeSlidePeer::HS_ID;
		if (null !== $this->hs_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . HomeSlidePeer::HS_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(HomeSlidePeer::HS_ID)) {
			$modifiedColumns[':p' . $index++]  = '`HS_ID`';
		}
		if ($this->isColumnModified(HomeSlidePeer::HS_IMAGE)) {
			$modifiedColumns[':p' . $index++]  = '`HS_IMAGE`';
		}
		if ($this->isColumnModified(HomeSlidePeer::HS_ORDER)) {
			$modifiedColumns[':p' . $index++]  = '`HS_ORDER`';
		}
		if ($this->isColumnModified(HomeSlidePeer::HS_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`HS_STATUS`';
		}
		if ($this->isColumnModified(HomeSlidePeer::CREATED_ON)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_ON`';
		}
		if ($this->isColumnModified(HomeSlidePeer::CREATED_BY)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_BY`';
		}
		if ($this->isColumnModified(HomeSlidePeer::MODIFIED_ON)) {
			$modifiedColumns[':p' . $index++]  = '`MODIFIED_ON`';
		}
		if ($this->isColumnModified(HomeSlidePeer::MODIFIED_BY)) {
			$modifiedColumns[':p' . $index++]  = '`MODIFIED_BY`';
		}
		if ($this->isColumnModified(HomeSlidePeer::HS_LINK)) {
			$modifiedColumns[':p' . $index++]  = '`HS_LINK`';
		}
		if ($this->isColumnModified(HomeSlidePeer::HS_NEW)) {
			$modifiedColumns[':p' . $index++]  = '`HS_NEW`';
		}
		

		$sql = sprintf(
			'INSERT INTO `home_slide` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`HS_ID`':
						$stmt->bindValue($identifier, $this->hs_id, PDO::PARAM_INT);
						break;
					case '`HS_IMAGE`':
						$stmt->bindValue($identifier, $this->hs_image, PDO::PARAM_STR);
						break;
					case '`HS_ORDER`':
						$stmt->bindValue($identifier, $this->hs_order, PDO::PARAM_INT);
						break;
					case '`HS_STATUS`':
						$stmt->bindValue($identifier, $this->hs_status, PDO::PARAM_INT);
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
					case '`HS_LINK`':
						$stmt->bindValue($identifier, $this->hs_link, PDO::PARAM_STR);
						break;
					case '`HS_NEW`':
						$stmt->bindValue($identifier, $this->hs_new, PDO::PARAM_INT);
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
		$this->setHsId($pk);

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


			if (($retval = HomeSlidePeer::doValidate($this, $columns)) !== true) {
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
		$pos = HomeSlidePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getHsId();
				break;
			case 1:
				return $this->getHsImage();
				break;
			case 2:
				return $this->getHsOrder();
				break;
			case 3:
				return $this->getHsStatus();
				break;
			case 4:
				return $this->getCreatedOn();
				break;
			case 5:
				return $this->getCreatedBy();
				break;
			case 6:
				return $this->getModifiedOn();
				break;
			case 7:
				return $this->getModifiedBy();
				break;
			case 8:
				return $this->getHsLink();
				break;
			case 9:
				return $this->getHsNew();
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
		if (isset($alreadyDumpedObjects['HomeSlide'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['HomeSlide'][$this->getPrimaryKey()] = true;
		$keys = HomeSlidePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHsId(),
			$keys[1] => $this->getHsImage(),
			$keys[2] => $this->getHsOrder(),
			$keys[3] => $this->getHsStatus(),
			$keys[4] => $this->getCreatedOn(),
			$keys[5] => $this->getCreatedBy(),
			$keys[6] => $this->getModifiedOn(),
			$keys[7] => $this->getModifiedBy(),
			$keys[8] => $this->getHsLink(),
			$keys[9] => $this->getHsNew(),
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
		$pos = HomeSlidePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setHsId($value);
				break;
			case 1:
				$this->setHsImage($value);
				break;
			case 2:
				$this->setHsOrder($value);
				break;
			case 3:
				$this->setHsStatus($value);
				break;
			case 4:
				$this->setCreatedOn($value);
				break;
			case 5:
				$this->setCreatedBy($value);
				break;
			case 6:
				$this->setModifiedOn($value);
				break;
			case 7:
				$this->setModifiedBy($value);
				break;
			case 8:
				$this->setHsLink($value);
				break;
			case 9:
				$this->setHsNew($value);
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
		$keys = HomeSlidePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHsId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHsImage($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHsOrder($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHsStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedOn($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setModifiedOn($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setModifiedBy($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHsLink($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setHsNew($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HomeSlidePeer::DATABASE_NAME);

		if ($this->isColumnModified(HomeSlidePeer::HS_ID)) $criteria->add(HomeSlidePeer::HS_ID, $this->hs_id);
		if ($this->isColumnModified(HomeSlidePeer::HS_IMAGE)) $criteria->add(HomeSlidePeer::HS_IMAGE, $this->hs_image);
		if ($this->isColumnModified(HomeSlidePeer::HS_ORDER)) $criteria->add(HomeSlidePeer::HS_ORDER, $this->hs_order);
		if ($this->isColumnModified(HomeSlidePeer::HS_STATUS)) $criteria->add(HomeSlidePeer::HS_STATUS, $this->hs_status);
		if ($this->isColumnModified(HomeSlidePeer::CREATED_ON)) $criteria->add(HomeSlidePeer::CREATED_ON, $this->created_on);
		if ($this->isColumnModified(HomeSlidePeer::CREATED_BY)) $criteria->add(HomeSlidePeer::CREATED_BY, $this->created_by);
		if ($this->isColumnModified(HomeSlidePeer::MODIFIED_ON)) $criteria->add(HomeSlidePeer::MODIFIED_ON, $this->modified_on);
		if ($this->isColumnModified(HomeSlidePeer::MODIFIED_BY)) $criteria->add(HomeSlidePeer::MODIFIED_BY, $this->modified_by);
		if ($this->isColumnModified(HomeSlidePeer::HS_LINK)) $criteria->add(HomeSlidePeer::HS_LINK, $this->hs_link);
		if ($this->isColumnModified(HomeSlidePeer::HS_NEW)) $criteria->add(HomeSlidePeer::HS_NEW, $this->hs_new);

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
		$criteria = new Criteria(HomeSlidePeer::DATABASE_NAME);
		$criteria->add(HomeSlidePeer::HS_ID, $this->hs_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getHsId();
	}

	/**
	 * Generic method to set the primary key (hs_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setHsId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getHsId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of HomeSlide (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setHsImage($this->getHsImage());
		$copyObj->setHsOrder($this->getHsOrder());
		$copyObj->setHsStatus($this->getHsStatus());
		$copyObj->setCreatedOn($this->getCreatedOn());
		$copyObj->setCreatedBy($this->getCreatedBy());
		$copyObj->setModifiedOn($this->getModifiedOn());
		$copyObj->setModifiedBy($this->getModifiedBy());
		$copyObj->setHsLink($this->getHsLink());
		$copyObj->setHsNew($this->getHsNew());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setHsId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     HomeSlide Clone of current object.
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
	 * @return     HomeSlidePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HomeSlidePeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->hs_id = null;
		$this->hs_image = null;
		$this->hs_order = null;
		$this->hs_status = null;
		$this->created_on = null;
		$this->created_by = null;
		$this->modified_on = null;
		$this->modified_by = null;
		$this->hs_link = null;
		$this->hs_new = null;		
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
		return (string) $this->exportTo(HomeSlidePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseHomeSlide
