<?php
/**
 * The template
 *
 * @package WooWanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;

$full_class = 'woocommerce-loop-product_type_catalog woocommerce-loop-product placeholder';

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class( $full_class, $product ); ?>>




	<div class="woocommerce-loop-product__imageble-content-wrapper _wv-swiper-parent">
	<div class="woocommerce-loop-product__head">
			<?php
			woovanilla_template_product_attributes( array( 'pa_vysota', 'pa_shirina' ) );
			woocommerce_template_single_excerpt();


			woovanilla_show_product_loop_labels();
			tinvwl_view_addto_htmlloop();
			woovanilla_template_product_loop_preview_btn();
			?>
	</div><!-- #woocommerce-loop-product__head -->
		<?php
			woocommerce_template_loop_product_link_open();
			woovanilla_template_product_loop_slider();
			woocommerce_template_loop_product_link_close();
		?>
		 
	</div><!-- #woocommerce-loop-product__imageble-content-wrapper -->
 <?php

	woocommerce_template_loop_product_title();
	?>
		 
		<div class="woocommerce-loop-product__reviews-and-time-waiting">
 <?php

	woovanilla_template_rating();
	woovanilla_template_loop_item_delivery_time_waiting();
	?>
		 
	</div><!-- #woocommerce-loop-product__reviews-and-time-waiting -->
		
	<?php woovanilla_variable_add_to_cart(); ?>


</div>
