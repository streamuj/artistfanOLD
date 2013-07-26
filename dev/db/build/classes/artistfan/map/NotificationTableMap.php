<?php



/**
 * This class defines the structure of the 'notification' table.
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
class NotificationTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.NotificationTableMap';

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
		$this->setName('notification');
		$this->setPhpName('Notification');
		$this->setClassname('Notification');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('NA_ID', 'NaId', 'INTEGER', true, null, null);
		$this->addColumn('NA_WALL_ID', 'NaWallId', 'INTEGER', false, 11, 0);
		$this->addColumn('NA_COMMENT_ID', 'NaCommentId', 'INTEGER', false, 11, 0);
		$this->addColumn('NA_MESSAGE', 'NaMessage', 'VARCHAR', false, 255, '0');
		$this->addColumn('NA_USER_ID', 'NaUserId', 'INTEGER', false, 255, 0);
		$this->addColumn('NA_STATUS', 'NaStatus', 'TINYINT', false, 1, 0);
		$this->addColumn('NA_DATE', 'NaDate', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // NotificationTableMap
