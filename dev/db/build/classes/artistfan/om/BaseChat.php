<?php


/**
 * Base class that represents a row from the 'chat' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseChat extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ChatPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ChatPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the cht_id field.
	 * @var        int
	 */
	protected $cht_id;

	/**
	 * The value for the cht_from field.
	 * @var        int
	 */
	protected $cht_from;

	/**
	 * The value for the cht_to field.
	 * @var        int
	 */
	protected $cht_to;

	/**
	 * The value for the cht_message field.
	 * @var        string
	 */
	protected $cht_message;

	/**
	 * The value for the cht_sent field.
	 * @var        int
	 */
	protected $cht_sent;

	/**
	 * The value for the cht_recd field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cht_recd;

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
		$this->cht_recd = 0;
	}

	/**
	 * Initializes internal state of BaseChat object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [cht_id] column value.
	 * 
	 * @return     int
	 */
	public function getChtId()
	{
		return $this->cht_id;
	}

	/**
	 * Get the [cht_from] column value.
	 * 
	 * @return     int
	 */
	public function getChtFrom()
	{
		return $this->cht_from;
	}

	/**
	 * Get the [cht_to] column value.
	 * 
	 * @return     int
	 */
	public function getChtTo()
	{
		return $this->cht_to;
	}

	/**
	 * Get the [cht_message] column value.
	 * 
	 * @return     string
	 */
	public function getChtMessage()
	{
		return $this->cht_message;
	}

	/**
	 * Get the [cht_sent] column value.
	 * 
	 * @return     int
	 */
	public function getChtSent()
	{
		return $this->cht_sent;
	}

	/**
	 * Get the [cht_recd] column value.
	 * 
	 * @return     int
	 */
	public function getChtRecd()
	{
		return $this->cht_recd;
	}

	/**
	 * Set the value of [cht_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cht_id !== $v) {
			$this->cht_id = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_ID;
		}

		return $this;
	} // setChtId()

	/**
	 * Set the value of [cht_from] column.
	 * 
	 * @param      int $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtFrom($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cht_from !== $v) {
			$this->cht_from = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_FROM;
		}

		return $this;
	} // setChtFrom()

	/**
	 * Set the value of [cht_to] column.
	 * 
	 * @param      int $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtTo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cht_to !== $v) {
			$this->cht_to = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_TO;
		}

		return $this;
	} // setChtTo()

	/**
	 * Set the value of [cht_message] column.
	 * 
	 * @param      string $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->cht_message !== $v) {
			$this->cht_message = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_MESSAGE;
		}

		return $this;
	} // setChtMessage()

	/**
	 * Set the value of [cht_sent] column.
	 * 
	 * @param      int $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtSent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cht_sent !== $v) {
			$this->cht_sent = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_SENT;
		}

		return $this;
	} // setChtSent()

	/**
	 * Set the value of [cht_recd] column.
	 * 
	 * @param      int $v new value
	 * @return     Chat The current object (for fluent API support)
	 */
	public function setChtRecd($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cht_recd !== $v) {
			$this->cht_recd = $v;
			$this->modifiedColumns[] = ChatPeer::CHT_RECD;
		}

		return $this;
	} // setChtRecd()

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
			if ($this->cht_recd !== 0) {
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

			$this->cht_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->cht_from = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->cht_to = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->cht_message = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->cht_sent = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->cht_recd = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = ChatPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Chat object", $e);
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
			$con = Propel::getConnection(ChatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ChatPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(ChatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ChatQuery::create()
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
			$con = Propel::getConnection(ChatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ChatPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = ChatPeer::CHT_ID;
		if (null !== $this->cht_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ChatPeer::CHT_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ChatPeer::CHT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_ID`';
		}
		if ($this->isColumnModified(ChatPeer::CHT_FROM)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_FROM`';
		}
		if ($this->isColumnModified(ChatPeer::CHT_TO)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_TO`';
		}
		if ($this->isColumnModified(ChatPeer::CHT_MESSAGE)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_MESSAGE`';
		}
		if ($this->isColumnModified(ChatPeer::CHT_SENT)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_SENT`';
		}
		if ($this->isColumnModified(ChatPeer::CHT_RECD)) {
			$modifiedColumns[':p' . $index++]  = '`CHT_RECD`';
		}

		$sql = sprintf(
			'INSERT INTO `chat` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`CHT_ID`':
						$stmt->bindValue($identifier, $this->cht_id, PDO::PARAM_INT);
						break;
					case '`CHT_FROM`':
						$stmt->bindValue($identifier, $this->cht_from, PDO::PARAM_INT);
						break;
					case '`CHT_TO`':
						$stmt->bindValue($identifier, $this->cht_to, PDO::PARAM_INT);
						break;
					case '`CHT_MESSAGE`':
						$stmt->bindValue($identifier, $this->cht_message, PDO::PARAM_STR);
						break;
					case '`CHT_SENT`':
						$stmt->bindValue($identifier, $this->cht_sent, PDO::PARAM_INT);
						break;
					case '`CHT_RECD`':
						$stmt->bindValue($identifier, $this->cht_recd, PDO::PARAM_INT);
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
		$this->setChtId($pk);

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


			if (($retval = ChatPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ChatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getChtId();
				break;
			case 1:
				return $this->getChtFrom();
				break;
			case 2:
				return $this->getChtTo();
				break;
			case 3:
				return $this->getChtMessage();
				break;
			case 4:
				return $this->getChtSent();
				break;
			case 5:
				return $this->getChtRecd();
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
		if (isset($alreadyDumpedObjects['Chat'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Chat'][$this->getPrimaryKey()] = true;
		$keys = ChatPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getChtId(),
			$keys[1] => $this->getChtFrom(),
			$keys[2] => $this->getChtTo(),
			$keys[3] => $this->getChtMessage(),
			$keys[4] => $this->getChtSent(),
			$keys[5] => $this->getChtRecd(),
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
		$pos = ChatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setChtId($value);
				break;
			case 1:
				$this->setChtFrom($value);
				break;
			case 2:
				$this->setChtTo($value);
				break;
			case 3:
				$this->setChtMessage($value);
				break;
			case 4:
				$this->setChtSent($value);
				break;
			case 5:
				$this->setChtRecd($value);
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
		$keys = ChatPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setChtId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setChtFrom($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setChtTo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setChtMessage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setChtSent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setChtRecd($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ChatPeer::DATABASE_NAME);

		if ($this->isColumnModified(ChatPeer::CHT_ID)) $criteria->add(ChatPeer::CHT_ID, $this->cht_id);
		if ($this->isColumnModified(ChatPeer::CHT_FROM)) $criteria->add(ChatPeer::CHT_FROM, $this->cht_from);
		if ($this->isColumnModified(ChatPeer::CHT_TO)) $criteria->add(ChatPeer::CHT_TO, $this->cht_to);
		if ($this->isColumnModified(ChatPeer::CHT_MESSAGE)) $criteria->add(ChatPeer::CHT_MESSAGE, $this->cht_message);
		if ($this->isColumnModified(ChatPeer::CHT_SENT)) $criteria->add(ChatPeer::CHT_SENT, $this->cht_sent);
		if ($this->isColumnModified(ChatPeer::CHT_RECD)) $criteria->add(ChatPeer::CHT_RECD, $this->cht_recd);

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
		$criteria = new Criteria(ChatPeer::DATABASE_NAME);
		$criteria->add(ChatPeer::CHT_ID, $this->cht_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getChtId();
	}

	/**
	 * Generic method to set the primary key (cht_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setChtId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getChtId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Chat (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setChtFrom($this->getChtFrom());
		$copyObj->setChtTo($this->getChtTo());
		$copyObj->setChtMessage($this->getChtMessage());
		$copyObj->setChtSent($this->getChtSent());
		$copyObj->setChtRecd($this->getChtRecd());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setChtId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Chat Clone of current object.
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
	 * @return     ChatPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ChatPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->cht_id = null;
		$this->cht_from = null;
		$this->cht_to = null;
		$this->cht_message = null;
		$this->cht_sent = null;
		$this->cht_recd = null;
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
		return (string) $this->exportTo(ChatPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseChat
