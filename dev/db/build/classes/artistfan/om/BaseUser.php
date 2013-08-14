<?php


/**
 * Base class that represents a row from the 'user' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseUser extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'UserPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        UserPeer
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
	 * The value for the email field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $email;

	/**
	 * The value for the status field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the email_confirmed field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $email_confirmed;

	/**
	 * The value for the first_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $first_name;

	/**
	 * The value for the last_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $last_name;

	/**
	 * The value for the band_name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $band_name;

	/**
	 * The value for the name field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the pass field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $pass;

	/**
	 * The value for the avatar field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $avatar;

	/**
	 * The value for the country field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $country;

	/**
	 * The value for the location field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $location;

	/**
	 * The value for the hide_loc field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $hide_loc;

	/**
	 * The value for the zip field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $zip;

	/**
	 * The value for the about field.
	 * @var        string
	 */
	protected $about;

	/**
	 * The value for the likes field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $likes;

	/**
	 * The value for the years_active field.
	 * @var        string
	 */
	protected $years_active;

	/**
	 * The value for the genres field.
	 * @var        string
	 */
	protected $genres;

	/**
	 * The value for the members field.
	 * @var        string
	 */
	protected $members;

	/**
	 * The value for the website field.
	 * @var        string
	 */
	protected $website;

	/**
	 * The value for the bio field.
	 * @var        string
	 */
	protected $bio;

	/**
	 * The value for the record_label field.
	 * @var        string
	 */
	protected $record_label;

	/**
	 * The value for the record_label_link field.
	 * @var        string
	 */
	protected $record_label_link;

	/**
	 * The value for the dob field.
	 * Note: this column has a database default value of: NULL
	 * @var        string
	 */
	protected $dob;

	/**
	 * The value for the gender field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $gender;

	/**
	 * The value for the checksum field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $checksum;

	/**
	 * The value for the ip field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $ip;

	/**
	 * The value for the last_login field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $last_login;

	/**
	 * The value for the last_reload field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $last_reload;

	/**
	 * The value for the blocked field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $blocked;

	/**
	 * The value for the block_reason field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $block_reason;

	/**
	 * The value for the reg_date field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $reg_date;

	/**
	 * The value for the wallet field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $wallet;

	/**
	 * The value for the wallet_block field.
	 * Note: this column has a database default value of: 0
	 * @var        double
	 */
	protected $wallet_block;

	/**
	 * The value for the fb_id field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $fb_id;

	/**
	 * The value for the fb_token field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $fb_token;

	/**
	 * The value for the fb_start field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $fb_start;

	/**
	 * The value for the tw_start field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $tw_start;

	/**
	 * The value for the tw_id field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $tw_id;

	/**
	 * The value for the tw_oauth_token field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $tw_oauth_token;

	/**
	 * The value for the tw_oauth_token_secret field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $tw_oauth_token_secret;

	/**
	 * The value for the featured field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $featured;

	/**
	 * The value for the is_admin field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_admin;
	
	/**
	 * The value for the is_online field.
	 * Note: this column has a database default value of: 0
	 * @var        int
	 */
	protected $is_online;

	/**
	 * The value for the alt_email field.
	 * Note: this column has a database default value of: 0
	 * @var        string
	 */
	protected $alt_email;	
	
	/**
	 * The value for the user_phone field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $user_phone;
	
	/**
	 * The value for the state field.
	 * @var        string
	 */
	protected $state;

	/**
	 * The value for the hash_tag field.
	 * @var        string
	 */
	protected $hash_tag;
	
	/**
	 * The value for the fb_on field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $fb_on;

	/**
	 * The value for the tw_on field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $tw_on;

	/**
	 * The value for the in_on field.
	 * Note: this column has a database default value of: 1
	 * @var        int
	 */
	protected $in_on;
	

	/**
	 * @var        array UserFollow[] Collection to store aggregation of UserFollow objects.
	 */
	protected $collUserFollowsRelatedByUserId;

	/**
	 * @var        array UserFollow[] Collection to store aggregation of UserFollow objects.
	 */
	protected $collUserFollowsRelatedByUserIdFollow;

	/**
	 * @var        array Wall[] Collection to store aggregation of Wall objects.
	 */
	protected $collWallsRelatedByUserId;

	/**
	 * @var        array Wall[] Collection to store aggregation of Wall objects.
	 */
	protected $collWallsRelatedByUserIdFrom;

	/**
	 * @var        array MusicAlbum[] Collection to store aggregation of MusicAlbum objects.
	 */
	protected $collMusicAlbums;

	/**
	 * @var        array Event[] Collection to store aggregation of Event objects.
	 */
	protected $collEvents;

	/**
	 * @var        array Music[] Collection to store aggregation of Music objects.
	 */
	protected $collMusics;

	/**
	 * @var        array Video[] Collection to store aggregation of Video objects.
	 */
	protected $collVideos;

	/**
	 * @var        array VideoPurchase[] Collection to store aggregation of VideoPurchase objects.
	 */
	protected $collVideoPurchases;

	/**
	 * @var        array Payout[] Collection to store aggregation of Payout objects.
	 */
	protected $collPayouts;

	/**
	 * @var        array ShoppingLog[] Collection to store aggregation of ShoppingLog objects.
	 */
	protected $collShoppingLogs;

	/**
	 * @var        array Photo[] Collection to store aggregation of Photo objects.
	 */
	protected $collPhotos;

	/**
	 * @var        array PhotoAlbum[] Collection to store aggregation of PhotoAlbum objects.
	 */
	protected $collPhotoAlbums;

	/**
	 * @var        array PaymentInfo[] Collection to store aggregation of PaymentInfo objects.
	 */
	protected $collPaymentInfos;

	/**
	 * @var        array BroadcastViewers[] Collection to store aggregation of BroadcastViewers objects.
	 */
	protected $collBroadcastViewerss;

	/**
	 * @var        array BroadcastFlows[] Collection to store aggregation of BroadcastFlows objects.
	 */
	protected $collBroadcastFlowss;

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
	protected $userFollowsRelatedByUserIdScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $userFollowsRelatedByUserIdFollowScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $wallsRelatedByUserIdScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $wallsRelatedByUserIdFromScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $musicAlbumsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $eventsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $musicsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $videosScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $videoPurchasesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $payoutsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $shoppingLogsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $photosScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $photoAlbumsScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $paymentInfosScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $broadcastViewerssScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $broadcastFlowssScheduledForDeletion = null;

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
		$this->email = '';
		$this->status = 0;
		$this->email_confirmed = 0;
		$this->first_name = '';
		$this->last_name = '';
		$this->band_name = '';
		$this->name = '';
		$this->pass = '';
		$this->avatar = '';
		$this->country = '';
		$this->location = '';
		$this->hide_loc = 0;
		$this->zip = '';
		$this->likes = '';
		$this->dob = NULL;
		$this->gender = 0;
		$this->checksum = '';
		$this->ip = '';
		$this->last_login = 0;
		$this->last_reload = 0;
		$this->blocked = 0;
		$this->block_reason = '';
		$this->reg_date = 0;
		$this->wallet = 0;
		$this->wallet_block = 0;
		$this->fb_id = '';
		$this->fb_token = '';
		$this->fb_start = 0;
		$this->tw_start = 0;
		$this->tw_id = '';
		$this->tw_oauth_token = '';
		$this->tw_oauth_token_secret = '';
		$this->featured = 0;
		$this->is_admin = 0;
		$this->is_online = 0;
		$this->alt_email = '';
		$this->user_phone = '';
		$this->fb_on = 1;
		$this->tw_on = 1;
		$this->in_on = 1;
		
	}

	/**
	 * Initializes internal state of BaseUser object.
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
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{
		return $this->email;
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
	 * Get the [email_confirmed] column value.
	 * 
	 * @return     int
	 */
	public function getEmailConfirmed()
	{
		return $this->email_confirmed;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getFirstName()
	{
		return $this->first_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getLastName()
	{
		return $this->last_name;
	}

	/**
	 * Get the [band_name] column value.
	 * 
	 * @return     string
	 */
	public function getBandName()
	{
		return $this->band_name;
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [pass] column value.
	 * 
	 * @return     string
	 */
	public function getPass()
	{
		return $this->pass;
	}

	/**
	 * Get the [avatar] column value.
	 * 
	 * @return     string
	 */
	public function getAvatar()
	{
		return $this->avatar;
	}

	/**
	 * Get the [country] column value.
	 * 
	 * @return     string
	 */
	public function getCountry()
	{
		return $this->country;
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
	 * Get the [hide_loc] column value.
	 * 
	 * @return     int
	 */
	public function getHideLoc()
	{
		return $this->hide_loc;
	}

	/**
	 * Get the [zip] column value.
	 * 
	 * @return     string
	 */
	public function getZip()
	{
		return $this->zip;
	}

	/**
	 * Get the [about] column value.
	 * 
	 * @return     string
	 */
	public function getAbout()
	{
		return $this->about;
	}

	/**
	 * Get the [likes] column value.
	 * 
	 * @return     string
	 */
	public function getLikes()
	{
		return $this->likes;
	}

	/**
	 * Get the [years_active] column value.
	 * 
	 * @return     string
	 */
	public function getYearsActive()
	{
		return $this->years_active;
	}

	/**
	 * Get the [genres] column value.
	 * 
	 * @return     string
	 */
	public function getGenres()
	{
		return $this->genres;
	}

	/**
	 * Get the [members] column value.
	 * 
	 * @return     string
	 */
	public function getMembers()
	{
		return $this->members;
	}

	/**
	 * Get the [website] column value.
	 * 
	 * @return     string
	 */
	public function getWebsite()
	{
		return $this->website;
	}

	/**
	 * Get the [bio] column value.
	 * 
	 * @return     string
	 */
	public function getBio()
	{
		return $this->bio;
	}

	/**
	 * Get the [record_label] column value.
	 * 
	 * @return     string
	 */
	public function getRecordLabel()
	{
		return $this->record_label;
	}

	/**
	 * Get the [record_label_link] column value.
	 * 
	 * @return     string
	 */
	public function getRecordLabelLink()
	{
		return $this->record_label_link;
	}

	/**
	 * Get the [optionally formatted] temporal [dob] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getDob($format = '%x')
	{
		if ($this->dob === null) {
			return null;
		}


		if ($this->dob === '0000-00-00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->dob);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->dob, true), $x);
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
	 * Get the [gender] column value.
	 * 
	 * @return     int
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * Get the [checksum] column value.
	 * 
	 * @return     string
	 */
	public function getChecksum()
	{
		return $this->checksum;
	}

	/**
	 * Get the [ip] column value.
	 * 
	 * @return     string
	 */
	public function getIp()
	{
		return $this->ip;
	}

	/**
	 * Get the [last_login] column value.
	 * 
	 * @return     int
	 */
	public function getLastLogin()
	{
		return $this->last_login;
	}

	/**
	 * Get the [last_reload] column value.
	 * 
	 * @return     int
	 */
	public function getLastReload()
	{
		return $this->last_reload;
	}

	/**
	 * Get the [blocked] column value.
	 * 
	 * @return     int
	 */
	public function getBlocked()
	{
		return $this->blocked;
	}

	/**
	 * Get the [block_reason] column value.
	 * 
	 * @return     string
	 */
	public function getBlockReason()
	{
		return $this->block_reason;
	}

	/**
	 * Get the [reg_date] column value.
	 * 
	 * @return     int
	 */
	public function getRegDate()
	{
		return $this->reg_date;
	}

	/**
	 * Get the [wallet] column value.
	 * 
	 * @return     double
	 */
	public function getWallet()
	{
		return $this->wallet;
	}

	/**
	 * Get the [wallet_block] column value.
	 * 
	 * @return     double
	 */
	public function getWalletBlock()
	{
		return $this->wallet_block;
	}

	/**
	 * Get the [fb_id] column value.
	 * 
	 * @return     string
	 */
	public function getFbId()
	{
		return $this->fb_id;
	}

	/**
	 * Get the [fb_token] column value.
	 * 
	 * @return     string
	 */
	public function getFbToken()
	{
		return $this->fb_token;
	}

	/**
	 * Get the [fb_start] column value.
	 * 
	 * @return     int
	 */
	public function getFbStart()
	{
		return $this->fb_start;
	}

	/**
	 * Get the [tw_start] column value.
	 * 
	 * @return     int
	 */
	public function getTwStart()
	{
		return $this->tw_start;
	}

	/**
	 * Get the [tw_id] column value.
	 * 
	 * @return     string
	 */
	public function getTwId()
	{
		return $this->tw_id;
	}

	/**
	 * Get the [tw_oauth_token] column value.
	 * 
	 * @return     string
	 */
	public function getTwOauthToken()
	{
		return $this->tw_oauth_token;
	}

	/**
	 * Get the [tw_oauth_token_secret] column value.
	 * 
	 * @return     string
	 */
	public function getTwOauthTokenSecret()
	{
		return $this->tw_oauth_token_secret;
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
	 * Get the [is_admin] column value.
	 * 
	 * @return     int
	 */
	public function getIsAdmin()
	{
		return $this->is_admin;
	}
	
	/**
	 * Get the [is_online] column value.
	 * 
	 * @return     int
	 */
	public function getIsOnline()
	{
		return $this->is_online;
	}

	/**
	 * Get the [alt_email] column value.
	 * 
	 * @return     string
	 */
	public function getAltEmail()
	{
		return $this->alt_email;
	}	
	
	/**
	 * Get the [user_phone] column value.
	 * 
	 * @return     string
	 */
	public function getUserPhone()
	{
		return $this->user_phone;
	}
	
	/**
	 * Get the [state] column value.
	 * 
	 * @return     string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * Get the [hash_tag] column value.
	 * 
	 * @return     string
	 */
	public function getHashTag()
	{
		return $this->hash_tag;
	}
	
	/**
	 * Get the [fb_on] column value.
	 * 
	 * @return     int
	 */
	public function getFbOn()
	{
		return $this->fb_on;
	}

	/**
	 * Get the [tw_on] column value.
	 * 
	 * @return     int
	 */
	public function getTwOn()
	{
		return $this->tw_on;
	}

	/**
	 * Get the [in_on] column value.
	 * 
	 * @return     int
	 */
	public function getInOn()
	{
		return $this->in_on;
	}	

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UserPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

		return $this;
	} // setEmail()

	/**
	 * Set the value of [status] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = UserPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Set the value of [email_confirmed] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setEmailConfirmed($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->email_confirmed !== $v) {
			$this->email_confirmed = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL_CONFIRMED;
		}

		return $this;
	} // setEmailConfirmed()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = UserPeer::FIRST_NAME;
		}

		return $this;
	} // setFirstName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = UserPeer::LAST_NAME;
		}

		return $this;
	} // setLastName()

	/**
	 * Set the value of [band_name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setBandName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->band_name !== $v) {
			$this->band_name = $v;
			$this->modifiedColumns[] = UserPeer::BAND_NAME;
		}

		return $this;
	} // setBandName()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = UserPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [pass] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setPass($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pass !== $v) {
			$this->pass = $v;
			$this->modifiedColumns[] = UserPeer::PASS;
		}

		return $this;
	} // setPass()

	/**
	 * Set the value of [avatar] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setAvatar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->avatar !== $v) {
			$this->avatar = $v;
			$this->modifiedColumns[] = UserPeer::AVATAR;
		}

		return $this;
	} // setAvatar()

	/**
	 * Set the value of [country] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->country !== $v) {
			$this->country = $v;
			$this->modifiedColumns[] = UserPeer::COUNTRY;
		}

		return $this;
	} // setCountry()

	/**
	 * Set the value of [location] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLocation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = UserPeer::LOCATION;
		}

		return $this;
	} // setLocation()

	/**
	 * Set the value of [hide_loc] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setHideLoc($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->hide_loc !== $v) {
			$this->hide_loc = $v;
			$this->modifiedColumns[] = UserPeer::HIDE_LOC;
		}

		return $this;
	} // setHideLoc()

	/**
	 * Set the value of [zip] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setZip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->zip !== $v) {
			$this->zip = $v;
			$this->modifiedColumns[] = UserPeer::ZIP;
		}

		return $this;
	} // setZip()

	/**
	 * Set the value of [about] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setAbout($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->about !== $v) {
			$this->about = $v;
			$this->modifiedColumns[] = UserPeer::ABOUT;
		}

		return $this;
	} // setAbout()

	/**
	 * Set the value of [likes] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLikes($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->likes !== $v) {
			$this->likes = $v;
			$this->modifiedColumns[] = UserPeer::LIKES;
		}

		return $this;
	} // setLikes()

	/**
	 * Set the value of [years_active] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setYearsActive($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->years_active !== $v) {
			$this->years_active = $v;
			$this->modifiedColumns[] = UserPeer::YEARS_ACTIVE;
		}

		return $this;
	} // setYearsActive()

	/**
	 * Set the value of [genres] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setGenres($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->genres !== $v) {
			$this->genres = $v;
			$this->modifiedColumns[] = UserPeer::GENRES;
		}

		return $this;
	} // setGenres()

	/**
	 * Set the value of [members] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setMembers($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->members !== $v) {
			$this->members = $v;
			$this->modifiedColumns[] = UserPeer::MEMBERS;
		}

		return $this;
	} // setMembers()

	/**
	 * Set the value of [website] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setWebsite($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->website !== $v) {
			$this->website = $v;
			$this->modifiedColumns[] = UserPeer::WEBSITE;
		}

		return $this;
	} // setWebsite()

	/**
	 * Set the value of [bio] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setBio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->bio !== $v) {
			$this->bio = $v;
			$this->modifiedColumns[] = UserPeer::BIO;
		}

		return $this;
	} // setBio()

	/**
	 * Set the value of [record_label] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRecordLabel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->record_label !== $v) {
			$this->record_label = $v;
			$this->modifiedColumns[] = UserPeer::RECORD_LABEL;
		}

		return $this;
	} // setRecordLabel()

	/**
	 * Set the value of [record_label_link] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRecordLabelLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->record_label_link !== $v) {
			$this->record_label_link = $v;
			$this->modifiedColumns[] = UserPeer::RECORD_LABEL_LINK;
		}

		return $this;
	} // setRecordLabelLink()

	/**
	 * Sets the value of [dob] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     User The current object (for fluent API support)
	 */
	public function setDob($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->dob !== null || $dt !== null) {
			$currentDateAsString = ($this->dob !== null && $tmpDt = new DateTime($this->dob)) ? $tmpDt->format('Y-m-d') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d') : null;
			if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
				|| ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
				 ) {
				$this->dob = $newDateAsString;
				$this->modifiedColumns[] = UserPeer::DOB;
			}
		} // if either are not null

		return $this;
	} // setDob()

	/**
	 * Set the value of [gender] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setGender($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->gender !== $v) {
			$this->gender = $v;
			$this->modifiedColumns[] = UserPeer::GENDER;
		}

		return $this;
	} // setGender()

	/**
	 * Set the value of [checksum] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setChecksum($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->checksum !== $v) {
			$this->checksum = $v;
			$this->modifiedColumns[] = UserPeer::CHECKSUM;
		}

		return $this;
	} // setChecksum()

	/**
	 * Set the value of [ip] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setIp($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ip !== $v) {
			$this->ip = $v;
			$this->modifiedColumns[] = UserPeer::IP;
		}

		return $this;
	} // setIp()

	/**
	 * Set the value of [last_login] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLastLogin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->last_login !== $v) {
			$this->last_login = $v;
			$this->modifiedColumns[] = UserPeer::LAST_LOGIN;
		}

		return $this;
	} // setLastLogin()

	/**
	 * Set the value of [last_reload] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setLastReload($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->last_reload !== $v) {
			$this->last_reload = $v;
			$this->modifiedColumns[] = UserPeer::LAST_RELOAD;
		}

		return $this;
	} // setLastReload()

	/**
	 * Set the value of [blocked] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setBlocked($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->blocked !== $v) {
			$this->blocked = $v;
			$this->modifiedColumns[] = UserPeer::BLOCKED;
		}

		return $this;
	} // setBlocked()

	/**
	 * Set the value of [block_reason] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setBlockReason($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->block_reason !== $v) {
			$this->block_reason = $v;
			$this->modifiedColumns[] = UserPeer::BLOCK_REASON;
		}

		return $this;
	} // setBlockReason()

	/**
	 * Set the value of [reg_date] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setRegDate($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->reg_date !== $v) {
			$this->reg_date = $v;
			$this->modifiedColumns[] = UserPeer::REG_DATE;
		}

		return $this;
	} // setRegDate()

	/**
	 * Set the value of [wallet] column.
	 * 
	 * @param      double $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setWallet($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->wallet !== $v) {
			$this->wallet = $v;
			$this->modifiedColumns[] = UserPeer::WALLET;
		}

		return $this;
	} // setWallet()

	/**
	 * Set the value of [wallet_block] column.
	 * 
	 * @param      double $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setWalletBlock($v)
	{
		if ($v !== null) {
			$v = (double) $v;
		}

		if ($this->wallet_block !== $v) {
			$this->wallet_block = $v;
			$this->modifiedColumns[] = UserPeer::WALLET_BLOCK;
		}

		return $this;
	} // setWalletBlock()

	/**
	 * Set the value of [fb_id] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFbId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->fb_id !== $v) {
			$this->fb_id = $v;
			$this->modifiedColumns[] = UserPeer::FB_ID;
		}

		return $this;
	} // setFbId()

	/**
	 * Set the value of [fb_token] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFbToken($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->fb_token !== $v) {
			$this->fb_token = $v;
			$this->modifiedColumns[] = UserPeer::FB_TOKEN;
		}

		return $this;
	} // setFbToken()

	/**
	 * Set the value of [fb_start] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFbStart($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->fb_start !== $v) {
			$this->fb_start = $v;
			$this->modifiedColumns[] = UserPeer::FB_START;
		}

		return $this;
	} // setFbStart()

	/**
	 * Set the value of [tw_start] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setTwStart($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tw_start !== $v) {
			$this->tw_start = $v;
			$this->modifiedColumns[] = UserPeer::TW_START;
		}

		return $this;
	} // setTwStart()

	/**
	 * Set the value of [tw_id] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setTwId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tw_id !== $v) {
			$this->tw_id = $v;
			$this->modifiedColumns[] = UserPeer::TW_ID;
		}

		return $this;
	} // setTwId()

	/**
	 * Set the value of [tw_oauth_token] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setTwOauthToken($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tw_oauth_token !== $v) {
			$this->tw_oauth_token = $v;
			$this->modifiedColumns[] = UserPeer::TW_OAUTH_TOKEN;
		}

		return $this;
	} // setTwOauthToken()

	/**
	 * Set the value of [tw_oauth_token_secret] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setTwOauthTokenSecret($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->tw_oauth_token_secret !== $v) {
			$this->tw_oauth_token_secret = $v;
			$this->modifiedColumns[] = UserPeer::TW_OAUTH_TOKEN_SECRET;
		}

		return $this;
	} // setTwOauthTokenSecret()

	/**
	 * Set the value of [featured] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFeatured($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->featured !== $v) {
			$this->featured = $v;
			$this->modifiedColumns[] = UserPeer::FEATURED;
		}

		return $this;
	} // setFeatured()

	/**
	 * Set the value of [is_admin] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setIsAdmin($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_admin !== $v) {
			$this->is_admin = $v;
			$this->modifiedColumns[] = UserPeer::IS_ADMIN;
		}

		return $this;
	} // setIsAdmin()
	
	/**
	 * Set the value of [is_online] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setIsOnline($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->is_online !== $v) {
			$this->is_online = $v;
			$this->modifiedColumns[] = UserPeer::IS_ONLINE;
		}

		return $this;
	} // setIsOnline()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setAltEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->alt_email !== $v) {
			$this->alt_email = $v;
			$this->modifiedColumns[] = UserPeer::ALT_EMAIL;
		}

		return $this;
	} // setAltEmail()
	
	/**
	 * Set the value of [user_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setUserPhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_phone !== $v) {
			$this->user_phone = $v;
			$this->modifiedColumns[] = UserPeer::USER_PHONE;
		}

		return $this;
	} // setUserPhone()
	
	/**
	 * Set the value of [state] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setState($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->state !== $v) {
			$this->state = $v;
			$this->modifiedColumns[] = UserPeer::STATE;
		}

		return $this;
	} // setState()

	/**
	 * Set the value of [hash_tag] column.
	 * 
	 * @param      string $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setHashTag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->hash_tag !== $v) {
			$this->hash_tag = $v;
			$this->modifiedColumns[] = UserPeer::HASH_TAG;
		}

		return $this;
	} // setHashTag()
	
	/**
	 * Set the value of [fb_on] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setFbOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->fb_on !== $v) {
			$this->fb_on = $v;
			$this->modifiedColumns[] = UserPeer::FB_ON;
		}

		return $this;
	} // setFbOn()

	/**
	 * Set the value of [tw_on] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setTwOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->tw_on !== $v) {
			$this->tw_on = $v;
			$this->modifiedColumns[] = UserPeer::TW_ON;
		}

		return $this;
	} // setTwOn()

	/**
	 * Set the value of [in_on] column.
	 * 
	 * @param      int $v new value
	 * @return     User The current object (for fluent API support)
	 */
	public function setInOn($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->in_on !== $v) {
			$this->in_on = $v;
			$this->modifiedColumns[] = UserPeer::IN_ON;
		}

		return $this;
	} // setInOn()	

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
			if ($this->email !== '') {
				return false;
			}

			if ($this->status !== 0) {
				return false;
			}

			if ($this->email_confirmed !== 0) {
				return false;
			}

			if ($this->first_name !== '') {
				return false;
			}

			if ($this->last_name !== '') {
				return false;
			}

			if ($this->band_name !== '') {
				return false;
			}

			if ($this->name !== '') {
				return false;
			}

			if ($this->pass !== '') {
				return false;
			}

			if ($this->avatar !== '') {
				return false;
			}

			if ($this->country !== '') {
				return false;
			}

			if ($this->location !== '') {
				return false;
			}

			if ($this->hide_loc !== 0) {
				return false;
			}

			if ($this->zip !== '') {
				return false;
			}

			if ($this->likes !== '') {
				return false;
			}

			if ($this->dob !== NULL) {
				return false;
			}

			if ($this->gender !== 0) {
				return false;
			}

			if ($this->checksum !== '') {
				return false;
			}

			if ($this->ip !== '') {
				return false;
			}

			if ($this->last_login !== 0) {
				return false;
			}

			if ($this->last_reload !== 0) {
				return false;
			}

			if ($this->blocked !== 0) {
				return false;
			}

			if ($this->block_reason !== '') {
				return false;
			}

			if ($this->reg_date !== 0) {
				return false;
			}

			if ($this->wallet !== 0) {
				return false;
			}

			if ($this->wallet_block !== 0) {
				return false;
			}

			if ($this->fb_id !== '') {
				return false;
			}

			if ($this->fb_token !== '') {
				return false;
			}

			if ($this->fb_start !== 0) {
				return false;
			}

			if ($this->tw_start !== 0) {
				return false;
			}

			if ($this->tw_id !== '') {
				return false;
			}

			if ($this->tw_oauth_token !== '') {
				return false;
			}

			if ($this->tw_oauth_token_secret !== '') {
				return false;
			}

			if ($this->featured !== 0) {
				return false;
			}

			if ($this->is_admin !== 0) {
				return false;
			}
			
			if ($this->is_online !== 0) {
				return false;
			}
			
			if ($this->alt_email !== '') {
				return false;
			}	
			
			if ($this->user_phone !== '') {
				return false;
			}
			if ($this->fb_on !== 1) {
				return false;
			}

			if ($this->tw_on !== 1) {
				return false;
			}

			if ($this->in_on !== 1) {
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
			$this->email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->status = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->email_confirmed = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->first_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->last_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->band_name = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->name = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->pass = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->avatar = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->country = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->location = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->hide_loc = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->zip = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->about = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->likes = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->years_active = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->genres = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->members = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->website = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->bio = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->record_label = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->record_label_link = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->dob = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->gender = ($row[$startcol + 24] !== null) ? (int) $row[$startcol + 24] : null;
			$this->checksum = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ip = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->last_login = ($row[$startcol + 27] !== null) ? (int) $row[$startcol + 27] : null;
			$this->last_reload = ($row[$startcol + 28] !== null) ? (int) $row[$startcol + 28] : null;
			$this->blocked = ($row[$startcol + 29] !== null) ? (int) $row[$startcol + 29] : null;
			$this->block_reason = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->reg_date = ($row[$startcol + 31] !== null) ? (int) $row[$startcol + 31] : null;
			$this->wallet = ($row[$startcol + 32] !== null) ? (double) $row[$startcol + 32] : null;
			$this->wallet_block = ($row[$startcol + 33] !== null) ? (double) $row[$startcol + 33] : null;
			$this->fb_id = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
			$this->fb_token = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->fb_start = ($row[$startcol + 36] !== null) ? (int) $row[$startcol + 36] : null;
			$this->tw_start = ($row[$startcol + 37] !== null) ? (int) $row[$startcol + 37] : null;
			$this->tw_id = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
			$this->tw_oauth_token = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
			$this->tw_oauth_token_secret = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
			$this->featured = ($row[$startcol + 41] !== null) ? (int) $row[$startcol + 41] : null;
			$this->is_admin = ($row[$startcol + 42] !== null) ? (int) $row[$startcol + 42] : null;
			$this->is_online = ($row[$startcol + 43] !== null) ? (int) $row[$startcol + 43] : null;
			$this->alt_email = ($row[$startcol + 44] !== null) ? (string) $row[$startcol + 44] : null;
			$this->user_phone = ($row[$startcol + 45] !== null) ? (string) $row[$startcol + 45] : null;
			$this->state = ($row[$startcol + 46] !== null) ? (string) $row[$startcol + 46] : null;
			$this->hash_tag = ($row[$startcol + 47] !== null) ? (string) $row[$startcol + 47] : null;
			$this->fb_on = ($row[$startcol + 48] !== null) ? (int) $row[$startcol + 48] : null;
			$this->tw_on = ($row[$startcol + 49] !== null) ? (int) $row[$startcol + 49] : null;
			$this->in_on = ($row[$startcol + 50] !== null) ? (int) $row[$startcol + 50] : null;			
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 45; // 43 = UserPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collUserFollowsRelatedByUserId = null;

			$this->collUserFollowsRelatedByUserIdFollow = null;

			$this->collWallsRelatedByUserId = null;

			$this->collWallsRelatedByUserIdFrom = null;

			$this->collMusicAlbums = null;

			$this->collEvents = null;

			$this->collMusics = null;

			$this->collVideos = null;

			$this->collVideoPurchases = null;

			$this->collPayouts = null;

			$this->collShoppingLogs = null;

			$this->collPhotos = null;

			$this->collPhotoAlbums = null;

			$this->collPaymentInfos = null;

			$this->collBroadcastViewerss = null;

			$this->collBroadcastFlowss = null;

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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = UserQuery::create()
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
				UserPeer::addInstanceToPool($this);
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

			if ($this->userFollowsRelatedByUserIdScheduledForDeletion !== null) {
				if (!$this->userFollowsRelatedByUserIdScheduledForDeletion->isEmpty()) {
					UserFollowQuery::create()
						->filterByPrimaryKeys($this->userFollowsRelatedByUserIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->userFollowsRelatedByUserIdScheduledForDeletion = null;
				}
			}

			if ($this->collUserFollowsRelatedByUserId !== null) {
				foreach ($this->collUserFollowsRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->userFollowsRelatedByUserIdFollowScheduledForDeletion !== null) {
				if (!$this->userFollowsRelatedByUserIdFollowScheduledForDeletion->isEmpty()) {
					UserFollowQuery::create()
						->filterByPrimaryKeys($this->userFollowsRelatedByUserIdFollowScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->userFollowsRelatedByUserIdFollowScheduledForDeletion = null;
				}
			}

			if ($this->collUserFollowsRelatedByUserIdFollow !== null) {
				foreach ($this->collUserFollowsRelatedByUserIdFollow as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->wallsRelatedByUserIdScheduledForDeletion !== null) {
				if (!$this->wallsRelatedByUserIdScheduledForDeletion->isEmpty()) {
					WallQuery::create()
						->filterByPrimaryKeys($this->wallsRelatedByUserIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->wallsRelatedByUserIdScheduledForDeletion = null;
				}
			}

			if ($this->collWallsRelatedByUserId !== null) {
				foreach ($this->collWallsRelatedByUserId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->wallsRelatedByUserIdFromScheduledForDeletion !== null) {
				if (!$this->wallsRelatedByUserIdFromScheduledForDeletion->isEmpty()) {
					WallQuery::create()
						->filterByPrimaryKeys($this->wallsRelatedByUserIdFromScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->wallsRelatedByUserIdFromScheduledForDeletion = null;
				}
			}

			if ($this->collWallsRelatedByUserIdFrom !== null) {
				foreach ($this->collWallsRelatedByUserIdFrom as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->musicAlbumsScheduledForDeletion !== null) {
				if (!$this->musicAlbumsScheduledForDeletion->isEmpty()) {
					MusicAlbumQuery::create()
						->filterByPrimaryKeys($this->musicAlbumsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->musicAlbumsScheduledForDeletion = null;
				}
			}

			if ($this->collMusicAlbums !== null) {
				foreach ($this->collMusicAlbums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->eventsScheduledForDeletion !== null) {
				if (!$this->eventsScheduledForDeletion->isEmpty()) {
					EventQuery::create()
						->filterByPrimaryKeys($this->eventsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->eventsScheduledForDeletion = null;
				}
			}

			if ($this->collEvents !== null) {
				foreach ($this->collEvents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->musicsScheduledForDeletion !== null) {
				if (!$this->musicsScheduledForDeletion->isEmpty()) {
					MusicQuery::create()
						->filterByPrimaryKeys($this->musicsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->musicsScheduledForDeletion = null;
				}
			}

			if ($this->collMusics !== null) {
				foreach ($this->collMusics as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->videosScheduledForDeletion !== null) {
				if (!$this->videosScheduledForDeletion->isEmpty()) {
					VideoQuery::create()
						->filterByPrimaryKeys($this->videosScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->videosScheduledForDeletion = null;
				}
			}

			if ($this->collVideos !== null) {
				foreach ($this->collVideos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
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

			if ($this->shoppingLogsScheduledForDeletion !== null) {
				if (!$this->shoppingLogsScheduledForDeletion->isEmpty()) {
					ShoppingLogQuery::create()
						->filterByPrimaryKeys($this->shoppingLogsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->shoppingLogsScheduledForDeletion = null;
				}
			}

			if ($this->collShoppingLogs !== null) {
				foreach ($this->collShoppingLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->photosScheduledForDeletion !== null) {
				if (!$this->photosScheduledForDeletion->isEmpty()) {
					PhotoQuery::create()
						->filterByPrimaryKeys($this->photosScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->photosScheduledForDeletion = null;
				}
			}

			if ($this->collPhotos !== null) {
				foreach ($this->collPhotos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->photoAlbumsScheduledForDeletion !== null) {
				if (!$this->photoAlbumsScheduledForDeletion->isEmpty()) {
					PhotoAlbumQuery::create()
						->filterByPrimaryKeys($this->photoAlbumsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->photoAlbumsScheduledForDeletion = null;
				}
			}

			if ($this->collPhotoAlbums !== null) {
				foreach ($this->collPhotoAlbums as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->paymentInfosScheduledForDeletion !== null) {
				if (!$this->paymentInfosScheduledForDeletion->isEmpty()) {
					PaymentInfoQuery::create()
						->filterByPrimaryKeys($this->paymentInfosScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->paymentInfosScheduledForDeletion = null;
				}
			}

			if ($this->collPaymentInfos !== null) {
				foreach ($this->collPaymentInfos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->broadcastViewerssScheduledForDeletion !== null) {
				if (!$this->broadcastViewerssScheduledForDeletion->isEmpty()) {
					BroadcastViewersQuery::create()
						->filterByPrimaryKeys($this->broadcastViewerssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->broadcastViewerssScheduledForDeletion = null;
				}
			}

			if ($this->collBroadcastViewerss !== null) {
				foreach ($this->collBroadcastViewerss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->broadcastFlowssScheduledForDeletion !== null) {
				if (!$this->broadcastFlowssScheduledForDeletion->isEmpty()) {
					BroadcastFlowsQuery::create()
						->filterByPrimaryKeys($this->broadcastFlowssScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->broadcastFlowssScheduledForDeletion = null;
				}
			}

			if ($this->collBroadcastFlowss !== null) {
				foreach ($this->collBroadcastFlowss as $referrerFK) {
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

		$this->modifiedColumns[] = UserPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(UserPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(UserPeer::EMAIL)) {
			$modifiedColumns[':p' . $index++]  = '`EMAIL`';
		}
		if ($this->isColumnModified(UserPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(UserPeer::EMAIL_CONFIRMED)) {
			$modifiedColumns[':p' . $index++]  = '`EMAIL_CONFIRMED`';
		}
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`FIRST_NAME`';
		}
		if ($this->isColumnModified(UserPeer::LAST_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_NAME`';
		}
		if ($this->isColumnModified(UserPeer::BAND_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`BAND_NAME`';
		}
		if ($this->isColumnModified(UserPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(UserPeer::PASS)) {
			$modifiedColumns[':p' . $index++]  = '`PASS`';
		}
		if ($this->isColumnModified(UserPeer::AVATAR)) {
			$modifiedColumns[':p' . $index++]  = '`AVATAR`';
		}
		if ($this->isColumnModified(UserPeer::COUNTRY)) {
			$modifiedColumns[':p' . $index++]  = '`COUNTRY`';
		}
		if ($this->isColumnModified(UserPeer::LOCATION)) {
			$modifiedColumns[':p' . $index++]  = '`LOCATION`';
		}
		if ($this->isColumnModified(UserPeer::HIDE_LOC)) {
			$modifiedColumns[':p' . $index++]  = '`HIDE_LOC`';
		}
		if ($this->isColumnModified(UserPeer::ZIP)) {
			$modifiedColumns[':p' . $index++]  = '`ZIP`';
		}
		if ($this->isColumnModified(UserPeer::ABOUT)) {
			$modifiedColumns[':p' . $index++]  = '`ABOUT`';
		}
		if ($this->isColumnModified(UserPeer::LIKES)) {
			$modifiedColumns[':p' . $index++]  = '`LIKES`';
		}
		if ($this->isColumnModified(UserPeer::YEARS_ACTIVE)) {
			$modifiedColumns[':p' . $index++]  = '`YEARS_ACTIVE`';
		}
		if ($this->isColumnModified(UserPeer::GENRES)) {
			$modifiedColumns[':p' . $index++]  = '`GENRES`';
		}
		if ($this->isColumnModified(UserPeer::MEMBERS)) {
			$modifiedColumns[':p' . $index++]  = '`MEMBERS`';
		}
		if ($this->isColumnModified(UserPeer::WEBSITE)) {
			$modifiedColumns[':p' . $index++]  = '`WEBSITE`';
		}
		if ($this->isColumnModified(UserPeer::BIO)) {
			$modifiedColumns[':p' . $index++]  = '`BIO`';
		}
		if ($this->isColumnModified(UserPeer::RECORD_LABEL)) {
			$modifiedColumns[':p' . $index++]  = '`RECORD_LABEL`';
		}
		if ($this->isColumnModified(UserPeer::RECORD_LABEL_LINK)) {
			$modifiedColumns[':p' . $index++]  = '`RECORD_LABEL_LINK`';
		}
		if ($this->isColumnModified(UserPeer::DOB)) {
			$modifiedColumns[':p' . $index++]  = '`DOB`';
		}
		if ($this->isColumnModified(UserPeer::GENDER)) {
			$modifiedColumns[':p' . $index++]  = '`GENDER`';
		}
		if ($this->isColumnModified(UserPeer::CHECKSUM)) {
			$modifiedColumns[':p' . $index++]  = '`CHECKSUM`';
		}
		if ($this->isColumnModified(UserPeer::IP)) {
			$modifiedColumns[':p' . $index++]  = '`IP`';
		}
		if ($this->isColumnModified(UserPeer::LAST_LOGIN)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_LOGIN`';
		}
		if ($this->isColumnModified(UserPeer::LAST_RELOAD)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_RELOAD`';
		}
		if ($this->isColumnModified(UserPeer::BLOCKED)) {
			$modifiedColumns[':p' . $index++]  = '`BLOCKED`';
		}
		if ($this->isColumnModified(UserPeer::BLOCK_REASON)) {
			$modifiedColumns[':p' . $index++]  = '`BLOCK_REASON`';
		}
		if ($this->isColumnModified(UserPeer::REG_DATE)) {
			$modifiedColumns[':p' . $index++]  = '`REG_DATE`';
		}
		if ($this->isColumnModified(UserPeer::WALLET)) {
			$modifiedColumns[':p' . $index++]  = '`WALLET`';
		}
		if ($this->isColumnModified(UserPeer::WALLET_BLOCK)) {
			$modifiedColumns[':p' . $index++]  = '`WALLET_BLOCK`';
		}
		if ($this->isColumnModified(UserPeer::FB_ID)) {
			$modifiedColumns[':p' . $index++]  = '`FB_ID`';
		}
		if ($this->isColumnModified(UserPeer::FB_TOKEN)) {
			$modifiedColumns[':p' . $index++]  = '`FB_TOKEN`';
		}
		if ($this->isColumnModified(UserPeer::FB_START)) {
			$modifiedColumns[':p' . $index++]  = '`FB_START`';
		}
		if ($this->isColumnModified(UserPeer::TW_START)) {
			$modifiedColumns[':p' . $index++]  = '`TW_START`';
		}
		if ($this->isColumnModified(UserPeer::TW_ID)) {
			$modifiedColumns[':p' . $index++]  = '`TW_ID`';
		}
		if ($this->isColumnModified(UserPeer::TW_OAUTH_TOKEN)) {
			$modifiedColumns[':p' . $index++]  = '`TW_OAUTH_TOKEN`';
		}
		if ($this->isColumnModified(UserPeer::TW_OAUTH_TOKEN_SECRET)) {
			$modifiedColumns[':p' . $index++]  = '`TW_OAUTH_TOKEN_SECRET`';
		}
		if ($this->isColumnModified(UserPeer::FEATURED)) {
			$modifiedColumns[':p' . $index++]  = '`FEATURED`';
		}
		if ($this->isColumnModified(UserPeer::IS_ADMIN)) {
			$modifiedColumns[':p' . $index++]  = '`IS_ADMIN`';
		}
		if ($this->isColumnModified(UserPeer::IS_ONLINE)) {
			$modifiedColumns[':p' . $index++]  = '`IS_ONLINE`';
		}
		if ($this->isColumnModified(UserPeer::ALT_EMAIL)) {
			$modifiedColumns[':p' . $index++]  = '`ALT_EMAIL`';
		}
		if ($this->isColumnModified(UserPeer::USER_PHONE)) {
			$modifiedColumns[':p' . $index++]  = '`USER_PHONE`';
		}
		if ($this->isColumnModified(UserPeer::STATE)) {
			$modifiedColumns[':p' . $index++]  = '`STATE`';
		}
		if ($this->isColumnModified(UserPeer::HASH_TAG)) {
			$modifiedColumns[':p' . $index++]  = '`HASH_TAG`';
		}
		if ($this->isColumnModified(UserPeer::FB_ON)) {
			$modifiedColumns[':p' . $index++]  = '`FB_ON`';
		}
		if ($this->isColumnModified(UserPeer::TW_ON)) {
			$modifiedColumns[':p' . $index++]  = '`TW_ON`';
		}
		if ($this->isColumnModified(UserPeer::IN_ON)) {
			$modifiedColumns[':p' . $index++]  = '`IN_ON`';
		}		
		
		$sql = sprintf(
			'INSERT INTO `user` (%s) VALUES (%s)',
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
					case '`EMAIL`':
						$stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
						break;
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`EMAIL_CONFIRMED`':
						$stmt->bindValue($identifier, $this->email_confirmed, PDO::PARAM_INT);
						break;
					case '`FIRST_NAME`':
						$stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
						break;
					case '`LAST_NAME`':
						$stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
						break;
					case '`BAND_NAME`':
						$stmt->bindValue($identifier, $this->band_name, PDO::PARAM_STR);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`PASS`':
						$stmt->bindValue($identifier, $this->pass, PDO::PARAM_STR);
						break;
					case '`AVATAR`':
						$stmt->bindValue($identifier, $this->avatar, PDO::PARAM_STR);
						break;
					case '`COUNTRY`':
						$stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
						break;
					case '`LOCATION`':
						$stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
						break;
					case '`HIDE_LOC`':
						$stmt->bindValue($identifier, $this->hide_loc, PDO::PARAM_INT);
						break;
					case '`ZIP`':
						$stmt->bindValue($identifier, $this->zip, PDO::PARAM_STR);
						break;
					case '`ABOUT`':
						$stmt->bindValue($identifier, $this->about, PDO::PARAM_STR);
						break;
					case '`LIKES`':
						$stmt->bindValue($identifier, $this->likes, PDO::PARAM_STR);
						break;
					case '`YEARS_ACTIVE`':
						$stmt->bindValue($identifier, $this->years_active, PDO::PARAM_STR);
						break;
					case '`GENRES`':
						$stmt->bindValue($identifier, $this->genres, PDO::PARAM_STR);
						break;
					case '`MEMBERS`':
						$stmt->bindValue($identifier, $this->members, PDO::PARAM_STR);
						break;
					case '`WEBSITE`':
						$stmt->bindValue($identifier, $this->website, PDO::PARAM_STR);
						break;
					case '`BIO`':
						$stmt->bindValue($identifier, $this->bio, PDO::PARAM_STR);
						break;
					case '`RECORD_LABEL`':
						$stmt->bindValue($identifier, $this->record_label, PDO::PARAM_STR);
						break;
					case '`RECORD_LABEL_LINK`':
						$stmt->bindValue($identifier, $this->record_label_link, PDO::PARAM_STR);
						break;
					case '`DOB`':
						$stmt->bindValue($identifier, $this->dob, PDO::PARAM_STR);
						break;
					case '`GENDER`':
						$stmt->bindValue($identifier, $this->gender, PDO::PARAM_INT);
						break;
					case '`CHECKSUM`':
						$stmt->bindValue($identifier, $this->checksum, PDO::PARAM_STR);
						break;
					case '`IP`':
						$stmt->bindValue($identifier, $this->ip, PDO::PARAM_STR);
						break;
					case '`LAST_LOGIN`':
						$stmt->bindValue($identifier, $this->last_login, PDO::PARAM_INT);
						break;
					case '`LAST_RELOAD`':
						$stmt->bindValue($identifier, $this->last_reload, PDO::PARAM_INT);
						break;
					case '`BLOCKED`':
						$stmt->bindValue($identifier, $this->blocked, PDO::PARAM_INT);
						break;
					case '`BLOCK_REASON`':
						$stmt->bindValue($identifier, $this->block_reason, PDO::PARAM_STR);
						break;
					case '`REG_DATE`':
						$stmt->bindValue($identifier, $this->reg_date, PDO::PARAM_INT);
						break;
					case '`WALLET`':
						$stmt->bindValue($identifier, $this->wallet, PDO::PARAM_STR);
						break;
					case '`WALLET_BLOCK`':
						$stmt->bindValue($identifier, $this->wallet_block, PDO::PARAM_STR);
						break;
					case '`FB_ID`':
						$stmt->bindValue($identifier, $this->fb_id, PDO::PARAM_STR);
						break;
					case '`FB_TOKEN`':
						$stmt->bindValue($identifier, $this->fb_token, PDO::PARAM_STR);
						break;
					case '`FB_START`':
						$stmt->bindValue($identifier, $this->fb_start, PDO::PARAM_INT);
						break;
					case '`TW_START`':
						$stmt->bindValue($identifier, $this->tw_start, PDO::PARAM_INT);
						break;
					case '`TW_ID`':
						$stmt->bindValue($identifier, $this->tw_id, PDO::PARAM_STR);
						break;
					case '`TW_OAUTH_TOKEN`':
						$stmt->bindValue($identifier, $this->tw_oauth_token, PDO::PARAM_STR);
						break;
					case '`TW_OAUTH_TOKEN_SECRET`':
						$stmt->bindValue($identifier, $this->tw_oauth_token_secret, PDO::PARAM_STR);
						break;
					case '`FEATURED`':
						$stmt->bindValue($identifier, $this->featured, PDO::PARAM_INT);
						break;
					case '`IS_ADMIN`':
						$stmt->bindValue($identifier, $this->is_admin, PDO::PARAM_INT);
						break;
					case '`IS_ONLINE`':
						$stmt->bindValue($identifier, $this->is_online, PDO::PARAM_INT);
						break;
					case '`ALT_EMAIL`':
						$stmt->bindValue($identifier, $this->alt_email, PDO::PARAM_INT);
						break;
					case '`USER_PHONE`':
						$stmt->bindValue($identifier, $this->user_phone, PDO::PARAM_STR);
						break;		
					case '`STATE`':
						$stmt->bindValue($identifier, $this->state, PDO::PARAM_STR);
						break;
					case '`HASH_TAG`':
						$stmt->bindValue($identifier, $this->hash_tag, PDO::PARAM_STR);
						break;	
					case '`FB_ON`':
						$stmt->bindValue($identifier, $this->fb_on, PDO::PARAM_INT);
						break;
					case '`TW_ON`':
						$stmt->bindValue($identifier, $this->tw_on, PDO::PARAM_INT);
						break;
					case '`IN_ON`':
						$stmt->bindValue($identifier, $this->in_on, PDO::PARAM_INT);
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


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUserFollowsRelatedByUserId !== null) {
					foreach ($this->collUserFollowsRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserFollowsRelatedByUserIdFollow !== null) {
					foreach ($this->collUserFollowsRelatedByUserIdFollow as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWallsRelatedByUserId !== null) {
					foreach ($this->collWallsRelatedByUserId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWallsRelatedByUserIdFrom !== null) {
					foreach ($this->collWallsRelatedByUserIdFrom as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMusicAlbums !== null) {
					foreach ($this->collMusicAlbums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEvents !== null) {
					foreach ($this->collEvents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMusics !== null) {
					foreach ($this->collMusics as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVideos !== null) {
					foreach ($this->collVideos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVideoPurchases !== null) {
					foreach ($this->collVideoPurchases as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPayouts !== null) {
					foreach ($this->collPayouts as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collShoppingLogs !== null) {
					foreach ($this->collShoppingLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPhotos !== null) {
					foreach ($this->collPhotos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPhotoAlbums !== null) {
					foreach ($this->collPhotoAlbums as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPaymentInfos !== null) {
					foreach ($this->collPaymentInfos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collBroadcastViewerss !== null) {
					foreach ($this->collBroadcastViewerss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collBroadcastFlowss !== null) {
					foreach ($this->collBroadcastFlowss as $referrerFK) {
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEmail();
				break;
			case 2:
				return $this->getStatus();
				break;
			case 3:
				return $this->getEmailConfirmed();
				break;
			case 4:
				return $this->getFirstName();
				break;
			case 5:
				return $this->getLastName();
				break;
			case 6:
				return $this->getBandName();
				break;
			case 7:
				return $this->getName();
				break;
			case 8:
				return $this->getPass();
				break;
			case 9:
				return $this->getAvatar();
				break;
			case 10:
				return $this->getCountry();
				break;
			case 11:
				return $this->getLocation();
				break;
			case 12:
				return $this->getHideLoc();
				break;
			case 13:
				return $this->getZip();
				break;
			case 14:
				return $this->getAbout();
				break;
			case 15:
				return $this->getLikes();
				break;
			case 16:
				return $this->getYearsActive();
				break;
			case 17:
				return $this->getGenres();
				break;
			case 18:
				return $this->getMembers();
				break;
			case 19:
				return $this->getWebsite();
				break;
			case 20:
				return $this->getBio();
				break;
			case 21:
				return $this->getRecordLabel();
				break;
			case 22:
				return $this->getRecordLabelLink();
				break;
			case 23:
				return $this->getDob();
				break;
			case 24:
				return $this->getGender();
				break;
			case 25:
				return $this->getChecksum();
				break;
			case 26:
				return $this->getIp();
				break;
			case 27:
				return $this->getLastLogin();
				break;
			case 28:
				return $this->getLastReload();
				break;
			case 29:
				return $this->getBlocked();
				break;
			case 30:
				return $this->getBlockReason();
				break;
			case 31:
				return $this->getRegDate();
				break;
			case 32:
				return $this->getWallet();
				break;
			case 33:
				return $this->getWalletBlock();
				break;
			case 34:
				return $this->getFbId();
				break;
			case 35:
				return $this->getFbToken();
				break;
			case 36:
				return $this->getFbStart();
				break;
			case 37:
				return $this->getTwStart();
				break;
			case 38:
				return $this->getTwId();
				break;
			case 39:
				return $this->getTwOauthToken();
				break;
			case 40:
				return $this->getTwOauthTokenSecret();
				break;
			case 41:
				return $this->getFeatured();
				break;
			case 42:
				return $this->getIsAdmin();
				break;
			case 43:
				return $this->getIsOnline();
				break;
			case 44:
				return $this->getAltEmail();
				break;
			case 45:
				return $this->getUserPhone();
				break;	
			case 46:
				return $this->getState();
				break;
			case 47:
				return $this->getHashTag();
				break;
			case 48:
				return $this->getFbOn();
				break;
			case 49:
				return $this->getTwOn();
				break;
			case 50:
				return $this->getInOn();
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
		if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getEmail(),
			$keys[2] => $this->getStatus(),
			$keys[3] => $this->getEmailConfirmed(),
			$keys[4] => $this->getFirstName(),
			$keys[5] => $this->getLastName(),
			$keys[6] => $this->getBandName(),
			$keys[7] => $this->getName(),
			$keys[8] => $this->getPass(),
			$keys[9] => $this->getAvatar(),
			$keys[10] => $this->getCountry(),
			$keys[11] => $this->getLocation(),
			$keys[12] => $this->getHideLoc(),
			$keys[13] => $this->getZip(),
			$keys[14] => $this->getAbout(),
			$keys[15] => $this->getLikes(),
			$keys[16] => $this->getYearsActive(),
			$keys[17] => $this->getGenres(),
			$keys[18] => $this->getMembers(),
			$keys[19] => $this->getWebsite(),
			$keys[20] => $this->getBio(),
			$keys[21] => $this->getRecordLabel(),
			$keys[22] => $this->getRecordLabelLink(),
			$keys[23] => $this->getDob(),
			$keys[24] => $this->getGender(),
			$keys[25] => $this->getChecksum(),
			$keys[26] => $this->getIp(),
			$keys[27] => $this->getLastLogin(),
			$keys[28] => $this->getLastReload(),
			$keys[29] => $this->getBlocked(),
			$keys[30] => $this->getBlockReason(),
			$keys[31] => $this->getRegDate(),
			$keys[32] => $this->getWallet(),
			$keys[33] => $this->getWalletBlock(),
			$keys[34] => $this->getFbId(),
			$keys[35] => $this->getFbToken(),
			$keys[36] => $this->getFbStart(),
			$keys[37] => $this->getTwStart(),
			$keys[38] => $this->getTwId(),
			$keys[39] => $this->getTwOauthToken(),
			$keys[40] => $this->getTwOauthTokenSecret(),
			$keys[41] => $this->getFeatured(),
			$keys[42] => $this->getIsAdmin(),
			$keys[43] => $this->getIsOnline(),
			$keys[44] => $this->getAltEmail(),
			$keys[45] => $this->getUserPhone(),			
			$keys[46] => $this->getState(),
			$keys[47] => $this->getHashTag(),
			$keys[48] => $this->getFbOn(),
			$keys[49] => $this->getTwOn(),
			$keys[50] => $this->getInOn(),			
		);
		if ($includeForeignObjects) {
			if (null !== $this->collUserFollowsRelatedByUserId) {
				$result['UserFollowsRelatedByUserId'] = $this->collUserFollowsRelatedByUserId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collUserFollowsRelatedByUserIdFollow) {
				$result['UserFollowsRelatedByUserIdFollow'] = $this->collUserFollowsRelatedByUserIdFollow->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collWallsRelatedByUserId) {
				$result['WallsRelatedByUserId'] = $this->collWallsRelatedByUserId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collWallsRelatedByUserIdFrom) {
				$result['WallsRelatedByUserIdFrom'] = $this->collWallsRelatedByUserIdFrom->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collMusicAlbums) {
				$result['MusicAlbums'] = $this->collMusicAlbums->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collEvents) {
				$result['Events'] = $this->collEvents->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collMusics) {
				$result['Musics'] = $this->collMusics->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collVideos) {
				$result['Videos'] = $this->collVideos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collVideoPurchases) {
				$result['VideoPurchases'] = $this->collVideoPurchases->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPayouts) {
				$result['Payouts'] = $this->collPayouts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collShoppingLogs) {
				$result['ShoppingLogs'] = $this->collShoppingLogs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPhotos) {
				$result['Photos'] = $this->collPhotos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPhotoAlbums) {
				$result['PhotoAlbums'] = $this->collPhotoAlbums->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collPaymentInfos) {
				$result['PaymentInfos'] = $this->collPaymentInfos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collBroadcastViewerss) {
				$result['BroadcastViewerss'] = $this->collBroadcastViewerss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collBroadcastFlowss) {
				$result['BroadcastFlowss'] = $this->collBroadcastFlowss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEmail($value);
				break;
			case 2:
				$this->setStatus($value);
				break;
			case 3:
				$this->setEmailConfirmed($value);
				break;
			case 4:
				$this->setFirstName($value);
				break;
			case 5:
				$this->setLastName($value);
				break;
			case 6:
				$this->setBandName($value);
				break;
			case 7:
				$this->setName($value);
				break;
			case 8:
				$this->setPass($value);
				break;
			case 9:
				$this->setAvatar($value);
				break;
			case 10:
				$this->setCountry($value);
				break;
			case 11:
				$this->setLocation($value);
				break;
			case 12:
				$this->setHideLoc($value);
				break;
			case 13:
				$this->setZip($value);
				break;
			case 14:
				$this->setAbout($value);
				break;
			case 15:
				$this->setLikes($value);
				break;
			case 16:
				$this->setYearsActive($value);
				break;
			case 17:
				$this->setGenres($value);
				break;
			case 18:
				$this->setMembers($value);
				break;
			case 19:
				$this->setWebsite($value);
				break;
			case 20:
				$this->setBio($value);
				break;
			case 21:
				$this->setRecordLabel($value);
				break;
			case 22:
				$this->setRecordLabelLink($value);
				break;
			case 23:
				$this->setDob($value);
				break;
			case 24:
				$this->setGender($value);
				break;
			case 25:
				$this->setChecksum($value);
				break;
			case 26:
				$this->setIp($value);
				break;
			case 27:
				$this->setLastLogin($value);
				break;
			case 28:
				$this->setLastReload($value);
				break;
			case 29:
				$this->setBlocked($value);
				break;
			case 30:
				$this->setBlockReason($value);
				break;
			case 31:
				$this->setRegDate($value);
				break;
			case 32:
				$this->setWallet($value);
				break;
			case 33:
				$this->setWalletBlock($value);
				break;
			case 34:
				$this->setFbId($value);
				break;
			case 35:
				$this->setFbToken($value);
				break;
			case 36:
				$this->setFbStart($value);
				break;
			case 37:
				$this->setTwStart($value);
				break;
			case 38:
				$this->setTwId($value);
				break;
			case 39:
				$this->setTwOauthToken($value);
				break;
			case 40:
				$this->setTwOauthTokenSecret($value);
				break;
			case 41:
				$this->setFeatured($value);
				break;
			case 42:
				$this->setIsAdmin($value);
				break;
			case 43:
				return $this->setIsOnline($value);
				break;
			case 44:
				return $this->setAltEmail($value);
				break;	
			case 45:
				$this->setUserPhone($value);
				break;
			case 46:
				$this->setState($value);
				break;
			case 47:
				$this->setHashTag($value);
				break;			
			case 48:
				$this->setFbOn($value);
				break;
			case 49:
				$this->setTwOn($value);
				break;
			case 50:
				$this->setInOn($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEmail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setStatus($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEmailConfirmed($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFirstName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLastName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBandName($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPass($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setAvatar($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCountry($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLocation($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setHideLoc($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setZip($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setAbout($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLikes($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setYearsActive($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setGenres($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setMembers($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setWebsite($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setBio($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setRecordLabel($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setRecordLabelLink($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setDob($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setGender($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setChecksum($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setIp($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setLastLogin($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setLastReload($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setBlocked($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setBlockReason($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setRegDate($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setWallet($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setWalletBlock($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setFbId($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setFbToken($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setFbStart($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setTwStart($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setTwId($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setTwOauthToken($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setTwOauthTokenSecret($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setFeatured($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setIsAdmin($arr[$keys[42]]);
		if (array_key_exists($keys[43], $arr)) $this->setIsOnline($arr[$keys[43]]);
		if (array_key_exists($keys[44], $arr)) $this->setAltEmail($arr[$keys[44]]);
		if (array_key_exists($keys[45], $arr)) $this->setUserPhone($arr[$keys[45]]);	
		if (array_key_exists($keys[46], $arr)) $this->setState($arr[$keys[46]]);
		if (array_key_exists($keys[47], $arr)) $this->setHashTag($arr[$keys[47]]);	
		if (array_key_exists($keys[48], $arr)) $this->setFbOn($arr[$keys[48]]);
		if (array_key_exists($keys[49], $arr)) $this->setTwOn($arr[$keys[49]]);
		if (array_key_exists($keys[50], $arr)) $this->setInOn($arr[$keys[50]]);		
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::STATUS)) $criteria->add(UserPeer::STATUS, $this->status);
		if ($this->isColumnModified(UserPeer::EMAIL_CONFIRMED)) $criteria->add(UserPeer::EMAIL_CONFIRMED, $this->email_confirmed);
		if ($this->isColumnModified(UserPeer::FIRST_NAME)) $criteria->add(UserPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(UserPeer::LAST_NAME)) $criteria->add(UserPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(UserPeer::BAND_NAME)) $criteria->add(UserPeer::BAND_NAME, $this->band_name);
		if ($this->isColumnModified(UserPeer::NAME)) $criteria->add(UserPeer::NAME, $this->name);
		if ($this->isColumnModified(UserPeer::PASS)) $criteria->add(UserPeer::PASS, $this->pass);
		if ($this->isColumnModified(UserPeer::AVATAR)) $criteria->add(UserPeer::AVATAR, $this->avatar);
		if ($this->isColumnModified(UserPeer::COUNTRY)) $criteria->add(UserPeer::COUNTRY, $this->country);
		if ($this->isColumnModified(UserPeer::LOCATION)) $criteria->add(UserPeer::LOCATION, $this->location);
		if ($this->isColumnModified(UserPeer::HIDE_LOC)) $criteria->add(UserPeer::HIDE_LOC, $this->hide_loc);
		if ($this->isColumnModified(UserPeer::ZIP)) $criteria->add(UserPeer::ZIP, $this->zip);
		if ($this->isColumnModified(UserPeer::ABOUT)) $criteria->add(UserPeer::ABOUT, $this->about);
		if ($this->isColumnModified(UserPeer::LIKES)) $criteria->add(UserPeer::LIKES, $this->likes);
		if ($this->isColumnModified(UserPeer::YEARS_ACTIVE)) $criteria->add(UserPeer::YEARS_ACTIVE, $this->years_active);
		if ($this->isColumnModified(UserPeer::GENRES)) $criteria->add(UserPeer::GENRES, $this->genres);
		if ($this->isColumnModified(UserPeer::MEMBERS)) $criteria->add(UserPeer::MEMBERS, $this->members);
		if ($this->isColumnModified(UserPeer::WEBSITE)) $criteria->add(UserPeer::WEBSITE, $this->website);
		if ($this->isColumnModified(UserPeer::BIO)) $criteria->add(UserPeer::BIO, $this->bio);
		if ($this->isColumnModified(UserPeer::RECORD_LABEL)) $criteria->add(UserPeer::RECORD_LABEL, $this->record_label);
		if ($this->isColumnModified(UserPeer::RECORD_LABEL_LINK)) $criteria->add(UserPeer::RECORD_LABEL_LINK, $this->record_label_link);
		if ($this->isColumnModified(UserPeer::DOB)) $criteria->add(UserPeer::DOB, $this->dob);
		if ($this->isColumnModified(UserPeer::GENDER)) $criteria->add(UserPeer::GENDER, $this->gender);
		if ($this->isColumnModified(UserPeer::CHECKSUM)) $criteria->add(UserPeer::CHECKSUM, $this->checksum);
		if ($this->isColumnModified(UserPeer::IP)) $criteria->add(UserPeer::IP, $this->ip);
		if ($this->isColumnModified(UserPeer::LAST_LOGIN)) $criteria->add(UserPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(UserPeer::LAST_RELOAD)) $criteria->add(UserPeer::LAST_RELOAD, $this->last_reload);
		if ($this->isColumnModified(UserPeer::BLOCKED)) $criteria->add(UserPeer::BLOCKED, $this->blocked);
		if ($this->isColumnModified(UserPeer::BLOCK_REASON)) $criteria->add(UserPeer::BLOCK_REASON, $this->block_reason);
		if ($this->isColumnModified(UserPeer::REG_DATE)) $criteria->add(UserPeer::REG_DATE, $this->reg_date);
		if ($this->isColumnModified(UserPeer::WALLET)) $criteria->add(UserPeer::WALLET, $this->wallet);
		if ($this->isColumnModified(UserPeer::WALLET_BLOCK)) $criteria->add(UserPeer::WALLET_BLOCK, $this->wallet_block);
		if ($this->isColumnModified(UserPeer::FB_ID)) $criteria->add(UserPeer::FB_ID, $this->fb_id);
		if ($this->isColumnModified(UserPeer::FB_TOKEN)) $criteria->add(UserPeer::FB_TOKEN, $this->fb_token);
		if ($this->isColumnModified(UserPeer::FB_START)) $criteria->add(UserPeer::FB_START, $this->fb_start);
		if ($this->isColumnModified(UserPeer::TW_START)) $criteria->add(UserPeer::TW_START, $this->tw_start);
		if ($this->isColumnModified(UserPeer::TW_ID)) $criteria->add(UserPeer::TW_ID, $this->tw_id);
		if ($this->isColumnModified(UserPeer::TW_OAUTH_TOKEN)) $criteria->add(UserPeer::TW_OAUTH_TOKEN, $this->tw_oauth_token);
		if ($this->isColumnModified(UserPeer::TW_OAUTH_TOKEN_SECRET)) $criteria->add(UserPeer::TW_OAUTH_TOKEN_SECRET, $this->tw_oauth_token_secret);
		if ($this->isColumnModified(UserPeer::FEATURED)) $criteria->add(UserPeer::FEATURED, $this->featured);
		if ($this->isColumnModified(UserPeer::IS_ADMIN)) $criteria->add(UserPeer::IS_ADMIN, $this->is_admin);
		if ($this->isColumnModified(UserPeer::IS_ONLINE)) $criteria->add(UserPeer::IS_ONLINE, $this->is_online);
		if ($this->isColumnModified(UserPeer::ALT_EMAIL)) $criteria->add(UserPeer::ALT_EMAIL, $this->alt_email);
		if ($this->isColumnModified(UserPeer::USER_PHONE)) $criteria->add(UserPeer::USER_PHONE, $this->user_phone);		
		if ($this->isColumnModified(UserPeer::STATE)) $criteria->add(UserPeer::STATE, $this->state);
		if ($this->isColumnModified(UserPeer::HASH_TAG)) $criteria->add(UserPeer::HASH_TAG, $this->hash_tag);
		if ($this->isColumnModified(UserPeer::FB_ON)) $criteria->add(UserPeer::FB_ON, $this->fb_on);
		if ($this->isColumnModified(UserPeer::TW_ON)) $criteria->add(UserPeer::TW_ON, $this->tw_on);
		if ($this->isColumnModified(UserPeer::IN_ON)) $criteria->add(UserPeer::IN_ON, $this->in_on);		

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
		$criteria = new Criteria(UserPeer::DATABASE_NAME);
		$criteria->add(UserPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of User (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setEmail($this->getEmail());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setEmailConfirmed($this->getEmailConfirmed());
		$copyObj->setFirstName($this->getFirstName());
		$copyObj->setLastName($this->getLastName());
		$copyObj->setBandName($this->getBandName());
		$copyObj->setName($this->getName());
		$copyObj->setPass($this->getPass());
		$copyObj->setAvatar($this->getAvatar());
		$copyObj->setCountry($this->getCountry());
		$copyObj->setLocation($this->getLocation());
		$copyObj->setHideLoc($this->getHideLoc());
		$copyObj->setZip($this->getZip());
		$copyObj->setAbout($this->getAbout());
		$copyObj->setLikes($this->getLikes());
		$copyObj->setYearsActive($this->getYearsActive());
		$copyObj->setGenres($this->getGenres());
		$copyObj->setMembers($this->getMembers());
		$copyObj->setWebsite($this->getWebsite());
		$copyObj->setBio($this->getBio());
		$copyObj->setRecordLabel($this->getRecordLabel());
		$copyObj->setRecordLabelLink($this->getRecordLabelLink());
		$copyObj->setDob($this->getDob());
		$copyObj->setGender($this->getGender());
		$copyObj->setChecksum($this->getChecksum());
		$copyObj->setIp($this->getIp());
		$copyObj->setLastLogin($this->getLastLogin());
		$copyObj->setLastReload($this->getLastReload());
		$copyObj->setBlocked($this->getBlocked());
		$copyObj->setBlockReason($this->getBlockReason());
		$copyObj->setRegDate($this->getRegDate());
		$copyObj->setWallet($this->getWallet());
		$copyObj->setWalletBlock($this->getWalletBlock());
		$copyObj->setFbId($this->getFbId());
		$copyObj->setFbToken($this->getFbToken());
		$copyObj->setFbStart($this->getFbStart());
		$copyObj->setTwStart($this->getTwStart());
		$copyObj->setTwId($this->getTwId());
		$copyObj->setTwOauthToken($this->getTwOauthToken());
		$copyObj->setTwOauthTokenSecret($this->getTwOauthTokenSecret());
		$copyObj->setFeatured($this->getFeatured());
		$copyObj->setIsAdmin($this->getIsAdmin());
		$copyObj->setIsOnline($this->getIsOnline());
		$copyObj->setAltEmail($this->getAltEmail());
		$copyObj->setUserPhone($this->getUserPhone());		
		$copyObj->setState($this->getState());
		$copyObj->setHashTag($this->getHashTag());
		$copyObj->setFbOn($this->getFbOn());
		$copyObj->setTwOn($this->getTwOn());
		$copyObj->setInOn($this->getInOn());		

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getUserFollowsRelatedByUserId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserFollowRelatedByUserId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUserFollowsRelatedByUserIdFollow() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUserFollowRelatedByUserIdFollow($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWallsRelatedByUserId() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWallRelatedByUserId($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getWallsRelatedByUserIdFrom() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addWallRelatedByUserIdFrom($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMusicAlbums() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMusicAlbum($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getEvents() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addEvent($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getMusics() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addMusic($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getVideos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addVideo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getVideoPurchases() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addVideoPurchase($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPayouts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPayout($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getShoppingLogs() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addShoppingLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPhotos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPhoto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPhotoAlbums() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPhotoAlbum($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPaymentInfos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addPaymentInfo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getBroadcastViewerss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBroadcastViewers($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getBroadcastFlowss() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addBroadcastFlows($relObj->copy($deepCopy));
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
	 * @return     User Clone of current object.
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
	 * @return     UserPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new UserPeer();
		}
		return self::$peer;
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
		if ('UserFollowRelatedByUserId' == $relationName) {
			return $this->initUserFollowsRelatedByUserId();
		}
		if ('UserFollowRelatedByUserIdFollow' == $relationName) {
			return $this->initUserFollowsRelatedByUserIdFollow();
		}
		if ('WallRelatedByUserId' == $relationName) {
			return $this->initWallsRelatedByUserId();
		}
		if ('WallRelatedByUserIdFrom' == $relationName) {
			return $this->initWallsRelatedByUserIdFrom();
		}
		if ('MusicAlbum' == $relationName) {
			return $this->initMusicAlbums();
		}
		if ('Event' == $relationName) {
			return $this->initEvents();
		}
		if ('Music' == $relationName) {
			return $this->initMusics();
		}
		if ('Video' == $relationName) {
			return $this->initVideos();
		}
		if ('VideoPurchase' == $relationName) {
			return $this->initVideoPurchases();
		}
		if ('Payout' == $relationName) {
			return $this->initPayouts();
		}
		if ('ShoppingLog' == $relationName) {
			return $this->initShoppingLogs();
		}
		if ('Photo' == $relationName) {
			return $this->initPhotos();
		}
		if ('PhotoAlbum' == $relationName) {
			return $this->initPhotoAlbums();
		}
		if ('PaymentInfo' == $relationName) {
			return $this->initPaymentInfos();
		}
		if ('BroadcastViewers' == $relationName) {
			return $this->initBroadcastViewerss();
		}
		if ('BroadcastFlows' == $relationName) {
			return $this->initBroadcastFlowss();
		}
		if ('EventVideo' == $relationName) {
			return $this->initEventVideos();
		}
	}

	/**
	 * Clears out the collUserFollowsRelatedByUserId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserFollowsRelatedByUserId()
	 */
	public function clearUserFollowsRelatedByUserId()
	{
		$this->collUserFollowsRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserFollowsRelatedByUserId collection.
	 *
	 * By default this just sets the collUserFollowsRelatedByUserId collection to an empty array (like clearcollUserFollowsRelatedByUserId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initUserFollowsRelatedByUserId($overrideExisting = true)
	{
		if (null !== $this->collUserFollowsRelatedByUserId && !$overrideExisting) {
			return;
		}
		$this->collUserFollowsRelatedByUserId = new PropelObjectCollection();
		$this->collUserFollowsRelatedByUserId->setModel('UserFollow');
	}

	/**
	 * Gets an array of UserFollow objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array UserFollow[] List of UserFollow objects
	 * @throws     PropelException
	 */
	public function getUserFollowsRelatedByUserId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collUserFollowsRelatedByUserId || null !== $criteria) {
			if ($this->isNew() && null === $this->collUserFollowsRelatedByUserId) {
				// return empty collection
				$this->initUserFollowsRelatedByUserId();
			} else {
				$collUserFollowsRelatedByUserId = UserFollowQuery::create(null, $criteria)
					->filterByUserFromK($this)
					->find($con);
				if (null !== $criteria) {
					return $collUserFollowsRelatedByUserId;
				}
				$this->collUserFollowsRelatedByUserId = $collUserFollowsRelatedByUserId;
			}
		}
		return $this->collUserFollowsRelatedByUserId;
	}

	/**
	 * Sets a collection of UserFollowRelatedByUserId objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $userFollowsRelatedByUserId A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setUserFollowsRelatedByUserId(PropelCollection $userFollowsRelatedByUserId, PropelPDO $con = null)
	{
		$this->userFollowsRelatedByUserIdScheduledForDeletion = $this->getUserFollowsRelatedByUserId(new Criteria(), $con)->diff($userFollowsRelatedByUserId);

		foreach ($userFollowsRelatedByUserId as $userFollowRelatedByUserId) {
			// Fix issue with collection modified by reference
			if ($userFollowRelatedByUserId->isNew()) {
				$userFollowRelatedByUserId->setUserFromK($this);
			}
			$this->addUserFollowRelatedByUserId($userFollowRelatedByUserId);
		}

		$this->collUserFollowsRelatedByUserId = $userFollowsRelatedByUserId;
	}

	/**
	 * Returns the number of related UserFollow objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserFollow objects.
	 * @throws     PropelException
	 */
	public function countUserFollowsRelatedByUserId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collUserFollowsRelatedByUserId || null !== $criteria) {
			if ($this->isNew() && null === $this->collUserFollowsRelatedByUserId) {
				return 0;
			} else {
				$query = UserFollowQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserFromK($this)
					->count($con);
			}
		} else {
			return count($this->collUserFollowsRelatedByUserId);
		}
	}

	/**
	 * Method called to associate a UserFollow object to this object
	 * through the UserFollow foreign key attribute.
	 *
	 * @param      UserFollow $l UserFollow
	 * @return     User The current object (for fluent API support)
	 */
	public function addUserFollowRelatedByUserId(UserFollow $l)
	{
		if ($this->collUserFollowsRelatedByUserId === null) {
			$this->initUserFollowsRelatedByUserId();
		}
		if (!$this->collUserFollowsRelatedByUserId->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddUserFollowRelatedByUserId($l);
		}

		return $this;
	}

	/**
	 * @param	UserFollowRelatedByUserId $userFollowRelatedByUserId The userFollowRelatedByUserId object to add.
	 */
	protected function doAddUserFollowRelatedByUserId($userFollowRelatedByUserId)
	{
		$this->collUserFollowsRelatedByUserId[]= $userFollowRelatedByUserId;
		$userFollowRelatedByUserId->setUserFromK($this);
	}

	/**
	 * Clears out the collUserFollowsRelatedByUserIdFollow collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUserFollowsRelatedByUserIdFollow()
	 */
	public function clearUserFollowsRelatedByUserIdFollow()
	{
		$this->collUserFollowsRelatedByUserIdFollow = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUserFollowsRelatedByUserIdFollow collection.
	 *
	 * By default this just sets the collUserFollowsRelatedByUserIdFollow collection to an empty array (like clearcollUserFollowsRelatedByUserIdFollow());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initUserFollowsRelatedByUserIdFollow($overrideExisting = true)
	{
		if (null !== $this->collUserFollowsRelatedByUserIdFollow && !$overrideExisting) {
			return;
		}
		$this->collUserFollowsRelatedByUserIdFollow = new PropelObjectCollection();
		$this->collUserFollowsRelatedByUserIdFollow->setModel('UserFollow');
	}

	/**
	 * Gets an array of UserFollow objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array UserFollow[] List of UserFollow objects
	 * @throws     PropelException
	 */
	public function getUserFollowsRelatedByUserIdFollow($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collUserFollowsRelatedByUserIdFollow || null !== $criteria) {
			if ($this->isNew() && null === $this->collUserFollowsRelatedByUserIdFollow) {
				// return empty collection
				$this->initUserFollowsRelatedByUserIdFollow();
			} else {
				$collUserFollowsRelatedByUserIdFollow = UserFollowQuery::create(null, $criteria)
					->filterByUserToK($this)
					->find($con);
				if (null !== $criteria) {
					return $collUserFollowsRelatedByUserIdFollow;
				}
				$this->collUserFollowsRelatedByUserIdFollow = $collUserFollowsRelatedByUserIdFollow;
			}
		}
		return $this->collUserFollowsRelatedByUserIdFollow;
	}

	/**
	 * Sets a collection of UserFollowRelatedByUserIdFollow objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $userFollowsRelatedByUserIdFollow A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setUserFollowsRelatedByUserIdFollow(PropelCollection $userFollowsRelatedByUserIdFollow, PropelPDO $con = null)
	{
		$this->userFollowsRelatedByUserIdFollowScheduledForDeletion = $this->getUserFollowsRelatedByUserIdFollow(new Criteria(), $con)->diff($userFollowsRelatedByUserIdFollow);

		foreach ($userFollowsRelatedByUserIdFollow as $userFollowRelatedByUserIdFollow) {
			// Fix issue with collection modified by reference
			if ($userFollowRelatedByUserIdFollow->isNew()) {
				$userFollowRelatedByUserIdFollow->setUserToK($this);
			}
			$this->addUserFollowRelatedByUserIdFollow($userFollowRelatedByUserIdFollow);
		}

		$this->collUserFollowsRelatedByUserIdFollow = $userFollowsRelatedByUserIdFollow;
	}

	/**
	 * Returns the number of related UserFollow objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UserFollow objects.
	 * @throws     PropelException
	 */
	public function countUserFollowsRelatedByUserIdFollow(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collUserFollowsRelatedByUserIdFollow || null !== $criteria) {
			if ($this->isNew() && null === $this->collUserFollowsRelatedByUserIdFollow) {
				return 0;
			} else {
				$query = UserFollowQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserToK($this)
					->count($con);
			}
		} else {
			return count($this->collUserFollowsRelatedByUserIdFollow);
		}
	}

	/**
	 * Method called to associate a UserFollow object to this object
	 * through the UserFollow foreign key attribute.
	 *
	 * @param      UserFollow $l UserFollow
	 * @return     User The current object (for fluent API support)
	 */
	public function addUserFollowRelatedByUserIdFollow(UserFollow $l)
	{
		if ($this->collUserFollowsRelatedByUserIdFollow === null) {
			$this->initUserFollowsRelatedByUserIdFollow();
		}
		if (!$this->collUserFollowsRelatedByUserIdFollow->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddUserFollowRelatedByUserIdFollow($l);
		}

		return $this;
	}

	/**
	 * @param	UserFollowRelatedByUserIdFollow $userFollowRelatedByUserIdFollow The userFollowRelatedByUserIdFollow object to add.
	 */
	protected function doAddUserFollowRelatedByUserIdFollow($userFollowRelatedByUserIdFollow)
	{
		$this->collUserFollowsRelatedByUserIdFollow[]= $userFollowRelatedByUserIdFollow;
		$userFollowRelatedByUserIdFollow->setUserToK($this);
	}

	/**
	 * Clears out the collWallsRelatedByUserId collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWallsRelatedByUserId()
	 */
	public function clearWallsRelatedByUserId()
	{
		$this->collWallsRelatedByUserId = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWallsRelatedByUserId collection.
	 *
	 * By default this just sets the collWallsRelatedByUserId collection to an empty array (like clearcollWallsRelatedByUserId());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initWallsRelatedByUserId($overrideExisting = true)
	{
		if (null !== $this->collWallsRelatedByUserId && !$overrideExisting) {
			return;
		}
		$this->collWallsRelatedByUserId = new PropelObjectCollection();
		$this->collWallsRelatedByUserId->setModel('Wall');
	}

	/**
	 * Gets an array of Wall objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Wall[] List of Wall objects
	 * @throws     PropelException
	 */
	public function getWallsRelatedByUserId($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collWallsRelatedByUserId || null !== $criteria) {
			if ($this->isNew() && null === $this->collWallsRelatedByUserId) {
				// return empty collection
				$this->initWallsRelatedByUserId();
			} else {
				$collWallsRelatedByUserId = WallQuery::create(null, $criteria)
					->filterByUserToK($this)
					->find($con);
				if (null !== $criteria) {
					return $collWallsRelatedByUserId;
				}
				$this->collWallsRelatedByUserId = $collWallsRelatedByUserId;
			}
		}
		return $this->collWallsRelatedByUserId;
	}

	/**
	 * Sets a collection of WallRelatedByUserId objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $wallsRelatedByUserId A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setWallsRelatedByUserId(PropelCollection $wallsRelatedByUserId, PropelPDO $con = null)
	{
		$this->wallsRelatedByUserIdScheduledForDeletion = $this->getWallsRelatedByUserId(new Criteria(), $con)->diff($wallsRelatedByUserId);

		foreach ($wallsRelatedByUserId as $wallRelatedByUserId) {
			// Fix issue with collection modified by reference
			if ($wallRelatedByUserId->isNew()) {
				$wallRelatedByUserId->setUserToK($this);
			}
			$this->addWallRelatedByUserId($wallRelatedByUserId);
		}

		$this->collWallsRelatedByUserId = $wallsRelatedByUserId;
	}

	/**
	 * Returns the number of related Wall objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Wall objects.
	 * @throws     PropelException
	 */
	public function countWallsRelatedByUserId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collWallsRelatedByUserId || null !== $criteria) {
			if ($this->isNew() && null === $this->collWallsRelatedByUserId) {
				return 0;
			} else {
				$query = WallQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserToK($this)
					->count($con);
			}
		} else {
			return count($this->collWallsRelatedByUserId);
		}
	}

	/**
	 * Method called to associate a Wall object to this object
	 * through the Wall foreign key attribute.
	 *
	 * @param      Wall $l Wall
	 * @return     User The current object (for fluent API support)
	 */
	public function addWallRelatedByUserId(Wall $l)
	{
		if ($this->collWallsRelatedByUserId === null) {
			$this->initWallsRelatedByUserId();
		}
		if (!$this->collWallsRelatedByUserId->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddWallRelatedByUserId($l);
		}

		return $this;
	}

	/**
	 * @param	WallRelatedByUserId $wallRelatedByUserId The wallRelatedByUserId object to add.
	 */
	protected function doAddWallRelatedByUserId($wallRelatedByUserId)
	{
		$this->collWallsRelatedByUserId[]= $wallRelatedByUserId;
		$wallRelatedByUserId->setUserToK($this);
	}

	/**
	 * Clears out the collWallsRelatedByUserIdFrom collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addWallsRelatedByUserIdFrom()
	 */
	public function clearWallsRelatedByUserIdFrom()
	{
		$this->collWallsRelatedByUserIdFrom = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collWallsRelatedByUserIdFrom collection.
	 *
	 * By default this just sets the collWallsRelatedByUserIdFrom collection to an empty array (like clearcollWallsRelatedByUserIdFrom());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initWallsRelatedByUserIdFrom($overrideExisting = true)
	{
		if (null !== $this->collWallsRelatedByUserIdFrom && !$overrideExisting) {
			return;
		}
		$this->collWallsRelatedByUserIdFrom = new PropelObjectCollection();
		$this->collWallsRelatedByUserIdFrom->setModel('Wall');
	}

	/**
	 * Gets an array of Wall objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Wall[] List of Wall objects
	 * @throws     PropelException
	 */
	public function getWallsRelatedByUserIdFrom($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collWallsRelatedByUserIdFrom || null !== $criteria) {
			if ($this->isNew() && null === $this->collWallsRelatedByUserIdFrom) {
				// return empty collection
				$this->initWallsRelatedByUserIdFrom();
			} else {
				$collWallsRelatedByUserIdFrom = WallQuery::create(null, $criteria)
					->filterByUserFromK($this)
					->find($con);
				if (null !== $criteria) {
					return $collWallsRelatedByUserIdFrom;
				}
				$this->collWallsRelatedByUserIdFrom = $collWallsRelatedByUserIdFrom;
			}
		}
		return $this->collWallsRelatedByUserIdFrom;
	}

	/**
	 * Sets a collection of WallRelatedByUserIdFrom objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $wallsRelatedByUserIdFrom A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setWallsRelatedByUserIdFrom(PropelCollection $wallsRelatedByUserIdFrom, PropelPDO $con = null)
	{
		$this->wallsRelatedByUserIdFromScheduledForDeletion = $this->getWallsRelatedByUserIdFrom(new Criteria(), $con)->diff($wallsRelatedByUserIdFrom);

		foreach ($wallsRelatedByUserIdFrom as $wallRelatedByUserIdFrom) {
			// Fix issue with collection modified by reference
			if ($wallRelatedByUserIdFrom->isNew()) {
				$wallRelatedByUserIdFrom->setUserFromK($this);
			}
			$this->addWallRelatedByUserIdFrom($wallRelatedByUserIdFrom);
		}

		$this->collWallsRelatedByUserIdFrom = $wallsRelatedByUserIdFrom;
	}

	/**
	 * Returns the number of related Wall objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Wall objects.
	 * @throws     PropelException
	 */
	public function countWallsRelatedByUserIdFrom(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collWallsRelatedByUserIdFrom || null !== $criteria) {
			if ($this->isNew() && null === $this->collWallsRelatedByUserIdFrom) {
				return 0;
			} else {
				$query = WallQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUserFromK($this)
					->count($con);
			}
		} else {
			return count($this->collWallsRelatedByUserIdFrom);
		}
	}

	/**
	 * Method called to associate a Wall object to this object
	 * through the Wall foreign key attribute.
	 *
	 * @param      Wall $l Wall
	 * @return     User The current object (for fluent API support)
	 */
	public function addWallRelatedByUserIdFrom(Wall $l)
	{
		if ($this->collWallsRelatedByUserIdFrom === null) {
			$this->initWallsRelatedByUserIdFrom();
		}
		if (!$this->collWallsRelatedByUserIdFrom->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddWallRelatedByUserIdFrom($l);
		}

		return $this;
	}

	/**
	 * @param	WallRelatedByUserIdFrom $wallRelatedByUserIdFrom The wallRelatedByUserIdFrom object to add.
	 */
	protected function doAddWallRelatedByUserIdFrom($wallRelatedByUserIdFrom)
	{
		$this->collWallsRelatedByUserIdFrom[]= $wallRelatedByUserIdFrom;
		$wallRelatedByUserIdFrom->setUserFromK($this);
	}

	/**
	 * Clears out the collMusicAlbums collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMusicAlbums()
	 */
	public function clearMusicAlbums()
	{
		$this->collMusicAlbums = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMusicAlbums collection.
	 *
	 * By default this just sets the collMusicAlbums collection to an empty array (like clearcollMusicAlbums());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMusicAlbums($overrideExisting = true)
	{
		if (null !== $this->collMusicAlbums && !$overrideExisting) {
			return;
		}
		$this->collMusicAlbums = new PropelObjectCollection();
		$this->collMusicAlbums->setModel('MusicAlbum');
	}

	/**
	 * Gets an array of MusicAlbum objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array MusicAlbum[] List of MusicAlbum objects
	 * @throws     PropelException
	 */
	public function getMusicAlbums($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMusicAlbums || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusicAlbums) {
				// return empty collection
				$this->initMusicAlbums();
			} else {
				$collMusicAlbums = MusicAlbumQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collMusicAlbums;
				}
				$this->collMusicAlbums = $collMusicAlbums;
			}
		}
		return $this->collMusicAlbums;
	}

	/**
	 * Sets a collection of MusicAlbum objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $musicAlbums A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setMusicAlbums(PropelCollection $musicAlbums, PropelPDO $con = null)
	{
		$this->musicAlbumsScheduledForDeletion = $this->getMusicAlbums(new Criteria(), $con)->diff($musicAlbums);

		foreach ($musicAlbums as $musicAlbum) {
			// Fix issue with collection modified by reference
			if ($musicAlbum->isNew()) {
				$musicAlbum->setUser($this);
			}
			$this->addMusicAlbum($musicAlbum);
		}

		$this->collMusicAlbums = $musicAlbums;
	}

	/**
	 * Returns the number of related MusicAlbum objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related MusicAlbum objects.
	 * @throws     PropelException
	 */
	public function countMusicAlbums(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMusicAlbums || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusicAlbums) {
				return 0;
			} else {
				$query = MusicAlbumQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collMusicAlbums);
		}
	}

	/**
	 * Method called to associate a MusicAlbum object to this object
	 * through the MusicAlbum foreign key attribute.
	 *
	 * @param      MusicAlbum $l MusicAlbum
	 * @return     User The current object (for fluent API support)
	 */
	public function addMusicAlbum(MusicAlbum $l)
	{
		if ($this->collMusicAlbums === null) {
			$this->initMusicAlbums();
		}
		if (!$this->collMusicAlbums->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddMusicAlbum($l);
		}

		return $this;
	}

	/**
	 * @param	MusicAlbum $musicAlbum The musicAlbum object to add.
	 */
	protected function doAddMusicAlbum($musicAlbum)
	{
		$this->collMusicAlbums[]= $musicAlbum;
		$musicAlbum->setUser($this);
	}

	/**
	 * Clears out the collEvents collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addEvents()
	 */
	public function clearEvents()
	{
		$this->collEvents = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collEvents collection.
	 *
	 * By default this just sets the collEvents collection to an empty array (like clearcollEvents());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initEvents($overrideExisting = true)
	{
		if (null !== $this->collEvents && !$overrideExisting) {
			return;
		}
		$this->collEvents = new PropelObjectCollection();
		$this->collEvents->setModel('Event');
	}

	/**
	 * Gets an array of Event objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Event[] List of Event objects
	 * @throws     PropelException
	 */
	public function getEvents($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collEvents || null !== $criteria) {
			if ($this->isNew() && null === $this->collEvents) {
				// return empty collection
				$this->initEvents();
			} else {
				$collEvents = EventQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collEvents;
				}
				$this->collEvents = $collEvents;
			}
		}
		return $this->collEvents;
	}

	/**
	 * Sets a collection of Event objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $events A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setEvents(PropelCollection $events, PropelPDO $con = null)
	{
		$this->eventsScheduledForDeletion = $this->getEvents(new Criteria(), $con)->diff($events);

		foreach ($events as $event) {
			// Fix issue with collection modified by reference
			if ($event->isNew()) {
				$event->setUser($this);
			}
			$this->addEvent($event);
		}

		$this->collEvents = $events;
	}

	/**
	 * Returns the number of related Event objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Event objects.
	 * @throws     PropelException
	 */
	public function countEvents(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collEvents || null !== $criteria) {
			if ($this->isNew() && null === $this->collEvents) {
				return 0;
			} else {
				$query = EventQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collEvents);
		}
	}

	/**
	 * Method called to associate a Event object to this object
	 * through the Event foreign key attribute.
	 *
	 * @param      Event $l Event
	 * @return     User The current object (for fluent API support)
	 */
	public function addEvent(Event $l)
	{
		if ($this->collEvents === null) {
			$this->initEvents();
		}
		if (!$this->collEvents->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddEvent($l);
		}

		return $this;
	}

	/**
	 * @param	Event $event The event object to add.
	 */
	protected function doAddEvent($event)
	{
		$this->collEvents[]= $event;
		$event->setUser($this);
	}

	/**
	 * Clears out the collMusics collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addMusics()
	 */
	public function clearMusics()
	{
		$this->collMusics = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collMusics collection.
	 *
	 * By default this just sets the collMusics collection to an empty array (like clearcollMusics());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initMusics($overrideExisting = true)
	{
		if (null !== $this->collMusics && !$overrideExisting) {
			return;
		}
		$this->collMusics = new PropelObjectCollection();
		$this->collMusics->setModel('Music');
	}

	/**
	 * Gets an array of Music objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Music[] List of Music objects
	 * @throws     PropelException
	 */
	public function getMusics($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collMusics || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusics) {
				// return empty collection
				$this->initMusics();
			} else {
				$collMusics = MusicQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collMusics;
				}
				$this->collMusics = $collMusics;
			}
		}
		return $this->collMusics;
	}

	/**
	 * Sets a collection of Music objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $musics A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setMusics(PropelCollection $musics, PropelPDO $con = null)
	{
		$this->musicsScheduledForDeletion = $this->getMusics(new Criteria(), $con)->diff($musics);

		foreach ($musics as $music) {
			// Fix issue with collection modified by reference
			if ($music->isNew()) {
				$music->setUser($this);
			}
			$this->addMusic($music);
		}

		$this->collMusics = $musics;
	}

	/**
	 * Returns the number of related Music objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Music objects.
	 * @throws     PropelException
	 */
	public function countMusics(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collMusics || null !== $criteria) {
			if ($this->isNew() && null === $this->collMusics) {
				return 0;
			} else {
				$query = MusicQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collMusics);
		}
	}

	/**
	 * Method called to associate a Music object to this object
	 * through the Music foreign key attribute.
	 *
	 * @param      Music $l Music
	 * @return     User The current object (for fluent API support)
	 */
	public function addMusic(Music $l)
	{
		if ($this->collMusics === null) {
			$this->initMusics();
		}
		if (!$this->collMusics->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddMusic($l);
		}

		return $this;
	}

	/**
	 * @param	Music $music The music object to add.
	 */
	protected function doAddMusic($music)
	{
		$this->collMusics[]= $music;
		$music->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Musics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Music[] List of Music objects
	 */
	public function getMusicsJoinMusicAlbum($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MusicQuery::create(null, $criteria);
		$query->joinWith('MusicAlbum', $join_behavior);

		return $this->getMusics($query, $con);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Musics from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Music[] List of Music objects
	 */
	public function getMusicsJoinMusicPurchase($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = MusicQuery::create(null, $criteria);
		$query->joinWith('MusicPurchase', $join_behavior);

		return $this->getMusics($query, $con);
	}

	/**
	 * Clears out the collVideos collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addVideos()
	 */
	public function clearVideos()
	{
		$this->collVideos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collVideos collection.
	 *
	 * By default this just sets the collVideos collection to an empty array (like clearcollVideos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initVideos($overrideExisting = true)
	{
		if (null !== $this->collVideos && !$overrideExisting) {
			return;
		}
		$this->collVideos = new PropelObjectCollection();
		$this->collVideos->setModel('Video');
	}

	/**
	 * Gets an array of Video objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Video[] List of Video objects
	 * @throws     PropelException
	 */
	public function getVideos($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collVideos || null !== $criteria) {
			if ($this->isNew() && null === $this->collVideos) {
				// return empty collection
				$this->initVideos();
			} else {
				$collVideos = VideoQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collVideos;
				}
				$this->collVideos = $collVideos;
			}
		}
		return $this->collVideos;
	}

	/**
	 * Sets a collection of Video objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $videos A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setVideos(PropelCollection $videos, PropelPDO $con = null)
	{
		$this->videosScheduledForDeletion = $this->getVideos(new Criteria(), $con)->diff($videos);

		foreach ($videos as $video) {
			// Fix issue with collection modified by reference
			if ($video->isNew()) {
				$video->setUser($this);
			}
			$this->addVideo($video);
		}

		$this->collVideos = $videos;
	}

	/**
	 * Returns the number of related Video objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Video objects.
	 * @throws     PropelException
	 */
	public function countVideos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collVideos || null !== $criteria) {
			if ($this->isNew() && null === $this->collVideos) {
				return 0;
			} else {
				$query = VideoQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collVideos);
		}
	}

	/**
	 * Method called to associate a Video object to this object
	 * through the Video foreign key attribute.
	 *
	 * @param      Video $l Video
	 * @return     User The current object (for fluent API support)
	 */
	public function addVideo(Video $l)
	{
		if ($this->collVideos === null) {
			$this->initVideos();
		}
		if (!$this->collVideos->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddVideo($l);
		}

		return $this;
	}

	/**
	 * @param	Video $video The video object to add.
	 */
	protected function doAddVideo($video)
	{
		$this->collVideos[]= $video;
		$video->setUser($this);
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
	 * If this User is new, it will return
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
					->filterByUser($this)
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
				$videoPurchase->setUser($this);
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
					->filterByUser($this)
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
	 * @return     User The current object (for fluent API support)
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
		$videoPurchase->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related VideoPurchases from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array VideoPurchase[] List of VideoPurchase objects
	 */
	public function getVideoPurchasesJoinVideo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = VideoPurchaseQuery::create(null, $criteria);
		$query->joinWith('Video', $join_behavior);

		return $this->getVideoPurchases($query, $con);
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
	 * If this User is new, it will return
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
					->filterByUser($this)
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
				$payout->setUser($this);
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
					->filterByUser($this)
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
	 * @return     User The current object (for fluent API support)
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
		$payout->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Payouts from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Payout[] List of Payout objects
	 */
	public function getPayoutsJoinPaymentInfo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PayoutQuery::create(null, $criteria);
		$query->joinWith('PaymentInfo', $join_behavior);

		return $this->getPayouts($query, $con);
	}

	/**
	 * Clears out the collShoppingLogs collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addShoppingLogs()
	 */
	public function clearShoppingLogs()
	{
		$this->collShoppingLogs = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collShoppingLogs collection.
	 *
	 * By default this just sets the collShoppingLogs collection to an empty array (like clearcollShoppingLogs());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initShoppingLogs($overrideExisting = true)
	{
		if (null !== $this->collShoppingLogs && !$overrideExisting) {
			return;
		}
		$this->collShoppingLogs = new PropelObjectCollection();
		$this->collShoppingLogs->setModel('ShoppingLog');
	}

	/**
	 * Gets an array of ShoppingLog objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array ShoppingLog[] List of ShoppingLog objects
	 * @throws     PropelException
	 */
	public function getShoppingLogs($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collShoppingLogs || null !== $criteria) {
			if ($this->isNew() && null === $this->collShoppingLogs) {
				// return empty collection
				$this->initShoppingLogs();
			} else {
				$collShoppingLogs = ShoppingLogQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collShoppingLogs;
				}
				$this->collShoppingLogs = $collShoppingLogs;
			}
		}
		return $this->collShoppingLogs;
	}

	/**
	 * Sets a collection of ShoppingLog objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $shoppingLogs A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setShoppingLogs(PropelCollection $shoppingLogs, PropelPDO $con = null)
	{
		$this->shoppingLogsScheduledForDeletion = $this->getShoppingLogs(new Criteria(), $con)->diff($shoppingLogs);

		foreach ($shoppingLogs as $shoppingLog) {
			// Fix issue with collection modified by reference
			if ($shoppingLog->isNew()) {
				$shoppingLog->setUser($this);
			}
			$this->addShoppingLog($shoppingLog);
		}

		$this->collShoppingLogs = $shoppingLogs;
	}

	/**
	 * Returns the number of related ShoppingLog objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related ShoppingLog objects.
	 * @throws     PropelException
	 */
	public function countShoppingLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collShoppingLogs || null !== $criteria) {
			if ($this->isNew() && null === $this->collShoppingLogs) {
				return 0;
			} else {
				$query = ShoppingLogQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collShoppingLogs);
		}
	}

	/**
	 * Method called to associate a ShoppingLog object to this object
	 * through the ShoppingLog foreign key attribute.
	 *
	 * @param      ShoppingLog $l ShoppingLog
	 * @return     User The current object (for fluent API support)
	 */
	public function addShoppingLog(ShoppingLog $l)
	{
		if ($this->collShoppingLogs === null) {
			$this->initShoppingLogs();
		}
		if (!$this->collShoppingLogs->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddShoppingLog($l);
		}

		return $this;
	}

	/**
	 * @param	ShoppingLog $shoppingLog The shoppingLog object to add.
	 */
	protected function doAddShoppingLog($shoppingLog)
	{
		$this->collShoppingLogs[]= $shoppingLog;
		$shoppingLog->setUser($this);
	}

	/**
	 * Clears out the collPhotos collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPhotos()
	 */
	public function clearPhotos()
	{
		$this->collPhotos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPhotos collection.
	 *
	 * By default this just sets the collPhotos collection to an empty array (like clearcollPhotos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPhotos($overrideExisting = true)
	{
		if (null !== $this->collPhotos && !$overrideExisting) {
			return;
		}
		$this->collPhotos = new PropelObjectCollection();
		$this->collPhotos->setModel('Photo');
	}

	/**
	 * Gets an array of Photo objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Photo[] List of Photo objects
	 * @throws     PropelException
	 */
	public function getPhotos($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPhotos || null !== $criteria) {
			if ($this->isNew() && null === $this->collPhotos) {
				// return empty collection
				$this->initPhotos();
			} else {
				$collPhotos = PhotoQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collPhotos;
				}
				$this->collPhotos = $collPhotos;
			}
		}
		return $this->collPhotos;
	}

	/**
	 * Sets a collection of Photo objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $photos A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPhotos(PropelCollection $photos, PropelPDO $con = null)
	{
		$this->photosScheduledForDeletion = $this->getPhotos(new Criteria(), $con)->diff($photos);

		foreach ($photos as $photo) {
			// Fix issue with collection modified by reference
			if ($photo->isNew()) {
				$photo->setUser($this);
			}
			$this->addPhoto($photo);
		}

		$this->collPhotos = $photos;
	}

	/**
	 * Returns the number of related Photo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Photo objects.
	 * @throws     PropelException
	 */
	public function countPhotos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPhotos || null !== $criteria) {
			if ($this->isNew() && null === $this->collPhotos) {
				return 0;
			} else {
				$query = PhotoQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collPhotos);
		}
	}

	/**
	 * Method called to associate a Photo object to this object
	 * through the Photo foreign key attribute.
	 *
	 * @param      Photo $l Photo
	 * @return     User The current object (for fluent API support)
	 */
	public function addPhoto(Photo $l)
	{
		if ($this->collPhotos === null) {
			$this->initPhotos();
		}
		if (!$this->collPhotos->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPhoto($l);
		}

		return $this;
	}

	/**
	 * @param	Photo $photo The photo object to add.
	 */
	protected function doAddPhoto($photo)
	{
		$this->collPhotos[]= $photo;
		$photo->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related Photos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Photo[] List of Photo objects
	 */
	public function getPhotosJoinPhotoAlbum($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = PhotoQuery::create(null, $criteria);
		$query->joinWith('PhotoAlbum', $join_behavior);

		return $this->getPhotos($query, $con);
	}

	/**
	 * Clears out the collPhotoAlbums collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPhotoAlbums()
	 */
	public function clearPhotoAlbums()
	{
		$this->collPhotoAlbums = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPhotoAlbums collection.
	 *
	 * By default this just sets the collPhotoAlbums collection to an empty array (like clearcollPhotoAlbums());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPhotoAlbums($overrideExisting = true)
	{
		if (null !== $this->collPhotoAlbums && !$overrideExisting) {
			return;
		}
		$this->collPhotoAlbums = new PropelObjectCollection();
		$this->collPhotoAlbums->setModel('PhotoAlbum');
	}

	/**
	 * Gets an array of PhotoAlbum objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array PhotoAlbum[] List of PhotoAlbum objects
	 * @throws     PropelException
	 */
	public function getPhotoAlbums($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPhotoAlbums || null !== $criteria) {
			if ($this->isNew() && null === $this->collPhotoAlbums) {
				// return empty collection
				$this->initPhotoAlbums();
			} else {
				$collPhotoAlbums = PhotoAlbumQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collPhotoAlbums;
				}
				$this->collPhotoAlbums = $collPhotoAlbums;
			}
		}
		return $this->collPhotoAlbums;
	}

	/**
	 * Sets a collection of PhotoAlbum objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $photoAlbums A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPhotoAlbums(PropelCollection $photoAlbums, PropelPDO $con = null)
	{
		$this->photoAlbumsScheduledForDeletion = $this->getPhotoAlbums(new Criteria(), $con)->diff($photoAlbums);

		foreach ($photoAlbums as $photoAlbum) {
			// Fix issue with collection modified by reference
			if ($photoAlbum->isNew()) {
				$photoAlbum->setUser($this);
			}
			$this->addPhotoAlbum($photoAlbum);
		}

		$this->collPhotoAlbums = $photoAlbums;
	}

	/**
	 * Returns the number of related PhotoAlbum objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PhotoAlbum objects.
	 * @throws     PropelException
	 */
	public function countPhotoAlbums(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPhotoAlbums || null !== $criteria) {
			if ($this->isNew() && null === $this->collPhotoAlbums) {
				return 0;
			} else {
				$query = PhotoAlbumQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collPhotoAlbums);
		}
	}

	/**
	 * Method called to associate a PhotoAlbum object to this object
	 * through the PhotoAlbum foreign key attribute.
	 *
	 * @param      PhotoAlbum $l PhotoAlbum
	 * @return     User The current object (for fluent API support)
	 */
	public function addPhotoAlbum(PhotoAlbum $l)
	{
		if ($this->collPhotoAlbums === null) {
			$this->initPhotoAlbums();
		}
		if (!$this->collPhotoAlbums->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPhotoAlbum($l);
		}

		return $this;
	}

	/**
	 * @param	PhotoAlbum $photoAlbum The photoAlbum object to add.
	 */
	protected function doAddPhotoAlbum($photoAlbum)
	{
		$this->collPhotoAlbums[]= $photoAlbum;
		$photoAlbum->setUser($this);
	}

	/**
	 * Clears out the collPaymentInfos collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addPaymentInfos()
	 */
	public function clearPaymentInfos()
	{
		$this->collPaymentInfos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collPaymentInfos collection.
	 *
	 * By default this just sets the collPaymentInfos collection to an empty array (like clearcollPaymentInfos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initPaymentInfos($overrideExisting = true)
	{
		if (null !== $this->collPaymentInfos && !$overrideExisting) {
			return;
		}
		$this->collPaymentInfos = new PropelObjectCollection();
		$this->collPaymentInfos->setModel('PaymentInfo');
	}

	/**
	 * Gets an array of PaymentInfo objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array PaymentInfo[] List of PaymentInfo objects
	 * @throws     PropelException
	 */
	public function getPaymentInfos($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collPaymentInfos || null !== $criteria) {
			if ($this->isNew() && null === $this->collPaymentInfos) {
				// return empty collection
				$this->initPaymentInfos();
			} else {
				$collPaymentInfos = PaymentInfoQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collPaymentInfos;
				}
				$this->collPaymentInfos = $collPaymentInfos;
			}
		}
		return $this->collPaymentInfos;
	}

	/**
	 * Sets a collection of PaymentInfo objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $paymentInfos A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setPaymentInfos(PropelCollection $paymentInfos, PropelPDO $con = null)
	{
		$this->paymentInfosScheduledForDeletion = $this->getPaymentInfos(new Criteria(), $con)->diff($paymentInfos);

		foreach ($paymentInfos as $paymentInfo) {
			// Fix issue with collection modified by reference
			if ($paymentInfo->isNew()) {
				$paymentInfo->setUser($this);
			}
			$this->addPaymentInfo($paymentInfo);
		}

		$this->collPaymentInfos = $paymentInfos;
	}

	/**
	 * Returns the number of related PaymentInfo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related PaymentInfo objects.
	 * @throws     PropelException
	 */
	public function countPaymentInfos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collPaymentInfos || null !== $criteria) {
			if ($this->isNew() && null === $this->collPaymentInfos) {
				return 0;
			} else {
				$query = PaymentInfoQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collPaymentInfos);
		}
	}

	/**
	 * Method called to associate a PaymentInfo object to this object
	 * through the PaymentInfo foreign key attribute.
	 *
	 * @param      PaymentInfo $l PaymentInfo
	 * @return     User The current object (for fluent API support)
	 */
	public function addPaymentInfo(PaymentInfo $l)
	{
		if ($this->collPaymentInfos === null) {
			$this->initPaymentInfos();
		}
		if (!$this->collPaymentInfos->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddPaymentInfo($l);
		}

		return $this;
	}

	/**
	 * @param	PaymentInfo $paymentInfo The paymentInfo object to add.
	 */
	protected function doAddPaymentInfo($paymentInfo)
	{
		$this->collPaymentInfos[]= $paymentInfo;
		$paymentInfo->setUser($this);
	}

	/**
	 * Clears out the collBroadcastViewerss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBroadcastViewerss()
	 */
	public function clearBroadcastViewerss()
	{
		$this->collBroadcastViewerss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBroadcastViewerss collection.
	 *
	 * By default this just sets the collBroadcastViewerss collection to an empty array (like clearcollBroadcastViewerss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initBroadcastViewerss($overrideExisting = true)
	{
		if (null !== $this->collBroadcastViewerss && !$overrideExisting) {
			return;
		}
		$this->collBroadcastViewerss = new PropelObjectCollection();
		$this->collBroadcastViewerss->setModel('BroadcastViewers');
	}

	/**
	 * Gets an array of BroadcastViewers objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array BroadcastViewers[] List of BroadcastViewers objects
	 * @throws     PropelException
	 */
	public function getBroadcastViewerss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collBroadcastViewerss || null !== $criteria) {
			if ($this->isNew() && null === $this->collBroadcastViewerss) {
				// return empty collection
				$this->initBroadcastViewerss();
			} else {
				$collBroadcastViewerss = BroadcastViewersQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collBroadcastViewerss;
				}
				$this->collBroadcastViewerss = $collBroadcastViewerss;
			}
		}
		return $this->collBroadcastViewerss;
	}

	/**
	 * Sets a collection of BroadcastViewers objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $broadcastViewerss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setBroadcastViewerss(PropelCollection $broadcastViewerss, PropelPDO $con = null)
	{
		$this->broadcastViewerssScheduledForDeletion = $this->getBroadcastViewerss(new Criteria(), $con)->diff($broadcastViewerss);

		foreach ($broadcastViewerss as $broadcastViewers) {
			// Fix issue with collection modified by reference
			if ($broadcastViewers->isNew()) {
				$broadcastViewers->setUser($this);
			}
			$this->addBroadcastViewers($broadcastViewers);
		}

		$this->collBroadcastViewerss = $broadcastViewerss;
	}

	/**
	 * Returns the number of related BroadcastViewers objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related BroadcastViewers objects.
	 * @throws     PropelException
	 */
	public function countBroadcastViewerss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collBroadcastViewerss || null !== $criteria) {
			if ($this->isNew() && null === $this->collBroadcastViewerss) {
				return 0;
			} else {
				$query = BroadcastViewersQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collBroadcastViewerss);
		}
	}

	/**
	 * Method called to associate a BroadcastViewers object to this object
	 * through the BroadcastViewers foreign key attribute.
	 *
	 * @param      BroadcastViewers $l BroadcastViewers
	 * @return     User The current object (for fluent API support)
	 */
	public function addBroadcastViewers(BroadcastViewers $l)
	{
		if ($this->collBroadcastViewerss === null) {
			$this->initBroadcastViewerss();
		}
		if (!$this->collBroadcastViewerss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddBroadcastViewers($l);
		}

		return $this;
	}

	/**
	 * @param	BroadcastViewers $broadcastViewers The broadcastViewers object to add.
	 */
	protected function doAddBroadcastViewers($broadcastViewers)
	{
		$this->collBroadcastViewerss[]= $broadcastViewers;
		$broadcastViewers->setUser($this);
	}

	/**
	 * Clears out the collBroadcastFlowss collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addBroadcastFlowss()
	 */
	public function clearBroadcastFlowss()
	{
		$this->collBroadcastFlowss = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collBroadcastFlowss collection.
	 *
	 * By default this just sets the collBroadcastFlowss collection to an empty array (like clearcollBroadcastFlowss());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initBroadcastFlowss($overrideExisting = true)
	{
		if (null !== $this->collBroadcastFlowss && !$overrideExisting) {
			return;
		}
		$this->collBroadcastFlowss = new PropelObjectCollection();
		$this->collBroadcastFlowss->setModel('BroadcastFlows');
	}

	/**
	 * Gets an array of BroadcastFlows objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this User is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array BroadcastFlows[] List of BroadcastFlows objects
	 * @throws     PropelException
	 */
	public function getBroadcastFlowss($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collBroadcastFlowss || null !== $criteria) {
			if ($this->isNew() && null === $this->collBroadcastFlowss) {
				// return empty collection
				$this->initBroadcastFlowss();
			} else {
				$collBroadcastFlowss = BroadcastFlowsQuery::create(null, $criteria)
					->filterByUser($this)
					->find($con);
				if (null !== $criteria) {
					return $collBroadcastFlowss;
				}
				$this->collBroadcastFlowss = $collBroadcastFlowss;
			}
		}
		return $this->collBroadcastFlowss;
	}

	/**
	 * Sets a collection of BroadcastFlows objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $broadcastFlowss A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setBroadcastFlowss(PropelCollection $broadcastFlowss, PropelPDO $con = null)
	{
		$this->broadcastFlowssScheduledForDeletion = $this->getBroadcastFlowss(new Criteria(), $con)->diff($broadcastFlowss);

		foreach ($broadcastFlowss as $broadcastFlows) {
			// Fix issue with collection modified by reference
			if ($broadcastFlows->isNew()) {
				$broadcastFlows->setUser($this);
			}
			$this->addBroadcastFlows($broadcastFlows);
		}

		$this->collBroadcastFlowss = $broadcastFlowss;
	}

	/**
	 * Returns the number of related BroadcastFlows objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related BroadcastFlows objects.
	 * @throws     PropelException
	 */
	public function countBroadcastFlowss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collBroadcastFlowss || null !== $criteria) {
			if ($this->isNew() && null === $this->collBroadcastFlowss) {
				return 0;
			} else {
				$query = BroadcastFlowsQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByUser($this)
					->count($con);
			}
		} else {
			return count($this->collBroadcastFlowss);
		}
	}

	/**
	 * Method called to associate a BroadcastFlows object to this object
	 * through the BroadcastFlows foreign key attribute.
	 *
	 * @param      BroadcastFlows $l BroadcastFlows
	 * @return     User The current object (for fluent API support)
	 */
	public function addBroadcastFlows(BroadcastFlows $l)
	{
		if ($this->collBroadcastFlowss === null) {
			$this->initBroadcastFlowss();
		}
		if (!$this->collBroadcastFlowss->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddBroadcastFlows($l);
		}

		return $this;
	}

	/**
	 * @param	BroadcastFlows $broadcastFlows The broadcastFlows object to add.
	 */
	protected function doAddBroadcastFlows($broadcastFlows)
	{
		$this->collBroadcastFlowss[]= $broadcastFlows;
		$broadcastFlows->setUser($this);
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
	 * If this User is new, it will return
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
					->filterByUser($this)
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
				$eventVideo->setUser($this);
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
					->filterByUser($this)
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
	 * @return     User The current object (for fluent API support)
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
		$eventVideo->setUser($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this User is new, it will return
	 * an empty collection; or if this User has previously
	 * been saved, it will retrieve related EventVideos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in User.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array EventVideo[] List of EventVideo objects
	 */
	public function getEventVideosJoinEvent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = EventVideoQuery::create(null, $criteria);
		$query->joinWith('Event', $join_behavior);

		return $this->getEventVideos($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->email = null;
		$this->status = null;
		$this->email_confirmed = null;
		$this->first_name = null;
		$this->last_name = null;
		$this->band_name = null;
		$this->name = null;
		$this->pass = null;
		$this->avatar = null;
		$this->country = null;
		$this->location = null;
		$this->hide_loc = null;
		$this->zip = null;
		$this->about = null;
		$this->likes = null;
		$this->years_active = null;
		$this->genres = null;
		$this->members = null;
		$this->website = null;
		$this->bio = null;
		$this->record_label = null;
		$this->record_label_link = null;
		$this->dob = null;
		$this->gender = null;
		$this->checksum = null;
		$this->ip = null;
		$this->last_login = null;
		$this->last_reload = null;
		$this->blocked = null;
		$this->block_reason = null;
		$this->reg_date = null;
		$this->wallet = null;
		$this->wallet_block = null;
		$this->fb_id = null;
		$this->fb_token = null;
		$this->fb_start = null;
		$this->tw_start = null;
		$this->tw_id = null;
		$this->tw_oauth_token = null;
		$this->tw_oauth_token_secret = null;
		$this->featured = null;
		$this->is_admin = null;
		$this->is_online = null;
		$this->alt_email = null;
		$this->user_phone = null;
		$this->state = null;
		$this->hash_tag = null;
		$this->fb_on = null;
		$this->tw_on = null;
		$this->in_on = null;		
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
			if ($this->collUserFollowsRelatedByUserId) {
				foreach ($this->collUserFollowsRelatedByUserId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUserFollowsRelatedByUserIdFollow) {
				foreach ($this->collUserFollowsRelatedByUserIdFollow as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWallsRelatedByUserId) {
				foreach ($this->collWallsRelatedByUserId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collWallsRelatedByUserIdFrom) {
				foreach ($this->collWallsRelatedByUserIdFrom as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMusicAlbums) {
				foreach ($this->collMusicAlbums as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEvents) {
				foreach ($this->collEvents as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMusics) {
				foreach ($this->collMusics as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collVideos) {
				foreach ($this->collVideos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collVideoPurchases) {
				foreach ($this->collVideoPurchases as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPayouts) {
				foreach ($this->collPayouts as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collShoppingLogs) {
				foreach ($this->collShoppingLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPhotos) {
				foreach ($this->collPhotos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPhotoAlbums) {
				foreach ($this->collPhotoAlbums as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPaymentInfos) {
				foreach ($this->collPaymentInfos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collBroadcastViewerss) {
				foreach ($this->collBroadcastViewerss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collBroadcastFlowss) {
				foreach ($this->collBroadcastFlowss as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEventVideos) {
				foreach ($this->collEventVideos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collUserFollowsRelatedByUserId instanceof PropelCollection) {
			$this->collUserFollowsRelatedByUserId->clearIterator();
		}
		$this->collUserFollowsRelatedByUserId = null;
		if ($this->collUserFollowsRelatedByUserIdFollow instanceof PropelCollection) {
			$this->collUserFollowsRelatedByUserIdFollow->clearIterator();
		}
		$this->collUserFollowsRelatedByUserIdFollow = null;
		if ($this->collWallsRelatedByUserId instanceof PropelCollection) {
			$this->collWallsRelatedByUserId->clearIterator();
		}
		$this->collWallsRelatedByUserId = null;
		if ($this->collWallsRelatedByUserIdFrom instanceof PropelCollection) {
			$this->collWallsRelatedByUserIdFrom->clearIterator();
		}
		$this->collWallsRelatedByUserIdFrom = null;
		if ($this->collMusicAlbums instanceof PropelCollection) {
			$this->collMusicAlbums->clearIterator();
		}
		$this->collMusicAlbums = null;
		if ($this->collEvents instanceof PropelCollection) {
			$this->collEvents->clearIterator();
		}
		$this->collEvents = null;
		if ($this->collMusics instanceof PropelCollection) {
			$this->collMusics->clearIterator();
		}
		$this->collMusics = null;
		if ($this->collVideos instanceof PropelCollection) {
			$this->collVideos->clearIterator();
		}
		$this->collVideos = null;
		if ($this->collVideoPurchases instanceof PropelCollection) {
			$this->collVideoPurchases->clearIterator();
		}
		$this->collVideoPurchases = null;
		if ($this->collPayouts instanceof PropelCollection) {
			$this->collPayouts->clearIterator();
		}
		$this->collPayouts = null;
		if ($this->collShoppingLogs instanceof PropelCollection) {
			$this->collShoppingLogs->clearIterator();
		}
		$this->collShoppingLogs = null;
		if ($this->collPhotos instanceof PropelCollection) {
			$this->collPhotos->clearIterator();
		}
		$this->collPhotos = null;
		if ($this->collPhotoAlbums instanceof PropelCollection) {
			$this->collPhotoAlbums->clearIterator();
		}
		$this->collPhotoAlbums = null;
		if ($this->collPaymentInfos instanceof PropelCollection) {
			$this->collPaymentInfos->clearIterator();
		}
		$this->collPaymentInfos = null;
		if ($this->collBroadcastViewerss instanceof PropelCollection) {
			$this->collBroadcastViewerss->clearIterator();
		}
		$this->collBroadcastViewerss = null;
		if ($this->collBroadcastFlowss instanceof PropelCollection) {
			$this->collBroadcastFlowss->clearIterator();
		}
		$this->collBroadcastFlowss = null;
		if ($this->collEventVideos instanceof PropelCollection) {
			$this->collEventVideos->clearIterator();
		}
		$this->collEventVideos = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseUser
