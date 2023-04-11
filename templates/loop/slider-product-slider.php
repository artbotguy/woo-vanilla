<?php

if (!defined('ABSPATH')) {
  exit;
}

global $product;
?>

<div id="slider-product-<?php echo esc_attr($product->get_id()); ?>" class="swiper slider-product">
  <div class="swiper-wrapper">
    <?php foreach ($product_images_src as $src) : ?>
      <div class="swiper-slide">
        <picture>
          <source srcset="" type="image/webp">
          <source srcset="" type="image/jpeg">
          <img src="<?php echo esc_attr($src); ?>" alt="">
        </picture>
      </div>
    <?php endforeach; ?>
  </div>
</div>