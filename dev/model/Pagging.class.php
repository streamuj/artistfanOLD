<?php
/**
 * Pagging class - Make pages list
 *
 * @package    Sape.local
 * @version    1.0
 * @since      12.03.2006
 * @copyright  2009 5Dev Team
 * @link       http://sape.local
 */

class Pagging
{
    private $mResOnPage; //Results on page
    private $mEcount; //Count of elements
    private $mPageLink; //Link for pages
    private $mPage; //Current page
    private $mPageMax; //Max pagging items on page

    public function __construct($ResOnPage = 10, $Ecount = 0, $page = 1, $link = '')
    {
        $this -> mResOnPage = $ResOnPage;
        $this -> mEcount = $Ecount;
        $this -> mPageLink = $link;
        $this -> mPageMax = 4;

        if (!is_numeric($page) || $page == 0)
        {
            $page = 1;
        }
        $this -> mPage = $page;
    }


    public function &Make(&$gSmarty, $func = 0, $client_tmpl = 0)
    {
        $pages = '';
        if ($this -> mEcount < $this -> mResOnPage || $this -> mResOnPage == 0)
        {
            return $pages;
        }

        $range = $this -> GetRange();
        $range[] = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page', $this -> mPage);
	
        $link = $this -> mPageLink;
        if (!$func)
        {
            $link .= (strpos($link, '?') > 0) ? '&' : '?';
        }
        #make list
        $k = 0;
        $i = 1;
        $res = array();

        $fl = 1;
        $lr = 8;

        if (($this -> mEcount / $this -> mResOnPage) > $this -> mPageMax && $this -> mPage >= $this -> mPageMax - 1)
        {
            if (floor(($this -> mPage + 1) / $this -> mPageMax) == (($this -> mPage + 1) / $this -> mPageMax))
            {
                $fl = $this -> mPage - ($this -> mPageMax / 2);
                $lr = $this -> mPage + $this -> mPageMax - ($this -> mPageMax / 2);
            }
            else
            {
                $fl = floor($this -> mPage / $this -> mPageMax) * $this -> mPageMax - 1;
                if ($this -> mPage < $fl + ($this -> mPageMax / 2) - 1)
                {
                    $fl = $fl - ($this -> mPageMax / 2);
                }
                $lr = $fl + $this -> mPageMax;
            }
        }

        /** prev && next
        if ($this -> mPage > $this -> mPageMax)
        {
        $gSmarty -> assign('lfirst', $link.'page=1');
        }
        if ($this -> mPage < ceil($this -> mEcount / $this -> mResOnPage))
        {
        $gSmarty -> assign('llast', $link.'page='.ceil($this -> mEcount / $this -> mResOnPage));
        }
         */

        if (1 < $this -> mPage)
        {
            $gSmarty -> assign('lprev', $func ? 'javascript:'.$link . '(' . ($this -> mPage - 1) . ')' : $link . 'page=' . ($this -> mPage - 1));
        }
        if ($this -> mPage < (ceil($this -> mEcount / $this -> mResOnPage)))
        {
            $gSmarty -> assign('lnext', $func ? 'javascript:'.$link . '(' . ($this -> mPage + 1) . ')' : $link . 'page=' . ($this -> mPage + 1));

            if ($lr < (ceil($this -> mEcount / $this -> mResOnPage)))
            {
                $gSmarty -> assign('last_page', ceil($this -> mEcount / $this -> mResOnPage));
                $gSmarty -> assign('last_page_link', $func ? 'javascript:'.$link . '(' . (ceil($this -> mEcount / $this -> mResOnPage)) . ')' : $link . 'page=' . ceil($this -> mEcount / $this -> mResOnPage));
            }
        }


        while ($k < $this -> mEcount)
        {
            if ($i > $lr)
            {
                break;
            }
            if ($i >= $fl && $i <= $lr)
            {
                $res[] = array('page' => $i, 'link' => $func ? 'javascript:'.$link . '('.$i.')' : $link . 'page=' . $i);
            }
            $k += $this -> mResOnPage;
            $i++;
        }
        if (1 < count($res))
        {
            $gSmarty -> assign('pages', $res);
        }

        if (!$client_tmpl)
        {
            $pages = $gSmarty -> fetch('mods/admin/_pagging.html');
        }
        else
        {
            $pages = $gSmarty -> fetch('mods/_pagging.html');
        }
        return $pages;

    }



    public function &Make2(&$gSmarty, $func = 0, $client_tmpl = 0)
    {
		 $pages = '';
        if ($this -> mEcount < $this -> mResOnPage || $this -> mResOnPage == 0)
        {
            return $pages;
        }

        $range = $this -> GetRange();
        $range[] = $this -> mEcount;
        $gSmarty -> assign('range', $range);
        $gSmarty -> assign('page', $this -> mPage);

        $link = $this -> mPageLink;
        if (!$func)
        {
            $link .= (strpos($link, '?') > 0) ? '&' : '?';
        }
        #make list
        $k = 0;
        $i = 1;
        $res = array();

        $fl = 1;
        $lr = 8;

        if (($this -> mEcount / $this -> mResOnPage) > $this -> mPageMax && $this -> mPage >= $this -> mPageMax - 1)
        {
            if (floor(($this -> mPage + 1) / $this -> mPageMax) == (($this -> mPage + 1) / $this -> mPageMax))
            {
                $fl = $this -> mPage - ($this -> mPageMax / 2);
                $lr = $this -> mPage + $this -> mPageMax - ($this -> mPageMax / 2);
            }
            else
            {
                $fl = floor($this -> mPage / $this -> mPageMax) * $this -> mPageMax - 1;
                if ($this -> mPage < $fl + ($this -> mPageMax / 2) - 1)
                {
                    $fl = $fl - ($this -> mPageMax / 2);
                }
                $lr = $fl + $this -> mPageMax;
            }
        }

        

        if (1 < $this -> mPage)
        {
            $gSmarty -> assign('lprev', $func ? 'javascript:'.$link . '($(\'#filter\').val(),' . ($this -> mPage - 1) . ')' : $link . 'page=' . ($this -> mPage - 1));
        }
        if ($this -> mPage < (ceil($this -> mEcount / $this -> mResOnPage)))
        {
            $gSmarty -> assign('lnext', $func ? 'javascript:'.$link . '($(\'#filter\').val(),' . ($this -> mPage + 1) . ')' : $link . 'page=' . ($this -> mPage + 1));

            if ($lr < (ceil($this -> mEcount / $this -> mResOnPage)))
            {
                $gSmarty -> assign('last_page', ceil($this -> mEcount / $this -> mResOnPage));
                $gSmarty -> assign('last_page_link', $func ? 'javascript:'.$link . '($(\'#filter\').val(),' . (ceil($this -> mEcount / $this -> mResOnPage)) . ')' : $link . 'page=' . ceil($this -> mEcount / $this -> mResOnPage));
            }
        }


        while ($k < $this -> mEcount)
        {
            if ($i > $lr)
            {
                break;
            }
            if ($i >= $fl && $i <= $lr)
            {
                $res[] = array('page' => $i, 'link' => $func ? 'javascript:'.$link . '($(\'#filter\').val(), '.$i.')' : $link . 'page=' . $i);
            }
            $k += $this -> mResOnPage;
            $i++;
        }
        if (1 < count($res))
        {
            $gSmarty -> assign('pages', $res);
        }

        if (!$client_tmpl)
        {

            $pages = $gSmarty -> fetch('mods/admin/_pagging.html');
			
        }
        else
        {
            $pages = $gSmarty -> fetch('mods/_pagging.html');
        }
		
		if($pages)
		{
			 return $pages;
		}else{
			return $pages = "ERROR";
		}
       

    }

    public function &GetRange()
    {
        $res[0] = ($this -> mPage - 1) * $this -> mResOnPage;
        $res[1] = $this -> mPage * $this -> mResOnPage;
        if ($res[1] > $this -> mEcount)
            $res[1] = $this -> mEcount;
        return $res;

    }
    #GetRange

}#end class