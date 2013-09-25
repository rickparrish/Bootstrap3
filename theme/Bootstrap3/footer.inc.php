<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      footer.inc.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/
?>
      <hr>

      <footer>
        <p>Bootstrap3 for GetSimple CMS by <a href="http://www.rickparrish.ca">Rick Parrish</a> of <a href="http://www.randm.ca">R&amp;M Software</a> - <?php get_site_credits(); ?></p>
      </footer>

    </div> <!-- /container -->
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php get_theme_url(); ?>/js/jquery-1.10.2.min.js"></script>
    <script src="<?php get_theme_url(); ?>/js/jquery.cookie.js"></script>
    <script src="<?php get_theme_url(); ?>/js/bootstrap.min.js"></script>

    <?php
      if ($ThemeSettings->DisplayOtherThemes == "true") {
    ?>
        <script type="text/javascript">
          $(document).ready(function() { 
            if($.cookie("css")) {
              $("link.SelectedTheme").attr("href", $.cookie("css"));
            }
            $(document).on('click', '#ThemesMenu li a', function() { 
              $("link.SelectedTheme").attr("href", $(this).attr('rel'));
              $.cookie("css", $(this).attr('rel'), {expires: 365, path: '/'});
              return false;
            });
            
            $("ul.nav").append(
              '<li class="dropdown">' +
              '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Other Themes <b class="caret"></b></a>' +
              '<ul class="dropdown-menu" id="ThemesMenu">' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Default.min.css">Default</a></li>' +
              '<li class="divider"></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Amelia.min.css">Amelia</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Cerulean.min.css">Cerulean</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Cosmo.min.css">Cosmo</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Cyborg.min.css">Cyborg</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Flatly.min.css">Flatly</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Journal.min.css">Journal</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Readable.min.css">Readable</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Simplex.min.css">Simplex</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Slate.min.css">Slate</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_Spacelab.min.css">Spacelab</a></li>' +
              '<li><a href="#" rel="<?php get_theme_url(); ?>/css/bootstrap_United.min.css">United</a></li>' +
              '</ul>' +
              '</li>');
          });
        </script>
    <?php
      }
    ?>

    <?php get_footer(); ?>
  </body>
</html>