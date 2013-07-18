<?php



/**
 * Skeleton subclass for representing a row from the 'card' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Card extends BaseCard {



	public static function AddCard()
		{
			$sql	=	"INSERT INTO `card` (`card_id`, `card_user_id`, `card_name`, `card_number`, `card_type`, `card_expiry`, `card_cvv`, `card_bill_name`, `card_address`, `card_city`, `card_state`, `card_country`, `card_zip`, `card_phone`) VALUES (NULL, '114', 'card_name', 'card_number', 'card_type', 'card_expiry', 'card_expiry', 'card_bill_name', 'card_address', 'card_city', 'card_state', 'card_country', 'card_zip', 'card_phone');";
			$res = Query::Execute($sql);
			return $res;
			
		}
	public static function CheckexistingCard()
		{
		
		}
	public static function test()
		{
		echo "im here";
		echo "<pre>";

		print_r($_REQUEST);
		die;
		
		
		}
		
		



} // Card
