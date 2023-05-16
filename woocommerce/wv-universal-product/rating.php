<?php
/**
 * Universal template for loop and single products
 *
 * @package WooWanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

// echo wv_get_rating_html( $product->get_average_rating() ); // WordPress.XSS.EscapeOutput.OutputNotEscaped.

?>

	<div class="woocommerce-product-rating wv-rating-reviews">
		<?php echo wv_get_rating_html( $average ); // WPCS: XSS ok. ?>
		<?php if ( comments_open() ) : ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
			<?php
			echo '(' . sprintf(
				_n( '%s review', '%s reviews', $review_count, 'woocommerce' ),
				'<span class="count">' .
				esc_html( $review_count ) . '</span>'
			) . ')';
			?>
			</a>
		<?php endif ?>
	</div>
