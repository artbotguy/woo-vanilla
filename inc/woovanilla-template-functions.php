<?php
/**
 * WooVanilla template functions.
 *
 * @package WooVanilla
 */

/**
 * Output the start of a product loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 * @return string
 */
function woovanilla_product_loop_start( $echo = true ) {
	ob_start();

	wc_set_loop_prop( 'loop', 0 );

	wc_get_template( 'loop/loop-slider-start.php' );

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

	wc_get_template( 'loop/loop-slider-end.php' );

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
function woovanilla_recent_products( $args ) {
	$args = apply_filters(
		'woovanilla_recent_products_args',
		array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'date',
			'order'   => 'desc',
			'title'   => __( 'Новинки', 'woovanilla' ),
		// 'cache' => false,
		)
	);

	$shortcode_content = woovanilla_do_shortcode(
		'products_slider',
		apply_filters(
			'woovanilla_recent_products_shortcode_args',
			array(
				'orderby'  => esc_attr( $args['orderby'] ),
				'order'    => esc_attr( $args['order'] ),
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			)
		)
	);

	/**
	 * Only display the section if the shortcode returns products
	 */
	if ( false !== strpos( $shortcode_content, 'product' ) ) {
		echo '<section class="slider-products">';

		do_action( 'woovanilla_homepage_before_recent_products' );

		echo '<div class="slider-products__head">
        <h2 class="slider-products__title">' . wp_kses_post( $args['title'] ) . '</h2>
        <div class="slider-products__arrow">
          <svg class="icon">
            <use xlink:href="#sprite-arrow-long"></use>
          </svg>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>';

		do_action( 'woovanilla_homepage_after_recent_products_title' );

		echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		do_action( 'woovanilla_homepage_after_recent_products' );

		echo '</section>';
	}
}

/**
 * Undocumented function
 *
 * @param [type] $args the comment param.
 */
function woovanilla_catalog_products( $args ) {
	$args = apply_filters(
		'woovanilla_recent_products_args',
		array(
			'limit'   => 4,
			'columns' => 4,
			'orderby' => 'date',
			'order'   => 'desc',
			'title'   => __( 'Каталог', 'woovanilla' ),
		)
	);

	$shortcode_content = woovanilla_do_shortcode(
		'products',
		apply_filters(
			'woovanilla_recent_products_shortcode_args',
			array(
				'orderby'  => esc_attr( $args['orderby'] ),
				'order'    => esc_attr( $args['order'] ),
				'per_page' => intval( $args['limit'] ),
				'columns'  => intval( $args['columns'] ),
			)
		)
	);

	/**
	 * Only display the section if the shortcode returns products
	 */
	if ( false !== strpos( $shortcode_content, 'product' ) ) {
		echo '<section class="catalog-products">';

		echo '<div class="catalog-products__head">
        <h2 class="catalog-products__title">' . wp_kses_post( $args['title'] ) . '</h2>
      </div>';

		echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		echo '</section>';
	}
}

/**
 * Undocumented function
 */
function woovanilla_template_product_loop_slider() {

	wc_get_template(
		'wv-universal-product/slider-product.php',
		array(
			'product_images_src' => get_all_images_product_src(),
		)
	);
}

/**
 * Undocumented function
 */
function woovanilla_show_product_loop_labels() {
	echo '<div class="woocommerce-loop-product__labels"><div class="woocommerce-loop-product__label">Хит</div></div>';
}

/**
 * Undocumented function
 */
function woovanilla_template_product_loop_preview() {
	echo '<div class="woocommerce-loop-product__preview link-item link-item_type_circle">
    <svg class="icon icon_m">
      <use xlink:href="#sprite-watch"></use>
    </svg>
    </div>';
}

/**
 * Undocumented function
 */
function woovanilla_template_product_attributes() {
	global $product;
	wc_get_template(
		'wv-universal-product/wv-product-attributes.php',
		array(
			'attribute_names' => array_keys(
				array_filter(
					$product->get_attributes(),
					function( $attr ) {
						return ! $attr->get_variation();
					}
				)
			),
		)
	);
}

	/**
	 * Output the variable product add to cart area.
	 */
function woovanilla_variable_add_to_cart() {
	global $product;

	// Enqueue variation scripts.
	wp_enqueue_script( 'wc-add-to-cart-variation' );

	// Get Available variations?
	$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

	// Load the template.
	wc_get_template(
		'wv-universal-product/wv-variable.php',
		array(
			'available_variations' => $get_variations ? $product->get_available_variations() : false,
			'attributes'           => $product->get_variation_attributes(),
			'selected_attributes'  => $product->get_default_attributes(),
		)
	);
}

	/**
	 * Get the product price for the loop.
	 */
function woovanilla_template_loop_price() {
	wv_get_variation( $wv_loop_product_view_type );
	wc_get_template( 'loop/price.php' );
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
		$html  = '<div class="woocommerce-loop-product__rating"><label>' . esc_html( round( $rating ) ) . '.0</label>
		<div class="woocommerce-loop-product__rating-star-wrap woocommerce-loop-product__rating-star-wrap_atfer_width_' . round( $rating ) . '">
		<svg class="icon">
			<use xlink:href="#sprite-star"></use>
		</svg>		<svg class="icon">
			<use xlink:href="#sprite-star"></use>
		</svg></div></div>
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
	<span>%d мин</span>
	<svg class="icon">
		<use xlink:href="#sprite-delivery"></use>
	</svg>
	</div>',
		150
	);
}

/**
 * Undocumented function
 */
function woovanilla_template_popover_info( $args ) {
	printf(
		'
<div class="wv-popover"><span>%s</span><svg class="icon" 
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
function woovanilla_template_ordering_info() {
	wc_get_template( 'global/wv-ordering-info.php' );
}
