<?php
/**
 * The template
 *
 * @package WooWanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;

$full_class = 'swiper-slide woocommerce-loop-product_type_slider woocommerce-loop-product placeholder';

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( $full_class, $product ); ?>>

	<div class="woocommerce-loop-product__head">
		<?php
			woovanilla_show_product_loop_labels();
			tinvwl_view_addto_htmlloop();
			woovanilla_template_product_loop_preview_btn();
		?>
	</div>
	<?php
		woocommerce_template_loop_product_link_open();
		woovanilla_template_product_loop_slider();
		woocommerce_template_loop_product_link_close();

		woocommerce_template_loop_product_title();

		woovanilla_template_product_attributes( array( 'pa_vysota', 'pa_shirina' ), ',' );
		woovanilla_variable_add_to_cart();
	?>
</div>
