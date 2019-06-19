<?php
/**
 * Plugin's activation class
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
 * Plugin's activation class
 */
class Activate_Plugin {
	/**
	 * Code during plugin activation
	 *
	 * @since     1.0.0
	 * @access    public
	 * @param    Config $config    Config object.
	 */
	public static function init( Config $config ) {
		// phpcs:disable
		error_log( print_r( $config, TRUE ) );
		error_log( 'Activation Hook Working!' );
		// phpcs:enable
	}

}
