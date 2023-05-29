<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

// $arrow_icon_html =
// '<svg class="wv-icon-default">
// <use xlink:href="#sprite-arrow-long"></use>
// </svg>';

?>
<nav class="wv-pagination placeholder-wave woocommerce-pagination">
	<div class="wv-pagination__wrapper placeholder">
		<?php
		echo paginate_links(
			apply_filters(
				'woocommerce_pagination_args',
				array( // WPCS: XSS ok.
					'base'     => $base,
					'format'   => $format,
					'add_args' => false,
					'current'  => max( 1, $current ),
					'total'    => $total,
					// 'prev_text' => '<span>Предыдущая</span>',
					// 'next_text' => '<span>Следующая</span>',
					'prev_next'    => false,
					'type'     => 'list',
					'end_size' => 3,
					'mid_size' => 3,
				)
			)
		);
		?>
	</div>
</nav>
