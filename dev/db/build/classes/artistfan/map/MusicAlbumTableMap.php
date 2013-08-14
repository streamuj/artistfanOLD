<?php



/**
 * This class defines the structure of the 'music_album' table.
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
class MusicAlbumTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.MusicAlbumTableMap';

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
		$this->setName('music_album');
		$this->setPhpName('MusicAlbum');
		$this->setClassname('MusicAlbum');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 250, '');
		$this->addColumn('DESCR', 'Descr', 'LONGVARCHAR', false, null, null);
		$this->addColumn('DATE_RELEASE', 'DateRelease', 'DATE', false, null, '0000-00-00');
		$this->addColumn('IMAGE', 'Image', 'VARCHAR', false, 100, '');
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('ACTIVE', 'Active', 'TINYINT', false, 1, 0);
		$this->addColumn('DELETED', 'Deleted', 'TINYINT', false, 1, 0);
		$this->addColumn('FEATURED', 'Featured', 'TINYINT', false, 1, 0);
		$this->addColumn('ALBUM_PAY_MORE', 'AlbumPayMore', 'TINYINT', false, 1, 0);
		$this->addColumn('GENRE', 'Genre', 'VARCHAR', false, 250, '');
		$this->addColumn('LABEL', 'Label', 'VARCHAR', false, 250, '');
		$this->addColumn('IS_SINGLE', 'IsSingle', 'TINYINT', false, 1, 0);
		$this->addColumn('EMAIL_SENT', 'EmailSent', 'TINYINT', false, 2, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('Music', 'Music', RelationMap::ONE_TO_MANY, array('id' => 'album_id', ), null, null, 'Musics');
	} // buildRelations()

} // MusicAlbumTableMap
