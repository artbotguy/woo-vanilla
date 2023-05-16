<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'wv-single-product', $product ); ?>>

	<?php
		echo '<div class="wv-single-product__main">';
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="wv-single-product__summary">
		<?php
		woocommerce_template_single_title();
		woovanilla_template_rating();
		woovanilla_template_product_attributes( array( 'pa_czvet', 'pa_shirina', 'pa_vysota' ) );
		woovanilla_variable_add_to_cart();
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		// do_action( 'woocommerce_single_product_summary' );
		?>
				<div class="wv-bouquet-composition"><h6>Состав:</h6>
		<ul><li><span>Роза пионовидная вайлд лук</span><span>- 10 шт.</span></li></ul>
		<ul><li><span>Роза кустовая пионовидная</span><span>- 3 шт.</span></li></ul>
		<ul><li><span>Озотамнус</span><span>- 2 шт.</span></li></ul>
		<ul><li><span>Эвкалипт</span><span>- 6 шт.</span></li></ul>
</div>
	</div>
	<div class="wv-single-product__description">
	<?php woocommerce_product_description_tab(); ?>
	</div>

	<?php
	woovanilla_template_ordering_info();
	echo '</div>';
	/**
	 * // WV Note: Хук должен выводить шаблоны, в которые должны поступать продукты.
	 * С вариативными продуктами в шаблон поступает вариации и их применение в WV loop product
	 * не предствляется возможным...
	 *
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	// do_action( 'woocommerce_after_single_product_summary' );

	// заглушка наполовину работает как дефолтная логика - т.к. related в WC работает методом рандома
	woovanilla_slider_products( array(), 'Рекомендуемые товары' );
	woovanilla_slider_products( array(), 'Ранее вы смотрели' );

	wc_get_template( 'wv-sections/wv-advantages-single-product.php' );


	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
