<?php
/*
 * Plugin Name: Bootstrap3 Theme Settings
 * Description: Settings for the GetSimple Theme: Bootstrap3
 * Version: 1.0
 * Author: Rick Parrish
 * Author URI: http://www.rickparrish.ca
*/

# get correct id for plugin
$PluginId=basename(__FILE__, ".php");
$SettingsFile=GSDATAOTHERPATH . 'Bootstrap3Settings.xml';

# add in this plugin's language file
i18n_merge($PluginId) || i18n_merge($PluginId, 'en_US');

# register plugin
register_plugin(
  $PluginId,                                # ID of plugin, should be filename minus php
  i18n_r($PluginId . '/BOOTSTRAP3_TITLE'),  # Title of plugin
  '1.0',                                    # Version of plugin
  'Rick Parrish',                           # Author of plugin
  'http://www.rickparrish.ca',              # Author URL
  i18n_r($PluginId . '/BOOTSTRAP3_DESC'),   # Plugin Description
  'theme',                                  # Page type of plugin
  'DisplayForm'                             # Function that displays content
);

# hooks
# enable side menu if theme is bootstrap3 or on theme page and enabling bootstrap3, handle plugin exec before global is set
if ($TEMPLATE == "Bootstrap3" || (get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] == 'Bootstrap3')) {
  if (!($TEMPLATE == "Bootstrap3" && get_filename_id() == 'theme' && isset($_POST['template']) && $_POST['template'] != 'Bootstrap3')) {
    add_action('theme-sidebar', 'createSideMenu', array($PluginId, i18n_r($PluginId . '/BOOTSTRAP3_TITLE'))); 
  }
}

$Themes = array(
  'Default',
  'Amelia',
  'Cerulean',
  'Cosmo',
  'Cyborg',
  'Flatly',
  'Journal',
  'Readable',
  'Simplex',
  'Slate',
  'Spacelab',
  'United'
);

# get XML data
if (file_exists($SettingsFile)) {
  $Settings = getXML($SettingsFile);
}

function DisplayForm() {
  global  $PluginId, $Settings, $SettingsFile, $Themes;

  // init error/success messages
  $ErrorMessage = null;
  $SuccessMessage = null;
  
  // submitted form
  if (isset($_POST['cmdSubmit'])) {    
    $xml = @new SimpleXMLElement('<item></item>');
    $xml->addChild('SelectedTheme', $_POST['cboTheme']);
    $xml->addChild('DisplayOtherThemes', $_POST['chkDisplayOtherThemes']);
    if (!$xml->asXML($SettingsFile)) {
      $ErrorMessage = i18n_r('CHMOD_ERROR');
    } else {
      $Settings = getXML($SettingsFile);
      $SuccessMessage = i18n_r('SETTINGS_UPDATED');
    }
  }
  ?>
  
  <h3><?php i18n($PluginId . '/BOOTSTRAP3_TITLE'); ?></h3>
  
  <?php 
    if($SuccessMessage) { 
      echo '<p style="color:#669933;"><b>'. $SuccessMessage .'</b></p>';
    } 
    if($ErrorMessage) { 
      echo '<p style="color:#cc0000;"><b>'. $ErrorMessage .'</b></p>';
    }
  ?>
  
  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <p>
      <label for="cboTheme"><?php i18n($PluginId . '/THEME_LABEL'); ?></label>
      <select name="cboTheme" id="cboTheme">
        <?php
          foreach ($Themes as $Theme) {
            $Selected = ($Settings->SelectedTheme == $Theme) ? ' selected="selected"' : '';
            echo "<option value=\"$Theme\"$Selected>$Theme</option>";
          }
        ?>
      </select>
    </p>
    
    <p>
      <label for="chkDisplayOtherThemes"><?php i18n($PluginId.'/DISPLAY_OTHER_THEMES_LABEL'); ?></label>
      <input type="checkbox" id="chkDisplayOtherThemes" name="chkDisplayOtherThemes" value="true"<?php echo $Settings->DisplayOtherThemes == "true" ? 'checked="checked"' : '' ?>> 
    </p>
        
    <p>
      <input type="submit" id="cmdSubmit" name="cmdSubmit" class="submit" value="<?php i18n('BTN_SAVESETTINGS'); ?>" />
    </p>
  </form>
  
<?php
}
?>
