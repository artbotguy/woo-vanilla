<?php
/**
 * Functions
 *
 * @package WooVanilla
 */


/**
 * Функция крепится к хуку, и служит для добавления к response, вызываемого TInvWL_Public_AddToWishlist::add_to_wishlist(),
 * свойства content, которое представляет себя отрендеренный wl со всеми продуктами, после добавления продукта
 * Нужен для того, чтобы обновлялся wl, когда он используется как offcanvas с помощью ajax
 *
 * @param array $data the comment param.
 */
function wv_add_content_response_body_add_to_wishlist( $data = array() ) {
	$data['content'] = tinvwl_shortcode_view();
	return $data;
}

/**
 * Undocumented function
 *
 * @return array list links images
 */
function get_all_images_product_src() {
		 global $product;

	return array_map(
		function ( $id ) {
			return wp_get_attachment_url( $id );
		},
		array_merge( $product->get_gallery_image_ids(), array( $product->get_image_id() ) )
	);
}

/**
 * Undocumented function
 *
 * @param [type] $tag the comment param.
 * @param array  $atts the comment param.
 * @param [type] $content the comment param.
 */
function woovanilla_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;

	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}

	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

/**
 * FROM AWPS
 */

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Var_dump and die method
	 *
	 * @return void
	 */
	function dd() {
		 echo '<pre>';
		array_map(
			function ( $x ) {
				var_dump( $x );
			},
			func_get_args()
		);
		echo '</pre>';
		die;
	}
}

