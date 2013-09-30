<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      contact.php
* @Package:   GetSimple
* @Action:    Bootstrap3 for GetSimple CMS
*
*****************************************************/

$ThemeSettings = Bootstrap3_Settings();

$Name = '';
$Email = '';
$Subject = '';
$Url = '';
$Body = '';

$HasErrorName = '';
$HasErrorEmail = '';
$HasErrorSubject = '';
$HasErrorBody = '';

$FormError = '';
$MailError = false;
$Success = false;

if (isset($_POST['cmdSendMessage'])) {
  $Name = $_POST['txtName'];
  $Email = $_POST['txtEmail'];
  $Subject = $_POST['txtSubject'];
  $Url = $_POST['txtUrl'];
  $Body = $_POST['txtBody'];
  
  if (empty($Name)) { 
    $HasErrorName = "has-error"; 
    $FormError .= '<li>Missing your name</li>';
  }
  if (!check_email_address($Email)) { 
    $HasErrorEmail = "has-error"; 
    $FormError .= '<li>Invalid email address</li>';
  }
  if (empty($Subject)) { 
    $HasErrorSubject = "has-error"; 
    $FormError .= '<li>Missing a subject line</li>';
  }
  if (empty($Body)) { 
    $HasErrorBody = "has-error"; 
    $FormError .= '<li>Missing the message body</li>';
  }
  
  if (empty($FormError)) {
    if (!empty($Url)) {
      $Subject = "(CONTACT_SPAM) " . $Subject;
      $Body = "Url: $Url\n\n" . $Body;
    }

    if (@mail($ThemeSettings->ContactEmail, $Subject, $Body, 'From: "' . str_replace('"', "'", $Name) . '" <' . $Email . '>')) {
      $Success = true;
      
      $Subject = '';
      $Url = '';
      $Body = '';
    } else {
      $MailError = true;
    }
  }
}
?>
<?php include('header.inc.php'); ?>

      <div class="row">
        <div class="col-md-8">
          
          <?php
            if (check_email_address($ThemeSettings->ContactEmail)) {
          ?>
              
              <div class="well">
                <form method="post" class="form-horizontal">
                  <fieldset>
                    <legend><?php get_page_title(); ?></legend>

                    <?php
                      if (!empty($FormError)) {
                    ?>
                    
                        <div class="alert alert-dismissable alert-danger">
                          <button data-dismiss="alert" class="close" type="button">x</button>
                          <strong>Oops!</strong> Looks like there's a problem with your submission, please fix it and try again:
                          <ul>
                            <?php echo $FormError; ?>
                          </ul>
                        </div>

                    <?php
                      } else if ($MailError) {
                    ?>
                    
                        <div class="alert alert-dismissable alert-danger">
                          <button data-dismiss="alert" class="close" type="button">x</button>
                          <strong>Oops!</strong> I wasn't able to send your message just now.  Please try again in a few minutes.
                        </div>
                        
                    <?php
                      } else if ($Success) {
                    ?>
                    
                        <div class="alert alert-dismissable alert-success">
                          <button data-dismiss="alert" class="close" type="button">x</button>
                          <strong>Success!</strong> Your message has been sent.
                        </div>
                        
                    <?php
                      }
                    ?>
                
                    <div><?php get_page_content(); ?></div>

                    <div class="form-group <?php echo $HasErrorName; ?>">
                      <label class="col-lg-2 control-label" for="txtName">Name</label>
                      <div class="col-lg-10">
                        <input type="text" id="txtName" name="txtName" class="form-control" value="<?php echo htmlentities($Name); ?>" placeholder="What's your name?" />
                      </div>
                    </div>

                    <div class="form-group <?php echo $HasErrorEmail; ?>">
                      <label class="col-lg-2 control-label" for="txtEmail">Email</label>
                      <div class="col-lg-10">
                        <input type="text" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo htmlentities($Email); ?>" placeholder="What's your email address?" />
                      </div>
                    </div>

                    <div class="form-group <?php echo $HasErrorSubject; ?>">
                      <label class="col-lg-2 control-label" for="txtSubject">Subject</label>
                      <div class="col-lg-10">
                        <input type="text" id="txtSubject" name="txtSubject" class="form-control" value="<?php echo htmlentities($Subject); ?>" placeholder="What's this about?" />
                      </div>
                    </div>

                    <div class="form-group" style="display: none;">
                      <label class="col-lg-2 control-label" for="txtUrl">Url</label>
                      <div class="col-lg-10">
                        <input type="text" id="txtUrl" name="txtUrl" class="form-control" value="<?php echo htmlentities($Url); ?>" placeholder="What url is this for?" />
                        <span class="help-block">NOTE: Leave this box BLANK!</span>
                      </div>
                    </div>

                    <div class="form-group <?php echo $HasErrorBody; ?>">
                      <label class="col-lg-2 control-label" for="txtBody">Body</label>
                      <div class="col-lg-10">
                        <textarea id="txtBody" name="txtBody" class="form-control" rows="10" placeholder="Would you care to elaborate?"><?php echo htmlentities($Body); ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" id="cmdSendMessage" name="cmdSendMessage" class="btn btn-primary">Send Message</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
                
          <?php
            } else {
          ?>
          
              <div class="alert alert-danger">
                <strong>Oops!</strong> The site admin hasn't configured the contact form yet!
              </div> 
              
          <?php
            }
          ?>
            
        </div>
        
        <div class="col-md-4">
          <?php get_component('sidebar'); ?>
        </div>
      </div>

<?php include('footer.inc.php'); ?>
