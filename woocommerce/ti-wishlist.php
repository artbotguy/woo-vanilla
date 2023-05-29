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
	<?php
	if ( function_exists( 'wc_print_notices' ) && isset( WC()->session ) ) {
		wc_print_notices();
	}
	?>
	<?php $form_url = tinv_url_wishlist( $wishlist['share_key'], $wl_paged, true ); ?>
	<form action="<?php echo esc_url( $form_url ); ?>" method="post" autocomplete="off"
		  data-tinvwl_paged="<?php echo $wl_paged; ?>" data-tinvwl_per_page="<?php echo $wl_per_page; ?>"
		  data-tinvwl_sharekey="<?php echo $wishlist['share_key']; ?>">
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
						$product_url = apply_filters( 'tinvwl_wishlist_item_url', $product->get_permalink(), $wl_product, $product );

						?>
						<div class="wv-item">
							<div class="wv-item__first-column">
								<?php
								$thumbnail = apply_filters( 'tinvwl_wishlist_item_thumbnail', $product->get_image(), $wl_product, $product );

								if ( ! $product->is_visible() ) {
									echo $thumbnail; // WPCS: xss ok.
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_url ), $thumbnail ); // WPCS: xss ok.
								}
								?>
							</div>
							<div class="wv-item__summary">
							
								<div class="wv-item__name">
								<?php
									echo apply_filters(
										'tinvwl_wishlist_item_name',
										sprintf(
											'<a href="%s">%s</a>',
											esc_url( $product_url ),
											is_callable(
												array(
													$product,
													'get_name',
												)
											) ? $product->get_name() : $product->get_title()
										),
										$wl_product,
										$product
									); // WPCS: xss ok.;
								?>
								</div>
								<?php 
								// WVNOTE: Логика метаданных актуальна для вариативных wl-items (такое не добавлено)
								// echo apply_filters( 'tinvwl_wishlist_item_meta_data', tinv_wishlist_get_item_data( $product, $wl_product ), $wl_product, $product ); // WPCS: xss ok.; 
								?>

								<div class="wv-item__price">
								<?php
								woocommerce_template_loop_price();
								// echo apply_filters( 'tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product ); // WPCS: xss ok.
								?>
								</div>
							</div>
							<div class="wv-item__last-column">

								<button type="submit" name="tinvwl-remove"
								value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
								title="<?php _e( 'Remove', 'ti-woocommerce-wishlist' ); ?>">								<svg class="wv-icon xoo-wsc-smr-del">
									<use xlink:href="#sprite-remove"></use>
								</svg>
								</button>
								<button class="button alt" name="tinvwl-add-to-cart"
											value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
											title="<?php echo esc_html( apply_filters( 'tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product ) ); ?>">
									<svg class="wv-icon">
										<use xlink:href="#sprite-cart"></use>
									</svg>
								</button>
							</div>
						</div>
						<?php
					} // End if().
				} // End foreach().
				// restore global product data.
				$product = $_product_tmp;
				// restore global post data.
				$post = $_post_tmp;
				?>
		<!-- <table class="tinvwl-table-manage-list">
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

	
			</tbody>
			<tfoot>
			<tr>
				<td colspan="100">
					<?php wp_nonce_field( 'tinvwl_wishlist_owner', 'wishlist_nonce' ); ?>
				</td>
			</tr>
			</tfoot>
		</table> -->
	</form>
	<div class="tinv-lists-nav tinv-wishlist-clear">
	</div>
</div>
