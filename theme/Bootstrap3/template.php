<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      template.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/

# Get this theme's settings based on what was entered within its plugin.
# This function is in functions.php
$ThemeSettings = Bootstrap3_Settings();
if ($ThemeSettings->DefaultTemplate) {
  include($ThemeSettings->DefaultTemplate);
} else {
  include('content-md-8_sidebar-md-4.php');
}
?>
