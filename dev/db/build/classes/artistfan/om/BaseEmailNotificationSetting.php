<?php


/**
 * Base class that represents a row from the 'emil_notification_setting' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEmailNotificationSetting extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'EmailNotificationSettingPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EmailNotificationSettingPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the ens_id field.
	 * @var        int
	 */
	protected $ens_id;

	/**
	 * The value for the ens_user_id field.
	 * @var        int
	 */
	protected $ens_user_id;

	/**
	 * The value for the ens_ent_id field.
	 * @var        int
	 */
	protected $ens_ent_id;

	/**
	 * The value for the ens_status field.
	 * @var        int
	 */
	protected $ens_status;

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
	 * Get the [ens_id] column value.
	 * 
	 * @return     int
	 */
	public function getEnsId()
	{
		return $this->ens_id;
	}

	/**
	 * Get the [ens_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getEnsUserId()
	{
		return $this->ens_user_id;
	}

	/**
	 * Get the [ens_ent_id] column value.
	 * 
	 * @return     int
	 */
	public function getEnsEntId()
	{
		return $this->ens_ent_id;
	}

	/**
	 * Get the [ens_status] column value.
	 * 
	 * @return     int
	 */
	public function getEnsStatus()
	{
		return $this->ens_status;
	}

	/**
	 * Set the value of [ens_id] column.
	 * 
	 * @param      int $v new value
	 * @return     EmailNotificationSetting The current object (for fluent API support)
	 */
	public function setEnsId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ens_id !== $v) {
			$this->ens_id = $v;
			$this->modifiedColumns[] = EmailNotificationSettingPeer::ENS_ID;
		}

		return $this;
	} // setEnsId()

	/**
	 * Set the value of [ens_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     EmailNotificationSetting The current object (for fluent API support)
	 */
	public function setEnsUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ens_user_id !== $v) {
			$this->ens_user_id = $v;
			$this->modifiedColumns[] = EmailNotificationSettingPeer::ENS_USER_ID;
		}

		return $this;
	} // setEnsUserId()

	/**
	 * Set the value of [ens_ent_id] column.
	 * 
	 * @param      int $v new value
	 * @return     EmailNotificationSetting The current object (for fluent API support)
	 */
	public function setEnsEntId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ens_ent_id !== $v) {
			$this->ens_ent_id = $v;
			$this->modifiedColumns[] = EmailNotificationSettingPeer::ENS_ENT_ID;
		}

		return $this;
	} // setEnsEntId()

	/**
	 * Set the value of [ens_status] column.
	 * 
	 * @param      int $v new value
	 * @return     EmailNotificationSetting The current object (for fluent API support)
	 */
	public function setEnsStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ens_status !== $v) {
			$this->ens_status = $v;
			$this->modifiedColumns[] = EmailNotificationSettingPeer::ENS_STATUS;
		}

		return $this;
	} // setEnsStatus()

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

			$this->ens_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ens_user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ens_ent_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ens_status = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 4; // 4 = EmailNotificationSettingPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating EmailNotificationSetting object", $e);
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
			$con = Propel::getConnection(EmailNotificationSettingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = EmailNotificationSettingPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(EmailNotificationSettingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = EmailNotificationSettingQuery::create()
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
			$con = Propel::getConnection(EmailNotificationSettingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				EmailNotificationSettingPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = EmailNotificationSettingPeer::ENS_ID;
		if (null !== $this->ens_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmailNotificationSettingPeer::ENS_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ENS_ID`';
		}
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ENS_USER_ID`';
		}
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_ENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ENS_ENT_ID`';
		}
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`ENS_STATUS`';
		}

		$sql = sprintf(
			'INSERT INTO `emil_notification_setting` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ENS_ID`':
						$stmt->bindValue($identifier, $this->ens_id, PDO::PARAM_INT);
						break;
					case '`ENS_USER_ID`':
						$stmt->bindValue($identifier, $this->ens_user_id, PDO::PARAM_INT);
						break;
					case '`ENS_ENT_ID`':
						$stmt->bindValue($identifier, $this->ens_ent_id, PDO::PARAM_INT);
						break;
					case '`ENS_STATUS`':
						$stmt->bindValue($identifier, $this->ens_status, PDO::PARAM_INT);
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
		$this->setEnsId($pk);

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


			if (($retval = EmailNotificationSettingPeer::doValidate($this, $columns)) !== true) {
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
		$pos = EmailNotificationSettingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEnsId();
				break;
			case 1:
				return $this->getEnsUserId();
				break;
			case 2:
				return $this->getEnsEntId();
				break;
			case 3:
				return $this->getEnsStatus();
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
		if (isset($alreadyDumpedObjects['EmailNotificationSetting'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['EmailNotificationSetting'][$this->getPrimaryKey()] = true;
		$keys = EmailNotificationSettingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getEnsId(),
			$keys[1] => $this->getEnsUserId(),
			$keys[2] => $this->getEnsEntId(),
			$keys[3] => $this->getEnsStatus(),
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
		$pos = EmailNotificationSettingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEnsId($value);
				break;
			case 1:
				$this->setEnsUserId($value);
				break;
			case 2:
				$this->setEnsEntId($value);
				break;
			case 3:
				$this->setEnsStatus($value);
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
		$keys = EmailNotificationSettingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEnsId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEnsUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEnsEntId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEnsStatus($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailNotificationSettingPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_ID)) $criteria->add(EmailNotificationSettingPeer::ENS_ID, $this->ens_id);
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_USER_ID)) $criteria->add(EmailNotificationSettingPeer::ENS_USER_ID, $this->ens_user_id);
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_ENT_ID)) $criteria->add(EmailNotificationSettingPeer::ENS_ENT_ID, $this->ens_ent_id);
		if ($this->isColumnModified(EmailNotificationSettingPeer::ENS_STATUS)) $criteria->add(EmailNotificationSettingPeer::ENS_STATUS, $this->ens_status);

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
		$criteria = new Criteria(EmailNotificationSettingPeer::DATABASE_NAME);
		$criteria->add(EmailNotificationSettingPeer::ENS_ID, $this->ens_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getEnsId();
	}

	/**
	 * Generic method to set the primary key (ens_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setEnsId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getEnsId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of EmailNotificationSetting (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setEnsUserId($this->getEnsUserId());
		$copyObj->setEnsEntId($this->getEnsEntId());
		$copyObj->setEnsStatus($this->getEnsStatus());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setEnsId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     EmailNotificationSetting Clone of current object.
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
	 * @return     EmailNotificationSettingPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EmailNotificationSettingPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->ens_id = null;
		$this->ens_user_id = null;
		$this->ens_ent_id = null;
		$this->ens_status = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
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
		return (string) $this->exportTo(EmailNotificationSettingPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseEmailNotificationSetting
