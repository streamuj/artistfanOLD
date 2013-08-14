<?php 
/**
 * Chat Room class
 * User: Balakrishnan
 *
 */
class Base_Notification extends Base
{ 
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
		if (!$this->mUser->IsAuth())
        {
			uni_redirect( PATH_ROOT . 'base/user/login' );
        }
    }

    public function Index()
    {
		$redirect = $this->GetRedirectUrl();		
		if($_REQUEST['ajaxMode'])
		{	

			$newNotification = $this->mCache->get($this->mUser->mUserInfo['Id'].'_notification');	
			if($newNotification && $this->mUser->mUserInfo['Id']) {
				$wallcount	=	Notification::ShowNotification_Wall($this->mUser->mUserInfo['Id']);
				$commentcount	=	Notification::ShowNotification_Comment($this->mUser->mUserInfo['Id']);
				$notificationCount = count($wallcount) + count($commentcount);			
				$res['q'] =	$notificationCount;
			} else {
				$res['q'] = 0;
			}
			echo json_encode($res);
			exit();
		} 
		else 
		{
			uni_redirect(PATH_ROOT . 'u/'.$this->mUser->mUserInfo['Name']);
		}
	}
	
}
