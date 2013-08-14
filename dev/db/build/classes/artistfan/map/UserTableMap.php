<?php



/**
 * This class defines the structure of the 'user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.artistfan.map
 */
class UserTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.UserTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('user');
		$this->setPhpName('User');
		$this->setClassname('User');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', true, 255, '');
		$this->addColumn('STATUS', 'Status', 'TINYINT', false, 3, 0);
		$this->addColumn('EMAIL_CONFIRMED', 'EmailConfirmed', 'TINYINT', false, 1, 0);
		$this->addColumn('FIRST_NAME', 'FirstName', 'VARCHAR', false, 26, '');
		$this->addColumn('LAST_NAME', 'LastName', 'VARCHAR', false, 26, '');
		$this->addColumn('BAND_NAME', 'BandName', 'VARCHAR', false, 150, '');
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 40, '');
		$this->addColumn('PASS', 'Pass', 'VARCHAR', false, 100, '');
		$this->addColumn('AVATAR', 'Avatar', 'VARCHAR', false, 100, '');
		$this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 2, '');
		$this->addColumn('LOCATION', 'Location', 'VARCHAR', false, 250, '');
		$this->addColumn('HIDE_LOC', 'HideLoc', 'TINYINT', false, 1, 0);
		$this->addColumn('ZIP', 'Zip', 'VARCHAR', false, 20, '');
		$this->addColumn('ABOUT', 'About', 'LONGVARCHAR', false, null, null);
		$this->addColumn('LIKES', 'Likes', 'VARCHAR', false, 250, '');
		$this->addColumn('YEARS_ACTIVE', 'YearsActive', 'VARCHAR', false, 250, null);
		$this->addColumn('GENRES', 'Genres', 'VARCHAR', false, 250, null);
		$this->addColumn('MEMBERS', 'Members', 'LONGVARCHAR', false, null, null);
		$this->addColumn('WEBSITE', 'Website', 'VARCHAR', false, 250, null);
		$this->addColumn('BIO', 'Bio', 'LONGVARCHAR', false, null, null);
		$this->addColumn('RECORD_LABEL', 'RecordLabel', 'LONGVARCHAR', false, null, null);
		$this->addColumn('RECORD_LABEL_LINK', 'RecordLabelLink', 'LONGVARCHAR', false, null, null);
		$this->addColumn('DOB', 'Dob', 'DATE', false, null, '0000-00-00');
		$this->addColumn('GENDER', 'Gender', 'TINYINT', false, 2, 0);
		$this->addColumn('CHECKSUM', 'Checksum', 'VARCHAR', false, 250, '');
		$this->addColumn('IP', 'Ip', 'VARCHAR', false, 15, '');
		$this->addColumn('LAST_LOGIN', 'LastLogin', 'INTEGER', false, 11, 0);
		$this->addColumn('LAST_RELOAD', 'LastReload', 'INTEGER', false, 11, 0);
		$this->addColumn('BLOCKED', 'Blocked', 'TINYINT', false, 3, 0);
		$this->addColumn('BLOCK_REASON', 'BlockReason', 'VARCHAR', false, 250, '');
		$this->addColumn('REG_DATE', 'RegDate', 'INTEGER', false, 11, 0);
		$this->addColumn('WALLET', 'Wallet', 'FLOAT', false, null, 0);
		$this->addColumn('WALLET_BLOCK', 'WalletBlock', 'FLOAT', false, null, 0);
		$this->addColumn('FB_ID', 'FbId', 'VARCHAR', false, 100, '');
		$this->addColumn('FB_TOKEN', 'FbToken', 'VARCHAR', false, 200, '');
		$this->addColumn('FB_START', 'FbStart', 'INTEGER', false, 1, 0);
		$this->addColumn('TW_START', 'TwStart', 'INTEGER', false, 1, 0);
		$this->addColumn('TW_ID', 'TwId', 'VARCHAR', false, 100, '');
		$this->addColumn('TW_OAUTH_TOKEN', 'TwOauthToken', 'VARCHAR', false, 200, '');
		$this->addColumn('TW_OAUTH_TOKEN_SECRET', 'TwOauthTokenSecret', 'VARCHAR', false, 200, '');
		$this->addColumn('FEATURED', 'Featured', 'TINYINT', false, 1, 0);
		$this->addColumn('IS_ADMIN', 'IsAdmin', 'TINYINT', false, 1, 0);
		$this->addColumn('IS_ONLINE', 'IsOnline', 'TINYINT', false, 1, 0);
		$this->addColumn('ALT_EMAIL', 'AltEmail', 'LONGVARCHAR', false, null, null);
		$this->addColumn('USER_PHONE', 'UserPhone', 'VARCHAR', false, 50, '');
		$this->addColumn('STATE', 'State', 'VARCHAR', false, 150, null);
		$this->addColumn('HASH_TAG', 'HashTag', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FB_ON', 'FbOn', 'TINYINT', false, 2, 1);
		$this->addColumn('TW_ON', 'TwOn', 'TINYINT', false, 2, 1);
		$this->addColumn('IN_ON', 'InOn', 'TINYINT', false, 2, 1);		
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('UserFollowRelatedByUserId', 'UserFollow', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'UserFollowsRelatedByUserId');
		$this->addRelation('UserFollowRelatedByUserIdFollow', 'UserFollow', RelationMap::ONE_TO_MANY, array('id' => 'user_id_follow', ), null, null, 'UserFollowsRelatedByUserIdFollow');
		$this->addRelation('WallRelatedByUserId', 'Wall', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'WallsRelatedByUserId');
		$this->addRelation('WallRelatedByUserIdFrom', 'Wall', RelationMap::ONE_TO_MANY, array('id' => 'user_id_from', ), null, null, 'WallsRelatedByUserIdFrom');
		$this->addRelation('MusicAlbum', 'MusicAlbum', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'MusicAlbums');
		$this->addRelation('Event', 'Event', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Events');
		$this->addRelation('Music', 'Music', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Musics');
		$this->addRelation('Video', 'Video', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Videos');
		$this->addRelation('VideoPurchase', 'VideoPurchase', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'VideoPurchases');
		$this->addRelation('Payout', 'Payout', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Payouts');
		$this->addRelation('ShoppingLog', 'ShoppingLog', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'ShoppingLogs');
		$this->addRelation('Photo', 'Photo', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'Photos');
		$this->addRelation('PhotoAlbum', 'PhotoAlbum', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'PhotoAlbums');
		$this->addRelation('PaymentInfo', 'PaymentInfo', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'PaymentInfos');
		$this->addRelation('BroadcastViewers', 'BroadcastViewers', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'BroadcastViewerss');
		$this->addRelation('BroadcastFlows', 'BroadcastFlows', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'BroadcastFlowss');
		$this->addRelation('EventVideo', 'EventVideo', RelationMap::ONE_TO_MANY, array('id' => 'user_id', ), null, null, 'EventVideos');
	} // buildRelations()

} // UserTableMap
