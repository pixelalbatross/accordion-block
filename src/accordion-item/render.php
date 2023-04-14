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

ob_start();
/**
 * Fires before the accordion item title.
 *
 * @param string $title Accordion item title.
 */
do_action( 'pixelalbatross_accordion_block_before_item_title', $attributes['title'] );
$before_item_title = ob_end_clean();

ob_start();
/**
 * Fires after the accordion item title
 *
 * @param string $title Accordion item title.
 */
do_action( 'pixelalbatross_accordion_block_after_item_title', $attributes['title'] );
$after_item_title = ob_end_clean();

$button = tag('button', [
	'type' => 'button'
	'class' => 'accordion-button'
	'aria-expanded' => $is_open ? 'true' : 'false',
	'aria-label' => $is_open ? $aria_label_close : $aria_label_open,
	'data-aria-label-open' => $aria_label_open,
	'data-aria-label-close' => $aria_label_close,
], $before_item_title . tag('span', ['class' => 'accordion-title'], wp_kses_post($attributes['title'])) . $after_item_title);

$panel_classes = [
	class => 'accordion-panel',
	role => 'region',
];
if ( ! $is_open ) {
	$panel_classes['hidden'] = 'until-found';
}

printf(
	'<div %s>%s%s</div>',
	get_block_wrapper_attributes(),
	tag('div', ['class' => 'accordion-header'], tag('h2', ['class' => 'accordion-heading'], $button)),
	tag('div', $panel_classes, $content)
);
