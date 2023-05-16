<?php
/**
 * The template for displaying product content within loops
 *
 * $wv_loop_product_view_type Variable, defining view type. Theme has 2 view type loop products. Default is catalog. Specific is slider loop product
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
	<?php

	echo '<div class="woocommerce-loop-product__head">';

	woovanilla_show_product_loop_labels();
	 tinvwl_view_addto_htmlloop();
	woovanilla_template_product_loop_preview_btn();
	echo '</div>'; // END - woocommerce-loop-product__head

	// woovanilla_template_loop_product_link_open();
	woocommerce_template_loop_product_link_open();

	woovanilla_template_product_loop_slider();


	woocommerce_template_loop_product_link_close();


	woovanilla_template_product_attributes( array( 'pa_vysota', 'pa_shirina' ), ',' );


	woovanilla_variable_add_to_cart();

	?>


</div>
