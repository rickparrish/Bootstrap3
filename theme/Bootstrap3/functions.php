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

function get_navigation_bootstrap($currentpage) {
    global $pagesArray, $USR;

    $menu = '';

    $pagesSorted = subval_sort($pagesArray, 'menuOrder');
    if (count($pagesSorted) != 0) {
        foreach ($pagesSorted as $page) {
            if ((!$page['parent']) && ($page['menuStatus'] == 'Y') && (($page['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
                // Check if we're handling the page the user is on
                if ($currentpage == $page['url']) {
                    $li_classes = "current active ". $page['parent'] ." ". $page['url'];
                } else {
                    $li_classes = trim($page['parent'] ." ". $page['url']);
                }

                // Make sure there's both a menu and title attribute
                if ($page['menu'] == '') { $page['menu'] = $page['title']; }
                if ($page['title'] == '') { $page['title'] = $page['menu']; }

                // Check if the page has children
                $Children = getChildren($page['url']);
                if (count($Children) != 0) {
                    // We have children, create a submenu
                    $li_classes .= " dropdown";

                    $link = '<a href="'. find_url($page['url'],$page['parent']) . '" title="'. encode_quotes(cl($page['title'])) .'" class="dropdown-toggle" data-toggle="dropdown">'.strip_decode($page['menu']).'<b class="caret"></b></a>';

                    $submenu = '<ul class="dropdown-menu">';

                    foreach ($pagesSorted as $Child) {
                        if ((in_array($Child['url'], $Children)) && ($Child['menuStatus'] == 'Y') && (($Child['private'] != 'Y') || ((isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'))))) {
                            // Check if we're handling the page the user is on
                            if ($currentpage == $Child['url']) {
                                $li_classes_child = "current active ". $Child['parent'] ." ". $Child['url'];
                                $li_classes .= " current active";
                            } else {
                                $li_classes_child = trim($Child['parent'] ." ". $Child['url']);
                            }

                            // Make sure there's both a menu and title attribute
                            if ($Child['menu'] == '') { $Child['menu'] = $Child['title']; }
                            if ($Child['title'] == '') { $Child['title'] = $Child['menu']; }

                            // Add to the sub-menu
                            $submenu .= '<li class="' . $li_classes_child . '"><a href="' . find_url($Child['url'], $Child['parent']) . '" title="' . encode_quotes(cl($Child['title'])) . '">' . strip_decode($Child['menu']) . '</a></li>';
                        }
                    }

                    $submenu .= '</ul>';
                } else {
                    // Just a regular link, no children
                    $link = '<a href="'. find_url($page['url'],$page['parent']) . '" title="'. encode_quotes(cl($page['title'])) .'">'.strip_decode($page['menu']).'</a>';
                    $submenu = '';
                }

                // Append to the menu string
                $menu .= '<li class="'. $li_classes .'">' . $link . $submenu . '</li>'."\n";
            }
        }
    }

    echo exec_filter('menuitems',$menu);
}
?>
