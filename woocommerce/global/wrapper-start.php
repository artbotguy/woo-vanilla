<?php
/**
 * Content wrappers
 *
 * @package WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$post_name = $post->post_name;
?>
<main id="main" class="site-main wv-site-main wv-site-main_page_<?php echo $post_name; ?>">
