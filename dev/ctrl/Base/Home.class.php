<?php
/**
 * Pages class
 * User: Tanya
 * Date: 04.05.12
 * Time: 16:02
 *
 */

class Base_Home extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }


    /**
     * Show static pages
     * @return void
     */
	 public function Category()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('status', 'category');
     
		$res = array('q' => 'ok');				

		$flashMessage = _v('msg', '');		
		$home_cat = _v('home_cat', EXPLORE_VIDEO);
		
		$this->mSmarty->assign('flashMessage', $flashMessage);
		
		//home category            			
		$homeCategory = HomeCategory::GetHomeCategory(0);
		$this->mSmarty->assignByRef('homeCategory', $homeCategory);
		
		if($home_cat)
		{	
			//get All Parent Categories
		    $categories = HomeCategory::GetHomeCategory($home_cat, (RECENT_VIDEOS.','.RECENT_ARTIST.','.LIVE_SHOW));
			$this->mSmarty->assignByRef('categories', $categories);
			
			$this->mSmarty->assignByRef('home_cat', $home_cat);
			
											
			if($_REQUEST['page'])
			{
				$res['data'] = $this->mSmarty->fetch('mods/admin/home/_category_listing_ajax.html');
				echo json_encode($res);
				exit();
			} 
			else
			{					
				$this->mSmarty->display('mods/admin/home/_category_list.html');
			}			
		}

    }	
	public function UpdateCategory()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
        $cat_name = _v('cat_name', '');	
		
		if($id)
		{		
			 HomeCategory::UpdateCatName($id, $cat_name);
			 $res['catName'] = $cat_name;
		}

		echo json_encode($res);
		exit();			
	}
	public function UpdateCatOrder()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
        $cat_order = _v('cat_order', '');

		if($id)
		{		
			 HomeCategory::UpdateCatOrder($id, $cat_order);
		}

		echo json_encode($res);
		exit();			
	}	
	public function AddNewCategory()
	{
        $res = array('q' => 'ok');
		
        $cat_name = _v('cat_name', '');	
        $cat_order = _v('cat_order', '');		
        $parent_id = _v('parent_id', '');

		$mHomeCategory = new HomeCategory();

		$mHomeCategory->setHcName($cat_name);		
		$mHomeCategory->setHcParent($parent_id);					
  	    $mHomeCategory->setHcOrder($cat_order);
		
        $mHomeCategory->save();
		
		echo json_encode($res);
		exit();		
					
	}	

    /**
     * Show static pages
     * @return void
     */
	 public function AddNewLink()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('amodule', 'home');
		
		$status = _v('status','');					
        $this->mSmarty->assign('status', $status);
		
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);		

        $this->mSmarty->display('mods/admin/home/_list.html');
       
    }	
    /**
     * Show static pages
     * @return void
     */
	 public function Artist()
    {
        //show template
        $this->mSmarty->assign('amodule', 'home');
		
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);		
			
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

       // $status = 'artist';		
		
		$status = _v('status','artist');							
        $this->mSmarty->assign('status', $status);
        
		$res = array('q' => 'ok');				
        		
		$page = _v('page', 1);
		$pcnt = 10;
		$flashMessage = _v('msg', '');		
		$home_cat = _v('home_cat', '');
		
		$this->mSmarty->assign('flashMessage', $flashMessage);
						
		$h_list = Home::getArtistList($page, $pcnt, $home_cat); 		
		$rcnt = Home::getArtistCount($home_cat);
		$this->mSmarty->assign('h_list', $h_list);
				 		       
		
			//$rcnt = $h_list;
			include_once 'model/Pagging.class.php';	
            $link = 'oHome.ArtistList';

			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
						
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
		
			//home category            			
			$homeCategory = HomeCategory::GetHomeCategory(EXPLORE_ARTIST);
			$this->mSmarty->assignByRef('homeCategory', $homeCategory);

								
			if($_REQUEST['page']){
					$res['data'] = $this->mSmarty->fetch('mods/admin/home/_artist_listing_ajax.html');
					echo json_encode($res);
					exit();
			} 
			else
			{					
		        $this->mSmarty->display('mods/admin/home/_artist_list.html');
			}
       
    }
   /**
     * Show static pages
     * @return void
     */
	 public function Video()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $status = 'video';		
        $this->mSmarty->assign('status', $status);
		
		$this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('amodule', 'home');

		
		$res = array('q' => 'ok');				
        		
		$page = _v('page', 1);
		$pcnt = 10;
		$flashMessage = _v('msg', '');	
		$home_cat = _v('home_cat', '');
		$this->mSmarty->assign('flashMessage', $flashMessage);
		
		
		$h_list = Home::getVideoList($page, $pcnt, $home_cat); 
		$rcnt = Home::getVideoCount($home_cat);
		
		$this->mSmarty->assign('h_list', $h_list);			 		       
		
			//$rcnt = $h_list;
			include_once 'model/Pagging.class.php';	
            $link = 'oHome.VideoList';

			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
						
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
			//home category            			
			$homeCategory = HomeCategory::GetHomeCategory(EXPLORE_VIDEO);
			$this->mSmarty->assignByRef('homeCategory', $homeCategory);
									
			if($_REQUEST['page']){
					$res['data'] = $this->mSmarty->fetch('mods/admin/home/_video_listing_ajax.html');
					echo json_encode($res);
					exit();
			} 
			else
			{					
		        $this->mSmarty->display('mods/admin/home/_video_list.html');
			}		
       
    }
    /**
     * Show static pages
     * @return void
     */
	 public function Event()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $status = 'events';		
        $this->mSmarty->assign('status', $status);
		
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('amodule', 'home');

		
		$res = array('q' => 'ok');				
        		
		$page = _v('page', 1);
		$pcnt = 10;
		$flashMessage = _v('msg', '');
		$home_cat = _v('home_cat', '');
		$this->mSmarty->assign('flashMessage', $flashMessage);
		
		
		$h_list = Home::getEventList($page, $pcnt, $home_cat); 

		$rcnt = Home::getEventCount($home_cat);
	
		$this->mSmarty->assign('h_list', $h_list);			 		       
		
			//$rcnt = $h_list;
			include_once 'model/Pagging.class.php';	
            $link = 'oHome.EventList';

			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
						
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
			
			//home category            			
			$homeCategory = HomeCategory::GetHomeCategory(EXPLORE_SHOWS);
			$this->mSmarty->assignByRef('homeCategory', $homeCategory);			
						
			if($_REQUEST['page']){
					$res['data'] = $this->mSmarty->fetch('mods/admin/home/_event_listing_ajax.html');
					echo json_encode($res);
					exit();
			} 
			else
			{					
		        $this->mSmarty->display('mods/admin/home/_event_list.html');
			}
    }
    /**
     * Show static pages
     * @return void
     */
	 public function MusicAlbum()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $status = 'musicAlbum';		
        $this->mSmarty->assign('status', $status);

        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        
        //show template
        $this->mSmarty->assign('amodule', 'home');

		$res = array('q' => 'ok');				
        		
		$page = _v('page', 1);
		$pcnt = 10;
		$flashMessage = _v('msg', '');
		$home_cat = _v('home_cat', '');
		$this->mSmarty->assign('flashMessage', $flashMessage);
		
		
		$h_list = Home::getMusicAlbumList($page, $pcnt, $home_cat); 
		$rcnt = Home::getMusicAlbumCount($home_cat);

		$this->mSmarty->assign('h_list', $h_list);			 		       
		
			//$rcnt = $h_list;
			include_once 'model/Pagging.class.php';	
            $link = 'oHome.MusicAlbumList';

			$mpg = new Pagging($pcnt, $rcnt, $page, $link);
			
			$res['pagging'] = $mpg->Make($this->mSmarty, 1);
            $res['page'] = $page;
						
			$this->mSmarty->assignByRef('pagging', $res['pagging']);
			
			//home category            			
			$homeCategory = HomeCategory::GetHomeCategory(EXPLORE_MUSIC_ALBUM);
			$this->mSmarty->assignByRef('homeCategory', $homeCategory);				
						
			if($_REQUEST['page']){
					$res['data'] = $this->mSmarty->fetch('mods/admin/home/_music_album_listing_ajax.html');
					echo json_encode($res);
					exit();
			} 
			else
			{					
		        $this->mSmarty->display('mods/admin/home/_music_album_list.html');
			}
					

       
    }		
		
	public function SaveHomeArtist()
	{    
		if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }				
		  $id = _v('id','0');
		  $link = _v('link','');
		  $order = _v('h_order','0');	
		  $home_cat = _v('home_cat','0');
     
	      try
          {
             if (!empty($errs))
             {
                            throw new Exception('err');
             }
			 else
			 {
				$result = Home::SaveHomePageArtist($id, $link, $order, $home_cat, DBDATE );						
		     }					
			$res['q'] = 'ok';
           }
           catch (Exception $e)
           {
               $err = $e->getMessage();
               if ($err != 'err')
               {
                    $errs[] = $err;
               }
                    $res['errs'] = $errs;
                    $res['q'] = 'err';
            }								  

		
		echo json_encode($res);
        exit();
	}
	public function SaveHomeVideo()
	{
        $res = array('q' => 'ok');
	    
		if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }				
		  $id = _v('id','0');
		  $link = _v('link','');
		  $order = _v('h_order','0');	
		  $home_cat = _v('home_cat','0');		
		  $rand_id = _v('rand_id','');  
		 
		 if($home_cat == VIDEO_SLIDE_CAT_ID)
		 {		 
			 //image
             $image = $this->mSession->Get('upl_v_slide_'.$rand_id);

             if (!empty($image))
             {
 			    include_once 'libs/Crop/Image_Transform.php';
                include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                 $pathinfo = pathinfo($image);
                 $ext = ToLower($pathinfo['extension']);                   
				 $dir = 'files/photo/slide/video';
                 $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
                 copy(BPATH . $image, BPATH . $dir . '/' . $fn);
					
                $image = $fn;
					
				$imageLocation = BPATH.$dir .'/'.$image;
				$imgJpgName = getJpgFileName($image);

				$slideLocation = $dir.'/s_' .$imgJpgName;
					
				include_once 'libs/Crop/class.image.php';
				$thumbImage = new simpleImage();
				$thumbImage->load($imageLocation);
						
				$x1 = _v('x1', 0);
				$y1 = _v('y1', 0); 
				$x2 = _v('x2', 0); 
				$y2 = _v('y2', 0); 
								
			   //Crop Album Image for Explore Music
					
				if(file_exists($imageLocation))
				{
					$w = _v('w', ALBUM_SLIDE_WIDTH); 
					$h = _v('h', ALBUM_SLIDE_HEIGHT);

					//Scale the image to the thumb_width set above
					$scale = ALBUM_SLIDE_WIDTH/$w;
			
					$reSizeImage = $thumbImage->resizeThumbnailImage($slideLocation, $w,$h,$x1,$y1,$scale);
				}
						
                //delete tmp
				@unlink($imageLocation);					
                $this->mSession->Del('upl_v_slide_' . $rand_id);
			}
		}		  		  	    

		$result = Home::SaveHomePageVideo($id, $link, $order, $home_cat, DBDATE, $imgJpgName);
		
        $res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_video_list_ajax.html');		

        echo json_encode($res);
        exit();
	}
	public function SaveHomeEvent()
	{
        $res = array('q' => 'ok');
	    
		if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }				
		  $id = _v('id','0');
		  $link = _v('link','');
		  $order = _v('h_order','0');	
		  $home_cat = _v('home_cat','0');	  	  
		 
		$result = Home::SaveHomePageEvent($id, $link, $order, $home_cat, DBDATE );
		
		$res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_event_list_ajax.html');		

        echo json_encode($res);
        exit();
	}	
	public function SaveHomeMusicAlbum()
	{
        $res = array('q' => 'ok');
	    
		if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }				
		  $id = _v('id','0');
		  $link = _v('link','');
		  $order = _v('h_order','0');	
		  $home_cat = _v('home_cat','0');	
		  $rand_id = _v('rand_id','');  
		 
		 //deb($rand_id);
		 
		 if($home_cat == MUSIC_SLIDE_CAT_ID)
		 {		 
			 //image
             $image = $this->mSession->Get('upl_v_slide_'.$rand_id);

             if (!empty($image))
             {
 			    include_once 'libs/Crop/Image_Transform.php';
                include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                 $pathinfo = pathinfo($image);
                 $ext = ToLower($pathinfo['extension']);                   
				 $dir = 'files/photo/slide/music';
                 $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
                 copy(BPATH . $image, BPATH . $dir . '/' . $fn);
					
                $image = $fn;
					
				$imageLocation = BPATH.$dir .'/'.$image;
				$imgJpgName = getJpgFileName($image);

				$slideLocation = $dir.'/s_' .$imgJpgName;
					
				include_once 'libs/Crop/class.image.php';
				$thumbImage = new simpleImage();
				$thumbImage->load($imageLocation);
						
				$x1 = _v('x1', 0);
				$y1 = _v('y1', 0); 
				$x2 = _v('x2', 0); 
				$y2 = _v('y2', 0); 
								
			   //Crop Album Image for Explore Music
					
				if(file_exists($imageLocation))
				{
					$w = _v('w', ALBUM_SLIDE_WIDTH); 
					$h = _v('h', ALBUM_SLIDE_HEIGHT);

					//Scale the image to the thumb_width set above
					$scale = ALBUM_SLIDE_WIDTH/$w;
			
					$reSizeImage = $thumbImage->resizeThumbnailImage($slideLocation, $w,$h,$x1,$y1,$scale);
				}
						
                //delete tmp
				@unlink($imageLocation);					
                $this->mSession->Del('upl_v_slide_' . $rand_id);
			}
		 }
		$result = Home::SaveHomePageMusicAlbum($id, $link, $order, $home_cat, DBDATE, $imgJpgName );

        $res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_music_album_list_ajax.html');		

        echo json_encode($res);
        exit();
	}			

    /**
     * Ajax users list
     * @return void
     */
    public function SearchArtistList()
    {
        //check admin status
        if(!$this->mUser->CheckAdminStatus())
        {
            exit();
        }
        $res = array('q' => 'ok');
		
		$email = _v('email', '');
		$name = _v('name', '');
		$location = _v('location', '');
		$featured = _v('featured', '');
		$status = _v('status', '');		

        
        //filters
        $filters = '';
	
		if($email)
		{
               $filters .= ($filters ? ' AND ' : '') . '(user.email LIKE "%' . $email . '%")';
		}
		if($name)
		{	
              $vq = explode(' ', $name);
              $sq = '';
              foreach ($vq as $v2)
              {
                     if (strlen($v2) > 1)
                     {
                           $sq .= (!$sq ? '' : ' AND ') . '(user.first_name LIKE "%' . $v2 . '%" OR user.last_name LIKE "%' . $v2 . '%" OR user.name LIKE "%' . $v2 . '%" OR user.band_name LIKE "%' . $v2 . '%")';
                      }
              }
               if ($sq)
              {
                      $filters .= ($filters ? ' AND ' : '') . '('.$sq.')';
	          }    
		}
		if($location)
		{
			$filters .= ($filters ? ' AND ' : '') . '(user.location LIKE "%' . $location . '%")';
		}
		
		

	   $list = User::GetUsersList(USER_ARTIST, '', '', $filters);

        $this->mSmarty->assignByRef('list', $list['list']);

	    $this->mSmarty->assignByRef('status', $status);
		
		switch($status)
		{
			case 'artist':
						$gId = 'artist_id';
						$cId = EXPLORE_ARTIST;						
						break;
			case 'video':
						$gId = 'video_id';
						$cId = EXPLORE_VIDEO;						
						break;
			case 'events':
						$gId = 'event_id';
						$cId = EXPLORE_SHOWS;						
						break;
			case 'musicAlbum':
						$gId = 'music_album_id';
						$cId = EXPLORE_MUSIC_ALBUM;
						break;																								
		}
		$lastId = Home :: GetLastId($gId);
        $this->mSmarty->assign('lastId', $lastId+1);
		
		//home category            			
		$homeCategory = HomeCategory::GetHomeCategory($cId);
		$this->mSmarty->assignByRef('homeCategory', $homeCategory);
					
        $rand_id = _v('rand_id', rand(100000, 999999));
        $this->mSmarty->assign('rand_id', $rand_id);	
						
        $res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_user_list_ajax.html');

        echo json_encode($res);
        exit();
    } 
    public function HomeVideoList()
    {
        $this->mSmarty->assign('module', 'Video');
		
		$res = array('q' => 'ok');				
        $u_id = _v('id', 0);

			$video = Video::GetVideoForHomeList( $u_id );

            //videos            			
			$this->mSmarty->assignByRef('video', $video);				
						
			$res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_video_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
    public function HomeEventList()
    {
        $this->mSmarty->assign('module', 'Events');
	
	    $res = array('q' => 'ok');				
        $u_id = _v('id', 0);

			$homeEvent = Home::getEventList();

			$hIds =array();
			foreach($homeEvent as $val)
			{
				$hIds[] .=$val['EventId'];
			}
			
		    $u_events = Event::EventsList( $u_id, 0, 0, array('from' => date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y")))), '', array(1,2), '', EVENT_APPROVED, $hIds);

            $this->mSmarty->assignByRef('u_events', $u_events);
	   
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_event_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }

    public function HomeMusicAlbumList()
    {
        $this->mSmarty->assign('module', 'Music');
     
		$res = array('q' => 'ok');				
        $u_id = _v('id', 0);

			//$albums = MusicAlbum::GetAlbumList($u_id, 1, 1);
			
			$albums = MusicAlbum::GetMusicAlbumForHomeList($u_id);			

            $this->mSmarty->assignByRef('albums', $albums);
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/home/ajax/_music_album_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
	public function DeleteLink()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
		Home::DeleteLink($id);

		echo json_encode($res);
		exit();			
	}
	public function SaveHomeOrder()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
        $h_order = _v('h_order', 0);	
				
		Home::SaveHomeOrder($id, $h_order);

		echo json_encode($res);
		exit();			
	}	
	public function DeleteCat()
	{
        $res = array('q' => 'ok');
        $id = _v('id', 0);	
		HomeCategory::DeleteCat($id);

		echo json_encode($res);
		exit();			
	}	
    /**
     * Upload image for album
     * @return void
     */
    public function UploadAlbumImage()
    {
        $this->mSmarty->assign('module', 'music');
        $rand_id = _v('rand_id', 0);
        
        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/images/tmp/');
	
		$tmpFileName = 'files/images/tmp/'.$result['name'];
		list($width, $height) = getimagesize($tmpFileName);
		
		//print_r($width.'--'.$height);
		
		if($width < ALBUM_SLIDE_WIDTH || $height < ALBUM_SLIDE_HEIGHT){ 
			@unlink($tmpFileName);
			echo json_encode(array('success'=>false, 'message'=> HOMEPAGE_ALBUM_SLIDE_IMAGE_ERR));
			exit;
		}
        //crop to small size
        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_v_slide_'.$rand_id, $mFu->GetSavedFile() );
            $result['image'] = $mFu->GetSavedFile();
			
						
			include_once BPATH. 'libs/Crop/class.image.php';
			
			$imgObj = new simpleImage();
			$imgObj->load($result['image']);
			$imgObj->resizeToWidth(ALBUM_SLIDE_WIDTH);
			$imgObj->save($result['image']);
			
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();
			
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }	
}
