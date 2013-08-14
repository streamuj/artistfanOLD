<?php



/**
 * This class defines the structure of the 'adaptive_payment' table.
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
class AdaptivePaymentTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.AdaptivePaymentTableMap';

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
		$this->setName('adaptive_payment');
		$this->setPhpName('AdaptivePayment');
		$this->setClassname('AdaptivePayment');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('AP_ID', 'ApId', 'INTEGER', true, null, null);
		$this->addColumn('AP_SENDER_EMAIL', 'ApSenderEmail', 'VARCHAR', false, 250, '');
		$this->addColumn('AP_APPROVAL_KEY', 'ApApprovalKey', 'VARCHAR', false, 100, '');
		$this->addColumn('AP_FROM_DATE', 'ApFromDate', 'VARCHAR', false, 30, '');
		$this->addColumn('AP_TO_DATE', 'ApToDate', 'VARCHAR', false, 30, '');
		$this->addColumn('AP_MAX_AMOUNT', 'ApMaxAmount', 'VARCHAR', false, 20, '');
		$this->addColumn('AP_DATE', 'ApDate', 'INTEGER', false, null, 0);
		$this->addColumn('AP_STATUS', 'ApStatus', 'TINYINT', false, 2, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // AdaptivePaymentTableMap
