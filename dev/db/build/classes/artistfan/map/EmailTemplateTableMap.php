<?php



/**
 * This class defines the structure of the 'email_template' table.
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
class EmailTemplateTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.EmailTemplateTableMap';

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
		$this->setName('email_template');
		$this->setPhpName('EmailTemplate');
		$this->setClassname('EmailTemplate');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ET_ID', 'EtId', 'INTEGER', true, null, null);
		$this->addColumn('ET_SUBJECT', 'EtSubject', 'VARCHAR', false, 255, '');
		$this->addColumn('ET_MESSAGE', 'EtMessage', 'LONGVARCHAR', false, null, null);
		$this->addColumn('ET_TYPE', 'EtType', 'VARCHAR', false, 100, '');
		$this->addColumn('ET_MDATE', 'EtMdate', 'INTEGER', false, null, 0);
		$this->addColumn('ET_USER_ID', 'EtUserId', 'INTEGER', false, null, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
	} // buildRelations()

} // EmailTemplateTableMap
