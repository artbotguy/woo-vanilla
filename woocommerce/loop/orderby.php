<?php
/**
 * Show options for ordering
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// echo do_shortcode( '[wpforms id="1220"]' );


?>
<!-- <div class="js-choice"></div> -->
<form class="woocommerce-ordering wv-ordering placeholder" method="get">
	<div class="wv-ordering__title">Сортировать:</div>
	<div class="wv-ordering__wrapper _wv-form-item">
		<select name="orderby" class="wv-select-js-choice-orderby orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
			<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
