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

// eslint-disable-next-line jsdoc/require-param
/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes, isSelected }) {
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
		'core/group',
		'core/heading',
		'core/image',
		'core/list-item',
		'core/list',
		'core/media-text',
		'core/paragraph',
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
					<RichText
						tagName="h2"
						value={title}
						onChange={(value) => setAttributes({ title: value })}
						placeholder={__('Accordion Title', 'accordion-block')}
						allowedFormats={[]}
						className="accordion-heading"
					/>
				</div>
				<div {...innerBlocksProps} />
			</div>
			<InspectorControls>
				<PanelBody title={__('Accordion Item Settings', 'accordion-block')}>
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
