<?php


/**
 * Base class that represents a row from the 'notification' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseNotification extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'NotificationPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        NotificationPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the na_id field.
	 * @var        int
	 */
	protected $na_id;

	/**
	 * The value for the na_wall_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $na_wall_id;

	/**
	 * The value for the na_comment_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $na_comment_id;

	/**
	 * The value for the na_message field.
	 * Note: this column has a database default value of: '0'
	 * @var        string
	 */
	protected $na_message;

	/**
	 * The value for the na_user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $na_user_id;

	/**
	 * The value for the na_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $na_status;

	/**
	 * The value for the na_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $na_date;

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
		$this->na_wall_id = 0;
		$this->na_comment_id = 0;
		$this->na_message = '0';
		$this->na_user_id = 0;
		$this->na_status = 0;
		$this->na_date = 0;
	}

	/**
	 * Initializes internal state of BaseNotification object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [na_id] column value.
	 * 
	 * @return     int
	 */
	public function getNaId()
	{
		return $this->na_id;
	}

	/**
	 * Get the [na_wall_id] column value.
	 * 
	 * @return     int
	 */
	public function getNaWallId()
	{
		return $this->na_wall_id;
	}

	/**
	 * Get the [na_comment_id] column value.
	 * 
	 * @return     int
	 */
	public function getNaCommentId()
	{
		return $this->na_comment_id;
	}

	/**
	 * Get the [na_message] column value.
	 * 
	 * @return     string
	 */
	public function getNaMessage()
	{
		return $this->na_message;
	}

	/**
	 * Get the [na_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getNaUserId()
	{
		return $this->na_user_id;
	}

	/**
	 * Get the [na_status] column value.
	 * 
	 * @return     int
	 */
	public function getNaStatus()
	{
		return $this->na_status;
	}

	/**
	 * Get the [na_date] column value.
	 * 
	 * @return     int
	 */
	public function getNaDate()
	{
		return $this->na_date;
	}

	/**
	 * Set the value of [na_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_id !== $v) {
			$this->na_id = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_ID;
		}

		return $this;
	} // setNaId()

	/**
	 * Set the value of [na_wall_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaWallId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_wall_id !== $v) {
			$this->na_wall_id = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_WALL_ID;
		}

		return $this;
	} // setNaWallId()

	/**
	 * Set the value of [na_comment_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaCommentId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_comment_id !== $v) {
			$this->na_comment_id = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_COMMENT_ID;
		}

		return $this;
	} // setNaCommentId()

	/**
	 * Set the value of [na_message] column.
	 * 
	 * @param      string $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->na_message !== $v) {
			$this->na_message = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_MESSAGE;
		}

		return $this;
	} // setNaMessage()

	/**
	 * Set the value of [na_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_user_id !== $v) {
			$this->na_user_id = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_USER_ID;
		}

		return $this;
	} // setNaUserId()

	/**
	 * Set the value of [na_status] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_status !== $v) {
			$this->na_status = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_STATUS;
		}

		return $this;
	} // setNaStatus()

	/**
	 * Set the value of [na_date] column.
	 * 
	 * @param      int $v new value
	 * @return     Notification The current object (for fluent API support)
	 */
	public function setNaDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->na_date !== $v) {
			$this->na_date = $v;
			$this->modifiedColumns[] = NotificationPeer::NA_DATE;
		}

		return $this;
	} // setNaDate()

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
			if ($this->na_wall_id !== 0) {
				return false;
			}

			if ($this->na_comment_id !== 0) {
				return false;
			}

			if ($this->na_message !== '0') {
				return false;
			}

			if ($this->na_user_id !== 0) {
				return false;
			}

			if ($this->na_status !== 0) {
				return false;
			}

			if ($this->na_date !== 0) {
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

			$this->na_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->na_wall_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->na_comment_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->na_message = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->na_user_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->na_status = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->na_date = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = NotificationPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Notification object", $e);
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
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = NotificationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = NotificationQuery::create()
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
			$con = Propel::getConnection(NotificationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				NotificationPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = NotificationPeer::NA_ID;
		if (null !== $this->na_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . NotificationPeer::NA_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(NotificationPeer::NA_ID)) {
			$modifiedColumns[':p' . $index++]  = '`NA_ID`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_WALL_ID)) {
			$modifiedColumns[':p' . $index++]  = '`NA_WALL_ID`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_COMMENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`NA_COMMENT_ID`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_MESSAGE)) {
			$modifiedColumns[':p' . $index++]  = '`NA_MESSAGE`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`NA_USER_ID`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`NA_STATUS`';
		}
		if ($this->isColumnModified(NotificationPeer::NA_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`NA_DATE`';
		}

		$sql = sprintf(
			'INSERT INTO `notification` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`NA_ID`':
						$stmt->bindValue($identifier, $this->na_id, PDO::PARAM_INT);
						break;
					case '`NA_WALL_ID`':
						$stmt->bindValue($identifier, $this->na_wall_id, PDO::PARAM_INT);
						break;
					case '`NA_COMMENT_ID`':
						$stmt->bindValue($identifier, $this->na_comment_id, PDO::PARAM_INT);
						break;
					case '`NA_MESSAGE`':
						$stmt->bindValue($identifier, $this->na_message, PDO::PARAM_STR);
						break;
					case '`NA_USER_ID`':
						$stmt->bindValue($identifier, $this->na_user_id, PDO::PARAM_INT);
						break;
					case '`NA_STATUS`':
						$stmt->bindValue($identifier, $this->na_status, PDO::PARAM_INT);
						break;
					case '`NA_DATE`':
						$stmt->bindValue($identifier, $this->na_date, PDO::PARAM_INT);
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
		$this->setNaId($pk);

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


			if (($retval = NotificationPeer::doValidate($this, $columns)) !== true) {
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
		$pos = NotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNaId();
				break;
			case 1:
				return $this->getNaWallId();
				break;
			case 2:
				return $this->getNaCommentId();
				break;
			case 3:
				return $this->getNaMessage();
				break;
			case 4:
				return $this->getNaUserId();
				break;
			case 5:
				return $this->getNaStatus();
				break;
			case 6:
				return $this->getNaDate();
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
		if (isset($alreadyDumpedObjects['Notification'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Notification'][$this->getPrimaryKey()] = true;
		$keys = NotificationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNaId(),
			$keys[1] => $this->getNaWallId(),
			$keys[2] => $this->getNaCommentId(),
			$keys[3] => $this->getNaMessage(),
			$keys[4] => $this->getNaUserId(),
			$keys[5] => $this->getNaStatus(),
			$keys[6] => $this->getNaDate(),
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
		$pos = NotificationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNaId($value);
				break;
			case 1:
				$this->setNaWallId($value);
				break;
			case 2:
				$this->setNaCommentId($value);
				break;
			case 3:
				$this->setNaMessage($value);
				break;
			case 4:
				$this->setNaUserId($value);
				break;
			case 5:
				$this->setNaStatus($value);
				break;
			case 6:
				$this->setNaDate($value);
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
		$keys = NotificationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNaWallId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNaCommentId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNaMessage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNaUserId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNaStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNaDate($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(NotificationPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotificationPeer::NA_ID)) $criteria->add(NotificationPeer::NA_ID, $this->na_id);
		if ($this->isColumnModified(NotificationPeer::NA_WALL_ID)) $criteria->add(NotificationPeer::NA_WALL_ID, $this->na_wall_id);
		if ($this->isColumnModified(NotificationPeer::NA_COMMENT_ID)) $criteria->add(NotificationPeer::NA_COMMENT_ID, $this->na_comment_id);
		if ($this->isColumnModified(NotificationPeer::NA_MESSAGE)) $criteria->add(NotificationPeer::NA_MESSAGE, $this->na_message);
		if ($this->isColumnModified(NotificationPeer::NA_USER_ID)) $criteria->add(NotificationPeer::NA_USER_ID, $this->na_user_id);
		if ($this->isColumnModified(NotificationPeer::NA_STATUS)) $criteria->add(NotificationPeer::NA_STATUS, $this->na_status);
		if ($this->isColumnModified(NotificationPeer::NA_DATE)) $criteria->add(NotificationPeer::NA_DATE, $this->na_date);

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
		$criteria = new Criteria(NotificationPeer::DATABASE_NAME);
		$criteria->add(NotificationPeer::NA_ID, $this->na_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getNaId();
	}

	/**
	 * Generic method to set the primary key (na_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setNaId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getNaId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Notification (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setNaWallId($this->getNaWallId());
		$copyObj->setNaCommentId($this->getNaCommentId());
		$copyObj->setNaMessage($this->getNaMessage());
		$copyObj->setNaUserId($this->getNaUserId());
		$copyObj->setNaStatus($this->getNaStatus());
		$copyObj->setNaDate($this->getNaDate());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setNaId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Notification Clone of current object.
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
	 * @return     NotificationPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new NotificationPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->na_id = null;
		$this->na_wall_id = null;
		$this->na_comment_id = null;
		$this->na_message = null;
		$this->na_user_id = null;
		$this->na_status = null;
		$this->na_date = null;
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
		return (string) $this->exportTo(NotificationPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseNotification
