<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://Peacefulqode.com/
 * @since             1.0.0
 * @package           Woo_Categories_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       List  Categories Widget
 * Plugin URI:        http://list-categories-widget.com/
 * Description:       The Category Widget  is a very simple plugin to display the list of categories for any taxonomies type (WooCommerce Product Category, Blog Category, Project Category…etc) on your WordPress website.
 * Version:           1.0.0
 * Author:            Peacefulqode
 * Author URI:        http://Peacefulqode.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       list-categories-widget
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
define( 'WOO_CATEGORIES_WIDGET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-category-widget-activator.php
 */
function activate_woo_categories_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-category-widget-activator.php';
	Woo_Categories_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-category-widget-deactivator.php
 */
function deactivate_woo_categories_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-category-widget-deactivator.php';
	Woo_Categories_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_categories_widget' );
register_deactivation_hook( __FILE__, 'deactivate_woo_categories_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-category-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_categories_widget() {

	$plugin = new Woo_Categories_Widget();
	$plugin->run();

}
run_woo_categories_widget();
