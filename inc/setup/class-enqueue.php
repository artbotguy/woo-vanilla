<?php
/**
 * Enqueue
 *
 * @package WooVanilla
 */

namespace WooVanilla\Setup;

/**
 * Enqueue.
 */
class Enqueue {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Notice the mix() function in wp_enqueue_...
	 * It provides the path to a versioned asset by Laravel Mix using querystring-based
	 * cache-busting (This means, the file name won't change, but the md5. Look here for
	 * more information: https://github.com/JeffreyWay/laravel-mix/issues/920 )
	 *
	 * Проблема с переопределением (?) подключения скрипта может возникать с wp_deregister_script()
	 * из-за невыясненных несоответствий - например, с jquery
	 */
	public function enqueue_scripts() {
		$version = time();
		
		wp_deregister_style( 'tinvwl' );
		wp_deregister_style( 'tinvwl-theme' );
		wp_deregister_style( 'tinvwl-webfont-font' );
		wp_deregister_style( 'tinvwl-webfont' );

		wp_deregister_style( 'xoo-wsc-fonts' );
		wp_deregister_style( 'xoo-wsc-style' );


		// WV fonts
		wp_enqueue_style( 'gf-yeseva-one', 'https://fonts.googleapis.com/css?family=Yeseva+One:regular', array(), $version );
		wp_enqueue_style( 'gf-inter', 'https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900)', array(), $version );

		// $wv_fonts_filenames = scandir( get_template_directory() . '/assets/dist/fonts' );
		// for ( $i = 0; $i < count( $wv_fonts_filenames ); $i++ ) {
		// $filename = $wv_fonts_filenames[ $i ];
		// if ( strpos( $wv_fonts_filenames[ $i ], '.woff' ) ) {
		// wp_enqueue_style( 'wv-font' . $i, get_stylesheet_directory_uri() . '/assets/dist/fonts/' . $filename, array(), $version );
		// }
		// }

		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', array(), $version, 'all' );
		
		// wp_enqueue_style( 'wv-main-css', mix( 'css/style.css' ), array(), $version, 'all' );
		wp_enqueue_style( 'wv-main-css',  get_stylesheet_directory_uri() . '/assets/dist/css/style.css' , array(), $version, 'all' );

		// JS
		/**
		 * Main script
		 *  WVNote: need jq cut from this bundle
		 */
		// wp_enqueue_script( 'wv-main-js', mix( 'js/app.js' ), array(), $version, true );
		wp_enqueue_script( 'wv-main-js', get_stylesheet_directory_uri() . '/assets/src/scripts/app.js', array( 'jquery' ), $version, 'all' );

		wp_localize_script(
			'wv-main-js',
			'__WooVanilla__',
			array(
				'customSliders' => (object) array(
					'sliderProducts' => array(
						array(
							'selector' => 'wv-slider-products_type_sliders-home',
							'options'  => array(
								'slidesPerView' => 1,
								'breakpoints'   => (object) array(),
							),
						),
					),
				),
			),
		);

		/**
		 * WC
		 *
		 * note: Мб Webpack dev почему-то из-за подключенного через mix() файла препятсвет корректоной работе HMR для стилей
		 */

		/**
		 * Note: Сложности с подлючением, мб из-за локальных подключений в файлах php-шаблонов
		 * Так же не ясно как подключается public.js и admin.js- найден только handele = 'tinwvl' aka. _name
		 */

		wp_deregister_script( 'tinvwl' );
		wp_register_script( 'tinvwl', get_stylesheet_directory_uri() . '/assets/src/scripts/wp/tinvwl-public.js', array( 'jquery', 'jquery-blockui', 'js-cookie', apply_filters( 'tinvwl_wc_cart_fragments_enabled', true ) ? 'wc-cart-fragments' : 'jquery' ), $version, 'all' );
		wp_localize_script( 'tinvwl', 'tinvwl_add_to_wishlist', wv_get_localize_args_public() );
		// // wp_enqueue_script( 'tinvwl', mix( 'js/tinvwl-public.js' ), array( 'jquery', 'wp-color-picker' ), $version, true );
		// // wp_enqueue_script( 'tinvwl', get_stylesheet_directory_uri() . '/assets/dist/js/tinvwl-public.js', array('jquery', 'wp-color-picker' ), $version, 'all' );

		wp_deregister_script( 'xoo-wsc-main-js' );
		// wp_enqueue_script( 'xoo-wsc-main-js', mix( 'js/xoo-wsc-main.js' ), array( 'jquery' ), $version, true );
		wp_enqueue_script( 'xoo-wsc-main-js', get_stylesheet_directory_uri() . '/assets/src/scripts/wp/xoo-wsc-main.js', array( 'jquery' ), $version, 'all' );

		wp_deregister_script( 'wc-add-to-cart-variation' );
		// wp_enqueue_script( 'wc-add-to-cart-variation', mix( 'js/add-to-cart-variation.js' ), array( 'wp-util', 'jquery-blockui' ), $version, true );
		wp_enqueue_script( 'wc-add-to-cart-variation', get_stylesheet_directory_uri() . '/assets/src/scripts/wp/add-to-cart-variation.js', array( 'wp-util', 'jquery-blockui' ), $version, 'all' );

		/**
		 * Activate browser-sync on development environment
		 */
		if ( getenv( 'APP_ENV' ) === 'development' ) :
			wp_enqueue_script( '__bs_script__', getenv( 'WP_SITEURL' ) . ':3000/browser-sync/browser-sync-client.js', array(), $version, true );
		endif;

	}
}
