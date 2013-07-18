<?php



/**
 * Skeleton subclass for representing a row from the 'email_template' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class EmailTemplate extends BaseEmailTemplate {

	public static function getEmailTemplate($emailType)
	{
		$sql ="SELECT * FROM  `email_template` WHERE  `et_type` = '$emailType'";
		$all = Query::GetOne($sql);
	    return $all;
	}

} // EmailTemplate
