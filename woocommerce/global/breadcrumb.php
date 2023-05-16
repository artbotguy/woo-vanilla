<?php
/**
 * Shop breadcrumb
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a class="woocommerce-breadcrumb__item" href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo '<span class="woocommerce-breadcrumb__item">' . esc_html( $crumb[0] ) . '</span>';
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<svg class="wv-icon-default">
				<use xlink:href="#sprite-arrow-long"></use>
			</svg>';
		}
	}

	echo $wrap_after;

}
