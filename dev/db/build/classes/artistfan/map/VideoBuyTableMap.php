<?php



/**
 * This class defines the structure of the 'video_buy' table.
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
class VideoBuyTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.VideoBuyTableMap';

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
		$this->setName('video_buy');
		$this->setPhpName('VideoBuy');
		$this->setClassname('VideoBuy');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('USER_ID', 'UserId', 'INTEGER', false, 11, 0);
		$this->addForeignKey('VIDEO_ID', 'VideoId', 'INTEGER', 'video', 'ID', false, 11, 0);
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Video', 'Video', RelationMap::MANY_TO_ONE, array('video_id' => 'id', ), null, null);
	} // buildRelations()

} // VideoBuyTableMap
