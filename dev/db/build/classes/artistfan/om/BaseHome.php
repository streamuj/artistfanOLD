<?php


/**
 * Base class that represents a row from the 'home' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHome extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'HomePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        HomePeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the home_id field.
	 * @var        int
	 */
	protected $home_id;

	/**
	 * The value for the artist_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $artist_id;

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
	 * The value for the music_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $music_id;

	/**
	 * The value for the music_album_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $music_album_id;

	/**
	 * The value for the link field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $link;

	/**
	 * The value for the home_order field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $home_order;

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
	 * The value for the home_cat field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $home_cat;

	/**
	 * The value for the image_path field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $image_path;

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
		$this->artist_id = 0;
		$this->video_id = 0;
		$this->event_id = 0;
		$this->music_id = 0;
		$this->music_album_id = 0;
		$this->link = '';
		$this->home_order = 0;
		$this->cdate = 0;
		$this->mdate = 0;
		$this->home_cat = 0;
		$this->image_path = '';
	}

	/**
	 * Initializes internal state of BaseHome object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [home_id] column value.
	 * 
	 * @return     int
	 */
	public function getHomeId()
	{
		return $this->home_id;
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
	 * Get the [music_id] column value.
	 * 
	 * @return     int
	 */
	public function getMusicId()
	{
		return $this->music_id;
	}

	/**
	 * Get the [music_album_id] column value.
	 * 
	 * @return     int
	 */
	public function getMusicAlbumId()
	{
		return $this->music_album_id;
	}

	/**
	 * Get the [link] column value.
	 * 
	 * @return     string
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * Get the [home_order] column value.
	 * 
	 * @return     int
	 */
	public function getHomeOrder()
	{
		return $this->home_order;
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
	 * Get the [home_cat] column value.
	 * 
	 * @return     int
	 */
	public function getHomeCat()
	{
		return $this->home_cat;
	}

	/**
	 * Get the [image_path] column value.
	 * 
	 * @return     string
	 */
	public function getImagePath()
	{
		return $this->image_path;
	}

	/**
	 * Set the value of [home_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setHomeId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->home_id !== $v) {
			$this->home_id = $v;
			$this->modifiedColumns[] = HomePeer::HOME_ID;
		}

		return $this;
	} // setHomeId()

	/**
	 * Set the value of [artist_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setArtistId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->artist_id !== $v) {
			$this->artist_id = $v;
			$this->modifiedColumns[] = HomePeer::ARTIST_ID;
		}

		return $this;
	} // setArtistId()

	/**
	 * Set the value of [video_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setVideoId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->video_id !== $v) {
			$this->video_id = $v;
			$this->modifiedColumns[] = HomePeer::VIDEO_ID;
		}

		return $this;
	} // setVideoId()

	/**
	 * Set the value of [event_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setEventId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_id !== $v) {
			$this->event_id = $v;
			$this->modifiedColumns[] = HomePeer::EVENT_ID;
		}

		return $this;
	} // setEventId()

	/**
	 * Set the value of [music_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setMusicId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->music_id !== $v) {
			$this->music_id = $v;
			$this->modifiedColumns[] = HomePeer::MUSIC_ID;
		}

		return $this;
	} // setMusicId()

	/**
	 * Set the value of [music_album_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setMusicAlbumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->music_album_id !== $v) {
			$this->music_album_id = $v;
			$this->modifiedColumns[] = HomePeer::MUSIC_ALBUM_ID;
		}

		return $this;
	} // setMusicAlbumId()

	/**
	 * Set the value of [link] column.
	 * 
	 * @param      string $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->link !== $v) {
			$this->link = $v;
			$this->modifiedColumns[] = HomePeer::LINK;
		}

		return $this;
	} // setLink()

	/**
	 * Set the value of [home_order] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setHomeOrder($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->home_order !== $v) {
			$this->home_order = $v;
			$this->modifiedColumns[] = HomePeer::HOME_ORDER;
		}

		return $this;
	} // setHomeOrder()

	/**
	 * Set the value of [cdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setCdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->cdate !== $v) {
			$this->cdate = $v;
			$this->modifiedColumns[] = HomePeer::CDATE;
		}

		return $this;
	} // setCdate()

	/**
	 * Set the value of [mdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setMdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->mdate !== $v) {
			$this->mdate = $v;
			$this->modifiedColumns[] = HomePeer::MDATE;
		}

		return $this;
	} // setMdate()

	/**
	 * Set the value of [home_cat] column.
	 * 
	 * @param      int $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setHomeCat($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->home_cat !== $v) {
			$this->home_cat = $v;
			$this->modifiedColumns[] = HomePeer::HOME_CAT;
		}

		return $this;
	} // setHomeCat()

	/**
	 * Set the value of [image_path] column.
	 * 
	 * @param      string $v new value
	 * @return     Home The current object (for fluent API support)
	 */
	public function setImagePath($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image_path !== $v) {
			$this->image_path = $v;
			$this->modifiedColumns[] = HomePeer::IMAGE_PATH;
		}

		return $this;
	} // setImagePath()

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
			if ($this->artist_id !== 0) {
				return false;
			}

			if ($this->video_id !== 0) {
				return false;
			}

			if ($this->event_id !== 0) {
				return false;
			}

			if ($this->music_id !== 0) {
				return false;
			}

			if ($this->music_album_id !== 0) {
				return false;
			}

			if ($this->link !== '') {
				return false;
			}

			if ($this->home_order !== 0) {
				return false;
			}

			if ($this->cdate !== 0) {
				return false;
			}

			if ($this->mdate !== 0) {
				return false;
			}

			if ($this->home_cat !== 0) {
				return false;
			}

			if ($this->image_path !== '') {
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

			$this->home_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->artist_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->video_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->event_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->music_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->music_album_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->link = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->home_order = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->cdate = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->mdate = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->home_cat = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->image_path = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 12; // 12 = HomePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Home object", $e);
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
			$con = Propel::getConnection(HomePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = HomePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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
			$con = Propel::getConnection(HomePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = HomeQuery::create()
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
			$con = Propel::getConnection(HomePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				HomePeer::addInstanceToPool($this);
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

		$this->modifiedColumns[] = HomePeer::HOME_ID;
		if (null !== $this->home_id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . HomePeer::HOME_ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(HomePeer::HOME_ID)) {
			$modifiedColumns[':p' . $index++]  = '`HOME_ID`';
		}
		if ($this->isColumnModified(HomePeer::ARTIST_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ARTIST_ID`';
		}
		if ($this->isColumnModified(HomePeer::VIDEO_ID)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_ID`';
		}
		if ($this->isColumnModified(HomePeer::EVENT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_ID`';
		}
		if ($this->isColumnModified(HomePeer::MUSIC_ID)) {
			$modifiedColumns[':p' . $index++]  = '`MUSIC_ID`';
		}
		if ($this->isColumnModified(HomePeer::MUSIC_ALBUM_ID)) {
			$modifiedColumns[':p' . $index++]  = '`MUSIC_ALBUM_ID`';
		}
		if ($this->isColumnModified(HomePeer::LINK)) {
			$modifiedColumns[':p' . $index++]  = '`LINK`';
		}
		if ($this->isColumnModified(HomePeer::HOME_ORDER)) {
			$modifiedColumns[':p' . $index++]  = '`HOME_ORDER`';
		}
		if ($this->isColumnModified(HomePeer::CDATE)) {
			$modifiedColumns[':p' . $index++]  = '`CDATE`';
		}
		if ($this->isColumnModified(HomePeer::MDATE)) {
			$modifiedColumns[':p' . $index++]  = '`MDATE`';
		}
		if ($this->isColumnModified(HomePeer::HOME_CAT)) {
			$modifiedColumns[':p' . $index++]  = '`HOME_CAT`';
		}
		if ($this->isColumnModified(HomePeer::IMAGE_PATH)) {
			$modifiedColumns[':p' . $index++]  = '`IMAGE_PATH`';
		}

		$sql = sprintf(
			'INSERT INTO `home` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`HOME_ID`':
						$stmt->bindValue($identifier, $this->home_id, PDO::PARAM_INT);
						break;
					case '`ARTIST_ID`':
						$stmt->bindValue($identifier, $this->artist_id, PDO::PARAM_INT);
						break;
					case '`VIDEO_ID`':
						$stmt->bindValue($identifier, $this->video_id, PDO::PARAM_INT);
						break;
					case '`EVENT_ID`':
						$stmt->bindValue($identifier, $this->event_id, PDO::PARAM_INT);
						break;
					case '`MUSIC_ID`':
						$stmt->bindValue($identifier, $this->music_id, PDO::PARAM_INT);
						break;
					case '`MUSIC_ALBUM_ID`':
						$stmt->bindValue($identifier, $this->music_album_id, PDO::PARAM_INT);
						break;
					case '`LINK`':
						$stmt->bindValue($identifier, $this->link, PDO::PARAM_STR);
						break;
					case '`HOME_ORDER`':
						$stmt->bindValue($identifier, $this->home_order, PDO::PARAM_INT);
						break;
					case '`CDATE`':
						$stmt->bindValue($identifier, $this->cdate, PDO::PARAM_INT);
						break;
					case '`MDATE`':
						$stmt->bindValue($identifier, $this->mdate, PDO::PARAM_INT);
						break;
					case '`HOME_CAT`':
						$stmt->bindValue($identifier, $this->home_cat, PDO::PARAM_INT);
						break;
					case '`IMAGE_PATH`':
						$stmt->bindValue($identifier, $this->image_path, PDO::PARAM_STR);
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
		$this->setHomeId($pk);

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


			if (($retval = HomePeer::doValidate($this, $columns)) !== true) {
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
		$pos = HomePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getHomeId();
				break;
			case 1:
				return $this->getArtistId();
				break;
			case 2:
				return $this->getVideoId();
				break;
			case 3:
				return $this->getEventId();
				break;
			case 4:
				return $this->getMusicId();
				break;
			case 5:
				return $this->getMusicAlbumId();
				break;
			case 6:
				return $this->getLink();
				break;
			case 7:
				return $this->getHomeOrder();
				break;
			case 8:
				return $this->getCdate();
				break;
			case 9:
				return $this->getMdate();
				break;
			case 10:
				return $this->getHomeCat();
				break;
			case 11:
				return $this->getImagePath();
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
		if (isset($alreadyDumpedObjects['Home'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Home'][$this->getPrimaryKey()] = true;
		$keys = HomePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHomeId(),
			$keys[1] => $this->getArtistId(),
			$keys[2] => $this->getVideoId(),
			$keys[3] => $this->getEventId(),
			$keys[4] => $this->getMusicId(),
			$keys[5] => $this->getMusicAlbumId(),
			$keys[6] => $this->getLink(),
			$keys[7] => $this->getHomeOrder(),
			$keys[8] => $this->getCdate(),
			$keys[9] => $this->getMdate(),
			$keys[10] => $this->getHomeCat(),
			$keys[11] => $this->getImagePath(),
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
		$pos = HomePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setHomeId($value);
				break;
			case 1:
				$this->setArtistId($value);
				break;
			case 2:
				$this->setVideoId($value);
				break;
			case 3:
				$this->setEventId($value);
				break;
			case 4:
				$this->setMusicId($value);
				break;
			case 5:
				$this->setMusicAlbumId($value);
				break;
			case 6:
				$this->setLink($value);
				break;
			case 7:
				$this->setHomeOrder($value);
				break;
			case 8:
				$this->setCdate($value);
				break;
			case 9:
				$this->setMdate($value);
				break;
			case 10:
				$this->setHomeCat($value);
				break;
			case 11:
				$this->setImagePath($value);
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
		$keys = HomePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHomeId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setArtistId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVideoId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEventId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMusicId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMusicAlbumId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLink($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setHomeOrder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCdate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setMdate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setHomeCat($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setImagePath($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(HomePeer::DATABASE_NAME);

		if ($this->isColumnModified(HomePeer::HOME_ID)) $criteria->add(HomePeer::HOME_ID, $this->home_id);
		if ($this->isColumnModified(HomePeer::ARTIST_ID)) $criteria->add(HomePeer::ARTIST_ID, $this->artist_id);
		if ($this->isColumnModified(HomePeer::VIDEO_ID)) $criteria->add(HomePeer::VIDEO_ID, $this->video_id);
		if ($this->isColumnModified(HomePeer::EVENT_ID)) $criteria->add(HomePeer::EVENT_ID, $this->event_id);
		if ($this->isColumnModified(HomePeer::MUSIC_ID)) $criteria->add(HomePeer::MUSIC_ID, $this->music_id);
		if ($this->isColumnModified(HomePeer::MUSIC_ALBUM_ID)) $criteria->add(HomePeer::MUSIC_ALBUM_ID, $this->music_album_id);
		if ($this->isColumnModified(HomePeer::LINK)) $criteria->add(HomePeer::LINK, $this->link);
		if ($this->isColumnModified(HomePeer::HOME_ORDER)) $criteria->add(HomePeer::HOME_ORDER, $this->home_order);
		if ($this->isColumnModified(HomePeer::CDATE)) $criteria->add(HomePeer::CDATE, $this->cdate);
		if ($this->isColumnModified(HomePeer::MDATE)) $criteria->add(HomePeer::MDATE, $this->mdate);
		if ($this->isColumnModified(HomePeer::HOME_CAT)) $criteria->add(HomePeer::HOME_CAT, $this->home_cat);
		if ($this->isColumnModified(HomePeer::IMAGE_PATH)) $criteria->add(HomePeer::IMAGE_PATH, $this->image_path);

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
		$criteria = new Criteria(HomePeer::DATABASE_NAME);
		$criteria->add(HomePeer::HOME_ID, $this->home_id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getHomeId();
	}

	/**
	 * Generic method to set the primary key (home_id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setHomeId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getHomeId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Home (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setArtistId($this->getArtistId());
		$copyObj->setVideoId($this->getVideoId());
		$copyObj->setEventId($this->getEventId());
		$copyObj->setMusicId($this->getMusicId());
		$copyObj->setMusicAlbumId($this->getMusicAlbumId());
		$copyObj->setLink($this->getLink());
		$copyObj->setHomeOrder($this->getHomeOrder());
		$copyObj->setCdate($this->getCdate());
		$copyObj->setMdate($this->getMdate());
		$copyObj->setHomeCat($this->getHomeCat());
		$copyObj->setImagePath($this->getImagePath());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setHomeId(NULL); // this is a auto-increment column, so set to default value
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
	 * @return     Home Clone of current object.
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
	 * @return     HomePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new HomePeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->home_id = null;
		$this->artist_id = null;
		$this->video_id = null;
		$this->event_id = null;
		$this->music_id = null;
		$this->music_album_id = null;
		$this->link = null;
		$this->home_order = null;
		$this->cdate = null;
		$this->mdate = null;
		$this->home_cat = null;
		$this->image_path = null;
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
		return (string) $this->exportTo(HomePeer::DEFAULT_STRING_FORMAT);
	}

} // BaseHome
