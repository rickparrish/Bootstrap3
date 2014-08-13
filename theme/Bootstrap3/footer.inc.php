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
    <script src="<?php get_theme_url(); ?>/js/jquery.tablesorter.min.js"></script>
    <script src="<?php get_theme_url(); ?>/js/bootstrap.min.js"></script>
    <script>
      if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style")
        msViewportStyle.appendChild(
          document.createTextNode(
            "@-ms-viewport{width:auto!important}"
          )
        )
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle)
      }
    </script>

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
            
            // Allow sub menus
            // From http://stackoverflow.com/a/19076934/342378
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
              // Avoid following the href location when clicking
              event.preventDefault(); 
              // Avoid having the menu to close when clicking
              event.stopPropagation(); 
              // Store old class
              var OldClass = $(this).parent().attr("class");
              // Close all menus
              $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
              // Restore old class
              $(this).parent().attr("class", OldClass);
              // Toggle the class to show or hide it
              $(this).parent().toggleClass('open');

              var menu = $(this).parent().find("ul");
              var menupos = $(menu).offset();

              if (menupos.left + menu.width() > $(window).width()) {
                  var newpos = -$(menu).width();
                  menu.css({ left: newpos });    
              } else {
                  var newpos = $(this).parent().width();
                  menu.css({ left: newpos });
              }
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

      if ($ThemeSettings->TrackingId != "") {
    ?>

        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '<?php echo $ThemeSettings->TrackingId; ?>']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
    
    <?php
      }
    ?>

    <?php get_footer(); ?>
  </body>
</html>