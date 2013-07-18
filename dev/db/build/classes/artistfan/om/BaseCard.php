<?php


/**
 * Base class that represents a row from the 'card' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseCard extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CardPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CardPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the card_id field.
	 * @var        int
	 */
	protected $card_id;

	/**
	 * The value for the card_user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $card_user_id;

	/**
	 * The value for the card_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_name;

	/**
	 * The value for the card_number field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_number;

	/**
	 * The value for the card_type field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_type;

	/**
	 * The value for the card_expiry field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_expiry;

	/**
	 * The value for the card_cvv field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_cvv;

	/**
	 * The value for the card_bill_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_bill_name;

	/**
	 * The value for the card_address field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_address;

	/**
	 * The value for the card_city field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_city;

	/**
	 * The value for the card_state field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_state;

	/**
	 * The value for the card_country field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_country;

	/**
	 * The value for the card_zip field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_zip;

	/**
	 * The value for the card_phone field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $card_phone;

	/**
	 * @var        User
	 */
	protected $aUser;

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
		$this->card_user_id = 0;
		$this->card_name = '';
		$this->card_number = '';
		$this->card_type = '';
		$this->card_expiry = '';
		$this->card_cvv = '';
		$this->card_bill_name = '';
		$this->card_address = '';
		$this->card_city = '';
		$this->card_state = '';
		$this->card_country = '';
		$this->card_zip = '';
		$this->card_phone = '';
	}

	/**
	 * Initializes internal state of BaseCard object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [card_id] column value.
	 * 
	 * @return     int
	 */
	public function getCardId()
	{
		return $this->card_id;
	}

	/**
	 * Get the [card_user_id] column value.
	 * 
	 * @return     int
	 */
	public function getCardUserId()
	{
		return $this->card_user_id;
	}

	/**
	 * Get the [card_name] column value.
	 * 
	 * @return     string
	 */
	public function getCardName()
	{
		return $this->card_name;
	}

	/**
	 * Get the [card_number] column value.
	 * 
	 * @return     string
	 */
	public function getCardNumber()
	{
		return $this->card_number;
	}

	/**
	 * Get the [card_type] column value.
	 * 
	 * @return     string
	 */
	public function getCardType()
	{
		return $this->card_type;
	}

	/**
	 * Get the [card_expiry] column value.
	 * 
	 * @return     string
	 */
	public function getCardExpiry()
	{
		return $this->card_expiry;
	}

	/**
	 * Get the [card_cvv] column value.
	 * 
	 * @return     string
	 */
	public function getCardCvv()
	{
		return $this->card_cvv;
	}

	/**
	 * Get the [card_bill_name] column value.
	 * 
	 * @return     string
	 */
	public function getCardBillName()
	{
		return $this->card_bill_name;
	}

	/**
	 * Get the [card_address] column value.
	 * 
	 * @return     string
	 */
	public function getCardAddress()
	{
		return $this->card_address;
	}

	/**
	 * Get the [card_city] column value.
	 * 
	 * @return     string
	 */
	public function getCardCity()
	{
		return $this->card_city;
	}

	/**
	 * Get the [card_state] column value.
	 * 
	 * @return     string
	 */
	public function getCardState()
	{
		return $this->card_state;
	}

	/**
	 * Get the [card_country] column value.
	 * 
	 * @return     string
	 */
	public function getCardCountry()
	{
		return $this->card_country;
	}

	/**
	 * Get the [card_zip] column value.
	 * 
	 * @return     string
	 */
	public function getCardZip()
	{
		return $this->card_zip;
	}

	/**
	 * Get the [card_phone] column value.
	 * 
	 * @return     string
	 */
	public function getCardPhone()
	{
		return $this->card_phone;
	}

	/**
	 * Set the value of [card_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->card_id !== $v) {
			$this->card_id = $v;
			$this->modifiedColumns[] = CardPeer::CARD_ID;
		}

		return $this;
	} // setCardId()

	/**
	 * Set the value of [card_user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->card_user_id !== $v) {
			$this->card_user_id = $v;
			$this->modifiedColumns[] = CardPeer::CARD_USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setCardUserId()

	/**
	 * Set the value of [card_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_name !== $v) {
			$this->card_name = $v;
			$this->modifiedColumns[] = CardPeer::CARD_NAME;
		}

		return $this;
	} // setCardName()

	/**
	 * Set the value of [card_number] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_number !== $v) {
			$this->card_number = $v;
			$this->modifiedColumns[] = CardPeer::CARD_NUMBER;
		}

		return $this;
	} // setCardNumber()

	/**
	 * Set the value of [card_type] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_type !== $v) {
			$this->card_type = $v;
			$this->modifiedColumns[] = CardPeer::CARD_TYPE;
		}

		return $this;
	} // setCardType()

	/**
	 * Set the value of [card_expiry] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardExpiry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_expiry !== $v) {
			$this->card_expiry = $v;
			$this->modifiedColumns[] = CardPeer::CARD_EXPIRY;
		}

		return $this;
	} // setCardExpiry()

	/**
	 * Set the value of [card_cvv] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardCvv($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_cvv !== $v) {
			$this->card_cvv = $v;
			$this->modifiedColumns[] = CardPeer::CARD_CVV;
		}

		return $this;
	} // setCardCvv()

	/**
	 * Set the value of [card_bill_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardBillName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_bill_name !== $v) {
			$this->card_bill_name = $v;
			$this->modifiedColumns[] = CardPeer::CARD_BILL_NAME;
		}

		return $this;
	} // setCardBillName()

	/**
	 * Set the value of [card_address] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardAddress($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_address !== $v) {
			$this->card_address = $v;
			$this->modifiedColumns[] = CardPeer::CARD_ADDRESS;
		}

		return $this;
	} // setCardAddress()

	/**
	 * Set the value of [card_city] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_city !== $v) {
			$this->card_city = $v;
			$this->modifiedColumns[] = CardPeer::CARD_CITY;
		}

		return $this;
	} // setCardCity()

	/**
	 * Set the value of [card_state] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_state !== $v) {
			$this->card_state = $v;
			$this->modifiedColumns[] = CardPeer::CARD_STATE;
		}

		return $this;
	} // setCardState()

	/**
	 * Set the value of [card_country] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_country !== $v) {
			$this->card_country = $v;
			$this->modifiedColumns[] = CardPeer::CARD_COUNTRY;
		}

		return $this;
	} // setCardCountry()

	/**
	 * Set the value of [card_zip] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardZip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_zip !== $v) {
			$this->card_zip = $v;
			$this->modifiedColumns[] = CardPeer::CARD_ZIP;
		}

		return $this;
	} // setCardZip()

	/**
	 * Set the value of [card_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     Card The current object (for fluent API support)
	 */
	public function setCardPhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->card_phone !== $v) {
			$this->card_phone = $v;
			$this->modifiedColumns[] = CardPeer::CARD_PHONE;
		}

		return $this;
	} // setCardPhone()

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
			if ($this->card_user_id !== 0) {
				return false;
			}

			if ($this->card_name !== '') {
				return false;
			}

			if ($this->card_number !== '') {
				return false;
			}

			if ($this->card_type !== '') {
				return false;
			}

			if ($this->card_expiry !== '') {
				return false;
			}

			if ($this->card_cvv !== '') {
				return false;
			}

			if ($this->card_bill_name !== '') {
				return false;
			}

			if ($this->card_address !== '') {
				return false;
			}

			if ($this->card_city !== '') {
				return false;
			}

			if ($this->card_state !== '') {
				return false;
			}

			if ($this->card_country !== '') {
				return false;
			}

			if ($this->card_zip !== '') {
				return false;
			}

			if ($this->card_phone !== '') {
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

			$this->card_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->card_user_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->card_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->card_number = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->card_type = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->card_expiry = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->card_cvv = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->card_bill_name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->card_address = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->card_city = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->card_state = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->card_country = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->card_zip = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->card_phone = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 14; // 14 = CardPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Card object", $e);
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

		if ($this->aUser !== null && $this->card_user_id !== $this->aUser->getId()) {
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
			$con = Propel::getConnection(CardPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CardPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
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
			$con = Propel::getConnection(CardPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = CardQuery::create()
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
			$con = Propel::getConnection(CardPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				CardPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = CardPeer::CARD_ID;
		if (null !== $this->card_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . CardPeer::CARD_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(CardPeer::CARD_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_ID`';
		}
		if ($this->isColumnModified(CardPeer::CARD_USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_USER_ID`';
		}
		if ($this->isColumnModified(CardPeer::CARD_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_NAME`';
		}
		if ($this->isColumnModified(CardPeer::CARD_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_NUMBER`';
		}
		if ($this->isColumnModified(CardPeer::CARD_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_TYPE`';
		}
		if ($this->isColumnModified(CardPeer::CARD_EXPIRY)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_EXPIRY`';
		}
		if ($this->isColumnModified(CardPeer::CARD_CVV)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_CVV`';
		}
		if ($this->isColumnModified(CardPeer::CARD_BILL_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_BILL_NAME`';
		}
		if ($this->isColumnModified(CardPeer::CARD_ADDRESS)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_ADDRESS`';
		}
		if ($this->isColumnModified(CardPeer::CARD_CITY)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_CITY`';
		}
		if ($this->isColumnModified(CardPeer::CARD_STATE)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_STATE`';
		}
		if ($this->isColumnModified(CardPeer::CARD_COUNTRY)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_COUNTRY`';
		}
		if ($this->isColumnModified(CardPeer::CARD_ZIP)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_ZIP`';
		}
		if ($this->isColumnModified(CardPeer::CARD_PHONE)) {
			$modifiedColumns[':p' . $index++]  = '`CARD_PHONE`';
		}

		$sql = sprintf(
			'INSERT INTO `card` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`CARD_ID`':
						$stmt->bindValue($identifier, $this->card_id, PDO::PARAM_INT);
						break;
					case '`CARD_USER_ID`':
						$stmt->bindValue($identifier, $this->card_user_id, PDO::PARAM_INT);
						break;
					case '`CARD_NAME`':
						$stmt->bindValue($identifier, $this->card_name, PDO::PARAM_STR);
						break;
					case '`CARD_NUMBER`':
						$stmt->bindValue($identifier, $this->card_number, PDO::PARAM_STR);
						break;
					case '`CARD_TYPE`':
						$stmt->bindValue($identifier, $this->card_type, PDO::PARAM_STR);
						break;
					case '`CARD_EXPIRY`':
						$stmt->bindValue($identifier, $this->card_expiry, PDO::PARAM_STR);
						break;
					case '`CARD_CVV`':
						$stmt->bindValue($identifier, $this->card_cvv, PDO::PARAM_STR);
						break;
					case '`CARD_BILL_NAME`':
						$stmt->bindValue($identifier, $this->card_bill_name, PDO::PARAM_STR);
						break;
					case '`CARD_ADDRESS`':
						$stmt->bindValue($identifier, $this->card_address, PDO::PARAM_STR);
						break;
					case '`CARD_CITY`':
						$stmt->bindValue($identifier, $this->card_city, PDO::PARAM_STR);
						break;
					case '`CARD_STATE`':
						$stmt->bindValue($identifier, $this->card_state, PDO::PARAM_STR);
						break;
					case '`CARD_COUNTRY`':
						$stmt->bindValue($identifier, $this->card_country, PDO::PARAM_STR);
						break;
					case '`CARD_ZIP`':
						$stmt->bindValue($identifier, $this->card_zip, PDO::PARAM_STR);
						break;
					case '`CARD_PHONE`':
						$stmt->bindValue($identifier, $this->card_phone, PDO::PARAM_STR);
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
		$this->setCardId($pk);

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


			if (($retval = CardPeer::doValidate($this, $columns)) !== true) {
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
		$pos = CardPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCardId();
				break;
			case 1:
				return $this->getCardUserId();
				break;
			case 2:
				return $this->getCardName();
				break;
			case 3:
				return $this->getCardNumber();
				break;
			case 4:
				return $this->getCardType();
				break;
			case 5:
				return $this->getCardExpiry();
				break;
			case 6:
				return $this->getCardCvv();
				break;
			case 7:
				return $this->getCardBillName();
				break;
			case 8:
				return $this->getCardAddress();
				break;
			case 9:
				return $this->getCardCity();
				break;
			case 10:
				return $this->getCardState();
				break;
			case 11:
				return $this->getCardCountry();
				break;
			case 12:
				return $this->getCardZip();
				break;
			case 13:
				return $this->getCardPhone();
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
		if (isset($alreadyDumpedObjects['Card'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Card'][$this->getPrimaryKey()] = true;
		$keys = CardPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCardId(),
			$keys[1] => $this->getCardUserId(),
			$keys[2] => $this->getCardName(),
			$keys[3] => $this->getCardNumber(),
			$keys[4] => $this->getCardType(),
			$keys[5] => $this->getCardExpiry(),
			$keys[6] => $this->getCardCvv(),
			$keys[7] => $this->getCardBillName(),
			$keys[8] => $this->getCardAddress(),
			$keys[9] => $this->getCardCity(),
			$keys[10] => $this->getCardState(),
			$keys[11] => $this->getCardCountry(),
			$keys[12] => $this->getCardZip(),
			$keys[13] => $this->getCardPhone(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = CardPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCardId($value);
				break;
			case 1:
				$this->setCardUserId($value);
				break;
			case 2:
				$this->setCardName($value);
				break;
			case 3:
				$this->setCardNumber($value);
				break;
			case 4:
				$this->setCardType($value);
				break;
			case 5:
				$this->setCardExpiry($value);
				break;
			case 6:
				$this->setCardCvv($value);
				break;
			case 7:
				$this->setCardBillName($value);
				break;
			case 8:
				$this->setCardAddress($value);
				break;
			case 9:
				$this->setCardCity($value);
				break;
			case 10:
				$this->setCardState($value);
				break;
			case 11:
				$this->setCardCountry($value);
				break;
			case 12:
				$this->setCardZip($value);
				break;
			case 13:
				$this->setCardPhone($value);
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
		$keys = CardPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCardId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCardUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCardName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCardNumber($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCardType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCardExpiry($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCardCvv($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCardBillName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCardAddress($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCardCity($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCardState($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCardCountry($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCardZip($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCardPhone($arr[$keys[13]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CardPeer::DATABASE_NAME);

		if ($this->isColumnModified(CardPeer::CARD_ID)) $criteria->add(CardPeer::CARD_ID, $this->card_id);
		if ($this->isColumnModified(CardPeer::CARD_USER_ID)) $criteria->add(CardPeer::CARD_USER_ID, $this->card_user_id);
		if ($this->isColumnModified(CardPeer::CARD_NAME)) $criteria->add(CardPeer::CARD_NAME, $this->card_name);
		if ($this->isColumnModified(CardPeer::CARD_NUMBER)) $criteria->add(CardPeer::CARD_NUMBER, $this->card_number);
		if ($this->isColumnModified(CardPeer::CARD_TYPE)) $criteria->add(CardPeer::CARD_TYPE, $this->card_type);
		if ($this->isColumnModified(CardPeer::CARD_EXPIRY)) $criteria->add(CardPeer::CARD_EXPIRY, $this->card_expiry);
		if ($this->isColumnModified(CardPeer::CARD_CVV)) $criteria->add(CardPeer::CARD_CVV, $this->card_cvv);
		if ($this->isColumnModified(CardPeer::CARD_BILL_NAME)) $criteria->add(CardPeer::CARD_BILL_NAME, $this->card_bill_name);
		if ($this->isColumnModified(CardPeer::CARD_ADDRESS)) $criteria->add(CardPeer::CARD_ADDRESS, $this->card_address);
		if ($this->isColumnModified(CardPeer::CARD_CITY)) $criteria->add(CardPeer::CARD_CITY, $this->card_city);
		if ($this->isColumnModified(CardPeer::CARD_STATE)) $criteria->add(CardPeer::CARD_STATE, $this->card_state);
		if ($this->isColumnModified(CardPeer::CARD_COUNTRY)) $criteria->add(CardPeer::CARD_COUNTRY, $this->card_country);
		if ($this->isColumnModified(CardPeer::CARD_ZIP)) $criteria->add(CardPeer::CARD_ZIP, $this->card_zip);
		if ($this->isColumnModified(CardPeer::CARD_PHONE)) $criteria->add(CardPeer::CARD_PHONE, $this->card_phone);

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
		$criteria = new Criteria(CardPeer::DATABASE_NAME);
		$criteria->add(CardPeer::CARD_ID, $this->card_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCardId();
	}

	/**
	 * Generic method to set the primary key (card_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCardId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getCardId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Card (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setCardUserId($this->getCardUserId());
		$copyObj->setCardName($this->getCardName());
		$copyObj->setCardNumber($this->getCardNumber());
		$copyObj->setCardType($this->getCardType());
		$copyObj->setCardExpiry($this->getCardExpiry());
		$copyObj->setCardCvv($this->getCardCvv());
		$copyObj->setCardBillName($this->getCardBillName());
		$copyObj->setCardAddress($this->getCardAddress());
		$copyObj->setCardCity($this->getCardCity());
		$copyObj->setCardState($this->getCardState());
		$copyObj->setCardCountry($this->getCardCountry());
		$copyObj->setCardZip($this->getCardZip());
		$copyObj->setCardPhone($this->getCardPhone());

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
			$copyObj->setCardId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Card Clone of current object.
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
	 * @return     CardPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CardPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Card The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setUser(User $v = null)
	{
		if ($v === null) {
			$this->setCardUserId(0);
		} else {
			$this->setCardUserId($v->getId());
		}

		$this->aUser = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the User object, it will not be re-added.
		if ($v !== null) {
			$v->addCard($this);
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
		if ($this->aUser === null && ($this->card_user_id !== null)) {
			$this->aUser = UserQuery::create()->findPk($this->card_user_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aUser->addCards($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->card_id = null;
		$this->card_user_id = null;
		$this->card_name = null;
		$this->card_number = null;
		$this->card_type = null;
		$this->card_expiry = null;
		$this->card_cvv = null;
		$this->card_bill_name = null;
		$this->card_address = null;
		$this->card_city = null;
		$this->card_state = null;
		$this->card_country = null;
		$this->card_zip = null;
		$this->card_phone = null;
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
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(CardPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseCard
