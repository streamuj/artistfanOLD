<?php
function make_assoc_array( $ar, $field )
{
    $res= array();
    foreach ($ar as $v) 
    {
        $res[ $v[$field] ] = $v;
    }
    unset($ar);
    return $res;
}


/**
 * return array with keys && 1
 * @param <type> $ar
 * @return int
 */
function make_array_keys_1( $ar )
{
    if (empty($ar))
    {
        return array();
    }
    $res = array();
    foreach ($ar as $v)
    {
        if (!is_array($v))
        {
            $res[$v] = 1;
        }
    }
    return $res;
}


/* Function to get the url of the text */
function getUrl($text)
{
	if(trim($text) == '') return;
	if(!stristr( $text, 'https://') && !stristr( $text, 'http://')){
		$text = 'http://'.$text;
	}
	return $text;
}

/* Change the text as hyperlink when it as website addresses */
function makeTextAsHyperLink($text)
{
	$text = trim($text);
	$text = html_entity_decode($text);
	$text = " ".$text;
	$text = preg_replace('/((f|ht){1}tps?:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+/i',
			'<a href="$0" target="_blank">$0</a>', $text);
	$text = preg_replace('/[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}/i',
	'<a href="mailto:$0" target="_blank">$0</a>', $text);
	$text = preg_replace('#([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~\#\?&//=]+)#i',
	'\\1<a href="http://\\2" target="_blank">\\2</a>', $text);
	return $text;
}

function addBackSlashes(&$item, $key)
{
	$item = addslashes(trim($item));
}

/**
 * Get image directory name by user ID
 * @param $uid
 * @return string
 */
function MakeDirName($uid)
{
    $s = '1/';
    return $s;
}

/**
 * Create directory for user
 * @param $dir
 * @param $user_id
 * @return string
 */
function MakeUserDir( $dir, $user_id, $glPath = '' )
{
    if (!$glPath)
    {
        $glPath = BPATH;
    }
    if (file_exists($glPath . $dir . '/' .$user_id))
    {
        return $dir . '/' .$user_id;
    }
    else
    {
        mkdir($glPath . $dir . '/' .$user_id, 0777);
        return $dir . '/' .$user_id;
    }
}



function debq( $q = 0 )
{
    if (!$q)
    {
        deb( Propel::getConnection()->getLastExecutedQuery() );
    }
    else
    {
        echo '<pre>'.Propel::getConnection()->getLastExecutedQuery().'</pre>';
    }
}

function base_chk2($str)
{
    return substr(trim(strip_tags($str, '')),0,1000);
}

/** prepate date period */
function PrepDateTime( $d1, $d2 )
{
    $s = '';
    if ( date("Y", $d1) == date("Y", $d2) && date("m", $d1) == date("m", $d2))
    {
        $s = date("M", $d1).' '.date("d", $d1).' - '.date("d", $d2).', '.date("Y", $d1);
    }        
    elseif ( date("Y", $d1) == date("Y", $d2) && date("m", $d1) != date("m", $d2) )
    {
        $s = date("M", $d1).' '.date("d", $d1).' - '.date("M", $d2).' '.date("d", $d2).', '.date("Y", $d1);
    }
    else
    {
        $s = date("M", $d1).' '.date("d", $d1).', '.date("Y", $d1).' - '.date("M", $d2).' '.date("d", $d2).', '.date("Y", $d2);
    }
    return $s;
}/** PrepDateTime */

function getEstTime()
{
	$estDate = new DateTime();
	$estTimeZone = new DateTimeZone('EST');
	$estDate->setTimezone($estTimeZone);
	$offset = $estDate->getOffset();
	$estTime = mktime() + $offset;
	return $estTime;
}

