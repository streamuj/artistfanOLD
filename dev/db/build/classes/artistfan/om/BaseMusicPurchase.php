<?php


/**
 * Base class that represents a row from the 'music_purchase' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicPurchase extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'MusicPurchasePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MusicPurchasePeer
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
	 * The value for the music_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $music_id;

	/**
	 * The value for the with_all_album field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $with_all_album;

	/**
	 * The value for the price field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $price;

	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

	/**
	 * @var        Music
	 */
	protected $aMusic;

	/**
	 * @var        Music one-to-one related Music object
	 */
	protected $singleMusicRelatedById;

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
	protected $musicsRelatedByIdScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->user_id = 0;
		$this->music_id = 0;
		$this->with_all_album = 0;
		$this->price = 0;
		$this->is_delete = 0;
		$this->pdate = 0;
	}

	/**
	 * Initializes internal state of BaseMusicPurchase object.
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
	 * Get the [music_id] column value.
	 * 
	 * @return     int
	 */
	public function getMusicId()
	{
		return $this->music_id;
	}

	/**
	 * Get the [with_all_album] column value.
	 * 
	 * @return     int
	 */
	public function getWithAllAlbum()
	{
		return $this->with_all_album;
	}

	/**
	 * Get the [price] column value.
	 * 
	 * @return     double
	 */
	public function getPrice()
	{
		return $this->price;
	}
	/**
	 * Get the [is_delete] column value.
	 * 
	 * @return     int
	 */
	public function getIsDelete()
	{
		return $this->is_delete;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::USER_ID;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [music_id] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setMusicId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->music_id !== $v) {
			$this->music_id = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::MUSIC_ID;
		}

		if ($this->aMusic !== null && $this->aMusic->getId() !== $v) {
			$this->aMusic = null;
		}

		return $this;
	} // setMusicId()

	/**
	 * Set the value of [with_all_album] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setWithAllAlbum($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->with_all_album !== $v) {
			$this->with_all_album = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::WITH_ALL_ALBUM;
		}

		return $this;
	} // setWithAllAlbum()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      double $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [is_delete] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setIsDelete($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_delete !== $v) {
			$this->is_delete = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::IS_DELETE;
		}

		return $this;
	} // setIsDelete()


	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     MusicPurchase The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = MusicPurchasePeer::PDATE;
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

			if ($this->music_id !== 0) {
				return false;
			}

			if ($this->with_all_album !== 0) {
				return false;
			}

			if ($this->price !== 0) {
				return false;
			}

			if ($this->pdate !== 0) {
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
			$this->music_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->with_all_album = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->price = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
			$this->pdate = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 6; // 6 = MusicPurchasePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating MusicPurchase object", $e);
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

		if ($this->aMusic !== null && $this->music_id !== $this->aMusic->getId()) {
			$this->aMusic = null;
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
			$con = Propel::getConnection(MusicPurchasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MusicPurchasePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aMusic = null;
			$this->singleMusicRelatedById = null;

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
			$con = Propel::getConnection(MusicPurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = MusicPurchaseQuery::create()
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
			$con = Propel::getConnection(MusicPurchasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				MusicPurchasePeer::addInstanceToPool($this);
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

			if ($this->aMusic !== null) {
				if ($this->aMusic->isModified() || $this->aMusic->isNew()) {
					$affectedRows += $this->aMusic->save($con);
				}
				$this->setMusic($this->aMusic);
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

			if ($this->musicsRelatedByIdScheduledForDeletion !== null) {
				if (!$this->musicsRelatedByIdScheduledForDeletion->isEmpty()) {
					MusicQuery::create()
						->filterByPrimaryKeys($this->musicsRelatedByIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->musicsRelatedByIdScheduledForDeletion = null;
				}
			}

			if ($this->singleMusicRelatedById !== null) {
				if (!$this->singleMusicRelatedById->isDeleted()) {
						$affectedRows += $this->singleMusicRelatedById->save($con);
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

		$this->modifiedColumns[] = MusicPurchasePeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . MusicPurchasePeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(MusicPurchasePeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::MUSIC_ID)) {
			$modifiedColumns[':p' . $index++]  = '`MUSIC_ID`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::WITH_ALL_ALBUM)) {
			$modifiedColumns[':p' . $index++]  = '`WITH_ALL_ALBUM`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PRICE`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::IS_DELETE)) {
			$modifiedColumns[':p' . $index++]  = '`IS_DELETE`';
		}
		if ($this->isColumnModified(MusicPurchasePeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}

		$sql = sprintf(
			'INSERT INTO `music_purchase` (%s) VALUES (%s)',
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
					case '`MUSIC_ID`':
						$stmt->bindValue($identifier, $this->music_id, PDO::PARAM_INT);
						break;
					case '`WITH_ALL_ALBUM`':
						$stmt->bindValue($identifier, $this->with_all_album, PDO::PARAM_INT);
						break;
					case '`PRICE`':
						$stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
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

			if ($this->aMusic !== null) {
				if (!$this->aMusic->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMusic->getValidationFailures());
				}
			}


			if (($retval = MusicPurchasePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->singleMusicRelatedById !== null) {
					if (!$this->singleMusicRelatedById->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleMusicRelatedById->getValidationFailures());
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
		$pos = MusicPurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMusicId();
				break;
			case 3:
				return $this->getWithAllAlbum();
				break;
			case 4:
				return $this->getPrice();
				break;
			case 5:
				return $this->getPdate();
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
		if (isset($alreadyDumpedObjects['MusicPurchase'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['MusicPurchase'][$this->getPrimaryKey()] = true;
		$keys = MusicPurchasePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getMusicId(),
			$keys[3] => $this->getWithAllAlbum(),
			$keys[4] => $this->getPrice(),
			$keys[5] => $this->getIsDelete(),
			$keys[6] => $this->getPdate(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aMusic) {
				$result['Music'] = $this->aMusic->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->singleMusicRelatedById) {
				$result['MusicRelatedById'] = $this->singleMusicRelatedById->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
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
		$pos = MusicPurchasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMusicId($value);
				break;
			case 3:
				$this->setWithAllAlbum($value);
				break;
			case 4:
				$this->setPrice($value);
				break;
			case 5:
				$this->setPdate($value);
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
		$keys = MusicPurchasePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMusicId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWithAllAlbum($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPrice($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIsDelete($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPdate($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MusicPurchasePeer::DATABASE_NAME);

		if ($this->isColumnModified(MusicPurchasePeer::ID)) $criteria->add(MusicPurchasePeer::ID, $this->id);
		if ($this->isColumnModified(MusicPurchasePeer::USER_ID)) $criteria->add(MusicPurchasePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(MusicPurchasePeer::MUSIC_ID)) $criteria->add(MusicPurchasePeer::MUSIC_ID, $this->music_id);
		if ($this->isColumnModified(MusicPurchasePeer::WITH_ALL_ALBUM)) $criteria->add(MusicPurchasePeer::WITH_ALL_ALBUM, $this->with_all_album);
		if ($this->isColumnModified(MusicPurchasePeer::PRICE)) $criteria->add(MusicPurchasePeer::PRICE, $this->price);
		if ($this->isColumnModified(MusicPurchasePeer::IS_DELETE)) $criteria->add(MusicPurchasePeer::IS_DELETE, $this->is_delete);
		if ($this->isColumnModified(MusicPurchasePeer::PDATE)) $criteria->add(MusicPurchasePeer::PDATE, $this->pdate);

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
		$criteria = new Criteria(MusicPurchasePeer::DATABASE_NAME);
		$criteria->add(MusicPurchasePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of MusicPurchase (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setMusicId($this->getMusicId());
		$copyObj->setWithAllAlbum($this->getWithAllAlbum());
		$copyObj->setPrice($this->getPrice());
		$copyObj->setPdate($this->getPdate());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			$relObj = $this->getMusicRelatedById();
			if ($relObj) {
				$copyObj->setMusicRelatedById($relObj->copy($deepCopy));
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
	 * @return     MusicPurchase Clone of current object.
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
	 * @return     MusicPurchasePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MusicPurchasePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Music object.
	 *
	 * @param      Music $v
	 * @return     MusicPurchase The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMusic(Music $v = null)
	{
		if ($v === null) {
			$this->setMusicId(0);
		} else {
			$this->setMusicId($v->getId());
		}

		$this->aMusic = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Music object, it will not be re-added.
		if ($v !== null) {
			$v->addMusicPurchaseRelatedByMusicId($this);
		}

		return $this;
	}


	/**
	 * Get the associated Music object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Music The associated Music object.
	 * @throws     PropelException
	 */
	public function getMusic(PropelPDO $con = null)
	{
		if ($this->aMusic === null && ($this->music_id !== null)) {
			$this->aMusic = MusicQuery::create()->findPk($this->music_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMusic->addMusicPurchasesRelatedByMusicId($this);
			 */
		}
		return $this->aMusic;
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
	}

	/**
	 * Gets a single Music object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     Music
	 * @throws     PropelException
	 */
	public function getMusicRelatedById(PropelPDO $con = null)
	{

		if ($this->singleMusicRelatedById === null && !$this->isNew()) {
			$this->singleMusicRelatedById = MusicQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleMusicRelatedById;
	}

	/**
	 * Sets a single Music object as related to this object by a one-to-one relationship.
	 *
	 * @param      Music $v Music
	 * @return     MusicPurchase The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMusicRelatedById(Music $v = null)
	{
		$this->singleMusicRelatedById = $v;

		// Make sure that that the passed-in Music isn't already associated with this object
		if ($v !== null && $v->getMusicPurchase() === null) {
			$v->setMusicPurchase($this);
		}

		return $this;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->music_id = null;
		$this->with_all_album = null;
		$this->price = null;
		$this->pdate = null;
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
			if ($this->singleMusicRelatedById) {
				$this->singleMusicRelatedById->clearAllReferences($deep);
			}
		} // if ($deep)

		if ($this->singleMusicRelatedById instanceof PropelCollection) {
			$this->singleMusicRelatedById->clearIterator();
		}
		$this->singleMusicRelatedById = null;
		$this->aMusic = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(MusicPurchasePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseMusicPurchase
