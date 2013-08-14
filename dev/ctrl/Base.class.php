<?php
/**
 * Base abstract class
 */
abstract class Base
{
    /**
     * full obj list
     */
    protected $mlObj;

    /**
     * Smarty
     * */
    protected $mSmarty;

    /**
     * Breadcrumb array
     * @var array
     */
    protected $mBc;

    /** Admin area status */
    protected $mItAdmin;

    /**
     * Current user object
     * @var Object
     */
    protected $mUser;


    /**
     * Cache object
     * @var
     */
    protected $mCache;

    /**
     * Session object
     * @var
     */
    protected $mSession;


    public function __construct($glObj)
    {
        $this->mlObj = $glObj;

        if (isset($glObj['mSmarty']))
        {
            $this->mSmarty = $glObj['mSmarty'];
        }

        if (isset($glObj['mSession']))
        {
            $this->mSession = $glObj['mSession'];
        }

        if (isset($glObj['mCache']))
        {
            $this->mCache = $glObj['mCache'];
        }

        if (isset($glObj['mUser']))
        {
            $this->mUser = $glObj['mUser'];

            //assign user info
            if ($this->mUser->IsAuth())
            {
                $this->mSmarty->assign('IsAuth', 1);
                $this->mSmarty->assign('UserInfo', $this->mUser->mUserInfo);
            }

        }
    }

    public function SetClass($mClassName, $mClass)
    {
        $this->mlObj[$mClassName] = $mClass;
        if (isset($this->$mClassName))
        {
            $this->$mClassName = $mClass;
        }
    }

    public function GetRootPath()
    {
        if (defined('BPATH') && trim(BPATH) != '/')
        {
            return BPATH;
        }
        elseif (defined('GL_PATH') && GL_PATH)
        {
            return GL_PATH;
        }
    }

    public function NotFound()
    {
        header('HTTP/1.1 404 Not Found');
        $this->mSmarty->display('mods/index/404.html');
    }
    /**
     * Generate url to redirect after sign in / sign up
     * @return string
     */
    protected function GetRedirectUrl()
    {
        $redirect = '';
        $rp = $this->mlObj['mSession']->Get('redirect');

	    if(!empty($rp['content']) && $this->mUser->mUserInfo['Status'] == 1)
        {		
            $enough = 1;
            $id = $rp['id'];
            switch ($rp['content'])
            {
                case 'track':
                    $content = Music::GetMusic($id, 0, 1);
                    if($content['Price'] <= $this->mUser->mUserInfo['Wallet'])
                    {
                        $redirect = 'u/' . $content['Name'] . '/music';
                        if($content['AlbumId'] > 0)
                        {
                            $redirect .= '/' . $content['AlbumId'];
                        }
                    }
                    else
                    {
                        $enough = 0;
                    }
                    break;
                case 'album':
                    $content = MusicAlbum::GetAlbum($id, 1);
                    if($content['Price'] <= $this->mUser->mUserInfo['Wallet'])
                    {
                        $redirect = 'u/' . $content['Name'] . '/music/' . $content['Id'];
                    }
                    else
                    {
                        $enough = 0;
                    }
                    break;
                case 'video':
                    $content = Video::GetVideoInfo($id, 0, 1);
                    if($content['Price'] <= $this->mUser->mUserInfo['Wallet'])
                    {
                        $redirect = 'u/' . $content['Name'] . '/video/' . $content['Id'];
                    }
                    else
                    {
                        $enough = 0;
                    }
                    break;
                case 'event':
                    $content = Event::GetEvent($id, 0, 1);
                    if(($rp['act'] != 'access') || ($rp['act'] == 'access' && $content['Price'] <= $this->mUser->mUserInfo['Wallet']))
                    {
                        $redirect = 'u/' . $content['Name'] . '/events/' . $content['Id'];
                    }
                    else
                    {
                        $enough = 0;
                    }
                    break;
            }
            if(!$enough)
            {
                //not enough money - redirect to purchase points
                $redirect = 'fan/wallet';
                $this->mlObj['mSession']->set('notice', 'You have to own artistsfan credits to buy content from artists. Please purchase credits using the form below.');
            }
            else
            {
                $this->mlObj['mSession']->Del('redirect');
            }
        }
		elseif($rp['url'])
		{
			$redirect = $rp['url'];
			$redirect = substr($redirect, 1);
		}
        else
        {
            $this->mlObj['mSession']->Del('redirect');
        }
        return $redirect;
    }
}

?>