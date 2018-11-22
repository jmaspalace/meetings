
<?php 

function bloque_banner($node){		
	$nodo=$node['entity'];
	$img_desktop=file_create_url($nodo->field_imagen_desktop['und'][0]['uri']);
	$img_mobile=file_create_url($nodo->field_imagen_mobile['und'][0]['uri']);
	?>
	<section class="bloque-banner container-fluid <?php print $nodo->field_tipo_margen['und'][0]['value'] ?> ">
		<?php 
		if (!empty($nodo->field_titulo['und'])) {
			?>
			<h1><?php print $nodo->field_titulo['und'][0]['value'] ?> </h1>
			<?php	
		}
		?>

		<picture>
			<source srcset="<?php print $img_mobile ?>" media="(max-width: 767px)">
				<source srcset="<?php print $img_desktop ?>">
					<img srcset="<?php print $img_desktop ?>">
				</picture>
			</section>
			<?php
		}

		function bloque_intro($node){
			$nodo=$node['entity'];

			?>
			<section class="container-fluid bloque-intro <?php print $nodo->field_tipo_margen['und'][0]['value'] ?>">
				<div class="container">
					<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
						<h2 class="titulo_bloque"><?php print $nodo->title ?></h2>
						<p>
							<?php print $nodo->body['und'][0]['value'] ?>
						</p>
					</div>
				</div>
			</section>

			<?php
		}


		function bloque_slider($node){
			$node=$node['entity'];
			?>
			<script type="text/javascript" src="https://player.vimeo.com/api/player.js"></script>
			<section class="container-fluid flexslider bloque-slider <?php print $node->field_tipo_margen['und'][0]['value'] ?> ">
				<ul class="slides">
					<?php
					$i=0;
					$title_mob="";
					$url_mob="";
					$title_url_mob="";
					foreach ($node->field_slides['und'] as $item) {								
						$field_collection = entity_load('field_collection_item', array($item['value']));
						foreach ($field_collection as $slides) {								
							if ($i==0 && empty($slides->field_subtitulo['und'])) {															
								$img_mob=file_create_url($slides->field_imagen_mobile['und'][0]['uri']);
								if (!empty($slides->field_titulo['und'])) {
									$title_mob=$slides->field_titulo['und'][0]['value'];
								}
								if (!empty($slides->field_call_to_action['und'])) {
									$url_mob=$slides->field_call_to_action['und'][0]['url'];
									$title_url_mob=$slides->field_call_to_action['und'][0]['title'];
								}

							}

							?>
							<?php 

							?>

							<li>
								<?php 
								if (!empty($slides->field_subtitulo['und'])) {
									?>
									<div class="container-video">
					<iframe src="<?php print $slides->field_subtitulo['und'][0]['value'] ?>"></iframe>
									</div>

									<?php
								}else{
								?>
								<picture>
									<img alt="" class="img-responsive" src="<?php print file_create_url($slides->field_imagen_desktop['und'][0]['uri'])?>">
								</picture>	
								<?php 
								if (!empty($slides->field_titulo['und']) ||!empty($slides->field_descripcion['und']) || !empty($slides->field_call_to_action['und'])) {							
									?>	
									<article class="box_info">
										<?php
										if (!empty($slides->field_titulo['und'])) {
											?>
											<h2><?php print $slides->field_titulo['und'][0]['value']?></h2>
											<?php 
										}
										if (!empty($slides->field_descripcion['und'])) {
											?>
											<p><?php print $slides->field_descripcion['und'][0]['value']?> </p>
											<?php 
										}
										if (!empty($slides->field_call_to_action['und'])) {
											$url_mob=$slides->field_call_to_action['und'][0]['url'];
											$title_url_mob=$slides->field_call_to_action['und'][0]['title'];
											?>
											<a href="<?php print $slides->field_call_to_action['und'][0]['url'] ?>" class="enlace"><?php print $slides->field_call_to_action['und'][0]['title'] ?></a>
											<?php
										}
										?>

									</article>
									<?php }
																	$i++;		
								}

									?>
								</li>						
								<?php		
							}					
						}
						?>			
					</ul>

					<div class="banner-mobile">
						<article class="box_info">
							<h2><?php print $title_mob ?></h2>
							<a href="<?php print $url_mob ?>" class="enlace"><?php print $title_url_mob ?></a>
						</article>
						<picture>
							<img alt="" src="<?php print $img_mob ?>" class="img-responsive img-mobile">
						</picture>
					</div>
				</section>

				<?php
			}


			function bloque_box_black($node){
				$node=$node['entity'];
				$img_background=file_create_url($node->field_imagen_desktop['und'][0]['uri']);
				?>
				<section id="" class="bloque-box-black container-fluid <?php print $node->field_tipo_margen['und'][0]['value'] ?>" style="background-image: url(<?php print $img_background ?>);">
					<img src="<?php print $img_background ?>" class="img-background">
					<article>
						<div class="box">
							<h2><?php print $node->title ?></h2>
							<p><?php print $node->body['und'][0]['value'] ?></p>
							<?php
							if (!empty($node->field_call_to_action['und'])) {
								?>
								<a href="<?php print $node->field_call_to_action['und'][0]['url'] ?>" class="enlace"><?php print $node->field_call_to_action['und'][0]['title'] ?></a>
								<?php 
							}
							?>
						</div>
					</article>
				</section>

				<?php

			}


			function bloque_content_1($node){
				
				$node=$node['entity'];
				$img_background=file_create_url($node->field_imagen_desktop['und'][0]['uri']);	
				$titulo=explode(" ", $node->title);
				$titulo_normal=$titulo[0]." ".$titulo[1];
				$titulo_especial="";
				for ($i=2; $i <count($titulo) ; $i++) { 
					$titulo_especial.=" ".$titulo[$i];
				}
				?>
				<section class="container-fluid bloque-content1 <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
					<h2 class="titulo_bloque"><span><?php print $titulo_normal ?></span> <?php print $titulo_especial ?></h2>
					<div class="container">
						<?php
						if (!empty($node->body['und'])) {
							print $node->body['und'][0]['value'] ;
						}	

						?>
					</div>
					<img src="<?php print $img_background ?>" class="img-responsive">
					<div class="container">
						<div class="row">
							<?php
							$i=1;
							foreach ($node->field_elementos_de_texto['und'] as $item) {		
								$field_collection = entity_load('field_collection_item', array($item['value']));
								foreach ($field_collection as $cajas) {			
									
									$titulo=explode(" ", $cajas->field_titulo['und'][0]['value']);
									$titulo_normal=$titulo[0];
									$titulo_especial="";
									for ($j=1; $j <count($titulo) ; $j++) { 
										$titulo_especial.=" ".$titulo[$j];
									}
									?>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<h3><?php print $titulo_normal ?> <span><?php print $titulo_especial ?></span></h3>
										<p><?php print $cajas->field_descripcion['und'][0]['value'] ?></p>
									</div>						
									<?php 						
									if ($i%2==0) {

										print "</div>";
										print '<div class="row">';
									}
									$i++;
								}
							}
							?>			
						</div>
					</div>
				</section>


				<?php
			}

			function bloque_content_2($node){
				$node=$node['entity'];
				$img_desktop=file_create_url($node->field_imagen_desktop['und'][0]['uri']);
				$img_mobile=file_create_url($node->field_imagen_mobile['und'][0]['uri']);
				$titulo=explode(" ", $node->title);
				$titulo_normal=$titulo[0]." ".$titulo[1];
				$titulo_especial="";
				for ($i=2; $i <count($titulo) ; $i++) { 
					$titulo_especial.=" ".$titulo[$i];
				}
				?>
				<section class="container-fluid bloque-content2 <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
					<div class="container">
						<h2 class="titulo_bloque"><span><?php print $titulo_normal ?></span> <?php print $titulo_especial ?></h2>
						<?php print $node->field_descripcion['und'][0]['value']; ?>
					</div>
					<img src="<?php print $img_desktop ?>" class="img-responsive">
					<div class="container">
						<?php 
						print $node->field_texto_2['und'][0]['value'];
						?>
					</div>
				</section>
				<?php

			}

			function bloque_content_3($node){
				$node=$node['entity'];
				?>	
				<?php
				$i=1;
				foreach ($node->field_bloques_content_3['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {		
						$img=file_create_url($cajas->field_image['und'][0]['uri']);		
						if ($i%2==0) {
							$alineacion="right";
						}else{
							$alineacion=$node->field_tipo_margen['und'][0]['value'];
						}									
						?>
						<section class="container-fluid bloque-content3 <?php print $alineacion ?>">
							<div class="col-md-6 col-sm-6 col-xs-12 content-img" style="background-image: url(<?php print $img ?>);">
								<img class="img-background" src="<?php print $img ?>">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 content-info">
								<div class="box">
									<h2><?php print $cajas->field_titulo['und'][0]['value'] ?></h2>
									<p><?php print $cajas->field_descripcion['und'][0]['value'] ?></p>

									<?php 
									if (!empty($cajas->field_call_to_action['und'])) {
										$target="";
										if (!empty($cajas->field_call_to_action['und'][0]['attributes']['target'])) {
											$target='target='.$cajas->field_call_to_action['und'][0]['attributes']['target'];
										}
										?>
										<a <?php print $target ?> href="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" class="enlace"><?php print $cajas->field_call_to_action['und'][0]['title'] ?></a>	
										<?php

									}
									
									?>
									
								</div>
							</div>
						</section>						
					</div>						
					<?php 

					$i++;
				}
			}
			?>			
		</div>
	</div>
</section>


<?php
}

