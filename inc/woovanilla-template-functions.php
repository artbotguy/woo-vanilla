<?php
/**
 * WooVanilla template functions.
 *
 * @package WooVanilla
 */

require 'template-functions/wv-header-template-functions.php';

/**
 * Output the start of a product loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 * @return string
 */
function woovanilla_product_loop_start( $echo = true ) {
	ob_start();

	wc_set_loop_prop( 'loop', 0 );

	wc_get_template( 'loop/wv-loop-slider-start.php' );

	$loop_start = apply_filters( 'woocommerce_product_loop_start', ob_get_clean() );

	if ( $echo ) {
	  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $loop_start;
	} else {
		return $loop_start;
	}
}

/**
 * Output the end of a product loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 * @return string
 */
function woovanilla_product_loop_end( $echo = true ) {
	ob_start();

	wc_get_template( 'loop/wv-loop-slider-end.php' );

	$loop_end = apply_filters( 'woocommerce_product_loop_end', ob_get_clean() );

	if ( $echo ) {
	  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $loop_end;
	} else {
		return $loop_end;
	}
}

/**
 * Undocumented function
 *
 * @param [type] $args the comment param.
 */
function woovanilla_slider_products( $args = array(), $title = 'Товары', $shortcode_tag = 'products_slider', $classes = '' ) {
	$def_args = array(
		// 'per_page' => 10,
		// 'orderby'  => 'date',
		// 'order'    => 'asc',
	);
	$shortcode_content = woovanilla_do_shortcode(
		$shortcode_tag,
		array_merge( $def_args, $args )
	);

	/**
	 * Only display the section if the shortcode returns "products"
	 */
	if ( false !== strpos( $shortcode_content, 'product' ) ) {
		$link = '#';
		if ( isset( $args['wv_shortcode_type'] ) ) {
			$link = get_permalink( wc_get_page_id( 'shop' ) ) . '?wv_shortcode_type=' . $args['wv_shortcode_type'];
		}

		echo '<section class="wv-section-slider-products placeholder-wave _wv-swiper-parent">';

		echo '<a href="' . $link . '" class="placeholder">
			<div class="wv-section-slider-products__head">
							<h2 class="wv-section-slider-products__title _wv-spec-title">' . wp_kses_post( $title ) . '</h2>
							<div class="wv-section-slider-products__arrow">
								<svg class="wv-icon">
									<use xlink:href="#sprite-arrow-slider-section"></use>
								</svg>
							</div>
						</div>
		</a>';

		echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo '</section>';
	}
}

/**
 * Undocumented function
 */
function woovanilla_template_product_loop_slider() {

	wc_get_template(
		'loop/wv-slider-product.php',
		array(
			'product_images_src' => wv_get_all_images_product_src(),
		)
	);
}

/**
 * Undocumented function
 */
function woovanilla_show_product_loop_labels() {
	global $product;
	$output = '<div class="woocommerce-loop-product__labels">';
	if ( $product->is_featured() ) {
		$output .= '<div class="woocommerce-loop-product__label">Хит</div>';
	}
	if ( $product->is_on_sale() ) {
		$output .= '<div class="woocommerce-loop-product__label">- 30%</div>';
	}
	$output .= '</div>';
	echo $output;
}

/**
 * Undocumented function
 */
function woovanilla_template_product_loop_preview_btn() {
	echo '<div class="woocommerce-loop-product__preview-btn wv-link-item wv-link-item_type_circle">
    <svg class="wv-icon">
      <use xlink:href="#sprite-watch"></use>
    </svg>
    </div>';
}

/**
 * Undocumented function
 */
function woovanilla_template_product_attributes( $include = array(), $separator = '' ) {
	global $product;
	$args = array( 'separator' => $separator );
	if ( $product instanceof WC_Product_Variable ) {
			$args = array_merge(
				$args,
				array(
					'attribute_names' => array_keys(
						array_filter(
							$product->get_attributes(),
							function( $attr ) use ( $include ) {
								if ( ( ! $attr->get_variation() ) &&
								empty( $include ) ? true : ( array_search( $attr->get_name(), $include ) !== false )
								) {
									return true;
								}
							}
						)
					),
				)
			);
	} elseif ( $product instanceof WC_Product_Variation ) {
		$args = array_merge(
			$args,
			array(
				'attribute_names' => array_keys(
					$product->get_attributes()
				),
			)
		);
	}

	wc_get_template(
		'wv-universal-product/wv-product-attributes.php',
		$args
	);
}

