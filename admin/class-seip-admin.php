<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.htag.com.au
 * @since      1.0.2
 *
 * @package    Seip
 * @subpackage Seip/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Seip
 * @subpackage Seip/admin
 * @author     HtAG Holdings <contact@htag.com.au>
 */
class Seip_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.2
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
         if ( 'settings_page_seip' == get_current_screen() -> id ) {
             // CSS stylesheet for Color Picker
             wp_enqueue_style( 'wp-color-picker' );            
             wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/seip-admin.css', array( 'wp-color-picker' ), $this->version, 'all' );
         }

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        if ( 'settings_page_seip' == get_current_screen() -> id ) {
            wp_enqueue_media();   
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/seip-admin.js', array( 'jquery', 'wp-color-picker', 'media-upload' ), $this->version, false );         
        }

	}
	
	
	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.2
	 */

	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		add_options_page( 'Simple Exit Intent Popup >> Config Page', 'Simple Exit Intent Popup', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
		);
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.2
	 */

	public function add_action_links( $links ) {
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
	   $settings_link = array(
		'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.2
	 */

	public function display_plugin_setup_page() {
		include_once( 'partials/seip-admin-display.php' );
	}
	
	 public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	 }
	 
	public function validate($input) {    
		
		$valid = array();

		$valid['time_delay_popup'] = (isset($input['time_delay_popup']) && !empty($input['time_delay_popup'])) ? 1: 0;
		$valid['once_per_session'] = (isset($input['once_per_session']) && !empty($input['once_per_session'])) ? 1: 0;
		$valid['delay_seconds'] = sanitize_text_field(intval($input['delay_seconds']));
		$valid['cookie_expiry'] = sanitize_text_field(intval($input['cookie_expiry']));
		$valid['cta_text_top'] = esc_js($input['cta_text_top']);
		$valid['cta_text_bottom'] = esc_js($input['cta_text_bottom']);
		$valid['cta_text_button'] = esc_js($input['cta_text_button']);
		$valid['cta_url'] = esc_url($input['cta_url']);
        $valid['popup_colour_scheme'] = (isset($input['popup_colour_scheme']) && !empty($input['popup_colour_scheme'])) ? sanitize_text_field($input['popup_colour_scheme']) : '';

        if ( !empty($valid['popup_colour_scheme']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['popup_colour_scheme']  ) ) { // if user insert a HEX color with #
            add_settings_error(
                    'popup_colour_scheme',                     // Setting title
                    'popup_colour_scheme_texterror',            // Error ID
                    'Please enter a valid hex value color',     // Error message
                    'error'                         // Type of message
            );
        }

		return $valid;
	 }	
	 
	

}
