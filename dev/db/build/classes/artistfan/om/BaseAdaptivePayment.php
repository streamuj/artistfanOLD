<?php


/**
 * Base class that represents a row from the 'adaptive_payment' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseAdaptivePayment extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'AdaptivePaymentPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        AdaptivePaymentPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the ap_id field.
	 * @var        int
	 */
	protected $ap_id;

	/**
	 * The value for the ap_sender_email field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ap_sender_email;

	/**
	 * The value for the ap_approval_key field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ap_approval_key;

	/**
	 * The value for the ap_from_date field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ap_from_date;

	/**
	 * The value for the ap_to_date field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ap_to_date;

	/**
	 * The value for the ap_max_amount field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ap_max_amount;

	/**
	 * The value for the ap_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $ap_date;

	/**
	 * The value for the ap_status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $ap_status;

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
		$this->ap_sender_email = '';
		$this->ap_approval_key = '';
		$this->ap_from_date = '';
		$this->ap_to_date = '';
		$this->ap_max_amount = '';
		$this->ap_date = 0;
		$this->ap_status = 0;
	}

	/**
	 * Initializes internal state of BaseAdaptivePayment object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [ap_id] column value.
	 * 
	 * @return     int
	 */
	public function getApId()
	{
		return $this->ap_id;
	}

	/**
	 * Get the [ap_sender_email] column value.
	 * 
	 * @return     string
	 */
	public function getApSenderEmail()
	{
		return $this->ap_sender_email;
	}

	/**
	 * Get the [ap_approval_key] column value.
	 * 
	 * @return     string
	 */
	public function getApApprovalKey()
	{
		return $this->ap_approval_key;
	}

	/**
	 * Get the [ap_from_date] column value.
	 * 
	 * @return     string
	 */
	public function getApFromDate()
	{
		return $this->ap_from_date;
	}

	/**
	 * Get the [ap_to_date] column value.
	 * 
	 * @return     string
	 */
	public function getApToDate()
	{
		return $this->ap_to_date;
	}

	/**
	 * Get the [ap_max_amount] column value.
	 * 
	 * @return     string
	 */
	public function getApMaxAmount()
	{
		return $this->ap_max_amount;
	}

	/**
	 * Get the [ap_date] column value.
	 * 
	 * @return     int
	 */
	public function getApDate()
	{
		return $this->ap_date;
	}

	/**
	 * Get the [ap_status] column value.
	 * 
	 * @return     int
	 */
	public function getApStatus()
	{
		return $this->ap_status;
	}

	/**
	 * Set the value of [ap_id] column.
	 * 
	 * @param      int $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ap_id !== $v) {
			$this->ap_id = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_ID;
		}

		return $this;
	} // setApId()

	/**
	 * Set the value of [ap_sender_email] column.
	 * 
	 * @param      string $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApSenderEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ap_sender_email !== $v) {
			$this->ap_sender_email = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_SENDER_EMAIL;
		}

		return $this;
	} // setApSenderEmail()

	/**
	 * Set the value of [ap_approval_key] column.
	 * 
	 * @param      string $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApApprovalKey($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ap_approval_key !== $v) {
			$this->ap_approval_key = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_APPROVAL_KEY;
		}

		return $this;
	} // setApApprovalKey()

	/**
	 * Set the value of [ap_from_date] column.
	 * 
	 * @param      string $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApFromDate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ap_from_date !== $v) {
			$this->ap_from_date = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_FROM_DATE;
		}

		return $this;
	} // setApFromDate()

	/**
	 * Set the value of [ap_to_date] column.
	 * 
	 * @param      string $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApToDate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ap_to_date !== $v) {
			$this->ap_to_date = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_TO_DATE;
		}

		return $this;
	} // setApToDate()

	/**
	 * Set the value of [ap_max_amount] column.
	 * 
	 * @param      string $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApMaxAmount($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ap_max_amount !== $v) {
			$this->ap_max_amount = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_MAX_AMOUNT;
		}

		return $this;
	} // setApMaxAmount()

	/**
	 * Set the value of [ap_date] column.
	 * 
	 * @param      int $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ap_date !== $v) {
			$this->ap_date = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_DATE;
		}

		return $this;
	} // setApDate()

	/**
	 * Set the value of [ap_status] column.
	 * 
	 * @param      int $v new value
	 * @return     AdaptivePayment The current object (for fluent API support)
	 */
	public function setApStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ap_status !== $v) {
			$this->ap_status = $v;
			$this->modifiedColumns[] = AdaptivePaymentPeer::AP_STATUS;
		}

		return $this;
	} // setApStatus()

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
			if ($this->ap_sender_email !== '') {
				return false;
			}

			if ($this->ap_approval_key !== '') {
				return false;
			}

			if ($this->ap_from_date !== '') {
				return false;
			}

			if ($this->ap_to_date !== '') {
				return false;
			}

			if ($this->ap_max_amount !== '') {
				return false;
			}

			if ($this->ap_date !== 0) {
				return false;
			}

			if ($this->ap_status !== 0) {
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

			$this->ap_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ap_sender_email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ap_approval_key = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ap_from_date = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ap_to_date = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ap_max_amount = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ap_date = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ap_status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 8; // 8 = AdaptivePaymentPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating AdaptivePayment object", $e);
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
			$con = Propel::getConnection(AdaptivePaymentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = AdaptivePaymentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(AdaptivePaymentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = AdaptivePaymentQuery::create()
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
			$con = Propel::getConnection(AdaptivePaymentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				AdaptivePaymentPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = AdaptivePaymentPeer::AP_ID;
		if (null !== $this->ap_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . AdaptivePaymentPeer::AP_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_ID)) {
			$modifiedColumns[':p' . $index++]  = '`AP_ID`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_SENDER_EMAIL)) {
			$modifiedColumns[':p' . $index++]  = '`AP_SENDER_EMAIL`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_APPROVAL_KEY)) {
			$modifiedColumns[':p' . $index++]  = '`AP_APPROVAL_KEY`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_FROM_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`AP_FROM_DATE`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_TO_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`AP_TO_DATE`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_MAX_AMOUNT)) {
			$modifiedColumns[':p' . $index++]  = '`AP_MAX_AMOUNT`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`AP_DATE`';
		}
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`AP_STATUS`';
		}

		$sql = sprintf(
			'INSERT INTO `adaptive_payment` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`AP_ID`':
						$stmt->bindValue($identifier, $this->ap_id, PDO::PARAM_INT);
						break;
					case '`AP_SENDER_EMAIL`':
						$stmt->bindValue($identifier, $this->ap_sender_email, PDO::PARAM_STR);
						break;
					case '`AP_APPROVAL_KEY`':
						$stmt->bindValue($identifier, $this->ap_approval_key, PDO::PARAM_STR);
						break;
					case '`AP_FROM_DATE`':
						$stmt->bindValue($identifier, $this->ap_from_date, PDO::PARAM_STR);
						break;
					case '`AP_TO_DATE`':
						$stmt->bindValue($identifier, $this->ap_to_date, PDO::PARAM_STR);
						break;
					case '`AP_MAX_AMOUNT`':
						$stmt->bindValue($identifier, $this->ap_max_amount, PDO::PARAM_STR);
						break;
					case '`AP_DATE`':
						$stmt->bindValue($identifier, $this->ap_date, PDO::PARAM_INT);
						break;
					case '`AP_STATUS`':
						$stmt->bindValue($identifier, $this->ap_status, PDO::PARAM_INT);
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
		$this->setApId($pk);

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


			if (($retval = AdaptivePaymentPeer::doValidate($this, $columns)) !== true) {
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
		$pos = AdaptivePaymentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getApId();
				break;
			case 1:
				return $this->getApSenderEmail();
				break;
			case 2:
				return $this->getApApprovalKey();
				break;
			case 3:
				return $this->getApFromDate();
				break;
			case 4:
				return $this->getApToDate();
				break;
			case 5:
				return $this->getApMaxAmount();
				break;
			case 6:
				return $this->getApDate();
				break;
			case 7:
				return $this->getApStatus();
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
		if (isset($alreadyDumpedObjects['AdaptivePayment'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['AdaptivePayment'][$this->getPrimaryKey()] = true;
		$keys = AdaptivePaymentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getApId(),
			$keys[1] => $this->getApSenderEmail(),
			$keys[2] => $this->getApApprovalKey(),
			$keys[3] => $this->getApFromDate(),
			$keys[4] => $this->getApToDate(),
			$keys[5] => $this->getApMaxAmount(),
			$keys[6] => $this->getApDate(),
			$keys[7] => $this->getApStatus(),
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
		$pos = AdaptivePaymentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setApId($value);
				break;
			case 1:
				$this->setApSenderEmail($value);
				break;
			case 2:
				$this->setApApprovalKey($value);
				break;
			case 3:
				$this->setApFromDate($value);
				break;
			case 4:
				$this->setApToDate($value);
				break;
			case 5:
				$this->setApMaxAmount($value);
				break;
			case 6:
				$this->setApDate($value);
				break;
			case 7:
				$this->setApStatus($value);
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
		$keys = AdaptivePaymentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setApId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setApSenderEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApApprovalKey($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setApFromDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setApToDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setApMaxAmount($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setApDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setApStatus($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(AdaptivePaymentPeer::DATABASE_NAME);

		if ($this->isColumnModified(AdaptivePaymentPeer::AP_ID)) $criteria->add(AdaptivePaymentPeer::AP_ID, $this->ap_id);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_SENDER_EMAIL)) $criteria->add(AdaptivePaymentPeer::AP_SENDER_EMAIL, $this->ap_sender_email);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_APPROVAL_KEY)) $criteria->add(AdaptivePaymentPeer::AP_APPROVAL_KEY, $this->ap_approval_key);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_FROM_DATE)) $criteria->add(AdaptivePaymentPeer::AP_FROM_DATE, $this->ap_from_date);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_TO_DATE)) $criteria->add(AdaptivePaymentPeer::AP_TO_DATE, $this->ap_to_date);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_MAX_AMOUNT)) $criteria->add(AdaptivePaymentPeer::AP_MAX_AMOUNT, $this->ap_max_amount);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_DATE)) $criteria->add(AdaptivePaymentPeer::AP_DATE, $this->ap_date);
		if ($this->isColumnModified(AdaptivePaymentPeer::AP_STATUS)) $criteria->add(AdaptivePaymentPeer::AP_STATUS, $this->ap_status);

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
		$criteria = new Criteria(AdaptivePaymentPeer::DATABASE_NAME);
		$criteria->add(AdaptivePaymentPeer::AP_ID, $this->ap_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getApId();
	}

	/**
	 * Generic method to set the primary key (ap_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setApId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getApId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of AdaptivePayment (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setApSenderEmail($this->getApSenderEmail());
		$copyObj->setApApprovalKey($this->getApApprovalKey());
		$copyObj->setApFromDate($this->getApFromDate());
		$copyObj->setApToDate($this->getApToDate());
		$copyObj->setApMaxAmount($this->getApMaxAmount());
		$copyObj->setApDate($this->getApDate());
		$copyObj->setApStatus($this->getApStatus());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setApId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     AdaptivePayment Clone of current object.
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
	 * @return     AdaptivePaymentPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new AdaptivePaymentPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->ap_id = null;
		$this->ap_sender_email = null;
		$this->ap_approval_key = null;
		$this->ap_from_date = null;
		$this->ap_to_date = null;
		$this->ap_max_amount = null;
		$this->ap_date = null;
		$this->ap_status = null;
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
		return (string) $this->exportTo(AdaptivePaymentPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseAdaptivePayment
