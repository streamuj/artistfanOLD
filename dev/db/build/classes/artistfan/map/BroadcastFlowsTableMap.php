<?php



/**
 * This class defines the structure of the 'broadcast_flows' table.
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
class BroadcastFlowsTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.BroadcastFlowsTableMap';

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
		$this->setName('broadcast_flows');
		$this->setPhpName('BroadcastFlows');
		$this->setClassname('BroadcastFlows');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('EVENT_ID', 'EventId', 'INTEGER', false, 11, 0);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('FLOW', 'Flow', 'VARCHAR', false, 250, '');
		$this->addColumn('STATUS', 'Status', 'TINYINT', false, 1, 0);
		$this->addColumn('USED', 'Used', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
	} // buildRelations()

} // BroadcastFlowsTableMap
