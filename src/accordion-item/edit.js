/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import {
	useBlockProps,
	useInnerBlocksProps,
	useBlockEditContext,
	InspectorControls,
	RichText,
} from '@wordpress/block-editor';
import { PanelBody, PanelRow, ToggleControl } from '@wordpress/components';
import { applyFilters } from '@wordpress/hooks';

export default function AccordionItemEdit({ attributes, setAttributes, isSelected }) {
	const { title, isOpen } = attributes;
	const { clientId } = useBlockEditContext();
	const hasSelectedInnerBlock = useSelect((select) =>
		select('core/block-editor').hasSelectedInnerBlock(clientId, true),
	);
	const isBlockSelected = isSelected || hasSelectedInnerBlock || isOpen;

	/**
	 * Filters the list of allowed blocks.
	 */
	const allowedBlocks = applyFilters('pixelalbatross.accordionBlock.allowedBlocks', [
		'core/button',
		'core/buttons',
		'core/columns',
		'core/cover',
		'core/group',
		'core/heading',
		'core/image',
		'core/list-item',
		'core/list',
		'core/media-text',
		'core/paragraph',
		'core/quote',
		'core/separator',
		'core/table',
	]);

	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(
		{
			className: 'accordion-panel',
			hidden: !isBlockSelected,
		},
		{
			allowedBlocks,
			template: [['core/paragraph']],
		},
	);

	return (
		<>
			<div {...blockProps}>
				<div className="accordion-header">
					<div className="accordion-heading" role="heading" aria-level="2">
						<div className="accordion-button" role="button">
							<RichText
								tagName="span"
								value={title}
								onChange={(value) => setAttributes({ title: value })}
								placeholder={__('Accordion Title', 'accordion-block')}
								allowedFormats={[]}
								className="accordion-title"
							/>
						</div>
					</div>
				</div>
				<div {...innerBlocksProps} />
			</div>
			<InspectorControls>
				<PanelBody title={__('Settings', 'accordion-block')}>
					<PanelRow>
						<ToggleControl
							label={__('Expand by default', 'accordion-block')}
							help={__(
								'When enabled, the item will be expanded by default on page load.',
								'accordion-block',
							)}
							checked={isOpen}
							onChange={(value) => {
								setAttributes({ isOpen: value });
							}}
						/>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
