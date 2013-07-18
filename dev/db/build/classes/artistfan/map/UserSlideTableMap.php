<?php



/**
 * This class defines the structure of the 'user_slide' table.
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
class UserSlideTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.UserSlideTableMap';

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
		$this->setName('user_slide');
		$this->setPhpName('UserSlide');
		$this->setClassname('UserSlide');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('US_ID', 'UsId', 'INTEGER', true, null, null);
		$this->addColumn('US_USER_ID', 'UsUserId', 'INTEGER', false, 11, 0);
		$this->addColumn('US_SLIDER_POS', 'UsSliderPos', 'INTEGER', false, 11, 1);
		$this->addColumn('US_SLIDER_IMAGE', 'UsSliderImage', 'VARCHAR', false, 150, null);
		$this->addColumn('US_STATUS', 'UsStatus', 'INTEGER', false, 11, 1);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // UserSlideTableMap
