<?php

namespace WooVanilla\Setup;

/**
 * Menus
 */
class Menus {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register() {
		add_action( 'after_setup_theme', array( $this, 'menus' ) );
	}

	/**
	 * Undocumented function
	 */
	public function menus() {
		/*
			Register all your menus here
		*/
		register_nav_menus(
			array(
				'navigation'        => esc_html__( 'navigation' ),
				'categories_header' => esc_html__( 'categories_header' ),
				'categories_footer' => esc_html__( 'categories_footer' ),
				'footer_contacts'   => esc_html__( 'footer_contacts' ),
				'header_contacts'   => esc_html__( 'header_contacts' ),
			)
		);
	}
}
