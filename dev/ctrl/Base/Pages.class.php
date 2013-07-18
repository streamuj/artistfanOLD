<?php
/**
 * Pages class
 * User: Tanya
 * Date: 04.05.12
 * Time: 16:02
 *
 */

class Base_Pages extends Base
{
    public function __construct($glObj)
    {
        parent :: __construct($glObj);
    }

 
    /**
     * Show static pages
     * @return void
     */
    public function Index()
    {
        $pg = ToLower(strip_tags(_v('pg', '')));
		
        $page = Pages::GetPageByAlias($pg);
		
		//deb($pg);
        
		if (!empty($page))
        {
            $this->mSmarty->assignByRef('page', $page);
			$this->mSmarty->assignByRef('pgTitle', $pg);
				
            $this->mSmarty->display('mods/pages/_page.html');   
        }
        else
        {
            $this->NotFound();
        }
    }

    /**
     * Pages list in admin panel
     * @return void
     */
    public function IndexAdmin()
    {
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $page = _v('page', 1);
        $pcnt = 10;
        
        $list = Pages::GetPagesList($page, $pcnt);

        $rcnt = $list['rcnt'];
        $list = $list['list'];
        
        include_once 'model/Pagging.class.php';
        $link = '/base/pages/indexadmin';
        $mpg = new Pagging($pcnt, $rcnt, $page, $link);
        $pagging = $mpg->Make($this->mSmarty);

        $this->mSmarty->assignByRef('pagging', $pagging);

        $this->mSmarty->assignByRef('list', $list);
        $this->mSmarty->assign('no_right', 1);
        $this->mSmarty->assign('amodule', 'pages');
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        $this->mSmarty->display('mods/admin/pages/_list.html');
    }

    /**
     * Publich/hide page
     * @return void
     */
    public function Active()
    {
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id  = _v('id', 0);
        if ($id)
        {
            $page = Pages::GetPageById($id);
            Pages::UpdatePage($id, array('Active' => ($page['Active'] ? 0 : 1)));
        }
        uni_redirect(PATH_ROOT . 'base/pages/indexadmin');
    }


    /**
     * Add/Edit page
     * @return void
     */
    public function EditPage()
    {
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }
        
        $id = _v('id', 0);

        if ($id)
        {
            $page = Pages::GetPageById($id);
            if (empty($page))
            {
                $id = 0;
            }
            $this->mSmarty->assign('id', $id);
        }

        if (!empty($_POST['fm']))
        {
            $fm = $_POST['fm'];
            $fm['Title'] = trim(strip_tags($fm['Title']));
            $fm['Pagename'] = trim(strip_tags($fm['Pagename']));
            $fm['Sortid'] = (int)$fm['Sortid'];
            
            $errs = array();
            if (empty($fm['Title']))
            {
                $errs['Title'] = PLEASE_SPECIFY_TITLE;
            }

            if (empty($fm['Pagename']))
            {
                $errs['Pagename'] = PLEASE_SPECIFY_ALIAS;
            }
            else
            {
                $same = Pages::CheckAlias($fm['Pagename'], $id);
                if($same)
                {
                    $errs['Pagename'] = PAGE_WITH_THAT_ALIAS_ALREADY_EXIST;
                }
            }
            if (empty($errs))
            {  
                if (!$id)
                {
                    Pages::AddPage($fm['Title'], $fm['Pagename'], $fm['Sortid'], $fm['Story']);
                }
                else
                {
                    $update = array('Title' => $fm['Title'],
                                    'Pagename' => $fm['Pagename'],
                                    'Story' => $fm['Story'],
                                    'Sortid' => $fm['Sortid']
                                   );
                    Pages::UpdatePage($id, $update);
                }

                uni_redirect(PATH_ROOT . 'base/pages/indexadmin');
            }
            else
            {
                $this->mSmarty->assignByRef('errs', $errs);
                $this->mSmarty->assignByRef('fm', $fm);
            }
        }
        else
        {
            $this -> mSmarty -> assignByRef('fm', $page);
        }
        $this->mSmarty->assign('no_right', 1);
        $this->mSmarty->assign('SITE_NAME', SITE_NAME);
        $this->mSmarty->assign('amodule', 'pages');
        $this->mSmarty->display('mods/admin/pages/_edit_page.html');
    }


    /**
     * Delete page
     * @return void
     */
    public function Del()
    {
        if(!$this->mUser->CheckAdminStatus())
        {
            uni_redirect(PATH_ROOT);
        }

        $id = _v('id', 0);
        if ($id)
        {
            Pages::DeletePage($id);
        }
        uni_redirect(PATH_ROOT . 'base/pages/indexadmin');
    }

    
}
