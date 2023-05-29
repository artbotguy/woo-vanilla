<?php
/**
 * Product not variable atributes
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	global $product;

?>
<div class="wv-product-attributes placeholder">
<?php
foreach ( $attribute_names as $key => $attribute_name ) :
	?>
<div class="wv-product-attributes__item">
	<label class="wv-product-attributes__label">
		<?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>:
		</label>
	<span class="wv-product-attributes__value">
		<?php
		echo $product->get_attribute( $attribute_name ); // WPCS: XSS ok.
			echo ( ( count( $attribute_names ) !== $key + 1 ) && ( $separator !== '' ) ) ? ( $separator . ' ' ) : '';
		?>
		</span>
</div>
	<?php
endforeach;
?>
</div>
