<?php



/**
 * This class defines the structure of the 'music_purchase' table.
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
class MusicPurchaseTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.MusicPurchaseTableMap';

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
		$this->setName('music_purchase');
		$this->setPhpName('MusicPurchase');
		$this->setClassname('MusicPurchase');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USER_ID', 'UserId', 'INTEGER', false, 11, 0);
		$this->addForeignKey('MUSIC_ID', 'MusicId', 'INTEGER', 'music', 'ID', false, 11, 0);
		$this->addColumn('WITH_ALL_ALBUM', 'WithAllAlbum', 'TINYINT', false, 1, 0);
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('IS_DELETE', 'IsDelete', 'TINYINT', false, 1, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Music', 'Music', RelationMap::MANY_TO_ONE, array('music_id' => 'id', ), null, null);
		$this->addRelation('MusicRelatedById', 'Music', RelationMap::ONE_TO_ONE, array('music_id' => 'id', ), null, null);
	} // buildRelations()

} // MusicPurchaseTableMap
