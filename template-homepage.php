<?php
/**
 * The template for displaying the homepage.
 *
 * Template name: Homepage
 *
 * @package WooVanilla
 */

get_header(); ?>


<div class="container-lg">

<?php
// do_action( 'homepage' );
wc_get_template( 'wv-sections/wv-sliders-home.php' );
wc_get_template( 'wv-sections/wv-advantages.php' );
woovanilla_slider_products( array( 'on_sale' => true ), 'Акция' );
woovanilla_slider_products( array( 'top_rated' => true ), 'Лучшие' );
woovanilla_slider_products( array( 'order' => 'desc' ), 'Новинки' );
?>
</div> <!-- #container -->

<?php
wc_get_template( 'wv-sections/wv-home-description.php' );
wc_get_template( 'wv-sections/wv-why-chose.php' );
wc_get_template( 'wv-sections/wv-google-map.php' );

?>

<?php
get_footer();
