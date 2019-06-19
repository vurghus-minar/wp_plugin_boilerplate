<?php
/**
 * Runs only when the plugin is uninstalled.
 *
 * @link       https://github.com/vurghus-minar
 * @since      1.0.0
 *
 * @package    AM_Boilerplate_Plugin
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// phpcs:disable
error_log( 'Uninstall Working!' );
// phpcs:enable