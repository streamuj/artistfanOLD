<?php



/**
 * This class defines the structure of the 'card' table.
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
class CardTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.CardTableMap';

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
		$this->setName('card');
		$this->setPhpName('Card');
		$this->setClassname('Card');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('CARD_ID', 'CardId', 'INTEGER', true, null, null);
		$this->addForeignKey('CARD_USER_ID', 'CardUserId', 'INTEGER', 'user', 'ID', true, null, 0);
		$this->addColumn('CARD_NAME', 'CardName', 'VARCHAR', false, 150, '');
		$this->addColumn('CARD_NUMBER', 'CardNumber', 'VARCHAR', false, 150, '');
		$this->addColumn('CARD_TYPE', 'CardType', 'VARCHAR', false, 50, '');
		$this->addColumn('CARD_EXPIRY', 'CardExpiry', 'VARCHAR', false, 50, '');
		$this->addColumn('CARD_CVV', 'CardCvv', 'VARCHAR', false, 50, '');
		$this->addColumn('CARD_BILL_NAME', 'CardBillName', 'VARCHAR', false, 200, '');
		$this->addColumn('CARD_ADDRESS', 'CardAddress', 'VARCHAR', false, 200, '');
		$this->addColumn('CARD_CITY', 'CardCity', 'VARCHAR', false, 200, '');
		$this->addColumn('CARD_STATE', 'CardState', 'VARCHAR', false, 150, '');
		$this->addColumn('CARD_COUNTRY', 'CardCountry', 'VARCHAR', false, 200, '');
		$this->addColumn('CARD_ZIP', 'CardZip', 'VARCHAR', false, 50, '');
		$this->addColumn('CARD_PHONE', 'CardPhone', 'VARCHAR', false, 50, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('card_user_id' => 'id', ), null, null);
	} // buildRelations()

} // CardTableMap
