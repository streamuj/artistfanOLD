<?php



/**
 * This class defines the structure of the 'home' table.
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
class HomeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.HomeTableMap';

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
		$this->setName('home');
		$this->setPhpName('Home');
		$this->setClassname('Home');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('HOME_ID', 'HomeId', 'INTEGER', true, null, null);
		$this->addColumn('ARTIST_ID', 'ArtistId', 'INTEGER', false, null, 0);
		$this->addColumn('VIDEO_ID', 'VideoId', 'INTEGER', false, null, 0);
		$this->addColumn('EVENT_ID', 'EventId', 'INTEGER', false, null, 0);
		$this->addColumn('MUSIC_ID', 'MusicId', 'INTEGER', false, null, 0);
		$this->addColumn('MUSIC_ALBUM_ID', 'MusicAlbumId', 'INTEGER', false, null, 0);
		$this->addColumn('LINK', 'Link', 'VARCHAR', false, 150, '');
		$this->addColumn('HOME_ORDER', 'HomeOrder', 'INTEGER', false, null, 0);
		$this->addColumn('CDATE', 'Cdate', 'INTEGER', false, null, 0);
		$this->addColumn('MDATE', 'Mdate', 'INTEGER', false, null, 0);
		$this->addColumn('HOME_CAT', 'HomeCat', 'INTEGER', false, null, 0);
		$this->addColumn('IMAGE_PATH', 'ImagePath', 'VARCHAR', false, 150, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // HomeTableMap
