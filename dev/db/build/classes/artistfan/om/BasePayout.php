<?php


/**
 * Base class that represents a row from the 'payout' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePayout extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'PayoutPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PayoutPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the payment_info_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $payment_info_id;

	/**
	 * The value for the method field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $method;

	/**
	 * The value for the ptype field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $ptype;

	/**
	 * The value for the money field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $money;

	/**
	 * The value for the balance field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $balance;

	/**
	 * The value for the status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

	/**
	 * The value for the user_from field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $user_from;

	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        PaymentInfo
	 */
	protected $aPaymentInfo;

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
		$this->user_id = 0;
		$this->payment_info_id = 0;
		$this->method = 0;
		$this->ptype = 0;
		$this->money = 0;
		$this->balance = 0;
		$this->status = 0;
		$this->pdate = 0;
		$this->user_from = 0;
	}

	/**
	 * Initializes internal state of BasePayout object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [user_id] column value.
	 * 
	 * @return     int
	 */
	public function getUserId()
	{
		return $this->user_id;
	}

	/**
	 * Get the [payment_info_id] column value.
	 * 
	 * @return     int
	 */
	public function getPaymentInfoId()
	{
		return $this->payment_info_id;
	}

	/**
	 * Get the [method] column value.
	 * 
	 * @return     int
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Get the [ptype] column value.
	 * 
	 * @return     int
	 */
	public function getPtype()
	{
		return $this->ptype;
	}

	/**
	 * Get the [money] column value.
	 * 
	 * @return     double
	 */
	public function getMoney()
	{
		return $this->money;
	}

	/**
	 * Get the [balance] column value.
	 * 
	 * @return     double
	 */
	public function getBalance()
	{
		return $this->balance;
	}

	/**
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [pdate] column value.
	 * 
	 * @return     int
	 */
	public function getPdate()
	{
		return $this->pdate;
	}

	/**
	 * Get the [user_from] column value.
	 * 
	 * @return     int
	 */
	public function getUserFrom()
	{
		return $this->user_from;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PayoutPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = PayoutPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [payment_info_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setPaymentInfoId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->payment_info_id !== $v) {
			$this->payment_info_id = $v;
			$this->modifiedColumns[] = PayoutPeer::PAYMENT_INFO_ID;
		}

		if ($this->aPaymentInfo !== null && $this->aPaymentInfo->getId() !== $v) {
			$this->aPaymentInfo = null;
		}

		return $this;
	} // setPaymentInfoId()

	/**
	 * Set the value of [method] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setMethod($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->method !== $v) {
			$this->method = $v;
			$this->modifiedColumns[] = PayoutPeer::METHOD;
		}

		return $this;
	} // setMethod()

	/**
	 * Set the value of [ptype] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setPtype($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ptype !== $v) {
			$this->ptype = $v;
			$this->modifiedColumns[] = PayoutPeer::PTYPE;
		}

		return $this;
	} // setPtype()

	/**
	 * Set the value of [money] column.
	 * 
	 * @param      double $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setMoney($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->money !== $v) {
			$this->money = $v;
			$this->modifiedColumns[] = PayoutPeer::MONEY;
		}

		return $this;
	} // setMoney()

	/**
	 * Set the value of [balance] column.
	 * 
	 * @param      double $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setBalance($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->balance !== $v) {
			$this->balance = $v;
			$this->modifiedColumns[] = PayoutPeer::BALANCE;
		}

		return $this;
	} // setBalance()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = PayoutPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = PayoutPeer::PDATE;
		}

		return $this;
	} // setPdate()

	/**
	 * Set the value of [user_from] column.
	 * 
	 * @param      int $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setUserFrom($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_from !== $v) {
			$this->user_from = $v;
			$this->modifiedColumns[] = PayoutPeer::USER_FROM;
		}

		return $this;
	} // setUserFrom()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     Payout The current object (for fluent API support)
	 */
	public function setDescription($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = PayoutPeer::DESCRIPTION;
		}

		return $this;
	} // setDescription()

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
			if ($this->user_id !== 0) {
				return false;
			}

			if ($this->payment_info_id !== 0) {
				return false;
			}

			if ($this->method !== 0) {
				return false;
			}

			if ($this->ptype !== 0) {
				return false;
			}

			if ($this->money !== 0) {
				return false;
			}

			if ($this->balance !== 0) {
				return false;
			}

			if ($this->status !== 0) {
				return false;
			}

			if ($this->pdate !== 0) {
				return false;
			}

			if ($this->user_from !== 0) {
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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->payment_info_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->method = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ptype = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->money = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
			$this->balance = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
			$this->status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->pdate = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->user_from = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->description = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = PayoutPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Payout object", $e);
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

		if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
			$this->aUser = null;
		}
		if ($this->aPaymentInfo !== null && $this->payment_info_id !== $this->aPaymentInfo->getId()) {
			$this->aPaymentInfo = null;
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
			$con = Propel::getConnection(PayoutPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PayoutPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->aPaymentInfo = null;
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
			$con = Propel::getConnection(PayoutPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = PayoutQuery::create()
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
			$con = Propel::getConnection(PayoutPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				PayoutPeer::addInstanceToPool($this);
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

			if ($this->aUser !== null) {
				if ($this->aUser->isModified() || $this->aUser->isNew()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}

			if ($this->aPaymentInfo !== null) {
				if ($this->aPaymentInfo->isModified() || $this->aPaymentInfo->isNew()) {
					$affectedRows += $this->aPaymentInfo->save($con);
				}
				$this->setPaymentInfo($this->aPaymentInfo);
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

		$this->modifiedColumns[] = PayoutPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . PayoutPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(PayoutPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(PayoutPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(PayoutPeer::PAYMENT_INFO_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PAYMENT_INFO_ID`';
		}
		if ($this->isColumnModified(PayoutPeer::METHOD)) {
			$modifiedColumns[':p' . $index++]  = '`METHOD`';
		}
		if ($this->isColumnModified(PayoutPeer::PTYPE)) {
			$modifiedColumns[':p' . $index++]  = '`PTYPE`';
		}
		if ($this->isColumnModified(PayoutPeer::MONEY)) {
			$modifiedColumns[':p' . $index++]  = '`MONEY`';
		}
		if ($this->isColumnModified(PayoutPeer::BALANCE)) {
			$modifiedColumns[':p' . $index++]  = '`BALANCE`';
		}
		if ($this->isColumnModified(PayoutPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(PayoutPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(PayoutPeer::USER_FROM)) {
			$modifiedColumns[':p' . $index++]  = '`USER_FROM`';
		}
		if ($this->isColumnModified(PayoutPeer::DESCRIPTION)) {
			$modifiedColumns[':p' . $index++]  = '`DESCRIPTION`';
		}

		$sql = sprintf(
			'INSERT INTO `payout` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`USER_ID`':
						$stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
						break;
					case '`PAYMENT_INFO_ID`':
						$stmt->bindValue($identifier, $this->payment_info_id, PDO::PARAM_INT);
						break;
					case '`METHOD`':
						$stmt->bindValue($identifier, $this->method, PDO::PARAM_INT);
						break;
					case '`PTYPE`':
						$stmt->bindValue($identifier, $this->ptype, PDO::PARAM_INT);
						break;
					case '`MONEY`':
						$stmt->bindValue($identifier, $this->money, PDO::PARAM_STR);
						break;
					case '`BALANCE`':
						$stmt->bindValue($identifier, $this->balance, PDO::PARAM_STR);
						break;
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
						break;
					case '`USER_FROM`':
						$stmt->bindValue($identifier, $this->user_from, PDO::PARAM_INT);
						break;
					case '`DESCRIPTION`':
						$stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
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
		$this->setId($pk);

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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}

			if ($this->aPaymentInfo !== null) {
				if (!$this->aPaymentInfo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPaymentInfo->getValidationFailures());
				}
			}


			if (($retval = PayoutPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PayoutPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getId();
				break;
			case 1:
				return $this->getUserId();
				break;
			case 2:
				return $this->getPaymentInfoId();
				break;
			case 3:
				return $this->getMethod();
				break;
			case 4:
				return $this->getPtype();
				break;
			case 5:
				return $this->getMoney();
				break;
			case 6:
				return $this->getBalance();
				break;
			case 7:
				return $this->getStatus();
				break;
			case 8:
				return $this->getPdate();
				break;
			case 9:
				return $this->getUserFrom();
				break;
			case 10:
				return $this->getDescription();
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
		if (isset($alreadyDumpedObjects['Payout'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Payout'][$this->getPrimaryKey()] = true;
		$keys = PayoutPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getPaymentInfoId(),
			$keys[3] => $this->getMethod(),
			$keys[4] => $this->getPtype(),
			$keys[5] => $this->getMoney(),
			$keys[6] => $this->getBalance(),
			$keys[7] => $this->getStatus(),
			$keys[8] => $this->getPdate(),
			$keys[9] => $this->getUserFrom(),
			$keys[10] => $this->getDescription(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aPaymentInfo) {
				$result['PaymentInfo'] = $this->aPaymentInfo->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = PayoutPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setId($value);
				break;
			case 1:
				$this->setUserId($value);
				break;
			case 2:
				$this->setPaymentInfoId($value);
				break;
			case 3:
				$this->setMethod($value);
				break;
			case 4:
				$this->setPtype($value);
				break;
			case 5:
				$this->setMoney($value);
				break;
			case 6:
				$this->setBalance($value);
				break;
			case 7:
				$this->setStatus($value);
				break;
			case 8:
				$this->setPdate($value);
				break;
			case 9:
				$this->setUserFrom($value);
				break;
			case 10:
				$this->setDescription($value);
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
		$keys = PayoutPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPaymentInfoId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMethod($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPtype($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMoney($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBalance($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPdate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUserFrom($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDescription($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PayoutPeer::DATABASE_NAME);

		if ($this->isColumnModified(PayoutPeer::ID)) $criteria->add(PayoutPeer::ID, $this->id);
		if ($this->isColumnModified(PayoutPeer::USER_ID)) $criteria->add(PayoutPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(PayoutPeer::PAYMENT_INFO_ID)) $criteria->add(PayoutPeer::PAYMENT_INFO_ID, $this->payment_info_id);
		if ($this->isColumnModified(PayoutPeer::METHOD)) $criteria->add(PayoutPeer::METHOD, $this->method);
		if ($this->isColumnModified(PayoutPeer::PTYPE)) $criteria->add(PayoutPeer::PTYPE, $this->ptype);
		if ($this->isColumnModified(PayoutPeer::MONEY)) $criteria->add(PayoutPeer::MONEY, $this->money);
		if ($this->isColumnModified(PayoutPeer::BALANCE)) $criteria->add(PayoutPeer::BALANCE, $this->balance);
		if ($this->isColumnModified(PayoutPeer::STATUS)) $criteria->add(PayoutPeer::STATUS, $this->status);
		if ($this->isColumnModified(PayoutPeer::PDATE)) $criteria->add(PayoutPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(PayoutPeer::USER_FROM)) $criteria->add(PayoutPeer::USER_FROM, $this->user_from);
		if ($this->isColumnModified(PayoutPeer::DESCRIPTION)) $criteria->add(PayoutPeer::DESCRIPTION, $this->description);

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
		$criteria = new Criteria(PayoutPeer::DATABASE_NAME);
		$criteria->add(PayoutPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Payout (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setPaymentInfoId($this->getPaymentInfoId());
		$copyObj->setMethod($this->getMethod());
		$copyObj->setPtype($this->getPtype());
		$copyObj->setMoney($this->getMoney());
		$copyObj->setBalance($this->getBalance());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setUserFrom($this->getUserFrom());
		$copyObj->setDescription($this->getDescription());

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
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Payout Clone of current object.
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
	 * @return     PayoutPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PayoutPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Payout The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setUserId(0);
		} else {
			$this->setUserId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addPayout($this);
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
	public function getUser(PropelPDO $con = null)
	{
		if ($this->aUser === null && ($this->user_id !== null)) {
			$this->aUser = UserQuery::create()->findPk($this->user_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aUser->addPayouts($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a PaymentInfo object.
	 *
	 * @param      PaymentInfo $v
	 * @return     Payout The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPaymentInfo(PaymentInfo $v = null)
	{
		if ($v === null) {
			$this->setPaymentInfoId(0);
		} else {
			$this->setPaymentInfoId($v->getId());
		}

		$this->aPaymentInfo = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the PaymentInfo object, it will not be re-added.
		if ($v !== null) {
			$v->addPayout($this);
		}

		return $this;
	}


	/**
	 * Get the associated PaymentInfo object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     PaymentInfo The associated PaymentInfo object.
	 * @throws     PropelException
	 */
	public function getPaymentInfo(PropelPDO $con = null)
	{
		if ($this->aPaymentInfo === null && ($this->payment_info_id !== null)) {
			$this->aPaymentInfo = PaymentInfoQuery::create()->findPk($this->payment_info_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aPaymentInfo->addPayouts($this);
			 */
		}
		return $this->aPaymentInfo;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->payment_info_id = null;
		$this->method = null;
		$this->ptype = null;
		$this->money = null;
		$this->balance = null;
		$this->status = null;
		$this->pdate = null;
		$this->user_from = null;
		$this->description = null;
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

		$this->aUser = null;
		$this->aPaymentInfo = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(PayoutPeer::DEFAULT_STRING_FORMAT);
	}

} // BasePayout