function bloque_content_3a($node){
	global $language;
	$node=$node['entity'];
	$vocabulary = taxonomy_vocabulary_machine_name_load('resorts');
	$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid,'language' => $language->language));				
	$options="";	
	foreach ($terms as $term) {								
		$selected="";		
		if (!empty($node->field_resort['und'])) {
			if ($term->tid==$node->field_resort['und'][0]['tid']) {
				$selected="selected";
			}	
		}		
		$options.="<option value=".$term->tid." ".$selected." >".$term->name."</option>";		
	}
	$view = views_get_view('resorts');
	$view->set_display('block');
	$view->set_arguments(array($node->field_resort['und'][0]['tid']));
	$view->execute();
	$resultado=$view->result[0]->_field_data['nid']['entity'];					
	?>
	<section class="container-fluid bloque-content3">
		<div class="col-md-6 col-sm-6 col-xs-12 content-img">
			<img class="img-background" src="<?php print file_create_url($resultado->field_image['und'][0]['uri']) ?>">
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 content-info">
			<select id="select-resort">
				<option disabled  <?php ?> > <?php print t('Select your resort')?></option>
				<?php 
				print $options;
				?>
			</select>
			<div class="box">
				<h4 class="subtitulo"></h4>
				<h2></h2>
				<h3 class="subtitulo"></h3>
				<p></p>
				<a href="" target="_blank" class="enlace"><?php print $resultado->field_call_to_action['und'][0]['title'] ?></a>
			</div>
		</div>
		<ul class="info-resorts">
			<li>
				<div class="subtitulo-h4"><?php print $resultado->field_titulo['und'][0]['value'] ?></div>
				<div class="subtitulo-h2"><?php print $resultado->title ?></div>
				<div class="subtitulo-h3"><?php print $resultado->field_subtitulo['und'][0]['value'] ?></div>
				<div class="text"><?php print $resultado->body['und'][0]['value'] ?></div>
				<div class="link"><?php print $resultado->field_call_to_action['und'][0]['url'] ?></div>
				<img class="img-background" src="<?php print file_create_url($resultado->field_image['und'][0]['uri']) ?>">
			</li>						
		</ul>
	</section>


	<?php
}



