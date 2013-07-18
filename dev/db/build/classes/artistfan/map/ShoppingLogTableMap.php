<?php



/**
 * This class defines the structure of the 'shopping_log' table.
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
class ShoppingLogTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.ShoppingLogTableMap';

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
		$this->setName('shopping_log');
		$this->setPhpName('ShoppingLog');
		$this->setClassname('ShoppingLog');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('WALL_ID', 'WallId', 'INTEGER', false, 11, 0);
		$this->addColumn('ARTIST_ID', 'ArtistId', 'INTEGER', false, 11, 0);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('ACTION', 'Action', 'VARCHAR', false, 15, '');
		$this->addColumn('MONEY', 'Money', 'FLOAT', false, null, 0);
		$this->addColumn('ALBUM_ID', 'AlbumId', 'INTEGER', false, 11, 0);
		$this->addColumn('MUSIC_ID', 'MusicId', 'INTEGER', false, 11, 0);
		$this->addColumn('VIDEO_ID', 'VideoId', 'INTEGER', false, 11, 0);
		$this->addColumn('EVENT_ID', 'EventId', 'INTEGER', false, 11, 0);
		$this->addColumn('DATA', 'Data', 'VARCHAR', false, 255, '');
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
	} // buildRelations()

} // ShoppingLogTableMap
