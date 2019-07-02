<?php
/**
 * Example settings class
 *
 * @package           AM_Boilerplate_Plugin
 * @since             1.0.0
 * @link              https://github.com/vurghus-minar
 */

namespace AM\Settings;

use \AM\Core\AbstractSettings as AbstractSettings;
use \AM\Config as Config;

/**
 * Example settings class
 */
class Example_Settings extends AbstractSettings {

	/**
	 * Setting name to be used internaly to generate resources.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string   $setting_name
	 */
	private $setting_name;

	/**
	 * Options default values
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array   $default_options
	 */
	public static $default_options;

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

		// Set setting name.
		$this->setting_name = 'example';

		// Add Defaults.
		self::$default_options = array(
			'bla' => 'one',
			'aha' => 'two',
			'zaz' => array(
				'fafa' => 'three',
				'tut'  => 'four',
			),
		);

		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_settings_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_settings_scripts' ) );
		add_filter( 'plugin_action_links_' . $this->config->plugin_basename, array( $this, 'add_plugin_action_links' ) );
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
	 * Enqueue settings styles
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function enqueue_settings_styles() {
		if ( ! isset( $this->settings_page_hook_suffix ) ) {
			return;
		}
		$current_screen = get_current_screen();
		if ( $this->settings_page_hook_suffix === $current_screen->id ) {
			wp_enqueue_style( $this->setting_name, $this->config->assets_url . 'settings/' . $this->setting_name . '/css/style.css', array(), $this->config->plugin_ver, 'all' );
		}

	}

	/**
	 * Enqueue settings scripts
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function enqueue_settings_scripts() {
		if ( ! isset( $this->settings_page_hook_suffix ) ) {
			return;
		}
		$current_screen = get_current_screen();
		if ( $this->settings_page_hook_suffix === $current_screen->id ) {
			wp_enqueue_script( $this->setting_name . '-main', $this->config->assets_url . 'settings/' . $this->setting_name . '/js/script.js', array( 'wp-element', 'wp-i18n' ), $this->config->plugin_ver, 'all' );
			wp_localize_script(
				$this->setting_name . '-main',
				$this->setting_name . '_rest_object',
				array(
					'nonce'    => wp_create_nonce( 'wp_rest' ),
					'rest_url' => rest_url( $this->config->api_namespace . '/example' ),
				)
			);
		}
	}


	/**
	 * Create option
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public static function create_options() {
		add_option( 'am_plugin_example_settings', self::$default_options );
	}

	/**
	 * Add settings menu in admin menu
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function create_settings_page() {
		$this->settings_page_hook_suffix = add_menu_page(
			__( 'Page Title', 'am-plugin-boilerplate' ),
			__( 'Menu Title', 'am-plugin-boilerplate' ),
			'manage_options',
			$this->config->slug,
			array(
				$this,
				'create_settings_page_content',
			),
			'dashicons-index-card'
		);
	}

	/**
	 * Add the settings page html
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function create_settings_page_content() {
		?>
			<div id="example-settings" class="wrap"></div>
		<?php
	}

	/**
	 * Add link to the  list of links to display on the plugins page.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    array $links    Array of exiting links.
	 */
	public function add_plugin_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->config->slug ) . '">' . __( 'Settings', 'am-plugin-boilerplate' ) . '</a>',
			),
			$links
		);
	}

}
