<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.htag.com.au
 * @since      1.0.2
 *
 * @package    Seip
 * @subpackage Seip/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.2
 * @package    Seip
 * @subpackage Seip/includes
 * @author     HtAG Holdings <contact@htag.com.au>
 */
class Seip {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      Seip_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.2
	 */
	public function __construct() {
		if ( defined( 'SEIP_VERSION' ) ) {
			$this->version = SEIP_VERSION;
		} else {
			$this->version = '1.0.2';
		}
		$this->plugin_name = 'seip';
		include_once(ABSPATH . 'wp-includes/pluggable.php');

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Seip_Loader. Orchestrates the hooks of the plugin.
	 * - Seip_i18n. Defines internationalization functionality.
	 * - Seip_Admin. Defines all hooks for the admin area.
	 * - Seip_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-seip-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-seip-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-seip-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-seip-public.php';

		$this->loader = new Seip_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Seip_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Seip_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Seip_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_styles', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
		
		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );
		
		// Save/Update plugin options
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');




	}
	

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Seip_Public( $this->get_plugin_name(), $this->get_version() );

		#$this->loader->add_action( 'wp_enqueue_styles', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		$url      = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url_path = parse_url( $url, PHP_URL_PATH );
		$slug = pathinfo( $url_path, PATHINFO_BASENAME );
		
		function containsWord($str, $word){
			return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
		}
        //TODO: Add settings page to list all slugs on which popup should not be shown
		if(! is_user_logged_in() && !containsWord($slug,'account' )){
		add_action( 'wp_footer', 'inintPopup',100);
		}
		
		function inintPopup() {
			$options = get_option('seip'); 
			
		?>
		<script type="text/javascript">
			bioEp.init({
				html: '<div>' +
				    '<div style="top: 0;left: 0;position: absolute;width: 100%;height: 7px;background-color: <?php echo $options['popup_colour_scheme'] ?>"></div><br><br>'+
					'<h3><?php echo $options['cta_text_top'] ?></h3>' +
					'<p style="padding:20px"><?php echo $options['cta_text_bottom'] ?></p>' +
					'<a href="<?php echo $options['cta_url'] ?>" class="bio_btn"><?php echo $options['cta_text_button'] ?></a><br><br>' +
					'<a href="https://www.htag.com.au" target="_blank"><img src="<?php echo plugins_url('img/htag-property-market-forecasts.png', __FILE__); ?>" alt="Real Estate Market Forecasts"/></a></div>',
				css: '#bio_ep {width: 520px; height: 260px;  color: #333; background-color: #fafafa; text-align: center;}' +
					'.bio_btn {display: inline-block; margin: 1px 0 0 0; padding: 10px; color: #fff; font-size: 16px; font-weight: 600; background-color: <?php echo $options['popup_colour_scheme'] ?>; border: 1px solid <?php echo $options['popup_colour_scheme'] ?>; cursor: pointer; -webkit-appearance: none; -moz-appearance: none; border-radius: 0; text-decoration: none;}',
				cookieExp: <?php echo $options['cookie_expiry'] ?>,
				showOnDelay: <?php echo $options['time_delay_popup']==1?'true':'false' ?>, 
				showOncePerSession: <?php echo $options['once_per_session']==1?'true':'false' ?>,
				delay: <?php echo $options['delay_seconds'] ?> 
			});
		</script>
		<?php
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.2
	 * @return    Seip_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		
		return $this->version;
	}
	

}
