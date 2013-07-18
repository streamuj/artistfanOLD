<?php



/**
 * This class defines the structure of the 'photo_album' table.
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
class PhotoAlbumTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.PhotoAlbumTableMap';

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
		$this->setName('photo_album');
		$this->setPhpName('PhotoAlbum');
		$this->setClassname('PhotoAlbum');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, '');
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('Photo', 'Photo', RelationMap::ONE_TO_MANY, array('id' => 'album_id', ), null, null, 'Photos');
	} // buildRelations()

} // PhotoAlbumTableMap
