<?php


/**
 * Base class that represents a row from the 'purchase' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePurchase extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'PurchasePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PurchasePeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the pc_id field.
	 * @var        int
	 */
	protected $pc_id;

	/**
	 * The value for the pc_type_name field.
	 * @var        string
	 */
	protected $pc_type_name;

	/**
	 * The value for the pc_type_id field.
	 * @var        int
	 */
	protected $pc_type_id;

	/**
	 * The value for the pc_price field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $pc_price;

	/**
	 * The value for the pc_description field.
	 * @var        string
	 */
	protected $pc_description;

	/**
	 * The value for the pc_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pc_date;

	/**
	 * The value for the pc_user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pc_user_id;

	/**
	 * The value for the pc_artist_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pc_artist_id;

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
		$this->pc_price = 0;
		$this->pc_date = 0;
		$this->pc_user_id = 0;
		$this->pc_artist_id = 0;
	}

	/**
	 * Initializes internal state of BasePurchase object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [pc_id] column value.
	 * 
	 * @return     int
	 */
	public function getPcId()
	{
		return $this->pc_id;
	}

	/**
	 * Get the [pc_type_name] column value.
	 * 
	 * @return     string
	 */
	public function getPcTypeName()
	{
		return $this->pc_type_name;
	}

	/**
	 * Get the [pc_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getPcTypeId()
	{
		return $this->pc_type_id;
	}

	/**
	 * Get the [pc_price] column value.
	 * 
	 * @return     double
	 */
	public function getPcPrice()
	{
		return $this->pc_price;
	}

	/**
	 * Get the [pc_description] column value.
	 * 
	 * @return     string
	 */
	public function getPcDescription()
	{
		return $this->pc_description;
	}

	/**
	 * Get the [pc_date] column value.
	 * 
	 * @return     int
	 */
	public function getPcDate()
	{
		return $this->pc_date;
	}

	/**
	 * Get the [pc_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getPcUserId()
	{
		return $this->pc_user_id;
	}

	/**
	 * Get the [pc_artist_id] column value.
	 * 
	 * @return     int
	 */
	public function getPcArtistId()
	{
		return $this->pc_artist_id;
	}

	/**
	 * Set the value of [pc_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pc_id !== $v) {
			$this->pc_id = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_ID;
		}

		return $this;
	} // setPcId()

	/**
	 * Set the value of [pc_type_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcTypeName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pc_type_name !== $v) {
			$this->pc_type_name = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_TYPE_NAME;
		}

		return $this;
	} // setPcTypeName()

	/**
	 * Set the value of [pc_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcTypeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pc_type_id !== $v) {
			$this->pc_type_id = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_TYPE_ID;
		}

		return $this;
	} // setPcTypeId()

	/**
	 * Set the value of [pc_price] column.
	 * 
	 * @param      double $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->pc_price !== $v) {
			$this->pc_price = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_PRICE;
		}

		return $this;
	} // setPcPrice()

	/**
	 * Set the value of [pc_description] column.
	 * 
	 * @param      string $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pc_description !== $v) {
			$this->pc_description = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_DESCRIPTION;
		}

		return $this;
	} // setPcDescription()

	/**
	 * Set the value of [pc_date] column.
	 * 
	 * @param      int $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pc_date !== $v) {
			$this->pc_date = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_DATE;
		}

		return $this;
	} // setPcDate()

	/**
	 * Set the value of [pc_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pc_user_id !== $v) {
			$this->pc_user_id = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_USER_ID;
		}

		return $this;
	} // setPcUserId()

	/**
	 * Set the value of [pc_artist_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Purchase The current object (for fluent API support)
	 */
	public function setPcArtistId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pc_artist_id !== $v) {
			$this->pc_artist_id = $v;
			$this->modifiedColumns[] = PurchasePeer::PC_ARTIST_ID;
		}

		return $this;
	} // setPcArtistId()

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
			if ($this->pc_price !== 0) {
				return false;
			}

			if ($this->pc_date !== 0) {
				return false;
			}

			if ($this->pc_user_id !== 0) {
				return false;
			}

			if ($this->pc_artist_id !== 0) {
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

			$this->pc_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->pc_type_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->pc_type_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->pc_price = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
			$this->pc_description = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->pc_date = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->pc_user_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->pc_artist_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = PurchasePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Purchase object", $e);
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
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PurchasePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = PurchaseQuery::create()
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
			$con = Propel::getConnection(PurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				PurchasePeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = PurchasePeer::PC_ID;
		if (null !== $this->pc_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . PurchasePeer::PC_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(PurchasePeer::PC_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PC_ID`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_TYPE_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`PC_TYPE_NAME`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_TYPE_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PC_TYPE_ID`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PC_PRICE`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_DESCRIPTION)) {
			$modifiedColumns[':p' . $index++]  = '`PC_DESCRIPTION`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`PC_DATE`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PC_USER_ID`';
		}
		if ($this->isColumnModified(PurchasePeer::PC_ARTIST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PC_ARTIST_ID`';
		}

		$sql = sprintf(
			'INSERT INTO `purchase` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`PC_ID`':
						$stmt->bindValue($identifier, $this->pc_id, PDO::PARAM_INT);
						break;
					case '`PC_TYPE_NAME`':
						$stmt->bindValue($identifier, $this->pc_type_name, PDO::PARAM_STR);
						break;
					case '`PC_TYPE_ID`':
						$stmt->bindValue($identifier, $this->pc_type_id, PDO::PARAM_INT);
						break;
					case '`PC_PRICE`':
						$stmt->bindValue($identifier, $this->pc_price, PDO::PARAM_STR);
						break;
					case '`PC_DESCRIPTION`':
						$stmt->bindValue($identifier, $this->pc_description, PDO::PARAM_STR);
						break;
					case '`PC_DATE`':
						$stmt->bindValue($identifier, $this->pc_date, PDO::PARAM_INT);
						break;
					case '`PC_USER_ID`':
						$stmt->bindValue($identifier, $this->pc_user_id, PDO::PARAM_INT);
						break;
					case '`PC_ARTIST_ID`':
						$stmt->bindValue($identifier, $this->pc_artist_id, PDO::PARAM_INT);
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
		$this->setPcId($pk);

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


			if (($retval = PurchasePeer::doValidate($this, $columns)) !== true) {
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
		$pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPcId();
				break;
			case 1:
				return $this->getPcTypeName();
				break;
			case 2:
				return $this->getPcTypeId();
				break;
			case 3:
				return $this->getPcPrice();
				break;
			case 4:
				return $this->getPcDescription();
				break;
			case 5:
				return $this->getPcDate();
				break;
			case 6:
				return $this->getPcUserId();
				break;
			case 7:
				return $this->getPcArtistId();
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
		if (isset($alreadyDumpedObjects['Purchase'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Purchase'][$this->getPrimaryKey()] = true;
		$keys = PurchasePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPcId(),
			$keys[1] => $this->getPcTypeName(),
			$keys[2] => $this->getPcTypeId(),
			$keys[3] => $this->getPcPrice(),
			$keys[4] => $this->getPcDescription(),
			$keys[5] => $this->getPcDate(),
			$keys[6] => $this->getPcUserId(),
			$keys[7] => $this->getPcArtistId(),
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
		$pos = PurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPcId($value);
				break;
			case 1:
				$this->setPcTypeName($value);
				break;
			case 2:
				$this->setPcTypeId($value);
				break;
			case 3:
				$this->setPcPrice($value);
				break;
			case 4:
				$this->setPcDescription($value);
				break;
			case 5:
				$this->setPcDate($value);
				break;
			case 6:
				$this->setPcUserId($value);
				break;
			case 7:
				$this->setPcArtistId($value);
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
		$keys = PurchasePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPcId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPcTypeName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPcTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPcPrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPcDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPcDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPcUserId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPcArtistId($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PurchasePeer::DATABASE_NAME);

		if ($this->isColumnModified(PurchasePeer::PC_ID)) $criteria->add(PurchasePeer::PC_ID, $this->pc_id);
		if ($this->isColumnModified(PurchasePeer::PC_TYPE_NAME)) $criteria->add(PurchasePeer::PC_TYPE_NAME, $this->pc_type_name);
		if ($this->isColumnModified(PurchasePeer::PC_TYPE_ID)) $criteria->add(PurchasePeer::PC_TYPE_ID, $this->pc_type_id);
		if ($this->isColumnModified(PurchasePeer::PC_PRICE)) $criteria->add(PurchasePeer::PC_PRICE, $this->pc_price);
		if ($this->isColumnModified(PurchasePeer::PC_DESCRIPTION)) $criteria->add(PurchasePeer::PC_DESCRIPTION, $this->pc_description);
		if ($this->isColumnModified(PurchasePeer::PC_DATE)) $criteria->add(PurchasePeer::PC_DATE, $this->pc_date);
		if ($this->isColumnModified(PurchasePeer::PC_USER_ID)) $criteria->add(PurchasePeer::PC_USER_ID, $this->pc_user_id);
		if ($this->isColumnModified(PurchasePeer::PC_ARTIST_ID)) $criteria->add(PurchasePeer::PC_ARTIST_ID, $this->pc_artist_id);

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
		$criteria = new Criteria(PurchasePeer::DATABASE_NAME);
		$criteria->add(PurchasePeer::PC_ID, $this->pc_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getPcId();
	}

	/**
	 * Generic method to set the primary key (pc_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setPcId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getPcId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Purchase (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setPcTypeName($this->getPcTypeName());
		$copyObj->setPcTypeId($this->getPcTypeId());
		$copyObj->setPcPrice($this->getPcPrice());
		$copyObj->setPcDescription($this->getPcDescription());
		$copyObj->setPcDate($this->getPcDate());
		$copyObj->setPcUserId($this->getPcUserId());
		$copyObj->setPcArtistId($this->getPcArtistId());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setPcId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Purchase Clone of current object.
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
	 * @return     PurchasePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PurchasePeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->pc_id = null;
		$this->pc_type_name = null;
		$this->pc_type_id = null;
		$this->pc_price = null;
		$this->pc_description = null;
		$this->pc_date = null;
		$this->pc_user_id = null;
		$this->pc_artist_id = null;
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
		return (string) $this->exportTo(PurchasePeer::DEFAULT_STRING_FORMAT);
	}

} // BasePurchase
