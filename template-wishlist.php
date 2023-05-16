<?php
/**
 * The template for displaying the wishlist.
 *
 * Template name: Wishlist
 *
 * @package WooVanilla
 */

get_header(); ?>


<div class="container-lg">

<?php

TInvWL_Public_TInvWL::instance()->wishlist_content();

?>
</div> <!-- #container -->
<?php
get_footer();
