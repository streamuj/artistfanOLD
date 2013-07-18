<?php


/**
 * Base class that represents a row from the 'event' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEvent extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'EventPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        EventPeer
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
	 * The value for the descr field.
	 * @var        string
	 */
	protected $descr;

	/**
	 * The value for the event_type field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $event_type;

	/**
	 * The value for the location field.
	 * @var        string
	 */
	protected $location;

	/**
	 * The value for the price field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $price;

	/**
	 * The value for the event_date field.
	 * @var        string
	 */
	protected $event_date;

	/**
	 * The value for the code field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $code;

	/**
	 * The value for the ticket_url field.
	 * @var        string
	 */
	protected $ticket_url;
	/**
	 * The value for the pdate field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $pdate;

	/**
	 * The value for the status field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the deleted field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $deleted;
	
	/**
	 * The value for the event_photo field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $event_photo;

	/**
	 * The value for the event_app field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $event_app;

	/**
	 * The value for the duration field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $duration;
		
	/**
	 * @var        User
	 */
	protected $aUser;

	/**
	 * @var        array EventAttend[] Collection to store aggregation of EventAttend objects.
	 */
	protected $collEventAttends;

	/**
	 * @var        array EventPurchase[] Collection to store aggregation of EventPurchase objects.
	 */
	protected $collEventPurchases;

	/**
	 * @var        array EventVideo[] Collection to store aggregation of EventVideo objects.
	 */
	protected $collEventVideos;

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
	protected $eventAttendsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $eventPurchasesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $eventVideosScheduledForDeletion = null;

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
		$this->event_type = 0;
		$this->price = 0;
		$this->code = '';
		$this->ticket_url = '';
		$this->pdate = 0;
		$this->status = 1;
		$this->deleted = 0;
		$this->event_photo = '';
		$this->event_app = 0;
		$this->duration = 0;
	}

	/**
	 * Initializes internal state of BaseEvent object.
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
	 * Get the [descr] column value.
	 * 
	 * @return     string
	 */
	public function getDescr()
	{
		return $this->descr;
	}

	/**
	 * Get the [event_type] column value.
	 * 
	 * @return     int
	 */
	public function getEventType()
	{
		return $this->event_type;
	}

	/**
	 * Get the [location] column value.
	 * 
	 * @return     string
	 */
	public function getLocation()
	{
		return $this->location;
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
	 * Get the [optionally formatted] temporal [event_date] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getEventDate($format = 'Y-m-d H:i:s')
	{
		if ($this->event_date === null) {
			return null;
		}


		if ($this->event_date === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->event_date);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->event_date, true), $x);
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
	 * Get the [code] column value.
	 * 
	 * @return     string
	 */
	public function getCode()
	{
		return $this->code;
	}
	/**
	 * Get the [ticket_url] column value.
	 * 
	 * @return     string
	 */
	public function getTicketUrl()
	{
		return $this->ticket_url;
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
	 * Get the [status] column value.
	 * 
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
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
	 * Get the [event_photo] column value.
	 * 
	 * @return     string
	 */
	public function getEventPhoto()
	{
		return $this->event_photo;
	}

	/**
	 * Get the [event_app] column value.
	 * 
	 * @return     int
	 */
	public function getEventApp()
	{
		return $this->event_app;
	}
	
	/**
	 * Get the [duration] column value.
	 * 
	 * @return     int
	 */
	public function getDuration()
	{
		return $this->duration;
	}
		
	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = EventPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setUserId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = EventPeer::USER_ID;
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
	 * @return     Event The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = EventPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [descr] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setDescr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->descr !== $v) {
			$this->descr = $v;
			$this->modifiedColumns[] = EventPeer::DESCR;
		}

		return $this;
	} // setDescr()

	/**
	 * Set the value of [event_type] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventType($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_type !== $v) {
			$this->event_type = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_TYPE;
		}

		return $this;
	} // setEventType()

	/**
	 * Set the value of [location] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setLocation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = EventPeer::LOCATION;
		}

		return $this;
	} // setLocation()

	/**
	 * Set the value of [price] column.
	 * 
	 * @param      double $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setPrice($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->price !== $v) {
			$this->price = $v;
			$this->modifiedColumns[] = EventPeer::PRICE;
		}

		return $this;
	} // setPrice()

	/**
	 * Sets the value of [event_date] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventDate($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->event_date !== null || $dt !== null) {
			$currentDateAsString = ($this->event_date !== null && $tmpDt = new DateTime($this->event_date)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->event_date = $newDateAsString;
				$this->modifiedColumns[] = EventPeer::EVENT_DATE;
			}
		} // if either are not null

		return $this;
	} // setEventDate()

	/**
	 * Set the value of [code] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setCode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->code !== $v) {
			$this->code = $v;
			$this->modifiedColumns[] = EventPeer::CODE;
		}

		return $this;
	} // setCode()
	
	/**
	 * Set the value of [ticket_url] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setTicketUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ticket_url !== $v) {
			$this->ticket_url = $v;
			$this->modifiedColumns[] = EventPeer::TICKET_URL;
		}

		return $this;
	} // setTicketUrl()

	/**
	 * Set the value of [pdate] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setPdate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->pdate !== $v) {
			$this->pdate = $v;
			$this->modifiedColumns[] = EventPeer::PDATE;
		}

		return $this;
	} // setPdate()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = EventPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [deleted] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setDeleted($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->deleted !== $v) {
			$this->deleted = $v;
			$this->modifiedColumns[] = EventPeer::DELETED;
		}

		return $this;
	} // setDeleted()
	
	/**
	 * Set the value of [event_photo] column.
	 * 
	 * @param      string $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventPhoto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->event_photo !== $v) {
			$this->event_photo = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_PHOTO;
		}

		return $this;
	} // setEventPhoto()
	
	/**
	 * Set the value of [event_app] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setEventApp($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->event_app !== $v) {
			$this->event_app = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_APP;
		}

		return $this;
	} // setEventApp()
		
	/**
	 * Set the value of [duration] column.
	 * 
	 * @param      int $v new value
	 * @return     Event The current object (for fluent API support)
	 */
	public function setDuration($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->duration !== $v) {
			$this->duration = $v;
			$this->modifiedColumns[] = EventPeer::DURATION;
		}

		return $this;
	} // setDuration()
	
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

			if ($this->event_type !== 0) {
				return false;
			}

			if ($this->price !== 0) {
				return false;
			}

			if ($this->code !== '') {
				return false;
			}
			
			if ($this->ticket_url !== '') {
				return false;
			}

			if ($this->pdate !== 0) {
				return false;
			}

			if ($this->status !== 1) {
				return false;
			}

			if ($this->deleted !== 0) {
				return false;
			}
			
			if ($this->event_photo !== '') {
				return false;
			}

			if ($this->event_app !== 0) {
				return false;
			}
			
			if ($this->duration !== 0) {
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
			$this->descr = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->event_type = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->location = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->price = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
			$this->event_date = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->code = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ticket_url = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->pdate = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->status = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->deleted = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->event_photo = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->event_app = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->duration = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 14; // 12 = EventPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Event object", $e);
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = EventPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aUser = null;
			$this->collEventAttends = null;

			$this->collEventPurchases = null;

			$this->collEventVideos = null;

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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = EventQuery::create()
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				EventPeer::addInstanceToPool($this);
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

			if ($this->eventAttendsScheduledForDeletion !== null) {
				if (!$this->eventAttendsScheduledForDeletion->isEmpty()) {
					EventAttendQuery::create()
						->filterByPrimaryKeys($this->eventAttendsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->eventAttendsScheduledForDeletion = null;
				}
			}

			if ($this->collEventAttends !== null) {
				foreach ($this->collEventAttends as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->eventPurchasesScheduledForDeletion !== null) {
				if (!$this->eventPurchasesScheduledForDeletion->isEmpty()) {
					EventPurchaseQuery::create()
						->filterByPrimaryKeys($this->eventPurchasesScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->eventPurchasesScheduledForDeletion = null;
				}
			}

			if ($this->collEventPurchases !== null) {
				foreach ($this->collEventPurchases as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->eventVideosScheduledForDeletion !== null) {
				if (!$this->eventVideosScheduledForDeletion->isEmpty()) {
					EventVideoQuery::create()
						->filterByPrimaryKeys($this->eventVideosScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->eventVideosScheduledForDeletion = null;
				}
			}

			if ($this->collEventVideos !== null) {
				foreach ($this->collEventVideos as $referrerFK) {
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

		$this->modifiedColumns[] = EventPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . EventPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(EventPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(EventPeer::USER_ID)) {
			$modifiedColumns[':p' . $index++]  = '`USER_ID`';
		}
		if ($this->isColumnModified(EventPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(EventPeer::DESCR)) {
			$modifiedColumns[':p' . $index++]  = '`DESCR`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_TYPE`';
		}
		if ($this->isColumnModified(EventPeer::LOCATION)) {
			$modifiedColumns[':p' . $index++]  = '`LOCATION`';
		}
		if ($this->isColumnModified(EventPeer::PRICE)) {
			$modifiedColumns[':p' . $index++]  = '`PRICE`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_DATE`';
		}
		if ($this->isColumnModified(EventPeer::CODE)) {
			$modifiedColumns[':p' . $index++]  = '`CODE`';
		}
		if ($this->isColumnModified(EventPeer::TICKET_URL)) {
			$modifiedColumns[':p' . $index++]  = '`TICKET_URL`';
		}
		if ($this->isColumnModified(EventPeer::PDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PDATE`';
		}
		if ($this->isColumnModified(EventPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(EventPeer::DELETED)) {
			$modifiedColumns[':p' . $index++]  = '`DELETED`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_PHOTO)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_PHOTO`';
		}
		if ($this->isColumnModified(EventPeer::EVENT_APP)) {
			$modifiedColumns[':p' . $index++]  = '`EVENT_APP`';
		}		
		if ($this->isColumnModified(EventPeer::DURATION)) {
			$modifiedColumns[':p' . $index++]  = '`DURATION`';
		}		
		$sql = sprintf(
			'INSERT INTO `event` (%s) VALUES (%s)',
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
					case '`DESCR`':
						$stmt->bindValue($identifier, $this->descr, PDO::PARAM_STR);
						break;
					case '`EVENT_TYPE`':
						$stmt->bindValue($identifier, $this->event_type, PDO::PARAM_INT);
						break;
					case '`LOCATION`':
						$stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
						break;
					case '`PRICE`':
						$stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
						break;
					case '`EVENT_DATE`':
						$stmt->bindValue($identifier, $this->event_date, PDO::PARAM_STR);
						break;
					case '`CODE`':
						$stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
						break;
					case '`TICKET_URL`':
						$stmt->bindValue($identifier, $this->ticket_url, PDO::PARAM_STR);
						break;
					case '`PDATE`':
						$stmt->bindValue($identifier, $this->pdate, PDO::PARAM_INT);
						break;
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`DELETED`':
						$stmt->bindValue($identifier, $this->deleted, PDO::PARAM_INT);
						break;
					case '`EVENT_PHOTO`':
						$stmt->bindValue($identifier, $this->event_photo, PDO::PARAM_STR);
						break;
					case '`EVENT_APP`':
						$stmt->bindValue($identifier, $this->event_app, PDO::PARAM_INT);
						break;	
					case '`DURATION`':
						$stmt->bindValue($identifier, $this->duration, PDO::PARAM_INT);
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


			if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collEventAttends !== null) {
					foreach ($this->collEventAttends as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventPurchases !== null) {
					foreach ($this->collEventPurchases as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventVideos !== null) {
					foreach ($this->collEventVideos as $referrerFK) {
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDescr();
				break;
			case 4:
				return $this->getEventType();
				break;
			case 5:
				return $this->getLocation();
				break;
			case 6:
				return $this->getPrice();
				break;
			case 7:
				return $this->getEventDate();
				break;
			case 8:
				return $this->getCode();
				break;
			case 9:
				return $this->getTicketUrl();
				break;
			case 10:
				return $this->getPdate();
				break;
			case 11:
				return $this->getStatus();
				break;
			case 12:
				return $this->getDeleted();
				break;
			case 13:
				return $this->getEventPhoto();
				break;
			case 14:
				return $this->getEventApp();
				break;	
			case 15:
				return $this->getDuration();
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
		if (isset($alreadyDumpedObjects['Event'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Event'][$this->getPrimaryKey()] = true;
		$keys = EventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserId(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getDescr(),
			$keys[4] => $this->getEventType(),
			$keys[5] => $this->getLocation(),
			$keys[6] => $this->getPrice(),
			$keys[7] => $this->getEventDate(),
			$keys[8] => $this->getCode(),
			$keys[9] => $this->getTicketUrl(),
			$keys[10] => $this->getPdate(),
			$keys[11] => $this->getStatus(),
			$keys[12] => $this->getDeleted(),
			$keys[13] => $this->getEventPhoto(),
			$keys[14] => $this->getEventApp(),	
			$keys[15] => $this->getDuration(),		
		);
		if ($includeForeignObjects) {
			if (null !== $this->aUser) {
				$result['User'] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collEventAttends) {
				$result['EventAttends'] = $this->collEventAttends->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collEventPurchases) {
				$result['EventPurchases'] = $this->collEventPurchases->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collEventVideos) {
				$result['EventVideos'] = $this->collEventVideos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDescr($value);
				break;
			case 4:
				$this->setEventType($value);
				break;
			case 5:
				$this->setLocation($value);
				break;
			case 6:
				$this->setPrice($value);
				break;
			case 7:
				$this->setEventDate($value);
				break;
			case 8:
				$this->setCode($value);
				break;
			case 9:
				$this->setTicketUrl($value);
				break;
			case 10:
				$this->setPdate($value);
				break;
			case 11:
				$this->setStatus($value);
				break;
			case 12:
				$this->setDeleted($value);
				break;
			case 13:
				$this->setEventPhoto($value);
				break;
			case 14:
				$this->setEventApp($value);
				break;	
			case 15:
				$this->setDuration($value);
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
		$keys = EventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescr($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEventType($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLocation($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrice($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEventDate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCode($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTicketUrl($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPdate($arr[$keys[9]]);
		if (array_key_exists($keys[11], $arr)) $this->setStatus($arr[$keys[10]]);
		if (array_key_exists($keys[12], $arr)) $this->setDeleted($arr[$keys[11]]);
		if (array_key_exists($keys[13], $arr)) $this->setEventPhoto($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEventApp($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDuration($arr[$keys[15]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPeer::ID)) $criteria->add(EventPeer::ID, $this->id);
		if ($this->isColumnModified(EventPeer::USER_ID)) $criteria->add(EventPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(EventPeer::TITLE)) $criteria->add(EventPeer::TITLE, $this->title);
		if ($this->isColumnModified(EventPeer::DESCR)) $criteria->add(EventPeer::DESCR, $this->descr);
		if ($this->isColumnModified(EventPeer::EVENT_TYPE)) $criteria->add(EventPeer::EVENT_TYPE, $this->event_type);
		if ($this->isColumnModified(EventPeer::LOCATION)) $criteria->add(EventPeer::LOCATION, $this->location);
		if ($this->isColumnModified(EventPeer::PRICE)) $criteria->add(EventPeer::PRICE, $this->price);
		if ($this->isColumnModified(EventPeer::EVENT_DATE)) $criteria->add(EventPeer::EVENT_DATE, $this->event_date);
		if ($this->isColumnModified(EventPeer::CODE)) $criteria->add(EventPeer::CODE, $this->code);
		if ($this->isColumnModified(EventPeer::TICKET_URL)) $criteria->add(EventPeer::TICKET_URL, $this->ticket_url);
		if ($this->isColumnModified(EventPeer::PDATE)) $criteria->add(EventPeer::PDATE, $this->pdate);
		if ($this->isColumnModified(EventPeer::STATUS)) $criteria->add(EventPeer::STATUS, $this->status);
		if ($this->isColumnModified(EventPeer::DELETED)) $criteria->add(EventPeer::DELETED, $this->deleted);
		if ($this->isColumnModified(EventPeer::EVENT_PHOTO)) $criteria->add(EventPeer::EVENT_PHOTO, $this->event_photo);
		if ($this->isColumnModified(EventPeer::EVENT_APP)) $criteria->add(EventPeer::EVENT_APP, $this->event_app);
		if ($this->isColumnModified(EventPeer::DURATION)) $criteria->add(EventPeer::DURATION, $this->duration);

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
		$criteria = new Criteria(EventPeer::DATABASE_NAME);
		$criteria->add(EventPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Event (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setUserId($this->getUserId());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setDescr($this->getDescr());
		$copyObj->setEventType($this->getEventType());
		$copyObj->setLocation($this->getLocation());
		$copyObj->setPrice($this->getPrice());
		$copyObj->setEventDate($this->getEventDate());
		$copyObj->setCode($this->getCode());
		$copyObj->setTicketUrl($this->getTicketUrl());
		$copyObj->setPdate($this->getPdate());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setDeleted($this->getDeleted());
		$copyObj->setEventPhoto($this->getEventPhoto());
		$copyObj->setEventApp($this->getEventApp());
		$copyObj->setDuration($this->getDuration());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getEventAttends() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEventAttend($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEventPurchases() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEventPurchase($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEventVideos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEventVideo($relObj->copy($deepCopy));
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
	 * @return     Event Clone of current object.
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
	 * @return     EventPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new EventPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a User object.
	 *
	 * @param      User $v
	 * @return     Event The current object (for fluent API support)
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
			$v->addEvent($this);
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
				$this->aUser->addEvents($this);
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
		if ('EventAttend' == $relationName) {
			return $this->initEventAttends();
		}
		if ('EventPurchase' == $relationName) {
			return $this->initEventPurchases();
		}
		if ('EventVideo' == $relationName) {
			return $this->initEventVideos();
		}
	}

	/**
	 * Clears out the collEventAttends collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEventAttends()
	 */
	public function clearEventAttends()
	{
		$this->collEventAttends = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEventAttends collection.
	 *
	 * By default this just sets the collEventAttends collection to an empty array (like clearcollEventAttends());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initEventAttends($overrideExisting = true)
	{
		if (null !== $this->collEventAttends && !$overrideExisting) {
			return;
		}
		$this->collEventAttends = new PropelObjectCollection();
		$this->collEventAttends->setModel('EventAttend');
	}

	/**
	 * Gets an array of EventAttend objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Event is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array EventAttend[] List of EventAttend objects
	 * @throws     PropelException
	 */
	public function getEventAttends($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collEventAttends || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventAttends) {
				// return empty collection
				$this->initEventAttends();
			} else {
				$collEventAttends = EventAttendQuery::create(null, $criteria)
					->filterByEvent($this)
					->find($con);
				if (null !== $criteria) {
					return $collEventAttends;
				}
				$this->collEventAttends = $collEventAttends;
			}
		}
		return $this->collEventAttends;
	}

	/**
	 * Sets a collection of EventAttend objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $eventAttends A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setEventAttends(PropelCollection $eventAttends, PropelPDO $con = null)
	{
		$this->eventAttendsScheduledForDeletion = $this->getEventAttends(new Criteria(), $con)->diff($eventAttends);

		foreach ($eventAttends as $eventAttend) {
			// Fix issue with collection modified by reference
			if ($eventAttend->isNew()) {
				$eventAttend->setEvent($this);
			}
			$this->addEventAttend($eventAttend);
		}

		$this->collEventAttends = $eventAttends;
	}

	/**
	 * Returns the number of related EventAttend objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related EventAttend objects.
	 * @throws     PropelException
	 */
	public function countEventAttends(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collEventAttends || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventAttends) {
				return 0;
			} else {
				$query = EventAttendQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByEvent($this)
					->count($con);
			}
		} else {
			return count($this->collEventAttends);
		}
	}

	/**
	 * Method called to associate a EventAttend object to this object
	 * through the EventAttend foreign key attribute.
	 *
	 * @param      EventAttend $l EventAttend
	 * @return     Event The current object (for fluent API support)
	 */
	public function addEventAttend(EventAttend $l)
	{
		if ($this->collEventAttends === null) {
			$this->initEventAttends();
		}
		if (!$this->collEventAttends->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddEventAttend($l);
		}

		return $this;
	}

	/**
	 * @param	EventAttend $eventAttend The eventAttend object to add.
	 */
	protected function doAddEventAttend($eventAttend)
	{
		$this->collEventAttends[]= $eventAttend;
		$eventAttend->setEvent($this);
	}

	/**
	 * Clears out the collEventPurchases collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEventPurchases()
	 */
	public function clearEventPurchases()
	{
		$this->collEventPurchases = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEventPurchases collection.
	 *
	 * By default this just sets the collEventPurchases collection to an empty array (like clearcollEventPurchases());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initEventPurchases($overrideExisting = true)
	{
		if (null !== $this->collEventPurchases && !$overrideExisting) {
			return;
		}
		$this->collEventPurchases = new PropelObjectCollection();
		$this->collEventPurchases->setModel('EventPurchase');
	}

	/**
	 * Gets an array of EventPurchase objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Event is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array EventPurchase[] List of EventPurchase objects
	 * @throws     PropelException
	 */
	public function getEventPurchases($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collEventPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventPurchases) {
				// return empty collection
				$this->initEventPurchases();
			} else {
				$collEventPurchases = EventPurchaseQuery::create(null, $criteria)
					->filterByEvent($this)
					->find($con);
				if (null !== $criteria) {
					return $collEventPurchases;
				}
				$this->collEventPurchases = $collEventPurchases;
			}
		}
		return $this->collEventPurchases;
	}

	/**
	 * Sets a collection of EventPurchase objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $eventPurchases A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setEventPurchases(PropelCollection $eventPurchases, PropelPDO $con = null)
	{
		$this->eventPurchasesScheduledForDeletion = $this->getEventPurchases(new Criteria(), $con)->diff($eventPurchases);

		foreach ($eventPurchases as $eventPurchase) {
			// Fix issue with collection modified by reference
			if ($eventPurchase->isNew()) {
				$eventPurchase->setEvent($this);
			}
			$this->addEventPurchase($eventPurchase);
		}

		$this->collEventPurchases = $eventPurchases;
	}

	/**
	 * Returns the number of related EventPurchase objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related EventPurchase objects.
	 * @throws     PropelException
	 */
	public function countEventPurchases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collEventPurchases || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventPurchases) {
				return 0;
			} else {
				$query = EventPurchaseQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByEvent($this)
					->count($con);
			}
		} else {
			return count($this->collEventPurchases);
		}
	}

	/**
	 * Method called to associate a EventPurchase object to this object
	 * through the EventPurchase foreign key attribute.
	 *
	 * @param      EventPurchase $l EventPurchase
	 * @return     Event The current object (for fluent API support)
	 */
	public function addEventPurchase(EventPurchase $l)
	{
		if ($this->collEventPurchases === null) {
			$this->initEventPurchases();
		}
		if (!$this->collEventPurchases->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddEventPurchase($l);
		}

		return $this;
	}

	/**
	 * @param	EventPurchase $eventPurchase The eventPurchase object to add.
	 */
	protected function doAddEventPurchase($eventPurchase)
	{
		$this->collEventPurchases[]= $eventPurchase;
		$eventPurchase->setEvent($this);
	}

	/**
	 * Clears out the collEventVideos collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEventVideos()
	 */
	public function clearEventVideos()
	{
		$this->collEventVideos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEventVideos collection.
	 *
	 * By default this just sets the collEventVideos collection to an empty array (like clearcollEventVideos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initEventVideos($overrideExisting = true)
	{
		if (null !== $this->collEventVideos && !$overrideExisting) {
			return;
		}
		$this->collEventVideos = new PropelObjectCollection();
		$this->collEventVideos->setModel('EventVideo');
	}

	/**
	 * Gets an array of EventVideo objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Event is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array EventVideo[] List of EventVideo objects
	 * @throws     PropelException
	 */
	public function getEventVideos($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collEventVideos || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventVideos) {
				// return empty collection
				$this->initEventVideos();
			} else {
				$collEventVideos = EventVideoQuery::create(null, $criteria)
					->filterByEvent($this)
					->find($con);
				if (null !== $criteria) {
					return $collEventVideos;
				}
				$this->collEventVideos = $collEventVideos;
			}
		}
		return $this->collEventVideos;
	}

	/**
	 * Sets a collection of EventVideo objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $eventVideos A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setEventVideos(PropelCollection $eventVideos, PropelPDO $con = null)
	{
		$this->eventVideosScheduledForDeletion = $this->getEventVideos(new Criteria(), $con)->diff($eventVideos);

		foreach ($eventVideos as $eventVideo) {
			// Fix issue with collection modified by reference
			if ($eventVideo->isNew()) {
				$eventVideo->setEvent($this);
			}
			$this->addEventVideo($eventVideo);
		}

		$this->collEventVideos = $eventVideos;
	}

	/**
	 * Returns the number of related EventVideo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related EventVideo objects.
	 * @throws     PropelException
	 */
	public function countEventVideos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collEventVideos || null !== $criteria) {
			if ($this->isNew() && null === $this->collEventVideos) {
				return 0;
			} else {
				$query = EventVideoQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByEvent($this)
					->count($con);
			}
		} else {
			return count($this->collEventVideos);
		}
	}

	/**
	 * Method called to associate a EventVideo object to this object
	 * through the EventVideo foreign key attribute.
	 *
	 * @param      EventVideo $l EventVideo
	 * @return     Event The current object (for fluent API support)
	 */
	public function addEventVideo(EventVideo $l)
	{
		if ($this->collEventVideos === null) {
			$this->initEventVideos();
		}
		if (!$this->collEventVideos->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddEventVideo($l);
		}

		return $this;
	}

	/**
	 * @param	EventVideo $eventVideo The eventVideo object to add.
	 */
	protected function doAddEventVideo($eventVideo)
	{
		$this->collEventVideos[]= $eventVideo;
		$eventVideo->setEvent($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Event is new, it will return
	 * an empty collection; or if this Event has previously
	 * been saved, it will retrieve related EventVideos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Event.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array EventVideo[] List of EventVideo objects
	 */
	public function getEventVideosJoinUser($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = EventVideoQuery::create(null, $criteria);
		$query->joinWith('User', $join_behavior);

		return $this->getEventVideos($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_id = null;
		$this->title = null;
		$this->descr = null;
		$this->event_type = null;
		$this->location = null;
		$this->price = null;
		$this->event_date = null;
		$this->code = null;
		$this->ticket_url = null;
		$this->pdate = null;
		$this->status = null;
		$this->deleted = null;
		$this->event_photo = null;
		$this->event_app = null;
		$this->duration = null;		
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
			if ($this->collEventAttends) {
				foreach ($this->collEventAttends as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEventPurchases) {
				foreach ($this->collEventPurchases as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEventVideos) {
				foreach ($this->collEventVideos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collEventAttends instanceof PropelCollection) {
			$this->collEventAttends->clearIterator();
		}
		$this->collEventAttends = null;
		if ($this->collEventPurchases instanceof PropelCollection) {
			$this->collEventPurchases->clearIterator();
		}
		$this->collEventPurchases = null;
		if ($this->collEventVideos instanceof PropelCollection) {
			$this->collEventVideos->clearIterator();
		}
		$this->collEventVideos = null;
		$this->aUser = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(EventPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseEvent
