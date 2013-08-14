<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.ispast.php
 * Type:     function
 * Name:     check if date is past
 * -------------------------------------------------------------
 */
function smarty_modifier_ispast($string)
{
    $time = strtotime($string) + 12*3600; //time of start event + 12 hour
    if($time <= mktime())
    {
        return true;
    }
    return false;
}
?>