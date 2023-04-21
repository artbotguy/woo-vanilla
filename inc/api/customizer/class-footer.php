<?php
/**
 * Theme Customizer - Footer
 *
 * @package WooVanilla
 */

namespace WooVanilla\Api\Customizer;

use WP_Customize_Control;
use WP_Customize_Color_Control;

use WooVanilla\Api\Customizer;

/**
 * Customizer class
 */
class Footer {

	/**
	 * register default hooks and actions for WordPress
	 *
	 * @return
	 */
	public function register( $wp_customize ) {
		$wp_customize->add_section(
			'woovanilla_footer_section',
			array(
				'title'       => __( 'Footer', 'woovanilla' ),
				'description' => __( 'Customize the Footer' ),
				'priority'    => 162,
			)
		);

		$wp_customize->add_setting(
			'woovanilla_footer_background_color',
			array(
				'default'   => '#ffffff',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload
			)
		);

		$wp_customize->add_setting(
			'woovanilla_footer_copy_text',
			array(
				'default'   => 'Proudly powered by AWPS',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'woovanilla_footer_background_color',
				array(
					'label'    => __( 'Background Color', 'woovanilla' ),
					'section'  => 'woovanilla_footer_section',
					'settings' => 'woovanilla_footer_background_color',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'woovanilla_footer_copy_text',
				array(
					'label'    => __( 'Copyright Text', 'woovanilla' ),
					'section'  => 'woovanilla_footer_section',
					'settings' => 'woovanilla_footer_copy_text',
				)
			)
		);

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'woovanilla_footer_background_color',
				array(
					'selector'         => '#woovanilla-footer-control',
					'render_callback'  => array( $this, 'outputCss' ),
					'fallback_refresh' => true,
				)
			);

			$wp_customize->selective_refresh->add_partial(
				'woovanilla_footer_copy_text',
				array(
					'selector'         => '#woovanilla-footer-copy-control',
					'render_callback'  => array( $this, 'outputText' ),
					'fallback_refresh' => true,
				)
			);
		}
	}

	/**
	 * Generate inline CSS for customizer async reload
	 */
	public function outputCss() {
		echo '<style type="text/css">';
			echo Customizer::css( '.site-footer', 'background-color', 'woovanilla_footer_background_color' );
		echo '</style>';
	}

	/**
	 * Generate inline text for customizer async reload
	 */
	public function outputText() {
		echo Customizer::text( 'woovanilla_footer_copy_text' );
	}
}
