<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://Peacefulqode.com/
 * @since      1.0.0
 *
 * @package    Woo_Categories_Widget
 * @subpackage Woo_Categories_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woo_Categories_Widget
 * @subpackage Woo_Categories_Widget/includes
 * @author     Peacefulqode <peacefulthemes@gmail.com>
 */
class Woo_Categories_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'category-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
