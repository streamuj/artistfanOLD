<?php


/**
 * Base class that represents a row from the 'payment_info' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePaymentInfo extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'PaymentInfoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PaymentInfoPeer
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
	 * The value for the routing_code field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $routing_code;

	/**
	 * The value for the account_number field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $account_number;

	/**
	 * The value for the holder_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $holder_name;

	/**
	 * The value for the account_type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $account_type;

	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

/**
	 * The value for the mail_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_name;

	/**
	 * The value for the mail_add1 field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_add1;

	/**
	 * The value for the mail_add2 field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_add2;

	/**
	 * The value for the mail_city field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_city;

	/**
	 * The value for the mail_state field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_state;

	/**
	 * The value for the mail_zip field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $mail_zip;

	/**
	 * The value for the paypal_id field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $paypal_id;

	/**
	 * The value for the paypal_approval_key field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $paypal_approval_key;

	/**
	 * The value for the paypal_info field.
	 * @var        string
	 */
	protected $paypal_info;
	


	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        array Payout[] Collection to store aggregation of Payout objects.
	 */
	protected $collPayouts;

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
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $payoutsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->user_id = 0;
		$this->routing_code = '';
		$this->account_number = '';
		$this->holder_name = '';
		$this->account_type = 0;
		$this->pdate = 0;
		$this->mail_name = '';
		$this->mail_add1 = '';
		$this->mail_add2 = '';
		$this->mail_city = '';
		$this->mail_state = '';
		$this->mail_zip = '';
		$this->paypal_id = '';		
		$this->paypal_approval_key = '';		
	}

	/**
	 * Initializes internal state of BasePaymentInfo object.
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
	 * Get the [routing_code] column value.
	 * 
	 * @return     string
	 */
	public function getRoutingCode()
	{
		return $this->routing_code;
	}

	/**
	 * Get the [account_number] column value.
	 * 
	 * @return     string
	 */
	public function getAccountNumber()
	{
		return $this->account_number;
	}

	/**
	 * Get the [holder_name] column value.
	 * 
	 * @return     string
	 */
	public function getHolderName()
	{
		return $this->holder_name;
	}

	/**
	 * Get the [account_type] column value.
	 * 
	 * @return     int
	 */
	public function getAccountType()
	{
		return $this->account_type;
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
	 * Set the value of [mail_name] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_name !== $v) {
			$this->mail_name = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_NAME;
		}

		return $this;
	} // setMailName()

	/**
	 * Set the value of [mail_add1] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailAdd1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_add1 !== $v) {
			$this->mail_add1 = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_ADD1;
		}

		return $this;
	} // setMailAdd1()

	/**
	 * Set the value of [mail_add2] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailAdd2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_add2 !== $v) {
			$this->mail_add2 = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_ADD2;
		}

		return $this;
	} // setMailAdd2()

	/**
	 * Set the value of [mail_city] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_city !== $v) {
			$this->mail_city = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_CITY;
		}

		return $this;
	} // setMailCity()

	/**
	 * Set the value of [mail_state] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_state !== $v) {
			$this->mail_state = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_STATE;
		}

		return $this;
	} // setMailState()

	/**
	 * Set the value of [mail_zip] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setMailZip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mail_zip !== $v) {
			$this->mail_zip = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::MAIL_ZIP;
		}

		return $this;
	} // setMailZip()

	/**
	 * Set the value of [paypal_id] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setPaypalId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->paypal_id !== $v) {
			$this->paypal_id = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::PAYPAL_ID;
		}

		return $this;
	} // setPaypalId()


	/**
	 * Get the [paypal_approval_key] column value.
	 * 
	 * @return     string
	 */
	public function getPaypalApprovalKey()
	{
		return $this->paypal_approval_key;
	}

	/**
	 * Get the [paypal_info] column value.
	 * 
	 * @return     string
	 */
	public function getPaypalInfo()
	{
		return $this->paypal_info;
	}




	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [routing_code] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setRoutingCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->routing_code !== $v) {
			$this->routing_code = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::ROUTING_CODE;
		}

		return $this;
	} // setRoutingCode()

	/**
	 * Set the value of [account_number] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setAccountNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->account_number !== $v) {
			$this->account_number = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::ACCOUNT_NUMBER;
		}

		return $this;
	} // setAccountNumber()

	/**
	 * Set the value of [holder_name] column.
	 * 
	 * @param      string $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setHolderName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->holder_name !== $v) {
			$this->holder_name = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::HOLDER_NAME;
		}

		return $this;
	} // setHolderName()

	/**
	 * Set the value of [account_type] column.
	 * 
	 * @param      int $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setAccountType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->account_type !== $v) {
			$this->account_type = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::ACCOUNT_TYPE;
		}

		return $this;
	} // setAccountType()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = PaymentInfoPeer::PDATE;
		}

		return $this;
	} // setPdate()

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

			if ($this->routing_code !== '') {
				return false;
			}

			if ($this->account_number !== '') {
				return false;
			}

			if ($this->holder_name !== '') {
				return false;
			}

			if ($this->account_type !== 0) {
				return false;
			}

			if ($this->pdate !== 0) {
				return false;				
			}

			if ($this->mail_name !== '') {
				return false;
			}

			if ($this->mail_add1 !== '') {
				return false;
			}

			if ($this->mail_add2 !== '') {
				return false;
			}

			if ($this->mail_city !== '') {
				return false;
			}

			if ($this->mail_state !== '') {
				return false;
			}

			if ($this->mail_zip !== '') {
				return false;
			}

			if ($this->paypal_id !== '') {
				return false;
			}			


			if ($this->paypal_approval_key !== '') {
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
			$this->routing_code = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->account_number = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->holder_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->account_type = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->pdate = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->mail_name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->mail_add1 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->mail_add2 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->mail_city = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->mail_state = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->mail_zip = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->paypal_id = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->paypal_approval_key = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->paypal_info = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;			
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 7; // 7 = PaymentInfoPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating PaymentInfo object", $e);
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
			$con = Propel::getConnection(PaymentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PaymentInfoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->collPayouts = null;

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
			$con = Propel::getConnection(PaymentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = PaymentInfoQuery::create()
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
			$con = Propel::getConnection(PaymentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				PaymentInfoPeer::addInstanceToPool($this);
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

			if ($this->payoutsScheduledForDeletion !== null) {
				if (!$this->payoutsScheduledForDeletion->isEmpty()) {
					PayoutQuery::create()
						->filterByPrimaryKeys($this->payoutsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->payoutsScheduledForDeletion = null;
				}
			}

			if ($this->collPayouts !== null) {
				foreach ($this->collPayouts as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

		$this->modifiedColumns[] = PaymentInfoPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . PaymentInfoPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(PaymentInfoPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::ROUTING_CODE)) {
			$modifiedColumns[':p' . $index++]  = '`ROUTING_CODE`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::ACCOUNT_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`ACCOUNT_NUMBER`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::HOLDER_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`HOLDER_NAME`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::ACCOUNT_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`ACCOUNT_TYPE`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_NAME`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ADD1)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_ADD1`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ADD2)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_ADD2`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_CITY)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_CITY`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_STATE)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_STATE`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ZIP)) {
			$modifiedColumns[':p' . $index++]  = '`MAIL_ZIP`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PAYPAL_ID`';
		}		
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_APPROVAL_KEY)) {
			$modifiedColumns[':p' . $index++]  = '`PAYPAL_APPROVAL_KEY`';
		}
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_INFO)) {
			$modifiedColumns[':p' . $index++]  = '`PAYPAL_INFO`';
		}
		

		$sql = sprintf(
			'INSERT INTO `payment_info` (%s) VALUES (%s)',
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
					case '`ROUTING_CODE`':
						$stmt->bindValue($identifier, $this->routing_code, PDO::PARAM_STR);
						break;
					case '`ACCOUNT_NUMBER`':
						$stmt->bindValue($identifier, $this->account_number, PDO::PARAM_STR);
						break;
					case '`HOLDER_NAME`':
						$stmt->bindValue($identifier, $this->holder_name, PDO::PARAM_STR);
						break;
					case '`ACCOUNT_TYPE`':
						$stmt->bindValue($identifier, $this->account_type, PDO::PARAM_INT);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
						break;
					case '`MAIL_NAME`':
						$stmt->bindValue($identifier, $this->mail_name, PDO::PARAM_STR);
						break;
					case '`MAIL_ADD1`':
						$stmt->bindValue($identifier, $this->mail_add1, PDO::PARAM_STR);
						break;
					case '`MAIL_ADD2`':
						$stmt->bindValue($identifier, $this->mail_add2, PDO::PARAM_STR);
						break;
					case '`MAIL_CITY`':
						$stmt->bindValue($identifier, $this->mail_city, PDO::PARAM_STR);
						break;
					case '`MAIL_STATE`':
						$stmt->bindValue($identifier, $this->mail_state, PDO::PARAM_STR);
						break;
					case '`MAIL_ZIP`':
						$stmt->bindValue($identifier, $this->mail_zip, PDO::PARAM_STR);
						break;
					case '`PAYPAL_ID`':
						$stmt->bindValue($identifier, $this->paypal_id, PDO::PARAM_STR);
						break;						
					case '`PAYPAL_APPROVAL_KEY`':
						$stmt->bindValue($identifier, $this->paypal_approval_key, PDO::PARAM_STR);
						break;
					case '`PAYPAL_INFO`':
						$stmt->bindValue($identifier, $this->paypal_info, PDO::PARAM_STR);
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


			if (($retval = PaymentInfoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPayouts !== null) {
					foreach ($this->collPayouts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
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
		$pos = PaymentInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRoutingCode();
				break;
			case 3:
				return $this->getAccountNumber();
				break;
			case 4:
				return $this->getHolderName();
				break;
			case 5:
				return $this->getAccountType();
				break;
			case 6:
				return $this->getPdate();
				break;
			case 7:
				return $this->getMailName();
				break;
			case 8:
				return $this->getMailAdd1();
				break;
			case 9:
				return $this->getMailAdd2();
				break;
			case 10:
				return $this->getMailCity();
				break;
			case 11:
				return $this->getMailState();
				break;
			case 12:
				return $this->getMailZip();
				break;
			case 13:
				return $this->getPaypalId();
				break;
			case 14:
				return $this->getPaypalApprovalKey();
				break;
			case 15:
				return $this->getPaypalInfo();
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
		if (isset($alreadyDumpedObjects['PaymentInfo'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['PaymentInfo'][$this->getPrimaryKey()] = true;
		$keys = PaymentInfoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getRoutingCode(),
			$keys[3] => $this->getAccountNumber(),
			$keys[4] => $this->getHolderName(),
			$keys[5] => $this->getAccountType(),
			$keys[6] => $this->getPdate(),
			$keys[7] => $this->getMailName(),
			$keys[8] => $this->getMailAdd1(),
			$keys[9] => $this->getMailAdd2(),
			$keys[10] => $this->getMailCity(),
			$keys[11] => $this->getMailState(),
			$keys[12] => $this->getMailZip(),
			$keys[13] => $this->getPaypalId(),			
			$keys[14] => $this->getPaypalApprovalKey(),
			$keys[15] => $this->getPaypalInfo(),
			
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collPayouts) {
				$result['Payouts'] = $this->collPayouts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = PaymentInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRoutingCode($value);
				break;
			case 3:
				$this->setAccountNumber($value);
				break;
			case 4:
				$this->setHolderName($value);
				break;
			case 5:
				$this->setAccountType($value);
				break;
			case 6:
				$this->setPdate($value);
				break;
			case 7:
				$this->setMailName($value);
				break;
			case 8:
				$this->setMailAdd1($value);
				break;
			case 9:
				$this->setMailAdd2($value);
				break;
			case 10:
				$this->setMailCity($value);
				break;
			case 11:
				$this->setMailState($value);
				break;
			case 12:
				$this->setMailZip($value);
				break;
			case 13:
				$this->setPaypalId($value);
				break;
			case 14:
				$this->setPaypalApprovalKey($value);
				break;
			case 15:
				$this->setPaypalInfo($value);
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
		$keys = PaymentInfoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRoutingCode($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAccountNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHolderName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAccountType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPdate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMailName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMailAdd1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMailAdd2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setMailCity($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setMailState($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setMailZip($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPaypalId($arr[$keys[13]]);		
		if (array_key_exists($keys[14], $arr)) $this->setPaypalApprovalKey($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPaypalInfo($arr[$keys[15]]);
		
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PaymentInfoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PaymentInfoPeer::ID)) $criteria->add(PaymentInfoPeer::ID, $this->id);
		if ($this->isColumnModified(PaymentInfoPeer::USER_ID)) $criteria->add(PaymentInfoPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(PaymentInfoPeer::ROUTING_CODE)) $criteria->add(PaymentInfoPeer::ROUTING_CODE, $this->routing_code);
		if ($this->isColumnModified(PaymentInfoPeer::ACCOUNT_NUMBER)) $criteria->add(PaymentInfoPeer::ACCOUNT_NUMBER, $this->account_number);
		if ($this->isColumnModified(PaymentInfoPeer::HOLDER_NAME)) $criteria->add(PaymentInfoPeer::HOLDER_NAME, $this->holder_name);
		if ($this->isColumnModified(PaymentInfoPeer::ACCOUNT_TYPE)) $criteria->add(PaymentInfoPeer::ACCOUNT_TYPE, $this->account_type);
		if ($this->isColumnModified(PaymentInfoPeer::PDATE)) $criteria->add(PaymentInfoPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_NAME)) $criteria->add(PaymentInfoPeer::MAIL_NAME, $this->mail_name);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ADD1)) $criteria->add(PaymentInfoPeer::MAIL_ADD1, $this->mail_add1);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ADD2)) $criteria->add(PaymentInfoPeer::MAIL_ADD2, $this->mail_add2);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_CITY)) $criteria->add(PaymentInfoPeer::MAIL_CITY, $this->mail_city);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_STATE)) $criteria->add(PaymentInfoPeer::MAIL_STATE, $this->mail_state);
		if ($this->isColumnModified(PaymentInfoPeer::MAIL_ZIP)) $criteria->add(PaymentInfoPeer::MAIL_ZIP, $this->mail_zip);
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_ID)) $criteria->add(PaymentInfoPeer::PAYPAL_ID, $this->paypal_id);		
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_APPROVAL_KEY)) $criteria->add(PaymentInfoPeer::PAYPAL_APPROVAL_KEY, $this->paypal_approval_key);
		if ($this->isColumnModified(PaymentInfoPeer::PAYPAL_INFO)) $criteria->add(PaymentInfoPeer::PAYPAL_INFO, $this->paypal_info);

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
		$criteria = new Criteria(PaymentInfoPeer::DATABASE_NAME);
		$criteria->add(PaymentInfoPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of PaymentInfo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setRoutingCode($this->getRoutingCode());
		$copyObj->setAccountNumber($this->getAccountNumber());
		$copyObj->setHolderName($this->getHolderName());
		$copyObj->setAccountType($this->getAccountType());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setMailName($this->getMailName());
		$copyObj->setMailAdd1($this->getMailAdd1());
		$copyObj->setMailAdd2($this->getMailAdd2());
		$copyObj->setMailCity($this->getMailCity());
		$copyObj->setMailState($this->getMailState());
		$copyObj->setMailZip($this->getMailZip());
		$copyObj->setPaypalId($this->getPaypalId());		
		$copyObj->setPaypalApprovalKey($this->getPaypalApprovalKey());
		$copyObj->setPaypalInfo($this->getPaypalInfo());
		

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getPayouts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPayout($relObj->copy($deepCopy));
				}
			}

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
	 * @return     PaymentInfo Clone of current object.
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
	 * @return     PaymentInfoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PaymentInfoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     PaymentInfo The current object (for fluent API support)
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
			$v->addPaymentInfo($this);
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
				$this->aUser->addPaymentInfos($this);
			 */
		}
		return $this->aUser;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('Payout' == $relationName) {
			return $this->initPayouts();
		}
	}

	/**
	 * Clears out the collPayouts collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPayouts()
	 */
	public function clearPayouts()
	{
		$this->collPayouts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPayouts collection.
	 *
	 * By default this just sets the collPayouts collection to an empty array (like clearcollPayouts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPayouts($overrideExisting = true)
	{
		if (null !== $this->collPayouts && !$overrideExisting) {
			return;
		}
		$this->collPayouts = new PropelObjectCollection();
		$this->collPayouts->setModel('Payout');
	}

	/**
	 * Gets an array of Payout objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this PaymentInfo is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Payout[] List of Payout objects
	 * @throws     PropelException
	 */
	public function getPayouts($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPayouts || null !== $criteria) {
			if ($this->isNew() && null === $this->collPayouts) {
				// return empty collection
				$this->initPayouts();
			} else {
				$collPayouts = PayoutQuery::create(null, $criteria)
					->filterByPaymentInfo($this)
					->find($con);
				if (null !== $criteria) {
					return $collPayouts;
				}
				$this->collPayouts = $collPayouts;
			}
		}
		return $this->collPayouts;
	}

	/**
	 * Sets a collection of Payout objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $payouts A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPayouts(PropelCollection $payouts, PropelPDO $con = null)
	{
		$this->payoutsScheduledForDeletion = $this->getPayouts(new Criteria(), $con)->diff($payouts);

		foreach ($payouts as $payout) {
			// Fix issue with collection modified by reference
			if ($payout->isNew()) {
				$payout->setPaymentInfo($this);
			}
			$this->addPayout($payout);
		}

		$this->collPayouts = $payouts;
	}

	/**
	 * Returns the number of related Payout objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Payout objects.
	 * @throws     PropelException
	 */
	public function countPayouts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPayouts || null !== $criteria) {
			if ($this->isNew() && null === $this->collPayouts) {
				return 0;
			} else {
				$query = PayoutQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByPaymentInfo($this)
					->count($con);
			}
		} else {
			return count($this->collPayouts);
		}
	}

	/**
	 * Method called to associate a Payout object to this object
	 * through the Payout foreign key attribute.
	 *
	 * @param      Payout $l Payout
	 * @return     PaymentInfo The current object (for fluent API support)
	 */
	public function addPayout(Payout $l)
	{
		if ($this->collPayouts === null) {
			$this->initPayouts();
		}
		if (!$this->collPayouts->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPayout($l);
		}

		return $this;
	}

	/**
	 * @param	Payout $payout The payout object to add.
	 */
	protected function doAddPayout($payout)
	{
		$this->collPayouts[]= $payout;
		$payout->setPaymentInfo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PaymentInfo is new, it will return
	 * an empty collection; or if this PaymentInfo has previously
	 * been saved, it will retrieve related Payouts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in PaymentInfo.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Payout[] List of Payout objects
	 */
	public function getPayoutsJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PayoutQuery::create(null, $criteria);
		$query->joinWith('User', $join_behavior);

		return $this->getPayouts($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->routing_code = null;
		$this->account_number = null;
		$this->holder_name = null;
		$this->account_type = null;
		$this->pdate = null;
		$this->mail_name = null;
		$this->mail_add1 = null;
		$this->mail_add2 = null;
		$this->mail_city = null;
		$this->mail_state = null;
		$this->mail_zip = null;
		$this->paypal_id = null;		
		$this->paypal_approval_key = null;
		$this->paypal_info = null;		
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
			if ($this->collPayouts) {
				foreach ($this->collPayouts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collPayouts instanceof PropelCollection) {
			$this->collPayouts->clearIterator();
		}
		$this->collPayouts = null;
		$this->aUser = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(PaymentInfoPeer::DEFAULT_STRING_FORMAT);
	}

} // BasePaymentInfo
