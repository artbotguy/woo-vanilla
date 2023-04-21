<?php
/**
 * Callbacks for Settings API
 *
 * @package WooVanilla
 */

namespace WooVanilla\Api\Callbacks;

/**
 * Settings API Callbacks Class
 */
class Settings_Callback {
	/**
	 * Undocumented function
	 */
	public function admin_index() {
		 return require_once get_template_directory() . '/views/admin/index.php';
	}
	/**
	 * Undocumented function
	 */
	public function admin_faq() {
		echo '<div class="wrap"><h1>FAQ Page</h1></div>';
	}
	/**
	 * Undocumented function
	 */
	public function woovanilla_options_group( $input ) {
		return $input;
	}
	/**
	 * Undocumented function
	 */
	public function woovanilla_admin_index() {
		echo 'Customize this Theme Settings section and add description and instructions';
	}
	/**
	 * Undocumented function
	 */
	public function first_name() {
		$first_name = esc_attr( get_option( 'first_name' ) );
		echo '<input id="first_name" type="text" class="regular-text" name="first_name" value="' . $first_name . '" placeholder="First Name" />';
	}
}
