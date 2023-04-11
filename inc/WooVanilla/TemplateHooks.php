<?php

namespace Awps\WooVanilla;


class TemplateHooks
{
  private $tfc;

  public function __construct()
  {
    $this->homepage();
    $this->product_loop_items();
  }

  public function homepage()
  {
    add_action('homepage', 'woovanilla_recent_products', 0);
    add_action('homepage', 'woovanilla_catalog_products', 0);
  }

  public function product_loop_items()
  {
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);


    add_action('woocommerce_before_shop_loop_item_title', 'woovanilla_template_product_loop_slider', 10);

    add_action('woovanilla_before_shop_loop_item_head', 'woovanilla_show_product_loop_labels', 10);
    add_action('woovanilla_before_shop_loop_item_head', 'tinvwl_view_addto_htmlloop', 10);
    add_action('woovanilla_before_shop_loop_item_head', 'woovanilla_template_product_loop_preview', 10);

    add_action('woovanilla_before_shop_loop_item_actions', 'woovanilla_before_shop_loop_item_actions', 10);


    add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 10);
  }

  public function product()
  {
    add_action('woovanilla_before_product_slider', 'woovanilla_template_product_slider_open');
    add_action('woovanilla_product_slider', 'woovanilla_template_product_slider_body');
    add_action('woovanilla_product_slider_additional', 'woovanilla_show_product_slider_pagination');
    add_action('woovanilla_after_product_slider', 'woovanilla_template_product_slider_close');
  }
}
