<?php

/**
 * @link              https://www.htag.com.au
 * @since             1.0.3
 * @package           Seip
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Exit Intent Popup
 * Plugin URI:        https://github.com/TerryJey/sei
 * Description:       Lighwheight exit intent / time delay popup that entices site visitors to take an action.
 * Version:           1.0.3
 * Author:            HtAG Holdings
 * Author URI:        https://www.htag.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       seip
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEIP_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-seip-activator.php
 */
function activate_seip() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seip-activator.php';
	Seip_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-seip-deactivator.php
 */
function deactivate_seip() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seip-deactivator.php';
	Seip_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_seip' );
register_deactivation_hook( __FILE__, 'deactivate_seip' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-seip.php';

/**
 *
 * @since    1.0.2
 */
function run_seip() {

	$plugin = new Seip();
	$plugin->run();

}
run_seip();
