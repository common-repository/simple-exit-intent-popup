<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.htag.com.au
 * @since      1.0.2
 *
 * @package    Seip
 * @subpackage Seip/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form method="post" name="cleanup_options" action="options.php">

    <?php
    //Grab all options
        $options = get_option($this->plugin_name);

        $time_delay_popup = $options['time_delay_popup'];
        $once_per_session = $options['once_per_session'];
        $cookie_expiry = $options['cookie_expiry'];
		$delay_seconds = $options['delay_seconds'];
		$popup_colour_scheme = $options['popup_colour_scheme'];
		$cta_text_top = $options['cta_text_top'];
		$cta_text_bottom = $options['cta_text_bottom'];
		$cta_text_button= $options['cta_text_button'];
		$cta_url= $options['cta_url'];

    ?>

    <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
    ?>
	<br>
	
	<h2 class="title">Behavior</h2>
	<hr>
	<table class="form-table">
	    <colgroup>
		   <col>
		   <col width="30">
		   <col>
		</colgroup>
		<tbody>
         
        <tr valign="top">
        <th scope="row">Delay (in seconds)</th>
        <td><input type="text" style="width: 30px;" id="<?php echo $this->plugin_name;?>-delay_seconds" name="<?php echo $this->plugin_name;?>[delay_seconds]" value="<?php if(!empty($delay_seconds)) {echo $delay_seconds;} else {echo '5';}?>"/></td>
		<td>The time, in seconds, until the popup activates and begins watching for exit intent. If mode is set to Time Delay Popup, this will be the time until the popup shows.</td>
        </tr>

        <tr valign="top">
        <th scope="row">Time Delay Popup</th>
        <td><input type="checkbox" id="<?php echo $this->plugin_name;?>-time_delay_popup" name="<?php echo $this->plugin_name;?>[time_delay_popup]" value="1" <?php checked( $time_delay_popup, 1 ); ?> /></td>
		<td>If checked, the popup will show after the delay option time. If unchecked, popup will show when a visitor moves their cursor above the document window, showing exit intent. Leave this unchecked for Exit Intent behavior.</td>
        </tr>
		
        <tr valign="top">
        <th scope="row">Show once per session</th>
        <td><input type="checkbox" id="<?php echo $this->plugin_name;?>-once_per_session" name="<?php echo $this->plugin_name;?>[once_per_session]" value="1" <?php checked( $once_per_session, 1 ); ?>  /></td>
        <td>If checked, the popup will only show once per browser session. If false and Cookie Expiry is set to 0, the popup will show multiple times in a single browser session.</td>
		</tr>
		</tbody>
    </table>

	<br>
	<h2 class="title">Cookie Controls</h2>
	<hr>
	<table class="form-table">
	    <colgroup>
		   <col>
		   <col width="30">
		   <col>
		</colgroup>
		<tbody>
        <tr valign="top">
        <th scope="row">Cookie Expiry (in days)</th>
        <td><input type="text" style="width: 30px;" id="<?php echo $this->plugin_name;?>-cookie_expiry" name="<?php echo $this->plugin_name;?>[cookie_expiry]" value="<?php if(!empty($cookie_expiry)) {echo $cookie_expiry;} else {echo '0';}?>"/></td>
		<td>The number of days to set the cookie for. A cookie is used to track if the popup has already been shown to a specific visitor. If the popup has been shown, it will not show again until the cookie expires. A value of 0 will always show the popup.</td>
        </tr>
        
		</tbody>
    </table>

	<br>
	<h2 class="title">Appearance</h2>
	<hr>
	<table class="form-table">
	    <colgroup>
		   <col>
		   <col width="80">
		   <col>
		</colgroup>
		<tbody>
        <tr valign="top">
        <th scope="row">Colour Scheme</th>
        <td><input type="text" class="<?php echo $this->plugin_name;?>-color-picker" id="<?php echo $this->plugin_name;?>-popup_colour_scheme" name="<?php echo $this->plugin_name;?>[popup_colour_scheme]"  value="<?php if(!empty($popup_colour_scheme)) {echo $popup_colour_scheme;} else {echo '#ffc107';}?>"  /></td>
		<td>Set this to HEX value of the colour you want.</td>
        </tr>      
		</tbody>
    </table>

	<br>
	<h2 class="title">Popup wording</h2>
	<hr>
	<table class="form-table">
	    <colgroup>
		   <col>
		   <col width="250px">
		   <col>
		</colgroup>
		<tbody>
        <tr valign="top">
        <th scope="row">Main CTA</th>
        <td><input type="text" style="width: 400px;" id="<?php echo $this->plugin_name;?>-cta_text_top" name="<?php echo $this->plugin_name;?>[cta_text_top]" value="<?php if(!empty($cta_text_top)) {echo $cta_text_top;} else {echo 'Join our site today!';}?>"/></td>		<td>First header line of text shown on the popup.</td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Additional CTA</th>
        <td><input type="text" style="width: 400px;" id="<?php echo $this->plugin_name;?>-cta_text_bottom" name="<?php echo $this->plugin_name;?>[cta_text_bottom]" value="<?php if(!empty($cta_text_bottom)) {echo $cta_text_bottom;} else {echo 'This message will only be shown once. Don\'t miss out!';}?>"/></td>
		<td>Second line of text shown on the popup.</td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Button Text</th>
        <td><input type="text" style="width: 400px;" id="<?php echo $this->plugin_name;?>-cta_text_button" name="<?php echo $this->plugin_name;?>[cta_text_button]" value="<?php if(!empty($cta_text_button)) {echo $cta_text_button;} else {echo 'Sign Up Now';}?>"/></td>        <td>Text shown on the button.</td>
		</tr>
		
		<tr valign="top">
        <th scope="row">Button URL</th>
        <td><input type="url" style="width: 400px;" id="<?php echo $this->plugin_name;?>-cta_url" name="<?php echo $this->plugin_name;?>[cta_url]" value="<?php if(!empty($cta_url)) {echo $cta_url;} else {echo 'https://www.htag.com.au/account/';}?>"/></td>        <td>Link that will open on button click.</td>
		</tr>
		</tbody>
    </table>
	<hr>
    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    </form>

</div>
