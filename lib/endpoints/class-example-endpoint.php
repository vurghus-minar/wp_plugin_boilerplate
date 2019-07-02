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

		register_rest_route(
			$this->config->api_namespace,
			$this->endpoint,
			array(
				'methods'             => $this->creatable,
				'callback'            => array( $this, 'update_example_settings' ),
				'permission_callback' => array( $this, 'is_authorized' ),
			)
		);

		register_rest_route(
			$this->config->api_namespace,
			$this->endpoint,
			array(
				'methods'             => $this->editable,
				'callback'            => array( $this, 'update_example_settings' ),
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
		$option = get_option( 'am_plugin_example_settings' );

		if ( ! $option ) {
			return new \WP_REST_Response(
				array(
					'success' => true,
					'value'   => '',
				),
				200
			);
		}
		return new \WP_REST_Response(
			array(
				'success' => true,
				'value'   => $option,
			),
			200
		);
	}

	/**
	 * Get example settings callback
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    object $request    The request object.
	 **/
	public function update_example_settings( $request ) {

		$options = array(
			'bla' => $request->get_param( 'bla' ),
			'aha' => $request->get_param( 'aha' ),
			'zaz' => $request->get_param( 'zaz' ),
		);

		$options_updated = update_option( 'am_plugin_example_settings', $options );

		return new \WP_REST_Response(
			array(
				'success' => $options_updated,
				'value'   => $options,
			),
			200
		);
	}

	/**
	 * Checks if user has permission to access endpoint
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function is_authorized() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_Error( 'rest_forbidden', esc_html__( 'Operation is forbidden! Now spank me!', 'am-plugin-boilerplate' ), array( 'status' => 401 ) );
		}

		return true;
	}

}

