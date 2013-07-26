<?php
/**
 * Base class that represents a row from the 'video' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseVideo extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'VideoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        VideoPeer
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
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the price field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $price;

	/**
	 * The value for the video field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $video;

	/**
	 * The value for the video_preview field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $video_preview;

	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

	/**
	 * The value for the active field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $active;

	/**
	 * The value for the deleted field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $deleted;

	/**
	 * The value for the from_yt field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $from_yt;

	/**
	 * The value for the status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $status;
	
	/**
	 * The value for the featured field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $featured;
	
	/**
	 * The value for the pay_more field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pay_more;

	/**
	 * The value for the video_length field.
	 * @var        string
	 */
	protected $video_length;
	
	/**
	 * The value for the video_count field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $video_count;
	
	/**
	 * The value for the video_type field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $video_type;
	
	/**
	 * The value for the video_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	/**
	 * The value for the video_date field.
	 * @var        string
	 */
	protected $video_date;

	/**
	 * The value for the video_image field.
	 * Note: this column has a database default value of: '150'
	 * @var        string
	 */
	protected $video_image;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        array VideoPurchase[] Collection to store aggregation of VideoPurchase objects.
	 */
	protected $collVideoPurchases;

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
	protected $videoPurchasesScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->user_id = 0;
		$this->title = '';
		$this->price = 0;
		$this->video = '';
		$this->video_preview = '';
		$this->pdate = 0;
		$this->active = 0;
		$this->deleted = 0;
		$this->from_yt = 0;
		$this->status = 0;
		$this->featured = 0;
		$this->featured = 0;
		$this->pay_more = 0;
		$this->video_type = 1;
		$this->video_date = NULL;
		$this->video_image = '';
	}

	/**
	 * Initializes internal state of BaseVideo object.
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
	 * Get the [price] column value.
	 * 
	 * @return     double
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Get the [video] column value.
	 * 
	 * @return     string
	 */
	public function getVideo()
	{
		return $this->video;
	}

	/**
	 * Get the [video_preview] column value.
	 * 
	 * @return     string
	 */
	public function getVideoPreview()
	{
		return $this->video_preview;
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
	 * Get the [active] column value.
	 * 
	 * @return     int
	 */
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Get the [deleted] column value.
	 * 
	 * @return     int
	 */
	public function getDeleted()
	{
		return $this->deleted;
	}

	/**
	 * Get the [from_yt] column value.
	 * 
	 * @return     int
	 */
	public function getFromYt()
	{
		return $this->from_yt;
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
	 * Get the [featured] column value.
	 * 
	 * @return     int
	 */
	public function getFeatured()
	{
		return $this->featured;
	}
	
	/**
	 * Get the [pay_more] column value.
	 * 
	 * @return     int
	 */
	public function getPayMore()
	{
		return $this->pay_more;
	}

	/**
	 * Get the [video_length] column value.
	 * 
	 * @return     string
	 */
	public function getVideoLength()
	{
		return $this->video_length;
	}
	
	/**
	 * Get the [video_count] column value.
	 * 
	 * @return     int
	 */
	public function getVideoCount()
	{
		return $this->video_count;
	}

	/**
	 * Get the [video_type] column value.
	 * 
	 * @return     int
	 */
	public function getVideoType()
	{
		return $this->video_type;
	}
	
	/**
	 * Get the [optionally formatted] temporal [video_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getVideoDate($format = '%x')
	{
		if ($this->video_date === null) {
			return null;
		}


		if ($this->video_date === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->video_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->video_date, true), $x);
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
	 * Get the [video_image] column value.
	 * 
	 * @return     string
	 */
	public function getVideoImage()
	{
		return $this->video_image;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = VideoPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = VideoPeer::USER_ID;
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
	 * @return     Video The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = VideoPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      double $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = VideoPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [video] column.
	 * 
	 * @param      string $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->video !== $v) {
			$this->video = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO;
		}

		return $this;
	} // setVideo()

	/**
	 * Set the value of [video_preview] column.
	 * 
	 * @param      string $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoPreview($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->video_preview !== $v) {
			$this->video_preview = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_PREVIEW;
		}

		return $this;
	} // setVideoPreview()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = VideoPeer::PDATE;
		}

		return $this;
	} // setPdate()

	/**
	 * Set the value of [active] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = VideoPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [deleted] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setDeleted($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = VideoPeer::DELETED;
		}

		return $this;
	} // setDeleted()

	/**
	 * Set the value of [from_yt] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setFromYt($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->from_yt !== $v) {
			$this->from_yt = $v;
			$this->modifiedColumns[] = VideoPeer::FROM_YT;
		}

		return $this;
	} // setFromYt()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = VideoPeer::STATUS;
		}

		return $this;
	} // setStatus()
	
	/**
	 * Set the value of [featured] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setFeatured($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->featured !== $v) {
			$this->featured = $v;
			$this->modifiedColumns[] = VideoPeer::FEATURED;
		}

		return $this;
	} // setFeatured()
	
	/**
	 * Set the value of [pay_more] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setPayMore($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pay_more !== $v) {
			$this->pay_more = $v;
			$this->modifiedColumns[] = VideoPeer::PAY_MORE;
		}

		return $this;
	} // setPayMore()

	/**
	 * Set the value of [video_length] column.
	 * 
	 * @param      string $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoLength($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->video_length !== $v) {
			$this->video_length = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_LENGTH;
		}

		return $this;
	} // setVideoLength()
	
	/**
	 * Set the value of [video_count] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoCount($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->video_count !== $v) {
			$this->video_count = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_COUNT;
		}

		return $this;
	} // setVideoCount()

	/**
	 * Set the value of [video_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->video_type !== $v) {
			$this->video_type = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_TYPE;
		}

		return $this;
	} // setVideoType()
	
	/**
	 * Sets the value of [video_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoDate($v)
	{
		/*
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->video_date !== null || $dt !== null) {
			$currentDateAsString = ($this->video_date !== null && $tmpDt = new DateTime($this->video_date)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->video_date = $newDateAsString;
				$this->modifiedColumns[] = VideoPeer::VIDEO_DATE;
			}
		} // if either are not null

		return $this;
		*/
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->video_date !== null || $dt !== null) {
			$currentDateAsString = ($this->video_date !== null && $tmpDt = new DateTime($this->video_date)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
				|| ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
				 ) {
				$this->video_date = $newDateAsString;
				$this->modifiedColumns[] = VideoPeer::VIDEO_DATE;
			}
		} // if either are not null

		return $this;
			

	} // setVideoDate()


	/**
	 * Set the value of [video_image] column.
	 * 
	 * @param      string $v new value
	 * @return     Video The current object (for fluent API support)
	 */
	public function setVideoImage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->video_image !== $v) {
			$this->video_image = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_IMAGE;
		}

		return $this;
	} // setVideoImage()

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

			if ($this->title !== '') {
				return false;
			}

			if ($this->price !== 0) {
				return false;
			}

			if ($this->video !== '') {
				return false;
			}

			if ($this->video_preview !== '') {
				return false;
			}

			if ($this->pdate !== 0) {
				return false;
			}

			if ($this->active !== 0) {
				return false;
			}

			if ($this->deleted !== 0) {
				return false;
			}

			if ($this->from_yt !== 0) {
				return false;
			}

			if ($this->status !== 0) {
				return false;
			}
			if ($this->featured !== 0) {
				return false;
			}
			
			if ($this->pay_more !== 0) {
				return false;
			}
			
			if ($this->video_length !== 0) {
				return false;
			}
			
			if ($this->video_count !== 0) {
				return false;
			}

			if ($this->video_type !== 1) {
				return false;
			}

			if ($this->video_image !== '') {
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
			$this->price = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
			$this->video = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->video_preview = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->pdate = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->active = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->deleted = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->from_yt = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->status = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->featured = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->pay_more = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->video_length = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->video_count = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->video_type = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->video_date = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->video_image = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 14; // 11 = VideoPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Video object", $e);
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
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = VideoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->collVideoPurchases = null;

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
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = VideoQuery::create()
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
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				VideoPeer::addInstanceToPool($this);
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

			if ($this->videoPurchasesScheduledForDeletion !== null) {
				if (!$this->videoPurchasesScheduledForDeletion->isEmpty()) {
					VideoPurchaseQuery::create()
						->filterByPrimaryKeys($this->videoPurchasesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->videoPurchasesScheduledForDeletion = null;
				}
			}

			if ($this->collVideoPurchases !== null) {
				foreach ($this->collVideoPurchases as $referrerFK) {
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

		$this->modifiedColumns[] = VideoPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . VideoPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(VideoPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(VideoPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(VideoPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(VideoPeer::PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PRICE`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_PREVIEW)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_PREVIEW`';
		}
		if ($this->isColumnModified(VideoPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(VideoPeer::ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`ACTIVE`';
		}
		if ($this->isColumnModified(VideoPeer::DELETED)) {
			$modifiedColumns[':p' . $index++]  = '`DELETED`';
		}
		if ($this->isColumnModified(VideoPeer::FROM_YT)) {
			$modifiedColumns[':p' . $index++]  = '`FROM_YT`';
		}
		if ($this->isColumnModified(VideoPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(VideoPeer::FEATURED)) {
			$modifiedColumns[':p' . $index++]  = '`FEATURED`';
		}
		if ($this->isColumnModified(VideoPeer::PAY_MORE)) {
			$modifiedColumns[':p' . $index++]  = '`PAY_MORE`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_LENGTH)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_LENGTH`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_COUNT)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_COUNT`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_TYPE`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_DATE`';
		}
		if ($this->isColumnModified(VideoPeer::VIDEO_IMAGE)) {
			$modifiedColumns[':p' . $index++]  = '`VIDEO_IMAGE`';
		}
		$sql = sprintf(
			'INSERT INTO `video` (%s) VALUES (%s)',
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
					case '`PRICE`':
						$stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
						break;
					case '`VIDEO`':
						$stmt->bindValue($identifier, $this->video, PDO::PARAM_STR);
						break;
					case '`VIDEO_PREVIEW`':
						$stmt->bindValue($identifier, $this->video_preview, PDO::PARAM_STR);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
						break;
					case '`ACTIVE`':
						$stmt->bindValue($identifier, $this->active, PDO::PARAM_INT);
						break;
					case '`DELETED`':
						$stmt->bindValue($identifier, $this->deleted, PDO::PARAM_INT);
						break;
					case '`FROM_YT`':
						$stmt->bindValue($identifier, $this->from_yt, PDO::PARAM_INT);
						break;
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`FEATURED`':
						$stmt->bindValue($identifier, $this->featured, PDO::PARAM_INT);
						break;
					case '`PAY_MORE`':
						$stmt->bindValue($identifier, $this->pay_more, PDO::PARAM_INT);
						break;
					case '`VIDEO_LENGTH`':
						$stmt->bindValue($identifier, $this->video_length, PDO::PARAM_STR);
						break;
					case '`VIDEO_COUNT`':
						$stmt->bindValue($identifier, $this->video_count, PDO::PARAM_INT);
						break;
					case '`VIDEO_TYPE`':
						$stmt->bindValue($identifier, $this->video_type, PDO::PARAM_INT);
						break;	
					case '`VIDEO_DATE`':
						$stmt->bindValue($identifier, $this->video_date, PDO::PARAM_STR);
						break;
					case '`VIDEO_IMAGE`':
						$stmt->bindValue($identifier, $this->video_image, PDO::PARAM_STR);
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


			if (($retval = VideoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collVideoPurchases !== null) {
					foreach ($this->collVideoPurchases as $referrerFK) {
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
		$pos = VideoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPrice();
				break;
			case 4:
				return $this->getVideo();
				break;
			case 5:
				return $this->getVideoPreview();
				break;
			case 6:
				return $this->getPdate();
				break;
			case 7:
				return $this->getActive();
				break;
			case 8:
				return $this->getDeleted();
				break;
			case 9:
				return $this->getFromYt();
				break;
			case 10:
				return $this->getStatus();
				break;
			case 11:
				return $this->getFeatured();
				break;
			case 12:
				return $this->getPayMore();
				break;
			case 13:
				return $this->getVideoLength();
				break;
			case 14:
				return $this->getVideoCount();
				break;
			case 15:
				return $this->getVideoType();
				break;	
			case 16:
				return $this->getVideoDate();
				break;
			case 17:
				return $this->getVideoImage();
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
		if (isset($alreadyDumpedObjects['Video'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Video'][$this->getPrimaryKey()] = true;
		$keys = VideoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getPrice(),
			$keys[4] => $this->getVideo(),
			$keys[5] => $this->getVideoPreview(),
			$keys[6] => $this->getPdate(),
			$keys[7] => $this->getActive(),
			$keys[8] => $this->getDeleted(),
			$keys[9] => $this->getFromYt(),
			$keys[10] => $this->getStatus(),
			$keys[11] => $this->getFeatured(),
			$keys[12] => $this->getPayMore(),
			$keys[13] => $this->getVideoLength(),
			$keys[14] => $this->getVideoCount(),
			$keys[15] => $this->getVideoType(),
			$keys[16] => $this->getVideoDate(),			
			$keys[17] => $this->getVideoImage(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collVideoPurchases) {
				$result['VideoPurchases'] = $this->collVideoPurchases->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = VideoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTitle($value);
				break;
			case 3:
				$this->setPrice($value);
				break;
			case 4:
				$this->setVideo($value);
				break;
			case 5:
				$this->setVideoPreview($value);
				break;
			case 6:
				$this->setPdate($value);
				break;
			case 7:
				$this->setActive($value);
				break;
			case 8:
				$this->setDeleted($value);
				break;
			case 9:
				$this->setFromYt($value);
				break;
			case 10:
				$this->setStatus($value);
				break;
			case 11:
				$this->setFeatured($value);
				break;
			case 12:
				$this->setPayMore($value);
				break;
			case 13:
				$this->setVideoLength($value);
				break;
			case 14:
				$this->setVideoCount($value);
				break;
			case 15:
				$this->setVideoType($value);
				break;	
			case 16:
				$this->setVideoDate($value);
				break;
			case 17:
				$this->setVideoImage($value);
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
		$keys = VideoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPrice($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVideo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVideoPreview($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPdate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setActive($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDeleted($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFromYt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStatus($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFeatured($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPayMore($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setVideoLength($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setVideoCount($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setVideoType($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setVideoDate($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setVideoImage($arr[$keys[17]]);
		
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(VideoPeer::DATABASE_NAME);

		if ($this->isColumnModified(VideoPeer::ID)) $criteria->add(VideoPeer::ID, $this->id);
		if ($this->isColumnModified(VideoPeer::USER_ID)) $criteria->add(VideoPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(VideoPeer::TITLE)) $criteria->add(VideoPeer::TITLE, $this->title);
		if ($this->isColumnModified(VideoPeer::PRICE)) $criteria->add(VideoPeer::PRICE, $this->price);
		if ($this->isColumnModified(VideoPeer::VIDEO)) $criteria->add(VideoPeer::VIDEO, $this->video);
		if ($this->isColumnModified(VideoPeer::VIDEO_PREVIEW)) $criteria->add(VideoPeer::VIDEO_PREVIEW, $this->video_preview);
		if ($this->isColumnModified(VideoPeer::PDATE)) $criteria->add(VideoPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(VideoPeer::ACTIVE)) $criteria->add(VideoPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(VideoPeer::DELETED)) $criteria->add(VideoPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(VideoPeer::FROM_YT)) $criteria->add(VideoPeer::FROM_YT, $this->from_yt);
		if ($this->isColumnModified(VideoPeer::STATUS)) $criteria->add(VideoPeer::STATUS, $this->status);
		if ($this->isColumnModified(VideoPeer::FEATURED)) $criteria->add(VideoPeer::FEATURED, $this->featured);
		if ($this->isColumnModified(VideoPeer::PAY_MORE)) $criteria->add(VideoPeer::PAY_MORE, $this->pay_more);
		if ($this->isColumnModified(VideoPeer::VIDEO_LENGTH)) $criteria->add(VideoPeer::VIDEO_LENGTH, $this->video_length);
		if ($this->isColumnModified(VideoPeer::VIDEO_COUNT)) $criteria->add(VideoPeer::VIDEO_COUNT, $this->video_count);
		if ($this->isColumnModified(VideoPeer::VIDEO_TYPE)) $criteria->add(VideoPeer::VIDEO_TYPE, $this->video_type);
		if ($this->isColumnModified(VideoPeer::VIDEO_DATE)) $criteria->add(VideoPeer::VIDEO_DATE, $this->video_date);
		if ($this->isColumnModified(VideoPeer::VIDEO_IMAGE)) $criteria->add(VideoPeer::VIDEO_IMAGE, $this->video_image);

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
		$criteria = new Criteria(VideoPeer::DATABASE_NAME);
		$criteria->add(VideoPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Video (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setPrice($this->getPrice());
		$copyObj->setVideo($this->getVideo());
		$copyObj->setVideoPreview($this->getVideoPreview());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setActive($this->getActive());
		$copyObj->setDeleted($this->getDeleted());
		$copyObj->setFromYt($this->getFromYt());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setFeatured($this->getFeatured());
		$copyObj->setPayMore($this->getPayMore());
		$copyObj->setVideoLength($this->getVideoLength());
		$copyObj->setVideoCount($this->getVideoCount());
		$copyObj->setVideoType($this->getVideoType());
		$copyObj->setVideoDate($this->getVideoDate());
		$copyObj->setVideoImage($this->getVideoImage());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getVideoPurchases() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addVideoPurchase($relObj->copy($deepCopy));
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
	 * @return     Video Clone of current object.
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
	 * @return     VideoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VideoPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Video The current object (for fluent API support)
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
			$v->addVideo($this);
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
				$this->aUser->addVideos($this);
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
		if ('VideoPurchase' == $relationName) {
			return $this->initVideoPurchases();
		}
	}

	/**
	 * Clears out the collVideoPurchases collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addVideoPurchases()
	 */
	public function clearVideoPurchases()
	{
		$this->collVideoPurchases = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collVideoPurchases collection.
	 *
	 * By default this just sets the collVideoPurchases collection to an empty array (like clearcollVideoPurchases());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initVideoPurchases($overrideExisting = true)
	{
		if (null !== $this->collVideoPurchases && !$overrideExisting) {
			return;
		}
		$this->collVideoPurchases = new PropelObjectCollection();
		$this->collVideoPurchases->setModel('VideoPurchase');
	}

	/**
	 * Gets an array of VideoPurchase objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Video is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array VideoPurchase[] List of VideoPurchase objects
	 * @throws     PropelException
	 */
	public function getVideoPurchases($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collVideoPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collVideoPurchases) {
				// return empty collection
				$this->initVideoPurchases();
			} else {
				$collVideoPurchases = VideoPurchaseQuery::create(null, $criteria)
					->filterByVideo($this)
					->find($con);
				if (null !== $criteria) {
					return $collVideoPurchases;
				}
				$this->collVideoPurchases = $collVideoPurchases;
			}
		}
		return $this->collVideoPurchases;
	}

	/**
	 * Sets a collection of VideoPurchase objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $videoPurchases A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setVideoPurchases(PropelCollection $videoPurchases, PropelPDO $con = null)
	{
		$this->videoPurchasesScheduledForDeletion = $this->getVideoPurchases(new Criteria(), $con)->diff($videoPurchases);

		foreach ($videoPurchases as $videoPurchase) {
			// Fix issue with collection modified by reference
			if ($videoPurchase->isNew()) {
				$videoPurchase->setVideo($this);
			}
			$this->addVideoPurchase($videoPurchase);
		}

		$this->collVideoPurchases = $videoPurchases;
	}

	/**
	 * Returns the number of related VideoPurchase objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related VideoPurchase objects.
	 * @throws     PropelException
	 */
	public function countVideoPurchases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collVideoPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collVideoPurchases) {
				return 0;
			} else {
				$query = VideoPurchaseQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByVideo($this)
					->count($con);
			}
		} else {
			return count($this->collVideoPurchases);
		}
	}

	/**
	 * Method called to associate a VideoPurchase object to this object
	 * through the VideoPurchase foreign key attribute.
	 *
	 * @param      VideoPurchase $l VideoPurchase
	 * @return     Video The current object (for fluent API support)
	 */
	public function addVideoPurchase(VideoPurchase $l)
	{
		if ($this->collVideoPurchases === null) {
			$this->initVideoPurchases();
		}
		if (!$this->collVideoPurchases->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddVideoPurchase($l);
		}

		return $this;
	}

	/**
	 * @param	VideoPurchase $videoPurchase The videoPurchase object to add.
	 */
	protected function doAddVideoPurchase($videoPurchase)
	{
		$this->collVideoPurchases[]= $videoPurchase;
		$videoPurchase->setVideo($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Video is new, it will return
	 * an empty collection; or if this Video has previously
	 * been saved, it will retrieve related VideoPurchases from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Video.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array VideoPurchase[] List of VideoPurchase objects
	 */
	public function getVideoPurchasesJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = VideoPurchaseQuery::create(null, $criteria);
		$query->joinWith('User', $join_behavior);

		return $this->getVideoPurchases($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->title = null;
		$this->price = null;
		$this->video = null;
		$this->video_preview = null;
		$this->pdate = null;
		$this->active = null;
		$this->deleted = null;
		$this->from_yt = null;
		$this->status = null;
		$this->featured = null;
		$this->pay_more = null;
		$this->video_length = null;
		$this->video_count = null;
		$this->video_type = null;
		$this->video_date = null;
		$this->video_image = null;
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
			if ($this->collVideoPurchases) {
				foreach ($this->collVideoPurchases as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collVideoPurchases instanceof PropelCollection) {
			$this->collVideoPurchases->clearIterator();
		}
		$this->collVideoPurchases = null;
		$this->aUser = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(VideoPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseVideo
