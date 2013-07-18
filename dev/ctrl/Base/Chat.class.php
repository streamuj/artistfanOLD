<?php
/**
 * Pages class
 * User: Tanya
 * Date: 04.05.12
 * Time: 16:02
 *
 */

class Base_Chat extends Base
{
   
   	private $chatUsers;
	private $chatCloseUsers;
	
	function __construct($db, $params = array())
	{
		parent::__construct($db, __CLASS__);
		$this->params = $params;
		$this->chatUsers = $_SESSION['chatUser'] ? array_unique($_SESSION['chatUser']) : array();
		$this->chatCloseUsers = $_SESSION['closeChatUser'] ? array_unique($_SESSION['closeChatUser']) : array();
	}
	
	/* Add a chat user */
	function addChatUser($chatUserId)
	{
		if(!in_array($chatUserId, $this->chatUsers)){
			array_push($this->chatUsers, $chatUserId);
		}
		$key = array_search($chatUserId, $this->chatCloseUsers);
		if($key !== false) {
			unset($this->chatCloseUsers[$key]);
		}
		$_SESSION['chatUser'] = $this->chatUsers;
		$_SESSION['closeChatUser'] = $this->chatCloseUsers;
		return true;
	}
	
	/* Function to remove chat user when user click close button */
	function closeChatUser($chatUserId)
	{
		$key = array_search($chatUserId, $this->chatUsers);
		if($key !== false) {
			unset($this->chatUsers[$key]);
		}
		if(!in_array($chatUserId, $this->chatCloseUsers)){
			array_push($this->chatCloseUsers, $chatUserId); 
		}
		$_SESSION['closeChatUser'] = $this->chatCloseUsers;
		$_SESSION['chatUser'] = $this->chatUsers;
		return true;
	}
	
	/* Get current chat users */
	function getChatUsers()
	{
		return $this->chatUsers;
	}
	
	/* Get closed chat users */
	function getClosedChatUsers()
	{
		return $this->chatCloseUsers;
	}	
	
	
}
?>