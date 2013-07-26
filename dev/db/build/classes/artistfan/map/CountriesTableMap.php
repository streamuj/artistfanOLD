<?php



/**
 * This class defines the structure of the 'countries' table.
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
class CountriesTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.CountriesTableMap';

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
		$this->setName('countries');
		$this->setPhpName('Countries');
		$this->setClassname('Countries');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ISO2', 'Iso2', 'VARCHAR', true, 2, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 100, '');
		$this->addColumn('PCODE', 'Pcode', 'VARCHAR', false, 10, '');
		$this->addColumn('SORTID', 'Sortid', 'INTEGER', false, 11, 0);
		$this->addColumn('ISO3', 'Iso3', 'INTEGER', false, 5, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // CountriesTableMap
