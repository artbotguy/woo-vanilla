<?php
/**
 * Single Product Image
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$product_images_src = get_all_images_product_src();
?>
<div class="wv-single-product__sliders wv-swiper-parent">
	<div class="swiper wv-slider-single-product" id="wv-slider-single-product-<?php echo esc_attr( $product->get_id() ); ?>">
		<div class="swiper-wrapper">
		<?php foreach ( $product_images_src as $src ) : ?>
			<div class="swiper-slide">
			<picture>
				<source srcset="" type="image/webp">
				<source srcset="" type="image/jpeg">
				<img src="<?php echo esc_attr( $src ); ?>" alt="">
			</picture>
			</div>
		<?php endforeach; ?>
		</div>
	
	
	</div>
	<div thumbsSlider="" class="swiper wv-slider-thumb-single-product" id="wv-slider-thumb-single-product-<?php echo esc_attr( $product->get_id() ); ?>">
		<div class="swiper-wrapper">
		<?php foreach ( $product_images_src as $src ) : ?>
			<div class="swiper-slide">
			<picture>
				<source srcset="" type="image/webp">
				<source srcset="" type="image/jpeg">
				<img src="<?php echo esc_attr( $src ); ?>" alt="">
			</picture>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</div>
