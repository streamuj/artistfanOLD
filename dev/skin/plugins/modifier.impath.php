<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.phonecode.php
 * Type:     function
 * Name:     make phone
 * Purpose:  output phone code (use session array)
 * -------------------------------------------------------------
 */
function smarty_modifier_impath($user_id)
{
    return MakeDirName($user_id);

}
?>