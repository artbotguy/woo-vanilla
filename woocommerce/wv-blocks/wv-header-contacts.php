<?php
/**
 * Header contacts
 *
 * @package WooVanilla
 */
?>

<div class="wv-header-contacts">
  <ul class="d-flex flex-column wv-header-contacts__connect">
	<li>
	  <svg class="wv-icon">
		<use xlink:href="#sprite-call"></use>
	  </svg>
	  <span>+7 (920) 211-49-03</span>
	</li>
	<li>
	  <svg class="wv-icon">
		<use xlink:href="#sprite-point"></use>
	  </svg>
	  <span>ул. Революции 1905 года 80</span>
	</li>
	<li>
	  <svg class="wv-icon">
		<use xlink:href="#sprite-point"></use>
	  </svg>
	  <span>ул. Вл. Невского 17</span>
	</li>
	<li>
	  <svg class="wv-icon">
		<use xlink:href="#sprite-mail"></use>
	  </svg>
	  <span>info@lavkaroz.ru</span>
	</li>
  </ul>
  <?php wc_get_template( 'wv-blocks/wv-contacts-soc.php' ); ?>

</div>
