<?php
/**
 * Pages class
 * User: Tanya
 * Date: 04.05.12
 * Time: 16:02
 *
 */

class Base_HomeSlide extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }


    /**
     * Show static pages
     * @return void
     */
	 public function slide()
    {
		 if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }
		
		$page = _v('page', 1);
        $pcnt = 10;

        $rcnt = HomeSlide::GetCount();
        $slideList = HomeSlide::GetSlideList( 0, $page, $pcnt);
		
        include_once 'model/Pagging.class.php';
        $link = '/base/HomeSlide/slide';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make($this->mSmarty);
		
        $this->mSmarty->assignByRef('pagging', $pagging);

        $this->mSmarty->assignByRef('slideList', $slideList);
        $this->mSmarty->assign('no_right', 1);
        $this->mSmarty->assign('amodule', 'HomeSlide');
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
		
		$this->mSmarty->display('mods/admin/slide/_list.html');
       
    }
	
	public function AddSlide()
	{
		 if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }				
		  $rand_id = _v('rand_id', rand(100000, 999999));
		  $this->mSmarty->assign('rand_id', $rand_id);
		  
		  //photo
           $image = $this->mSession->Get('upl_photo_' . $rand_id);

           if (empty($id) && empty($image))
           {
                $errs['Image'] = PLEASE_UPLOAD_PHOTO_FILE;
           }
		   $order = $_POST['DisplayOrder'];
		   $link = $_POST['link'];
   		   $is_new = $_POST['is_new'];

		   if (!empty($image))
           {
                    include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
					$imageLocation = BPATH.$image;
					$slideLocation = BPATH . 'files/photo/slide/homeSlide/'.$fn;
					
						if(file_exists($imageLocation))
						{
								$tes = include_once 'libs/Crop/class.image.php';
								$thumbImage = new simpleImage();
								$thumbImage->load($imageLocation);
								
								$x1 = $_POST["x1"] ? $_POST["x1"] : 0;
								$y1 = $_POST["y1"] ? $_POST["y1"] : 0;
								$x2 = $_POST["x2"];
								$y2 = $_POST["y2"];
								$w = $_POST["w"] ? $_POST["w"] : HOME_SLD_WIDTH;
								$h = $_POST["h"] ? $_POST["h"] : HOME_SLD_HEIGHT;
								$scale = HOME_SLD_WIDTH/$w;
								$reSizeImage = $thumbImage->resizeThumbnailImage($slideLocation, $w,$h,$x1,$y1,$scale);
						}				
							
                    $image = $fn;
              }
			  if($image)
			  {
			  	 $id = HomeSlide::AddPhoto($image, $order, 0, $link, DBDATE, $this->mUser->mUserInfo['Id'], $is_new);
				 if($id)
				 {
				 	 @unlink($imageLocation);
				 }
				 uni_redirect(PATH_ROOT . 'base/HomeSlide/slide');
			  }  
			$thumb_width = HOME_SLD_WIDTH;
			$thumb_height = HOME_SLD_HEIGHT;
			$ratio = $thumb_height / $thumb_width;
			$this->mSmarty->assign('tHeight', $thumb_height);
			$this->mSmarty->assign('tWidth', $thumb_width);
			$this->mSmarty->assign('ratio', $ratio);
	        $this->mSmarty->assign('SITE_NAME', SITE_NAME);			
			
	        $this->mSmarty->display('mods/admin/slide/addSlide.html');
	}

    /**
     * Publich/hide ads
     * @return void
     */
	 
    public function Active()
    {
		
		
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id  = _v('id', 0);
		if($id)
		{
			 $slide = HomeSlide::updateBannerActiveStatus($id, DBDATE, $this->mUser->mUserInfo['Id']);
		}
		 uni_redirect(PATH_ROOT . 'base/HomeSlide/slide');
	
    }

	 /**
     * Publich/hide ads
     * @return void
     */
	 
    public function DeActive()
    {
	
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id  = _v('id', 0);
		if($id)
		{
			 $slide = HomeSlide::updateBannerDeactiveStatus($id,  DBDATE, $this->mUser->mUserInfo['Id']);
		}
		 uni_redirect(PATH_ROOT . 'base/HomeSlide/slide');
	
    }
	
	
	 /**
     * Delete
     * @return void
     */
	 
    public function DeleteHomeSlide()
    {
	
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id  = _v('id', 0);
		
		if($id)
		{
			 $image = HomeSlide::GetHomePageImageName($id);
			 $imageName = $image['hs_image'];
			 $slide = HomeSlide::DeleteSlide($id);
			 if($slide)
			 {
			 	 @unlink(BPATH .'files/photo/slide/homeSlide/'.$imageName);
			 }
		}
		 uni_redirect(PATH_ROOT . 'base/HomeSlide/slide');
	
    }	
	
	

 public function UploadPhoto()
    {
        $rand_id = _v('rand_id', 0);

        include_once 'model/FileUpload.class.php';
        $mFu = new FileUpload(array('jpg', 'jpeg', 'gif', 'png'));
		
		

        //upload to tmp directory
        $result = $mFu->handleUpload( 'files/photo/tmp/');

        if (!empty($result['success']) && 1==$result['success'])
        {
            $this->mSession->Set( 'upl_photo_'.$rand_id, $mFu->GetSavedFile() );
            $result['photo'] = $mFu->GetSavedFile();
			include_once BPATH. 'libs/Crop/class.image.php';
			$imgObj = new simpleImage();
			$imgObj->load($result['photo']);
			$imgObj->resizeToWidth(HOME_SLD_WIDTH);
			$imgObj->save($result['photo']);
			$result['width'] = $imgObj->getWidth();
			$result['height'] = $imgObj->getHeight();
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }
 
    public function SlideLinkVideo()
    {
        $this->mSmarty->assign('module', 'Video');
		
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$video = Video::GetVideoList( $u_id, 1, 1 );

            //videos            			
			$this->mSmarty->assignByRef('video', $video['list']);			   
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/slide/ajax/_video_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
    public function SlideLinkMusic()
    {
        $this->mSmarty->assign('module', 'Music');
     
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$albums = MusicAlbum::GetAlbumList($u_id, 1, 1);

            $this->mSmarty->assignByRef('albums', $albums);
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/slide/ajax/_music_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }	
    public function SlideLinkEvent()
    {
        $this->mSmarty->assign('module', 'Events');
	
	    $res = array('q' => OK );				
        $u_id = _v('id', 0);


        $u_events = Event::EventsList( $u_id, 0, 0, array('from' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date("m"), date("d")-1, date("Y")))), '', '', '', EVENT_APPROVED);

            $this->mSmarty->assignByRef('u_events', $u_events);
	   
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/slide/ajax/_event_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }
    public function SlideLinkPhoto()
    {
        $this->mSmarty->assign('module', 'Photo');
		        
		$res = array('q' => OK );				
        $u_id = _v('id', 0);

			$albums = PhotoAlbum::GetAlbumList($u_id);
            //videos
            			
			$this->mSmarty->assignByRef('albums', $albums);			   
            
			$res['data'] = $this->mSmarty->Fetch('mods/admin/slide/ajax/_photo_list_ajax.html');
		
			echo json_encode($res);
			exit();			
    }    
    
}
