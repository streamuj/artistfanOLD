<?php



/**
 * This class defines the structure of the 'wall' table.
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
class WallTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.WallTableMap';

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
		$this->setName('wall');
		$this->setPhpName('Wall');
		$this->setClassname('Wall');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addForeignKey('USER_ID_FROM', 'UserIdFrom', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('MESG', 'Mesg', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PHOTO', 'Photo', 'VARCHAR', false, null, null);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 1, 0);
		$this->addColumn('CDATE', 'Cdate', 'INTEGER', false, 1, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('UserToK', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('UserFromK', 'User', RelationMap::MANY_TO_ONE, array('user_id_from' => 'id', ), null, null);
	} // buildRelations()

} // WallTableMap
