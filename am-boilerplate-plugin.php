<?php
/**
 * The plugin's bootstrap.
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
 * Plugin Name: AM Boilerplate Plugin
 * Plugin URI:  https://github.com/vurghus-minar
 * Description: WordPress plugin boilerplate
 * Version:     1.0.0
 * Author:      Vurghus Minar <vurghus.minar@outlook.com>
 * Author URI:  https://github.com/vurghus-minar
 * License:     GPL v3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: am-boilerplate-plugin
 * Domain Path: /languages
 */

/**
 * Plugin configuration array
 */
$base_config = [
	'plugin_dir'      => plugin_dir_path( __FILE__ ), // Get current plugin directory.
	'plugin_basename' => plugin_basename( __FILE__ ), // Plugin basename i.e plugin_dir_name/plugin_file_name.php.
	'slug'            => 'am-boilerplate-plugin', // Plugin slug for text domain, settings, prefixes etc.
	'url'             => untrailingslashit( plugins_url( '/', __FILE__ ) ), // Plugin url.
	'version'         => '1.0.0', // Plugin version.
];

/**
 * Load all classes
 */
foreach ( new \RegexIterator(
	new \RecursiveIteratorIterator(
		new \RecursiveDirectoryIterator( $base_config['plugin_dir'] . 'lib', \RecursiveDirectoryIterator::SKIP_DOTS )
	),
	'/^.+\.php$/i',
	\RecursiveRegexIterator::GET_MATCH
) as $file ) {

	require_once $file[0];

}

/**
 * Create configuration object.
 */
$config = new \AM\Config( $base_config );

/**
 * Instantiate plugin
 */
\AM\Plugin::init( $config );

/**
 * Runs during plugin activation
 */
register_activation_hook(
	__FILE__,
	function () use ( $config ) {
		\AM\Activate_Plugin::init( $config );
	}
);

/**
 * Runs during plugin deactivation
 */
register_deactivation_hook(
	__FILE__,
	function () use ( $config ) {
		\AM\deactivate_Plugin::init( $config );
	}
);
