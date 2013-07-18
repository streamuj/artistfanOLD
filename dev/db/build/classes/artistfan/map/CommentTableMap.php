<?php



/**
 * This class defines the structure of the 'comment' table.
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
class CommentTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'artistfan.map.CommentTableMap';

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
		$this->setName('comment');
		$this->setPhpName('Comment');
		$this->setClassname('Comment');
		$this->setPackage('artistfan');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('CMT_ID', 'CmtId', 'INTEGER', true, null, null);
		$this->addForeignKey('CMT_USER_ID', 'CmtUserId', 'INTEGER', 'user', 'ID', false, 11, 0);
		$this->addColumn('CMT_REFER_TYPE', 'CmtReferType', 'INTEGER', false, 11, 0);
		$this->addColumn('CMT_REFER_ID', 'CmtReferId', 'INTEGER', false, 11, 0);
		$this->addColumn('CMT_MESSAGE', 'CmtMessage', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CMT_DATE', 'CmtDate', 'INTEGER', false, 11, 0);
		$this->addColumn('CMT_STATUS', 'CmtStatus', 'INTEGER', false, 11, 0);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('UserFromK', 'User', RelationMap::MANY_TO_ONE, array('cmt_user_id' => 'id', ), null, null);
	} // buildRelations()

} // CommentTableMap
