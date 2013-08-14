<?php



/**
 * This class defines the structure of the 'photo' table.
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
class PhotoTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.PhotoTableMap';

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
		$this->setName('photo');
		$this->setPhpName('Photo');
		$this->setClassname('Photo');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'LONGVARCHAR', false, null, null);
		$this->addForeignKey('ALBUM_ID', 'AlbumId', 'INTEGER', 'photo_album', 'ID', false, 11, 0);
		$this->addColumn('PHOTO_DATE', 'PhotoDate', 'DATE', false, null, '0000-00-00');
		$this->addColumn('IMAGE', 'Image', 'VARCHAR', false, 100, '');
		$this->addColumn('IS_COVER', 'IsCover', 'TINYINT', false, 1, 0);
		$this->addColumn('SLIDE', 'Slide', 'TINYINT', false, 1, 0);
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('LINK', 'Link', 'VARCHAR', false, 250, null);
		$this->addColumn('IS_NEW', 'IsNew', 'TINYINT', false, 1, 0);
		$this->addColumn('WALL_ID', 'WallId', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('PhotoAlbum', 'PhotoAlbum', RelationMap::MANY_TO_ONE, array('album_id' => 'id', ), null, null);
	} // buildRelations()

} // PhotoTableMap
