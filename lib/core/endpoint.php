<?php // phpcs:ignore
/**
 * Plugin's endpoint abstract class
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM\Core;

use \AM\Config as Config;

/**
 * Plugin's endpoint abstract class
 */
abstract class AbstractEndpoint {

	/**
	 * Alias for GET transport method.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */
	protected $readable = 'GET';

	/**
	 * Alias for POST transport method.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */
	protected $creatable = 'POST';

	/**
	 * Alias for POST, PUT, PATCH transport methods together.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */
	protected $editable = 'POST, PUT, PATCH';

	/**
	 * Alias for DELETE transport method.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string
	 */
	protected $deletable = 'DELETE';

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
	 * Register all routes.
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	abstract public function register_routes();


}