function wallTime($diff)
{
	$estDate = new DateTime();
	$estTimeZone = new DateTimeZone('EST');
	$estDate->setTimezone($estTimeZone);
	$offset = $estDate->getOffset();
	$estTime = mktime() + $offset;
	$orginalTime = $diff = $diff + $offset;


    if (empty($diff))
    {
        $res = array();
        return $res;
    }
	$diff = $estTime - $diff;
	/*
	if($diff < 60){
		$res ='';
	} elseif($diff < 60*60){
		$res = date('i \m\i\n\u\t\e\s', $diff).' ago';
	} elseif ($diff < 60*60*24){
		$res = date('H \h\o\u\r\s i \m\i\n\u\t\e\s ', $diff).' ago';
	} elseif($diff < 48*60*60){
		$res = ' Yesterday '.date('g:i a', $orginalTime);
	} elseif($diff < 72*60*60){
		$res = date('l \a\t g:i a', $orginalTime);
	} else {
		$res = date('F d \a\t g:i a', $orginalTime);
	}
	*/
	$res = date('F d \a\t g:i a', $orginalTime);
    return $res;
}
function textTime($diff)
{
	/* Get the EST Time*/
	$estDate = new DateTime();
	$estTimeZone = new DateTimeZone('EST');
	$estDate->setTimezone($estTimeZone);
	$offset = $estDate->getOffset();
	$estTime = mktime() + $offset;
//	$diff = $diff + $offset;


    if (empty($diff))
    {
        $res = array();
        return $res;
    }
	$diff = $estTime -$diff;
	
	if ($diff <=0) {
		return '';
	}


    $d['year'] = floor($diff/(60*60*24*7*4*12));
    $diff = $diff % (60*60*24*30);

    $d['month'] = floor($diff/(60*60*24*30));
    $diff = $diff % (60*60*24*30);

    $d['week'] = floor($diff/(60*60*24*7));
    $diff = $diff % (60*60*24*7);

    $d['day'] = floor($diff/(60*60*24));
    $diff = $diff%(60*60*24);

    $d['hour'] = floor($diff/(60*60));
    $diff= $diff % (60*60);

    $d['minute'] = floor($diff/(60));
    $diff= $diff % (60);
	
    $s = '';
    foreach ($d as $kx => $vx)
    {
        if ($vx)
        {
            $s.= ($s ? ' ' : '').$vx.' '.$kx.($vx > 1 ? 's' : '');
        } 
    }
	//echo $s;
	//die;
	
    return $s;
}


/**
 * round to 2 digits after "." for minumum
 * @param float
 * @return float
 */
function Round100( $num )
{
    if (0 < strpos('_'.$num, '.'))
    {
        $num = substr($num, 0, strpos($num, '.')).'.'.substr($num, strpos($num, '.')+1, 2);
    }
    return $num;
}/** Round100 */


/** 
 * form 16-digits number to 123456-7890-123456 
 * @param string $string
 * @return string  
 * */
function trnum( $string )
{
    $s = substr($string, 0, 6).'-'.substr($string, 6, 4).'-'.substr($string, 10, 6);
    return $s;
}


/** 
 * Make numeric format of number 
 * @param $v
 * @return string
 */
function mnum( $v )
{
	return number_format($v, 2, '.', '');
}


function hex2bin($h)
{
    if (!is_string($h)) 
        return null;
    $r = '';
    for ($a=0; $a<strlen($h); $a+=2) 
    { 
        $r.=chr(hexdec($h{$a}.$h{($a+1)})); 
    }
    return $r;
}


/** Debug functions */
function debm($vr)
{
    @mail('sergysh@gmail.com', 'Debug', print_r($vr, true));
}/** debm */


/**
 * Debuf function 
 * @param $val
 * @param $ondie
 * @return unknown_type
 */
function deb($val, $ondie = true)
{
    echo '<pre>';
    print_r($val);
    if ($ondie)
    {
        die();
    }
}/** deb */


/**
 * Send email to admin (with email ADMIN_EMAIL)
 *
 * @param string $source  message subject
 * @param string $message message text
 *
 * @return void
 *
 * @see includes/config/main.ini
 */
function admin_notify($source, $message)
{
    $headers = '';
    $headers .= 'From: '.SUPPORT_SITENAME.' Notification <'.SUPPORT_EMAIL.">\n";
    $headers .= 'Content-Type: text/html; charset='.DEF_CHARSET."\n"; 
    @mail(ADMIN_EMAIL,'New notify: '.$source, $message, $headers);
}


/** Check ? in string */
function cb($s)
{
    return (0 < strpos('_'.$s, '?')) ? '&' : '?';
}/** cb */


/** 
 * Prepare var from request
 *
 */
function _v( $var, $val = '' )
{
    $num =  (is_numeric($val)) ? 1 : 0;
	$r = (!empty($_REQUEST[$var]) && (!$num || ($num && is_numeric($_REQUEST[$var])))) ? $_REQUEST[$var] : $val; 
    return $r;
}/** _v */


