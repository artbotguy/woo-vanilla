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
	 */
	public function enqueue_scripts() {
		// wp_deregister_style( 'xoo-wsc-admin-fonts' );
		// wp_deregister_style( 'xoo-wsc-admin-style' );

		$version = time();

		wp_enqueue_style( 'gf-yeseva-one', 'https://fonts.googleapis.com/css?family=Yeseva+One:regular', array(), $version );
		wp_enqueue_style( 'gf-inter', 'https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900)', array(), $version );

		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/node_modules/bootstrap/dist/css/bootstrap.css', array(), $version, 'all' );
		wp_enqueue_style( 'wv-main-css', mix( 'css/style.css' ), array(), $version, 'all' );

		// JS
		wp_enqueue_script( 'wv-map', get_stylesheet_directory_uri() . '/assets/src/scripts/inc/map.js', array(), $version, 'all' );

		/**
		 * Main script
		 * note: need jq cut from this bundle
		 */
		wp_enqueue_script( 'wv-main-js', mix( 'js/app.js' ), array( 'wv-map' ), $version, true );

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
		wp_deregister_script( 'wc-add-to-cart-variation' );

		// wp_enqueue_script( 'wc-add-to-cart-variation', mix( 'js/add-to-cart-variation.js' ), array( 'wp-util', 'jquery-blockui' ), $version, true );
		wp_enqueue_script( 'wc-add-to-cart-variation', get_stylesheet_directory_uri() . '/assets/dist/js/add-to-cart-variation.js', array( 'wp-util', 'jquery-blockui' ), $version, 'all' );

		wp_deregister_script( 'xoo-wsc-main-js' );
		// wp_enqueue_script( 'xoo-wsc-main-js', mix( 'js/xoo-wsc-main.js' ), array( 'jquery' ), $version, true );
		wp_enqueue_script( 'xoo-wsc-main-js', get_stylesheet_directory_uri() . '/assets/dist/js/xoo-wsc-main.js', array( 'jquery' ), $version, 'all' );

		/**
		 * Activate browser-sync on development environment
		 */
		if ( getenv( 'APP_ENV' ) === 'development' ) :
			wp_enqueue_script( '__bs_script__', getenv( 'WP_SITEURL' ) . ':3000/browser-sync/browser-sync-client.js', array(), $version, true );
		endif;

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
