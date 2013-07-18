<?php



/**
 * This class defines the structure of the 'invitation' table.
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
class InvitationTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.InvitationTableMap';

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
		$this->setName('invitation');
		$this->setPhpName('Invitation');
		$this->setClassname('Invitation');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('INV_ID', 'InvId', 'INTEGER', true, null, null);
		$this->addColumn('INV_INVITER', 'InvInviter', 'INTEGER', true, null, 0);
		$this->addColumn('INV_INVITEE', 'InvInvitee', 'INTEGER', false, null, 0);
		$this->addColumn('INV_NAME', 'InvName', 'VARCHAR', false, 255, null);
		$this->addColumn('INV_EMAIL', 'InvEmail', 'VARCHAR', false, 200, null);
		$this->addColumn('INV_FBID', 'InvFbid', 'VARCHAR', false, 200, null);
		$this->addColumn('INV_STATUS', 'InvStatus', 'TINYINT', false, 1, null);
		$this->addColumn('CDATE', 'Cdate', 'INTEGER', false, null, 0);
		$this->addColumn('MDATE', 'Mdate', 'INTEGER', false, null, 0);
		$this->addColumn('INV_TWID', 'InvTwid', 'VARCHAR', false, 200, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // InvitationTableMap
