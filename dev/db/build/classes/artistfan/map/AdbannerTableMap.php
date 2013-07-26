<?php



/**
 * This class defines the structure of the 'adbanner' table.
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
class AdbannerTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.AdbannerTableMap';

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
		$this->setName('adbanner');
		$this->setPhpName('Adbanner');
		$this->setClassname('Adbanner');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ADB_ID', 'AdbId', 'INTEGER', true, null, null);
		$this->addColumn('ADB_CAT_ID', 'AdbCatId', 'INTEGER', true, null, 0);
		$this->addColumn('ADB_IMAGE', 'AdbImage', 'VARCHAR', true, 255, '');
		$this->addColumn('ADB_TYPE', 'AdbType', 'INTEGER', true, null, 0);
		$this->addColumn('ADB_NEW', 'AdbNew', 'TINYINT', true, 1, 0);
		$this->addColumn('ADB_LINK', 'AdbLink', 'LONGVARCHAR', false, null, null);
		$this->addColumn('ADB_STATUS', 'AdbStatus', 'TINYINT', true, 2, 0);
		$this->addColumn('CREATED_ON', 'CreatedOn', 'INTEGER', true, null, 0);
		$this->addColumn('CREATED_BY', 'CreatedBy', 'INTEGER', true, null, 0);
		$this->addColumn('MODIFIED_ON', 'ModifiedOn', 'INTEGER', true, null, 0);
		$this->addColumn('MODIFIED_BY', 'ModifiedBy', 'INTEGER', true, null, 0);
		$this->addColumn('ADB_ORDER', 'AdbOrder', 'INTEGER', false, null, 0);
		$this->addColumn('ADB_PAGE', 'AdbPage', 'VARCHAR', false, 255, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AdbannerTableMap
