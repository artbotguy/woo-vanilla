<?php

/**
 * WooVanilla Theme Class
 *
 * @package WooVanilla
 */

if ( ! class_exists( 'WooVanilla' ) ) :
	/**
	 * Undocumented class
	 */
	final class WooVanilla {

		/**
		 * Undocumented variable
		 *
		 * @var [type]
		 */
		protected static $instance = null;

		/**
		 * Undocumented function
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Store all the classes inside an array
		 *
		 * @return array Full list of classes
		 */
		public static function get_services() {
			return array(
				// WooVanilla\Core\Tags::class,
				// WooVanilla\Core\Sidebar::class,
				WooVanilla\Setup\Setup::class,
				WooVanilla\Setup\Menus::class,
				WooVanilla\Setup\Enqueue::class,
				// WooVanilla\Custom\Post_Types::class,
				// WooVanilla\Custom\Admin::class,
				// WooVanilla\Custom\Extras::class,
				// WooVanilla\Api\Customizer::class,
				// WooVanilla\Api\Gutenberg::class,
				// WooVanilla\Api\Widgets\Text_Widget::class,
				WooVanilla\Api\Widget_Areas::class,
				// WooVanilla\Plugins\Theme_Jetpack::class,
				// WooVanilla\Plugins\Acf::class,
			);
		}

		/**
		 * Loop through the classes, initialize them, and call the register() method if it exists
		 *
		 * @return
		 */
		public static function register_services() {
			foreach ( self::get_services() as $class ) {
				$service = self::instantiate( $class );
				if ( method_exists( $service, 'register' ) ) {
					$service->register();
				}
			}
		}

		/**
		 * Initialize the class
		 *
		 * @param  class $class         class from the services array
		 * @return class instance       new instance of the class
		 */
		private static function instantiate( $class ) {
			return new $class();
		}

	}

	return new WooVanilla();

endif;
