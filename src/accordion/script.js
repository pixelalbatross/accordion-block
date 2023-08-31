document.addEventListener('DOMContentLoaded', () => {
	const accordions = document.querySelectorAll('.wp-block-pixelalbatross-accordion');

	if (!accordions.length) {
		return;
	}

	/**
	 * Dispatch custom event.
	 *
	 * @param {element} element Trigger element.
	 * @param {string}  type    A string with the name of the event.
	 * @param {string}  options An object with properties passed to the CustomEvent() constructor.
	 */
	const dispatchEvent = (element, type, options = {}) => {
		// eslint-disable-next-line no-undef
		const event = new CustomEvent(type, options);
		element.dispatchEvent(event);
	};

	/**
	 * Open accordion item.
	 *
	 * @param {element} button Accordion item button.
	 * @param {element} panel  Accordion item panel.
	 */
	const open = (button, panel) => {
		button.setAttribute('aria-expanded', 'true');
		button.setAttribute('aria-label', button.dataset.ariaLabelClose);
		panel.removeAttribute('hidden');

		dispatchEvent(button, 'accordion:item:open', {
			bubbles: true,
			detail: {
				id: button.dataset.id,
			},
		});
	};

	/**
	 * Close accordion item.
	 *
	 * @param {element} button Accordion item button.
	 * @param {element} panel  Accordion item panel.
	 */
	const close = (button, panel) => {
		button.setAttribute('aria-expanded', 'false');
		button.setAttribute('aria-label', button.dataset.ariaLabelOpen);
		panel.setAttribute('hidden', 'hidden');

		dispatchEvent(button, 'accordion:item:close', {
			bubbles: true,
			detail: {
				id: button.dataset.id,
			},
		});
	};

	/**
	 * Toggle accordion item.
	 *
	 * @param {element} button Accordion item button.
	 */
	const toggle = (button) => {
		const panelId = button.getAttribute('aria-controls');
		const panel = document.getElementById(panelId);
		if (!panel) {
			return;
		}

		const isOpen = button.getAttribute('aria-expanded') === 'true';
		if (!isOpen) {
			open(button, panel);
		} else {
			close(button, panel);
		}
	};

	/**
	 * Setup accordion item.
	 *
	 * @param {element} accordionItem      Accordion item element.
	 * @param {number}  accordionIndex     Accordion index.
	 * @param {number}  accordionItemIndex Accordion item index.
	 */
	const setupAccordionItem = (accordionItem, accordionIndex, accordionItemIndex) => {
		const button = accordionItem.querySelector('button[aria-expanded]');
		button.addEventListener('click', () => {
			toggle(button);
		});

		const accordionItemId = `accordion-${accordionIndex}-item-${accordionItemIndex}`;

		// Add ids and aria attributes.
		button.setAttribute('id', `${accordionItemId}-heading`);
		button.setAttribute('aria-controls', `${accordionItemId}-panel`);
		button.setAttribute('data-id', accordionItemId);

		const parent = button.closest('.wp-block-pixelalbatross-accordion-item');
		if (parent) {
			parent.setAttribute('id', accordionItemId);

			const panel = parent.querySelector('.accordion-panel');
			if (panel) {
				panel.setAttribute('id', `${accordionItemId}-panel`);
				panel.setAttribute('aria-labelledby', `${accordionItemId}-heading`);
			}
		}

		dispatchEvent(accordionItem, 'accordion:init', {
			bubbles: true,
			detail: {
				panelId: button.dataset.id,
			},
		});
	};

	/**
	 * Setup accordions.
	 */
	accordions.forEach((accordion, accordionIndex) => {
		const accordionItems = accordion.querySelectorAll(
			'.wp-block-pixelalbatross-accordion-item .accordion-heading',
		);

		accordionItems.forEach((accordionItem, accordionItemIndex) => {
			setupAccordionItem(accordionItem, accordionIndex, accordionItemIndex);
		});
	});
});
