<?php
/**
 * @package WooVanilla
 */

namespace WooVanilla\Api;

/**
 * Custom
 */
class Widget_Areas {

	public $widget_ID;

	public $widget_name;

	public $widget_options = array();

	public $control_options = array();
		/**
		 * Undocumented variable
		 *
		 * @var [type]
		 */
	protected static $instance = null;

	function __construct() {

	}

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
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_action( 'widgets_init', array( $this, 'register_widget_areas' ) );
	}

	public function register_widget_areas() {
				register_sidebar(
					array(
						'name'          => 'catalog-filter-group',
						'id'            => 'catalog-filter-group',
						'before_widget' => '<div>',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="rounded">',
						'after_title'   => '</h2>',
					)
				);
	}

	public function area_template() {
		if ( is_active_sidebar( 'catalog-filter-group' ) ) :
			echo '<div id="" class="widget-area wv-widget-area wv-widget-area_location_catalog placeholder">';
				dynamic_sidebar( 'catalog-filter-group' );
			echo '</div>';
		endif;
	}
}
