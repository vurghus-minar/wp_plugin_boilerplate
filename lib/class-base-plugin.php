<?php
/**
 * The base plugin class
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
 * The base plugin class
 */
class Base_Plugin {

	/**
	 * The configuration object for the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      object    $config    The configuration object for the plugin..
	 */
	protected $config;

	/**
	 * Class constructor.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @param    Config $config    Config object.
	 */
	protected function __construct( Config $config ) {

		$this->config = $config->get_config();

	}

	/**
	 * Determines whether config-plugin directory exists in theme or child theme directory.
	 *
	 * @since    1.0.0
	 * @access    protected
	 */
	protected function assets_override_directory_exists() {
		if ( file_exists( $this->config->override_dir ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since     1.0.0
	 * @access    protected
	 */
	protected function load_textdomain() {

		load_plugin_textdomain(
			$this->config->text_domain,
			false,
			$this->config->language
		);

	}

	/**
	 * Creates an admin notice.
	 *
	 * @since    1.0.0
	 * @access    protected
	 * @param    string  $message    The message to display. E.g. _e('My message!', 'text-domain').
	 * @param    string  $type    Type of notice (success, error, warning, info).
	 * @param    boolean $is_dismissible    Whether the notice can be closed.
	 */
	protected function create_admin_notice( $message, $type, $is_dismissible = true ) {
		$notice_type          = in_array( $type, [ 'error', 'success', 'info', 'warning' ], true ) ? $type : 'info';
		$is_dismissible_class = $is_dismissible ? 'is-dismissible' : '';
		$html                 = "<div class=\"notice notice-$notice_type" . ' ' . "$is_dismissible_class\"><p>$message</p></div>";
		return $html;
	}

}

