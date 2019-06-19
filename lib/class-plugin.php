<?php
/**
 * The plugin class
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM;

use \AM\Settings\Example_Settings as Example_Settings;

/**
 * Prevent direct access to file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The plugin class
 */
class Plugin extends Base_Plugin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object   $instance   A single instance of this class.
	 */
	private static $instance;

	/**
	 * Class constructor.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    Config $config    Config object.
	 */
	private function __construct( Config $config ) {

		parent::__construct( $config );

		// DONE Initialize settings pages.
		$this->add_plugin_settings_pages( $config );
		// TODO Initialize endpoints.
		// TODO Add action hooks.
		// TODO Add filters.
	}

	/**
	 * Registers the plugin and returns a single instance of this class
	 *
	 * @since     1.0.0
	 * @access    public
	 * @param    Config $config    Config object.
	 */
	public static function init( Config $config ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $config );
		}
	}

	/**
	 * Loads plugin's backend styles.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_admin_styles() {

	}

	/**
	 * Loads plugin's backend scripts.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_admin_scripts() {

	}

	/**
	 * Loads plugin's frontend styles.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_public_styles() {

	}

	/**
	 * Loads plugin's frontend scripts.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function load_public_scripts() {

	}

	/**
	 * Adds plugin's settings pages.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    Config $config    Config object.
	 */
	public function add_plugin_settings_pages( Config $config ) {
		\AM\Settings\Example_Settings::init( $config );
	}

}

