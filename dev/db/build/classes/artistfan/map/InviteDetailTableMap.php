<?php



/**
 * This class defines the structure of the 'invite_detail' table.
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
class InviteDetailTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.InviteDetailTableMap';

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
		$this->setName('invite_detail');
		$this->setPhpName('InviteDetail');
		$this->setClassname('InviteDetail');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('ID_API_ID', 'IdApiId', 'INTEGER', false, null, 0);
		$this->addColumn('ID_NAME', 'IdName', 'VARCHAR', false, 255, '');
		$this->addColumn('ID_EMAIL', 'IdEmail', 'VARCHAR', false, 150, '');
		$this->addColumn('ID_FBID', 'IdFbid', 'VARCHAR', false, 200, '');
		$this->addColumn('CDATE', 'Cdate', 'INTEGER', false, null, 0);
		$this->addColumn('MDATE', 'Mdate', 'INTEGER', false, null, 0);
		$this->addColumn('ID_TWID', 'IdTwid', 'VARCHAR', false, 200, '');
		$this->addColumn('ID_IMAGE', 'IdImage', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // InviteDetailTableMap
