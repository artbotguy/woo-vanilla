/*global wc_add_to_cart_variation_params */
; (function ($, window, document, undefined) {
	/**
	 * VariationForm class which handles variation forms and attributes.
	 */
	var VariationForm = function ($form) {
		var self = this;

		self.$form = $form;
		// self.$attributeFields = $form.find('.variations select');
		self.$attributeFields = $form.find('.wv-variations input:radio');
		self.$singleVariation = $form.find('.single_variation');
		self.$singleVariationWrap = $form.find('.single_variation_wrap');
		self.$resetVariations = $form.find('.reset_variations');
		self.$product = $form.closest('.product');
		/**
		 * WV
		 * Array variations
		 */
		self.variationData = $form.data('product_variations');
		self.useAjax = false === self.variationData;
		self.xhr = false;
		self.loading = true;

		// Initial state.
		self.$singleVariationWrap.show();
		self.$form.off('.wc-variation-form');

		// Methods.
		self.getChosenAttributes = self.getChosenAttributes.bind(self);
		self.findMatchingVariations = self.findMatchingVariations.bind(self);
		self.isMatch = self.isMatch.bind(self);
		self.toggleResetLink = self.toggleResetLink.bind(self);

		// Events.
		$form.on('click.wc-variation-form', '.reset_variations', { variationForm: self }, self.onReset);
		$form.on('reload_product_variations', { variationForm: self }, self.onReload);
		$form.on('hide_variation', { variationForm: self }, self.onHide);
		$form.on('show_variation', { variationForm: self }, self.onShow);
		$form.on('click', '.single_add_to_cart_button', { variationForm: self }, self.onAddToCart);
		$form.on('reset_data', { variationForm: self }, self.onResetDisplayedVariation);
		$form.on('reset_image', { variationForm: self }, self.onResetImage);
		$form.on('change.wc-variation-form', '.variations select', { variationForm: self }, self.onChange);
		$form.on('found_variation.wc-variation-form', { variationForm: self }, self.onFoundVariation);
		$form.on('check_variations.wc-variation-form', { variationForm: self }, self.onFindVariation);
		$form.on('update_variation_values.wc-variation-form', { variationForm: self }, self.onUpdateAttributes);

		/**
		 * WV
		 */
		$form.on('change.wc-variation-form', '.wv-variations input:radio', { variationForm: self }, self.WVOnChange);


		// Init after gallery.
		setTimeout(function () {
			$form.trigger('check_variations');
			$form.trigger('wc_variation_form', self);
			self.loading = false;
		}, 100);
	};

	/**
 * Change
 */
	VariationForm.prototype.WVOnChange = function (event) {
		var form = event.data.variationForm;

		form.$form.find(`input[name="${event.currentTarget.name}"]`).removeAttr('checked');
		this.checked = true

		form.$form.find('input[name="variation_id"], input.variation_id').val('').trigger('change');
		form.$form.find('.wc-no-matching-variations').remove();

		if (form.useAjax) {
			form.$form.trigger('check_variations');
		} else {
			form.$form.trigger('woocommerce_variation_select_change');
			form.$form.trigger('check_variations');
		}

		// Custom event for when variation selection has been changed
		form.$form.trigger('woocommerce_variation_has_changed');
	};

	// /**
	//  * Reset all fields.
	//  */
	// VariationForm.prototype.onReset = function (event) {
	// 	event.preventDefault();
	// 	event.data.variationForm.$attributeFields.val('').trigger('change');
	// 	event.data.variationForm.$form.trigger('reset_data');
	// };

	/**
	 * Reload variation data from the DOM.
	 */
	VariationForm.prototype.onReload = function (event) {
		var form = event.data.variationForm;
		form.variationData = form.$form.data('product_variations');
		form.useAjax = false === form.variationData;
		form.$form.trigger('check_variations');
	};

	/**
	 * When a variation is hidden.
	 */
	VariationForm.prototype.onHide = function (event) {
		event.preventDefault();
		event.data.variationForm.$form
			.find('.single_add_to_cart_button')
			.removeClass('wc-variation-is-unavailable')
			.addClass('disabled wc-variation-selection-needed');
		event.data.variationForm.$form
			.find('.woocommerce-variation-add-to-cart')
			.removeClass('woocommerce-variation-add-to-cart-enabled')
			.addClass('woocommerce-variation-add-to-cart-disabled');
	};

	/**
	 * When a variation is shown.
	 */
	VariationForm.prototype.onShow = function (event, variation, purchasable) {
		event.preventDefault();
		if (purchasable) {
			event.data.variationForm.$form
				.find('.single_add_to_cart_button')
				.removeClass('disabled wc-variation-selection-needed wc-variation-is-unavailable');
			event.data.variationForm.$form
				.find('.woocommerce-variation-add-to-cart')
				.removeClass('woocommerce-variation-add-to-cart-disabled')
				.addClass('woocommerce-variation-add-to-cart-enabled');
		} else {
			event.data.variationForm.$form
				.find('.single_add_to_cart_button')
				.removeClass('wc-variation-selection-needed')
				.addClass('disabled wc-variation-is-unavailable');
			event.data.variationForm.$form
				.find('.woocommerce-variation-add-to-cart')
				.removeClass('woocommerce-variation-add-to-cart-enabled')
				.addClass('woocommerce-variation-add-to-cart-disabled');
		}

		// If present, the media element library needs initialized on the variation description.
		if (wp.mediaelement) {
			event.data.variationForm.$form.find('.wp-audio-shortcode, .wp-video-shortcode')
				.not('.mejs-container')
				.filter(
					function () {
						return !$(this).parent().hasClass('mejs-mediaelement');
					}
				)
				.mediaelementplayer(wp.mediaelement.settings);
		}
	};

	/**
	 * When the cart button is pressed.
	 */
	VariationForm.prototype.onAddToCart = function (event) {
		if ($(this).is('.disabled')) {
			event.preventDefault();

			if ($(this).is('.wc-variation-is-unavailable')) {
				window.alert(wc_add_to_cart_variation_params.i18n_unavailable_text);
			} else if ($(this).is('.wc-variation-selection-needed')) {
				window.alert(wc_add_to_cart_variation_params.i18n_make_a_selection_text);
			}
		}
	};

	/**
	 * When displayed variation data is reset.
	 */
	VariationForm.prototype.onResetDisplayedVariation = function (event) {
		var form = event.data.variationForm;
		form.$product.find('.product_meta').find('.sku').wc_reset_content();
		form.$product
			.find('.product_weight, .woocommerce-product-attributes-item--weight .woocommerce-product-attributes-item__value')
			.wc_reset_content();
		form.$product
			.find('.product_dimensions, .woocommerce-product-attributes-item--dimensions .woocommerce-product-attributes-item__value')
			.wc_reset_content();
		form.$form.trigger('reset_image');
		form.$singleVariation.slideUp(200).trigger('hide_variation');
	};

	/**
	 * When the product image is reset.
	 */
	VariationForm.prototype.onResetImage = function (event) {
		event.data.variationForm.$form.wc_variations_image_update(false);
	};

	/**
	 * Looks for matching variations for current selected attributes.
	 */
	VariationForm.prototype.onFindVariation = function (event, chosenAttributes) {
		var form = event.data.variationForm,
			attributes = 'undefined' !== typeof chosenAttributes ? chosenAttributes : form.getChosenAttributes(),
			currentAttributes = attributes.data;

		// if (attributes.count && attributes.count === attributes.chosenCount) {
		if (form.useAjax) {
			if (form.xhr) {
				form.xhr.abort();
			}
			form.$form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });
			currentAttributes.product_id = parseInt(form.$form.data('product_id'), 10);
			currentAttributes.custom_data = form.$form.data('custom_data');
			form.xhr = $.ajax({
				url: wc_add_to_cart_variation_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_variation'),
				type: 'POST',
				data: currentAttributes,
				success: function (variation) {
					if (variation) {
						form.$form.trigger('found_variation', [variation]);
					} else {
						form.$form.trigger('reset_data');
						attributes.chosenCount = 0;

						if (!form.loading) {
							form.$form
								.find('.single_variation')
								.after(
									'<p class="wc-no-matching-variations woocommerce-info">' +
									wc_add_to_cart_variation_params.i18n_no_matching_variations_text +
									'</p>'
								);
							form.$form.find('.wc-no-matching-variations').slideDown(200);
						}
					}
				},
				complete: function () {
					form.$form.unblock();
				}
			});
		} else {
			form.$form.trigger('update_variation_values');

			var matching_variations = form.findMatchingVariations(form.variationData, currentAttributes),
				variation = matching_variations.shift();

			if (variation) {
				form.$form.trigger('found_variation', [variation]);

			}
			/**
			 * WV
			 * Логика, если не найден вариант с совпадающими параметрами atrr (не созданы все доступные варианты комбинации)
			 */
			else {
				form.$form.trigger('reset_data');
				attributes.chosenCount = 0;

				if (!form.loading) {
					form.$form
						.find('.single_variation')
						.after(
							'<p class="wc-no-matching-variations woocommerce-info">' +
							wc_add_to_cart_variation_params.i18n_no_matching_variations_text +
							'</p>'
						);
					form.$form.find('.wc-no-matching-variations').slideDown(200);
				}
			}
		}
		// Show reset link.
		form.toggleResetLink(attributes.chosenCount > 0);
	};

	/**
	 * Запускается, когда найден вариант, соответствующий всем атрибутам.
	 */
	VariationForm.prototype.onFoundVariation = function (event, variation) {
		var form = event.data.variationForm,
			$sku = form.$product.find('.product_meta').find('.sku'),
			$weight = form.$product.find(
				'.product_weight, .woocommerce-product-attributes-item--weight .woocommerce-product-attributes-item__value'
			),
			$dimensions = form.$product.find(
				'.product_dimensions, .woocommerce-product-attributes-item--dimensions .woocommerce-product-attributes-item__value'
			),
			$qty = form.$singleVariationWrap.find('.quantity input[name="quantity"]'),
			purchasable = true,
			variation_id = '',
			template = false,
			$template_html = '';

		if (variation.sku) {
			$sku.wc_set_content(variation.sku);
		} else {
			$sku.wc_reset_content();
		}

		if (variation.weight) {
			$weight.wc_set_content(variation.weight_html);
		} else {
			$weight.wc_reset_content();
		}

		if (variation.dimensions) {
			// Decode HTML entities.
			$dimensions.wc_set_content($.parseHTML(variation.dimensions_html)[0].data);
		} else {
			$dimensions.wc_reset_content();
		}

		form.$form.wc_variations_image_update(variation);

		if (!variation.variation_is_visible) {
			template = wp_template('unavailable-variation-template');
		} else {
			/**
			 * Это ищет элемент с идентификатором tmpl- и возвращает функцию для отображения этого шаблона и интерполяции всех полей данных.
			 */
			template = wp_template('variation-template');
			variation_id = variation.variation_id;
		}

		/**
		 * Вставляет цену и т.п.
		 */
		// console.log(variation);
		$template_html = template({
			variation: variation
		});
		$template_html = $template_html.replace('/*<![CDATA[*/', '');
		$template_html = $template_html.replace('/*]]>*/', '');

		form.$singleVariation.html($template_html);
		form.$form.find('input[name="variation_id"], input.variation_id').val(variation.variation_id).trigger('change');

		// Hide or show qty input
		if (variation.is_sold_individually === 'yes') {
			$qty.find('input.qty').val('1').attr('min', '1').attr('max', '').trigger('change');
			$qty.hide();
		} else {

			var $qty_input = $qty.find('input.qty'),
				qty_val = parseFloat($qty_input.val());

			if (isNaN(qty_val)) {
				qty_val = variation.min_qty;
			} else {
				qty_val = qty_val > parseFloat(variation.max_qty) ? variation.max_qty : qty_val;
				qty_val = qty_val < parseFloat(variation.min_qty) ? variation.min_qty : qty_val;
			}

			$qty_input.attr('min', variation.min_qty).attr('max', variation.max_qty).val(qty_val).trigger('change');
			$qty.show();
		}

		// Enable or disable the add to cart button
		if (!variation.is_purchasable || !variation.is_in_stock || !variation.variation_is_visible) {
			purchasable = false;
		}

		// Reveal
		if (form.$singleVariation.text().trim()) {
			form.$singleVariation.slideDown(200).trigger('show_variation', [variation, purchasable]);
		} else {
			form.$singleVariation.show().trigger('show_variation', [variation, purchasable]);
		}
	};

	/**
	 * Запускается при изменении поля атрибута.
	 */
	VariationForm.prototype.onChange = function (event) {
		var form = event.data.variationForm;

		form.$form.find('input[name="variation_id"], input.variation_id').val('').trigger('change');
		form.$form.find('.wc-no-matching-variations').remove();

		if (form.useAjax) {
			form.$form.trigger('check_variations');
		} else {
			form.$form.trigger('woocommerce_variation_select_change');
			form.$form.trigger('check_variations');
		}

		// Custom event for when variation selection has been changed
		form.$form.trigger('woocommerce_variation_has_changed');
	};

	/**
	 * Escape quotes in a string.
	 * @param {string} string
	 * @return {string}
	 */
	VariationForm.prototype.addSlashes = function (string) {
		string = string.replace(/'/g, '\\\'');
		string = string.replace(/"/g, '\\\"');
		return string;
	};

	/**
	 * Updates attributes in the DOM to show valid values.
	 */
	VariationForm.prototype.onUpdateAttributes = function (event) {
		var form = event.data.variationForm,
			attributes = form.getChosenAttributes(),
			currentAttributes = attributes.data;

		if (form.useAjax) {
			return;
		}

		// Custom event for when variations have been updated.
		form.$form.trigger('woocommerce_update_variation_values');
	};

	/**
	 * Get chosen attributes from form.
	 * @return array
	 */
	VariationForm.prototype.getChosenAttributes = function () {
		var data = {};
		var count = 0;
		var chosen = 0;

		this.$attributeFields.each(function () {
			if (this.checked) {
				// note: решить с добавленными
				// 
				chosen++;

				var attribute_name = $(this).data('attribute_name') || $(this).attr('name');
				var value = $(this).val() || '';
				count++;
				data[attribute_name] = value;
			}
		});

		return {
			'count': count,
			'chosenCount': chosen,
			'data': data
		};
	};

	/**
	 * Find matching variations for attributes.
	 */
	VariationForm.prototype.findMatchingVariations = function (variations, attributes) {
		var matching = [];
		for (var i = 0; i < variations.length; i++) {
			var variation = variations[i];

			if (this.isMatch(variation.attributes, attributes)) {
				matching.push(variation);
			}
		}
		return matching;
	};

	/**
	 * See if attributes match.
	 * @return {Boolean}
	 */
	VariationForm.prototype.isMatch = function (variation_attributes, attributes) {
		var match = true;
		for (var attr_name in variation_attributes) {
			if (variation_attributes.hasOwnProperty(attr_name)) {
				var val1 = variation_attributes[attr_name];
				var val2 = attributes[attr_name];
				if (val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2) {
					match = false;
				}
			}
		}
		return match;
	};

	/**
	 * Show or hide the reset link.
	 */
	VariationForm.prototype.toggleResetLink = function (on) {
		if (on) {
			if (this.$resetVariations.css('visibility') === 'hidden') {
				this.$resetVariations.css('visibility', 'visible').hide().fadeIn();
			}
		} else {
			this.$resetVariations.css('visibility', 'hidden');
		}
	};

	/**
	 * Function to call wc_variation_form on jquery selector.
	 */
	$.fn.wc_variation_form = function () {
		new VariationForm(this);
		return this;
	};

	/**
	 * Stores the default text for an element so it can be reset later
	 */
	$.fn.wc_set_content = function (content) {
		if (undefined === this.attr('data-o_content')) {
			this.attr('data-o_content', this.text());
		}
		this.text(content);
	};

	/**
	 * Stores the default text for an element so it can be reset later
	 */
	$.fn.wc_reset_content = function () {
		if (undefined !== this.attr('data-o_content')) {
			this.text(this.attr('data-o_content'));
		}
	};

	/**
	 * Stores a default attribute for an element so it can be reset later
	 */
	$.fn.wc_set_variation_attr = function (attr, value) {
		if (undefined === this.attr('data-o_' + attr)) {
			this.attr('data-o_' + attr, (!this.attr(attr)) ? '' : this.attr(attr));
		}
		if (false === value) {
			this.removeAttr(attr);
		} else {
			this.attr(attr, value);
		}
	};

	/**
	 * Reset a default attribute for an element so it can be reset later
	 */
	$.fn.wc_reset_variation_attr = function (attr) {
		if (undefined !== this.attr('data-o_' + attr)) {
			this.attr(attr, this.attr('data-o_' + attr));
		}
	};

	/**
	 * Reset the slide position if the variation has a different image than the current one
	 */
	$.fn.wc_maybe_trigger_slide_position_reset = function (variation) {
		var $form = $(this),
			$product = $form.closest('.product'),
			$product_gallery = $product.find('.images'),
			reset_slide_position = false,
			new_image_id = (variation && variation.image_id) ? variation.image_id : '';

		if ($form.attr('current-image') !== new_image_id) {
			reset_slide_position = true;
		}

		$form.attr('current-image', new_image_id);

		if (reset_slide_position) {
			$product_gallery.trigger('woocommerce_gallery_reset_slide_position');
		}
	};

	/**
	 * Sets product images for the chosen variation
	 */
	$.fn.wc_variations_image_update = function (variation) {
		var $form = this,
			$product = $form.closest('.product'),
			$product_gallery = $product.find('.images'),
			$gallery_nav = $product.find('.flex-control-nav'),
			$gallery_img = $gallery_nav.find('li:eq(0) img'),
			$product_img_wrap = $product_gallery
				.find('.woocommerce-product-gallery__image, .woocommerce-product-gallery__image--placeholder')
				.eq(0),
			$product_img = $product_img_wrap.find('.wp-post-image'),
			$product_link = $product_img_wrap.find('a').eq(0);

		if (variation && variation.image && variation.image.src && variation.image.src.length > 1) {
			// See if the gallery has an image with the same original src as the image we want to switch to.
			var galleryHasImage = $gallery_nav.find('li img[data-o_src="' + variation.image.gallery_thumbnail_src + '"]').length > 0;

			// If the gallery has the image, reset the images. We'll scroll to the correct one.
			if (galleryHasImage) {
				$form.wc_variations_image_reset();
			}

			// See if gallery has a matching image we can slide to.
			var slideToImage = $gallery_nav.find('li img[src="' + variation.image.gallery_thumbnail_src + '"]');

			if (slideToImage.length > 0) {
				slideToImage.trigger('click');
				$form.attr('current-image', variation.image_id);
				window.setTimeout(function () {
					$(window).trigger('resize');
					$product_gallery.trigger('woocommerce_gallery_init_zoom');
				}, 20);
				return;
			}

			$product_img.wc_set_variation_attr('src', variation.image.src);
			$product_img.wc_set_variation_attr('height', variation.image.src_h);
			$product_img.wc_set_variation_attr('width', variation.image.src_w);
			$product_img.wc_set_variation_attr('srcset', variation.image.srcset);
			$product_img.wc_set_variation_attr('sizes', variation.image.sizes);
			$product_img.wc_set_variation_attr('title', variation.image.title);
			$product_img.wc_set_variation_attr('data-caption', variation.image.caption);
			$product_img.wc_set_variation_attr('alt', variation.image.alt);
			$product_img.wc_set_variation_attr('data-src', variation.image.full_src);
			$product_img.wc_set_variation_attr('data-large_image', variation.image.full_src);
			$product_img.wc_set_variation_attr('data-large_image_width', variation.image.full_src_w);
			$product_img.wc_set_variation_attr('data-large_image_height', variation.image.full_src_h);
			$product_img_wrap.wc_set_variation_attr('data-thumb', variation.image.src);
			$gallery_img.wc_set_variation_attr('src', variation.image.gallery_thumbnail_src);
			$product_link.wc_set_variation_attr('href', variation.image.full_src);
		} else {
			$form.wc_variations_image_reset();
		}

		window.setTimeout(function () {
			$(window).trigger('resize');
			$form.wc_maybe_trigger_slide_position_reset(variation);
			$product_gallery.trigger('woocommerce_gallery_init_zoom');
		}, 20);
	};

	/**
	 * Reset main image to defaults.
	 */
	$.fn.wc_variations_image_reset = function () {
		var $form = this,
			$product = $form.closest('.product'),
			$product_gallery = $product.find('.images'),
			$gallery_nav = $product.find('.flex-control-nav'),
			$gallery_img = $gallery_nav.find('li:eq(0) img'),
			$product_img_wrap = $product_gallery
				.find('.woocommerce-product-gallery__image, .woocommerce-product-gallery__image--placeholder')
				.eq(0),
			$product_img = $product_img_wrap.find('.wp-post-image'),
			$product_link = $product_img_wrap.find('a').eq(0);

		$product_img.wc_reset_variation_attr('src');
		$product_img.wc_reset_variation_attr('width');
		$product_img.wc_reset_variation_attr('height');
		$product_img.wc_reset_variation_attr('srcset');
		$product_img.wc_reset_variation_attr('sizes');
		$product_img.wc_reset_variation_attr('title');
		$product_img.wc_reset_variation_attr('data-caption');
		$product_img.wc_reset_variation_attr('alt');
		$product_img.wc_reset_variation_attr('data-src');
		$product_img.wc_reset_variation_attr('data-large_image');
		$product_img.wc_reset_variation_attr('data-large_image_width');
		$product_img.wc_reset_variation_attr('data-large_image_height');
		$product_img_wrap.wc_reset_variation_attr('data-thumb');
		$gallery_img.wc_reset_variation_attr('src');
		$product_link.wc_reset_variation_attr('href');
	};

	$(function () {
		if (typeof wc_add_to_cart_variation_params !== 'undefined') {
			$('.variations_form').each(function () {
				$(this).wc_variation_form();
			});
		}
	});

	/**
	 * Matches inline variation objects to chosen attributes
	 * @deprecated 2.6.9
	 * @type {Object}
	 */
	var wc_variation_form_matcher = {
		find_matching_variations: function (product_variations, settings) {
			var matching = [];
			for (var i = 0; i < product_variations.length; i++) {
				var variation = product_variations[i];

				if (wc_variation_form_matcher.variations_match(variation.attributes, settings)) {
					matching.push(variation);
				}
			}
			return matching;
		},
		variations_match: function (attrs1, attrs2) {
			var match = true;
			for (var attr_name in attrs1) {
				if (attrs1.hasOwnProperty(attr_name)) {
					var val1 = attrs1[attr_name];
					var val2 = attrs2[attr_name];
					if (val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2) {
						match = false;
					}
				}
			}
			return match;
		}
	};

	/**
	 * Avoids using wp.template where possible in order to be CSP compliant.
	 * wp.template uses internally eval().
	 * @param {string} templateId
	 * @return {Function}
	 */
	var wp_template = function (templateId) {
		var html = document.getElementById('tmpl-' + templateId).textContent;
		var hard = false;
		// any <# #> interpolate (evaluate).
		hard = hard || /<#\s?data\./.test(html);
		// any data that is NOT data.variation.
		hard = hard || /{{{?\s?data\.(?!variation\.).+}}}?/.test(html);
		// any data access deeper than 1 level e.g.
		// data.variation.object.item
		// data.variation.object['item']
		// data.variation.array[0]
		hard = hard || /{{{?\s?data\.variation\.[\w-]*[^\s}]/.test(html);
		if (hard) {
			return wp.template(templateId);
		}
		return function template(data) {
			var variation = data.variation || {};
			return html.replace(/({{{?)\s?data\.variation\.([\w-]*)\s?(}}}?)/g, function (_, open, key, close) {
				// Error in the format, ignore.
				if (open.length !== close.length) {
					return '';
				}
				var replacement = variation[key] || '';
				// {{{ }}} => interpolate (unescaped).
				// {{  }}  => interpolate (escaped).
				// https://codex.wordpress.org/Javascript_Reference/wp.template
				if (open.length === 2) {
					return window.escape(replacement);
				}
				return replacement;
			});
		};
	};

})(jQuery, window, document);