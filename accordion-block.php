<?php
/**
 * Plugin Name:       Accordion Block
 * Description:       Display content in collapsible sections.
 * Plugin URI:        https://pixelalbatross.pt/?utm_source=wp-plugins&utm_medium=accordion-block&utm_campaign=plugin-uri
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Version:           0.9.1
 * Author:            Pixel Albatross
 * Author URI:        https://pixelalbatross.pt/?utm_source=wp-plugins&utm_medium=accordion-block&utm_campaign=author-uri
 * License:           GPL-3.0-or-later
 * License URI:       https://spdx.org/licenses/GPL-3.0-or-later.html
 * Update URI:        https://pixelalbatross.pt/
 * GitHub Plugin URI: https://github.com/pixelalbatross/accordion-block
 * Text Domain:       accordion-block
 */

namespace PixelAlbatross\WP\Blocks\Accordion;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PIXELALBATROSS_ACCORDION_BLOCK_PATH', plugin_dir_path( __FILE__ ) );
define( 'PIXELALBATROSS_ACCORDION_BLOCK_URL', plugin_dir_url( __FILE__ ) );

if ( file_exists( PIXELALBATROSS_ACCORDION_BLOCK_PATH . 'vendor/autoload.php' ) ) {
	require_once PIXELALBATROSS_ACCORDION_BLOCK_PATH . 'vendor/autoload.php';
}

$update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/pixelalbatross/accordion-block/',
	__FILE__,
	'accordion-block'
);

$update_checker->getVcsApi()->enableReleaseAssets();

$update_checker->addResultFilter(
	function ( $plugin_info ) {
		$plugin_info->icons = [
			'svg' => PIXELALBATROSS_ACCORDION_BLOCK_URL . 'assets/images/icon.svg',
		];
		return $plugin_info;
	}
);

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function init() {

	$block_json_files = glob( PIXELALBATROSS_ACCORDION_BLOCK_PATH . 'build/*/block.json' );

	foreach ( $block_json_files as $filename ) {

		$block_folder = dirname( $filename );
		$block_type   = register_block_type_from_metadata( $block_folder );

		if ( ! empty( $block_type->editor_script_handles ) ) {
			foreach ( $block_type->editor_script_handles as $handle ) {
				wp_set_script_translations(
					$handle,
					'accordion-block',
					PIXELALBATROSS_ACCORDION_BLOCK_PATH . 'languages'
				);
			}
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\init' );

/**
 * Registers the block textdomain.
 *
 * @return void
 */
function i18n() {
	load_plugin_textdomain( 'accordion-block', false, plugin_basename( PIXELALBATROSS_ACCORDION_BLOCK_PATH ) . '/languages' );
}
add_action( 'init', __NAMESPACE__ . '\i18n' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function js_detection() {
	echo "<script>!function(s){s.classList.contains('js')?s.classList:s.classList.add('js')}(document.documentElement);</script>\n";
}
add_action( 'wp_head', __NAMESPACE__ . '\js_detection', 0 );

/**
 * Tells administrators, on the Plugins screen, that Outstand Accordion replaces this plugin.
 *
 * @return void
 */
function replacement_notice() {
	$screen = get_current_screen();

	if ( ! $screen instanceof \WP_Screen ) {
		return;
	}

	$screen_id = $screen->id;

	if ( 'plugins' !== $screen_id || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$show_notice = (bool) apply_filters( 'pixelalbatross_accordion_block_show_replacement_notice', true );

	if ( ! $show_notice ) {
		return;
	}

	wp_admin_notice(
		sprintf(
			/* translators: 1: Outstand Accordion URL, 2: migration guide URL. */
			__( 'Accordion Block is no longer maintained. It is replaced by <a href="%1$s">Outstand Accordion</a>, which can run alongside it while you migrate. Follow the <a href="%2$s">migration guide</a> to convert your accordions in the editor or with WP-CLI.', 'accordion-block' ),
			esc_url( 'https://github.com/pixelalbatross/outstand-accordion' ),
			esc_url( 'https://github.com/pixelalbatross/outstand-accordion/blob/1.0.0/MIGRATING.md' )
		),
		[
			'type'        => 'warning',
			'dismissible' => true,
		]
	);
}
add_action( 'admin_notices', __NAMESPACE__ . '\replacement_notice' );
