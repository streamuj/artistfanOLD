<?php



/**
 * This class defines the structure of the 'emil_notification_type' table.
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
class EmailNotificationTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.EmailNotificationTypeTableMap';

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
		$this->setName('emil_notification_type');
		$this->setPhpName('EmailNotificationType');
		$this->setClassname('EmailNotificationType');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ENT_ID', 'EntId', 'INTEGER', true, null, null);
		$this->addColumn('ENT_NAME', 'EntName', 'VARCHAR', false, 255, '');
		$this->addColumn('ENT_STATUS', 'EntStatus', 'TINYINT', false, 1, 1);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // EmailNotificationTypeTableMap
