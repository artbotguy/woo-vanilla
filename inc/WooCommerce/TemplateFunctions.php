<?php

namespace Awps\WooCommerce;

use Awps\WooVanilla\Functions;

class TemplateFunctions
{
  private $woowanilla_functions;

  public function __construct()
  {
    $this->woowanilla_functions = new Functions;
  }

  public function woovanilla_product_categories($args)
  {
    $args = apply_filters(
      'woovanilla_product_categories_args',
      array(
        'limit'            => 3,
        'columns'          => 3,
        'child_categories' => 0,
        'orderby'          => 'menu_order',
        'title'            => __('Shop by Category', 'woovanilla'),
      )
    );

    $shortcode_content = [$this->woowanilla_functions, 'woovanilla_do_shortcode'](
      'product_categories',
      apply_filters(
        'woovanilla_product_categories_shortcode_args',
        array(
          'number'  => intval($args['limit']),
          'columns' => intval($args['columns']),
          'orderby' => esc_attr($args['orderby']),
          'parent'  => esc_attr($args['child_categories']),
        )
      )
    );

    /**
     * Only display the section if the shortcode returns product categories
     */
    if (false !== strpos($shortcode_content, 'product-category')) {
      echo '<section class="woovanilla-product-section woovanilla-product-categories" aria-label="' . esc_attr__('Product Categories', 'woovanilla') . '">';

      do_action('woovanilla_homepage_before_product_categories');

      echo '<h2 class="section-title">' . wp_kses_post($args['title']) . '</h2>';

      do_action('woovanilla_homepage_after_product_categories_title');

      echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

      do_action('woovanilla_homepage_after_product_categories');

      echo '</section>';
    }
  }

  public function woovanilla_recent_products($args)
  {
    $args = apply_filters(
      'woovanilla_recent_products_args',
      array(
        'limit'   => 4,
        'columns' => 4,
        'orderby' => 'date',
        'order'   => 'desc',
        'title'   => __('New In', 'woovanilla'),
      )
    );

    $shortcode_content = [$this->woowanilla_functions, 'woovanilla_do_shortcode'](
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
      echo '<section class="woovanilla-product-section woovanilla-recent-products" aria-label="' . esc_attr__('Recent Products', 'woovanilla') . '">';

      do_action('woovanilla_homepage_before_recent_products');

      echo '<h2 class="section-title">' . wp_kses_post($args['title']) . '</h2>';

      do_action('woovanilla_homepage_after_recent_products_title');

      echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

      do_action('woovanilla_homepage_after_recent_products');

      echo '</section>';
    }
  }

  function woovanilla_promoted_products($per_page = '2', $columns = '2', $recent_fallback = true)
  {
    // if (woovanilla_is_woocommerce_activated()) {

    if (wc_get_featured_product_ids()) {

      echo '<h2>' . esc_html__('Featured Products', 'woovanilla') . '</h2>';

      // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
      echo [$this->woowanilla_functions, 'woovanilla_do_shortcode'](
        'featured_products',
        array(
          'per_page' => $per_page,
          'columns'  => $columns,
        )
      );
      // phpcs:enable
    } elseif (wc_get_product_ids_on_sale()) {

      echo '<h2>' . esc_html__('On Sale Now', 'woovanilla') . '</h2>';

      // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
      echo [$this->woowanilla_functions, 'woovanilla_do_shortcode'](
        'sale_products',
        array(
          'per_page' => $per_page,
          'columns'  => $columns,
        )
      );
      // phpcs:enable
    } elseif ($recent_fallback) {

      echo '<h2>' . esc_html__('New In Store', 'woovanilla') . '</h2>';

      // phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
      echo [$this->woowanilla_functions, 'woovanilla_do_shortcode'](
        'recent_products',
        array(
          'per_page' => $per_page,
          'columns'  => $columns,
        )
      );
      // phpcs:enable
    }
    // }
  }
}
