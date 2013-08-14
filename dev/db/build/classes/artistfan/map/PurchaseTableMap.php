<?php



/**
 * This class defines the structure of the 'purchase' table.
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
class PurchaseTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.PurchaseTableMap';

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
		$this->setName('purchase');
		$this->setPhpName('Purchase');
		$this->setClassname('Purchase');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('PC_ID', 'PcId', 'INTEGER', true, null, null);
		$this->addColumn('PC_TYPE_NAME', 'PcTypeName', 'VARCHAR', false, 255, null);
		$this->addColumn('PC_TYPE_ID', 'PcTypeId', 'INTEGER', false, null, null);
		$this->addColumn('PC_PRICE', 'PcPrice', 'FLOAT', false, null, 0);
		$this->addColumn('PC_DESCRIPTION', 'PcDescription', 'VARCHAR', false, 250, null);
		$this->addColumn('PC_DATE', 'PcDate', 'INTEGER', false, null, 0);
		$this->addColumn('PC_USER_ID', 'PcUserId', 'INTEGER', false, null, 0);
		$this->addColumn('PC_ARTIST_ID', 'PcArtistId', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // PurchaseTableMap
