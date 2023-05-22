<?php
/**
 * Template Hooks
 *
 * @package WooVanilla
 */


/**
 * Отключаем блок "Поделиться" и Header в вишлисте
 */
remove_action( 'tinvwl_after_wishlist', array( 'TInvWL_Public_Wishlist_Social', 'init' ) );
remove_action( 'tinvwl_before_wishlist', array( TInvWL_Public_Wishlist_View::instance(), 'wishlist_header' ) );



/**
 * Homepage
 */
// add_action( 'homepage', 'woovanilla_recent_products', 0 );

/**
 *  Product Loop Catalog
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );



// add_action( 'woocommerce_before_shop_loop_item_title', 'woovanilla_template_product_loop_slider', 10 );

// add_action( 'woovanilla_before_shop_loop_item_head', 'woovanilla_show_product_loop_labels', 10 );
// add_action( 'woovanilla_before_shop_loop_item_head', 'tinvwl_view_addto_htmlloop', 10 );
// add_action( 'woovanilla_before_shop_loop_item_head', 'woovanilla_template_product_loop_preview_btn', 10 );


// add_action( 'woocommerce_after_shop_loop_item_title', 'woovanilla_template_rating', 10 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'woovanilla_template_loop_item_delivery_time_waiting', 10 );

// add_action( 'woovanilla_shop_loop_item_footer', 'woovanilla_variable_add_to_cart', 10 );


/**
 * Product Loop Slider
 */
		// add_action( 'woocommerce_after_shop_loop_item_slider_title', 'woocommerce_template_loop_price' );




/**
 * Slider Product
 */
add_action( 'woovanilla_before_product_slider', 'woovanilla_template_product_slider_open' );
add_action( 'woovanilla_product_slider', 'woovanilla_template_product_slider_body' );
add_action( 'woovanilla_product_slider_additional', 'woovanilla_show_product_slider_pagination' );
add_action( 'woovanilla_after_product_slider', 'woovanilla_template_product_slider_close' );

/**
 * SINGLE PRODUCT
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

/**
 * Change order
 */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


/**
 * VARIATIONS
 */
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );

remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_single_variation_add_to_cart_button', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );




/**
 * Для вывода списка цветов нужен отдельный блок
 */
// add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );

/**
 * Подключаем, чтобы между вставить popover
 */
add_action( 'woocommerce_after_single_variation', 'woovanilla_variation_add_to_cart_button', 10 );

add_action( 'woocommerce_single_variation', 'woovanilla_single_variation', 10 );


/**
 * CATALOG
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


add_action( 'woocommerce_archive_description', 'woocommerce_catalog_ordering', 30 );


	/**
	 * PLUGINS
	 */

/**
 * Side Cart WooCommerce
 */
if ( class_exists( 'Xoo_Wsc_Loader' ) ) {
	remove_filter( 'woocommerce_add_to_cart_fragments', array( xoo_wsc_cart(), 'set_ajax_fragments' ) );
	remove_filter( 'woocommerce_update_order_review_fragments', array( xoo_wsc_cart(), 'set_ajax_fragments' ) );

	add_filter( 'woocommerce_add_to_cart_fragments', 'wv_set_ajax_fragments' );
	add_filter( 'woocommerce_update_order_review_fragments', 'wv_set_ajax_fragments' );

}

/**
 * FILTERS
 */


/**
 * Хук для того, чтобы в продуктах с одинаковой ценой показывалась цена
 */
add_filter( 'woocommerce_show_variation_price', '__return_true' );

add_filter( 'tinvwl_wishlist_button_after', 'woovanilla_tinvwl_wishlist_button_after' );

/**
 * Обновленные тайтлы сортировки
 */
add_filter( 'woocommerce_catalog_orderby', 'woovanilla_rename_sorting_option' );

/**
 * Вывод Cart Product name отдельно от Cart Product Meta
 */
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );


add_filter( 'tinvwl_addtowishlist_return_ajax', 'wv_add_content_response_body_add_to_wishlist' );
