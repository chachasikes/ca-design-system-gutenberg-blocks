/**
 * CAGov Alert
 */
 ( function( blocks, editor, i18n, element, components, _ ) {
	var __ = i18n.__;
	var el = element.createElement;
	var RichText = editor.RichText;

	blocks.registerBlockType( 'ca-design-system/alert', {
		title: __( 'Alert', 'ca-design-system' ),
		icon: 'universal-access-alt',
		category: 'ca-design-system',
		attributes: {
			title: {
				type: 'array',
				source: 'children',
				selector: 'h3',
			},
			body: {
				type: 'array',
				source: 'children',
				selector: 'p',
			},
			button: {
				type: 'array',
				source: 'children',
				selector: 'span',
			},
		},
		example: {
			attributes: {
				title: __( 'Alert title', 'ca-design-system' ),
				body: __( 'Alert body', 'ca-design-system' ),
				body: __( 'Alert button', 'ca-design-system' )
			}
		},
		edit: function( props ) {
			var attributes = props.attributes;

			return el(
				'div',
				{ className: 'cagov-alert cagov-stack full-bleed' },
				el(
					'div',
					{ className: 'container' },
				el( RichText, {
					tagName: 'h3',
					className: 'alert-title',
					inline: true,
					placeholder: __(
						'Write alert title…',
						'ca-design-system'
					),
					value: attributes.title,
					onChange: function( value ) {
						props.setAttributes( { title: value } );
					},
				} ),
				el( RichText, {
					tagName: 'p',
					className: 'alert-text',
					inline: true,
					placeholder: __(
						'Write alert body',
						'ca-design-system'
					),
					value: attributes.body,
					onChange: function( value ) {
						props.setAttributes( { body: value } );
					},
				} ),
				el( RichText, {
					tagName: 'span',
					className: 'button-white',
					inline: true,
					placeholder: __(
						'Write alert button text',
						'ca-design-system'
					),
					value: attributes.button,
					onChange: function( value ) {
						props.setAttributes( { button: value } );
					},
				} ),
			),
			);
		},
		save: function(props) {
			var attributes = props.attributes;
			return el(
				'div',
				{ className: 'cagov-alert cagov-stack full-bleed' },
				el(
					'div',
					{ className: 'container' },
				el( RichText.Content, {
					tagName: 'h3',
					className: 'alert-title',
					value: attributes.title,
				} ),
				el( RichText.Content, {
					tagName: 'p',
					className: 'alert-text',
					value: attributes.body,
				} ),
				el( RichText.Content, {
					tagName: 'span',
					className: 'button-white',
					value: attributes.button,
				} ),
				)
			);
		},
	} );
} )(
	window.wp.blocks,
	window.wp.editor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components,
	window._
);