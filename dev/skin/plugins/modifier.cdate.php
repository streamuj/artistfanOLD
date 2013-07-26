<?php
function smarty_modifier_cdate($string, $var = '')
{
	switch ($var) {
		case 'dweek':
			return ToUpper(date('D', strtotime($string)));
			break;
                case 'month':
			return date('M', strtotime($string));
			break;
                case 'mday':
			return date('j', strtotime($string));
			break;
                case 'age':
                        return floor((mktime()-strtotime($string))/(365*24*60*60));
                        break;
	}
}
?>