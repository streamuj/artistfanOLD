<?php


/**
 * Base class that represents a row from the 'comment' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseComment extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CommentPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CommentPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the cmt_id field.
	 * @var        int
	 */
	protected $cmt_id;

	/**
	 * The value for the cmt_user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cmt_user_id;

	/**
	 * The value for the cmt_refer_type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cmt_refer_type;

	/**
	 * The value for the cmt_refer_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cmt_refer_id;

	/**
	 * The value for the cmt_message field.
	 * @var        string
	 */
	protected $cmt_message;

	/**
	 * The value for the cmt_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cmt_date;

	/**
	 * The value for the cmt_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cmt_status;

	/**
	 * @var        User
	 */
	protected $aUserFromK;

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
		$this->cmt_user_id = 0;
		$this->cmt_refer_type = 0;
		$this->cmt_refer_id = 0;
		$this->cmt_date = 0;
		$this->cmt_status = 0;
	}

	/**
	 * Initializes internal state of BaseComment object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [cmt_id] column value.
	 * 
	 * @return     int
	 */
	public function getCmtId()
	{
		return $this->cmt_id;
	}

	/**
	 * Get the [cmt_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getCmtUserId()
	{
		return $this->cmt_user_id;
	}

	/**
	 * Get the [cmt_refer_type] column value.
	 * 
	 * @return     int
	 */
	public function getCmtReferType()
	{
		return $this->cmt_refer_type;
	}

	/**
	 * Get the [cmt_refer_id] column value.
	 * 
	 * @return     int
	 */
	public function getCmtReferId()
	{
		return $this->cmt_refer_id;
	}

	/**
	 * Get the [cmt_message] column value.
	 * 
	 * @return     string
	 */
	public function getCmtMessage()
	{
		return $this->cmt_message;
	}

	/**
	 * Get the [cmt_date] column value.
	 * 
	 * @return     int
	 */
	public function getCmtDate()
	{
		return $this->cmt_date;
	}

	/**
	 * Get the [cmt_status] column value.
	 * 
	 * @return     int
	 */
	public function getCmtStatus()
	{
		return $this->cmt_status;
	}

	/**
	 * Set the value of [cmt_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_id !== $v) {
			$this->cmt_id = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_ID;
		}

		return $this;
	} // setCmtId()

	/**
	 * Set the value of [cmt_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_user_id !== $v) {
			$this->cmt_user_id = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_USER_ID;
		}

		if ($this->aUserFromK !== null && $this->aUserFromK->getId() !== $v) {
			$this->aUserFromK = null;
		}

		return $this;
	} // setCmtUserId()

	/**
	 * Set the value of [cmt_refer_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtReferType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_refer_type !== $v) {
			$this->cmt_refer_type = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_REFER_TYPE;
		}

		return $this;
	} // setCmtReferType()

	/**
	 * Set the value of [cmt_refer_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtReferId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_refer_id !== $v) {
			$this->cmt_refer_id = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_REFER_ID;
		}

		return $this;
	} // setCmtReferId()

	/**
	 * Set the value of [cmt_message] column.
	 * 
	 * @param      string $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cmt_message !== $v) {
			$this->cmt_message = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_MESSAGE;
		}

		return $this;
	} // setCmtMessage()

	/**
	 * Set the value of [cmt_date] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_date !== $v) {
			$this->cmt_date = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_DATE;
		}

		return $this;
	} // setCmtDate()

	/**
	 * Set the value of [cmt_status] column.
	 * 
	 * @param      int $v new value
	 * @return     Comment The current object (for fluent API support)
	 */
	public function setCmtStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cmt_status !== $v) {
			$this->cmt_status = $v;
			$this->modifiedColumns[] = CommentPeer::CMT_STATUS;
		}

		return $this;
	} // setCmtStatus()

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
			if ($this->cmt_user_id !== 0) {
				return false;
			}

			if ($this->cmt_refer_type !== 0) {
				return false;
			}

			if ($this->cmt_refer_id !== 0) {
				return false;
			}

			if ($this->cmt_date !== 0) {
				return false;
			}

			if ($this->cmt_status !== 0) {
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

			$this->cmt_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->cmt_user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->cmt_refer_type = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->cmt_refer_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->cmt_message = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->cmt_date = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->cmt_status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = CommentPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Comment object", $e);
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

		if ($this->aUserFromK !== null && $this->cmt_user_id !== $this->aUserFromK->getId()) {
			$this->aUserFromK = null;
		}
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
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CommentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUserFromK = null;
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
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = CommentQuery::create()
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
			$con = Propel::getConnection(CommentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				CommentPeer::addInstanceToPool($this);
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

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUserFromK !== null) {
				if ($this->aUserFromK->isModified() || $this->aUserFromK->isNew()) {
					$affectedRows += $this->aUserFromK->save($con);
				}
				$this->setUserFromK($this->aUserFromK);
			}

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

		$this->modifiedColumns[] = CommentPeer::CMT_ID;
		if (null !== $this->cmt_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . CommentPeer::CMT_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(CommentPeer::CMT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_ID`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_USER_ID`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_REFER_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_REFER_TYPE`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_REFER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_REFER_ID`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_MESSAGE)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_MESSAGE`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_DATE`';
		}
		if ($this->isColumnModified(CommentPeer::CMT_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`CMT_STATUS`';
		}

		$sql = sprintf(
			'INSERT INTO `comment` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`CMT_ID`':
						$stmt->bindValue($identifier, $this->cmt_id, PDO::PARAM_INT);
						break;
					case '`CMT_USER_ID`':
						$stmt->bindValue($identifier, $this->cmt_user_id, PDO::PARAM_INT);
						break;
					case '`CMT_REFER_TYPE`':
						$stmt->bindValue($identifier, $this->cmt_refer_type, PDO::PARAM_INT);
						break;
					case '`CMT_REFER_ID`':
						$stmt->bindValue($identifier, $this->cmt_refer_id, PDO::PARAM_INT);
						break;
					case '`CMT_MESSAGE`':
						$stmt->bindValue($identifier, $this->cmt_message, PDO::PARAM_STR);
						break;
					case '`CMT_DATE`':
						$stmt->bindValue($identifier, $this->cmt_date, PDO::PARAM_INT);
						break;
					case '`CMT_STATUS`':
						$stmt->bindValue($identifier, $this->cmt_status, PDO::PARAM_INT);
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
		$this->setCmtId($pk);

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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aUserFromK !== null) {
				if (!$this->aUserFromK->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUserFromK->getValidationFailures());
				}
			}


			if (($retval = CommentPeer::doValidate($this, $columns)) !== true) {
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
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCmtId();
				break;
			case 1:
				return $this->getCmtUserId();
				break;
			case 2:
				return $this->getCmtReferType();
				break;
			case 3:
				return $this->getCmtReferId();
				break;
			case 4:
				return $this->getCmtMessage();
				break;
			case 5:
				return $this->getCmtDate();
				break;
			case 6:
				return $this->getCmtStatus();
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
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Comment'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Comment'][$this->getPrimaryKey()] = true;
		$keys = CommentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCmtId(),
			$keys[1] => $this->getCmtUserId(),
			$keys[2] => $this->getCmtReferType(),
			$keys[3] => $this->getCmtReferId(),
			$keys[4] => $this->getCmtMessage(),
			$keys[5] => $this->getCmtDate(),
			$keys[6] => $this->getCmtStatus(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUserFromK) {
				$result['UserFromK'] = $this->aUserFromK->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
		}
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
		$pos = CommentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCmtId($value);
				break;
			case 1:
				$this->setCmtUserId($value);
				break;
			case 2:
				$this->setCmtReferType($value);
				break;
			case 3:
				$this->setCmtReferId($value);
				break;
			case 4:
				$this->setCmtMessage($value);
				break;
			case 5:
				$this->setCmtDate($value);
				break;
			case 6:
				$this->setCmtStatus($value);
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
		$keys = CommentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCmtId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCmtUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCmtReferType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCmtReferId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCmtMessage($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCmtDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCmtStatus($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);

		if ($this->isColumnModified(CommentPeer::CMT_ID)) $criteria->add(CommentPeer::CMT_ID, $this->cmt_id);
		if ($this->isColumnModified(CommentPeer::CMT_USER_ID)) $criteria->add(CommentPeer::CMT_USER_ID, $this->cmt_user_id);
		if ($this->isColumnModified(CommentPeer::CMT_REFER_TYPE)) $criteria->add(CommentPeer::CMT_REFER_TYPE, $this->cmt_refer_type);
		if ($this->isColumnModified(CommentPeer::CMT_REFER_ID)) $criteria->add(CommentPeer::CMT_REFER_ID, $this->cmt_refer_id);
		if ($this->isColumnModified(CommentPeer::CMT_MESSAGE)) $criteria->add(CommentPeer::CMT_MESSAGE, $this->cmt_message);
		if ($this->isColumnModified(CommentPeer::CMT_DATE)) $criteria->add(CommentPeer::CMT_DATE, $this->cmt_date);
		if ($this->isColumnModified(CommentPeer::CMT_STATUS)) $criteria->add(CommentPeer::CMT_STATUS, $this->cmt_status);

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
		$criteria = new Criteria(CommentPeer::DATABASE_NAME);
		$criteria->add(CommentPeer::CMT_ID, $this->cmt_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCmtId();
	}

	/**
	 * Generic method to set the primary key (cmt_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCmtId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getCmtId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Comment (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setCmtUserId($this->getCmtUserId());
		$copyObj->setCmtReferType($this->getCmtReferType());
		$copyObj->setCmtReferId($this->getCmtReferId());
		$copyObj->setCmtMessage($this->getCmtMessage());
		$copyObj->setCmtDate($this->getCmtDate());
		$copyObj->setCmtStatus($this->getCmtStatus());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setCmtId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Comment Clone of current object.
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
	 * @return     CommentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CommentPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Comment The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUserFromK(User $v = null)
	{
		if ($v === null) {
			$this->setCmtUserId(0);
		} else {
			$this->setCmtUserId($v->getId());
		}

		$this->aUserFromK = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addComment($this);
		}

		return $this;
	}


	/**
	 * Get the associated User object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     User The associated User object.
	 * @throws     PropelException
	 */
	public function getUserFromK(PropelPDO $con = null)
	{
		if ($this->aUserFromK === null && ($this->cmt_user_id !== null)) {
			$this->aUserFromK = UserQuery::create()->findPk($this->cmt_user_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aUserFromK->addComments($this);
			 */
		}
		return $this->aUserFromK;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->cmt_id = null;
		$this->cmt_user_id = null;
		$this->cmt_refer_type = null;
		$this->cmt_refer_id = null;
		$this->cmt_message = null;
		$this->cmt_date = null;
		$this->cmt_status = null;
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

		$this->aUserFromK = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(CommentPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseComment
