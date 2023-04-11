<?php

/**
 * Output the start of a product loop. By default this is a UL.
 *
 * @param bool $echo Should echo?.
 * @return string
 */
function woovanilla_product_loop_start($echo = true)
{
  ob_start();

  wc_set_loop_prop('loop', 0);

  wc_get_template('loop/loop-slider-start.php');

  $loop_start = apply_filters('woocommerce_product_loop_start', ob_get_clean());

  if ($echo) {
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
function woovanilla_product_loop_end($echo = true)
{
  ob_start();

  wc_get_template('loop/loop-slider-end.php');

  $loop_end = apply_filters('woocommerce_product_loop_end', ob_get_clean());

  if ($echo) {
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $loop_end;
  } else {
    return $loop_end;
  }
}

function woovanilla_recent_products($args)
{
  $args = apply_filters(
    'woovanilla_recent_products_args',
    array(
      'limit'   => 4,
      'columns' => 4,
      'orderby' => 'date',
      'order'   => 'desc',
      'title'   => __('Новинки', 'woovanilla'),
      // 'cache' => false,
    )
  );

  $shortcode_content = woovanilla_do_shortcode(
    'products_slider',
    apply_filters(
      'woovanilla_recent_products_shortcode_args',
      array(
        'orderby'  => esc_attr($args['orderby']),
        'order'    => esc_attr($args['order']),
        'per_page' => intval($args['limit']),
        'columns'  => intval($args['columns']),
      )
    )
  );

  /**
   * Only display the section if the shortcode returns products
   */
  if (false !== strpos($shortcode_content, 'product')) {
    echo '<section class="slider-products">';

    do_action('woovanilla_homepage_before_recent_products');

    echo '<div class="slider-products__head">
        <h2 class="slider-products__title">' . wp_kses_post($args['title']) . '</h2>
        <div class="slider-products__arrow">
          <svg class="icon">
            <use xlink:href="#sprite-arrow-long"></use>
          </svg>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>';

    do_action('woovanilla_homepage_after_recent_products_title');

    echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    do_action('woovanilla_homepage_after_recent_products');

    echo '</section>';
  }
}

function woovanilla_catalog_products($args)
{
  $args = apply_filters(
    'woovanilla_recent_products_args',
    array(
      'limit'   => 4,
      'columns' => 4,
      'orderby' => 'date',
      'order'   => 'desc',
      'title'   => __('Каталог', 'woovanilla'),
      // 'cache' => false,
    )
  );

  $shortcode_content = woovanilla_do_shortcode(
    'products',
    apply_filters(
      'woovanilla_recent_products_shortcode_args',
      array(
        'orderby'  => esc_attr($args['orderby']),
        'order'    => esc_attr($args['order']),
        'per_page' => intval($args['limit']),
        'columns'  => intval($args['columns']),
      )
    )
  );

  /**
   * Only display the section if the shortcode returns products
   */
  if (false !== strpos($shortcode_content, 'product')) {
    echo '<section class="catalog-products">';

    echo '<div class="catalog-products__head">
        <h2 class="catalog-products__title">' . wp_kses_post($args['title']) . '</h2>
      </div>';

    echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    echo '</section>';
  }
}

function woovanilla_template_product_loop_slider()
{
  global $product;

  $product_images_src = array_map(
    function ($id) {
      return wp_get_attachment_url($id);
    },
    array_merge($product->get_gallery_image_ids(), [$product->get_image_id()])
  );

  wv_get_template('loop/slider-product.php', ['product_images_src' => $product_images_src]);
}

function woovanilla_show_product_loop_labels()
{
  echo '<div class="woocommerce-loop-product__labels"><div class="woocommerce-loop-product__label">Хит</div></div>';
}

function woovanilla_template_product_loop_preview()
{
  echo '<div class="woocommerce-loop-product__preview link-item link-item_type_circle">
    <svg class="icon icon_m">
      <use xlink:href="#sprite-watch"></use>
    </svg>
    </div>';
}

function woovanilla_before_shop_loop_item_actions()
{
  global $product;

  $var_attrs = $product->get_variation_attributes();
  $sizes = $var_attrs['pa_razmer'];
  wv_get_template('loop/loop-product-catalog-actions.php', ['sizes' => $sizes]);
}
