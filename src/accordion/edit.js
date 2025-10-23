/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';

export default function AccordionEdit() {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps, {
		allowedBlocks: ['pixelalbatross/accordion-item'],
		template: [['pixelalbatross/accordion-item'], ['pixelalbatross/accordion-item']],
	});

	return <div {...innerBlocksProps} />;
}
