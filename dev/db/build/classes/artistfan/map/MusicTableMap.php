<?php

/**
 * This class defines the structure of the 'music' table.
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
class MusicTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.MusicTableMap';

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
		$this->setName('music');
		$this->setPhpName('Music');
		$this->setClassname('Music');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'music_purchase', 'MUSIC_ID', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, '');
		$this->addForeignKey('ALBUM_ID', 'AlbumId', 'INTEGER', 'music_album', 'ID', false, 11, 0);
		$this->addColumn('GENRE', 'Genre', 'VARCHAR', false, 250, '');
		$this->addColumn('DATE_RELEASE', 'DateRelease', 'DATE', false, null, '0000-00-00');
		$this->addColumn('LABEL', 'Label', 'VARCHAR', false, 250, '');
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('TRACK', 'Track', 'VARCHAR', false, 100, '');
		$this->addColumn('TRACK_PREVIEW', 'TrackPreview', 'VARCHAR', false, 100, '');
		$this->addColumn('TRACK_LENGTH', 'TrackLength', 'VARCHAR', false, 20, '');
		$this->addColumn('TRACK_PREVIEW_LENGTH', 'TrackPreviewLength', 'VARCHAR', false, 20, '');
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('ACTIVE', 'Active', 'TINYINT', false, 1, 0);
		$this->addColumn('DELETED', 'Deleted', 'TINYINT', false, 1, 0);
		$this->addColumn('STATUS', 'Status', 'TINYINT', false, 1, 0);
		$this->addColumn('UPC_CODE', 'UpcCode', 'VARCHAR', false, 50, '');
		$this->addColumn('PAY_MORE', 'PayMore', 'TINYINT', false, 1, 0);
		$this->addColumn('SORT_ORDER', 'SortOrder', 'INTEGER', false, 4, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('MusicAlbum', 'MusicAlbum', RelationMap::MANY_TO_ONE, array('album_id' => 'id', ), null, null);
		$this->addRelation('MusicPurchase', 'MusicPurchase', RelationMap::MANY_TO_ONE, array('id' => 'music_id', ), null, null);
		$this->addRelation('MusicPurchaseRelatedByMusicId', 'MusicPurchase', RelationMap::ONE_TO_MANY, array('id' => 'music_id', ), null, null, 'MusicPurchasesRelatedByMusicId');
	} // buildRelations()

} // MusicTableMap
