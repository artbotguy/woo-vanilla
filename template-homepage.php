<?php
/**
 * The template for displaying the homepage.
 *
 * Template name: Homepage
 *
 * @package WooVanilla
 */

get_header(); ?>

<?php woocommerce_output_content_wrapper(); ?>

<div class="container-lg">

<?php
// do_action( 'homepage' );
wc_get_template( 'wv-sections/wv-sliders-home.php' );
wc_get_template( 'wv-sections/wv-advantages.php' );
woovanilla_slider_products( array( 'wv_shortcode_type' => 'sale_products' ), 'Акция' );
woovanilla_slider_products( array( 'wv_shortcode_type' => 'top_rated_products' ), 'Лучшие' );
woovanilla_slider_products( array( 'wv_shortcode_type' => 'wv_novetly_products' ), 'Новинки' );
?>
</div> <!-- #container -->

<?php
wc_get_template( 'wv-sections/wv-home-description.php' );
wc_get_template( 'wv-sections/wv-why-chose.php' );
wc_get_template( 'wv-sections/wv-google-map.php' );

woocommerce_output_content_wrapper_end();

get_footer();
