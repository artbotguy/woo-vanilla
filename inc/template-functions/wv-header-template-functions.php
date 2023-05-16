<?php
/**
 * Header template functions
 *
 * @package WooVanilla
 */

function woovanilla_template_header_shedule() {
	 echo '<div class="wv-header-shedule">
  <svg class="wv-icon">
    <use xlink:href="#sprite-shedule"></use>
  </svg>
  <span>Пн-Сб: 8:00–20:00 Вс: 9:00–20:00</span>
</div>';
}

function woovanilla_template_header_description() {
	 $description = get_bloginfo( 'description', 'display' );
	if ( $description ) {
		printf( '<div class="wv-header-description">%s</div>', esc_html( $description ) );
	}
}
