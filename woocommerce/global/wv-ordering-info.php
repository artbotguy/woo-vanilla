<?php
/**
 * Descr
 *
 * @package     WooVanilla
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?> 
<div class="wv-ordering-info placeholder-wave">

	<div class="wv-ordering-info__delivery wv-ordering-info-delivery placeholder">
		<div class="wv-ordering-info__title">Доставка</div>
		<ul class="wv-ordering-info-delivery__list">
		<li class="wv-ordering-info-delivery__item">Самовывоз - бесплатно.</li>
		<li class="wv-ordering-info-delivery__item">Доставка по Воронежу -&nbsp<span>от 300₽</span>.</li>
		<li class="wv-ordering-info-delivery__item">Доставка с 9:00 до 21:00.</li>
		<li class="wv-ordering-info-delivery__item">При заказе <span>от 5000₽</span> - доставка бесплатно.</li>
		</ul>
		<a href="#" class="wv-ordering-info-delivery__link">Подробнее о доставке</a>
	</div>
	<div class="wv-ordering-info__payment-methods placeholder">
		<div class="wv-ordering-info__title">Способы оплаты</div>
		<div class="wv-ordering-info__text">Вы можете оплатить наличными или картой:</div>
		<?php svg( 'payment-methods', 'icons' ); ?>
	</div>
	<div class="wv-ordering-info__purchase-returns placeholder">
		<div class="wv-ordering-info__title">Возврат товара</div>
		<div class="wv-ordering-info__text">Если получателя не устроит качество цветов или работа флориста – напишите нам, в течение 24 часов! Мы решим данную проблему.</div>
	</div>

</div>
