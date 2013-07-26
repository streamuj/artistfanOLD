<?php

/**
 * Small validation class
 */
class Valid
{
    public static function String($ar, $field)
    {
    	return !empty($ar[$field]) ? trim( strip_tags($ar[$field]) ) : '';
    }


    public static function Integer($ar, $field, $vals = array())
    {
    	$val = (!empty($ar[$field]) && is_numeric($ar[$field])) ? $ar[$field] : 0;
        if (!empty($vals) && !in_array($val, $vals))
        {
            $val = 0;
        }
        return $val;
    }


    /**
     * Validate date from mm/dd/yyyy format 
     * @param return -1 - empty, -2 - wrong data, else date in yyyy-mm-dd
     */
    public static function Date($ar, $field)
    {
        if (empty($ar[$field]))
        {
        	return -1;
        }	
        else
        {
        	$dt = explode('/', $ar[$field]);
        	if (count($dt)==3 &&
                $dt[0]>=1 && $dt[0]<=12 &&
                $dt[1]>=1 && $dt[1]<=31 &&
                $dt[2]>=date("Y")-100 && $dt[2]<=date("Y")+100
               )
            {
               	return $dt[2].'-'.$dt[0].'-'.$dt[1];
            }
            else
            {
            	return -2;
            }
        }
    }


    /**
     * Validate time from hh:mm AP/PM format
     */
    public static function Time($ar, $field)
    {
        if (empty($ar[$field]))
        {
        	return -1;
        }       	
        else
        {
        	$ar[$field] = trim($ar[$field]);

        	if (strlen($ar[$field]) > 8)
        	{
        		return -2;
        	}
        	else
        	{
        		$tm = strtotime(date("Y-m-d").' '.$ar[$field]);
                if (!empty($tm))
                {
                	return date("H:i", $tm);die;
                }
                else 
                {
                    return -2;    	
                }
        	}
        }
    }

//Video Format
    public static function GetVideoExt()
    {
        $ext_list = array(1=>'3g2',
                             2=>'3gp',
                             3=>'3gpp',
                             4=>'asf',
                             5=>'avi',
                             6=>'dat',
                             7=>'divx',
                             8=>'dv',
                             9=>'f4v',
                             10=>'flv',
                             11=>'m2ts',
                             12=>'m4v',
                             13=>'mkv',
                             14=>'mod',
                             15=>'mov',
                             16=>'mp4',
                             17=>'mpe',
                             18=>'mpeg',
                             19=>'mpeg4',
                             20=>'mpg',
                             21=>'mts',
                             22=>'nsv',
                             23=>'ogm',
                             24=>'ogv',
                             25=>'qt',
                             26=>'tod',
                             27=>'ts',
                             28=>'vob',
                             29=>'wmv');
        return $ext_list;                     
    }	

//Video Format
    public static function GetMusicExt()
    {
        $ext_list = array(1=>'3gp',
                             2=>'act',
                             3=>'AIFF',
                             4=>'aac',
                             5=>'ALAC',
                             6=>'amr',
                             7=>'atrac',
                             8=>'wav',
                             9=>'Au',
                             10=>'awb',
                             11=>'dct',
                             12=>'dss',
                             13=>'dvf',
                             14=>'flac',
                             15=>'gsm',
                             16=>'iklax',
                             17=>'IVS',
                             18=>'m4a',
                             19=>'m4p',
                             20=>'mmf',
                             21=>'mp3',
                             22=>'mpc',
                             23=>'msv',
                             24=>'ogg',
                             25=>'Opus',
                             26=>'ra',
                             27=>'rm',
                             28=>'raw',
                             29=>'TTA',
                             30=>'vox',
                             31=>'wma',
							 32=>'wmv');
        return $ext_list;                     
    }	

}
?>