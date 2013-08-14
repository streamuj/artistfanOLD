<?php



/**
 * This class defines the structure of the 'event' table.
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
class EventTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.EventTableMap';

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
		$this->setName('event');
		$this->setPhpName('Event');
		$this->setClassname('Event');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, '');
		$this->addColumn('DESCR', 'Descr', 'LONGVARCHAR', false, null, null);
		$this->addColumn('EVENT_TYPE', 'EventType', 'INTEGER', false, 11, 0);
		$this->addColumn('LOCATION', 'Location', 'VARCHAR', false, 255, null);
		$this->addColumn('PRICE', 'Price', 'FLOAT', false, null, 0);
		$this->addColumn('EVENT_DATE', 'EventDate', 'TIMESTAMP', false, null, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', false, 50, '');
		$this->addColumn('TICKET_URL', 'TicketUrl', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 1, 0);
		$this->addColumn('STATUS', 'Status', 'TINYINT', false, 1, 1);
		$this->addColumn('DELETED', 'Deleted', 'TINYINT', false, 1, 0);
		$this->addColumn('EVENT_PHOTO', 'EventPhoto', 'VARCHAR', false, 50, '');
		$this->addColumn('EVENT_APP', 'EventApp', 'TINYINT', false, 1, 0);
		$this->addColumn('DURATION', 'Duration', 'INTEGER', false, 4, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('EventAttend', 'EventAttend', RelationMap::ONE_TO_MANY, array('id' => 'event_id', ), null, null, 'EventAttends');
		$this->addRelation('EventPurchase', 'EventPurchase', RelationMap::ONE_TO_MANY, array('id' => 'event_id', ), null, null, 'EventPurchases');
		$this->addRelation('EventVideo', 'EventVideo', RelationMap::ONE_TO_MANY, array('id' => 'event_id', ), null, null, 'EventVideos');
	} // buildRelations()

} // EventTableMap