/**
 * Universal function for redirect. Auto-update urls if use_trans_id is on.
 *
 * @param string $url       url for redirect
 * @param int    $flag      type of redirect: 1,3 - through HTTP Header, 2,4 - through meta-tag. 3,4 - auto-update url with https (SSL Only)
 * @param int    $useSID    update url with session id: 0 - never, 1 - if no host in url, 2 - always
 * @param string $addParams this string is put in url end
 *
 * @return void
 */
/* Set redirect to the page*/
function setRedirect($url, $isSecure = false)
{
	if(!stristr( $url, 'http')){
		$url = ROOT_HTTP_PATH.'/'.$url;
	}
	if($isSecure) {
		$url = str_replace('http://', 'https://', $url);
	} else {
		$url = str_replace('https://', 'http://', $url);
	}
	if($_POST['ajaxMode']){
		echo array2json(array('redirect' => $url));
	} else if($_GET['ajaxMode']){
		echo '<script type="text/javascript">window.location ="'.$url.'"</script>';
	} else {
		header('location: '. $url);
	}
	exit;
} 


function uni_redirect($url, $flag = 1, $useSID = 1, $addParams = '') // 
{
    $url = add_sid($url,$useSID);
    if ('' != $addParams)
    {
        $purl   = parse_url($url);

        if (3 == $flag || 4 == $flag)
            $scheme = 'https://';
        else
            $scheme = (!empty($purl['scheme'])) ? $purl['scheme'].'://' : '';

        $host   = (!empty($purl['host'])) ?$purl['host'] : '';
        $port   = (!empty($purl['port'])) ?$purl['port'] : '';
        $path   = (!empty($purl['path'])) ?$purl['path'] : '/';


        $url    = $scheme.$host.$port.$path.'?';
        
        $url   .= (!empty($purl['query'])) ? $purl['query'].'&' : '';
        $url   .= $addParams;
    }
	$ajaxMode = _v('ajaxMode', 0);
	if($ajaxMode){
		echo json_encode(array('redirect'=>$url));
		exit;
	}
    if (1 == $flag || 3 == $flag)
        header('Location: '.$url);
     else
        echo '<html><head><meta http-equiv="Refresh" content="0; url='.$url.'" /></head></html>';

    exit();
}/** uni_redirect */




/**
 * Add session id in url if it is required
 *
 * @param string $url     url
 * @param int    $useSID  0 - no , 1 - if no host, 2 - always
 *
 * @return string result url
 *
 * @see uni_redirect()
 */ 
function add_sid($url, $useSID = 1) // 
{
    $purl   = parse_url($url);
    $scheme = (!empty($purl['scheme']))  ? $purl['scheme'].'://' : '';
    $host   = (!empty($purl['host']))    ? $purl['host']         : '';
    $port   = (!empty($purl['port']))    ? $purl['port']         : '';
    $path   = (!empty($purl['path']))    ? $purl['path']         : '/';
                   
    $url = $scheme.$host.$port.$path;

    if (defined('SID') && strlen(SID) > 0 
        && (2 == $useSID || 1 == $useSID && empty($host) ) )
    {
        if (!empty($purl['query']) && preg_match('/'.SID.'/',$purl['query']))
           $url = $url.'?'.$purl['query'];
        else 
           $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'].'&'.SID : $url.'?'.SID;
    }
    else
       $url = (!empty($purl['query'])) ? $url.'?'.$purl['query'] : $url;

    return $url;
}/** add_sid */


function PrepMethodName( $name, $val = '' )
{
	$name = trim(strtolower($name));  
    if (empty($name)|| !preg_match('/^[0-9a-z]+$/i', $name))
    {
    	$name = $val;
    }
    else
    {
    	$name[0] = strtoupper($name[0]); 
    }
    return $name;
}/** PrepMethodName */


/**
 * Make Uppercase
 * (for insert mb_string)
 * @param string $str input string
 * @return string
 */
function ToUpper($str)
{
	return mb_strtoupper($str, 'utf8');
}

/**
 * Make lowercase
 * (for insert mb_string)
 * 
 * @param string $str input string
 * @return string
 */
function ToLower($str)
{
	return mb_strtolower($str, 'utf8');
}/** ToLower */

function StringLen( $str )
{
    return mb_strlen($str, 'utf8');
}

/**
 * Verify Email
 *
 * @param string $email email for checking
 *
 * @return bool false if bad email or true if email is correct
 */
