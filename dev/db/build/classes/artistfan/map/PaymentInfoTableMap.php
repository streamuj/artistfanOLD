<?php



/**
 * This class defines the structure of the 'payment_info' table.
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
class PaymentInfoTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.PaymentInfoTableMap';

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
		$this->setName('payment_info');
		$this->setPhpName('PaymentInfo');
		$this->setClassname('PaymentInfo');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('ROUTING_CODE', 'RoutingCode', 'VARCHAR', false, 250, '');
		$this->addColumn('ACCOUNT_NUMBER', 'AccountNumber', 'VARCHAR', false, 250, '');
		$this->addColumn('HOLDER_NAME', 'HolderName', 'VARCHAR', false, 250, '');
		$this->addColumn('ACCOUNT_TYPE', 'AccountType', 'TINYINT', false, 1, 0);
		$this->addColumn('PDATE', 'Pdate', 'INTEGER', false, 11, 0);
		$this->addColumn('MAIL_NAME', 'MailName', 'VARCHAR', false, 250, '');
		$this->addColumn('MAIL_ADD1', 'MailAdd1', 'VARCHAR', false, 250, '');
		$this->addColumn('MAIL_ADD2', 'MailAdd2', 'VARCHAR', false, 250, '');
		$this->addColumn('MAIL_CITY', 'MailCity', 'VARCHAR', false, 250, '');
		$this->addColumn('MAIL_STATE', 'MailState', 'VARCHAR', false, 250, '');
		$this->addColumn('MAIL_ZIP', 'MailZip', 'VARCHAR', false, 250, '');
		$this->addColumn('PAYPAL_ID', 'PaypalId', 'VARCHAR', false, 250, '');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
		$this->addRelation('Payout', 'Payout', RelationMap::ONE_TO_MANY, array('id' => 'payment_info_id', ), null, null, 'Payouts');
	} // buildRelations()

} // PaymentInfoTableMap
