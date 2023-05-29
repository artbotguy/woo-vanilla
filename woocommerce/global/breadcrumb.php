<?php
/**
 * Descr
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?> 
 <?php
	if ( ! empty( $breadcrumb ) ) :


		echo $wrap_before;
		?>
<div class="container-lg">
		 
<div class="wv-breadcrumb__body placeholder">

		<?php
		foreach ( $breadcrumb as $key => $crumb ) {

			echo $before;

			if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<a class="wv-breadcrumb__item" href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
			} else {
				echo '<span class="wv-breadcrumb__item">' . esc_html( $crumb[0] ) . '</span>';
			}

			echo $after;

			if ( sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<svg class="wv-icon-default">
				<use xlink:href="#sprite-arrow-long"></use>
			</svg>';
			}
		}
		?>
		 
		</div>
		</div> <!-- #container --> 
		 <?php

			echo $wrap_after;

	endif;