/**
 * Undocumented function
 *
 * @param [type] $args contain $wv_loop_product_view_type
 */
function woovanilla_variable_add_to_cart( $args = array() ) {
	global $product;

	// Enqueue variation scripts.
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	// Get Available variations?
	$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

	// Load the template.
	wc_get_template(
		'wv-universal-product/add-to-cart/wv-variable.php',
		array_merge(
			array(
				'available_variations' => $get_variations ? $product->get_available_variations() : false,
				'attributes'           => $product->get_variation_attributes(),
				'selected_attributes'  => $product->get_default_attributes(),
			),
			$args
		)
	);
}

/**
 * Undocumented function
 *
 * @param [type] $wv_loop_product_view_type the comment param.
 * @return WC_Product_Variable|array
 */
function wv_get_variation( $wv_loop_product_view_type ) : WC_Product_Variable|array {
	global $product;
	if ( $product->is_type( 'variable' ) ) {
		if ( 'default' === $wv_loop_product_view_type ) {
			return $product->get_available_variations( 'object' );
		} elseif ( 'slider' === $wv_loop_product_view_type ) {
			return wc_get_product( $product->get_visible_children()[0] );
		}
	}
}


	/**
	 * Output a list of variation attributes for use in the cart forms.
	 *
	 * note: input:radio[checked=true] set. After js changing becomes not showing in DOM
	 * note: не реализована логика НЕ показывания не существующих комбинаций вариаций
	 *
	 * @param array $args Arguments.
	 * @since 2.4.0
	 */
function wv_radio_variation_attribute_options( $args = array() ) {
	$args = wp_parse_args(
		apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
		array(
			'options'          => false,
			'attribute'        => false,
			'product'          => false,
			'selected'         => false,
			'required'         => false,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'show_option_none' => __( 'Choose an option', 'woocommerce' ),
		)
	);

	// Get selected value.
	if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
		$selected_key = 'attribute_' . sanitize_title( $args['attribute'] );
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] );
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
	$id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
	$class                 = $args['class'];
	$required              = (bool) $args['required'];
	$show_option_none      = (bool) $args['show_option_none'];
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

	if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[ $attribute ];
	}

	$html = '';

	if ( ! empty( $options ) ) {
		if ( $product && taxonomy_exists( $attribute ) ) {
			// Get terms if this is a taxonomy - ordered. We need the names too.
			$terms = wc_get_product_terms(
				$product->get_id(),
				$attribute,
				array(
					'fields' => 'all',
				)
			);

			foreach ( $terms as $term ) {
				if ( in_array( $term->slug, $options, true ) ) {
					$html .=
					'<li class="' . $class . ' ' .
					' "><input class="" type="radio" ' .
					'name="' . $name . '" ' .
					'value="' .
					esc_attr( $term->slug ) . '" ' .
					( $term->slug === $args['selected'] ? 'checked ' : '' ) .
					'><label>' . esc_html(
						apply_filters(
							'woocommerce_variation_option_name',
							$term->name,
							$term,
							$attribute,
							$product
						)
					) .
					'</label></li>';
				}
			}
		} else {
			new \Exception( 'NOT REALIZE This handles < 2.4.0 bw compatibility where text attributes were not sanitized.' );
			// foreach ( $options as $option ) {
			// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
			// $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
			// $html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
			// }
		}
	}

	// $html .= '</select>';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args );
}

/**
 * Universal template for loop and single products
 */
function woovanilla_template_rating() {
	wc_get_template( 'wv-universal-product/rating.php' );
}

/**
 * Get HTML for ratings.
 *
 * @since  3.0.0
 * @param  float $rating Rating being shown.
 * @param  int   $count  Total number of ratings.
 * @return string
 */
function wv_get_rating_html( $rating, $count = 0 ) {
	$html = '';
	// if ( 0 < $rating ) {
		/* translators: %s: rating */
		$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
		$html  = '<div class="wv-rating-reviews__rating">
		<div class="wv-rating-reviews__rating-star-wrap wv-rating-reviews__rating-star-wrap_atfer_width_' . round( $rating ) . '">
		<svg class="wv-icon">
			<use xlink:href="#sprite-star"></use>
		</svg>		<svg class="wv-icon">
			<use xlink:href="#sprite-star"></use>
		</svg></div>
		<label>' . esc_html( round( $rating ) ) . '.0</label>
		</div>
';
		// '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) .
		// '</div>';
	// }

	return apply_filters( 'woocommerce_product_get_rating_html', $html, $rating, $count );
}

