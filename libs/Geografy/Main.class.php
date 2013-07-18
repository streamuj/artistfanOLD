<?php

/**
 * Access to geoIP DB
 * 
 * @package    Artistfan
 * @version    1.0
 * @since      01.04.2012
 * @copyright  2012
 * @link       
 */
require_once 'libs/Geografy/geoip.inc';
require_once 'libs/Geografy/geoipcity.inc';
require_once 'libs/Geografy/geoipregionvars.php';

class Model_Geografy_Main
{

    public static function GeoIPInit()
    {
        if (!defined('IP'))
        {
            define('IP',  real_ip());
        }

        // ------------------------------------------------------------------------=
        // GeoIP Initialization
        $AfricaArr = array('AO', 'BJ', 'BW', 'BF', 'BI', 'GA', 'GM', 'GH', 'GN', 'GW', 'DJ', 'ZM', 'EH', 'ZW', 'CV', 'CM', 'KE', 'KM', 'CG', 'CD', 'CI', 'LS', 'LR', 'LY', 'MU', 'MR', 'MG', 'MW', 'ML', 'MA', 'MZ', 'NA', 'NE', 'NG', 'RE', 'RW', 'ST', 'SZ', 'SH', 'SC', 'SN', 'SO', 'SD', 'SL', 'TZ', 'TG', 'TN', 'UG', 'CF', 'TD', 'GQ', 'ER', 'ET');

        $no_cache = 0;

        if (!$no_cache && !empty($_COOKIE['geo']['saved_ip']) && $_COOKIE['geo']['saved_ip'] == IP
                && !empty($_COOKIE['geo']['cntr_by_ip']) && preg_match('/^[A-Z]{2}$/', $_COOKIE['geo']['cntr_by_ip'])
        )
        {
            $selCountry = $_COOKIE['geo']['cntr_by_ip'];
            $selCity = (!empty($_COOKIE['geo']['city_by_ip'])) ? $_COOKIE['geo']['city_by_ip'] : '';
            $selZip  = (!empty($_COOKIE['geo']['zip_by_ip'])) ? $_COOKIE['geo']['zip_by_ip'] : '';
        }
        else
        {

            $gi = geoip_open(dirname(__FILE__) . '/' . 'GeoIPCity.dat', GEOIP_STANDARD);
            $selCity = '';
            $selZip = '';

            if (!empty($gi))
            {
                $record = geoip_record_by_addr($gi, IP);
                if (!empty($record))
                {
                    $selCountry = $record->country_code;
                    if (empty($selCountry))
                    {
                        $selCountry = 'US';
                    }

                    $selCity = $record->city;
                    $selZip = $record->postal_code;
                }
                else
                {
                    $selCountry = 'US';
                }
                geoip_close($gi);
            }
            else
                $selCountry = 'US';

            setcookie('geo[saved_ip]', IP, mktime() + 15552000, '/');
            setcookie('geo[cntr_by_ip]', $selCountry, mktime() + 15552000, '/');
            setcookie('geo[city_by_ip]', $selCity, mktime() + 15552000, '/');
            setcookie('geo[zip_by_ip]', $selZip, mktime() + 15552000, '/');
        }
        return array('country' => $selCountry,
            'city' => $selCity,
            'zip' => $selZip);
    }

}

?>