<?php



/**
 * This class defines the structure of the 'video' table.
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
class VideoTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.VideoTableMap';

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
		$this->setName('video');
		$this->setPhpName('Video');
		$this->setClassname('Video');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, '');
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('VIDEO', 'Video', 'VARCHAR', false, 250, '');
		$this->addColumn('VIDEO_PREVIEW', 'VideoPreview', 'VARCHAR', false, 250, '');
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('ACTIVE', 'Active', 'TINYINT', false, 1, 0);
		$this->addColumn('DELETED', 'Deleted', 'TINYINT', false, 1, 0);
		$this->addColumn('FROM_YT', 'FromYt', 'TINYINT', false, 1, 0);
		$this->addColumn('STATUS', 'Status', 'TINYINT', false, 1, 0);
		$this->addColumn('FEATURED', 'Featured', 'TINYINT', false, 1, 0);
		$this->addColumn('PAY_MORE', 'PayMore', 'TINYINT', false, 1, 0);
		$this->addColumn('VIDEO_LENGTH', 'VideoLength', 'VARCHAR', false, 20, null);
		$this->addColumn('VIDEO_COUNT', 'VideoCount', 'INTEGER', false, 11, 0);
		$this->addColumn('VIDEO_TYPE', 'VideoType', 'TINYINT', false, 2, 1);
		//$this->addColumn('VIDEO_DATE', 'VideoDate', 'DATE', false, null, null);		
		$this->addColumn('VIDEO_DATE', 'VideoDate', 'DATE', false, null, '0000-00-00');		
		$this->addColumn('VIDEO_IMAGE', 'VideoImage', 'VARCHAR', false, 255, '150');
		$this->addColumn('EMAIL_SENT', 'EmailSent', 'TINYINT', false, 2, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('VideoPurchase', 'VideoPurchase', RelationMap::ONE_TO_MANY, array('id' => 'video_id', ), null, null, 'VideoPurchases');
	} // buildRelations()

} // VideoTableMap