/**
 * Undocumented function
 *
 * @param integer $time the comment param.
 */
function woovanilla_template_loop_item_delivery_time_waiting() {
	printf(
		'<div class="woocommerce-loop-product__delivery-time-waiting">
	<span><span>%d</span> мин</span>
	</div>',
		150
	);
}


/**
 * Undocumented function
 */
function woovanilla_template_popover_info( $args = array(
	'wv-span-content' => 'скидка от кол-ва',
	'bs-content'      => 'Скидка от количества',
) ) {
	return printf(
		'
<div class="wv-popover placeholder"><span>%s</span><svg class="wv-icon" 
	role="button" 
	placement="top" 
	class="btn btn-lg btn-danger" 
	data-bs-trigger="click hover" 
	data-bs-toggle="popover" 
	data-bs-content="%s">
	<use xlink:href="#sprite-info"></use>	
</svg></div>',
		esc_html( $args['wv-span-content'] ),
		esc_html( $args['bs-content'] )
	);
}

/**
 * Undocumented function
 */
function woovanilla_template_buy_one_click() {
	echo '<a href="#" class="wv-buy-one-click placeholder"><span>Купить в 1 клик</span></a>';
}

/**
 * Undocumented function
 */
function woovanilla_template_ordering_info() {
	wc_get_template( 'global/wv-ordering-info.php' );
}

// /**
// WVNote: DEPR??? - мб в эой логике нет смысла (в добавлении woocommerce_template_loop_price)
// * Функция выводит шаблон, в которм присутствует данные о цене из бекенда.
// * Затем из фронтенда происходит обновление внутреннего html - данные перезаписываются
// */
function woovanilla_single_variation() {
		$output = '<div class="wv-variation-sub-wrapper">';

			$output .= '<div class="woocommerce-variation single_variation wv-placeholder-ajax placeholder">';
		// woocommerce_template_loop_price(); // WVNote
		$output .= '</div>';
		$output .= '</div>';
			echo $output;
}


/**
 * Undocumented function
 */
function woovanilla_variation_add_to_cart_button( $args = array() ) {
	wc_get_template( 'wv-universal-product/add-to-cart/variation-add-to-cart-button.php', $args );
}

/**
 * Undocumented function
 */
function woovanilla_tinvwl_wishlist_button_after() {
	return '	<svg class="wv-icon">
		<use xlink:href="#sprite-wish"></use>
	</svg>';
}

/**
 * Обновленные тайтлы сортировки
 */
function woovanilla_rename_sorting_option( $options ) {
	// $options['rating'] = 'По рейтингу';
	// $options['date'] = 'По новизне';
	// $options['popularity'] = 'По популярности';
	$options['menu_order'] = 'Сортировка';
	$options['price']      = 'По возрастанию цены';
	$options['price-desc'] = 'По убыванию цены';
	return $options;
}


function woovanilla_breadcrumb( $args = array() ) {
			$args = wp_parse_args(
				$args,
				apply_filters(
					'woocommerce_breadcrumb_defaults',
					array(
						'delimiter'   => '&nbsp;&#47;&nbsp;',
						'wrap_before' => '<nav class="wv-breadcrumb placeholder-wave woocommerce-breadcrumb">',
						'wrap_after'  => '</nav>',
						'before'      => '',
						'after'       => '',
						'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
					)
				)
			);

		$breadcrumbs = new WC_Breadcrumb();

	if ( ! empty( $args['home'] ) ) {
		$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
	}

		$args['breadcrumb'] = $breadcrumbs->generate();

		/**
		 * WooCommerce Breadcrumb hook
		 *
		 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
		 */
		do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

		wc_get_template( 'global/breadcrumb.php', $args );
}

/**
 * Функция теперь принимает аргументы
 *
 * (была добавлена для возможности добавления класса для global/wrapper-start.php)
 *
 * @param [type] $args the comment param.
 */
function woovanilla_output_content_wrapper( $args = array() ) {
	wc_get_template( 'global/wrapper-start.php', $args );
}
