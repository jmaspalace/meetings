<?php 
include(drupal_get_path('theme', 'mice').'/templates/utilities/bloques_render.tpl.php');
	
$banner=false;
foreach ($node->field_bloque['und'] as $item) {
	if ($item['entity']->type=='bloque_banner') {
		$banner=true;
		break;
	}
}

if (!$banner) {
	print "<h1 class='hidden'>".$node->title."</h1>";
}


foreach ($node->field_bloque['und'] as $item) {
	

	switch ($item['entity']->type) {
		case 'bloque_banner':
			bloque_banner($item);
			break;

		case 'bloque_intro':
			bloque_intro($item);
			break;

		case 'bloque_slider':
			bloque_slider($item);
			break;

		case 'bloque_box_black':
			bloque_box_black($item);
			break;

		case 'bloque_content_1':
			bloque_content_1($item);
			break;

		case 'bloque_content_2':
			bloque_content_2($item);
			break;

		case 'bloque_content_3':
			bloque_content_3($item);
			break;

		case 'bloque_content_3a':
			bloque_content_3a($item);
			break;

		case 'bloque_content_4':
			bloque_content_4($item);
			break;

		case 'bloque_content_5':
			bloque_content_5($item);
			break;

		case 'bloque_content_6':
			bloque_content_6($item);
			break;

		case 'bloque_content_7':
			bloque_content_7($item);
			break;

		case 'bloque_grid':
			bloque_grid($item);
			break;

		case 'bloque_img_background':
			bloque_img_background($item);
			break;

		case 'bloque_img_background_box':
			bloque_img_background_box($item);
			break;

		case 'bloque_news':
			bloque_news($item);
			break;


		case 'bloque_over':
			bloque_over($item);
			break;

		case 'bloque_user':
			bloque_user($item);
			break;

		case 'bloque_video':
			bloque_video($item);
			break;

		case 'separador':
			separador();
			break;

		case 'bloque_circle_gallery':
			bloque_circle_gallery($item);
			break;

		case 'bloque_formulario':
			bloque_formulario($item);
			break;

		case 'bloque_resort_table':
			bloque_resort_table($item);
			break;

		case 'bloque_vs':
			bloque_vs($item);
		break;

		case 'breadcrumb':
			breadcrumb();
		break;

		case 'share':
			share();
		break;

		case 'bloque_local_measure':
			bloque_local_measure();
		break;

		case 'bloque_3d':
			bloque_3d($item);
		break;
		
		default:
			# code...
			break;
	}
}





?>
