<?php


/**
 * Base class that represents a row from the 'invitation' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseInvitation extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'InvitationPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        InvitationPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the inv_id field.
	 * @var        int
	 */
	protected $inv_id;

	/**
	 * The value for the inv_inviter field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $inv_inviter;

	/**
	 * The value for the inv_invitee field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $inv_invitee;

	/**
	 * The value for the inv_name field.
	 * @var        string
	 */
	protected $inv_name;

	/**
	 * The value for the inv_email field.
	 * @var        string
	 */
	protected $inv_email;

	/**
	 * The value for the inv_fbid field.
	 * @var        string
	 */
	protected $inv_fbid;

	/**
	 * The value for the inv_status field.
	 * @var        int
	 */
	protected $inv_status;

	/**
	 * The value for the cdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $cdate;

	/**
	 * The value for the mdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $mdate;

	/**
	 * The value for the inv_twid field.
	 * @var        string
	 */
	protected $inv_twid;

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
		$this->inv_inviter = 0;
		$this->inv_invitee = 0;
		$this->cdate = 0;
		$this->mdate = 0;
	}

	/**
	 * Initializes internal state of BaseInvitation object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [inv_id] column value.
	 * 
	 * @return     int
	 */
	public function getInvId()
	{
		return $this->inv_id;
	}

	/**
	 * Get the [inv_inviter] column value.
	 * 
	 * @return     int
	 */
	public function getInvInviter()
	{
		return $this->inv_inviter;
	}

	/**
	 * Get the [inv_invitee] column value.
	 * 
	 * @return     int
	 */
	public function getInvInvitee()
	{
		return $this->inv_invitee;
	}

	/**
	 * Get the [inv_name] column value.
	 * 
	 * @return     string
	 */
	public function getInvName()
	{
		return $this->inv_name;
	}

	/**
	 * Get the [inv_email] column value.
	 * 
	 * @return     string
	 */
	public function getInvEmail()
	{
		return $this->inv_email;
	}

	/**
	 * Get the [inv_fbid] column value.
	 * 
	 * @return     string
	 */
	public function getInvFbid()
	{
		return $this->inv_fbid;
	}

	/**
	 * Get the [inv_status] column value.
	 * 
	 * @return     int
	 */
	public function getInvStatus()
	{
		return $this->inv_status;
	}

	/**
	 * Get the [cdate] column value.
	 * 
	 * @return     int
	 */
	public function getCdate()
	{
		return $this->cdate;
	}

	/**
	 * Get the [mdate] column value.
	 * 
	 * @return     int
	 */
	public function getMdate()
	{
		return $this->mdate;
	}

	/**
	 * Get the [inv_twid] column value.
	 * 
	 * @return     string
	 */
	public function getInvTwid()
	{
		return $this->inv_twid;
	}

	/**
	 * Set the value of [inv_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->inv_id !== $v) {
			$this->inv_id = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_ID;
		}

		return $this;
	} // setInvId()

	/**
	 * Set the value of [inv_inviter] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvInviter($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->inv_inviter !== $v) {
			$this->inv_inviter = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_INVITER;
		}

		return $this;
	} // setInvInviter()

	/**
	 * Set the value of [inv_invitee] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvInvitee($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->inv_invitee !== $v) {
			$this->inv_invitee = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_INVITEE;
		}

		return $this;
	} // setInvInvitee()

	/**
	 * Set the value of [inv_name] column.
	 * 
	 * @param      string $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->inv_name !== $v) {
			$this->inv_name = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_NAME;
		}

		return $this;
	} // setInvName()

	/**
	 * Set the value of [inv_email] column.
	 * 
	 * @param      string $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->inv_email !== $v) {
			$this->inv_email = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_EMAIL;
		}

		return $this;
	} // setInvEmail()

	/**
	 * Set the value of [inv_fbid] column.
	 * 
	 * @param      string $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvFbid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->inv_fbid !== $v) {
			$this->inv_fbid = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_FBID;
		}

		return $this;
	} // setInvFbid()

	/**
	 * Set the value of [inv_status] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->inv_status !== $v) {
			$this->inv_status = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_STATUS;
		}

		return $this;
	} // setInvStatus()

	/**
	 * Set the value of [cdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setCdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cdate !== $v) {
			$this->cdate = $v;
			$this->modifiedColumns[] = InvitationPeer::CDATE;
		}

		return $this;
	} // setCdate()

	/**
	 * Set the value of [mdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setMdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->mdate !== $v) {
			$this->mdate = $v;
			$this->modifiedColumns[] = InvitationPeer::MDATE;
		}

		return $this;
	} // setMdate()

	/**
	 * Set the value of [inv_twid] column.
	 * 
	 * @param      string $v new value
	 * @return     Invitation The current object (for fluent API support)
	 */
	public function setInvTwid($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->inv_twid !== $v) {
			$this->inv_twid = $v;
			$this->modifiedColumns[] = InvitationPeer::INV_TWID;
		}

		return $this;
	} // setInvTwid()

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
			if ($this->inv_inviter !== 0) {
				return false;
			}

			if ($this->inv_invitee !== 0) {
				return false;
			}

			if ($this->cdate !== 0) {
				return false;
			}

			if ($this->mdate !== 0) {
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

			$this->inv_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->inv_inviter = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->inv_invitee = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->inv_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->inv_email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->inv_fbid = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->inv_status = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->cdate = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->mdate = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->inv_twid = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 10; // 10 = InvitationPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Invitation object", $e);
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
			$con = Propel::getConnection(InvitationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = InvitationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(InvitationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = InvitationQuery::create()
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
			$con = Propel::getConnection(InvitationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				InvitationPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = InvitationPeer::INV_ID;
		if (null !== $this->inv_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . InvitationPeer::INV_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(InvitationPeer::INV_ID)) {
			$modifiedColumns[':p' . $index++]  = '`INV_ID`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_INVITER)) {
			$modifiedColumns[':p' . $index++]  = '`INV_INVITER`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_INVITEE)) {
			$modifiedColumns[':p' . $index++]  = '`INV_INVITEE`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`INV_NAME`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_EMAIL)) {
			$modifiedColumns[':p' . $index++]  = '`INV_EMAIL`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_FBID)) {
			$modifiedColumns[':p' . $index++]  = '`INV_FBID`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`INV_STATUS`';
		}
		if ($this->isColumnModified(InvitationPeer::CDATE)) {
			$modifiedColumns[':p' . $index++]  = '`CDATE`';
		}
		if ($this->isColumnModified(InvitationPeer::MDATE)) {
			$modifiedColumns[':p' . $index++]  = '`MDATE`';
		}
		if ($this->isColumnModified(InvitationPeer::INV_TWID)) {
			$modifiedColumns[':p' . $index++]  = '`INV_TWID`';
		}

		$sql = sprintf(
			'INSERT INTO `invitation` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`INV_ID`':
						$stmt->bindValue($identifier, $this->inv_id, PDO::PARAM_INT);
						break;
					case '`INV_INVITER`':
						$stmt->bindValue($identifier, $this->inv_inviter, PDO::PARAM_INT);
						break;
					case '`INV_INVITEE`':
						$stmt->bindValue($identifier, $this->inv_invitee, PDO::PARAM_INT);
						break;
					case '`INV_NAME`':
						$stmt->bindValue($identifier, $this->inv_name, PDO::PARAM_STR);
						break;
					case '`INV_EMAIL`':
						$stmt->bindValue($identifier, $this->inv_email, PDO::PARAM_STR);
						break;
					case '`INV_FBID`':
						$stmt->bindValue($identifier, $this->inv_fbid, PDO::PARAM_STR);
						break;
					case '`INV_STATUS`':
						$stmt->bindValue($identifier, $this->inv_status, PDO::PARAM_INT);
						break;
					case '`CDATE`':
						$stmt->bindValue($identifier, $this->cdate, PDO::PARAM_INT);
						break;
					case '`MDATE`':
						$stmt->bindValue($identifier, $this->mdate, PDO::PARAM_INT);
						break;
					case '`INV_TWID`':
						$stmt->bindValue($identifier, $this->inv_twid, PDO::PARAM_STR);
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
		$this->setInvId($pk);

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


			if (($retval = InvitationPeer::doValidate($this, $columns)) !== true) {
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
		$pos = InvitationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getInvId();
				break;
			case 1:
				return $this->getInvInviter();
				break;
			case 2:
				return $this->getInvInvitee();
				break;
			case 3:
				return $this->getInvName();
				break;
			case 4:
				return $this->getInvEmail();
				break;
			case 5:
				return $this->getInvFbid();
				break;
			case 6:
				return $this->getInvStatus();
				break;
			case 7:
				return $this->getCdate();
				break;
			case 8:
				return $this->getMdate();
				break;
			case 9:
				return $this->getInvTwid();
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
		if (isset($alreadyDumpedObjects['Invitation'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Invitation'][$this->getPrimaryKey()] = true;
		$keys = InvitationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getInvId(),
			$keys[1] => $this->getInvInviter(),
			$keys[2] => $this->getInvInvitee(),
			$keys[3] => $this->getInvName(),
			$keys[4] => $this->getInvEmail(),
			$keys[5] => $this->getInvFbid(),
			$keys[6] => $this->getInvStatus(),
			$keys[7] => $this->getCdate(),
			$keys[8] => $this->getMdate(),
			$keys[9] => $this->getInvTwid(),
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
		$pos = InvitationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setInvId($value);
				break;
			case 1:
				$this->setInvInviter($value);
				break;
			case 2:
				$this->setInvInvitee($value);
				break;
			case 3:
				$this->setInvName($value);
				break;
			case 4:
				$this->setInvEmail($value);
				break;
			case 5:
				$this->setInvFbid($value);
				break;
			case 6:
				$this->setInvStatus($value);
				break;
			case 7:
				$this->setCdate($value);
				break;
			case 8:
				$this->setMdate($value);
				break;
			case 9:
				$this->setInvTwid($value);
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
		$keys = InvitationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setInvId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInvInviter($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setInvInvitee($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setInvName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setInvEmail($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setInvFbid($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setInvStatus($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCdate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMdate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setInvTwid($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(InvitationPeer::DATABASE_NAME);

		if ($this->isColumnModified(InvitationPeer::INV_ID)) $criteria->add(InvitationPeer::INV_ID, $this->inv_id);
		if ($this->isColumnModified(InvitationPeer::INV_INVITER)) $criteria->add(InvitationPeer::INV_INVITER, $this->inv_inviter);
		if ($this->isColumnModified(InvitationPeer::INV_INVITEE)) $criteria->add(InvitationPeer::INV_INVITEE, $this->inv_invitee);
		if ($this->isColumnModified(InvitationPeer::INV_NAME)) $criteria->add(InvitationPeer::INV_NAME, $this->inv_name);
		if ($this->isColumnModified(InvitationPeer::INV_EMAIL)) $criteria->add(InvitationPeer::INV_EMAIL, $this->inv_email);
		if ($this->isColumnModified(InvitationPeer::INV_FBID)) $criteria->add(InvitationPeer::INV_FBID, $this->inv_fbid);
		if ($this->isColumnModified(InvitationPeer::INV_STATUS)) $criteria->add(InvitationPeer::INV_STATUS, $this->inv_status);
		if ($this->isColumnModified(InvitationPeer::CDATE)) $criteria->add(InvitationPeer::CDATE, $this->cdate);
		if ($this->isColumnModified(InvitationPeer::MDATE)) $criteria->add(InvitationPeer::MDATE, $this->mdate);
		if ($this->isColumnModified(InvitationPeer::INV_TWID)) $criteria->add(InvitationPeer::INV_TWID, $this->inv_twid);

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
		$criteria = new Criteria(InvitationPeer::DATABASE_NAME);
		$criteria->add(InvitationPeer::INV_ID, $this->inv_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getInvId();
	}

	/**
	 * Generic method to set the primary key (inv_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setInvId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getInvId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Invitation (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setInvInviter($this->getInvInviter());
		$copyObj->setInvInvitee($this->getInvInvitee());
		$copyObj->setInvName($this->getInvName());
		$copyObj->setInvEmail($this->getInvEmail());
		$copyObj->setInvFbid($this->getInvFbid());
		$copyObj->setInvStatus($this->getInvStatus());
		$copyObj->setCdate($this->getCdate());
		$copyObj->setMdate($this->getMdate());
		$copyObj->setInvTwid($this->getInvTwid());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setInvId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Invitation Clone of current object.
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
	 * @return     InvitationPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InvitationPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->inv_id = null;
		$this->inv_inviter = null;
		$this->inv_invitee = null;
		$this->inv_name = null;
		$this->inv_email = null;
		$this->inv_fbid = null;
		$this->inv_status = null;
		$this->cdate = null;
		$this->mdate = null;
		$this->inv_twid = null;
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
		return (string) $this->exportTo(InvitationPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseInvitation
