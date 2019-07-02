<?php
/**
 * Plugin's deactivation class
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM;

/**
 * Prevent direct access to file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin's deactivation class
 */
class Deactivate_Plugin {

	/**
	 * Code during plugin deactivation
	 *
	 * @since     1.0.0
	 * @access    public
	 * @param    Config $config    Config object.
	 */
	public static function init( Config $config ) {
		// phpcs:disable
		error_log( print_r( $config, TRUE ) );
		error_log('Deactivation Hook Working!' );
		// phpcs:enable
		delete_option( 'am_plugin_example_settings' );
	}

}
