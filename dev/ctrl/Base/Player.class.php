<?php
/**
 * Base music player class
 * User: ssergy
 * Date: 08.02.12
 * Time: 17:46
 * 
 */
 
class Base_Player extends Base
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
        $this->mSmarty->display('demo.html');

    }
	
	public function Music()
	{	
		$this->mSmarty->assign('module', 'music');
		
		$id = trim(strip_tags(_v('id', '')));
		
        $id = (int)$id;
		
		$music = Music::GetMusic($id, 1, 1);
		
		$isOwner = ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Id'] == $music['UserId']);
		$isOther = ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Id'] != $music['UserId']);
		
		 if (empty($music) || $music['Deleted']==1)
		{
			if($music['Deleted']==1) {
				uni_redirect( PATH_ROOT . 'artist/music/'.$music['AlbumId'] );
			} else {
				uni_redirect( PATH_ROOT . 'artist/music/');
			}
		}
		
		$this->mSmarty->assignByRef('music', $music);

        $this->mSession->Del( 'upl_music_rnd' );

        $this->mSmarty->assign('music_added', isset($_REQUEST['music_added']) ? 1 : 0);
        $this->mSmarty->assign('music_updated', isset($_REQUEST['music_updated']) ? 1 : 0);
        $this->mSmarty->assign('music_removed', isset($_REQUEST['music_removed']) ? 1 : 0);
        
        $this->mSmarty->display('mods/profile/edit_artist/music_one.html');
	}
	
	public function fanPlayer()
	{
		
		$this->mSmarty->assign('module', 'music');
		
		$id = trim(strip_tags(_v('id', '')));
		
        $id = (int)$id;
		
		$music = Music::GetMusic($id, 1, 1);
		
		$isOwner = ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Id'] == $music['UserId']);
		$isOther = ($this->mUser->IsAuth() && $this->mUser->mUserInfo['Id'] != $music['UserId']);
		
		 if (empty($music) || $music['Deleted']==1)
		{
			if($music['Deleted']==1) {
				uni_redirect( PATH_ROOT . 'artist/music/'.$music['AlbumId'] );
			} else {
				uni_redirect( PATH_ROOT . 'artist/music/');
			}
		}
		
		$this->mSmarty->assignByRef('music', $music);

        $this->mSession->Del( 'upl_music_rnd' );

        $this->mSmarty->assign('music_added', isset($_REQUEST['music_added']) ? 1 : 0);
        $this->mSmarty->assign('music_updated', isset($_REQUEST['music_updated']) ? 1 : 0);
        $this->mSmarty->assign('music_removed', isset($_REQUEST['music_removed']) ? 1 : 0);
        
        $this->mSmarty->display('mods/profile/edit_fan/music_one.html');
	
	}

    public function Play()
    {	
        $tracks = array();
        $action = trim(strip_tags(_v('action', '')));
        $id = _v('data', 0);
        $json = _v('json', 0);
		$fellow	= _v('fellow', 0);		
		$explore =	_v('explore', 0);		
        $playitem = 0; //track to play first

        switch ($action)
        {
            case 'add_track':
                if($id)
                {
				  // $MusicAlbumPrice = MusicAlbum::GetAlbum($id, 1, 1);					
                    $track = Music::GetMusic($id, 1, 1);					
                    if(!empty($track))
                    {
                        if($this->mUser->IsAuth())
                        {
                            $track['MusicPurchase'] = MusicPurchase::Get($this->mUser->mUserInfo['Id'], $id);
                        }
                        else
                        {
                            $track['MusicPurchase'] = array('Id' => 0, 'WithAllAlbum' => 0);
                        }
                        $track['IsOther'] = (!$this->mUser->IsAuth() || $track['UserId'] != $this->mUser->mUserInfo['Id']) ? 1 : 0;
                        //check if track was deleted or unpublished
                        if(($track['Deleted'] == 0 && $track['Active'] == 1) || $track['MusicPurchase']['Id'] > 0 ||  $track['UserId'] == $this->mUser->mUserInfo['Id'])

                        {

                            $tracks[] = $track;
                        }
                    }
                }
                break;
            case 'add_album':
                if($id)
                {
                    $album = MusicAlbum::GetAlbum($id, 1, 0, $this->mUser->mUserInfo['Id']);
                    if(!empty($album))
                    {
                      $album['IsOther'] = (!$this->mUser->IsAuth() || $album['UserId'] != $this->mUser->mUserInfo['Id']) ? 1 : 0;

					if($explore)
					{
						$tracks[] = $album;
					}
					else
					{
						$tracks_list = Music::GetMusicListWithPurchase($album['UserId'], $this->mUser->mUserInfo['Id'], $id, 1);
												//filter tracks (active and not deleted or purchased)
						foreach($tracks_list as $item)
						{
							if(($item['Deleted'] == 0 && $item['Active'] == 1) || !empty($item['MusicPurchase.Id']) ||
								$album['UserId'] == $this->mUser->mUserInfo['Id'])
							{
								//if track was purchased or it is active and not deleted
								$tracks[] = $item;
							}
						}
					}
                        if(empty($album['xImage']))
                        {
                            $album['xImage'] = 'i/ph/album-22x22.png';
                        } else {
							$album['xImage'] = str_replace('x_', 'm_', $album['xImage']);
						}
                        if(empty($album['Image']))
                        {
                            $album['Album_Image'] = 'i/ph/album-22x22.png';
                        } else {
							$album['Album_Image'] = 'files/track/images/'.$album['UserId'].'/m_'.$album['Image'];
						}

                        $album['Tracks'] = count($tracks);
                        $album['TracksPrice'] = 0;
                        foreach($tracks as $item)
                        {
                            $album['TracksPrice'] += $item['Price'];
                        }
                        unset($item);
                        $album['Savings'] = ($album['TracksPrice'] > $album['Price']) ? round($album['TracksPrice']-$album['Price'], 2) : 0;

                        foreach($tracks as &$item)
                        {
                            $item['IsOther'] = $album['IsOther'];
                           // $item['Image'] = $album['xImage'];
                            $item['PlayerImage'] = $album['Album_Image'];						   
                           // $item['Album_Image'] = $album['Album_Image'];							
                            $item['Name'] = $album['Name'];
                            $item['Band'] = $album['Band'];
                            $item['AlbumTitle'] = $album['Title'];
                            $item['AlbumPrice'] = $album['Price'];
                            $item['AlbumTracks'] = $album['Tracks'];
                            $item['AlbumSavings'] = $album['Savings'];
                            $item['AlbumActive'] = $album['Active'];
                            $item['AlbumDeleted'] = $album['Deleted'];
                            $item['Genres'] = $album['Genres'];
							if($explore)
							{
								$item['MusicPurchase']['Id'] = !empty($item['Purchase']) ? $item['Purchase'] : 0;
	                            $item['MusicPurchase']['WithAllAlbum'] = 0;
							}
							else
							{
        	                    $item['MusicPurchase']['Id'] = !empty($item['MusicPurchase.Id']) ? $item['MusicPurchase.Id'] : 0;
    	                        $item['MusicPurchase']['WithAllAlbum'] = !empty($item['MusicPurchase.WithAllAlbum']) ? $item['MusicPurchase.WithAllAlbum'] : 0;
							}
                        }

                    }
                }
                break;
            case 'playlist':
                if($this->mUser->IsAuth())
                {
                    $tracks = Music::GetPurchasedMusicList($this->mUser->mUserInfo['Id'], 0, 0, 0, 1);
                    foreach($tracks as &$item)
                    {
                        $item['MusicPurchase']['Id'] = $item['MusicPurchase.Id'];
                        $item['IsOther'] = 1;
                        if($id == $item['Id'])
                        {
                            $playitem = $id;
                        }
                    }
                }
                break;
        }

		
        if($json)
        {
            echo json_encode(array('q' => OK, 'data' => $tracks, 'playitem' => $playitem, 'IsAuth' => ($this->mUser->IsAuth() ? 1 : 0), 'Status' => ($this->mUser->IsAuth() ? $this->mUser->mUserInfo['Status'] : 0)));
            exit();
        }
		if($_SESSION['system_uid']==$tracks[0]['UserId'])
			{
        $this->mSmarty->assign('owner', true);					
			}
		

		//TrackPreview	
        $this->mSmarty->assign('system_status', $_SESSION['system_status']);		
        $this->mSmarty->assign('fellow', $fellow);		
        $this->mSmarty->assign('tracks', $tracks);
        $this->mSmarty->assign('playitem', $playitem);
        $this->mSmarty->assign('explore', $explore);
        $this->mSmarty->assign('albumTracks', $album['Tracks']);
        $this->mSmarty->assign('albumImage', $album['Image']);		
		$this->mSmarty->assign('ui', $this->mUser->mUserInfo);
		 
		if($explore)
		$this->mSmarty->display('exp_music_player.html');		
		else
    	$this->mSmarty->display('player.html');
		
    }

    


}