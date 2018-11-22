<?php 
global $language;
?>
<section class="container-fluid bloque_404">
		<picture>
			<source srcset="/<?= drupal_get_path('theme', 'mice') ?>/images/page-404-mobile.jpg" media="(max-width: 767px)" class="img-responsive">
			<source srcset="/<?= drupal_get_path('theme', 'mice') ?>/images/page-404.jpg" class="img-responsive">
			<img srcset="/<?= drupal_get_path('theme', 'mice') ?>/images/page-404.jpg" class="img-responsive">
		</picture>
		<div class="box-container">
			<h3><?php print t('This site is unavailable') ?></h3>
			<p><?php print t("It seems like you've wandered away from our active site. <br> Let us take you back to the page you need") ?></p>
			<a href="/<?php print $language->language ?>"><?php print t('Return to the homepage') ?></a>
		</div>
	</section>