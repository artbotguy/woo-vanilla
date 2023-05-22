<?php
/**
 * Variable product add to cart
 *
 * @package WooCommerce\Templates
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

?>
<form class="wv-variable variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<div class="wv-variations" cellspacing="0" role="presentation">
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<div class="wv-variations__item wv-variations__item_<?php echo $attribute_name; ?>" >
						<label class="wv-variations__label" for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
						<?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?><span class="_wv-sepr">:</span></label>
						<ul class="wv-variations__list">
							<?php
								wv_radio_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
										'class'     => 'wv-variations__sub-item',
									)
								);
							?>
						</ul>
					</div>
				<?php endforeach; ?>
		</div>

		<div class="wv-single-variation-wrap single_variation_wrap">
			<?php
							/**
							 * Hook: woocommerce_before_single_variation.
							 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 *
				 * @hooked woovanilla_variation_add_to_cart_button - 10 Qty and cart button.
				 */
				do_action( 'woocommerce_after_single_variation' );


			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
