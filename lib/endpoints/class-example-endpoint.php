<?php
/**
 * Example plugin settings rest api for a single endpoint.
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM\Endpoint;

use \AM\Core\AbstractEndpoint as AbstractEndpoint;
use \AM\Config as Config;

/**
 * Prevent direct access to file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Example plugin settings rest api for a single endpoint.
 */
class  Example_Endpoint extends AbstractEndpoint {

	/**
	 * Set the endpoint for this class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $endpoint = '/example/';

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

		// Add all routes that have been registered.
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Registers the plugin and returns a single instance of this class
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    Config $config    Config object.
	 */
	public static function init( Config $config ) {
		if ( null === self::$instance ) {
			self::$instance = new self( $config );
		}
	}


	/**
	 * Register all routes.
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function register_routes() {
		register_rest_route(
			$this->config->api_namespace,
			$this->endpoint,
			array(
				'methods'             => $this->readable,
				'callback'            => array( $this, 'get_example_settings' ),
				'permission_callback' => array( $this, 'is_authorized' ),
			)
		);
	}


	/**
	 * Get example settings callback
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function get_example_settings() {

	}

	/**
	 * Checks if user has permission to access endpoint
	 *
	 * @since    1.0.0
	 * @access   private
	 **/
	private function is_authorized() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_Error( 'rest_forbidden', esc_html__( 'My name\'s Chow! Chow Mein!', $this->config->text_domain ), array( 'status' => 401 ) );
		}

		return true;
	}

}

