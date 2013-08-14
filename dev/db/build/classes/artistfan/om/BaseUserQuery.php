<?php


/**
 * Base class that represents a query for the 'user' table.
 *
 * 
 *
 * @method     UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     UserQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     UserQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     UserQuery orderByEmailConfirmed($order = Criteria::ASC) Order by the email_confirmed column
 * @method     UserQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     UserQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     UserQuery orderByBandName($order = Criteria::ASC) Order by the band_name column
 * @method     UserQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     UserQuery orderByPass($order = Criteria::ASC) Order by the pass column
 * @method     UserQuery orderByAvatar($order = Criteria::ASC) Order by the avatar column
 * @method     UserQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method     UserQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     UserQuery orderByHideLoc($order = Criteria::ASC) Order by the hide_loc column
 * @method     UserQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method     UserQuery orderByAbout($order = Criteria::ASC) Order by the about column
 * @method     UserQuery orderByLikes($order = Criteria::ASC) Order by the likes column
 * @method     UserQuery orderByYearsActive($order = Criteria::ASC) Order by the years_active column
 * @method     UserQuery orderByGenres($order = Criteria::ASC) Order by the genres column
 * @method     UserQuery orderByMembers($order = Criteria::ASC) Order by the members column
 * @method     UserQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method     UserQuery orderByBio($order = Criteria::ASC) Order by the bio column
 * @method     UserQuery orderByRecordLabel($order = Criteria::ASC) Order by the record_label column
 * @method     UserQuery orderByRecordLabelLink($order = Criteria::ASC) Order by the record_label_link column
 * @method     UserQuery orderByDob($order = Criteria::ASC) Order by the dob column
 * @method     UserQuery orderByGender($order = Criteria::ASC) Order by the gender column
 * @method     UserQuery orderByChecksum($order = Criteria::ASC) Order by the checksum column
 * @method     UserQuery orderByIp($order = Criteria::ASC) Order by the ip column
 * @method     UserQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     UserQuery orderByLastReload($order = Criteria::ASC) Order by the last_reload column
 * @method     UserQuery orderByBlocked($order = Criteria::ASC) Order by the blocked column
 * @method     UserQuery orderByBlockReason($order = Criteria::ASC) Order by the block_reason column
 * @method     UserQuery orderByRegDate($order = Criteria::ASC) Order by the reg_date column
 * @method     UserQuery orderByWallet($order = Criteria::ASC) Order by the wallet column
 * @method     UserQuery orderByWalletBlock($order = Criteria::ASC) Order by the wallet_block column
 * @method     UserQuery orderByFbId($order = Criteria::ASC) Order by the fb_id column
 * @method     UserQuery orderByFbToken($order = Criteria::ASC) Order by the fb_token column
 * @method     UserQuery orderByFbStart($order = Criteria::ASC) Order by the fb_start column
 * @method     UserQuery orderByTwStart($order = Criteria::ASC) Order by the tw_start column
 * @method     UserQuery orderByTwId($order = Criteria::ASC) Order by the tw_id column
 * @method     UserQuery orderByTwOauthToken($order = Criteria::ASC) Order by the tw_oauth_token column
 * @method     UserQuery orderByTwOauthTokenSecret($order = Criteria::ASC) Order by the tw_oauth_token_secret column
 * @method     UserQuery orderByFeatured($order = Criteria::ASC) Order by the featured column
 * @method     UserQuery orderByIsAdmin($order = Criteria::ASC) Order by the is_admin column
 * @method     UserQuery orderByIsOnline($order = Criteria::ASC) Order by the is_online column
 *
 * @method     UserQuery groupById() Group by the id column
 * @method     UserQuery groupByEmail() Group by the email column
 * @method     UserQuery groupByStatus() Group by the status column
 * @method     UserQuery groupByEmailConfirmed() Group by the email_confirmed column
 * @method     UserQuery groupByFirstName() Group by the first_name column
 * @method     UserQuery groupByLastName() Group by the last_name column
 * @method     UserQuery groupByBandName() Group by the band_name column
 * @method     UserQuery groupByName() Group by the name column
 * @method     UserQuery groupByPass() Group by the pass column
 * @method     UserQuery groupByAvatar() Group by the avatar column
 * @method     UserQuery groupByCountry() Group by the country column
 * @method     UserQuery groupByLocation() Group by the location column
 * @method     UserQuery groupByHideLoc() Group by the hide_loc column
 * @method     UserQuery groupByZip() Group by the zip column
 * @method     UserQuery groupByAbout() Group by the about column
 * @method     UserQuery groupByLikes() Group by the likes column
 * @method     UserQuery groupByYearsActive() Group by the years_active column
 * @method     UserQuery groupByGenres() Group by the genres column
 * @method     UserQuery groupByMembers() Group by the members column
 * @method     UserQuery groupByWebsite() Group by the website column
 * @method     UserQuery groupByBio() Group by the bio column
 * @method     UserQuery groupByRecordLabel() Group by the record_label column
 * @method     UserQuery groupByRecordLabelLink() Group by the record_label_link column
 * @method     UserQuery groupByDob() Group by the dob column
 * @method     UserQuery groupByGender() Group by the gender column
 * @method     UserQuery groupByChecksum() Group by the checksum column
 * @method     UserQuery groupByIp() Group by the ip column
 * @method     UserQuery groupByLastLogin() Group by the last_login column
 * @method     UserQuery groupByLastReload() Group by the last_reload column
 * @method     UserQuery groupByBlocked() Group by the blocked column
 * @method     UserQuery groupByBlockReason() Group by the block_reason column
 * @method     UserQuery groupByRegDate() Group by the reg_date column
 * @method     UserQuery groupByWallet() Group by the wallet column
 * @method     UserQuery groupByWalletBlock() Group by the wallet_block column
 * @method     UserQuery groupByFbId() Group by the fb_id column
 * @method     UserQuery groupByFbToken() Group by the fb_token column
 * @method     UserQuery groupByFbStart() Group by the fb_start column
 * @method     UserQuery groupByTwStart() Group by the tw_start column
 * @method     UserQuery groupByTwId() Group by the tw_id column
 * @method     UserQuery groupByTwOauthToken() Group by the tw_oauth_token column
 * @method     UserQuery groupByTwOauthTokenSecret() Group by the tw_oauth_token_secret column
 * @method     UserQuery groupByFeatured() Group by the featured column
 * @method     UserQuery groupByIsAdmin() Group by the is_admin column
 * @method     User findOneByIsOnline(int $is_online) Return the first User filtered by the is_online column
 *
 * @method     UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     UserQuery leftJoinUserFollowRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFollowRelatedByUserId relation
 * @method     UserQuery rightJoinUserFollowRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFollowRelatedByUserId relation
 * @method     UserQuery innerJoinUserFollowRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFollowRelatedByUserId relation
 *
 * @method     UserQuery leftJoinUserFollowRelatedByUserIdFollow($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserFollowRelatedByUserIdFollow relation
 * @method     UserQuery rightJoinUserFollowRelatedByUserIdFollow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserFollowRelatedByUserIdFollow relation
 * @method     UserQuery innerJoinUserFollowRelatedByUserIdFollow($relationAlias = null) Adds a INNER JOIN clause to the query using the UserFollowRelatedByUserIdFollow relation
 *
 * @method     UserQuery leftJoinWallRelatedByUserId($relationAlias = null) Adds a LEFT JOIN clause to the query using the WallRelatedByUserId relation
 * @method     UserQuery rightJoinWallRelatedByUserId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WallRelatedByUserId relation
 * @method     UserQuery innerJoinWallRelatedByUserId($relationAlias = null) Adds a INNER JOIN clause to the query using the WallRelatedByUserId relation
 *
 * @method     UserQuery leftJoinWallRelatedByUserIdFrom($relationAlias = null) Adds a LEFT JOIN clause to the query using the WallRelatedByUserIdFrom relation
 * @method     UserQuery rightJoinWallRelatedByUserIdFrom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the WallRelatedByUserIdFrom relation
 * @method     UserQuery innerJoinWallRelatedByUserIdFrom($relationAlias = null) Adds a INNER JOIN clause to the query using the WallRelatedByUserIdFrom relation
 *
 * @method     UserQuery leftJoinMusicAlbum($relationAlias = null) Adds a LEFT JOIN clause to the query using the MusicAlbum relation
 * @method     UserQuery rightJoinMusicAlbum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MusicAlbum relation
 * @method     UserQuery innerJoinMusicAlbum($relationAlias = null) Adds a INNER JOIN clause to the query using the MusicAlbum relation
 *
 * @method     UserQuery leftJoinEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the Event relation
 * @method     UserQuery rightJoinEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Event relation
 * @method     UserQuery innerJoinEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the Event relation
 *
 * @method     UserQuery leftJoinMusic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Music relation
 * @method     UserQuery rightJoinMusic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Music relation
 * @method     UserQuery innerJoinMusic($relationAlias = null) Adds a INNER JOIN clause to the query using the Music relation
 *
 * @method     UserQuery leftJoinVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Video relation
 * @method     UserQuery rightJoinVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Video relation
 * @method     UserQuery innerJoinVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the Video relation
 *
 * @method     UserQuery leftJoinVideoPurchase($relationAlias = null) Adds a LEFT JOIN clause to the query using the VideoPurchase relation
 * @method     UserQuery rightJoinVideoPurchase($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VideoPurchase relation
 * @method     UserQuery innerJoinVideoPurchase($relationAlias = null) Adds a INNER JOIN clause to the query using the VideoPurchase relation
 *
 * @method     UserQuery leftJoinPayout($relationAlias = null) Adds a LEFT JOIN clause to the query using the Payout relation
 * @method     UserQuery rightJoinPayout($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Payout relation
 * @method     UserQuery innerJoinPayout($relationAlias = null) Adds a INNER JOIN clause to the query using the Payout relation
 *
 * @method     UserQuery leftJoinShoppingLog($relationAlias = null) Adds a LEFT JOIN clause to the query using the ShoppingLog relation
 * @method     UserQuery rightJoinShoppingLog($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ShoppingLog relation
 * @method     UserQuery innerJoinShoppingLog($relationAlias = null) Adds a INNER JOIN clause to the query using the ShoppingLog relation
 *
 * @method     UserQuery leftJoinPhoto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Photo relation
 * @method     UserQuery rightJoinPhoto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Photo relation
 * @method     UserQuery innerJoinPhoto($relationAlias = null) Adds a INNER JOIN clause to the query using the Photo relation
 *
 * @method     UserQuery leftJoinPhotoAlbum($relationAlias = null) Adds a LEFT JOIN clause to the query using the PhotoAlbum relation
 * @method     UserQuery rightJoinPhotoAlbum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PhotoAlbum relation
 * @method     UserQuery innerJoinPhotoAlbum($relationAlias = null) Adds a INNER JOIN clause to the query using the PhotoAlbum relation
 *
 * @method     UserQuery leftJoinPaymentInfo($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentInfo relation
 * @method     UserQuery rightJoinPaymentInfo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentInfo relation
 * @method     UserQuery innerJoinPaymentInfo($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentInfo relation
 *
 * @method     UserQuery leftJoinBroadcastViewers($relationAlias = null) Adds a LEFT JOIN clause to the query using the BroadcastViewers relation
 * @method     UserQuery rightJoinBroadcastViewers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BroadcastViewers relation
 * @method     UserQuery innerJoinBroadcastViewers($relationAlias = null) Adds a INNER JOIN clause to the query using the BroadcastViewers relation
 *
 * @method     UserQuery leftJoinBroadcastFlows($relationAlias = null) Adds a LEFT JOIN clause to the query using the BroadcastFlows relation
 * @method     UserQuery rightJoinBroadcastFlows($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BroadcastFlows relation
 * @method     UserQuery innerJoinBroadcastFlows($relationAlias = null) Adds a INNER JOIN clause to the query using the BroadcastFlows relation
 *
 * @method     UserQuery leftJoinEventVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the EventVideo relation
 * @method     UserQuery rightJoinEventVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EventVideo relation
 * @method     UserQuery innerJoinEventVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the EventVideo relation
 *
 * @method     User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method     User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method     User findOneById(int $id) Return the first User filtered by the id column
 * @method     User findOneByEmail(string $email) Return the first User filtered by the email column
 * @method     User findOneByStatus(int $status) Return the first User filtered by the status column
 * @method     User findOneByEmailConfirmed(int $email_confirmed) Return the first User filtered by the email_confirmed column
 * @method     User findOneByFirstName(string $first_name) Return the first User filtered by the first_name column
 * @method     User findOneByLastName(string $last_name) Return the first User filtered by the last_name column
 * @method     User findOneByBandName(string $band_name) Return the first User filtered by the band_name column
 * @method     User findOneByName(string $name) Return the first User filtered by the name column
 * @method     User findOneByPass(string $pass) Return the first User filtered by the pass column
 * @method     User findOneByAvatar(string $avatar) Return the first User filtered by the avatar column
 * @method     User findOneByCountry(string $country) Return the first User filtered by the country column
 * @method     User findOneByLocation(string $location) Return the first User filtered by the location column
 * @method     User findOneByHideLoc(int $hide_loc) Return the first User filtered by the hide_loc column
 * @method     User findOneByZip(string $zip) Return the first User filtered by the zip column
 * @method     User findOneByAbout(string $about) Return the first User filtered by the about column
 * @method     User findOneByLikes(string $likes) Return the first User filtered by the likes column
 * @method     User findOneByYearsActive(string $years_active) Return the first User filtered by the years_active column
 * @method     User findOneByGenres(string $genres) Return the first User filtered by the genres column
 * @method     User findOneByMembers(string $members) Return the first User filtered by the members column
 * @method     User findOneByWebsite(string $website) Return the first User filtered by the website column
 * @method     User findOneByBio(string $bio) Return the first User filtered by the bio column
 * @method     User findOneByRecordLabel(string $record_label) Return the first User filtered by the record_label column
 * @method     User findOneByRecordLabelLink(string $record_label_link) Return the first User filtered by the record_label_link column
 * @method     User findOneByDob(string $dob) Return the first User filtered by the dob column
 * @method     User findOneByGender(int $gender) Return the first User filtered by the gender column
 * @method     User findOneByChecksum(string $checksum) Return the first User filtered by the checksum column
 * @method     User findOneByIp(string $ip) Return the first User filtered by the ip column
 * @method     User findOneByLastLogin(int $last_login) Return the first User filtered by the last_login column
 * @method     User findOneByLastReload(int $last_reload) Return the first User filtered by the last_reload column
 * @method     User findOneByBlocked(int $blocked) Return the first User filtered by the blocked column
 * @method     User findOneByBlockReason(string $block_reason) Return the first User filtered by the block_reason column
 * @method     User findOneByRegDate(int $reg_date) Return the first User filtered by the reg_date column
 * @method     User findOneByWallet(double $wallet) Return the first User filtered by the wallet column
 * @method     User findOneByWalletBlock(double $wallet_block) Return the first User filtered by the wallet_block column
 * @method     User findOneByFbId(string $fb_id) Return the first User filtered by the fb_id column
 * @method     User findOneByFbToken(string $fb_token) Return the first User filtered by the fb_token column
 * @method     User findOneByFbStart(int $fb_start) Return the first User filtered by the fb_start column
 * @method     User findOneByTwStart(int $tw_start) Return the first User filtered by the tw_start column
 * @method     User findOneByTwId(string $tw_id) Return the first User filtered by the tw_id column
 * @method     User findOneByTwOauthToken(string $tw_oauth_token) Return the first User filtered by the tw_oauth_token column
 * @method     User findOneByTwOauthTokenSecret(string $tw_oauth_token_secret) Return the first User filtered by the tw_oauth_token_secret column
 * @method     User findOneByFeatured(int $featured) Return the first User filtered by the featured column
 * @method     User findOneByIsAdmin(int $is_admin) Return the first User filtered by the is_admin column
 * @method     array findByIsOnline(int $is_online) Return User objects filtered by the is_online column
 *
 * @method     array findById(int $id) Return User objects filtered by the id column
 * @method     array findByEmail(string $email) Return User objects filtered by the email column
 * @method     array findByStatus(int $status) Return User objects filtered by the status column
 * @method     array findByEmailConfirmed(int $email_confirmed) Return User objects filtered by the email_confirmed column
 * @method     array findByFirstName(string $first_name) Return User objects filtered by the first_name column
 * @method     array findByLastName(string $last_name) Return User objects filtered by the last_name column
 * @method     array findByBandName(string $band_name) Return User objects filtered by the band_name column
 * @method     array findByName(string $name) Return User objects filtered by the name column
 * @method     array findByPass(string $pass) Return User objects filtered by the pass column
 * @method     array findByAvatar(string $avatar) Return User objects filtered by the avatar column
 * @method     array findByCountry(string $country) Return User objects filtered by the country column
 * @method     array findByLocation(string $location) Return User objects filtered by the location column
 * @method     array findByHideLoc(int $hide_loc) Return User objects filtered by the hide_loc column
 * @method     array findByZip(string $zip) Return User objects filtered by the zip column
 * @method     array findByAbout(string $about) Return User objects filtered by the about column
 * @method     array findByLikes(string $likes) Return User objects filtered by the likes column
 * @method     array findByYearsActive(string $years_active) Return User objects filtered by the years_active column
 * @method     array findByGenres(string $genres) Return User objects filtered by the genres column
 * @method     array findByMembers(string $members) Return User objects filtered by the members column
 * @method     array findByWebsite(string $website) Return User objects filtered by the website column
 * @method     array findByBio(string $bio) Return User objects filtered by the bio column
 * @method     array findByRecordLabel(string $record_label) Return User objects filtered by the record_label column
 * @method     array findByRecordLabelLink(string $record_label_link) Return User objects filtered by the record_label_link column
 * @method     array findByDob(string $dob) Return User objects filtered by the dob column
 * @method     array findByGender(int $gender) Return User objects filtered by the gender column
 * @method     array findByChecksum(string $checksum) Return User objects filtered by the checksum column
 * @method     array findByIp(string $ip) Return User objects filtered by the ip column
 * @method     array findByLastLogin(int $last_login) Return User objects filtered by the last_login column
 * @method     array findByLastReload(int $last_reload) Return User objects filtered by the last_reload column
 * @method     array findByBlocked(int $blocked) Return User objects filtered by the blocked column
 * @method     array findByBlockReason(string $block_reason) Return User objects filtered by the block_reason column
 * @method     array findByRegDate(int $reg_date) Return User objects filtered by the reg_date column
 * @method     array findByWallet(double $wallet) Return User objects filtered by the wallet column
 * @method     array findByWalletBlock(double $wallet_block) Return User objects filtered by the wallet_block column
 * @method     array findByFbId(string $fb_id) Return User objects filtered by the fb_id column
 * @method     array findByFbToken(string $fb_token) Return User objects filtered by the fb_token column
 * @method     array findByFbStart(int $fb_start) Return User objects filtered by the fb_start column
 * @method     array findByTwStart(int $tw_start) Return User objects filtered by the tw_start column
 * @method     array findByTwId(string $tw_id) Return User objects filtered by the tw_id column
 * @method     array findByTwOauthToken(string $tw_oauth_token) Return User objects filtered by the tw_oauth_token column
 * @method     array findByTwOauthTokenSecret(string $tw_oauth_token_secret) Return User objects filtered by the tw_oauth_token_secret column
 * @method     array findByFeatured(int $featured) Return User objects filtered by the featured column
 * @method     array findByIsAdmin(int $is_admin) Return User objects filtered by the is_admin column
 * @method     array findByIsOnline(int $is_online) Return User objects filtered by the is_online column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseUserQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'User', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new UserQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    UserQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof UserQuery) {
			return $criteria;
		}
		$query = new UserQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    User|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    User A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `EMAIL`, `STATUS`, `EMAIL_CONFIRMED`, `FIRST_NAME`, `LAST_NAME`, `BAND_NAME`, `NAME`, `PASS`, `AVATAR`, `COUNTRY`, `LOCATION`, `HIDE_LOC`, `ZIP`, `ABOUT`, `LIKES`, `YEARS_ACTIVE`, `GENRES`, `MEMBERS`, `WEBSITE`, `BIO`, `RECORD_LABEL`, `RECORD_LABEL_LINK`, `DOB`, `GENDER`, `CHECKSUM`, `IP`, `LAST_LOGIN`, `LAST_RELOAD`, `BLOCKED`, `BLOCK_REASON`, `REG_DATE`, `WALLET`, `WALLET_BLOCK`, `FB_ID`, `FB_TOKEN`, `FB_START`, `TW_START`, `TW_ID`, `TW_OAUTH_TOKEN`, `TW_OAUTH_TOKEN_SECRET`, `FEATURED`, `IS_ADMIN`, `IS_ONLINE`, `ALT_EMAIL`, `USER_PHONE`,`STATE`, `HASH_TAG`, `FB_ON`, `TW_ON`, `IN_ON`  FROM `user` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new User();
			$obj->hydrate($row);
			UserPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    User|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
	 * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $email The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByEmail($email = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($email)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $email)) {
				$email = str_replace('*', '%', $email);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::EMAIL, $email, $comparison);
	}

	/**
	 * Filter the query on the status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStatus(1234); // WHERE status = 1234
	 * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
	 * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
	 * </code>
	 *
	 * @param     mixed $status The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(UserPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(UserPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query on the email_confirmed column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEmailConfirmed(1234); // WHERE email_confirmed = 1234
	 * $query->filterByEmailConfirmed(array(12, 34)); // WHERE email_confirmed IN (12, 34)
	 * $query->filterByEmailConfirmed(array('min' => 12)); // WHERE email_confirmed > 12
	 * </code>
	 *
	 * @param     mixed $emailConfirmed The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByEmailConfirmed($emailConfirmed = null, $comparison = null)
	{
		if (is_array($emailConfirmed)) {
			$useMinMax = false;
			if (isset($emailConfirmed['min'])) {
				$this->addUsingAlias(UserPeer::EMAIL_CONFIRMED, $emailConfirmed['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($emailConfirmed['max'])) {
				$this->addUsingAlias(UserPeer::EMAIL_CONFIRMED, $emailConfirmed['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::EMAIL_CONFIRMED, $emailConfirmed, $comparison);
	}

	/**
	 * Filter the query on the first_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
	 * $query->filterByFirstName('%fooValue%'); // WHERE first_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $firstName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByFirstName($firstName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($firstName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $firstName)) {
				$firstName = str_replace('*', '%', $firstName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::FIRST_NAME, $firstName, $comparison);
	}

	/**
	 * Filter the query on the last_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
	 * $query->filterByLastName('%fooValue%'); // WHERE last_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $lastName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByLastName($lastName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($lastName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $lastName)) {
				$lastName = str_replace('*', '%', $lastName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::LAST_NAME, $lastName, $comparison);
	}

	/**
	 * Filter the query on the band_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBandName('fooValue');   // WHERE band_name = 'fooValue'
	 * $query->filterByBandName('%fooValue%'); // WHERE band_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $bandName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBandName($bandName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($bandName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $bandName)) {
				$bandName = str_replace('*', '%', $bandName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::BAND_NAME, $bandName, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the pass column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPass('fooValue');   // WHERE pass = 'fooValue'
	 * $query->filterByPass('%fooValue%'); // WHERE pass LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pass The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPass($pass = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pass)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pass)) {
				$pass = str_replace('*', '%', $pass);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::PASS, $pass, $comparison);
	}

	/**
	 * Filter the query on the avatar column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAvatar('fooValue');   // WHERE avatar = 'fooValue'
	 * $query->filterByAvatar('%fooValue%'); // WHERE avatar LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $avatar The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByAvatar($avatar = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($avatar)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $avatar)) {
				$avatar = str_replace('*', '%', $avatar);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::AVATAR, $avatar, $comparison);
	}

	/**
	 * Filter the query on the country column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
	 * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $country The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByCountry($country = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($country)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $country)) {
				$country = str_replace('*', '%', $country);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::COUNTRY, $country, $comparison);
	}

	/**
	 * Filter the query on the location column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
	 * $query->filterByLocation('%fooValue%'); // WHERE location LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $location The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByLocation($location = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($location)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $location)) {
				$location = str_replace('*', '%', $location);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::LOCATION, $location, $comparison);
	}

	/**
	 * Filter the query on the hide_loc column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHideLoc(1234); // WHERE hide_loc = 1234
	 * $query->filterByHideLoc(array(12, 34)); // WHERE hide_loc IN (12, 34)
	 * $query->filterByHideLoc(array('min' => 12)); // WHERE hide_loc > 12
	 * </code>
	 *
	 * @param     mixed $hideLoc The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByHideLoc($hideLoc = null, $comparison = null)
	{
		if (is_array($hideLoc)) {
			$useMinMax = false;
			if (isset($hideLoc['min'])) {
				$this->addUsingAlias(UserPeer::HIDE_LOC, $hideLoc['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hideLoc['max'])) {
				$this->addUsingAlias(UserPeer::HIDE_LOC, $hideLoc['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::HIDE_LOC, $hideLoc, $comparison);
	}

	/**
	 * Filter the query on the zip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByZip('fooValue');   // WHERE zip = 'fooValue'
	 * $query->filterByZip('%fooValue%'); // WHERE zip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $zip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByZip($zip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($zip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $zip)) {
				$zip = str_replace('*', '%', $zip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::ZIP, $zip, $comparison);
	}

	/**
	 * Filter the query on the about column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAbout('fooValue');   // WHERE about = 'fooValue'
	 * $query->filterByAbout('%fooValue%'); // WHERE about LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $about The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByAbout($about = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($about)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $about)) {
				$about = str_replace('*', '%', $about);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::ABOUT, $about, $comparison);
	}

	/**
	 * Filter the query on the likes column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLikes('fooValue');   // WHERE likes = 'fooValue'
	 * $query->filterByLikes('%fooValue%'); // WHERE likes LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $likes The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByLikes($likes = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($likes)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $likes)) {
				$likes = str_replace('*', '%', $likes);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::LIKES, $likes, $comparison);
	}

	/**
	 * Filter the query on the years_active column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByYearsActive('fooValue');   // WHERE years_active = 'fooValue'
	 * $query->filterByYearsActive('%fooValue%'); // WHERE years_active LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $yearsActive The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByYearsActive($yearsActive = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($yearsActive)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $yearsActive)) {
				$yearsActive = str_replace('*', '%', $yearsActive);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::YEARS_ACTIVE, $yearsActive, $comparison);
	}

	/**
	 * Filter the query on the genres column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByGenres('fooValue');   // WHERE genres = 'fooValue'
	 * $query->filterByGenres('%fooValue%'); // WHERE genres LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $genres The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByGenres($genres = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($genres)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $genres)) {
				$genres = str_replace('*', '%', $genres);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::GENRES, $genres, $comparison);
	}

	/**
	 * Filter the query on the members column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMembers('fooValue');   // WHERE members = 'fooValue'
	 * $query->filterByMembers('%fooValue%'); // WHERE members LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $members The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByMembers($members = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($members)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $members)) {
				$members = str_replace('*', '%', $members);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::MEMBERS, $members, $comparison);
	}

	/**
	 * Filter the query on the website column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
	 * $query->filterByWebsite('%fooValue%'); // WHERE website LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $website The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByWebsite($website = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($website)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $website)) {
				$website = str_replace('*', '%', $website);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::WEBSITE, $website, $comparison);
	}

	/**
	 * Filter the query on the bio column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBio('fooValue');   // WHERE bio = 'fooValue'
	 * $query->filterByBio('%fooValue%'); // WHERE bio LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $bio The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBio($bio = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($bio)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $bio)) {
				$bio = str_replace('*', '%', $bio);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::BIO, $bio, $comparison);
	}

	/**
	 * Filter the query on the record_label column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRecordLabel('fooValue');   // WHERE record_label = 'fooValue'
	 * $query->filterByRecordLabel('%fooValue%'); // WHERE record_label LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $recordLabel The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRecordLabel($recordLabel = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($recordLabel)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $recordLabel)) {
				$recordLabel = str_replace('*', '%', $recordLabel);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::RECORD_LABEL, $recordLabel, $comparison);
	}

	/**
	 * Filter the query on the record_label_link column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRecordLabelLink('fooValue');   // WHERE record_label_link = 'fooValue'
	 * $query->filterByRecordLabelLink('%fooValue%'); // WHERE record_label_link LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $recordLabelLink The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRecordLabelLink($recordLabelLink = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($recordLabelLink)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $recordLabelLink)) {
				$recordLabelLink = str_replace('*', '%', $recordLabelLink);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::RECORD_LABEL_LINK, $recordLabelLink, $comparison);
	}

	/**
	 * Filter the query on the dob column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDob('2011-03-14'); // WHERE dob = '2011-03-14'
	 * $query->filterByDob('now'); // WHERE dob = '2011-03-14'
	 * $query->filterByDob(array('max' => 'yesterday')); // WHERE dob > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $dob The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByDob($dob = null, $comparison = null)
	{
		if (is_array($dob)) {
			$useMinMax = false;
			if (isset($dob['min'])) {
				$this->addUsingAlias(UserPeer::DOB, $dob['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($dob['max'])) {
				$this->addUsingAlias(UserPeer::DOB, $dob['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::DOB, $dob, $comparison);
	}

	/**
	 * Filter the query on the gender column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByGender(1234); // WHERE gender = 1234
	 * $query->filterByGender(array(12, 34)); // WHERE gender IN (12, 34)
	 * $query->filterByGender(array('min' => 12)); // WHERE gender > 12
	 * </code>
	 *
	 * @param     mixed $gender The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByGender($gender = null, $comparison = null)
	{
		if (is_array($gender)) {
			$useMinMax = false;
			if (isset($gender['min'])) {
				$this->addUsingAlias(UserPeer::GENDER, $gender['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($gender['max'])) {
				$this->addUsingAlias(UserPeer::GENDER, $gender['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::GENDER, $gender, $comparison);
	}

	/**
	 * Filter the query on the checksum column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByChecksum('fooValue');   // WHERE checksum = 'fooValue'
	 * $query->filterByChecksum('%fooValue%'); // WHERE checksum LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $checksum The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByChecksum($checksum = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($checksum)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $checksum)) {
				$checksum = str_replace('*', '%', $checksum);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::CHECKSUM, $checksum, $comparison);
	}

	/**
	 * Filter the query on the ip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIp('fooValue');   // WHERE ip = 'fooValue'
	 * $query->filterByIp('%fooValue%'); // WHERE ip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $ip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByIp($ip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($ip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $ip)) {
				$ip = str_replace('*', '%', $ip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::IP, $ip, $comparison);
	}

	/**
	 * Filter the query on the last_login column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastLogin(1234); // WHERE last_login = 1234
	 * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
	 * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
	 * </code>
	 *
	 * @param     mixed $lastLogin The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByLastLogin($lastLogin = null, $comparison = null)
	{
		if (is_array($lastLogin)) {
			$useMinMax = false;
			if (isset($lastLogin['min'])) {
				$this->addUsingAlias(UserPeer::LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($lastLogin['max'])) {
				$this->addUsingAlias(UserPeer::LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::LAST_LOGIN, $lastLogin, $comparison);
	}

	/**
	 * Filter the query on the last_reload column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLastReload(1234); // WHERE last_reload = 1234
	 * $query->filterByLastReload(array(12, 34)); // WHERE last_reload IN (12, 34)
	 * $query->filterByLastReload(array('min' => 12)); // WHERE last_reload > 12
	 * </code>
	 *
	 * @param     mixed $lastReload The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByLastReload($lastReload = null, $comparison = null)
	{
		if (is_array($lastReload)) {
			$useMinMax = false;
			if (isset($lastReload['min'])) {
				$this->addUsingAlias(UserPeer::LAST_RELOAD, $lastReload['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($lastReload['max'])) {
				$this->addUsingAlias(UserPeer::LAST_RELOAD, $lastReload['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::LAST_RELOAD, $lastReload, $comparison);
	}

	/**
	 * Filter the query on the blocked column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBlocked(1234); // WHERE blocked = 1234
	 * $query->filterByBlocked(array(12, 34)); // WHERE blocked IN (12, 34)
	 * $query->filterByBlocked(array('min' => 12)); // WHERE blocked > 12
	 * </code>
	 *
	 * @param     mixed $blocked The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBlocked($blocked = null, $comparison = null)
	{
		if (is_array($blocked)) {
			$useMinMax = false;
			if (isset($blocked['min'])) {
				$this->addUsingAlias(UserPeer::BLOCKED, $blocked['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($blocked['max'])) {
				$this->addUsingAlias(UserPeer::BLOCKED, $blocked['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::BLOCKED, $blocked, $comparison);
	}

	/**
	 * Filter the query on the block_reason column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBlockReason('fooValue');   // WHERE block_reason = 'fooValue'
	 * $query->filterByBlockReason('%fooValue%'); // WHERE block_reason LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $blockReason The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBlockReason($blockReason = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($blockReason)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $blockReason)) {
				$blockReason = str_replace('*', '%', $blockReason);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::BLOCK_REASON, $blockReason, $comparison);
	}

	/**
	 * Filter the query on the reg_date column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRegDate(1234); // WHERE reg_date = 1234
	 * $query->filterByRegDate(array(12, 34)); // WHERE reg_date IN (12, 34)
	 * $query->filterByRegDate(array('min' => 12)); // WHERE reg_date > 12
	 * </code>
	 *
	 * @param     mixed $regDate The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByRegDate($regDate = null, $comparison = null)
	{
		if (is_array($regDate)) {
			$useMinMax = false;
			if (isset($regDate['min'])) {
				$this->addUsingAlias(UserPeer::REG_DATE, $regDate['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($regDate['max'])) {
				$this->addUsingAlias(UserPeer::REG_DATE, $regDate['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::REG_DATE, $regDate, $comparison);
	}

	/**
	 * Filter the query on the wallet column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWallet(1234); // WHERE wallet = 1234
	 * $query->filterByWallet(array(12, 34)); // WHERE wallet IN (12, 34)
	 * $query->filterByWallet(array('min' => 12)); // WHERE wallet > 12
	 * </code>
	 *
	 * @param     mixed $wallet The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByWallet($wallet = null, $comparison = null)
	{
		if (is_array($wallet)) {
			$useMinMax = false;
			if (isset($wallet['min'])) {
				$this->addUsingAlias(UserPeer::WALLET, $wallet['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($wallet['max'])) {
				$this->addUsingAlias(UserPeer::WALLET, $wallet['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::WALLET, $wallet, $comparison);
	}

	/**
	 * Filter the query on the wallet_block column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByWalletBlock(1234); // WHERE wallet_block = 1234
	 * $query->filterByWalletBlock(array(12, 34)); // WHERE wallet_block IN (12, 34)
	 * $query->filterByWalletBlock(array('min' => 12)); // WHERE wallet_block > 12
	 * </code>
	 *
	 * @param     mixed $walletBlock The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByWalletBlock($walletBlock = null, $comparison = null)
	{
		if (is_array($walletBlock)) {
			$useMinMax = false;
			if (isset($walletBlock['min'])) {
				$this->addUsingAlias(UserPeer::WALLET_BLOCK, $walletBlock['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($walletBlock['max'])) {
				$this->addUsingAlias(UserPeer::WALLET_BLOCK, $walletBlock['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::WALLET_BLOCK, $walletBlock, $comparison);
	}

	/**
	 * Filter the query on the fb_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFbId('fooValue');   // WHERE fb_id = 'fooValue'
	 * $query->filterByFbId('%fooValue%'); // WHERE fb_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fbId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByFbId($fbId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fbId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fbId)) {
				$fbId = str_replace('*', '%', $fbId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::FB_ID, $fbId, $comparison);
	}

	/**
	 * Filter the query on the fb_token column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFbToken('fooValue');   // WHERE fb_token = 'fooValue'
	 * $query->filterByFbToken('%fooValue%'); // WHERE fb_token LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fbToken The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByFbToken($fbToken = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fbToken)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fbToken)) {
				$fbToken = str_replace('*', '%', $fbToken);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::FB_TOKEN, $fbToken, $comparison);
	}

	/**
	 * Filter the query on the fb_start column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFbStart(1234); // WHERE fb_start = 1234
	 * $query->filterByFbStart(array(12, 34)); // WHERE fb_start IN (12, 34)
	 * $query->filterByFbStart(array('min' => 12)); // WHERE fb_start > 12
	 * </code>
	 *
	 * @param     mixed $fbStart The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByFbStart($fbStart = null, $comparison = null)
	{
		if (is_array($fbStart)) {
			$useMinMax = false;
			if (isset($fbStart['min'])) {
				$this->addUsingAlias(UserPeer::FB_START, $fbStart['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fbStart['max'])) {
				$this->addUsingAlias(UserPeer::FB_START, $fbStart['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::FB_START, $fbStart, $comparison);
	}

	/**
	 * Filter the query on the tw_start column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwStart(1234); // WHERE tw_start = 1234
	 * $query->filterByTwStart(array(12, 34)); // WHERE tw_start IN (12, 34)
	 * $query->filterByTwStart(array('min' => 12)); // WHERE tw_start > 12
	 * </code>
	 *
	 * @param     mixed $twStart The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByTwStart($twStart = null, $comparison = null)
	{
		if (is_array($twStart)) {
			$useMinMax = false;
			if (isset($twStart['min'])) {
				$this->addUsingAlias(UserPeer::TW_START, $twStart['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twStart['max'])) {
				$this->addUsingAlias(UserPeer::TW_START, $twStart['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::TW_START, $twStart, $comparison);
	}

	/**
	 * Filter the query on the tw_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwId('fooValue');   // WHERE tw_id = 'fooValue'
	 * $query->filterByTwId('%fooValue%'); // WHERE tw_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $twId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByTwId($twId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($twId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $twId)) {
				$twId = str_replace('*', '%', $twId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::TW_ID, $twId, $comparison);
	}

	/**
	 * Filter the query on the tw_oauth_token column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwOauthToken('fooValue');   // WHERE tw_oauth_token = 'fooValue'
	 * $query->filterByTwOauthToken('%fooValue%'); // WHERE tw_oauth_token LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $twOauthToken The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByTwOauthToken($twOauthToken = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($twOauthToken)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $twOauthToken)) {
				$twOauthToken = str_replace('*', '%', $twOauthToken);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::TW_OAUTH_TOKEN, $twOauthToken, $comparison);
	}

	/**
	 * Filter the query on the tw_oauth_token_secret column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwOauthTokenSecret('fooValue');   // WHERE tw_oauth_token_secret = 'fooValue'
	 * $query->filterByTwOauthTokenSecret('%fooValue%'); // WHERE tw_oauth_token_secret LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $twOauthTokenSecret The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByTwOauthTokenSecret($twOauthTokenSecret = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($twOauthTokenSecret)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $twOauthTokenSecret)) {
				$twOauthTokenSecret = str_replace('*', '%', $twOauthTokenSecret);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::TW_OAUTH_TOKEN_SECRET, $twOauthTokenSecret, $comparison);
	}

	/**
	 * Filter the query on the featured column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFeatured(1234); // WHERE featured = 1234
	 * $query->filterByFeatured(array(12, 34)); // WHERE featured IN (12, 34)
	 * $query->filterByFeatured(array('min' => 12)); // WHERE featured > 12
	 * </code>
	 *
	 * @param     mixed $featured The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByFeatured($featured = null, $comparison = null)
	{
		if (is_array($featured)) {
			$useMinMax = false;
			if (isset($featured['min'])) {
				$this->addUsingAlias(UserPeer::FEATURED, $featured['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($featured['max'])) {
				$this->addUsingAlias(UserPeer::FEATURED, $featured['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::FEATURED, $featured, $comparison);
	}

	/**
	 * Filter the query on the is_admin column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsAdmin(1234); // WHERE is_admin = 1234
	 * $query->filterByIsAdmin(array(12, 34)); // WHERE is_admin IN (12, 34)
	 * $query->filterByIsAdmin(array('min' => 12)); // WHERE is_admin > 12
	 * </code>
	 *
	 * @param     mixed $isAdmin The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByIsAdmin($isAdmin = null, $comparison = null)
	{
		if (is_array($isAdmin)) {
			$useMinMax = false;
			if (isset($isAdmin['min'])) {
				$this->addUsingAlias(UserPeer::IS_ADMIN, $isAdmin['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isAdmin['max'])) {
				$this->addUsingAlias(UserPeer::IS_ADMIN, $isAdmin['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::IS_ADMIN, $isAdmin, $comparison);
	}
	
	/**
	 * Filter the query on the is_online column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsOnline(1234); // WHERE is_online = 1234
	 * $query->filterByIsOnline(array(12, 34)); // WHERE is_online IN (12, 34)
	 * $query->filterByIsOnline(array('min' => 12)); // WHERE is_online > 12
	 * </code>
	 *
	 * @param     mixed $isOnline The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByIsOnline($isOnline = null, $comparison = null)
	{
		if (is_array($isOnline)) {
			$useMinMax = false;
			if (isset($isOnline['min'])) {
				$this->addUsingAlias(UserPeer::IS_ONLINE, $isOnline['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($isOnline['max'])) {
				$this->addUsingAlias(UserPeer::IS_ONLINE, $isOnline['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::IS_ONLINE, $isOnline, $comparison);
	}

	/**
	  * Filter the query on the alt_email column
	  *
	  * Example usage:
	  * <code>
	  * $query->filterByAltEmail('fooValue');   // WHERE alt_email = 'fooValue'
	  * $query->filterByAltEmail('%fooValue%'); // WHERE alt_email LIKE '%fooValue%'
	  * </code>
	  *
	  * @param     string $altEmail The value to use as filter.
	  *              Accepts wildcards (* and % trigger a LIKE)
	  * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	  *
	  * @return    UserQuery The current query, for fluid interface
	  */
	 public function filterByAltEmail($altEmail = null, $comparison = null)
	 {
	  if (null === $comparison) {
	   if (is_array($altEmail)) {
		$comparison = Criteria::IN;
	   } elseif (preg_match('/[\%\*]/', $altEmail)) {
		$altEmail = str_replace('*', '%', $altEmail);
		$comparison = Criteria::LIKE;
	   }
	  }
	  return $this->addUsingAlias(UserPeer::ALT_EMAIL, $altEmail, $comparison);
	 }
 
 	/**
	 * Filter the query on the user_phone column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUserPhone('fooValue');   // WHERE user_phone = 'fooValue'
	 * $query->filterByUserPhone('%fooValue%'); // WHERE user_phone LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $userPhone The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByUserPhone($userPhone = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($userPhone)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $userPhone)) {
				$userPhone = str_replace('*', '%', $userPhone);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::USER_PHONE, $userPhone, $comparison);
	}
	
	/**
	 * Filter the query on the state column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
	 * $query->filterByState('%fooValue%'); // WHERE state LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $state The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByState($state = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($state)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $state)) {
				$state = str_replace('*', '%', $state);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::STATE, $state, $comparison);
	}

	/**
	 * Filter the query on the hash_tag column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHashTag('fooValue');   // WHERE hash_tag = 'fooValue'
	 * $query->filterByHashTag('%fooValue%'); // WHERE hash_tag LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $hashTag The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByHashTag($hashTag = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($hashTag)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $hashTag)) {
				$hashTag = str_replace('*', '%', $hashTag);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(UserPeer::HASH_TAG, $hashTag, $comparison);
	}
	public function filterByFbOn($fbOn = null, $comparison = null)
	{
		if (is_array($fbOn)) {
			$useMinMax = false;
			if (isset($fbOn['min'])) {
				$this->addUsingAlias(UserPeer::FB_ON, $fbOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($fbOn['max'])) {
				$this->addUsingAlias(UserPeer::FB_ON, $fbOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::FB_ON, $fbOn, $comparison);
	}

	/**
	 * Filter the query on the tw_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTwOn(1234); // WHERE tw_on = 1234
	 * $query->filterByTwOn(array(12, 34)); // WHERE tw_on IN (12, 34)
	 * $query->filterByTwOn(array('min' => 12)); // WHERE tw_on > 12
	 * </code>
	 *
	 * @param     mixed $twOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByTwOn($twOn = null, $comparison = null)
	{
		if (is_array($twOn)) {
			$useMinMax = false;
			if (isset($twOn['min'])) {
				$this->addUsingAlias(UserPeer::TW_ON, $twOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($twOn['max'])) {
				$this->addUsingAlias(UserPeer::TW_ON, $twOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::TW_ON, $twOn, $comparison);
	}

	/**
	 * Filter the query on the in_on column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByInOn(1234); // WHERE in_on = 1234
	 * $query->filterByInOn(array(12, 34)); // WHERE in_on IN (12, 34)
	 * $query->filterByInOn(array('min' => 12)); // WHERE in_on > 12
	 * </code>
	 *
	 * @param     mixed $inOn The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByInOn($inOn = null, $comparison = null)
	{
		if (is_array($inOn)) {
			$useMinMax = false;
			if (isset($inOn['min'])) {
				$this->addUsingAlias(UserPeer::IN_ON, $inOn['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($inOn['max'])) {
				$this->addUsingAlias(UserPeer::IN_ON, $inOn['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(UserPeer::IN_ON, $inOn, $comparison);
	}	
 
	/**
	 * Filter the query by a related UserFollow object
	 *
	 * @param     UserFollow $userFollow  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByUserFollowRelatedByUserId($userFollow, $comparison = null)
	{
		if ($userFollow instanceof UserFollow) {
			return $this
				->addUsingAlias(UserPeer::ID, $userFollow->getUserId(), $comparison);
		} elseif ($userFollow instanceof PropelCollection) {
			return $this
				->useUserFollowRelatedByUserIdQuery()
				->filterByPrimaryKeys($userFollow->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByUserFollowRelatedByUserId() only accepts arguments of type UserFollow or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the UserFollowRelatedByUserId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinUserFollowRelatedByUserId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserFollowRelatedByUserId');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'UserFollowRelatedByUserId');
		}

		return $this;
	}

	/**
	 * Use the UserFollowRelatedByUserId relation UserFollow object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserFollowQuery A secondary query class using the current class as primary query
	 */
	public function useUserFollowRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUserFollowRelatedByUserId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserFollowRelatedByUserId', 'UserFollowQuery');
	}

	/**
	 * Filter the query by a related UserFollow object
	 *
	 * @param     UserFollow $userFollow  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByUserFollowRelatedByUserIdFollow($userFollow, $comparison = null)
	{
		if ($userFollow instanceof UserFollow) {
			return $this
				->addUsingAlias(UserPeer::ID, $userFollow->getUserIdFollow(), $comparison);
		} elseif ($userFollow instanceof PropelCollection) {
			return $this
				->useUserFollowRelatedByUserIdFollowQuery()
				->filterByPrimaryKeys($userFollow->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByUserFollowRelatedByUserIdFollow() only accepts arguments of type UserFollow or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the UserFollowRelatedByUserIdFollow relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinUserFollowRelatedByUserIdFollow($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('UserFollowRelatedByUserIdFollow');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'UserFollowRelatedByUserIdFollow');
		}

		return $this;
	}

	/**
	 * Use the UserFollowRelatedByUserIdFollow relation UserFollow object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserFollowQuery A secondary query class using the current class as primary query
	 */
	public function useUserFollowRelatedByUserIdFollowQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinUserFollowRelatedByUserIdFollow($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'UserFollowRelatedByUserIdFollow', 'UserFollowQuery');
	}

	/**
	 * Filter the query by a related Wall object
	 *
	 * @param     Wall $wall  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByWallRelatedByUserId($wall, $comparison = null)
	{
		if ($wall instanceof Wall) {
			return $this
				->addUsingAlias(UserPeer::ID, $wall->getUserId(), $comparison);
		} elseif ($wall instanceof PropelCollection) {
			return $this
				->useWallRelatedByUserIdQuery()
				->filterByPrimaryKeys($wall->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByWallRelatedByUserId() only accepts arguments of type Wall or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the WallRelatedByUserId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinWallRelatedByUserId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('WallRelatedByUserId');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'WallRelatedByUserId');
		}

		return $this;
	}

	/**
	 * Use the WallRelatedByUserId relation Wall object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    WallQuery A secondary query class using the current class as primary query
	 */
	public function useWallRelatedByUserIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinWallRelatedByUserId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'WallRelatedByUserId', 'WallQuery');
	}

	/**
	 * Filter the query by a related Wall object
	 *
	 * @param     Wall $wall  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByWallRelatedByUserIdFrom($wall, $comparison = null)
	{
		if ($wall instanceof Wall) {
			return $this
				->addUsingAlias(UserPeer::ID, $wall->getUserIdFrom(), $comparison);
		} elseif ($wall instanceof PropelCollection) {
			return $this
				->useWallRelatedByUserIdFromQuery()
				->filterByPrimaryKeys($wall->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByWallRelatedByUserIdFrom() only accepts arguments of type Wall or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the WallRelatedByUserIdFrom relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinWallRelatedByUserIdFrom($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('WallRelatedByUserIdFrom');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'WallRelatedByUserIdFrom');
		}

		return $this;
	}

	/**
	 * Use the WallRelatedByUserIdFrom relation Wall object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    WallQuery A secondary query class using the current class as primary query
	 */
	public function useWallRelatedByUserIdFromQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinWallRelatedByUserIdFrom($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'WallRelatedByUserIdFrom', 'WallQuery');
	}

	/**
	 * Filter the query by a related MusicAlbum object
	 *
	 * @param     MusicAlbum $musicAlbum  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByMusicAlbum($musicAlbum, $comparison = null)
	{
		if ($musicAlbum instanceof MusicAlbum) {
			return $this
				->addUsingAlias(UserPeer::ID, $musicAlbum->getUserId(), $comparison);
		} elseif ($musicAlbum instanceof PropelCollection) {
			return $this
				->useMusicAlbumQuery()
				->filterByPrimaryKeys($musicAlbum->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMusicAlbum() only accepts arguments of type MusicAlbum or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the MusicAlbum relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinMusicAlbum($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('MusicAlbum');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'MusicAlbum');
		}

		return $this;
	}

	/**
	 * Use the MusicAlbum relation MusicAlbum object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicAlbumQuery A secondary query class using the current class as primary query
	 */
	public function useMusicAlbumQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusicAlbum($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'MusicAlbum', 'MusicAlbumQuery');
	}

	/**
	 * Filter the query by a related Event object
	 *
	 * @param     Event $event  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByEvent($event, $comparison = null)
	{
		if ($event instanceof Event) {
			return $this
				->addUsingAlias(UserPeer::ID, $event->getUserId(), $comparison);
		} elseif ($event instanceof PropelCollection) {
			return $this
				->useEventQuery()
				->filterByPrimaryKeys($event->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEvent() only accepts arguments of type Event or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Event relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinEvent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Event');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Event');
		}

		return $this;
	}

	/**
	 * Use the Event relation Event object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventQuery A secondary query class using the current class as primary query
	 */
	public function useEventQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEvent($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Event', 'EventQuery');
	}

	/**
	 * Filter the query by a related Music object
	 *
	 * @param     Music $music  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByMusic($music, $comparison = null)
	{
		if ($music instanceof Music) {
			return $this
				->addUsingAlias(UserPeer::ID, $music->getUserId(), $comparison);
		} elseif ($music instanceof PropelCollection) {
			return $this
				->useMusicQuery()
				->filterByPrimaryKeys($music->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByMusic() only accepts arguments of type Music or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Music relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinMusic($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Music');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Music');
		}

		return $this;
	}

	/**
	 * Use the Music relation Music object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    MusicQuery A secondary query class using the current class as primary query
	 */
	public function useMusicQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinMusic($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Music', 'MusicQuery');
	}

	/**
	 * Filter the query by a related Video object
	 *
	 * @param     Video $video  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByVideo($video, $comparison = null)
	{
		if ($video instanceof Video) {
			return $this
				->addUsingAlias(UserPeer::ID, $video->getUserId(), $comparison);
		} elseif ($video instanceof PropelCollection) {
			return $this
				->useVideoQuery()
				->filterByPrimaryKeys($video->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByVideo() only accepts arguments of type Video or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Video relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Video');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Video');
		}

		return $this;
	}

	/**
	 * Use the Video relation Video object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VideoQuery A secondary query class using the current class as primary query
	 */
	public function useVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVideo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Video', 'VideoQuery');
	}

	/**
	 * Filter the query by a related VideoPurchase object
	 *
	 * @param     VideoPurchase $videoPurchase  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByVideoPurchase($videoPurchase, $comparison = null)
	{
		if ($videoPurchase instanceof VideoPurchase) {
			return $this
				->addUsingAlias(UserPeer::ID, $videoPurchase->getUserId(), $comparison);
		} elseif ($videoPurchase instanceof PropelCollection) {
			return $this
				->useVideoPurchaseQuery()
				->filterByPrimaryKeys($videoPurchase->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByVideoPurchase() only accepts arguments of type VideoPurchase or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the VideoPurchase relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinVideoPurchase($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('VideoPurchase');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'VideoPurchase');
		}

		return $this;
	}

	/**
	 * Use the VideoPurchase relation VideoPurchase object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    VideoPurchaseQuery A secondary query class using the current class as primary query
	 */
	public function useVideoPurchaseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinVideoPurchase($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'VideoPurchase', 'VideoPurchaseQuery');
	}

	/**
	 * Filter the query by a related Payout object
	 *
	 * @param     Payout $payout  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPayout($payout, $comparison = null)
	{
		if ($payout instanceof Payout) {
			return $this
				->addUsingAlias(UserPeer::ID, $payout->getUserId(), $comparison);
		} elseif ($payout instanceof PropelCollection) {
			return $this
				->usePayoutQuery()
				->filterByPrimaryKeys($payout->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPayout() only accepts arguments of type Payout or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Payout relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinPayout($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Payout');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Payout');
		}

		return $this;
	}

	/**
	 * Use the Payout relation Payout object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PayoutQuery A secondary query class using the current class as primary query
	 */
	public function usePayoutQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPayout($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Payout', 'PayoutQuery');
	}

	/**
	 * Filter the query by a related ShoppingLog object
	 *
	 * @param     ShoppingLog $shoppingLog  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByShoppingLog($shoppingLog, $comparison = null)
	{
		if ($shoppingLog instanceof ShoppingLog) {
			return $this
				->addUsingAlias(UserPeer::ID, $shoppingLog->getUserId(), $comparison);
		} elseif ($shoppingLog instanceof PropelCollection) {
			return $this
				->useShoppingLogQuery()
				->filterByPrimaryKeys($shoppingLog->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByShoppingLog() only accepts arguments of type ShoppingLog or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ShoppingLog relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinShoppingLog($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ShoppingLog');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ShoppingLog');
		}

		return $this;
	}

	/**
	 * Use the ShoppingLog relation ShoppingLog object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ShoppingLogQuery A secondary query class using the current class as primary query
	 */
	public function useShoppingLogQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinShoppingLog($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ShoppingLog', 'ShoppingLogQuery');
	}

	/**
	 * Filter the query by a related Photo object
	 *
	 * @param     Photo $photo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPhoto($photo, $comparison = null)
	{
		if ($photo instanceof Photo) {
			return $this
				->addUsingAlias(UserPeer::ID, $photo->getUserId(), $comparison);
		} elseif ($photo instanceof PropelCollection) {
			return $this
				->usePhotoQuery()
				->filterByPrimaryKeys($photo->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPhoto() only accepts arguments of type Photo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Photo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinPhoto($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Photo');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Photo');
		}

		return $this;
	}

	/**
	 * Use the Photo relation Photo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoQuery A secondary query class using the current class as primary query
	 */
	public function usePhotoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPhoto($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Photo', 'PhotoQuery');
	}

	/**
	 * Filter the query by a related PhotoAlbum object
	 *
	 * @param     PhotoAlbum $photoAlbum  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPhotoAlbum($photoAlbum, $comparison = null)
	{
		if ($photoAlbum instanceof PhotoAlbum) {
			return $this
				->addUsingAlias(UserPeer::ID, $photoAlbum->getUserId(), $comparison);
		} elseif ($photoAlbum instanceof PropelCollection) {
			return $this
				->usePhotoAlbumQuery()
				->filterByPrimaryKeys($photoAlbum->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPhotoAlbum() only accepts arguments of type PhotoAlbum or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PhotoAlbum relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinPhotoAlbum($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PhotoAlbum');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PhotoAlbum');
		}

		return $this;
	}

	/**
	 * Use the PhotoAlbum relation PhotoAlbum object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PhotoAlbumQuery A secondary query class using the current class as primary query
	 */
	public function usePhotoAlbumQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPhotoAlbum($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PhotoAlbum', 'PhotoAlbumQuery');
	}

	/**
	 * Filter the query by a related PaymentInfo object
	 *
	 * @param     PaymentInfo $paymentInfo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByPaymentInfo($paymentInfo, $comparison = null)
	{
		if ($paymentInfo instanceof PaymentInfo) {
			return $this
				->addUsingAlias(UserPeer::ID, $paymentInfo->getUserId(), $comparison);
		} elseif ($paymentInfo instanceof PropelCollection) {
			return $this
				->usePaymentInfoQuery()
				->filterByPrimaryKeys($paymentInfo->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByPaymentInfo() only accepts arguments of type PaymentInfo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the PaymentInfo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinPaymentInfo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('PaymentInfo');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'PaymentInfo');
		}

		return $this;
	}

	/**
	 * Use the PaymentInfo relation PaymentInfo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    PaymentInfoQuery A secondary query class using the current class as primary query
	 */
	public function usePaymentInfoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinPaymentInfo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'PaymentInfo', 'PaymentInfoQuery');
	}

	/**
	 * Filter the query by a related BroadcastViewers object
	 *
	 * @param     BroadcastViewers $broadcastViewers  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBroadcastViewers($broadcastViewers, $comparison = null)
	{
		if ($broadcastViewers instanceof BroadcastViewers) {
			return $this
				->addUsingAlias(UserPeer::ID, $broadcastViewers->getUserId(), $comparison);
		} elseif ($broadcastViewers instanceof PropelCollection) {
			return $this
				->useBroadcastViewersQuery()
				->filterByPrimaryKeys($broadcastViewers->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByBroadcastViewers() only accepts arguments of type BroadcastViewers or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the BroadcastViewers relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinBroadcastViewers($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('BroadcastViewers');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'BroadcastViewers');
		}

		return $this;
	}

	/**
	 * Use the BroadcastViewers relation BroadcastViewers object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BroadcastViewersQuery A secondary query class using the current class as primary query
	 */
	public function useBroadcastViewersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBroadcastViewers($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'BroadcastViewers', 'BroadcastViewersQuery');
	}

	/**
	 * Filter the query by a related BroadcastFlows object
	 *
	 * @param     BroadcastFlows $broadcastFlows  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByBroadcastFlows($broadcastFlows, $comparison = null)
	{
		if ($broadcastFlows instanceof BroadcastFlows) {
			return $this
				->addUsingAlias(UserPeer::ID, $broadcastFlows->getUserId(), $comparison);
		} elseif ($broadcastFlows instanceof PropelCollection) {
			return $this
				->useBroadcastFlowsQuery()
				->filterByPrimaryKeys($broadcastFlows->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByBroadcastFlows() only accepts arguments of type BroadcastFlows or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the BroadcastFlows relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinBroadcastFlows($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('BroadcastFlows');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'BroadcastFlows');
		}

		return $this;
	}

	/**
	 * Use the BroadcastFlows relation BroadcastFlows object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BroadcastFlowsQuery A secondary query class using the current class as primary query
	 */
	public function useBroadcastFlowsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBroadcastFlows($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'BroadcastFlows', 'BroadcastFlowsQuery');
	}

	/**
	 * Filter the query by a related EventVideo object
	 *
	 * @param     EventVideo $eventVideo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function filterByEventVideo($eventVideo, $comparison = null)
	{
		if ($eventVideo instanceof EventVideo) {
			return $this
				->addUsingAlias(UserPeer::ID, $eventVideo->getUserId(), $comparison);
		} elseif ($eventVideo instanceof PropelCollection) {
			return $this
				->useEventVideoQuery()
				->filterByPrimaryKeys($eventVideo->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByEventVideo() only accepts arguments of type EventVideo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the EventVideo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function joinEventVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('EventVideo');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'EventVideo');
		}

		return $this;
	}

	/**
	 * Use the EventVideo relation EventVideo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    EventVideoQuery A secondary query class using the current class as primary query
	 */
	public function useEventVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinEventVideo($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'EventVideo', 'EventVideoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     User $user Object to remove from the list of results
	 *
	 * @return    UserQuery The current query, for fluid interface
	 */
	public function prune($user = null)
	{
		if ($user) {
			$this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseUserQuery