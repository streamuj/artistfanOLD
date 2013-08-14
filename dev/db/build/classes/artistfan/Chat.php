<?php

/**
 * Skeleton subclass for representing a row from the 'chat' table.
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Chat extends BaseChat
{
		
	/*function to get chat between the two users */
	public static function GetChatMessage($userId, $memberId)
	{
		$sql = 'SELECT id, cht_message, IF(cht_from = {'.(int)$userId.'}, '"Me"', name) as name, cht_sent FROM chat 
				INNER JOIN user ON id = cht_from AND user.email_confirmed = 1 AND user.blocked = 0
				WHERE ((cht_from = '.(int)$userId.' AND cht_to = '.(int)$memberId.') OR (cht_from = '.(int)$memberId.' AND cht_to = '.(int)$userId.'))
				AND (cht_sent >= user.last_login OR (cht_recd = 0 AND cht_to = '.(int)$userId.')) 
				AND id IN ('.(int)$userId.', '.(int)$memberId.')
				ORDER BY cht_sent ASC';
		$res = Query::GetAll($sql);
		$sql = 'UPDATE chat SET cht_recd = 1 WHERE (cht_from = '.(int)$memberId.' AND cht_to = '.(int)$userId.') AND cht_recd = 0';
		$Update = Query::Execute($sql);
		return $res;		
	}
	
	/* Function to get new chat messsages */
	public static function getNewChatMessage($userId, $memberId)
	{
		$sql = 'SELECT id, cht_message, name, cht_sent FROM chat 
				INNER JOIN user ON id = cht_from AND user.email_confirmed = 1 AND user.blocked = 0
				WHERE cht_from = '.(int)$memberId.' AND cht_to = $userId
				AND id IN ('.(int)$userId.', '.(int)$memberId.') AND cht_recd = 0
				ORDER BY cht_sent ASC';	
		$res = Query::GetAll($sql);
		$sql = 'UPDATE chat SET cht_recd = 1 WHERE (cht_from = '.(int)$memberId.' AND cht_to = '.(int)$userId.') AND cht_recd = 0';
		$Update = Query::Execute($sql);
		return $res;	
	}
	
	/* Adding chat messages into database */
	public static function addChatMessage($userId, $chatUserId, $message, $date);
	{
		$sql = 'INSERT INTO chat(cht_from, cht_to, cht_message, cht_sent)VALUES('.(int)$userId.', '.(int)$chatUserId.', "'.$message.'", '.$date.')';
		$res = Query::Execute($sql);
		return $res;
	}
	
} // Chat
