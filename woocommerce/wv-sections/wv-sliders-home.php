<?php
/**
 * Sliders Homepage
 *
 * @package WooVanilla
 */

$banners = get_posts(
	array(
		'post_type' => 'wv_banner',
		'orderby'   => 'date',
		'order'     => 'ASC',
		'tax_query' => array(
			array(
				'taxonomy' => 'wv_banner_categories',
				// 'field'    => 'id',
				'terms'    => 657, // Where term_id of Term 1 is "1".
			),
		),
	)
);

?>
<div class="wv-sliders-home placeholder-wave">
	<section class="wv-section-slider-banners placeholder _wv-swiper-parent">
		<div class="swiper wv-slider-banners" id="wv-slider-banners-home">
			<div class="swiper-wrapper">
			<?php foreach ( $banners as $banner ) : ?>
			<div class="swiper-slide _img-container">
			<div class="wv-slider-banners__content">
					<h3 class="wv-slider-banners__title"><?php echo esc_html( $banner->post_title ); ?></h3>
					<?php echo $banner->post_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<picture>
				<source srcset="" type="image/webp">
				<source srcset="" type="image/jpeg">
				<img src="<?php echo esc_attr( get_the_post_thumbnail_url( $banner ) ); ?>" alt="">
			</picture>
			</div>
			<?php endforeach; ?>
			</div>
			<?php wc_get_template( 'wv-packages/wv-swiper-arrows.php' ); ?>
			<div class="swiper-pagination"></div>
		</div>
	</section>
	<?php woovanilla_slider_products( array( 'class' => 'wv-slider-products_type_sliders-home' ), 'Букет недели', 'products_slider', '' ); ?>
</div>
