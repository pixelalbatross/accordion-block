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
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
