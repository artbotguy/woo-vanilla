<?php
/**
 * Header Main Search
 *
 * @package WooVanilla
 */
defined( 'ABSPATH' ) || exit;

?>

<div class="wv-header-main-search _wv-hovervable">
	<div class="search wv-header-main-search__wrapper">
	<div class="wv-header-main-search__toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog"></div>
	<?php get_product_search_form(); ?>
	</div>
</div>