function verify_email($email)
{
    if (7 > strlen($email))
       return false;

    $zones = array(
            'ac','ad','ae','af','ag','ai','al','am','an','ao','aq','ar','as','at','au','aw','az',
            'ax','ba','bb','bd','be','bf','bg','bh','bi','bj','bm','bn','bo','br','bs','bt','bv',
            'bw','by','bz','ca','cc','cd','cf','cg','ch','ci','ck','cl','cm','cn','co','cr','cs',
            'cu','cv','cx','cy','cz','de','dj','dk','dm','do','dz','ec','ee','eg','eh','er','es',
            'et','eu','fi','fj','fk','fm','fo','fr','ga','gb','gd','ge','gf','gg','gh','gi','gl',
            'gm','gn','gp','gq','gr','gs','gt','gu','gw','gy','hk','hm','hn','hr','ht','hu','id',
            'ie','il','im','in','io','iq','ir','is','it','je','jm','jo','jp','ke','kg','kh','ki',
            'km','kn','kp','kr','kw','ky','kz','la','lb','lc','li','lk','lr','ls','lt','lu','lv',
            'ly','ma','mc','md','mg','mh','mk','ml','mm','mn','mo','mp','mq','mr','ms','mt','mu',
            'mv','mw','mx','my','mz','na','nc','ne','nf','ng','ni','nl','no','np','nr','nu','nz',
            'om','pa','pe','pf','pg','ph','pk','pl','pm','pn','pr','ps','pt','pw','py','qa','re',
            'ro','ru','rw','sa','sb','sc','sd','se','sg','sh','si','sj','sk','sl','sm','sn','so',
            'sr','st','sv','sy','sz','tc','td','tf','tg','th','tj','tk','tl','tm','tn','to','tp',
            'tr','tt','tv','tw','tz','ua','ug','uk','um','us','uy','uz','va','vc','ve','vg','vi',
            'vn','vu','wf','ws','ye','yt','yu','za','zm','zw',
            'aero','biz','cat','com','coop','info','jobs','mobi','museum','name','net',
            'org','pro','travel','gov','edu','mil','int'
            );
    $regEmail = '/^[\w-\.]+@([\w-]+\.)+([\w-]{2,4})$/';

    $matches = array();
    if (!preg_match($regEmail, $email, $matches))
        return false;

    if (!in_array($matches[2], $zones))
       return false;

    return true;
}#verify_email 



function check_valid_url($url)
{
	$url = trim($url);
	if (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
	"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
	"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
	"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&()".
	"?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i",$url,$ok))
	return false;
	if (!strstr($url,"://")) $url = "http://".$url;
	$url = preg_replace("~^[a-z]+~ie","strtolower('\\0')",$url);
	return $url;
}


/**
 *function human_file_size
 *Get normal file size (Mb,Kb etc.)
 * @param  int32
 * @return string
 */
