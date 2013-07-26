<?php


/**
 * Base class that represents a row from the 'photo' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BasePhoto extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'PhotoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PhotoPeer
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
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the album_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $album_id;

	/**
	 * The value for the photo_date field.
	 * Note: this column has a database default value of: NULL
	 * @var        string
	 */
	protected $photo_date;

	/**
	 * The value for the image field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $image;

	/**
	 * The value for the is_cover field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_cover;

	/**
	 * The value for the slide field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $slide;

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
	 * The value for the link field.
	 * @var        string
	 */
	protected $link;
	
	/**
	 * The value for the is_new field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_new;	
	
	/**
	 * The value for the wall_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $wall_id;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        PhotoAlbum
	 */
	protected $aPhotoAlbum;

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
		$this->album_id = 0;
		$this->photo_date = NULL;
		$this->image = '';
		$this->is_cover = 0;
		$this->slide = 0;
		$this->price = 0;
		$this->pdate = 0;
		$this->is_new = 0;	
		$this->wall_id = 0;	
	}

	/**
	 * Initializes internal state of BasePhoto object.
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
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
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
	 * Get the [optionally formatted] temporal [photo_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getPhotoDate($format = '%x')
	{
		if ($this->photo_date === null) {
			return null;
		}


		if ($this->photo_date === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->photo_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->photo_date, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [image] column value.
	 * 
	 * @return     string
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * Get the [is_cover] column value.
	 * 
	 * @return     int
	 */
	public function getIsCover()
	{
		return $this->is_cover;
	}

	/**
	 * Get the [slide] column value.
	 * 
	 * @return     int
	 */
	public function getSlide()
	{
		return $this->slide;
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
	 * Get the [pdate] column value.
	 * 
	 * @return     int
	 */
	public function getPdate()
	{
		return $this->pdate;
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
	 * Get the [is_new] column value.
	 * 
	 * @return     int
	 */
	public function getIsNew()
	{
		return $this->is_new;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PhotoPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = PhotoPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
		}

		return $this;
	} // setUserId()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = PhotoPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [album_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setAlbumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->album_id !== $v) {
			$this->album_id = $v;
			$this->modifiedColumns[] = PhotoPeer::ALBUM_ID;
		}

		if ($this->aPhotoAlbum !== null && $this->aPhotoAlbum->getId() !== $v) {
			$this->aPhotoAlbum = null;
		}

		return $this;
	} // setAlbumId()

	/**
	 * Sets the value of [photo_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setPhotoDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->photo_date !== null || $dt !== null) {
			$currentDateAsString = ($this->photo_date !== null && $tmpDt = new DateTime($this->photo_date)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
				|| ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
				 ) {
				$this->photo_date = $newDateAsString;
				$this->modifiedColumns[] = PhotoPeer::PHOTO_DATE;
			}
		} // if either are not null

		return $this;
	} // setPhotoDate()

	/**
	 * Set the value of [image] column.
	 * 
	 * @param      string $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image !== $v) {
			$this->image = $v;
			$this->modifiedColumns[] = PhotoPeer::IMAGE;
		}

		return $this;
	} // setImage()

	/**
	 * Set the value of [is_cover] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setIsCover($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_cover !== $v) {
			$this->is_cover = $v;
			$this->modifiedColumns[] = PhotoPeer::IS_COVER;
		}

		return $this;
	} // setIsCover()

	/**
	 * Set the value of [slide] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setSlide($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->slide !== $v) {
			$this->slide = $v;
			$this->modifiedColumns[] = PhotoPeer::SLIDE;
		}

		return $this;
	} // setSlide()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      double $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = PhotoPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = PhotoPeer::PDATE;
		}

		return $this;
	} // setPdate()

	/**
	 * Set the value of [link] column.
	 * 
	 * @param      string $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->link !== $v) {
			$this->link = $v;
			$this->modifiedColumns[] = PhotoPeer::LINK;
		}

		return $this;
	} // setLink()

	/**
	 * Set the value of [is_new] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setIsNew($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_new !== $v) {
			$this->is_new = $v;
			$this->modifiedColumns[] = PhotoPeer::IS_NEW;
		}

		return $this;
	} // setIsNew()
	
	/**
	 * Set the value of [wall_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Photo The current object (for fluent API support)
	 */
	public function setWallId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->wall_id !== $v) {
			$this->wall_id = $v;
			$this->modifiedColumns[] = PhotoPeer::WALL_ID;
		}

		return $this;
	} // setWallId()

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

			if ($this->album_id !== 0) {
				return false;
			}

			if ($this->photo_date !== NULL) {
				return false;
			}

			if ($this->image !== '') {
				return false;
			}

			if ($this->is_cover !== 0) {
				return false;
			}

			if ($this->slide !== 0) {
				return false;
			}

			if ($this->price !== 0) {
				return false;
			}

			if ($this->pdate !== 0) {
				return false;
			}

			if ($this->is_new !== 0) {
				return false;
			}	
			
			if ($this->wall_id !== 0) {
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
			$this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->album_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->photo_date = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->image = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->is_cover = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->slide = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->price = ($row[$startcol + 8] !== null) ? (double) $row[$startcol + 8] : null;
			$this->pdate = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->link = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->is_new = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->wall_id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = PhotoPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Photo object", $e);
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
		if ($this->aPhotoAlbum !== null && $this->album_id !== $this->aPhotoAlbum->getId()) {
			$this->aPhotoAlbum = null;
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
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = PhotoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->aPhotoAlbum = null;
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
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = PhotoQuery::create()
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
			$con = Propel::getConnection(PhotoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				PhotoPeer::addInstanceToPool($this);
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

			if ($this->aPhotoAlbum !== null) {
				if ($this->aPhotoAlbum->isModified() || $this->aPhotoAlbum->isNew()) {
					$affectedRows += $this->aPhotoAlbum->save($con);
				}
				$this->setPhotoAlbum($this->aPhotoAlbum);
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

			if ($this->photoPurchasesScheduledForDeletion !== null) {
				if (!$this->photoPurchasesScheduledForDeletion->isEmpty()) {
					PhotoPurchaseQuery::create()
						->filterByPrimaryKeys($this->photoPurchasesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->photoPurchasesScheduledForDeletion = null;
				}
			}

			if ($this->collPhotoPurchases !== null) {
				foreach ($this->collPhotoPurchases as $referrerFK) {
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

		$this->modifiedColumns[] = PhotoPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . PhotoPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(PhotoPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(PhotoPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(PhotoPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(PhotoPeer::ALBUM_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ALBUM_ID`';
		}
		if ($this->isColumnModified(PhotoPeer::PHOTO_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`PHOTO_DATE`';
		}
		if ($this->isColumnModified(PhotoPeer::IMAGE)) {
			$modifiedColumns[':p' . $index++]  = '`IMAGE`';
		}
		if ($this->isColumnModified(PhotoPeer::IS_COVER)) {
			$modifiedColumns[':p' . $index++]  = '`IS_COVER`';
		}
		if ($this->isColumnModified(PhotoPeer::SLIDE)) {
			$modifiedColumns[':p' . $index++]  = '`SLIDE`';
		}
		if ($this->isColumnModified(PhotoPeer::PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PRICE`';
		}
		if ($this->isColumnModified(PhotoPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(PhotoPeer::LINK)) {
			$modifiedColumns[':p' . $index++]  = '`LINK`';
		}
		if ($this->isColumnModified(PhotoPeer::IS_NEW)) {
			$modifiedColumns[':p' . $index++]  = '`IS_NEW`';
		}
		if ($this->isColumnModified(PhotoPeer::WALL_ID)) {
			$modifiedColumns[':p' . $index++]  = '`WALL_ID`';
		}		

		$sql = sprintf(
			'INSERT INTO `photo` (%s) VALUES (%s)',
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
					case '`TITLE`':
						$stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
						break;
					case '`ALBUM_ID`':
						$stmt->bindValue($identifier, $this->album_id, PDO::PARAM_INT);
						break;
					case '`PHOTO_DATE`':
						$stmt->bindValue($identifier, $this->photo_date, PDO::PARAM_STR);
						break;
					case '`IMAGE`':
						$stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
						break;
					case '`IS_COVER`':
						$stmt->bindValue($identifier, $this->is_cover, PDO::PARAM_INT);
						break;
					case '`SLIDE`':
						$stmt->bindValue($identifier, $this->slide, PDO::PARAM_INT);
						break;
					case '`PRICE`':
						$stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
						break;
					case '`LINK`':
						$stmt->bindValue($identifier, $this->link, PDO::PARAM_STR);
						break;
					case '`IS_NEW`':
						$stmt->bindValue($identifier, $this->is_new, PDO::PARAM_INT);
						break;		
					case '`WALL_ID`':
						$stmt->bindValue($identifier, $this->wall_id, PDO::PARAM_INT);
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

			if ($this->aPhotoAlbum !== null) {
				if (!$this->aPhotoAlbum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPhotoAlbum->getValidationFailures());
				}
			}


			if (($retval = PhotoPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTitle();
				break;
			case 3:
				return $this->getAlbumId();
				break;
			case 4:
				return $this->getPhotoDate();
				break;
			case 5:
				return $this->getImage();
				break;
			case 6:
				return $this->getIsCover();
				break;
			case 7:
				return $this->getSlide();
				break;
			case 8:
				return $this->getPrice();
				break;
			case 9:
				return $this->getPdate();
				break;
			case 10:
				return $this->getLink();
				break;
			case 11:
				return $this->getIsNew();
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
		if (isset($alreadyDumpedObjects['Photo'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Photo'][$this->getPrimaryKey()] = true;
		$keys = PhotoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getAlbumId(),
			$keys[4] => $this->getPhotoDate(),
			$keys[5] => $this->getImage(),
			$keys[6] => $this->getIsCover(),
			$keys[7] => $this->getSlide(),
			$keys[8] => $this->getPrice(),
			$keys[9] => $this->getPdate(),
			$keys[10] => $this->getLink(),
			$keys[11] => $this->getIsNew(),			

		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aPhotoAlbum) {
				$result['PhotoAlbum'] = $this->aPhotoAlbum->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
		$pos = PhotoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 3:
				$this->setAlbumId($value);
				break;
			case 4:
				$this->setPhotoDate($value);
				break;
			case 5:
				$this->setImage($value);
				break;
			case 6:
				$this->setIsCover($value);
				break;
			case 7:
				$this->setSlide($value);
				break;
			case 8:
				$this->setPrice($value);
				break;
			case 9:
				$this->setPdate($value);
				break;
			case 10:
				$this->setLink($value);
				break;
			case 11:
				$this->setIsNew($value);
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
		$keys = PhotoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlbumId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPhotoDate($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setImage($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIsCover($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSlide($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPrice($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPdate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLink($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIsNew($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PhotoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PhotoPeer::ID)) $criteria->add(PhotoPeer::ID, $this->id);
		if ($this->isColumnModified(PhotoPeer::USER_ID)) $criteria->add(PhotoPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(PhotoPeer::TITLE)) $criteria->add(PhotoPeer::TITLE, $this->title);
		if ($this->isColumnModified(PhotoPeer::ALBUM_ID)) $criteria->add(PhotoPeer::ALBUM_ID, $this->album_id);
		if ($this->isColumnModified(PhotoPeer::PHOTO_DATE)) $criteria->add(PhotoPeer::PHOTO_DATE, $this->photo_date);
		if ($this->isColumnModified(PhotoPeer::IMAGE)) $criteria->add(PhotoPeer::IMAGE, $this->image);
		if ($this->isColumnModified(PhotoPeer::IS_COVER)) $criteria->add(PhotoPeer::IS_COVER, $this->is_cover);
		if ($this->isColumnModified(PhotoPeer::SLIDE)) $criteria->add(PhotoPeer::SLIDE, $this->slide);
		if ($this->isColumnModified(PhotoPeer::PRICE)) $criteria->add(PhotoPeer::PRICE, $this->price);
		if ($this->isColumnModified(PhotoPeer::PDATE)) $criteria->add(PhotoPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(PhotoPeer::LINK)) $criteria->add(PhotoPeer::LINK, $this->link);
		if ($this->isColumnModified(PhotoPeer::IS_NEW)) $criteria->add(PhotoPeer::IS_NEW, $this->is_new);
		if ($this->isColumnModified(PhotoPeer::WALL_ID)) $criteria->add(PhotoPeer::WALL_ID, $this->wall_id);

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
		$criteria = new Criteria(PhotoPeer::DATABASE_NAME);
		$criteria->add(PhotoPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Photo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setAlbumId($this->getAlbumId());
		$copyObj->setPhotoDate($this->getPhotoDate());
		$copyObj->setImage($this->getImage());
		$copyObj->setIsCover($this->getIsCover());
		$copyObj->setSlide($this->getSlide());
		$copyObj->setPrice($this->getPrice());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setLink($this->getLink());
		$copyObj->setIsNew($this->getIsNew());

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
	 * @return     Photo Clone of current object.
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
	 * @return     PhotoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PhotoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Photo The current object (for fluent API support)
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
			$v->addPhoto($this);
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
				$this->aUser->addPhotos($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a PhotoAlbum object.
	 *
	 * @param      PhotoAlbum $v
	 * @return     Photo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setPhotoAlbum(PhotoAlbum $v = null)
	{
		if ($v === null) {
			$this->setAlbumId(0);
		} else {
			$this->setAlbumId($v->getId());
		}

		$this->aPhotoAlbum = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the PhotoAlbum object, it will not be re-added.
		if ($v !== null) {
			$v->addPhoto($this);
		}

		return $this;
	}


	/**
	 * Get the associated PhotoAlbum object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     PhotoAlbum The associated PhotoAlbum object.
	 * @throws     PropelException
	 */
	public function getPhotoAlbum(PropelPDO $con = null)
	{
		if ($this->aPhotoAlbum === null && ($this->album_id !== null)) {
			$this->aPhotoAlbum = PhotoAlbumQuery::create()->findPk($this->album_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aPhotoAlbum->addPhotos($this);
			 */
		}
		return $this->aPhotoAlbum;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->title = null;
		$this->album_id = null;
		$this->photo_date = null;
		$this->image = null;
		$this->is_cover = null;
		$this->slide = null;
		$this->price = null;
		$this->pdate = null;
		$this->link = null;
		$this->is_new = null;
		$this->wall_id = null;
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
		$this->aPhotoAlbum = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(PhotoPeer::DEFAULT_STRING_FORMAT);
	}

} // BasePhoto
