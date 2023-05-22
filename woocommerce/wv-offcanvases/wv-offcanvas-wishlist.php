<div class="offcanvas offcanvas-end wv-offcanvas wv-offcanvas-wishlist" tabindex="-1" id="offcanvasWishlist">
	<div class="wv-offcanvas__header offcanvas-header">
		<div class="wv-offcanvas__title offcanvas-title">Список желаний</div>
	  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="wv-offcanvas__body offcanvas-body">
<?php

TInvWL_Public_TInvWL::instance()->wishlist_content();

?>
	</div>
  </div>
