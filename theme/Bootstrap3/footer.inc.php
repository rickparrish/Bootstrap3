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
              HighlightTheme($.cookie("css"));
            }
            $("#ThemesMenu li a").click(function() {
              $("link.SelectedTheme").attr("href", $(this).attr('rel'));
              $.cookie("css", $(this).attr('rel'), {expires: 365, path: '/'});
              HighlightTheme($.cookie("css"));
              return false;
            });
          });
          
          function HighlightTheme(url) {
            $("#ThemesMenu li.current").attr("class", "");
            $("#ThemesMenu li a[rel='" + url + "']").parent().attr("class", "current active");
          }
        </script>
    <?php
      }
    ?>

    <?php get_footer(); ?>
  </body>
</html>