<?php



/**
 * This class defines the structure of the 'home_category' table.
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
class HomeCategoryTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.HomeCategoryTableMap';

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
		$this->setName('home_category');
		$this->setPhpName('HomeCategory');
		$this->setClassname('HomeCategory');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('HC_ID', 'HcId', 'INTEGER', true, null, null);
		$this->addColumn('HC_NAME', 'HcName', 'VARCHAR', false, 255, '');
		$this->addColumn('HC_TYPE', 'HcType', 'INTEGER', false, 4, 0);
		$this->addColumn('HC_PARENT', 'HcParent', 'INTEGER', false, 11, 0);
		$this->addColumn('HC_ORDER', 'HcOrder', 'INTEGER', false, 4, 0);
		$this->addColumn('HC_STATUS', 'HcStatus', 'INTEGER', false, 1, 1);
		$this->addColumn('HC_TEXT', 'HcText', 'VARCHAR', false, 255, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // HomeCategoryTableMap
