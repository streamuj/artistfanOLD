<?php
function smarty_modifier_mdate($string, $var = 0)
{
	switch ($var) {
		case '1':
			return date('m/d/Y', strtotime($string));
			break;
                case '2':
			return date('l M j', strtotime($string));
			break;
                case '3':
			return date('h:i A', strtotime($string));
			break;
		case '4':
                        return date('m/d/Y g:i A', $string);
			break;
                case '5':
			return date('F j, Y', strtotime($string));
			break;
		default:
			return date('m/d/Y g:i A', strtotime($string));
			break;
	}
}
?>