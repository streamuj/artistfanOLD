<?php


/**
 * Base class that represents a row from the 'home_category' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHomeCategory extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'HomeCategoryPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HomeCategoryPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the hc_id field.
	 * @var        int
	 */
	protected $hc_id;

	/**
	 * The value for the hc_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $hc_name;

	/**
	 * The value for the hc_type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hc_type;

	/**
	 * The value for the hc_parent field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hc_parent;

	/**
	 * The value for the hc_order field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hc_order;

	/**
	 * The value for the hc_status field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $hc_status;

	/**
	 * The value for the hc_text field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $hc_text;

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
		$this->hc_name = '';
		$this->hc_type = 0;
		$this->hc_parent = 0;
		$this->hc_order = 0;
		$this->hc_status = 1;
		$this->hc_text = '';
	}

	/**
	 * Initializes internal state of BaseHomeCategory object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [hc_id] column value.
	 * 
	 * @return     int
	 */
	public function getHcId()
	{
		return $this->hc_id;
	}

	/**
	 * Get the [hc_name] column value.
	 * 
	 * @return     string
	 */
	public function getHcName()
	{
		return $this->hc_name;
	}

	/**
	 * Get the [hc_type] column value.
	 * 
	 * @return     int
	 */
	public function getHcType()
	{
		return $this->hc_type;
	}

	/**
	 * Get the [hc_parent] column value.
	 * 
	 * @return     int
	 */
	public function getHcParent()
	{
		return $this->hc_parent;
	}

	/**
	 * Get the [hc_order] column value.
	 * 
	 * @return     int
	 */
	public function getHcOrder()
	{
		return $this->hc_order;
	}

	/**
	 * Get the [hc_status] column value.
	 * 
	 * @return     int
	 */
	public function getHcStatus()
	{
		return $this->hc_status;
	}

	/**
	 * Get the [hc_text] column value.
	 * 
	 * @return     string
	 */
	public function getHcText()
	{
		return $this->hc_text;
	}

	/**
	 * Set the value of [hc_id] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hc_id !== $v) {
			$this->hc_id = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_ID;
		}

		return $this;
	} // setHcId()

	/**
	 * Set the value of [hc_name] column.
	 * 
	 * @param      string $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hc_name !== $v) {
			$this->hc_name = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_NAME;
		}

		return $this;
	} // setHcName()

	/**
	 * Set the value of [hc_type] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hc_type !== $v) {
			$this->hc_type = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_TYPE;
		}

		return $this;
	} // setHcType()

	/**
	 * Set the value of [hc_parent] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcParent($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hc_parent !== $v) {
			$this->hc_parent = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_PARENT;
		}

		return $this;
	} // setHcParent()

	/**
	 * Set the value of [hc_order] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hc_order !== $v) {
			$this->hc_order = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_ORDER;
		}

		return $this;
	} // setHcOrder()

	/**
	 * Set the value of [hc_status] column.
	 * 
	 * @param      int $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hc_status !== $v) {
			$this->hc_status = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_STATUS;
		}

		return $this;
	} // setHcStatus()

	/**
	 * Set the value of [hc_text] column.
	 * 
	 * @param      string $v new value
	 * @return     HomeCategory The current object (for fluent API support)
	 */
	public function setHcText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hc_text !== $v) {
			$this->hc_text = $v;
			$this->modifiedColumns[] = HomeCategoryPeer::HC_TEXT;
		}

		return $this;
	} // setHcText()

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
			if ($this->hc_name !== '') {
				return false;
			}

			if ($this->hc_type !== 0) {
				return false;
			}

			if ($this->hc_parent !== 0) {
				return false;
			}

			if ($this->hc_order !== 0) {
				return false;
			}

			if ($this->hc_status !== 1) {
				return false;
			}

			if ($this->hc_text !== '') {
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

			$this->hc_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->hc_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->hc_type = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->hc_parent = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->hc_order = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->hc_status = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->hc_text = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = HomeCategoryPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating HomeCategory object", $e);
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
			$con = Propel::getConnection(HomeCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HomeCategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(HomeCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = HomeCategoryQuery::create()
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
			$con = Propel::getConnection(HomeCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				HomeCategoryPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = HomeCategoryPeer::HC_ID;
		if (null !== $this->hc_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . HomeCategoryPeer::HC_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(HomeCategoryPeer::HC_ID)) {
			$modifiedColumns[':p' . $index++]  = '`HC_ID`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`HC_NAME`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`HC_TYPE`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_PARENT)) {
			$modifiedColumns[':p' . $index++]  = '`HC_PARENT`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_ORDER)) {
			$modifiedColumns[':p' . $index++]  = '`HC_ORDER`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`HC_STATUS`';
		}
		if ($this->isColumnModified(HomeCategoryPeer::HC_TEXT)) {
			$modifiedColumns[':p' . $index++]  = '`HC_TEXT`';
		}

		$sql = sprintf(
			'INSERT INTO `home_category` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`HC_ID`':
						$stmt->bindValue($identifier, $this->hc_id, PDO::PARAM_INT);
						break;
					case '`HC_NAME`':
						$stmt->bindValue($identifier, $this->hc_name, PDO::PARAM_STR);
						break;
					case '`HC_TYPE`':
						$stmt->bindValue($identifier, $this->hc_type, PDO::PARAM_INT);
						break;
					case '`HC_PARENT`':
						$stmt->bindValue($identifier, $this->hc_parent, PDO::PARAM_INT);
						break;
					case '`HC_ORDER`':
						$stmt->bindValue($identifier, $this->hc_order, PDO::PARAM_INT);
						break;
					case '`HC_STATUS`':
						$stmt->bindValue($identifier, $this->hc_status, PDO::PARAM_INT);
						break;
					case '`HC_TEXT`':
						$stmt->bindValue($identifier, $this->hc_text, PDO::PARAM_STR);
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
		$this->setHcId($pk);

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


			if (($retval = HomeCategoryPeer::doValidate($this, $columns)) !== true) {
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
		$pos = HomeCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getHcId();
				break;
			case 1:
				return $this->getHcName();
				break;
			case 2:
				return $this->getHcType();
				break;
			case 3:
				return $this->getHcParent();
				break;
			case 4:
				return $this->getHcOrder();
				break;
			case 5:
				return $this->getHcStatus();
				break;
			case 6:
				return $this->getHcText();
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
		if (isset($alreadyDumpedObjects['HomeCategory'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['HomeCategory'][$this->getPrimaryKey()] = true;
		$keys = HomeCategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHcId(),
			$keys[1] => $this->getHcName(),
			$keys[2] => $this->getHcType(),
			$keys[3] => $this->getHcParent(),
			$keys[4] => $this->getHcOrder(),
			$keys[5] => $this->getHcStatus(),
			$keys[6] => $this->getHcText(),
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
		$pos = HomeCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setHcId($value);
				break;
			case 1:
				$this->setHcName($value);
				break;
			case 2:
				$this->setHcType($value);
				break;
			case 3:
				$this->setHcParent($value);
				break;
			case 4:
				$this->setHcOrder($value);
				break;
			case 5:
				$this->setHcStatus($value);
				break;
			case 6:
				$this->setHcText($value);
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
		$keys = HomeCategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHcId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHcName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHcType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setHcParent($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHcOrder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setHcStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHcText($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HomeCategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(HomeCategoryPeer::HC_ID)) $criteria->add(HomeCategoryPeer::HC_ID, $this->hc_id);
		if ($this->isColumnModified(HomeCategoryPeer::HC_NAME)) $criteria->add(HomeCategoryPeer::HC_NAME, $this->hc_name);
		if ($this->isColumnModified(HomeCategoryPeer::HC_TYPE)) $criteria->add(HomeCategoryPeer::HC_TYPE, $this->hc_type);
		if ($this->isColumnModified(HomeCategoryPeer::HC_PARENT)) $criteria->add(HomeCategoryPeer::HC_PARENT, $this->hc_parent);
		if ($this->isColumnModified(HomeCategoryPeer::HC_ORDER)) $criteria->add(HomeCategoryPeer::HC_ORDER, $this->hc_order);
		if ($this->isColumnModified(HomeCategoryPeer::HC_STATUS)) $criteria->add(HomeCategoryPeer::HC_STATUS, $this->hc_status);
		if ($this->isColumnModified(HomeCategoryPeer::HC_TEXT)) $criteria->add(HomeCategoryPeer::HC_TEXT, $this->hc_text);

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
		$criteria = new Criteria(HomeCategoryPeer::DATABASE_NAME);
		$criteria->add(HomeCategoryPeer::HC_ID, $this->hc_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getHcId();
	}

	/**
	 * Generic method to set the primary key (hc_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setHcId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getHcId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of HomeCategory (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setHcName($this->getHcName());
		$copyObj->setHcType($this->getHcType());
		$copyObj->setHcParent($this->getHcParent());
		$copyObj->setHcOrder($this->getHcOrder());
		$copyObj->setHcStatus($this->getHcStatus());
		$copyObj->setHcText($this->getHcText());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setHcId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     HomeCategory Clone of current object.
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
	 * @return     HomeCategoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HomeCategoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->hc_id = null;
		$this->hc_name = null;
		$this->hc_type = null;
		$this->hc_parent = null;
		$this->hc_order = null;
		$this->hc_status = null;
		$this->hc_text = null;
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
		return (string) $this->exportTo(HomeCategoryPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseHomeCategory
