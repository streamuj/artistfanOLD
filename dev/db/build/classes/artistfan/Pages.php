<?php


/**
 * Skeleton subclass for representing a row from the 'pages' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Pages extends BasePages {

    /**
     * Get page by alias
     * @param string $alias
     * @param int $active
     * @return array
     */
    public static function GetPageByAlias($alias, $active = 1)
    {
        $page = PagesQuery::create()->select(array('Id', 'Title', 'Pagename', 'Sortid', 'Story', 'Active', 'Pdate'));
        if ($active)
        {
            $page = $page->filterByActive(1);
        }
        $page = $page->filterByPagename($alias)->findOne();

        return $page;
    }

    /**
     * Get page by id
     * @param int $id
     * @param int $active
     * @return array
     */
    public static function GetPageById($id, $active = 1)
    {
        $page = PagesQuery::create()->select(array('Id', 'Title', 'Pagename', 'Sortid', 'Story', 'Active', 'Pdate'));
        if ($active)
        {
            $page = $page->filterByActive(1);
        }
        $page = $page->filterById($id)->findOne();

        return $page;
    }

    /**
     * Check exist page alias
     * @param string $alias
     * @param int $id
     * @return int
     */
    public static function CheckAlias($alias, $id = 0)
    {
        $page = PagesQuery::create()->select(array('Id'));
        if ($id)
        {
            $page = $page->filterById($id, Criteria::NOT_EQUAL);
        }
        $page = $page->filterByPagename($alias)->findOne();

        return !empty($page) ? 1 : 0;
    }

    /**
     * Add page
     * @param string $alias
     * @param int $active
     * @return array
     */
    public static function AddPage($title, $alias, $sort, $story, $active = 1)
    {
        $page = new Pages();
        $page->setTitle($title);
        $page->setPagename($alias);
        $page->setSortid((int) $sort);
        $page->setStory($story);
        $page->setActive($active);
        $page->setPdate(mktime());
        $page->save();

        return true;
    }

    /**
     * Update page
     * @param int $id
     * @param array $update
     * @return bool
     */
    public static function UpdatePage($id, $update)
    {
        PagesQuery::create()->select(array('Id'))->filterById($id)->update($update);
        return true;
    }

    /**
     * Delete page
     * @param int $id
     * @return bool
     */
    public static function DeletePage($id)
    {
        PagesQuery::create()->select(array('Id'))->filterById($id)->delete();
        return true;
    }

    /**
     * Get pages list for admin panel
     * @param int $page
     * @param int $items_on_page
     * @return array
     */
    public static function GetPagesList($page = 1, $items_on_page = 10)
    {
        $result = array('rcnt' => 0, 'list' => array());
        $pages = PagesQuery::create()->select(array('Id', 'Title', 'Pagename', 'Sortid', 'Story', 'Active', 'Pdate'));
        $result['rcnt'] = $pages -> count();
        $pages = $pages -> setOffset((($page - 1) * $items_on_page)) -> limit($items_on_page) -> find() -> toArray();
        $result['list'] = $pages;
        
        return $result;
    }
} // Pages