function human_file_size($size)
{
   $filesizename = array(' Bytes', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
   return round($size/pow(1500, ($i = floor(log($size, 1500)))), 2) . $filesizename[$i];
}


    /**
    * Make original filename
    * @param string $fname - filename
    * @param string $path   - filepath, for example see DIR_WS_IMAGE in main.php
    * @return string - unique image name
    */
    function MakeOrig($fname = '', $path = '', $rv = 0)
    {
        if ($fname == '' || $path == '')
        {
            return $fname;
        }
        $i    = explode('.', $fname);
        if (count($i) < 2)
        {
            $i[1] = 'jpg';
        }
        if (1 == $rv)
        {
            $i[0] = randval();
        }
        $ic   = $i[0];
        $k    = 0;
        while (file_exists($path . '/' . $ic.'.'.$i[count($i)-1]))
        {
            $ic = $i[0] . $k;
            $k ++;
        }
        $s =  $ic.'.'.$i[count($i)-1];
        return $s;
    }#MakeOrig
	
// --------------------------------------------------------------------------------

/**
 * Generate random unique integer value dependent on current time
 *
 * @return int
 */
function randval()
{
   return (int)date('n').date('j').date('y').date('h').date('i').date('s').rand(99,2);
}        


// --------------------------------------------------------------------------------
/**
 * Crop function with copy image
 * @param  int $crop resize method: 1,2
 * @return int
 */
function i_crop_copy($w, $h, $uploadfile, $res_img, $crop = 1)
{
	
	
    $size = getimagesize($uploadfile);
    if ($size)
    {
        $width  = $size[0];
        $height = $size[1];

        $imgObjName  =  'Image_Transform_Driver_GD';
        $img         = new $imgObjName();

        if ($width > $w || $height > $h)
        {
            $wx = $w;
            $hx = $h;

            $img -> load($uploadfile);

            if (1 == $crop)
            {
                $crop_height = ($width*$hx)/$wx;
                if ($crop_height > $height) // crop by width
                {
                    $crop_width  = ($height*$wx)/$hx;
                    $crop_height = $height;
                    $img -> crop(($width - $crop_width) / 2, 0, $crop_width, $height);
                }
                else // �rop by height
                {
                    $crop_width  = $width;
                    $img -> crop(0, ($height - $crop_height) / 2, $width, $crop_height);
                }
               
                $img -> save($res_img);
                $img -> load($res_img);
            }
            else
            {
                $coeff = $height / $width;

                if ($coeff*$wx > $hx)
                   $wx = $width*$hx / $height;
                else
                   $hx = $height*$wx / $width;
            }

            if ($img -> resize($wx, $hx))
            {
                $img -> save($res_img,'jpeg');
                return true;
            }
            else
            {
                return false;
            }    
        }
        else
		{
            copy($uploadfile, $res_img); 
		}	
    }
    else
    {
        return false;
    }  
}#i_crop_copy

/**
 * GZ-Compress (i)

 * @param Smarty $gSmarty 
 *
 * @return void
 */
function load_gz_compress(&$gSmarty)
{
    if (defined('GZ_COMPRESS') && 1 == GZ_COMPRESS 
        && false !== strpos(getenv('HTTP_ACCEPT_ENCODING'), 'gzip') 
       )
    {
        header('Content-Encoding: gzip');
       
        function GZCallback($buffer) 
        {
            return gzencode($buffer, 9);
        }
       
        ob_start('GZCallback');
        ob_implicit_flush(0);
        $gSmarty -> assign('GZ_COMPRESS', GZ_COMPRESS);
    }
}


/**
 * Generate random string value (through md5) based on unique information.
 * Initial unique information is supplemented with random numbers
 *
 * @param string $info unique information for encryption
 *
 * @return string
 */
function uni_id2($info = '')
{
    define('SALT_LENGTH', 8);
	$length = SALT_LENGTH;
    $chars = '0123456789abcdef';
    $salt  = '';
    mt_srand((double)microtime()*1000000);
    while ($length--) 
    {
        $salt .= $chars[mt_rand(0, strlen($chars)-1)];
    }
    
    return md5($salt.$info.mt_rand(0,1000000).get_mt_time());
}


/**
 * Time in seconds including micro seconds.
 *
 * @return string time in seconds: example 5.234232432
 *
 * @see microtime()
 */
function get_mt_time()
{
    $arr = split(' ',microtime());
    return ($arr[0] + $arr[1]);
}


function MakeOrigName( $fname )
{
    $ext  =  str_replace('.', '', strrchr($fname, "."));
    $name =  translit( substr($fname, 0, strlen($fname) - strlen($ext) -1) );

    $ext  = (empty($ext)) ? '.jpg' : $ext;
    $name = (empty($name)) ? mktime() : $name;
    while (file_exists( BPATH . 'files/images/' . $name.'.'.$ext ))
    {
        $name = $name . rand(100, 999);
    }
	$fname = strtolower( $name . '.' . $ext );
    return $fname;
}/** MakeOrigName */



function ValidNumberMod10($cardNumber)
{
    //Parameters
    //
    // cardNumber: credit card number
    //
    // return value:
    //    true if card is valid
    //    false if card is invalid

    $checkSum = 0;
    $cc = array(16);

    for ($i = 0; $i < strlen($cardNumber); $i++)
    {
        $cc[$i] = floor (substr($cardNumber,$i,1));
    }


    for ($i = (strlen($cardNumber) % 2); $i < strlen($cardNumber); $i+=2)
    {
        $a = $cc[$i] * 2;
        if ($a >= 10)
        {
            $a = "$a";
            $b = substr($a,0,1);
            $c = substr($a,1,1);
            $cc[$i] = floor($b) + floor($c);
        }
        else
        {
            $cc[$i] = $a;
        }
    }

    for ($i = 0; $i < strlen($cardNumber); $i++)
    {
        $checkSum += floor ($cc[$i]);
    }

    $validCc = (($checkSum % 10) == 0);

    return $validCc;

}/** ValidNumberMod10 */


function CardVerify($cardNumber,$cardType)
{
    //Parameters
    //
    // cardNumber: credit card number
    //
    // cardType: credit card type
    //    V - Visa
    //    M - Mastercard
    //    A - America Express
    //    D - Diners
    //
    // return value:
    //    true if card is valid
    //    false if card is invalid

    $arrayCard['V']  = array('name' => 'Visa', 'start' => '4', 'length' => '13,16');
    $arrayCard['M']  = array('name' => 'MasterCard', 'start' => '51,52,53,54,55', 'length' => '16');
    $arrayCard['A']  = array('name' => 'AmericanExpress', 'start' => '34,37', 'length' => '15');
    $arrayCard['D']  = array('name' => 'Diners', 'start' => '30,36,38', 'length' => '14');
    $arrayCard['DI'] = array('name' => 'DiscoverCard', 'start' => '6011', 'length' => '16');
    $arrayCard['E']  = array('name' => 'enRouteCard', 'start' => '2014,2149', 'length' => '15');
    $arrayCard['J']  = array('name' => 'JCBCard', 'start' => '3088,3096,3112,3158,3337,3528', 'length' => '16');

    /** check size */
    $checkSize = false;
    $arraySize = explode (",", $arrayCard[$cardType]['length']);
    foreach ($arraySize as $size)
    {
        if ($size == strlen($cardNumber))
        {
            $checkSize = true;
            break;
        }
    }

    /** check number */
    $checkNumber = false;
    if ($checkSize)
    {
        $arrayStart = explode (",", $arrayCard[$cardType]['start']);
        foreach ($arrayStart as $start)
        {
            if (substr($cardNumber,0,strlen($start)) == $start)
            {
                $checkNumber = true;
                break;
            }
        }
    }

    $r = (ValidNumberMod10($cardNumber) && $checkSize && $checkNumber) ? true : false;

    return $r;
}/** CardVerify */


function cardnum($string)
{
    $s = substr($string, 0, 4).'-XXXX-XXXX-'.substr($string, 12, 4);
    return $s;
}

/* Function to get file name return base name and extension as array */
function getFileInfo($fileName)
{
	$fileArray = explode('.', $fileName);
	$fileExt = array_pop($fileArray);
	$fileBaseName = implode('.', $fileArray);
	return array($fileBaseName, $fileExt);
}
/* Function to get file name with png extension */
function getPngFileName($fileName)
{
	list($fileBaseName, $fileExt) = getFileInfo($fileName);
	return $fileBaseName.'.png';
}

function getJpgFileName($fileName)
{
	list($fileBaseName, $fileExt) = getFileInfo($fileName);
	return $fileBaseName.'.jpg';
}

function seoUrl($string) 
{
    //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
    $string = strtolower(trim($string));
    //Strip any unwanted characters
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}  

function getHourString($duration)
{
	$hourSeconds = 60*60;
	$minuteSeconds = 60;
	$hour = 0;
	$minute = 0;
	$second = 0;
	if($duration / $hourSeconds >= 1){
		$hour = floor($duration / $hourSeconds);
		$totalMinutes = $duration % $hourSeconds;
	} else {
		$totalMinutes = $duration;
	}
	if($totalMinutes / $minuteSeconds >= 1){
		$minute = floor($totalMinutes / $minuteSeconds);
		$second = $totalMinutes % $minuteSeconds;
	} else {
		$second = $duration;
	}
	$durationString = sprintf('%02d:%02d:%02d',  $hour, $minute, $second);
	return $durationString;
}		

/**
 * Get real ip
 *
 * @return mixed false on error or string otherwise
 */
function real_ip()
{
    $REMOTE_ADDR          = @$_SERVER['REMOTE_ADDR'];
    $HTTP_X_FORWARDED_FOR = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $HTTP_X_FORWARDED     = @$_SERVER['HTTP_X_FORWARDED'];
    $HTTP_FORWARDED_FOR   = @$_SERVER['HTTP_FORWARDED_FOR'];
    $HTTP_FORWARDED       = @$_SERVER['HTTP_FORWARDED'];
    $HTTP_VIA             = @$_SERVER['HTTP_VIA'];
    $HTTP_X_COMING_FROM   = @$_SERVER['HTTP_VIA'];
    $HTTP_COMING_FROM     = @$_SERVER['HTTP_COMING_FROM'];

    $proxy_ip = '';

    if ($HTTP_X_FORWARDED_FOR)
        $proxy_ip = $HTTP_X_FORWARDED_FOR;
    else
    {
        if ($HTTP_X_FORWARDED)
            $proxy_ip = $HTTP_X_FORWARDED;
        else
        {
            if ($HTTP_FORWARDED_FOR)
                $proxy_ip = $HTTP_FORWARDED_FOR;
            else
            {
                if ($HTTP_FORWARDED)
                    $proxy_ip = $HTTP_FORWARDED;
                else
                {
                    if ($HTTP_VIA)
                        $proxy_ip = $HTTP_VIA;
                    else
                    {
                        if ($HTTP_X_COMING_FROM)
                            $proxy_ip = $HTTP_X_COMING_FROM;
                        else
                        {
                            if ($HTTP_COMING_FROM)
                                $proxy_ip = $HTTP_COMING_FROM;
                        }
                    }
                }
            }
        }
    }

    if (!$proxy_ip)
        return $REMOTE_ADDR;
    else
    {
        $matches = array();
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $proxy_ip, $matches))
            return $matches[0];
        else
            return $REMOTE_ADDR;
    }
}/** real_ip */


