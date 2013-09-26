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
            // If user selected a theme, load it
            if ($.cookie("theme")) {
              $("link.SelectedTheme").attr("href", $.cookie("theme"));
              HighlightTheme($.cookie("theme"));
            }

            // If user selected a navbar inversion, load it
            if ($.cookie("invert")) {
              if ($.cookie("invert") == "true") {
                $('#chkInvertNavigationBar').attr('checked','checked');
                SetInvert(true);
              } else {
                $('#chkInvertNavigationBar').removeAttr('checked');
                SetInvert(false);
              }
            }

            // User is selecting a new theme
            $("#ThemesMenu li a").click(function() {
              $("link.SelectedTheme").attr("href", $(this).attr('rel'));
              $.cookie("theme", $(this).attr('rel'), {expires: 365, path: '/'});
              HighlightTheme($.cookie("theme"));
              return false;
            });

            // User is selecting a new navbar inversion
            $("#chkInvertNavigationBar").change(function() {
              if (this.checked) {
                $.cookie("invert", "true", {expires: 365, path: '/'});
                SetInvert(true);
              } else {
                $.cookie("invert", "false", {expires: 365, path: '/'});
                SetInvert(false);
              }
            });

            // Prevent the menu from disappearing when selecting a navbar inversion
            $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
              e.stopPropagation();
            });
          });
          
          function HighlightTheme(url) {
            $("#ThemesMenu li.current").attr("class", "");
            $("#ThemesMenu li a[rel='" + url + "']").parent().attr("class", "current active");
          }
          
          function SetInvert(invert) {
            if (invert) {
              $("#NavBar").removeClass("navbar-default").addClass("navbar-inverse");
            } else {
              $("#NavBar").addClass("navbar-default").removeClass("navbar-inverse");
            }
          }
        </script>
    <?php
      }
    ?>

    <?php get_footer(); ?>
  </body>
</html>