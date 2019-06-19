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

		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );
		add_filter( 'plugin_action_links_' . $this->config->plugin_basename, array( $this, 'add_plugin_action_links' ) );
		$this->create_option();

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
	 * Enqueue settings scripts
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function enqueue_settings_scripts() {

	}

	/**
	 * Enqueue settings styles
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function enqueue_settings_styles() {

	}


	/**
	 * Create option
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function create_option() {
		add_option( 'am_plugin_example_settings' );
	}

	/**
	 * Add settings menu in admin menu
	 *
	 * @since    1.0.0
	 * @access   public
	 **/
	public function create_settings_page() {
		$this->settings_page_hook_suffix = add_menu_page(
			__( 'Page Title', $this->config->text_domain ),
			__( 'Menu Title', $this->config->text_domain ),
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
			<div id="example-settings" class="wrap"><h1>I am real.</h1></div>
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
				'settings' => '<a href="' . admin_url( 'admin.php?page=' . $this->config->slug ) . '">' . __( 'Settings', $this->config->text_domain ) . '</a>',
			),
			$links
		);
	}

}
