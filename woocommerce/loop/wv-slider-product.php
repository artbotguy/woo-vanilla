<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>

<div class="swiper wv-slider-product woocommerce-loop-product__slider" id="wv-slider-product-<?php echo esc_attr( $product->get_id() ); ?>">
  <div class="swiper-wrapper">
	<?php foreach ( $product_images_src as $src ) : ?>
	  <div class="swiper-slide _img-container">
		<picture>
		  <source srcset="" type="image/webp">
		  <source srcset="" type="image/jpeg">
		  <img src="<?php echo esc_attr( $src ); ?>" alt="">
		</picture>
	  </div>
	<?php endforeach; ?>
  </div>
  <div class="swiper-pagination"></div>
</div>
