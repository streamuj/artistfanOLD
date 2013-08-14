<?php


/**
 * Base static class for performing query and update operations on the 'user' table.
 *
 * 
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseUserPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'artistfan';

	/** the table name for this class */
	const TABLE_NAME = 'user';

	/** the related Propel class for this table */
	const OM_CLASS = 'User';

	/** the related TableMap class for this table */
	const TM_CLASS = 'UserTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 48;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 48;

	/** the column name for the ID field */
	const ID = 'user.ID';

	/** the column name for the EMAIL field */
	const EMAIL = 'user.EMAIL';

	/** the column name for the STATUS field */
	const STATUS = 'user.STATUS';

	/** the column name for the EMAIL_CONFIRMED field */
	const EMAIL_CONFIRMED = 'user.EMAIL_CONFIRMED';

	/** the column name for the FIRST_NAME field */
	const FIRST_NAME = 'user.FIRST_NAME';

	/** the column name for the LAST_NAME field */
	const LAST_NAME = 'user.LAST_NAME';

	/** the column name for the BAND_NAME field */
	const BAND_NAME = 'user.BAND_NAME';

	/** the column name for the NAME field */
	const NAME = 'user.NAME';

	/** the column name for the PASS field */
	const PASS = 'user.PASS';

	/** the column name for the AVATAR field */
	const AVATAR = 'user.AVATAR';

	/** the column name for the COUNTRY field */
	const COUNTRY = 'user.COUNTRY';

	/** the column name for the LOCATION field */
	const LOCATION = 'user.LOCATION';

	/** the column name for the HIDE_LOC field */
	const HIDE_LOC = 'user.HIDE_LOC';

	/** the column name for the ZIP field */
	const ZIP = 'user.ZIP';

	/** the column name for the ABOUT field */
	const ABOUT = 'user.ABOUT';

	/** the column name for the LIKES field */
	const LIKES = 'user.LIKES';

	/** the column name for the YEARS_ACTIVE field */
	const YEARS_ACTIVE = 'user.YEARS_ACTIVE';

	/** the column name for the GENRES field */
	const GENRES = 'user.GENRES';

	/** the column name for the MEMBERS field */
	const MEMBERS = 'user.MEMBERS';

	/** the column name for the WEBSITE field */
	const WEBSITE = 'user.WEBSITE';

	/** the column name for the BIO field */
	const BIO = 'user.BIO';

	/** the column name for the RECORD_LABEL field */
	const RECORD_LABEL = 'user.RECORD_LABEL';

	/** the column name for the RECORD_LABEL_LINK field */
	const RECORD_LABEL_LINK = 'user.RECORD_LABEL_LINK';

	/** the column name for the DOB field */
	const DOB = 'user.DOB';

	/** the column name for the GENDER field */
	const GENDER = 'user.GENDER';

	/** the column name for the CHECKSUM field */
	const CHECKSUM = 'user.CHECKSUM';

	/** the column name for the IP field */
	const IP = 'user.IP';

	/** the column name for the LAST_LOGIN field */
	const LAST_LOGIN = 'user.LAST_LOGIN';

	/** the column name for the LAST_RELOAD field */
	const LAST_RELOAD = 'user.LAST_RELOAD';

	/** the column name for the BLOCKED field */
	const BLOCKED = 'user.BLOCKED';

	/** the column name for the BLOCK_REASON field */
	const BLOCK_REASON = 'user.BLOCK_REASON';

	/** the column name for the REG_DATE field */
	const REG_DATE = 'user.REG_DATE';

	/** the column name for the WALLET field */
	const WALLET = 'user.WALLET';

	/** the column name for the WALLET_BLOCK field */
	const WALLET_BLOCK = 'user.WALLET_BLOCK';

	/** the column name for the FB_ID field */
	const FB_ID = 'user.FB_ID';

	/** the column name for the FB_TOKEN field */
	const FB_TOKEN = 'user.FB_TOKEN';

	/** the column name for the FB_START field */
	const FB_START = 'user.FB_START';

	/** the column name for the TW_START field */
	const TW_START = 'user.TW_START';

	/** the column name for the TW_ID field */
	const TW_ID = 'user.TW_ID';

	/** the column name for the TW_OAUTH_TOKEN field */
	const TW_OAUTH_TOKEN = 'user.TW_OAUTH_TOKEN';

	/** the column name for the TW_OAUTH_TOKEN_SECRET field */
	const TW_OAUTH_TOKEN_SECRET = 'user.TW_OAUTH_TOKEN_SECRET';

	/** the column name for the FEATURED field */
	const FEATURED = 'user.FEATURED';

	/** the column name for the IS_ADMIN field */
	const IS_ADMIN = 'user.IS_ADMIN';
	
	/** the column name for the IS_ONLINE field */
	const IS_ONLINE = 'user.IS_ONLINE';

	/** the column name for the ALT_EMAIL field */
	const ALT_EMAIL = 'user.ALT_EMAIL';	
	
	/** the column name for the USER_PHONE field */
	const USER_PHONE = 'user.USER_PHONE';
	
	/** the column name for the STATE field */
	const STATE = 'user.STATE';

	/** the column name for the HASH_TAG field */
	const HASH_TAG = 'user.HASH_TAG';
	/** the column name for the FB_ON field */
	const FB_ON = 'user.FB_ON';

	/** the column name for the TW_ON field */
	const TW_ON = 'user.TW_ON';

	/** the column name for the IN_ON field */
	const IN_ON = 'user.IN_ON';	

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of User objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array User[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Email', 'Status', 'EmailConfirmed', 'FirstName', 'LastName', 'BandName', 'Name', 'Pass', 'Avatar', 'Country', 'Location', 'HideLoc', 'Zip', 'About', 'Likes', 'YearsActive', 'Genres', 'Members', 'Website', 'Bio', 'RecordLabel', 'RecordLabelLink', 'Dob', 'Gender', 'Checksum', 'Ip', 'LastLogin', 'LastReload', 'Blocked', 'BlockReason', 'RegDate', 'Wallet', 'WalletBlock', 'FbId', 'FbToken', 'FbStart', 'TwStart', 'TwId', 'TwOauthToken', 'TwOauthTokenSecret', 'Featured', 'IsAdmin','IsOnline','AltEmail', 'UserPhone','State', 'HashTag','FbOn', 'TwOn', 'InOn', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'email', 'status', 'emailConfirmed', 'firstName', 'lastName', 'bandName', 'name', 'pass', 'avatar', 'country', 'location', 'hideLoc', 'zip', 'about', 'likes', 'yearsActive', 'genres', 'members', 'website', 'bio', 'recordLabel', 'recordLabelLink', 'dob', 'gender', 'checksum', 'ip', 'lastLogin', 'lastReload', 'blocked', 'blockReason', 'regDate', 'wallet', 'walletBlock', 'fbId', 'fbToken', 'fbStart', 'twStart', 'twId', 'twOauthToken', 'twOauthTokenSecret', 'featured', 'isAdmin', 'isOnline', 'altEmail', 'UserPhone','state', 'hashTag','fbOn', 'twOn', 'inOn', ),
		BasePeer::TYPE_COLNAME => array (self::ID, self::EMAIL, self::STATUS, self::EMAIL_CONFIRMED, self::FIRST_NAME, self::LAST_NAME, self::BAND_NAME, self::NAME, self::PASS, self::AVATAR, self::COUNTRY, self::LOCATION, self::HIDE_LOC, self::ZIP, self::ABOUT, self::LIKES, self::YEARS_ACTIVE, self::GENRES, self::MEMBERS, self::WEBSITE, self::BIO, self::RECORD_LABEL, self::RECORD_LABEL_LINK, self::DOB, self::GENDER, self::CHECKSUM, self::IP, self::LAST_LOGIN, self::LAST_RELOAD, self::BLOCKED, self::BLOCK_REASON, self::REG_DATE, self::WALLET, self::WALLET_BLOCK, self::FB_ID, self::FB_TOKEN, self::FB_START, self::TW_START, self::TW_ID, self::TW_OAUTH_TOKEN, self::TW_OAUTH_TOKEN_SECRET, self::FEATURED, self::IS_ADMIN, self::IS_ONLINE, self::ALT_EMAIL, self::USER_PHONE, self::STATE, self::HASH_TAG,self::FB_ON, self::TW_ON, self::IN_ON, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID', 'EMAIL', 'STATUS', 'EMAIL_CONFIRMED', 'FIRST_NAME', 'LAST_NAME', 'BAND_NAME', 'NAME', 'PASS', 'AVATAR', 'COUNTRY', 'LOCATION', 'HIDE_LOC', 'ZIP', 'ABOUT', 'LIKES', 'YEARS_ACTIVE', 'GENRES', 'MEMBERS', 'WEBSITE', 'BIO', 'RECORD_LABEL', 'RECORD_LABEL_LINK', 'DOB', 'GENDER', 'CHECKSUM', 'IP', 'LAST_LOGIN', 'LAST_RELOAD', 'BLOCKED', 'BLOCK_REASON', 'REG_DATE', 'WALLET', 'WALLET_BLOCK', 'FB_ID', 'FB_TOKEN', 'FB_START', 'TW_START', 'TW_ID', 'TW_OAUTH_TOKEN', 'TW_OAUTH_TOKEN_SECRET', 'FEATURED', 'IS_ADMIN', 'IS_ONLINE', 'ALT_EMAIL', 'USER_PHONE', 'STATE', 'HASH_TAG', 'FB_ON', 'TW_ON', 'IN_ON', ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'email', 'status', 'email_confirmed', 'first_name', 'last_name', 'band_name', 'name', 'pass', 'avatar', 'country', 'location', 'hide_loc', 'zip', 'about', 'likes', 'years_active', 'genres', 'members', 'website', 'bio', 'record_label', 'record_label_link', 'dob', 'gender', 'checksum', 'ip', 'last_login', 'last_reload', 'blocked', 'block_reason', 'reg_date', 'wallet', 'wallet_block', 'fb_id', 'fb_token', 'fb_start', 'tw_start', 'tw_id', 'tw_oauth_token', 'tw_oauth_token_secret', 'featured', 'is_admin', 'is_online', 'alt_email', 'user_phone', 'state', 'hash_tag', 'fb_on', 'tw_on', 'in_on', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Email' => 1, 'Status' => 2, 'EmailConfirmed' => 3, 'FirstName' => 4, 'LastName' => 5, 'BandName' => 6, 'Name' => 7, 'Pass' => 8, 'Avatar' => 9, 'Country' => 10, 'Location' => 11, 'HideLoc' => 12, 'Zip' => 13, 'About' => 14, 'Likes' => 15, 'YearsActive' => 16, 'Genres' => 17, 'Members' => 18, 'Website' => 19, 'Bio' => 20, 'RecordLabel' => 21, 'RecordLabelLink' => 22, 'Dob' => 23, 'Gender' => 24, 'Checksum' => 25, 'Ip' => 26, 'LastLogin' => 27, 'LastReload' => 28, 'Blocked' => 29, 'BlockReason' => 30, 'RegDate' => 31, 'Wallet' => 32, 'WalletBlock' => 33, 'FbId' => 34, 'FbToken' => 35, 'FbStart' => 36, 'TwStart' => 37, 'TwId' => 38, 'TwOauthToken' => 39, 'TwOauthTokenSecret' => 40, 'Featured' => 41, 'IsAdmin' => 42, 'IsOnline' => 43,  'AltEmail' => 44, 'UserPhone' => 45, 'State' => 46, 'HashTag' => 47, 'FbOn' => 48, 'TwOn' => 49, 'InOn' => 50, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'email' => 1, 'status' => 2, 'emailConfirmed' => 3, 'firstName' => 4, 'lastName' => 5, 'bandName' => 6, 'name' => 7, 'pass' => 8, 'avatar' => 9, 'country' => 10, 'location' => 11, 'hideLoc' => 12, 'zip' => 13, 'about' => 14, 'likes' => 15, 'yearsActive' => 16, 'genres' => 17, 'members' => 18, 'website' => 19, 'bio' => 20, 'recordLabel' => 21, 'recordLabelLink' => 22, 'dob' => 23, 'gender' => 24, 'checksum' => 25, 'ip' => 26, 'lastLogin' => 27, 'lastReload' => 28, 'blocked' => 29, 'blockReason' => 30, 'regDate' => 31, 'wallet' => 32, 'walletBlock' => 33, 'fbId' => 34, 'fbToken' => 35, 'fbStart' => 36, 'twStart' => 37, 'twId' => 38, 'twOauthToken' => 39, 'twOauthTokenSecret' => 40, 'featured' => 41, 'isAdmin' => 42, 'isOnline' => 43, 'altEmail' => 44, 'userPhone' => 45, 'state' => 46, 'hashTag' => 47, 'fbOn' => 48, 'twOn' => 49, 'inOn' => 50, ),
		BasePeer::TYPE_COLNAME => array (self::ID => 0, self::EMAIL => 1, self::STATUS => 2, self::EMAIL_CONFIRMED => 3, self::FIRST_NAME => 4, self::LAST_NAME => 5, self::BAND_NAME => 6, self::NAME => 7, self::PASS => 8, self::AVATAR => 9, self::COUNTRY => 10, self::LOCATION => 11, self::HIDE_LOC => 12, self::ZIP => 13, self::ABOUT => 14, self::LIKES => 15, self::YEARS_ACTIVE => 16, self::GENRES => 17, self::MEMBERS => 18, self::WEBSITE => 19, self::BIO => 20, self::RECORD_LABEL => 21, self::RECORD_LABEL_LINK => 22, self::DOB => 23, self::GENDER => 24, self::CHECKSUM => 25, self::IP => 26, self::LAST_LOGIN => 27, self::LAST_RELOAD => 28, self::BLOCKED => 29, self::BLOCK_REASON => 30, self::REG_DATE => 31, self::WALLET => 32, self::WALLET_BLOCK => 33, self::FB_ID => 34, self::FB_TOKEN => 35, self::FB_START => 36, self::TW_START => 37, self::TW_ID => 38, self::TW_OAUTH_TOKEN => 39, self::TW_OAUTH_TOKEN_SECRET => 40, self::FEATURED => 41, self::IS_ADMIN => 42, self::IS_ONLINE => 43, self::ALT_EMAIL => 44,  self::USER_PHONE => 45, self::STATE => 46, self::HASH_TAG => 47, self::FB_ON => 48, self::TW_ON => 49, self::IN_ON => 50, ),
		BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'EMAIL' => 1, 'STATUS' => 2, 'EMAIL_CONFIRMED' => 3, 'FIRST_NAME' => 4, 'LAST_NAME' => 5, 'BAND_NAME' => 6, 'NAME' => 7, 'PASS' => 8, 'AVATAR' => 9, 'COUNTRY' => 10, 'LOCATION' => 11, 'HIDE_LOC' => 12, 'ZIP' => 13, 'ABOUT' => 14, 'LIKES' => 15, 'YEARS_ACTIVE' => 16, 'GENRES' => 17, 'MEMBERS' => 18, 'WEBSITE' => 19, 'BIO' => 20, 'RECORD_LABEL' => 21, 'RECORD_LABEL_LINK' => 22, 'DOB' => 23, 'GENDER' => 24, 'CHECKSUM' => 25, 'IP' => 26, 'LAST_LOGIN' => 27, 'LAST_RELOAD' => 28, 'BLOCKED' => 29, 'BLOCK_REASON' => 30, 'REG_DATE' => 31, 'WALLET' => 32, 'WALLET_BLOCK' => 33, 'FB_ID' => 34, 'FB_TOKEN' => 35, 'FB_START' => 36, 'TW_START' => 37, 'TW_ID' => 38, 'TW_OAUTH_TOKEN' => 39, 'TW_OAUTH_TOKEN_SECRET' => 40, 'FEATURED' => 41, 'IS_ADMIN' => 42, 'IS_ONLINE' => 43,  'ALT_EMAIL' => 44,  'USER_PHONE' => 45, 'STATE' => 46, 'HASH_TAG' => 47, 'FB_ON' => 48, 'TW_ON' => 49, 'IN_ON' => 50, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'email' => 1, 'status' => 2, 'email_confirmed' => 3, 'first_name' => 4, 'last_name' => 5, 'band_name' => 6, 'name' => 7, 'pass' => 8, 'avatar' => 9, 'country' => 10, 'location' => 11, 'hide_loc' => 12, 'zip' => 13, 'about' => 14, 'likes' => 15, 'years_active' => 16, 'genres' => 17, 'members' => 18, 'website' => 19, 'bio' => 20, 'record_label' => 21, 'record_label_link' => 22, 'dob' => 23, 'gender' => 24, 'checksum' => 25, 'ip' => 26, 'last_login' => 27, 'last_reload' => 28, 'blocked' => 29, 'block_reason' => 30, 'reg_date' => 31, 'wallet' => 32, 'wallet_block' => 33, 'fb_id' => 34, 'fb_token' => 35, 'fb_start' => 36, 'tw_start' => 37, 'tw_id' => 38, 'tw_oauth_token' => 39, 'tw_oauth_token_secret' => 40, 'featured' => 41, 'is_admin' => 42, 'is_online' => 43, 'alt_email' => 44, 'user_phone' => 45, 'state' => 46, 'hash_tag' => 47, 'fb_on' => 48, 'tw_on' => 49, 'in_on' => 50, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. UserPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(UserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(UserPeer::ID);
			$criteria->addSelectColumn(UserPeer::EMAIL);
			$criteria->addSelectColumn(UserPeer::STATUS);
			$criteria->addSelectColumn(UserPeer::EMAIL_CONFIRMED);
			$criteria->addSelectColumn(UserPeer::FIRST_NAME);
			$criteria->addSelectColumn(UserPeer::LAST_NAME);
			$criteria->addSelectColumn(UserPeer::BAND_NAME);
			$criteria->addSelectColumn(UserPeer::NAME);
			$criteria->addSelectColumn(UserPeer::PASS);
			$criteria->addSelectColumn(UserPeer::AVATAR);
			$criteria->addSelectColumn(UserPeer::COUNTRY);
			$criteria->addSelectColumn(UserPeer::LOCATION);
			$criteria->addSelectColumn(UserPeer::HIDE_LOC);
			$criteria->addSelectColumn(UserPeer::ZIP);
			$criteria->addSelectColumn(UserPeer::ABOUT);
			$criteria->addSelectColumn(UserPeer::LIKES);
			$criteria->addSelectColumn(UserPeer::YEARS_ACTIVE);
			$criteria->addSelectColumn(UserPeer::GENRES);
			$criteria->addSelectColumn(UserPeer::MEMBERS);
			$criteria->addSelectColumn(UserPeer::WEBSITE);
			$criteria->addSelectColumn(UserPeer::BIO);
			$criteria->addSelectColumn(UserPeer::RECORD_LABEL);
			$criteria->addSelectColumn(UserPeer::RECORD_LABEL_LINK);
			$criteria->addSelectColumn(UserPeer::DOB);
			$criteria->addSelectColumn(UserPeer::GENDER);
			$criteria->addSelectColumn(UserPeer::CHECKSUM);
			$criteria->addSelectColumn(UserPeer::IP);
			$criteria->addSelectColumn(UserPeer::LAST_LOGIN);
			$criteria->addSelectColumn(UserPeer::LAST_RELOAD);
			$criteria->addSelectColumn(UserPeer::BLOCKED);
			$criteria->addSelectColumn(UserPeer::BLOCK_REASON);
			$criteria->addSelectColumn(UserPeer::REG_DATE);
			$criteria->addSelectColumn(UserPeer::WALLET);
			$criteria->addSelectColumn(UserPeer::WALLET_BLOCK);
			$criteria->addSelectColumn(UserPeer::FB_ID);
			$criteria->addSelectColumn(UserPeer::FB_TOKEN);
			$criteria->addSelectColumn(UserPeer::FB_START);
			$criteria->addSelectColumn(UserPeer::TW_START);
			$criteria->addSelectColumn(UserPeer::TW_ID);
			$criteria->addSelectColumn(UserPeer::TW_OAUTH_TOKEN);
			$criteria->addSelectColumn(UserPeer::TW_OAUTH_TOKEN_SECRET);
			$criteria->addSelectColumn(UserPeer::FEATURED);
			$criteria->addSelectColumn(UserPeer::IS_ADMIN);
			$criteria->addSelectColumn(UserPeer::IS_ONLINE);
			$criteria->addSelectColumn(UserPeer::ALT_EMAIL);
			$criteria->addSelectColumn(UserPeer::USER_PHONE);		
			$criteria->addSelectColumn(UserPeer::STATE);
			$criteria->addSelectColumn(UserPeer::HASH_TAG);	
			$criteria->addSelectColumn(UserPeer::FB_ON);
			$criteria->addSelectColumn(UserPeer::TW_ON);
			$criteria->addSelectColumn(UserPeer::IN_ON);			
		} else {
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.EMAIL');
			$criteria->addSelectColumn($alias . '.STATUS');
			$criteria->addSelectColumn($alias . '.EMAIL_CONFIRMED');
			$criteria->addSelectColumn($alias . '.FIRST_NAME');
			$criteria->addSelectColumn($alias . '.LAST_NAME');
			$criteria->addSelectColumn($alias . '.BAND_NAME');
			$criteria->addSelectColumn($alias . '.NAME');
			$criteria->addSelectColumn($alias . '.PASS');
			$criteria->addSelectColumn($alias . '.AVATAR');
			$criteria->addSelectColumn($alias . '.COUNTRY');
			$criteria->addSelectColumn($alias . '.LOCATION');
			$criteria->addSelectColumn($alias . '.HIDE_LOC');
			$criteria->addSelectColumn($alias . '.ZIP');
			$criteria->addSelectColumn($alias . '.ABOUT');
			$criteria->addSelectColumn($alias . '.LIKES');
			$criteria->addSelectColumn($alias . '.YEARS_ACTIVE');
			$criteria->addSelectColumn($alias . '.GENRES');
			$criteria->addSelectColumn($alias . '.MEMBERS');
			$criteria->addSelectColumn($alias . '.WEBSITE');
			$criteria->addSelectColumn($alias . '.BIO');
			$criteria->addSelectColumn($alias . '.RECORD_LABEL');
			$criteria->addSelectColumn($alias . '.RECORD_LABEL_LINK');
			$criteria->addSelectColumn($alias . '.DOB');
			$criteria->addSelectColumn($alias . '.GENDER');
			$criteria->addSelectColumn($alias . '.CHECKSUM');
			$criteria->addSelectColumn($alias . '.IP');
			$criteria->addSelectColumn($alias . '.LAST_LOGIN');
			$criteria->addSelectColumn($alias . '.LAST_RELOAD');
			$criteria->addSelectColumn($alias . '.BLOCKED');
			$criteria->addSelectColumn($alias . '.BLOCK_REASON');
			$criteria->addSelectColumn($alias . '.REG_DATE');
			$criteria->addSelectColumn($alias . '.WALLET');
			$criteria->addSelectColumn($alias . '.WALLET_BLOCK');
			$criteria->addSelectColumn($alias . '.FB_ID');
			$criteria->addSelectColumn($alias . '.FB_TOKEN');
			$criteria->addSelectColumn($alias . '.FB_START');
			$criteria->addSelectColumn($alias . '.TW_START');
			$criteria->addSelectColumn($alias . '.TW_ID');
			$criteria->addSelectColumn($alias . '.TW_OAUTH_TOKEN');
			$criteria->addSelectColumn($alias . '.TW_OAUTH_TOKEN_SECRET');
			$criteria->addSelectColumn($alias . '.FEATURED');
			$criteria->addSelectColumn($alias . '.IS_ADMIN');
			$criteria->addSelectColumn($alias . '.IS_ONLINE');
			$criteria->addSelectColumn($alias . '.ALT_EMAIL');
			$criteria->addSelectColumn($alias . '.USER_PHONE');
			$criteria->addSelectColumn($alias . '.STATE');
			$criteria->addSelectColumn($alias . '.HASH_TAG');
			$criteria->addSelectColumn($alias . '.FB_ON');
			$criteria->addSelectColumn($alias . '.TW_ON');
			$criteria->addSelectColumn($alias . '.IN_ON');			
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(UserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Selects one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     User
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Selects several row from the DB.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return UserPeer::populateObjects(UserPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UserPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      User $value A User object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A User object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof User) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or User object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     User Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to user
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol] === null) {
			return null;
		}
		return (string) $row[$startcol];
	}

	/**
	 * Retrieves the primary key from the DB resultset row
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return (int) $row[$startcol];
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = UserPeer::getOMClass();
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UserPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (User object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = UserPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = UserPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + UserPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = UserPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			UserPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseUserPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseUserPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new UserTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 *
	 * @return     string ClassName
	 */
	public static function getOMClass()
	{
		return UserPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a User or Criteria object.
	 *
	 * @param      mixed $values Criteria or User object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from User object
		}

		if ($criteria->containsKey(UserPeer::ID) && $criteria->keyContainsValue(UserPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Performs an UPDATE on the database, given a User or Criteria object.
	 *
	 * @param      mixed $values Criteria or User object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(UserPeer::ID);
			$value = $criteria->remove(UserPeer::ID);
			if ($value) {
				$selectCriteria->add(UserPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(UserPeer::TABLE_NAME);
			}

		} else { // $values is User object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the user table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(UserPeer::TABLE_NAME, $con, UserPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			UserPeer::clearInstancePool();
			UserPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a User or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or User object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			UserPeer::clearInstancePool();
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof User) { // it's a model object
			// invalidate the cache for this single object
			UserPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UserPeer::ID, (array) $values, Criteria::IN);
			// invalidate the cache for this object(s)
			foreach ((array) $values as $singleval) {
				UserPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			UserPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given User object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      User $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UserPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(UserPeer::DATABASE_NAME, UserPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     User
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = UserPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(UserPeer::DATABASE_NAME);
		$criteria->add(UserPeer::ID, $pk);

		$v = UserPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(UserPeer::DATABASE_NAME);
			$criteria->add(UserPeer::ID, $pks, Criteria::IN);
			$objs = UserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseUserPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseUserPeer::buildTableMap();

