<?php



/**
 * This class defines the structure of the 'adbanner_type' table.
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
class AdbannerTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.AdbannerTypeTableMap';

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
		$this->setName('adbanner_type');
		$this->setPhpName('AdbannerType');
		$this->setClassname('AdbannerType');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ADBT_ID', 'AdbtId', 'INTEGER', true, null, null);
		$this->addColumn('ADBT_NAME', 'AdbtName', 'VARCHAR', true, 150, '');
		$this->addColumn('ADBT_IMG_WIDTH', 'AdbtImgWidth', 'INTEGER', true, 11, 0);
		$this->addColumn('ADBT_IMG_HEIGHT', 'AdbtImgHeight', 'INTEGER', true, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AdbannerTypeTableMap
