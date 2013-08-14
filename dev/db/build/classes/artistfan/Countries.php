<?php



/**
 * Skeleton subclass for representing a row from the 'countries' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.artistfan
 */
class Countries extends BaseCountries {

    public static function GetCountries( $mCache = '' )
    {
        //get from cache
        if (!empty($mCache))
        {
            $countries = $mCache->get('all_countries', 30*24*3600);
            if (!empty($countries))
            {
                return @unserialize($countries);
            }
        }

        $countries_list = CountriesQuery::create()->select(array('Iso2', 'Name', 'Pcode', 'Iso3'))
                ->orderBySortid('DESC')->orderByName()->find()->toArray();

        //make assoc
        $countries = array();
        foreach($countries_list as $item)
        {
            $countries[$item['Iso2']] = $item;
        }
        unset($countries_list);

        //save to cache
        if (!empty($mCache))
        {
            $mCache->set('all_countries', serialize($countries), 30*24*3600);
        }
        
        //return
        return $countries;
    }

    public static function GetCountryName($iso)
    {
        return CountriesQuery::create()->select(array('Name'))
                ->filterByIso2($iso)->findOne();
    }

    public static function GetCountriesNames($array_iso)
    {
        $countries_list = CountriesQuery::create()->select(array('Name', 'Iso2'))
                ->filterByIso2($array_iso, Criteria::IN)->find()->toArray();
        $countries = array();
        foreach($countries_list as $item)
        {
            $countries[$item['Iso2']] = $item['Name'];
        }
        unset($countries_list);
        return $countries;
    }

} // Countries
