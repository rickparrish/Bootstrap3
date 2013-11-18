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
        $XML = <<<XML
<?xml version='1.0'?>
<document>
  <ContactEmail></ContactEmail>
  <DisplayOtherThemes>false</DisplayOtherThemes>
  <InvertNavigationBar>false</InvertNavigationBar>
  <SelectedTheme>Default</SelectedTheme>
  <TrackingId></TrackingId>
</document>
XML;
        return simplexml_load_string($XML);
    }
}

function AddPageToNavigation_bootstrap($page, $currentpage, $pagesSorted, $level) {
    // Make sure there's both a menu and title attribute
    if ($page['menu'] == '') { $page['menu'] = $page['title']; }
    if ($page['title'] == '') { $page['title'] = $page['menu']; }

    // Check if the page has children
    $Children = getChildren($page['url']);
    if (count($Children) == 0) {
        // Just a regular link, no children
        $link = '<a href="' . find_url($page['url'], $page['parent']) . '" title="' . encode_quotes(cl($page['title'])) . '">' . strip_decode($page['menu']) . '</a>';
        $submenu = '';
    } else {
        // We have children, create a submenu
        $caret = ($level == 1) ? '<b class="caret"></b>' : '';
        $link = '<a href="' . find_url($page['url'], $page['parent']) . '" title="' . encode_quotes(cl($page['title'])) . '" class="dropdown-toggle" data-toggle="dropdown">' . strip_decode($page['menu']) . $caret . '</a>';

        $submenu = '<ul class="dropdown-menu">';

        foreach ($pagesSorted as $Child) {
            if ((in_array($Child['url'], $Children)) && ($Child['menuStatus'] == 'Y') && (($Child['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
              $submenu .= AddPageToNavigation_bootstrap($Child, $currentpage, $pagesSorted, $level + 1);
            }
        }

        $submenu .= '</ul>';
    }
                 
    // Check if we're handling the page the user is on (or if the submenu contained the page the user is on)
    if (($currentpage == $page['url']) || (stripos($submenu, "current active") !== false)) {
        $li_classes = "current active " . $page['parent'] . " " . $page['url'];
    } else {
        $li_classes = trim($page['parent'] . " " . $page['url']);
    }
    if (count($Children) > 0) { 
        if ($level == 1) {
            $li_classes .= " dropdown"; 
        } else {
            $li_classes .= " dropdown-submenu";
        }
    }
                 
    return '<li class="' . $li_classes . '">' . $link . $submenu . '</li>' . "\n";
}

function get_navigation_bootstrap($currentpage) {
    global $pagesArray, $USR;

    $menu = '';

    $pagesSorted = subval_sort($pagesArray, 'menuOrder');
    if (count($pagesSorted) != 0) {
        foreach ($pagesSorted as $page) {
            if ((!$page['parent']) && ($page['menuStatus'] == 'Y') && (($page['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
                // Append to the menu string
                $menu .= AddPageToNavigation_bootstrap($page, $currentpage, $pagesSorted, 1);
            }
        }
    }

    echo exec_filter('menuitems',$menu);
}
?>
