<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      template.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/
?>
<?php include('header.inc.php'); ?>

      <div class="row">
        <div class="col-md-8">
          <div class="page-header">
            <h1><?php get_page_title(); ?></h1>
          </div>
          <?php get_page_content(); ?>
        </div>
        
        <div class="col-md-4">
          <?php get_component('sidebar'); ?>
        </div>
      </div>

<?php include('footer.inc.php'); ?>
