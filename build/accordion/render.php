<?php
/**
 * Accordion
 *
 * @param array     $attributes Block attributes.
 * @param string    $content    Block default content.
 * @param \WP_Block $block      Block instance.
 *
 * @package pixelalbatross/accordion-block
 */

?>

<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

	<?php
	/**
	 * Fires before the accordion items.
	 */
	do_action( 'pixelalbatross_accordion_block_before_items' );
	?>

	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

	<?php
	/**
	 * Fires after the accordion items.
	 */
	do_action( 'pixelalbatross_accordion_block_after_items' );
	?>
</div>