if ( ! function_exists( 'starts_with' ) ) {
	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param  string       $haystack
	 * @param  string|array $needles
	 * @return bool
	 */
	function starts_with( $haystack, $needles ) {
		foreach ( (array) $needles as $needle ) {
			if ( $needle != '' && substr( $haystack, 0, strlen( $needle ) ) === (string) $needle ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'mix' ) ) {
	/**
	 * Get the path to a versioned Mix file.
	 *
	 * @param  string $path
	 * @param  string $manifestDirectory
	 * @return \Illuminate\Support\HtmlString
	 *
	 * @throws \Exception
	 */
	function mix( $path, $manifestDirectory = '' ) {
		if ( ! $manifestDirectory ) {
			// Setup path for standard AWPS-Folder-Structure
			$manifestDirectory = 'assets/dist/';
		}
		static $manifest;
		if ( ! starts_with( $path, '/' ) ) {
			$path = "/{$path}";
		}
		if ( $manifestDirectory && ! starts_with( $manifestDirectory, '/' ) ) {
			$manifestDirectory = "/{$manifestDirectory}";
		}
		$rootDir = dirname( __FILE__, 2 );
		if ( file_exists( $rootDir . '/' . $manifestDirectory . '/hot' ) ) {
			return getenv( 'WP_SITEURL' ) . ':8080' . $path;
		}
		if ( ! $manifest ) {
			$manifestPath = $rootDir . $manifestDirectory . 'mix-manifest.json';
			if ( ! file_exists( $manifestPath ) ) {
				throw new Exception( 'The Mix manifest does not exist.' );
			}
			$manifest = json_decode( file_get_contents( $manifestPath ), true );
		}

		if ( starts_with( $manifest[ $path ], '/' ) ) {
			$manifest[ $path ] = ltrim( $manifest[ $path ], '/' );
		}

		$path = $manifestDirectory . $manifest[ $path ];

		return get_template_directory_uri() . $path;
	}
}

if ( ! function_exists( 'assets' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * @param  string $path
	 */
	function assets( $path ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_directory_uri() . '/assets/dist/' . $path;
	}
}

if ( ! function_exists( 'svg' ) ) {
	/**
	 * Easily point to the assets dist folder.
	 *
	 * Exemple: assets/dist/images/svg/icons/inline-benifits-24-7.svg.php => benifits-24-7
	 *
	 *   *
	 *
	 * @param  string $path
	 */
	function svg( $path, $subfolder = '' ) {
		if ( ! $path ) {
			return;
		}

		echo get_template_part(
			'assets/dist/images/svg/' .
			( empty( $subfolder ) ? '' : ( $subfolder . '/' ) ) .
			'inline',
			$path . '.svg'
		);
	}
}

/**
 * Undocumented function
 *
 * @param array $args the comment param.
 */
function wv_nav_menu( $args = array() ) {
	static $menu_id_slugs = array();

	$defaults = array(
		'menu'                        => '',
		'container'                   => 'div',
		'container_class'             => '',
		'container_id'                => '',
		'container_aria_label'        => '',
		'menu_class'                  => 'menu',
		'menu_id'                     => '',
		'echo'                        => true,
		'fallback_cb'                 => 'wp_page_menu',
		'before'                      => '',
		'after'                       => '',
		'link_before'                 => '',
		'link_after'                  => '',
		'items_wrap'                  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'item_spacing'                => 'preserve',
		'depth'                       => 0,
		'walker'                      => '',
		'theme_location'              => '',
		'wv_bootstrap_type_component' => '',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! in_array( $args['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
		// Invalid value, fall back to default.
		$args['item_spacing'] = $defaults['item_spacing'];
	}

	/**
	 * Filters the arguments used to display a navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @see wv_nav_menu()
	 *
	 * @param array $args Array of wv_nav_menu() arguments.
	 */
	$args = apply_filters( 'wv_nav_menu_args', $args );
	$args = (object) $args;

	/**
	 * Filters whether to short-circuit the wv_nav_menu() output.
	 *
	 * Returning a non-null value from the filter will short-circuit wv_nav_menu(),
	 * echoing that value if $args->echo is true, returning that value otherwise.
	 *
	 * @since 3.9.0
	 *
	 * @see wv_nav_menu()
	 *
	 * @param string|null $output Nav menu output to short-circuit with. Default null.
	 * @param stdClass    $args   An object containing wv_nav_menu() arguments.
	 */
	$nav_menu = apply_filters( 'pre_wv_nav_menu', null, $args );

	if ( null !== $nav_menu ) {
		if ( $args->echo ) {
			echo $nav_menu;
			return;
		}

		return $nav_menu;
	}

	// Get the nav menu based on the requested menu.
	$menu = wp_get_nav_menu_object( $args->menu );

	// Get the nav menu based on the theme_location.
	$locations = get_nav_menu_locations();
	if ( ! $menu && $args->theme_location && $locations && isset( $locations[ $args->theme_location ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
	}

	// Get the first menu that has items if we still can't find a menu.
	if ( ! $menu && ! $args->theme_location ) {
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			$menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) );
			if ( $menu_items ) {
				$menu = $menu_maybe;
				break;
			}
		}
	}

	if ( empty( $args->menu ) ) {
		$args->menu = $menu;
	}

	// If the menu exists, get its items.
	if ( $menu && ! is_wp_error( $menu ) && ! isset( $menu_items ) ) {
		$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
	}

	/*
	 * If no menu was found:
	 *  - Fall back (if one was specified), or bail.
	 *
	 * If no menu items were found:
	 *  - Fall back, but only if no theme location was specified.
	 *  - Otherwise, bail.
	 */
	if ( ( ! $menu || is_wp_error( $menu ) || ( isset( $menu_items ) && empty( $menu_items ) && ! $args->theme_location ) )
		&& isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) ) {
			return call_user_func( $args->fallback_cb, (array) $args );
	}

	if ( ! $menu || is_wp_error( $menu ) ) {
		return false;
	}

	$nav_menu = '';
	$items    = '';

	$show_container = false;
	if ( $args->container ) {
		/**
		 * Filters the list of HTML tags that are valid for use as menu containers.
		 *
		 * @since 3.0.0
		 *
		 * @param string[] $tags The acceptable HTML tags for use as menu containers.
		 *                       Default is array containing 'div' and 'nav'.
		 */
		$allowed_tags = apply_filters( 'wv_nav_menu_container_allowedtags', array( 'div', 'nav' ) );

		if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags, true ) ) {
			$show_container = true;
			$class          = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-' . $menu->slug . '-container"';
			$id             = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
			$aria_label     = ( 'nav' === $args->container && $args->container_aria_label ) ? ' aria-label="' . esc_attr( $args->container_aria_label ) . '"' : '';
			$nav_menu      .= '<' . $args->container . $id . $class . $aria_label . '>';
		}
	}

	// Set up the $menu_item variables.
	_wp_menu_item_classes_by_context( $menu_items );

	$sorted_menu_items        = array();
	$menu_items_with_children = array();
	foreach ( (array) $menu_items as $menu_item ) {
		/*
		 * Fix invalid `menu_item_parent`. See: https://core.trac.wordpress.org/ticket/56926.
		 * Compare as strings. Plugins may change the ID to a string.
		 */
		if ( (string) $menu_item->ID === (string) $menu_item->menu_item_parent ) {
			$menu_item->menu_item_parent = 0;
		}

		$sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
		if ( $menu_item->menu_item_parent ) {
			$menu_items_with_children[ $menu_item->menu_item_parent ] = true;
		}
	}

	// Add the menu-item-has-children class where applicable.
	if ( $menu_items_with_children ) {
		foreach ( $sorted_menu_items as &$menu_item ) {
			if ( isset( $menu_items_with_children[ $menu_item->ID ] ) ) {
				$menu_item->classes[] = 'menu-item-has-children';
			}
		}
	}

	unset( $menu_items, $menu_item );

	/**
	 * Filters the sorted list of menu item objects before generating the menu's HTML.
	 *
	 * @since 3.1.0
	 *
	 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 * @param stdClass $args              An object containing wv_nav_menu() arguments.
	 */
	$sorted_menu_items = apply_filters( 'wv_nav_menu_objects', $sorted_menu_items, $args );

	$items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
	unset( $sorted_menu_items );

	// Attributes.
	if ( ! empty( $args->menu_id ) ) {
		$wrap_id = $args->menu_id;
	} else {
		$wrap_id = 'menu-' . $menu->slug;

		while ( in_array( $wrap_id, $menu_id_slugs, true ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) ) {
				$wrap_id = preg_replace( '#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			} else {
				$wrap_id = $wrap_id . '-1';
			}
		}
	}
	$menu_id_slugs[] = $wrap_id;

	$wrap_class = $args->menu_class ? $args->menu_class : '';

	/**
	 * Filters the HTML list content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @see wv_nav_menu()
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wv_nav_menu() arguments.
	 */
	$items = apply_filters( 'wv_nav_menu_items', $items, $args );
	/**
	 * Filters the HTML list content for a specific navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @see wv_nav_menu()
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wv_nav_menu() arguments.
	 */
	$items = apply_filters( "wv_nav_menu_{$menu->slug}_items", $items, $args );

	// Don't print any markup if there are no items at this point.
	if ( empty( $items ) ) {
		return false;
	}

	$nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
	unset( $items );

	if ( $show_container ) {
		$nav_menu .= '</' . $args->container . '>';
	}

	/**
	 * Filters the HTML content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @see wv_nav_menu()
	 *
	 * @param string   $nav_menu The HTML content for the navigation menu.
	 * @param stdClass $args     An object containing wv_nav_menu() arguments.
	 */
	$nav_menu = apply_filters( 'wv_nav_menu', $nav_menu, $args );

	if ( $args->echo ) {
		echo $nav_menu;
	} else {
		return $nav_menu;
	}
}

/**
 * Функция в точности копирует блок кода из TInvWL_Public_TInvWL::enqueue_scripts()
 */
function wv_get_localize_args_public() {
			$args = array(
				'text_create'                => __( 'Create New', 'ti-woocommerce-wishlist' ),
				'text_already_in'            => apply_filters( 'tinvwl_already_in_wishlist_text', tinv_get_option( 'general', 'text_already_in' ) ),
				'simple_flow'                => tinv_get_option( 'general', 'simple_flow' ),
				'hide_zero_counter'          => tinv_get_option( 'topline', 'hide_zero_counter' ),
				'i18n_make_a_selection_text' => esc_attr__( 'Please select some product options before adding this product to your wishlist.', 'ti-woocommerce-wishlist' ),
				'tinvwl_break_submit'        => esc_attr__( 'No items or actions are selected.', 'ti-woocommerce-wishlist' ),
				'tinvwl_clipboard'           => esc_attr__( 'Copied!', 'ti-woocommerce-wishlist' ),
				'allow_parent_variable'      => apply_filters( 'tinvwl_allow_add_parent_variable_product', false ),
				'block_ajax_wishlists_data'  => apply_filters( 'tinvwl_block_ajax_wishlists_data', false ),
				'update_wishlists_data'      => apply_filters( 'tinvwl_update_wishlists_data', false ),
				'hash_key'                   => 'ti_wishlist_data_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ),
				'nonce'                      => wp_create_nonce( 'wp_rest' ),
				'rest_root'                  => esc_url_raw( get_rest_url() ),
				'plugin_url'                 => esc_url_raw( TINVWL_URL ),
				'wc_ajax_url'                => WC_AJAX::get_endpoint( 'tinvwl' ),
				'stats'                      => tinv_get_option( 'general', 'product_stats' ),
				'popup_timer'                => apply_filters( 'tinvwl_popup_close_timer', 6000 ),
			);

			if ( function_exists( 'wpml_get_current_language' ) ) {

				global $sitepress;

				if ( $sitepress && $sitepress instanceof SitePress ) {
					$wpml_settings = $sitepress->get_settings();
					if ( isset( $wpml_settings['custom_posts_sync_option'] ) && isset( $wpml_settings['custom_posts_sync_option']['product'] ) && in_array(
						$wpml_settings['custom_posts_sync_option']['product'],
						array(
							1,
							2,
						)
					) ) {

						if ( 2 == $wpml_settings['custom_posts_sync_option']['product'] ) {
							$args['wpml_default'] = wpml_get_default_language();
						}
						$args['wpml'] = wpml_get_current_language();
					}
				}
			}
			return $args;
}

if ( class_exists( 'Xoo_Wsc_Loader' ) ) {
	/**
	 * Undocumented function
	 */
	function wv_set_ajax_fragments() {

		WC()->cart->calculate_totals();

		ob_start();
		xoo_wsc_helper()->get_template( 'xoo-wsc-container.php' );
		$container = ob_get_clean();

		ob_start();
		xoo_wsc_helper()->get_template( 'xoo-wsc-slider.php' );
		$slider = ob_get_clean();

		ob_start();
		xoo_wsc_helper()->get_template( 'global/footer/totals.php' );
		$wv_totals = ob_get_clean();

		// ob_start();
		// echo '<span>' . xoo_wsc_cart()->get_cart_count() . '</span>';
		$wv_cart_count = '<span>' . xoo_wsc_cart()->get_cart_count() . '</span>';

		$fragments['div.xoo-wsc-container']                      = $container;
		$fragments['div.xoo-wsc-slider']                         = $slider;
		$fragments['.wv-header-main-cart .xoo-wsc-ft-totals']    = $wv_totals;
		$fragments['header .wv-cart-count span'] = $wv_cart_count;

		return $fragments;

	}
}
