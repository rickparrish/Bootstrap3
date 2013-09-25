<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      functions.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/

/**
 * Bootstrap3 Settings
 *
 * This defines variables based on the theme plugin's settings
 *
 * @return bool
 */
function Bootstrap3_Settings() {
    $file = GSDATAOTHERPATH . 'Bootstrap3Settings.xml';
    if (file_exists($file)) {
        return getXML($file);
    } else {
        return false;
    }
}
?>
