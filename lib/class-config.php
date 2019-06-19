<?php
/**
 * Plugin's configuration class
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
 * Plugin's configuration class
 */
class Config {

	/**
	 * Plugin basename i.e plugin_dir_name/plugin_file_name.php
	 *
	 * @since    1.0.0
	 * @access private
	 * @var      string    plugin_basename   Plugin basename i.e plugin_dir_name/plugin_file_name.php
	 */
	private $plugin_basename;

	/**
	 * The slug of this plugin.
	 *
	 * @since    1.0.0
	 * @access private
	 * @var      string    $slug    The plugin slug.
	 */
	private $slug;

	/**
	 * The base URL path (without trailing slash).
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $url    The base URL path of this plugin.
	 */
	private $url;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The filesystem directory path fo this plugin file.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_dir    The filesystem directory path for the plugin.
	 */
	private $plugin_dir;

	/**
	 * The stylesheet directory folder path that overrides public script and style.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $override_dir   The stylesheet directory folder path that overrides public script and style.
	 */
	private $override_dir;

	/**
	 * The Rest API namespace.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $api_namespacer   The Rest API namespace.
	 */
	private $api_namespace;

	/**
	 * Class constructor.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param      array $config_array    Array of configuration.
	 */
	public function __construct( $config_array ) {
		$this->plugin_basename = $config_array['plugin_basename'];
		$this->slug            = $config_array['slug'];
		$this->url             = $config_array['url'];
		$this->version         = $config_array['version'];
		$this->plugin_dir      = $config_array['plugin_dir'];
		$this->override_dir    = get_stylesheet_directory() . "/config-$this->slug/";
		$this->api_namespace   = $this->slug . '/v' . $this->version;
	}

	/**
	 * Registers all directories associated with the plugin and converts them to an object array.
	 *
	 * @since     1.0.0
	 * @access    public
	 */
	public function get_config() {
		return (object) [
			'slug'            => $this->slug,
			'plugin_dir'      => $this->plugin_dir,
			'plugin_ver'      => $this->version,
			'plugin_basename' => $this->plugin_basename,
			'plugin_url'      => $this->url,
			'override_dir'    => $this->override_dir,
			'language_dir'    => $this->plugin_dir . '/languages',
			'text_domain'     => $this->slug,
			'api_namespace'   => $this->api_namespace,
			'backend_dir'     => (object) [
				'style'  => $this->plugin_dir . 'assets/css/',
				'script' => $this->plugin_dir . 'assets/js/',
			],
			'frontend_dir'    => (object) [
				'style'           => $this->plugin_dir . 'assets/public/css/',
				'script'          => $this->plugin_dir . 'assets/public/js/',
				'style_override'  => $this->override_dir . 'assets/public/css/',
				'script_override' => $this->override_dir . 'assets/public/js/',
			],
		];

	}

}
