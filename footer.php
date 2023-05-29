<?php
/**
 * The template for displaying the footer
 *
 * @package WooVanilla
 */
// <div class="wv-footer__body placeholder wv-placeholder-transparent">
?>

		<footer class="wv-footer">
			<div class="wv-footer__body placeholder">
				<div class="container-lg">
					<section class="wv-footer__main placeholder-wave">
							<?php
							wv_nav_menu(
								array(
									'theme_location' => 'categories_footer',
									'walker'         => new WooVanilla\Core\Walker_Bootstrapped_Menu(),
									'container'      => false,
									'menu_class'     => 'menu wv-collapse-menu wv-menu-categories wv-menu-categories_location_footer placeholder',
									// повторил значение, которое и так рендерится (для доступа из start_lvl())
									'menu_id'        => 'menu-categories_footer',
									'wv_bootstrap_type_component' => 'collapse',
								)
							);
							wv_nav_menu(
								array(
									'theme_location' => 'navigation',
									'walker'         => new WooVanilla\Core\Walker_Bootstrapped_Menu(),
									'container'      => false,
									'menu_class'     => 'menu wv-collapse-menu wv-menu-navigation wv-menu-navigation_location_footer wv-menu-navigation placeholder',
									'menu_id'        => 'menu-navigation_footer', // Note
									'wv_bootstrap_type_component' => 'collapse',
								)
							);
							?>
							<?php
							wv_nav_menu(
								array(
									'theme_location' => 'footer_contacts',
									'walker'         => new WooVanilla\Core\Walker_Contacts(),
									'container'      => false,
									'menu_class'     => 'menu wv-menu-contacts wv-menu-contacts_location_footer placeholder',
									'menu_id'        => 'menu-footer_contacts',
								)
							);
							?>
					</section>
					<section class="wv-footer__bot wv-footer-bot placeholder">
						<div class="wv-footer-bot__item"><span class="wv-footer__text">© 2014 – 2022. Интернет-магазин «Лавка Роз»</span></div>
						<div class="wv-footer-bot__item"><?php svg( 'payments', 'icons' ); ?></div>
						<div class="wv-footer-bot__item">
						<?php wc_get_template( 'wv-blocks/wv-contacts-soc.php', array( 'title' => 'Мы в социальных сетях:' ) ); ?>
						</div>
					</section>
				</div><!-- #container -->
			</div>

			<div class="WV_DEVELOPMENT">Изображения позаимствованы с сайта <a href="https://unsplash.com/">UNSPLASH.COM</a></div>
		</footer>

		<?php wc_get_template( 'wv-offcanvases/wv-offcanvases.php' ); ?>
		</div> <!-- #wv-root -->

		<?php wp_footer(); ?>
	</body>
</html>
