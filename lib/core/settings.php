<?php // phpcs:ignore
/**
 * Plugin's settings abstract class
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM\Core;

use \AM\Config as Config;

/**
 * Plugin's settings abstract class
 */
abstract class AbstractSettings {


	/**
	 * The resulting settings page's hook_suffix
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      mixed    $settings_page_hook_suffix    The resulting settings page's hook_suffix. False or String.
	 */
	protected $settings_page_hook_suffix = null;

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
	 * Enqueue settings scripts
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	abstract public function enqueue_settings_scripts();

	/**
	 * Enqueue settings styles
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	abstract public function enqueue_settings_styles();

	/**
	 * Add settings menu in admin menu
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	abstract public function create_settings_page();

	/**
	 * Add the settings page html
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	abstract public function create_settings_page_content();
}
