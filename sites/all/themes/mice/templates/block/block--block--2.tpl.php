<section class="container-fluid footer1">
			<div class="container">
				<div class="col-md-12 col-xs-12">
					<div class="newsletter">
						<p id="suscribe-title"><?php print t('Subscribe to our Newsletter:') ?></p>
						<form action="/send/newsletter" method="POST" id="newsletter-form">
							<input id="email_news" data-parsley-errors-container="#error_form1" type="email" required="required"  name="email_newsletter" data-parsley-type-message="<?php print t('The entered email address does not appear valid.') ?> " data-parsley-required-message="<?php print t('E-mail field is required.') ?> " >
							<input type="submit" value="<?php print t('Send') ?>">
							<div class="checbox-content">
								<p class="title-checkbox"><?php print t('Please read & understand our') ?> <a href="<?php print t('https://www.palaceresorts.com/en/terms') ?>"> <?php print t('Terms & Conditions') ?></a> </p>
								<div class="mask-checkbox">
									<input type="checkbox" id="chek-terms" name="chek-terms" data-parsley-required-message="<?php print t('terms & conditions field is required.') ?> " data-parsley-errors-container="#error_form1" required="required">
									<span></span>
								</div>
								<p class="description"><?php print t('I accept & understand terms & conditions') ?></p>
							</div>

							<div class="checbox-content">
								<div class="mask-checkbox">
									<input type="checkbox" id="chek-sing" name="chek-sing" data-parsley-required-message="<?php print t('Sign me up field is required.') ?>" data-parsley-errors-container="#error_form1" required="required">
									<span></span>
								</div>
								<p class="description"><?php print t('Yes, I love getting deals! Sign me up!') ?></p>
							</div>
						</form>
						<span id="error_form1"></span>
						<span id="respuesta" style="display: none;"><?php print  t('SIGN UP FOR SPECIAL OFFERS <br> Thank you, your submission has been received.')?><span>			
					</div>
				</div>
			</div>
		</section>
		<section class="container-fluid footer2">
			<div class="container">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<ul class="inline">
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo1.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo2.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo3.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo4.png"></li>
					</ul>
				</div>
				<?php 
					global $language;
					   if ($language->language=="en") {
            $menu = menu_tree_all_data( "menu-footer-english");
          }else{
            $menu = menu_tree_all_data( "menu-footer-espa-ol");
          }     

			?>
			<div class="col-md-6 col-sm-6 col-xs-12" style="padding:0;" >

			<?php
            foreach( $menu as $menu1 ){             
            $child = $menu1[ "link" ];   
            ?>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<h3><?php print $child['link_title'] ?></h3>
					<ul class="points">
						<?php 
							foreach ($menu1['below'] as $submenu) {
								   $child = $submenu[ "link" ];   
								   $pos = strpos($child[ "href" ], "node");                
					               if ($child[ "href" ]=="<front>") {
					                $child[ "href" ]=$home;    
					                }elseif ($pos !== false) {
					                $child[ "href" ]="/".$language->language."/".drupal_get_path_alias($child[ "href" ], $language->language);
					               }           
								?>
								<li>
									<a href="<?php print $child['href'] ?>">
										<?php print $child['link_title'] ?>
									</a>
								</li>

								<?php
							}
						?>
						
					</ul>
				</div>
				<?php 
			}
				?>
				</div>
			</div>
		</section>
		<section class="container-fluid footer3">
			<div class="container">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<ul class="inline social-media">
						<li><a target="_blank" href="<?php print variable_get('url-twitter') ?>"><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon2.png"></a></li>
					</ul>
					<p><?php print t('Call Us') ?> <span><?php print t('888 - 731 - 7625') ?></span></p>
				</div>
				<div class="col-md-8 col-sm-8 hidden-xs">
					<h3><?php print t('our awards') ?></h3>
					<ul class="inline">
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo5.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo6.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo7.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo8.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo9.png"></li>
						<li><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logo10.png"></li>
					</ul>
				</div>
			</div>
		</section>
		<section class="container-fluid footer4">
			<div class="container">
				<ul class="inline">
					<li>© <?php echo date('Y'); ?> Palace Resorts</li>
					<li><a href="#">All Rights Reserved</a></li>
					<!--<li><a href="/en/privacy-policy/">Privacy Policy</a></li>-->
				</ul>
			</div>
		</section>
