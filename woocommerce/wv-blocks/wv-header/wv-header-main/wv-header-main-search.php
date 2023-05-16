<?php
/**
 * Header Main Search
 *
 * @package WooVanilla
 */
defined( 'ABSPATH' ) || exit;

?>

	<div class="wv-header-main-search">
	  <div class="search wv-header-main-search__wrapper" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCatalog">
		<?php wc_get_template( 'wv-blocks/wv-header-search.php' ); ?>
	  </div>
	</div>
