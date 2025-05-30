<?php
/**
 * Accordion
 *
 * @var array     $attributes Block attributes.
 * @var string    $content    Block default content.
 * @var \WP_Block $block      Block instance.
 *
 * @package AccordionBlock
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
