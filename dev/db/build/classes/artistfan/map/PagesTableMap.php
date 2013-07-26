<?php



/**
 * This class defines the structure of the 'pages' table.
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
class PagesTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.PagesTableMap';

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
		$this->setName('pages');
		$this->setPhpName('Pages');
		$this->setClassname('Pages');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
		$this->addColumn('PAGENAME', 'Pagename', 'VARCHAR', true, 255, null);
		$this->addColumn('SORTID', 'Sortid', 'INTEGER', false, 11, 0);
		$this->addColumn('STORY', 'Story', 'LONGVARCHAR', false, null, null);
		$this->addColumn('ACTIVE', 'Active', 'TINYINT', false, 1, 1);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // PagesTableMap
