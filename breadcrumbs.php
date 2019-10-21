<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Breadcrumbs
 *
 * @wordpress-plugin
 * Plugin Name:       Breadcrumbs
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       Custom bread crumbs for your site.
 * Version:           1.0.0
 * Author:            Hadal3000
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Breadcrumbs
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Breadcrumbs_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_Breadcrumbs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-breadcrumbs-activator.php';
	Breadcrumbs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_Breadcrumbs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-breadcrumbs-deactivator.php';
	Breadcrumbs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Breadcrumbs' );
register_deactivation_hook( __FILE__, 'deactivate_Breadcrumbs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-breadcrumbs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Breadcrumbs() {

	$plugin = new Breadcrumbs();
	$plugin->run();

}
run_Breadcrumbs();


//on page plugins add setting link
add_filter( 'plugin_action_links', 'settings_link' ,10, 4 );

function settings_link( $actions, $plugin_file ){
	var_dump(strpos( $plugin_file, basename(__FILE__) ));
	var_dump(basename(__FILE__) );
	var_dump($plugin_file );
	if( false === strpos( $plugin_file, basename(__FILE__) ) )
		return $actions;

	$settings_link = '<a href="options-general.php?page='. basename(dirname(__FILE__)).'">'.__("Settings").'</a>';
	array_unshift( $actions, $settings_link );
	return $actions;
}
