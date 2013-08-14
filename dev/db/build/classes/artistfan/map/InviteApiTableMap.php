<?php



/**
 * This class defines the structure of the 'invite_api' table.
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
class InviteApiTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.InviteApiTableMap';

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
		$this->setName('invite_api');
		$this->setPhpName('InviteApi');
		$this->setClassname('InviteApi');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('IA_ID', 'IaId', 'INTEGER', true, null, null);
		$this->addColumn('IA_USER_ID', 'IaUserId', 'INTEGER', false, null, 0);
		$this->addColumn('IA_EMAIL', 'IaEmail', 'VARCHAR', false, 200, '0');
		$this->addColumn('IA_TYPE', 'IaType', 'VARCHAR', false, 50, '');
		$this->addColumn('CDATE', 'Cdate', 'INTEGER', false, null, 0);
		$this->addColumn('MDATE', 'Mdate', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // InviteApiTableMap
