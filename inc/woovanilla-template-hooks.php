<?php
/**
 * Template Hooks
 *
 * @package WooVanilla
 */

/**
 * Хук для того, чтобы в продуктах с одинаковой ценой показывалась цена
 */
add_filter( 'woocommerce_show_variation_price', '__return_true' );

/**
 * Homepage
 */
add_action( 'homepage', 'woovanilla_recent_products', 0 );
add_action( 'homepage', 'woovanilla_catalog_products', 0 );

/**
 *  Product Loop Catalog
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );



add_action( 'woocommerce_before_shop_loop_item_title', 'woovanilla_template_product_loop_slider', 10 );

add_action( 'woovanilla_before_shop_loop_item_head', 'woovanilla_show_product_loop_labels', 10 );
add_action( 'woovanilla_before_shop_loop_item_head', 'tinvwl_view_addto_htmlloop', 10 );
add_action( 'woovanilla_before_shop_loop_item_head', 'woovanilla_template_product_loop_preview', 10 );

add_action( 'woocommerce_after_shop_loop_item_title', 'woovanilla_template_rating', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woovanilla_template_loop_item_delivery_time_waiting', 10 );

add_action( 'woovanilla_shop_loop_item_footer', 'woovanilla_variable_add_to_cart', 10 );


/**
 * Product Loop Slider
 */

add_action( 'woocommerce_after_shop_loop_item_slider_title', 'woovanilla_template_product_attributes', 10 );



/**
 * Slider Product
 */
add_action( 'woovanilla_before_product_slider', 'woovanilla_template_product_slider_open' );
add_action( 'woovanilla_product_slider', 'woovanilla_template_product_slider_body' );
add_action( 'woovanilla_product_slider_additional', 'woovanilla_show_product_slider_pagination' );
add_action( 'woovanilla_after_product_slider', 'woovanilla_template_product_slider_close' );

/**
 * Single product
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

/**
 * Отключаем, чтобы подключить в хук woocommerce_after_single_variation
 */
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );


add_action( 'woocommerce_single_product_summary', 'woovanilla_template_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woovanilla_template_product_attributes', 15 );
add_action( 'woocommerce_single_product_summary', 'woovanilla_variable_add_to_cart', 30 );

/**
 * Подключаем, чтобы между вставить popover
 */
add_action( 'woocommerce_after_single_variation', 'woocommerce_single_variation_add_to_cart_button', 10 );



	/**
	 * PLUGINS
	 */

	/**
	 * Side Cart WooCommerce
	 */
