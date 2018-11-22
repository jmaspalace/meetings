<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $type: The type of search, e.g., "node" or "user".
 *
 *
 * @see template_preprocess_custom_search_results()
 */

$banner_node=node_load(284);
$img_desktop=file_create_url($banner_node->field_imagen_desktop['und'][0]['uri']);
  $img_mobile=file_create_url($banner_node->field_imagen_mobile['und'][0]['uri']);
  ?>
  <section class="bloque-banner container-fluid <?php print $banner_node->field_tipo_margen['und'][0]['value'] ?> ">
    <?php 
    if (!empty($banner_node->field_titulo['und'])) {
      ?>
      <h1><?php print $banner_node->field_titulo['und'][0]['value'] ?> </h1>
      <?php 
    }
    ?>

    <picture>
      <source srcset="<?php print $img_mobile ?>" media="(max-width: 767px)">
        <source srcset="<?php print $img_desktop ?>">
          <img srcset="<?php print $img_desktop ?>">
        </picture>
      </section>

<section class="container-fluid bloque-form">
<?php if ($search_results) : ?>
  <section id="search-block">
      
    </section>
  <h2><?php print t('search results');?></h2>
  <?php if (isset($filter) && $filter != '' && $filter_position == 'above') : ?>
    <div class="custom-search-filter">
      <?php print $filter; ?>
    </div>
  <?php endif; ?>
  <ol class="search-results <?php print $module; ?>-results">
    <?php print $search_results; ?>
  </ol>
  <?php if (isset($filter) && $filter != '' && $filter_position == 'below') : ?>
    <div class="custom-search-filter">
      <?php print $filter; ?>
    </div>
  <?php endif; ?>
  <?php print $pager; ?>
<?php else : ?>
  <h2><?php print t('your search yielded no results');?></h2>
  <?php print search_help('search#noresults', drupal_help_arg()); ?>
<?php endif; ?>
</section>

<script type="text/javascript">
  jQuery('#search-form').appendTo('#search-block');
</script>

  <div class="separador"></div>

<?php 
$node=node_load(11);

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
