<?php


/**
 * Base class that represents a row from the 'music' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusic extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'MusicPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MusicPeer
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
	 * The value for the album_id field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $album_id;

	/**
	 * The value for the genre field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $genre;

	/**
	 * The value for the date_release field.
	 * Note: this column has a database default value of: NULL
	 * @var        string
	 */
	protected $date_release;

	/**
	 * The value for the label field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $label;

	/**
	 * The value for the price field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $price;

	/**
	 * The value for the track field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $track;

	/**
	 * The value for the track_preview field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $track_preview;

	/**
	 * The value for the track_length field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $track_length;

	/**
	 * The value for the track_preview_length field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $track_preview_length;

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
	 * The value for the status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $status;
	
	/**
	 * The value for the upc_code field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $upc_code;
	
	/**
	 * The value for the pay_more field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pay_more;

	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        MusicAlbum
	 */
	protected $aMusicAlbum;

	/**
	 * @var        MusicPurchase
	 */
	protected $aMusicPurchase;

	/**
	 * @var        array MusicPurchase[] Collection to store aggregation of MusicPurchase objects.
	 */
	protected $collMusicPurchasesRelatedByMusicId;

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
	protected $musicPurchasesRelatedByMusicIdScheduledForDeletion = null;

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
		$this->album_id = 0;
		$this->genre = '';
		$this->date_release = NULL;
		$this->label = '';
		$this->price = 0;
		$this->track = '';
		$this->track_preview = '';
		$this->track_length = '';
		$this->track_preview_length = '';
		$this->pdate = 0;
		$this->active = 0;
		$this->deleted = 0;
		$this->status = 0;
		$this->upc_code = 0;
		$this->pay_more = 0;
	}

	/**
	 * Initializes internal state of BaseMusic object.
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
	 * Get the [genre] column value.
	 * 
	 * @return     string
	 */
	public function getGenre()
	{
		return $this->genre;
	}

	/**
	 * Get the [optionally formatted] temporal [date_release] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDateRelease($format = '%x')
	{
		if ($this->date_release === null) {
			return null;
		}


		if ($this->date_release === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->date_release);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_release, true), $x);
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
	 * Get the [label] column value.
	 * 
	 * @return     string
	 */
	public function getLabel()
	{
		return $this->label;
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
	 * Get the [track] column value.
	 * 
	 * @return     string
	 */
	public function getTrack()
	{
		return $this->track;
	}

	/**
	 * Get the [track_preview] column value.
	 * 
	 * @return     string
	 */
	public function getTrackPreview()
	{
		return $this->track_preview;
	}

	/**
	 * Get the [track_length] column value.
	 * 
	 * @return     string
	 */
	public function getTrackLength()
	{
		return $this->track_length;
	}

	/**
	 * Get the [track_preview_length] column value.
	 * 
	 * @return     string
	 */
	public function getTrackPreviewLength()
	{
		return $this->track_preview_length;
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
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}
	
	/**
	 * Get the [upc_code] column value.
	 * 
	 * @return     int
	 */
	public function getUpcCode()
	{
		return $this->upc_code;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MusicPeer::ID;
		}

		if ($this->aMusicPurchase !== null && $this->aMusicPurchase->getMusicId() !== $v) {
			$this->aMusicPurchase = null;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = MusicPeer::USER_ID;
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
	 * @return     Music The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = MusicPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [album_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setAlbumId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->album_id !== $v) {
			$this->album_id = $v;
			$this->modifiedColumns[] = MusicPeer::ALBUM_ID;
		}

		if ($this->aMusicAlbum !== null && $this->aMusicAlbum->getId() !== $v) {
			$this->aMusicAlbum = null;
		}

		return $this;
	} // setAlbumId()

	/**
	 * Set the value of [genre] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setGenre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->genre !== $v) {
			$this->genre = $v;
			$this->modifiedColumns[] = MusicPeer::GENRE;
		}

		return $this;
	} // setGenre()

	/**
	 * Sets the value of [date_release] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Music The current object (for fluent API support)
	 */
	public function setDateRelease($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->date_release !== null || $dt !== null) {
			$currentDateAsString = ($this->date_release !== null && $tmpDt = new DateTime($this->date_release)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
				|| ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
				 ) {
				$this->date_release = $newDateAsString;
				$this->modifiedColumns[] = MusicPeer::DATE_RELEASE;
			}
		} // if either are not null

		return $this;
	} // setDateRelease()

	/**
	 * Set the value of [label] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->label !== $v) {
			$this->label = $v;
			$this->modifiedColumns[] = MusicPeer::LABEL;
		}

		return $this;
	} // setLabel()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      double $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = MusicPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Set the value of [track] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setTrack($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->track !== $v) {
			$this->track = $v;
			$this->modifiedColumns[] = MusicPeer::TRACK;
		}

		return $this;
	} // setTrack()

	/**
	 * Set the value of [track_preview] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setTrackPreview($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->track_preview !== $v) {
			$this->track_preview = $v;
			$this->modifiedColumns[] = MusicPeer::TRACK_PREVIEW;
		}

		return $this;
	} // setTrackPreview()

	/**
	 * Set the value of [track_length] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setTrackLength($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->track_length !== $v) {
			$this->track_length = $v;
			$this->modifiedColumns[] = MusicPeer::TRACK_LENGTH;
		}

		return $this;
	} // setTrackLength()

	/**
	 * Set the value of [track_preview_length] column.
	 * 
	 * @param      string $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setTrackPreviewLength($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->track_preview_length !== $v) {
			$this->track_preview_length = $v;
			$this->modifiedColumns[] = MusicPeer::TRACK_PREVIEW_LENGTH;
		}

		return $this;
	} // setTrackPreviewLength()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = MusicPeer::PDATE;
		}

		return $this;
	} // setPdate()

	/**
	 * Set the value of [active] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setActive($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->active !== $v) {
			$this->active = $v;
			$this->modifiedColumns[] = MusicPeer::ACTIVE;
		}

		return $this;
	} // setActive()

	/**
	 * Set the value of [deleted] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setDeleted($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = MusicPeer::DELETED;
		}

		return $this;
	} // setDeleted()
	
	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = MusicPeer::STATUS;
		}

		return $this;
	} // setStatus()
	
	/**
	 * Set the value of [upc_code] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setUpcCode($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->upc_code !== $v) {
			$this->upc_code = $v;
			$this->modifiedColumns[] = MusicPeer::UPC_CODE;
		}

		return $this;
	} // setUpcCode()
	
	/**
	 * Set the value of [pay_more] column.
	 * 
	 * @param      int $v new value
	 * @return     Music The current object (for fluent API support)
	 */
	public function setPayMore($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pay_more !== $v) {
			$this->pay_more = $v;
			$this->modifiedColumns[] = MusicPeer::PAY_MORE;
		}

		return $this;
	} // setPayMore()

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

			if ($this->album_id !== 0) {
				return false;
			}

			if ($this->genre !== '') {
				return false;
			}

			if ($this->date_release !== NULL) {
				return false;
			}

			if ($this->label !== '') {
				return false;
			}

			if ($this->price !== 0) {
				return false;
			}

			if ($this->track !== '') {
				return false;
			}

			if ($this->track_preview !== '') {
				return false;
			}

			if ($this->track_length !== '') {
				return false;
			}

			if ($this->track_preview_length !== '') {
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
			
			if ($this->status !== 0) {
				return false;
			}
			
			if ($this->upc_code !== 0) {
				return false;
			}
			
			if ($this->pay_more !== 0) {
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
			$this->genre = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->date_release = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->label = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->price = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
			$this->track = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->track_preview = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->track_length = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->track_preview_length = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->pdate = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->active = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->deleted = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->status = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->upc_code = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->pay_more = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 18; // 17 = MusicPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Music object", $e);
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

		if ($this->aMusicPurchase !== null && $this->id !== $this->aMusicPurchase->getMusicId()) {
			$this->aMusicPurchase = null;
		}
		if ($this->aUser !== null && $this->user_id !== $this->aUser->getId()) {
			$this->aUser = null;
		}
		if ($this->aMusicAlbum !== null && $this->album_id !== $this->aMusicAlbum->getId()) {
			$this->aMusicAlbum = null;
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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = MusicPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->aMusicAlbum = null;
			$this->aMusicPurchase = null;
			$this->collMusicPurchasesRelatedByMusicId = null;

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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = MusicQuery::create()
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
			$con = Propel::getConnection(MusicPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				MusicPeer::addInstanceToPool($this);
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

			if ($this->aMusicAlbum !== null) {
				if ($this->aMusicAlbum->isModified() || $this->aMusicAlbum->isNew()) {
					$affectedRows += $this->aMusicAlbum->save($con);
				}
				$this->setMusicAlbum($this->aMusicAlbum);
			}

			if ($this->aMusicPurchase !== null) {
				if ($this->aMusicPurchase->isModified() || $this->aMusicPurchase->isNew()) {
					$affectedRows += $this->aMusicPurchase->save($con);
				}
				$this->setMusicPurchase($this->aMusicPurchase);
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

			if ($this->musicPurchasesRelatedByMusicIdScheduledForDeletion !== null) {
				if (!$this->musicPurchasesRelatedByMusicIdScheduledForDeletion->isEmpty()) {
					MusicPurchaseQuery::create()
						->filterByPrimaryKeys($this->musicPurchasesRelatedByMusicIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->musicPurchasesRelatedByMusicIdScheduledForDeletion = null;
				}
			}

			if ($this->collMusicPurchasesRelatedByMusicId !== null) {
				foreach ($this->collMusicPurchasesRelatedByMusicId as $referrerFK) {
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

		$this->modifiedColumns[] = MusicPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . MusicPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(MusicPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(MusicPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(MusicPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(MusicPeer::ALBUM_ID)) {
			$modifiedColumns[':p' . $index++]  = '`ALBUM_ID`';
		}
		if ($this->isColumnModified(MusicPeer::GENRE)) {
			$modifiedColumns[':p' . $index++]  = '`GENRE`';
		}
		if ($this->isColumnModified(MusicPeer::DATE_RELEASE)) {
			$modifiedColumns[':p' . $index++]  = '`DATE_RELEASE`';
		}
		if ($this->isColumnModified(MusicPeer::LABEL)) {
			$modifiedColumns[':p' . $index++]  = '`LABEL`';
		}
		if ($this->isColumnModified(MusicPeer::PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PRICE`';
		}
		if ($this->isColumnModified(MusicPeer::TRACK)) {
			$modifiedColumns[':p' . $index++]  = '`TRACK`';
		}
		if ($this->isColumnModified(MusicPeer::TRACK_PREVIEW)) {
			$modifiedColumns[':p' . $index++]  = '`TRACK_PREVIEW`';
		}
		if ($this->isColumnModified(MusicPeer::TRACK_LENGTH)) {
			$modifiedColumns[':p' . $index++]  = '`TRACK_LENGTH`';
		}
		if ($this->isColumnModified(MusicPeer::TRACK_PREVIEW_LENGTH)) {
			$modifiedColumns[':p' . $index++]  = '`TRACK_PREVIEW_LENGTH`';
		}
		if ($this->isColumnModified(MusicPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(MusicPeer::ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`ACTIVE`';
		}
		if ($this->isColumnModified(MusicPeer::DELETED)) {
			$modifiedColumns[':p' . $index++]  = '`DELETED`';
		}
		
		if ($this->isColumnModified(MusicPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		
		if ($this->isColumnModified(MusicPeer::UPC_CODE)) {
			$modifiedColumns[':p' . $index++]  = '`UPC_CODE`';
		}
		if ($this->isColumnModified(MusicPeer::PAY_MORE)) {
			$modifiedColumns[':p' . $index++]  = '`PAY_MORE`';
		}

		$sql = sprintf(
			'INSERT INTO `music` (%s) VALUES (%s)',
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
					case '`GENRE`':
						$stmt->bindValue($identifier, $this->genre, PDO::PARAM_STR);
						break;
					case '`DATE_RELEASE`':
						$stmt->bindValue($identifier, $this->date_release, PDO::PARAM_STR);
						break;
					case '`LABEL`':
						$stmt->bindValue($identifier, $this->label, PDO::PARAM_STR);
						break;
					case '`PRICE`':
						$stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
						break;
					case '`TRACK`':
						$stmt->bindValue($identifier, $this->track, PDO::PARAM_STR);
						break;
					case '`TRACK_PREVIEW`':
						$stmt->bindValue($identifier, $this->track_preview, PDO::PARAM_STR);
						break;
					case '`TRACK_LENGTH`':
						$stmt->bindValue($identifier, $this->track_length, PDO::PARAM_STR);
						break;
					case '`TRACK_PREVIEW_LENGTH`':
						$stmt->bindValue($identifier, $this->track_preview_length, PDO::PARAM_STR);
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
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`UPC_CODE`':
						$stmt->bindValue($identifier, $this->upc_code, PDO::PARAM_STR);
						break;
					case '`PAY_MORE`':
						$stmt->bindValue($identifier, $this->pay_more, PDO::PARAM_INT);
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

			if ($this->aMusicAlbum !== null) {
				if (!$this->aMusicAlbum->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMusicAlbum->getValidationFailures());
				}
			}

			if ($this->aMusicPurchase !== null) {
				if (!$this->aMusicPurchase->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMusicPurchase->getValidationFailures());
				}
			}


			if (($retval = MusicPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMusicPurchasesRelatedByMusicId !== null) {
					foreach ($this->collMusicPurchasesRelatedByMusicId as $referrerFK) {
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
		$pos = MusicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGenre();
				break;
			case 5:
				return $this->getDateRelease();
				break;
			case 6:
				return $this->getLabel();
				break;
			case 7:
				return $this->getPrice();
				break;
			case 8:
				return $this->getTrack();
				break;
			case 9:
				return $this->getTrackPreview();
				break;
			case 10:
				return $this->getTrackLength();
				break;
			case 11:
				return $this->getTrackPreviewLength();
				break;
			case 12:
				return $this->getPdate();
				break;
			case 13:
				return $this->getActive();
				break;
			case 14:
				return $this->getDeleted();
				break;
			case 15:
				return $this->getStatus();
				break;
			case 16:
				return $this->getUpcCode();
				break;
			case 17:
				return $this->getPayMore();
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
		if (isset($alreadyDumpedObjects['Music'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Music'][$this->getPrimaryKey()] = true;
		$keys = MusicPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getAlbumId(),
			$keys[4] => $this->getGenre(),
			$keys[5] => $this->getDateRelease(),
			$keys[6] => $this->getLabel(),
			$keys[7] => $this->getPrice(),
			$keys[8] => $this->getTrack(),
			$keys[9] => $this->getTrackPreview(),
			$keys[10] => $this->getTrackLength(),
			$keys[11] => $this->getTrackPreviewLength(),
			$keys[12] => $this->getPdate(),
			$keys[13] => $this->getActive(),
			$keys[14] => $this->getDeleted(),
			$keys[15] => $this->getStatus(),
			$keys[16] => $this->getUpcCode(),
			$keys[17] => $this->getPayMore(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aMusicAlbum) {
				$result['MusicAlbum'] = $this->aMusicAlbum->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aMusicPurchase) {
				$result['MusicPurchase'] = $this->aMusicPurchase->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collMusicPurchasesRelatedByMusicId) {
				$result['MusicPurchasesRelatedByMusicId'] = $this->collMusicPurchasesRelatedByMusicId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = MusicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAlbumId($value);
				break;
			case 4:
				$this->setGenre($value);
				break;
			case 5:
				$this->setDateRelease($value);
				break;
			case 6:
				$this->setLabel($value);
				break;
			case 7:
				$this->setPrice($value);
				break;
			case 8:
				$this->setTrack($value);
				break;
			case 9:
				$this->setTrackPreview($value);
				break;
			case 10:
				$this->setTrackLength($value);
				break;
			case 11:
				$this->setTrackPreviewLength($value);
				break;
			case 12:
				$this->setPdate($value);
				break;
			case 13:
				$this->setActive($value);
				break;
			case 14:
				$this->setDeleted($value);
				break;
			case 15:
				$this->setStatus($value);
				break;
			case 16:
				$this->setUpcCode($value);
				break;
			case 17:
				$this->setPayMore($value);
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
		$keys = MusicPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlbumId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setGenre($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDateRelease($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLabel($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPrice($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setTrack($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTrackPreview($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTrackLength($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTrackPreviewLength($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPdate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setActive($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setDeleted($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setStatus($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpcCode($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setPayMore($arr[$keys[17]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MusicPeer::DATABASE_NAME);

		if ($this->isColumnModified(MusicPeer::ID)) $criteria->add(MusicPeer::ID, $this->id);
		if ($this->isColumnModified(MusicPeer::USER_ID)) $criteria->add(MusicPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(MusicPeer::TITLE)) $criteria->add(MusicPeer::TITLE, $this->title);
		if ($this->isColumnModified(MusicPeer::ALBUM_ID)) $criteria->add(MusicPeer::ALBUM_ID, $this->album_id);
		if ($this->isColumnModified(MusicPeer::GENRE)) $criteria->add(MusicPeer::GENRE, $this->genre);
		if ($this->isColumnModified(MusicPeer::DATE_RELEASE)) $criteria->add(MusicPeer::DATE_RELEASE, $this->date_release);
		if ($this->isColumnModified(MusicPeer::LABEL)) $criteria->add(MusicPeer::LABEL, $this->label);
		if ($this->isColumnModified(MusicPeer::PRICE)) $criteria->add(MusicPeer::PRICE, $this->price);
		if ($this->isColumnModified(MusicPeer::TRACK)) $criteria->add(MusicPeer::TRACK, $this->track);
		if ($this->isColumnModified(MusicPeer::TRACK_PREVIEW)) $criteria->add(MusicPeer::TRACK_PREVIEW, $this->track_preview);
		if ($this->isColumnModified(MusicPeer::TRACK_LENGTH)) $criteria->add(MusicPeer::TRACK_LENGTH, $this->track_length);
		if ($this->isColumnModified(MusicPeer::TRACK_PREVIEW_LENGTH)) $criteria->add(MusicPeer::TRACK_PREVIEW_LENGTH, $this->track_preview_length);
		if ($this->isColumnModified(MusicPeer::PDATE)) $criteria->add(MusicPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(MusicPeer::ACTIVE)) $criteria->add(MusicPeer::ACTIVE, $this->active);
		if ($this->isColumnModified(MusicPeer::DELETED)) $criteria->add(MusicPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(MusicPeer::STATUS)) $criteria->add(MusicPeer::STATUS, $this->status);
		if ($this->isColumnModified(MusicPeer::UPC_CODE)) $criteria->add(MusicPeer::UPC_CODE, $this->upc_code);
		if ($this->isColumnModified(MusicPeer::PAY_MORE)) $criteria->add(MusicPeer::PAY_MORE, $this->pay_more);

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
		$criteria = new Criteria(MusicPeer::DATABASE_NAME);
		$criteria->add(MusicPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Music (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setAlbumId($this->getAlbumId());
		$copyObj->setGenre($this->getGenre());
		$copyObj->setDateRelease($this->getDateRelease());
		$copyObj->setLabel($this->getLabel());
		$copyObj->setPrice($this->getPrice());
		$copyObj->setTrack($this->getTrack());
		$copyObj->setTrackPreview($this->getTrackPreview());
		$copyObj->setTrackLength($this->getTrackLength());
		$copyObj->setTrackPreviewLength($this->getTrackPreviewLength());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setActive($this->getActive());
		$copyObj->setDeleted($this->getDeleted());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setUpcCode($this->getUpcCode());
		$copyObj->setPayMore($this->getPayMore());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getMusicPurchasesRelatedByMusicId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMusicPurchaseRelatedByMusicId($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getMusicPurchase();
			if ($relObj) {
				$copyObj->setMusicPurchase($relObj->copy($deepCopy));
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
	 * @return     Music Clone of current object.
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
	 * @return     MusicPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MusicPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Music The current object (for fluent API support)
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
			$v->addMusic($this);
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
				$this->aUser->addMusics($this);
			 */
		}
		return $this->aUser;
	}

	/**
	 * Declares an association between this object and a MusicAlbum object.
	 *
	 * @param      MusicAlbum $v
	 * @return     Music The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMusicAlbum(MusicAlbum $v = null)
	{
		if ($v === null) {
			$this->setAlbumId(0);
		} else {
			$this->setAlbumId($v->getId());
		}

		$this->aMusicAlbum = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the MusicAlbum object, it will not be re-added.
		if ($v !== null) {
			$v->addMusic($this);
		}

		return $this;
	}


	/**
	 * Get the associated MusicAlbum object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     MusicAlbum The associated MusicAlbum object.
	 * @throws     PropelException
	 */
	public function getMusicAlbum(PropelPDO $con = null)
	{
		if ($this->aMusicAlbum === null && ($this->album_id !== null)) {
			$this->aMusicAlbum = MusicAlbumQuery::create()->findPk($this->album_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aMusicAlbum->addMusics($this);
			 */
		}
		return $this->aMusicAlbum;
	}

	/**
	 * Declares an association between this object and a MusicPurchase object.
	 *
	 * @param      MusicPurchase $v
	 * @return     Music The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setMusicPurchase(MusicPurchase $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getMusicId());
		}

		$this->aMusicPurchase = $v;

		// Add binding for other direction of this 1:1 relationship.
		if ($v !== null) {
			$v->setMusicRelatedById($this);
		}

		return $this;
	}


	/**
	 * Get the associated MusicPurchase object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     MusicPurchase The associated MusicPurchase object.
	 * @throws     PropelException
	 */
	public function getMusicPurchase(PropelPDO $con = null)
	{
		if ($this->aMusicPurchase === null && ($this->id !== null)) {
			$this->aMusicPurchase = MusicPurchaseQuery::create()
				->filterByMusicRelatedById($this) // here
				->findOne($con);
			// Because this foreign key represents a one-to-one relationship, we will create a bi-directional association.
			$this->aMusicPurchase->setMusicRelatedById($this);
		}
		return $this->aMusicPurchase;
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
		if ('MusicPurchaseRelatedByMusicId' == $relationName) {
			return $this->initMusicPurchasesRelatedByMusicId();
		}
	}

	/**
	 * Clears out the collMusicPurchasesRelatedByMusicId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMusicPurchasesRelatedByMusicId()
	 */
	public function clearMusicPurchasesRelatedByMusicId()
	{
		$this->collMusicPurchasesRelatedByMusicId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMusicPurchasesRelatedByMusicId collection.
	 *
	 * By default this just sets the collMusicPurchasesRelatedByMusicId collection to an empty array (like clearcollMusicPurchasesRelatedByMusicId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMusicPurchasesRelatedByMusicId($overrideExisting = true)
	{
		if (null !== $this->collMusicPurchasesRelatedByMusicId && !$overrideExisting) {
			return;
		}
		$this->collMusicPurchasesRelatedByMusicId = new PropelObjectCollection();
		$this->collMusicPurchasesRelatedByMusicId->setModel('MusicPurchase');
	}

	/**
	 * Gets an array of MusicPurchase objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Music is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MusicPurchase[] List of MusicPurchase objects
	 * @throws     PropelException
	 */
	public function getMusicPurchasesRelatedByMusicId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMusicPurchasesRelatedByMusicId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusicPurchasesRelatedByMusicId) {
				// return empty collection
				$this->initMusicPurchasesRelatedByMusicId();
			} else {
				$collMusicPurchasesRelatedByMusicId = MusicPurchaseQuery::create(null, $criteria)
					->filterByMusic($this)
					->find($con);
				if (null !== $criteria) {
					return $collMusicPurchasesRelatedByMusicId;
				}
				$this->collMusicPurchasesRelatedByMusicId = $collMusicPurchasesRelatedByMusicId;
			}
		}
		return $this->collMusicPurchasesRelatedByMusicId;
	}

	/**
	 * Sets a collection of MusicPurchaseRelatedByMusicId objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $musicPurchasesRelatedByMusicId A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setMusicPurchasesRelatedByMusicId(PropelCollection $musicPurchasesRelatedByMusicId, PropelPDO $con = null)
	{
		$this->musicPurchasesRelatedByMusicIdScheduledForDeletion = $this->getMusicPurchasesRelatedByMusicId(new Criteria(), $con)->diff($musicPurchasesRelatedByMusicId);

		foreach ($musicPurchasesRelatedByMusicId as $musicPurchaseRelatedByMusicId) {
			// Fix issue with collection modified by reference
			if ($musicPurchaseRelatedByMusicId->isNew()) {
				$musicPurchaseRelatedByMusicId->setMusic($this);
			}
			$this->addMusicPurchaseRelatedByMusicId($musicPurchaseRelatedByMusicId);
		}

		$this->collMusicPurchasesRelatedByMusicId = $musicPurchasesRelatedByMusicId;
	}

	/**
	 * Returns the number of related MusicPurchase objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MusicPurchase objects.
	 * @throws     PropelException
	 */
	public function countMusicPurchasesRelatedByMusicId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMusicPurchasesRelatedByMusicId || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusicPurchasesRelatedByMusicId) {
				return 0;
			} else {
				$query = MusicPurchaseQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByMusic($this)
					->count($con);
			}
		} else {
			return count($this->collMusicPurchasesRelatedByMusicId);
		}
	}

	/**
	 * Method called to associate a MusicPurchase object to this object
	 * through the MusicPurchase foreign key attribute.
	 *
	 * @param      MusicPurchase $l MusicPurchase
	 * @return     Music The current object (for fluent API support)
	 */
	public function addMusicPurchaseRelatedByMusicId(MusicPurchase $l)
	{
		if ($this->collMusicPurchasesRelatedByMusicId === null) {
			$this->initMusicPurchasesRelatedByMusicId();
		}
		if (!$this->collMusicPurchasesRelatedByMusicId->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddMusicPurchaseRelatedByMusicId($l);
		}

		return $this;
	}

	/**
	 * @param	MusicPurchaseRelatedByMusicId $musicPurchaseRelatedByMusicId The musicPurchaseRelatedByMusicId object to add.
	 */
	protected function doAddMusicPurchaseRelatedByMusicId($musicPurchaseRelatedByMusicId)
	{
		$this->collMusicPurchasesRelatedByMusicId[]= $musicPurchaseRelatedByMusicId;
		$musicPurchaseRelatedByMusicId->setMusic($this);
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
		$this->genre = null;
		$this->date_release = null;
		$this->label = null;
		$this->price = null;
		$this->track = null;
		$this->track_preview = null;
		$this->track_length = null;
		$this->track_preview_length = null;
		$this->pdate = null;
		$this->active = null;
		$this->deleted = null;
		$this->status = null;
		$this->upc_code = null;
		$this->pay_more = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->applyDefaultValues();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
		$this->setStatus(false);
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
			if ($this->collMusicPurchasesRelatedByMusicId) {
				foreach ($this->collMusicPurchasesRelatedByMusicId as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collMusicPurchasesRelatedByMusicId instanceof PropelCollection) {
			$this->collMusicPurchasesRelatedByMusicId->clearIterator();
		}
		$this->collMusicPurchasesRelatedByMusicId = null;
		$this->aUser = null;
		$this->aMusicAlbum = null;
		$this->aMusicPurchase = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(MusicPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseMusic
