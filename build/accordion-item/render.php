<?php
/**
 * Accordion Item
 *
 * @param array     $attributes Block attributes.
 * @param string    $content    Block default content.
 * @param \WP_Block $block      Block instance.
 *
 * @package pixelalbatross/accordion-block
 */

if ( empty( $attributes['title'] ) ) {
	return;
}

$is_open = $attributes['isOpen'] ?? false;

$aria_label_open = sprintf(
	/* translators: %s accordion title */
	_x( '%s, show this section', 'ARIA label when the accordion is closed', 'accordion-block' ),
	$attributes['title']
);

$aria_label_close = sprintf(
	/* translators: %s accordion title */
	_x( '%s, hide this section', 'ARIA label when the accordion is open', 'accordion-block' ),
	$attributes['title']
);

?>

<div <?php echo get_block_wrapper_attributes(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="accordion-header">
		<h2 class="accordion-heading">
			<button
				type="button"
				class="accordion-button"
				aria-expanded="<?php echo esc_attr( $is_open ? 'true' : 'false' ); ?>"
				aria-label="<?php echo esc_attr( $is_open ? $aria_label_close : $aria_label_open ); ?>"
				data-aria-label-open="<?php echo esc_attr( $aria_label_open ); ?>"
				data-aria-label-close="<?php echo esc_attr( $aria_label_close ); ?>"
			>
				<?php
				/**
				 * Fires before the accordion item title.
				 *
				 * @param string {title} Accordion item title.
				 */
				do_action( 'pixelalbatross_accordion_block_before_item_title', $attributes['title'] );
				?>

				<span class="accordion-title">
					<?php echo wp_kses_post( $attributes['title'] ); ?>
				</span>

				<?php
				/**
				 * Fires after the accordion item title
				 *
				 * @param string {title} Accordion item title.
				 */
				do_action( 'pixelalbatross_accordion_block_after_item_title', $attributes['title'] );
				?>
			</button>
		</h2>
	</div>

	<div
		class="accordion-panel"
		role="region"
		<?php if ( ! $is_open ) : ?>
		hidden="until-found"
		<?php endif; ?>
	>
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>
