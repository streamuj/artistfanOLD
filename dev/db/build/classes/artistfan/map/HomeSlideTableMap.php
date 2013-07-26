<?php



/**
 * This class defines the structure of the 'home_slide' table.
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
class HomeSlideTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.HomeSlideTableMap';

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
		$this->setName('home_slide');
		$this->setPhpName('HomeSlide');
		$this->setClassname('HomeSlide');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('HS_ID', 'HsId', 'INTEGER', true, null, null);
		$this->addColumn('HS_IMAGE', 'HsImage', 'VARCHAR', true, 150, '');
		$this->addColumn('HS_ORDER', 'HsOrder', 'INTEGER', false, 4, 0);
		$this->addColumn('HS_STATUS', 'HsStatus', 'INTEGER', false, 1, 0);
		$this->addColumn('CREATED_ON', 'CreatedOn', 'INTEGER', false, null, 0);
		$this->addColumn('CREATED_BY', 'CreatedBy', 'INTEGER', false, null, 0);
		$this->addColumn('MODIFIED_ON', 'ModifiedOn', 'INTEGER', false, null, 0);
		$this->addColumn('MODIFIED_BY', 'ModifiedBy', 'INTEGER', false, null, 0);
		$this->addColumn('HS_LINK', 'HsLink', 'LONGVARCHAR', false, null, null);
		$this->addColumn('HS_NEW', 'HsNew', 'TINYINT', false, 1, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // HomeSlideTableMap