function ip_init()
{
    // define('IP', '72.233.44.162');return;

    if (!empty($_SESSION['saved_ip']))
        define('IP', $_SESSION['saved_ip']);
    else
    {
        define('IP', real_ip());
        $_SESSION['saved_ip'] = IP;
    }
}
/*
function getTimeArray($timeBreakInMin=30)
{
  $returnArray = array();
  $high = (24 * 60/$timeBreakInMin -1) * $timeBreakInMin * 60;
  $timeBreakSteps = range(0, $high, $timeBreakInMin*60);
  foreach ($timeBreakSteps as $time){
    $key = date('g:i a', $time);
    $returnArray[$key] = $key;
  }
  return $returnArray;
}*/

function getTimeValueArray($startTime = 135, $endTime = 300, $timeBreakInMin = 15)
{
  $returnArray = array();
  $timeBreakSteps = range($startTime*60, $endTime*60, $timeBreakInMin*60);
  foreach ($timeBreakSteps as $time){
    $key = $time/60;
	$value = date('g:i', $time);
    $returnArray[$key] = $value;
  }
  return $returnArray;
}

/* Function to check web scrawlers */
function crawlerDetect($userAgent)
{
    $crawlArray = array('Google','msnbot','Rambler','Yahoo','AbachoBOT','accoona','AcoiRobot','ASPSeek',
 'CrocCrawler','Dumbot','FAST-WebCrawler','GeonaBot','Gigabot','Lycos','MSRBOT','Scooter', 'AltaVista','IDBot', 
 'eStyle','Scrubby','facebook','Facebook', 'Twitterbot/1.0');
 
 $crawlers  = implode('|', array_values($crawlArray));

 $isCrawler = (preg_match("#$crawlers#", $userAgent) > 0);
 return $isCrawler;
}
/* Send Email function in common */
function sendEmail($fromEmail, $fromName, $toEamil, $toName, $subject, $message)
{
	require_once(BPATH.'libs/Phpmailer_v5.1/class.phpmailer.php');
	$gMail = new PHPMailer();
    $gMail->Host = SMTP_HOST; // sets the SMTP server
	$gMail->Port = SMTP_PORT; // set the SMTP port
	$gMail->Username = SMTP_EMAIL; // SMTP account username
	$gMail->Password = SMTP_PASSWORD; // SMTP account password
	$gMail->SMTPAuth = true;
    $gMail->IsSMTP(); 
    $gMail->AddReplyTo(REPLY_EMAIL);
	$gMail->SetFrom($fromEmail, $fromName);
	$gMail->AddAddress($toEamil, $toName);
	$gMail->WordWrap = 50;
	$gMail->IsHTML(true);
	$gMail->Subject = $subject;
	$gMail->Body = $message;
	$gMail->Send();
	return true;
}


/**
 * Extended exception
 */
class ExtException extends Exception
{

    protected $mErrArr;

    /**
     * Constructor
     *
     * @param array $errCodes array with error codes
     *
     * @return void
     */
    public function __construct($errCodes)
    {
        if (!is_array($errCodes))
            $errCodes = array((int) $errCodes);

        $this->mErrArr = $errCodes;

        parent::__construct('Extended exception. Please use method "GetCodes".');
    }

    public function GetCodes()
    {
        return $this->mErrArr;
    }
	
}
?>