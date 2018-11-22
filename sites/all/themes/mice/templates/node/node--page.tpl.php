<section class="bloque-thanks container-fluid">
		<div class="box">
			<h2><?php print $node->title ?></h2>
			<p><?php print $node->body['und'][0]['value'] ?></p>
		</div>
		<picture>
			<source srcset="<?php print file_create_url($node->field_imagen_mobile['und'][0]['uri']) ?>" media="(max-width: 767px)">
			<source srcset="<?php print file_create_url($node->field_imagen_desktop['und'][0]['uri']) ?>">
			<img srcset="<?php print file_create_url($node->field_imagen_desktop['und'][0]['uri']) ?>">
		</picture>
	</section>