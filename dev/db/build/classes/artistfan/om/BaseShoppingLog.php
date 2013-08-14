<?php


/**
 * Base class that represents a row from the 'shopping_log' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseShoppingLog extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ShoppingLogPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ShoppingLogPeer
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
	 * The value for the wall_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $wall_id;

	/**
	 * The value for the artist_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $artist_id;

	/**
	 * The value for the user_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $user_id;

	/**
	 * The value for the action field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $action;

	/**
	 * The value for the money field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $money;

	/**
	 * The value for the album_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $album_id;

	/**
	 * The value for the music_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $music_id;

	/**
	 * The value for the video_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $video_id;

	/**
	 * The value for the event_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $event_id;

	/**
	 * The value for the data field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $data;

	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

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
		$this->wall_id = 0;
		$this->artist_id = 0;
		$this->user_id = 0;
		$this->action = '';
		$this->money = 0;
		$this->album_id = 0;
		$this->music_id = 0;
		$this->video_id = 0;
		$this->event_id = 0;
		$this->data = '';
		$this->pdate = 0;
	}

	/**
	 * Initializes internal state of BaseShoppingLog object.
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
	 * Get the [wall_id] column value.
	 * 
	 * @return     int
	 */
	public function getWallId()
	{
		return $this->wall_id;
	}

	/**
	 * Get the [artist_id] column value.
	 * 
	 * @return     int
	 */
	public function getArtistId()
	{
		return $this->artist_id;
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
	 * Get the [action] column value.
	 * 
	 * @return     string
	 */
	public function getAction()
	{
		return $this->action;
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
	 * Get the [album_id] column value.
	 * 
	 * @return     int
	 */
	public function getAlbumId()
	{
		return $this->album_id;
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
	 * Get the [video_id] column value.
	 * 
	 * @return     int
	 */
	public function getVideoId()
	{
		return $this->video_id;
	}

	/**
	 * Get the [event_id] column value.
	 * 
	 * @return     int
	 */
	public function getEventId()
	{
		return $this->event_id;
	}

	/**
	 * Get the [data] column value.
	 * 
	 * @return     string
	 */
	public function getData()
	{
		return $this->data;
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
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [wall_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setWallId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wall_id !== $v) {
			$this->wall_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::WALL_ID;
		}

		return $this;
	} // setWallId()

	/**
	 * Set the value of [artist_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setArtistId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->artist_id !== $v) {
			$this->artist_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::ARTIST_ID;
		}

		return $this;
	} // setArtistId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [action] column.
	 * 
	 * @param      string $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->action !== $v) {
			$this->action = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::ACTION;
		}

		return $this;
	} // setAction()

	/**
	 * Set the value of [money] column.
	 * 
	 * @param      double $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setMoney($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->money !== $v) {
			$this->money = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::MONEY;
		}

		return $this;
	} // setMoney()

	/**
	 * Set the value of [album_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setAlbumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->album_id !== $v) {
			$this->album_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::ALBUM_ID;
		}

		return $this;
	} // setAlbumId()

	/**
	 * Set the value of [music_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setMusicId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->music_id !== $v) {
			$this->music_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::MUSIC_ID;
		}

		return $this;
	} // setMusicId()

	/**
	 * Set the value of [video_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setVideoId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->video_id !== $v) {
			$this->video_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::VIDEO_ID;
		}

		return $this;
	} // setVideoId()

	/**
	 * Set the value of [event_id] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setEventId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::EVENT_ID;
		}

		return $this;
	} // setEventId()

	/**
	 * Set the value of [data] column.
	 * 
	 * @param      string $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setData($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->data !== $v) {
			$this->data = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::DATA;
		}

		return $this;
	} // setData()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     ShoppingLog The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = ShoppingLogPeer::PDATE;
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
			if ($this->wall_id !== 0) {
				return false;
			}

			if ($this->artist_id !== 0) {
				return false;
			}

			if ($this->user_id !== 0) {
				return false;
			}

			if ($this->action !== '') {
				return false;
			}

			if ($this->money !== 0) {
				return false;
			}

			if ($this->album_id !== 0) {
				return false;
			}

			if ($this->music_id !== 0) {
				return false;
			}

			if ($this->video_id !== 0) {
				return false;
			}

			if ($this->event_id !== 0) {
				return false;
			}

			if ($this->data !== '') {
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
			$this->wall_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->artist_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->user_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->action = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->money = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
			$this->album_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->music_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->video_id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->event_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->data = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->pdate = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 12; // 12 = ShoppingLogPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating ShoppingLog object", $e);
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
			$con = Propel::getConnection(ShoppingLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ShoppingLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(ShoppingLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ShoppingLogQuery::create()
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
			$con = Propel::getConnection(ShoppingLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				ShoppingLogPeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = ShoppingLogPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ShoppingLogPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ShoppingLogPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::WALL_ID)) {
			$modifiedColumns[':p' . $index++]  = '`WALL_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::ARTIST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ARTIST_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::ACTION)) {
			$modifiedColumns[':p' . $index++]  = '`ACTION`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::MONEY)) {
			$modifiedColumns[':p' . $index++]  = '`MONEY`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::ALBUM_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ALBUM_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::MUSIC_ID)) {
			$modifiedColumns[':p' . $index++]  = '`MUSIC_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::VIDEO_ID)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::EVENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_ID`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::DATA)) {
			$modifiedColumns[':p' . $index++]  = '`DATA`';
		}
		if ($this->isColumnModified(ShoppingLogPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}

		$sql = sprintf(
			'INSERT INTO `shopping_log` (%s) VALUES (%s)',
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
					case '`WALL_ID`':
						$stmt->bindValue($identifier, $this->wall_id, PDO::PARAM_INT);
						break;
					case '`ARTIST_ID`':
						$stmt->bindValue($identifier, $this->artist_id, PDO::PARAM_INT);
						break;
					case '`USER_ID`':
						$stmt->bindValue($identifier, $this->user_id, PDO::PARAM_INT);
						break;
					case '`ACTION`':
						$stmt->bindValue($identifier, $this->action, PDO::PARAM_STR);
						break;
					case '`MONEY`':
						$stmt->bindValue($identifier, $this->money, PDO::PARAM_STR);
						break;
					case '`ALBUM_ID`':
						$stmt->bindValue($identifier, $this->album_id, PDO::PARAM_INT);
						break;
					case '`MUSIC_ID`':
						$stmt->bindValue($identifier, $this->music_id, PDO::PARAM_INT);
						break;
					case '`VIDEO_ID`':
						$stmt->bindValue($identifier, $this->video_id, PDO::PARAM_INT);
						break;
					case '`EVENT_ID`':
						$stmt->bindValue($identifier, $this->event_id, PDO::PARAM_INT);
						break;
					case '`DATA`':
						$stmt->bindValue($identifier, $this->data, PDO::PARAM_STR);
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

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = ShoppingLogPeer::doValidate($this, $columns)) !== true) {
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
		$pos = ShoppingLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWallId();
				break;
			case 2:
				return $this->getArtistId();
				break;
			case 3:
				return $this->getUserId();
				break;
			case 4:
				return $this->getAction();
				break;
			case 5:
				return $this->getMoney();
				break;
			case 6:
				return $this->getAlbumId();
				break;
			case 7:
				return $this->getMusicId();
				break;
			case 8:
				return $this->getVideoId();
				break;
			case 9:
				return $this->getEventId();
				break;
			case 10:
				return $this->getData();
				break;
			case 11:
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
		if (isset($alreadyDumpedObjects['ShoppingLog'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['ShoppingLog'][$this->getPrimaryKey()] = true;
		$keys = ShoppingLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWallId(),
			$keys[2] => $this->getArtistId(),
			$keys[3] => $this->getUserId(),
			$keys[4] => $this->getAction(),
			$keys[5] => $this->getMoney(),
			$keys[6] => $this->getAlbumId(),
			$keys[7] => $this->getMusicId(),
			$keys[8] => $this->getVideoId(),
			$keys[9] => $this->getEventId(),
			$keys[10] => $this->getData(),
			$keys[11] => $this->getPdate(),
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
		$pos = ShoppingLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWallId($value);
				break;
			case 2:
				$this->setArtistId($value);
				break;
			case 3:
				$this->setUserId($value);
				break;
			case 4:
				$this->setAction($value);
				break;
			case 5:
				$this->setMoney($value);
				break;
			case 6:
				$this->setAlbumId($value);
				break;
			case 7:
				$this->setMusicId($value);
				break;
			case 8:
				$this->setVideoId($value);
				break;
			case 9:
				$this->setEventId($value);
				break;
			case 10:
				$this->setData($value);
				break;
			case 11:
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
		$keys = ShoppingLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWallId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setArtistId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUserId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAction($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMoney($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setAlbumId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMusicId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVideoId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEventId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setData($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPdate($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ShoppingLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(ShoppingLogPeer::ID)) $criteria->add(ShoppingLogPeer::ID, $this->id);
		if ($this->isColumnModified(ShoppingLogPeer::WALL_ID)) $criteria->add(ShoppingLogPeer::WALL_ID, $this->wall_id);
		if ($this->isColumnModified(ShoppingLogPeer::ARTIST_ID)) $criteria->add(ShoppingLogPeer::ARTIST_ID, $this->artist_id);
		if ($this->isColumnModified(ShoppingLogPeer::USER_ID)) $criteria->add(ShoppingLogPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(ShoppingLogPeer::ACTION)) $criteria->add(ShoppingLogPeer::ACTION, $this->action);
		if ($this->isColumnModified(ShoppingLogPeer::MONEY)) $criteria->add(ShoppingLogPeer::MONEY, $this->money);
		if ($this->isColumnModified(ShoppingLogPeer::ALBUM_ID)) $criteria->add(ShoppingLogPeer::ALBUM_ID, $this->album_id);
		if ($this->isColumnModified(ShoppingLogPeer::MUSIC_ID)) $criteria->add(ShoppingLogPeer::MUSIC_ID, $this->music_id);
		if ($this->isColumnModified(ShoppingLogPeer::VIDEO_ID)) $criteria->add(ShoppingLogPeer::VIDEO_ID, $this->video_id);
		if ($this->isColumnModified(ShoppingLogPeer::EVENT_ID)) $criteria->add(ShoppingLogPeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(ShoppingLogPeer::DATA)) $criteria->add(ShoppingLogPeer::DATA, $this->data);
		if ($this->isColumnModified(ShoppingLogPeer::PDATE)) $criteria->add(ShoppingLogPeer::PDATE, $this->pdate);

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
		$criteria = new Criteria(ShoppingLogPeer::DATABASE_NAME);
		$criteria->add(ShoppingLogPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of ShoppingLog (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setWallId($this->getWallId());
		$copyObj->setArtistId($this->getArtistId());
		$copyObj->setUserId($this->getUserId());
		$copyObj->setAction($this->getAction());
		$copyObj->setMoney($this->getMoney());
		$copyObj->setAlbumId($this->getAlbumId());
		$copyObj->setMusicId($this->getMusicId());
		$copyObj->setVideoId($this->getVideoId());
		$copyObj->setEventId($this->getEventId());
		$copyObj->setData($this->getData());
		$copyObj->setPdate($this->getPdate());

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
	 * @return     ShoppingLog Clone of current object.
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
	 * @return     ShoppingLogPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ShoppingLogPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     ShoppingLog The current object (for fluent API support)
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
			$v->addShoppingLog($this);
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
				$this->aUser->addShoppingLogs($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->wall_id = null;
		$this->artist_id = null;
		$this->user_id = null;
		$this->action = null;
		$this->money = null;
		$this->album_id = null;
		$this->music_id = null;
		$this->video_id = null;
		$this->event_id = null;
		$this->data = null;
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
		return (string) $this->exportTo(ShoppingLogPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseShoppingLog
