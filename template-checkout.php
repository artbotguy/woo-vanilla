<?php
/**
 * The template for displaying the Checkout.
 *
 * Template name: Checkout
 *
 * @package WooVanilla
 */

get_header();

global $wp;

?>

<?php woovanilla_output_content_wrapper( array( 'template' => $template ) ); ?>

<div class="container-lg">
  <?php
	woovanilla_breadcrumb();
	?>
	
	<div class="wv-checkout">

	<?php if ( ! isset( $wp->query_vars['order-received'] ) ) : ?>
	 
	<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="wv-checkout__cart">
			<div class="wv-checkout__cart-header">
				<span>Товары в корзине</span>
				<?php echo do_shortcode( '[prowc_empty_cart_button]' ); ?>
			</div>
				<?php
				xoo_wsc_helper()->get_template( 'xoo-wsc-body.php' );
				?>
		</div>
<?php endif; ?>	

 <?php
	echo do_shortcode( '[woocommerce_checkout]' );
	?>
	</div><!-- #wv-checkout -->

</div> <!-- #container -->

<?php


woocommerce_output_content_wrapper_end();

get_footer();
