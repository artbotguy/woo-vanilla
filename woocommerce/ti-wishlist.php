<?php
/**
 * The Template for displaying wishlist if a current user is owner.
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script( 'tinvwl' );
?>
<div class="tinv-wishlist woocommerce tinv-wishlist-clear">
	<?php do_action( 'tinvwl_before_wishlist', $wishlist ); ?>
	<?php
	if ( function_exists( 'wc_print_notices' ) && isset( WC()->session ) ) {
		wc_print_notices();
	}
	?>
	<?php $form_url = tinv_url_wishlist( $wishlist['share_key'], $wl_paged, true ); ?>
	<form action="<?php echo esc_url( $form_url ); ?>" method="post" autocomplete="off"
		  data-tinvwl_paged="<?php echo $wl_paged; ?>" data-tinvwl_per_page="<?php echo $wl_per_page; ?>"
		  data-tinvwl_sharekey="<?php echo $wishlist['share_key']; ?>">
		<?php do_action( 'tinvwl_before_wishlist_table', $wishlist ); ?>
		<table class="tinvwl-table-manage-list">
			<thead>
			<tr>
				<?php if ( isset( $wishlist_table['colm_checkbox'] ) && $wishlist_table['colm_checkbox'] ) { ?>
					<th class="product-cb"><input type="checkbox" class="global-cb input-checkbox"
												  title="<?php _e( 'Select all for bulk action', 'ti-woocommerce-wishlist' ); ?>">
					</th>
				<?php } ?>
				<th class="product-remove"></th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><span
						class="tinvwl-full"><?php esc_html_e( 'Product Name', 'ti-woocommerce-wishlist' ); ?></span><span
						class="tinvwl-mobile"><?php esc_html_e( 'Product', 'ti-woocommerce-wishlist' ); ?></span>
				</th>
				<?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
					<th class="product-price"><?php esc_html_e( 'Unit Price', 'ti-woocommerce-wishlist' ); ?></th>
				<?php } ?>
				<?php if ( isset( $wishlist_table_row['colm_date'] ) && $wishlist_table_row['colm_date'] ) { ?>
					<th class="product-date"><?php esc_html_e( 'Date Added', 'ti-woocommerce-wishlist' ); ?></th>
				<?php } ?>
				<?php if ( isset( $wishlist_table_row['colm_stock'] ) && $wishlist_table_row['colm_stock'] ) { ?>
					<th class="product-stock"><?php esc_html_e( 'Stock Status', 'ti-woocommerce-wishlist' ); ?></th>
				<?php } ?>
				<?php if ( isset( $wishlist_table_row['add_to_cart'] ) && $wishlist_table_row['add_to_cart'] ) { ?>
					<th class="product-action">&nbsp;</th>
				<?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php do_action( 'tinvwl_wishlist_contents_before' ); ?>

			<?php

			global $product, $post;
			// store global product data.
			$_product_tmp = $product;
			// store global post data.
			$_post_tmp = $post;

			foreach ( $products as $wl_product ) {

				if ( empty( $wl_product['data'] ) ) {
					continue;
				}

				// override global product data.
				$product = apply_filters( 'tinvwl_wishlist_item', $wl_product['data'] );
				// override global post data.
				$post = get_post( $product->get_id() );

				unset( $wl_product['data'] );
				if ( $wl_product['quantity'] > 0 && apply_filters( 'tinvwl_wishlist_item_visible', true, $wl_product, $product ) ) {
							wc_get_template( 'content-product.php' );
					?>
					<?php
					do_action( 'tinvwl_wishlist_row_after', $wl_product, $product );
				} // End if().
			} // End foreach().
			// restore global product data.
			$product = $_product_tmp;
			// restore global post data.
			$post = $_post_tmp;
			?>
			<?php do_action( 'tinvwl_wishlist_contents_after' ); ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="100">
					<?php do_action( 'tinvwl_after_wishlist_table', $wishlist ); ?>
					<?php wp_nonce_field( 'tinvwl_wishlist_owner', 'wishlist_nonce' ); ?>
				</td>
			</tr>
			</tfoot>
		</table>
	</form>
	<?php do_action( 'tinvwl_after_wishlist', $wishlist ); ?>
	<div class="tinv-lists-nav tinv-wishlist-clear">
		<?php do_action( 'tinvwl_pagenation_wishlist', $wishlist ); ?>
	</div>
</div>
