<?php

/**
 * Pages class
 * User: Tanya
 * Date: 04.05.12
 * Time: 16:02
 *
 */ 
  
class Base_Adbanner extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);

		if (!$this->mUser->IsAuth())
        {
            uni_redirect( PATH_ROOT . 'base/user/login' );
        }		
    }


    /**
     * Show static pages
     * @return void
     */
    public function Banner()
    {
		 if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }
		
		$page = _v('page', 1);
        $pcnt = 10;

        $rcnt = Adbanner::GetCount();
        $banner = Adbanner::getBannerList( 0, $page, $pcnt);
		
		 include_once 'model/Pagging.class.php';
        $link = '/base/Adbanner/Banner';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make($this->mSmarty);
		
        $this->mSmarty->assignByRef('pagging', $pagging);
		$bannerType = AdbannerType::GetBannerType();
		$this->mSmarty->assignByRef('bannerType', $bannerType);
        $this->mSmarty->assignByRef('banner', $banner);
        $this->mSmarty->assign('no_right', 1);
        $this->mSmarty->assign('amodule', 'Adbanner');
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
		
		$this->mSmarty->display('mods/admin/ads/_list.html');
       
    }

	 /**
     * Show static pages
     * @return void
     */
    public function addBanner()
    {
		 if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }
		
		  $rand_id = _v('rand_id', rand(100000, 999999));
		  $this->mSmarty->assign('rand_id', $rand_id);
		  $BannerTypeparams	=	$_REQUEST['BannerType'];
		  
		  if($_POST)
		  {

		   	   $image = $this->mSession->Get('upl_photo_' . $rand_id);
			   if (empty($id) && empty($image))
			   {   
					$errs['Image'] = 'Please upload photo file';
			   }
		   
			   if(empty($errs))
			   {
			     if (!empty($image))
          	    {
                    include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
					$imageLocation = BPATH.$image;
					$slideLocation = BPATH . 'files/photo/addBanner/'.$fn;
					
						if(file_exists($imageLocation))
						{
								$tes = include_once 'libs/Crop/class.image.php';
								$thumbImage = new simpleImage();
								$thumbImage->load($imageLocation);
								
								if($BannerTypeparams==1)
								{
								$thumbImage->fitImage(TOP_BANNER_WIDTH,  TOP_BANNER_HEIGHT);								
								}
								else if($BannerTypeparams==2)
								{
								$thumbImage->fitImage(RIGHT_BANNER_WIDTH,  RIGHT_BANNER_HEIGHT);																
								}
								else{
								$thumbImage->fitImage(CENTER_BANNER_WIDTH,  CENTER_BANNER_HEIGHT);																
								}
								
								
								$thumbImage->saveThumb($slideLocation);
						}
						else
						{
								$tes = include_once 'libs/Crop/class.image.php';
								$thumbImage = new simpleImage();
								$thumbImage->load($imageLocation);
								if($BannerTypeparams==1)
								{
								$thumbImage->fitImage(TOP_BANNER_WIDTH,  TOP_BANNER_HEIGHT);								
								}
								else if($BannerTypeparams==2)
								{
								$thumbImage->fitImage(RIGHT_BANNER_WIDTH,  RIGHT_BANNER_HEIGHT);																
								}
								else{
								$thumbImage->fitImage(CENTER_BANNER_WIDTH,  CENTER_BANNER_HEIGHT);																
								}

								$thumbImage->saveThumb($slideLocation);
							
						}
							
                    $image = $fn;
					
              }
			  if($image)
			  {
			  	 $id = Adbanner::AddBanner($image, $_POST['BannerType'], $_POST['Link']);
				 if($id)
				 {
				 	 @unlink($imageLocation);
				 }
				 $this->mSmarty->assign('added', 1);
				 uni_redirect(PATH_ROOT . 'base/Adbanner/addBanner');
			  }
		  }
		  else
		  {			
			$this->mSmarty->assignByRef('errs', $errs);
		  }		  
 		}


		/* Get Banner Type*/
			$bannerType = AdbannerType::GetBannerType();

			//deb($bannerType);
			$this->mSmarty->assignByRef('bannerType', $bannerType);
			$this->mSmarty->assign('no_right', 1);
			$this->mSmarty->assign('amodule', 'Adbanner');
			$this->mSmarty->assign('SITE_NAME', SITE_NAME);
			 
		$this->mSmarty->display('mods/admin/ads/addBanner.html');
       
    }
	
	public function editBanner()
	{
	
		 if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }
		  $BannerTypeparams	=	$_REQUEST['BannerType'];
		  $rand_id = _v('rand_id', rand(100000, 999999));
		  $id = _v('id',0);
		  $editdata	=	$this->getBannerById($id);
		  if($editdata)
		  {
		  $this->mSmarty->assign('id', $id);		  		  
		  $this->mSmarty->assign('adb_image', $editdata['adb_image']);		  
		  $this->mSmarty->assign('adb_type', $editdata['adb_type']);		  
		  $this->mSmarty->assign('adb_link', $editdata['adb_link']);		  		  		  
		  }
		  
		  
		  if($_REQUEST['Update']=='Update')
		  {
		    if($_POST)
		  {
		  	  $image = $this->mSession->Get('upl_photo_' . $rand_id);
			   if (empty($id) && empty($image))
			   {
					$errs['Image'] = 'Please upload photo file';
			   }
			   
			   if (!empty($image))
          	   {
                    include_once 'libs/Crop/Image_Transform.php';
                    include_once 'libs/Crop/Image_Transform_Driver_GD.php';
                    
                    $pathinfo = pathinfo($image);
                    $ext = ToLower($pathinfo['extension']);
                    $fn = substr(md5(mktime()), 0, 10) . date("hm") . '.' . $ext;
					$imageLocation = BPATH.$image;
					$slideLocation = BPATH . 'files/photo/addBanner/'.$fn;
					
						if(file_exists($imageLocation))
						{
								$tes = include_once 'libs/Crop/class.image.php';
								$thumbImage = new simpleImage();
								$thumbImage->load($imageLocation);
								if($BannerTypeparams==1)
								{
								$thumbImage->fitImage(TOP_BANNER_WIDTH,  TOP_BANNER_HEIGHT);								
								}
								else if($BannerTypeparams==2)
								{
								$thumbImage->fitImage(RIGHT_BANNER_WIDTH,  RIGHT_BANNER_HEIGHT);																
								}
								else{
								$thumbImage->fitImage(CENTER_BANNER_WIDTH,  CENTER_BANNER_HEIGHT);																
								}

								$thumbImage->saveThumb($slideLocation);
						}
						else
						{
								$tes = include_once 'libs/Crop/class.image.php';
								$thumbImage = new simpleImage();
								$thumbImage->load($imageLocation);
								if($BannerTypeparams==1)
								{
								$thumbImage->fitImage(TOP_BANNER_WIDTH,  TOP_BANNER_HEIGHT);								
								}
								else if($BannerTypeparams==2)
								{
								$thumbImage->fitImage(RIGHT_BANNER_WIDTH,  RIGHT_BANNER_HEIGHT);																
								}
								else{
								$thumbImage->fitImage(CENTER_BANNER_WIDTH,  CENTER_BANNER_HEIGHT);																
								}

								$thumbImage->saveThumb($slideLocation);
							
						}
							
                    $image = $fn;
					
              }
			  if($image)
			  {

			  	 $id = Adbanner::EditBanner($image, $_POST['BannerType'], $_POST['Link'],$_POST['Id']);
				 if($id)
				 {
				 	 @unlink($imageLocation);
				 }
				 uni_redirect(PATH_ROOT . 'base/Adbanner/Banner');
			  }
			  else
			  {
			   $editdata	=	$this->getBannerById($_POST['Id']);
				  if($editdata)
				  {
					$image	=	$editdata['adb_image'];
				  }
				  $id = Adbanner::EditBanner($image, $_POST['BannerType'], $_POST['Link'],$_POST['Id']);
				 if($id)
				 {
				 	 @unlink($imageLocation);
				 }
				 uni_redirect(PATH_ROOT . 'base/Adbanner/Banner');
			  
			  }
		  }
		  }
		  
		  $this->mSmarty->assign('rand_id', $rand_id);
		  
		
		
		/* Get Banner Type*/
			$bannerType = AdbannerType::GetBannerType();
			//deb($bannerType);
			$this->mSmarty->assignByRef('bannerType', $bannerType);
			$this->mSmarty->assign('no_right', 1);
			$this->mSmarty->assign('amodule', 'Adbanner');
			$this->mSmarty->assign('SITE_NAME', SITE_NAME);
					
		$this->mSmarty->display('mods/admin/ads/editBanner.html');
       
    
	}
	
	public function getBannerById($id)
		{
		$sql	=	"SELECT * FROM `adbanner` where adb_id = $id";
		$result	=	 Query::GetOne($sql);
		return $result;
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
			 $banner = Adbanner::updateBannerActiveStatus($id);
		}
		 uni_redirect(PATH_ROOT . 'base/Adbanner/Banner');
	
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
			 $banner = Adbanner::updateBannerDeactiveStatus($id);
		}
		 uni_redirect(PATH_ROOT . 'base/Adbanner/Banner');
	
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
        }

        echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        exit();
    }
	
	/* Delete ads Banner */
	
	public function Delete()
	{
		if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id  = _v('id', 0);
		if($id)
		{
			 $banner = Adbanner::DeleteBanner($id);
		}
		 uni_redirect(PATH_ROOT . 'base/Adbanner/Banner');
	
	}
	
    
}
