<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      header.inc.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/

# Get this theme's settings based on what was entered within its plugin.
# This function is in functions.php
$ThemeSettings = Bootstrap3_Settings();
$SelectedTheme = $ThemeSettings->SelectedTheme;
if (!$SelectedTheme) $SelectedTheme = "Default";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php get_theme_url(); ?>/ico/favicon.png">

    <title><?php get_page_clean_title(); ?> - <?php get_site_name(); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php get_theme_url(); ?>/css/bootstrap_<?php echo $SelectedTheme; ?>.min.css" rel="stylesheet" class="SelectedTheme">

    <!-- Custom styles for this template -->
    <link href="<?php get_theme_url(); ?>/css/Bootstrap3.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php get_theme_url(); ?>/js/html5shiv.js"></script>
      <script src="<?php get_theme_url(); ?>/js/respond.min.js"></script>
    <![endif]-->

    <?php get_header(); ?>
</head>
  <body id="<?php get_page_slug(); ?>">
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php get_site_url(); ?>"><?php get_site_name(); ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if (function_exists('get_navigation_bootstrap')) { get_navigation_bootstrap(return_page_slug()); } else { get_navigation(return_page_slug()); } ?>
          </ul>
          <?php
            if ($ThemeSettings->DisplayOtherThemes == "true") {
              $ThemeUrl = get_theme_url(false);

              function AddThemeMenuItem($ThemeName) {
                global $ThemeUrl;
                echo '<li><a href="#" rel="' . $ThemeUrl . '/css/bootstrap_' . $ThemeName . '.min.css">' . $ThemeName . '</a></li>';
              }
            
              echo '<ul class="nav navbar-nav navbar-right">';
              echo '  <li class="dropdown">';
              echo '    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Other Themes <b class="caret"></b></a>';
              echo '    <ul class="dropdown-menu" id="ThemesMenu">';
              AddThemeMenuItem('Default');
              echo '<li class="divider"></li>';
              AddThemeMenuItem('Amelia');
              AddThemeMenuItem('Cerulean');
              AddThemeMenuItem('Cosmo');
              AddThemeMenuItem('Cyborg');
              AddThemeMenuItem('Flatly');
              AddThemeMenuItem('Journal');
              AddThemeMenuItem('Readable');
              AddThemeMenuItem('Simplex');
              AddThemeMenuItem('Slate');
              AddThemeMenuItem('Spacelab');
              AddThemeMenuItem('United');
              echo '    </ul>';
              echo '  </li>';
              echo '</ul>';
            }
          ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
