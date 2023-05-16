<?php
/**
 * Header Top
 *
 * @package WooVanilla
 */

defined( 'ABSPATH' ) || exit;

?>

<nav class="placeholder-wave navbar navbar-expand-md wv-header-top">
<div class="placeholder wv-header-top__head">
<!-- header-shedule -->
<button class="navbar-toggler wv-header-top__icon _btn-minimal" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav">
  <span></span><span></span><span></span>
</button>
<?php woovanilla_template_header_description(); ?>
<div class="wv-header-top__local-contacts">
  <a target="_blank" rel="noopener noreferrer" href="https://vk.com/" id="linkVK">
  <svg class="wv-icon">
	<use xlink:href="#sprite-vk"></use>
  </svg>
  </a>
  <a href="whatsapp://send?abid=+79308360370&text=Hello%2C%20World!" id="linkWA">
  <svg class="wv-icon">
	<use xlink:href="#sprite-wa"></use>
  </svg>
  </a>
  <a href="tel:+79308360370" id="linkCall">
  <svg class="wv-icon">
	<use xlink:href="#sprite-call"></use>
  </svg>
  </a>
</div>

</div>
</nav>
