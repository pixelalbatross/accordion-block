<?php
/**
 * Plugin Name:       Accordion Block
 * Description:       Display content in collapsible sections.
 * Plugin URI:        https://pixelalbatross.pt/?utm_source=wp-plugins&utm_medium=accordion-block&utm_campaign=plugin-uri
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Version:           0.7.1
 * Author:            Pixel Albatross
 * Author URI:        https://pixelalbatross.pt/?utm_source=wp-plugins&utm_medium=accordion-block&utm_campaign=author-uri
 * License:           GPL-3.0-or-later
 * License URI:       https://spdx.org/licenses/GPL-3.0-or-later.html
 * Update URI:        https://pixelalbatross.pt/
 * GitHub Plugin URI: https://github.com/pixelalbatross/accordion-block
 * Text Domain:       accordion-block
 *
 * @package           pixelalbatross/accordion-block
 */

namespace PixelAlbatross\WP\AccordionBlock;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PIXALB_ACCORDION_BLOCK_PATH', plugin_dir_path( __FILE__ ) );

if ( file_exists( PIXALB_ACCORDION_BLOCK_PATH . 'vendor/autoload.php' ) ) {
	require_once PIXALB_ACCORDION_BLOCK_PATH . 'vendor/autoload.php';
}

$updater = PucFactory::buildUpdateChecker(
	'https://github.com/pixelalbatross/accordion-block/',
	__FILE__,
	'accordion-block'
);

$updater->setBranch( 'main' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function accordion_block_init() {

	$block_json_files = glob( PIXALB_ACCORDION_BLOCK_PATH . 'build/*/block.json' );

	foreach ( $block_json_files as $filename ) {

		$block_folder = dirname( $filename );
		$block_type   = register_block_type_from_metadata( $block_folder );

		if ( ! empty( $block_type->editor_script_handles ) ) {
			foreach ( $block_type->editor_script_handles as $handle ) {
				wp_set_script_translations(
					$handle,
					'accordion-block',
					PIXALB_ACCORDION_BLOCK_PATH . 'languages'
				);
			}
		}
	}
}
add_action( 'init', __NAMESPACE__ . '\accordion_block_init' );

/**
 * Registers the block textdomain.
 *
 * @return void
 */
function accordion_block_i18n() {
	load_plugin_textdomain( 'accordion-block', false, plugin_basename( PIXALB_ACCORDION_BLOCK_PATH ) . '/languages' );
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\accordion_block_i18n' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function accordion_block_js_detection() {
	echo "<script>!function(s){s.classList.contains('js')?s.classList:s.classList.add('js')}(document.documentElement);</script>\n";
}
add_action( 'wp_head', __NAMESPACE__ . '\accordion_block_js_detection', 0 );