function bloque_content_4($node){
	$node=$node['entity'];
	$img_grande=file_create_url($node->field_image['und'][0]['uri']);	
	$titulo=explode(" ", $node->title);
	$titulo_normal=$titulo[0]." ".$titulo[1];
	$titulo_especial="";
	for ($i=2; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	?>

	<section class="container-fluid bloque-content4 <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<h2 class="titulo_bloque"><span><?php print $titulo_normal ?></span> <?php print $titulo_especial ?></h2>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 images">
					<?php 
					foreach ($node->field_2_imagenes['und'] as $item) {
						?>
						<img src="<?php print file_create_url($item['uri']) ?>" class="img-responsive">
						<?php
					}
					?>										
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<img src="<?php print $img_grande ?>" class="img-responsive">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<ul class="points">
						<?php 
						print $node->field_descripcion['und'][0]['value'];
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php

}


function bloque_content_5($node){
	$node=$node['entity'];	
	?>	
	<?php
	$j=1;
	foreach ($node->field_bloques_content_5['und'] as $item) {		
		$field_collection = entity_load('field_collection_item', array($item['value']));
		foreach ($field_collection as $cajas) {		
			$img=file_create_url($cajas->field_image['und'][0]['uri']);		
			if ($j%2==0) {
				$alineacion="right";
			}else{
				$alineacion=$node->field_tipo_margen['und'][0]['value'];
			}									
			?>
			<section class="container-fluid bloque-content5 <?php print $alineacion ?>">
				<div class="col-md-6 col-sm-6 col-xs-12 content-img" style="background-image: url(<?php print $img ?>);">
					<img class="img-background" src="<?php print $img ?>">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 content-info">
					<div class="box">
						<h2><?php print $cajas->field_titulo['und'][0]['value'] ?></h2>
						<h3 class="subtitulo"><?php print $cajas->field_subtitulo['und'][0]['value'] ?></h3>
						<?php 
						print "<p>".$cajas->field_descripcion['und'][0]['value']."</p>";
						$btn="";
						for ($i=0; $i <2 ; $i++) { 
							if (!empty($cajas->field_botones_2['und'][$i])) {						
								if (!empty($cajas->field_botones_2['und'][$i]['attributes']['target'])) {
									$target="target=".$cajas->field_botones_2['und'][$i]['attributes']['target'];
								}else{
									$target="";
								}
								if ($i==1) {
									$btn="enlace-white";
								}
								
								?>
								<a <?php print $target ?> href="<?php print $cajas->field_botones_2['und'][$i]['url'] ?>" class="<?php  print "enlace ".$btn ?>"><?php print $cajas->field_botones_2['und'][$i]['title'] ?></a>
								<?php
							}
						}
						?>				
					</div>
				</div>
			</section>						
		</div>						
		<?php 

		$j++;
	}
}
?>			
</div>
</div>
</section>


<?php
}

function bloque_grid($node){
	$node=$node['entity'];	
	?>
	<section class="container-fluid bloque-grid <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<div class="grid">
				<?php
				foreach ($node->field_bloque_imagenes['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {		
						$img=file_create_url($cajas->field_image['und'][0]['uri']);									
						?>
						<div class="grid-item">
							<img src="<?php print $img ?>" class="img-responsive">
							<?php 
							if (!empty($cajas->field_descripcion['und'][0]['value'])) {								
								?>
								<p><?php print $cajas->field_descripcion['und'][0]['value'] ?></p>
								<?php 
							}
							?>
						</div>					


						<?php 												
					}
				}
				?>			
			</div>
		</div>
	</section>


	<?php
}


function bloque_img_background($node){
	$node=$node['entity'];
	$img_background=file_create_url($node->field_imagen_desktop['und'][0]['uri']);
	$titulo=explode(" ", $node->title);
	$titulo_normal=$titulo[0];
	$titulo_especial="";
	for ($i=1; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	?>
	<section class="container-fluid bloque-img-background <?php print $node->field_tipo_margen['und'][0]['value'] ?>" style="background-image: url(<?php print $img_background ?>);">
		<img class="img-background" src="<?php print $img_background ?>">
		<div class="content-info container">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<h2 class="titulo_bloque"><?php print $titulo_normal ?> <span class="line2"><?php print $titulo_especial ?></span></h2>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 list">
				<?php print $node->field_descripcion['und'][0]['value'] ?>
			</div>
		</div>
	</section>
	<?php

}


function bloque_img_background_box($node){
	$node=$node['entity'];
	$img_background=file_create_url($node->field_image['und'][0]['uri']);
	$titulo=explode(" ", $node->title);
	$titulo_normal=$titulo[0]." ".$titulo[1];
	$titulo_especial="";
	for ($i=2; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	?>

	<section class="container-fluid bloque-img-background-box <?php print $node->field_tipo_margen['und'][0]['value'] ?>" style="background-image: url(<?php print $img_background ?>);">
		<img class="img-background" src="<?php print $img_background ?>">
		<div class="box">
			<h2><span><?php print $titulo_normal ?> </span> <br> <?php print $titulo_especial ?></h2>
			<?php print $node->field_descripcion['und'][0]['value'] ?>
		</div>
	</section>
	
	<?php

}



function bloque_news($node){
	$node=$node['entity'];	
	?>
	<section class="container-fluid bloque-list-news <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<div class="row">
				<?php
				$i=1;
				foreach ($node->field_bloques_news['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {	
						$img=file_create_url($cajas->field_image['und'][0]['uri']);																
						?>
						<div class="col-md-4 col-sm-4 col-xs-12 box-news">
							<div class="image">
								<img src="<?php print $img ?>" class="img-responsive">
								<h3><?php print $cajas->field_titulo['und'][0]['value'] ?></h3>
							</div>
							<?php 
							if (!empty($cajas->field_descripcion['und'])) {
								print $cajas->field_descripcion['und'][0]['value'];
							}
							
							?>
							<a href="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" ><?php print $cajas->field_call_to_action['und'][0]['title'] ?></a>

						</div>
						
						<?php 
						if ($i%3==0) {
							print "</div>";
							print '<div class="row">';
						}
						$i++;
					}
				}
				?>			
			</div>
		</div>
	</section>


	<?php
}



function bloque_over($node){
	$node=$node['entity'];	
	?>
	<section class="container-fluid bloque-over <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<div class="col-md-12 col-sm-12 col-xs-12 section1">
				<?php
				
				foreach ($node->field_bloques_over['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {	
						$img=file_create_url($cajas->field_image['und'][0]['uri']);										
						?>

						<div class="col-md-4 col-sm-4 col-xs-12 section section2">
							<div class="fondo-gallery" style="background-image: url(<?php print $img ?>);">
								<img src="<?php print $img ?>" class="img-background">
							</div>
							<div class="content-gallery-overblack">
								<div class="content-info">
									<h2 class="titulo_bloque"><?php print $cajas->field_titulo['und'][0]['value'] ?></h2>
									<a href="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" class="enlace"><?php print $cajas->field_call_to_action['und'][0]['title'] ?></a>
								</div>
							</div>
						</div>
						
						<?php 				
					}
				}
				?>			
			</div>
		</div>
	</section>


	<?php
}


function bloque_user($node){
	$node=$node['entity'];	
	?>
	<section class="container-fluid bloque-user <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<div class="row">
				<?php
				$i=0;
				foreach ($node->field_bloques_user['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {	
						$img=file_create_url($cajas->field_image['und'][0]['uri']);																			
						?>

						<div class="col-md-4 col-sm-4 col-xs-12 box">
							<div class="user">
								<div class="rounded imagen">
									<img src="<?php print $img ?>">
								</div>
								<p class="position"><?php print $cajas->field_subtitulo['und'][0]['value'] ?></p>
								<p class="name"><?php print $cajas->field_titulo['und'][0]['value'] ?></p>
								<p class="tel"><?php print $cajas->field_numero_contacto['und'][0]['value'] ?></p>
								<p class="description"><?php print $cajas->field_descripcion['und'][0]['value'] ?></p>
								<?php 
								if (!empty($cajas->field_call_to_action['und'])) {
									?>
									<a href="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" class="meet"><?php print $cajas->field_call_to_action['und'][0]['title'] ?></a>
									<?php 
								}
								?>
							</div>
						</div>

						<?php
						if ($i==0) {
							print '</div>';
							print '<div class="row">';
							
						}else{
							if ($i%3==0) {
								print "</div>";
								print '<div class="row">';
							}

						}														
						
						
						$i++;
					}
				}
				?>			
			</div>
		</div>
	</section>


	<?php
}

function bloque_video($node){
	$node=$node['entity'];
	$titulo=explode(" ", $node->field_subtitulo['und'][0]['value']);
	$titulo_normal=$titulo[0]." ".$titulo[1];
	$titulo_especial="";
	for ($i=2; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	?>
	<section class="container-fluid bloque-video <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<h2 class="titulo_bloque"><span><?php print $titulo_normal ?></span> <?php print $titulo_especial ?></h2>
		<div class="container-video">
			<iframe src="<?php print $node->field_titulo['und'][0]['value'] ?>"></iframe>
		</div>
	</section>

	<?php

}


function bloque_content_6($node){
	$node=$node['entity'];
	$titulo=explode(" ", $node->field_descripcion['und'][0]['value']);
	$titulo_normal=$titulo[0]." ".$titulo[1]." ".$titulo[2];
	$titulo_especial="";
	for ($i=3; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	$img_grande=file_create_url($node->field_image['und'][0]['uri']);
	?><section class="container-fluid bloque-content6 <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<h1 class="titulo_bloque"><span><?php print $titulo_normal ?></span><?php print $titulo_especial ?></h1>
			<?php print $node->field_texto_2['und'][0]['value']  ?>
		</div>
		<img src="<?php print $img_grande ?>" class="img-responsive large">
		<div class="container">
			<?php print $node->field_descripcion_2['und'][0]['value']  ?>
			<?php 
			if (!empty($node->field_texto_citado['und'])) {							
				?>
				<blockquote>
					<?php print $node->field_texto_citado['und'][0]['value']  ?>					
				</blockquote>
				<?php 
			}
			?>
			<?php print $node->field_descripcion_3['und'][0]['value']  ?>

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 images">
					<?php 
					foreach ($node->field_2_imagenes['und'] as $item) {
						?>
						<img src="<?php print file_create_url($item['uri']) ?>" class="img-responsive">
						<?php
					}
					?>	
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<img src="<?php print file_create_url($node->field_imagen_desktop['und'][0]['uri']) ?>" class="img-responsive">
				</div>
			</div>
		</div>
	</section>

	<?php

}


function bloque_content_7($node){
	$node=$node['entity'];
	$titulo=explode(" ", $node->title);
	$titulo_normal=$titulo[0]." ".$titulo[1];
	$titulo_especial="";
	for ($i=2; $i <count($titulo) ; $i++) { 
		$titulo_especial.=" ".$titulo[$i];
	}
	$img_grande=file_create_url($node->field_image['und'][0]['uri']);
	?>
	<section class="container-fluid bloque-content7 <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<h2 class="titulo_bloque"><span><?php print $titulo_normal ?></span><?php print $titulo_especial ?></h2>
					<?php print $node->body['und'][0]['value']  ?>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<img src="<?php print $img_grande ?>" class="img-responsive">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<?php print $node->field_descripcion['und'][0]['value']  ?>					
				</div>
			</div>
		</div>
	</section>
	<?php

}

function separador(){	
	?>
	<div class="separador"></div>
	<?php

}



function bloque_circle_gallery($node){
	$node=$node['entity'];	
	?>
	<section class="container-fluid bloque-circle-gallery <?php print $node->field_tipo_margen['und'][0]['value'] ?>">
		<div class="container">
			<ul>
				<?php				
				foreach ($node->field_bloques_circle_gallery['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {	
						$img=file_create_url($cajas->field_image['und'][0]['uri']);															
						?>
						<li>
							<p class="titulo"><?php print $cajas->field_titulo['und'][0]['value'] ?></p>
							<div class="rounded">
								<img src="<?php print $img ?>">
							</div>
							<a href="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" ><?php print $cajas->field_call_to_action['und'][0]['title'] ?></a>
						</li>
						
						
						<?php 
						
					}
				}
				?>			
			</ul>
		</div>
	</section>


	<?php
}

function bloque_formulario($node){
	$node=$node['entity'];
	$form="client-block-".$node->field_formulario['und'][0]['target_id'];
	$block = module_invoke('webform', 'block_view', $form);
	?>

	<section class="container-fluid bloque-form <?php print $node->field_tipo_margen['und'][0]['value'] ?> ok">
		<div class="container ok2">
			<?php 
			print render($block['content']);
			?>
		</div>
	</section>

	<script type="text/javascript">
		jQuery('#edit-submitted-f4-state').html("<option selected disable>Select State</option>");
		jQuery('form select').selectpicker('refresh');														
		jQuery('#edit-submitted-f3-country').change(function() {
			var pais = jQuery(this).val(); 
			jQuery.ajax({
				type: "POST",
				url: '/traer/departamentos/',
				data:{"idPais":pais},          
				success: function(data)
				{     							
					jQuery('#edit-submitted-f4-state').html(data);
					jQuery('form select').selectpicker('refresh');														
				}
			});
		})

	</script>


	<?php
}

function bloque_resort_table($node){
	$node=$node['entity'];		
	?>
	<section class="container-fluid bloque-table">
		<div class="container">
			<div class="table-responsive">
				<?php print $node->body['und'][0]['value'] ?>
			</div>
		</div>
	</section>

	<?php
}

function bloque_vs($node){
	$node=$node['entity'];		
	?>
	<section class="container-fluid bloque-vs" style="background-image: url('<?php print file_create_url($node->field_image['und'][0]['uri']) ?>');">
		<img src="<?php print file_create_url($node->field_image['und'][0]['uri']) ?> " class="img-background" >
		<div class="container">
			<div class="tg-wrap">
				<?php print $node->body['und'][0]['value'] ?>
			</div>
			<?php 
			if (!empty($node->field_call_to_action['und'])) {
				?>
				<a class="enlace download" href="<?php print $node->field_call_to_action['und'][0]['url'] ?>"><?php print $node->field_call_to_action['und'][0]['title'] ?></a>

				<?php
			}
			?>
		</div>
	</section>

	<?php
}


function breadcrumb(){
	global $language;
	if($language->language=="es"){
		$home="/es";
	}else{
		$home="/en";
	}

	?>

	<section class="container-fluid bloque-breadcrumb">
		<div class="container">
			<ul>
				<li><a href="<?php print $home ?>"><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon-home.png"></a></li>
				<?php 			
				$request= $_SERVER['REQUEST_URI'];
				$libera_idioma=explode("/".$language->language."/",$request);
				$pos = strpos($libera_idioma[1], "?");
				if ($pos !== false) {
					$libera_idioma=explode("?", $libera_idioma[1]);
					$path=explode("/", $libera_idioma[0]);
				}else{          
					$path=explode("/", $libera_idioma[1]);
				}
				$path_aumentado="/".$language->language;

				foreach ($path as $item) {
					if (!empty($item)) {
						$path_aumentado.="/".$item;				
						$name=str_replace("-", " ", $item);
						?>
						<li><a href="<?php print $path_aumentado ?>"><?php print $name  ?></a></li>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</section>

	<?php
}

function share(){
	?>
	<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a26e9a007047400115ab0dc&product=inline-share-buttons"></script>
	<section class='container-fluid bloque-social-media'>

		<div class='container'>
			<p class="social-share-this"><?php print t('Share') ?></p>
			<div class="sharethis-inline-share-buttons">				
			</div>
		</div>

	</section>
	<?php
}

function bloque_local_measure(){
	?>
	<script src="https://cdn.getlocalmeasure.com/embed/widgets.js" data-cfasync="false"></script>
	<section class="container-fluid bloque-local-measure">
		<div class="container">
			<h2><?php print t('Happening Now') ?></h2>
			<div id="widget-6c600c1f8ff1bd48549abd20bf02e85c2bcbf7c812dbbbd7e4bfe26a1e8b" data-lmwidget="6c600c1f8ff1bd48549abd20bf02e85c2bcbf7c812dbbbd7e4bfe26a1e8b"></div>
		</div>
	</section>
	<?php
}

function bloque_3d($node){
	$node=$node['entity'];		
	?>
	<section class="container-fluid bloque-plano3d">
		<div class="center container">
			<?php
				foreach ($node->field_botones_3d['und'] as $item) {		
					$field_collection = entity_load('field_collection_item', array($item['value']));
					foreach ($field_collection as $cajas) {		
						?>
						<button class="enlace btn-plano3d" type="button" data-url="<?php print $cajas->field_call_to_action['und'][0]['url'] ?>" data-title='<?php print $cajas->field_call_to_action['und'][0]['title'] ?>'><?php print $cajas->field_call_to_action['und'][0]['title'] ?></button>								
						<?php 												
					}
				}
				?>	
			
		</div>
	</section>
	<?php
}
