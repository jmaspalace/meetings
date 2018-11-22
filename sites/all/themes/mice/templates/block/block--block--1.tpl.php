<?php 
  global $language;
          if ($language->language=="en") {
            $menu_top = menu_tree_all_data( "menu-menu-top-en");
          }else{
            $menu_top = menu_tree_all_data( "menu-menu-top-es");
          }                    
  if($language->language=="es"){
    $home="/es";
  }else{
    $home="/en";
  }      
?>
<div class="container-header">
      <div class="col-md-3 col-sm-2 col-xs-6">
        <a href="<?php print $home ?>" class="logo-desktop"><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logoBrand.png" alt="" class="img-responsive logo-mice"></a>
        <a href="<?php print $home ?>" class="logo-mobile"><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/logoMobile.png" title="le blanc brand" alt="le blanc brand">
        </a>
      </div>
      <div class="col-md-9 col-sm-10 col-xs-6 content-menu">
        <div class="icon-menu"></div>

        <div class="menu-superior left">
          <ul>
            <?php 
            foreach ($menu_top as $item) {
             $child = $item[ "link" ];              
            $pos = strpos($child[ "href" ], "node");                
               if ($child[ "href" ]=="<front>") {
                $child[ "href" ]=$home;    
                }elseif ($pos !== false) {
                $child[ "href" ]="/".$language->language."/".drupal_get_path_alias($child[ "href" ], $language->language);
               }           
             ?>
            <li>
              <a href="<?php print $child['href'] ?>"><?php print $child['link_title'] ?></a>
            </li> 
             <?php
            }
            ?>
                       
          </ul>
        </div>
        <?php 
        if ($language->language=="en") {
          $principal_phone=variable_get('phone-en');
        }else{
          $principal_phone=variable_get('phone-es');
        }

        ?>

        <div class="menu-superior">
          <ul>
            <li>
              <div class="dropdown dropdown-tels">
                <div data-toggle="dropdown">
                  <img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon-tel.png" alt=""> <?php print $principal_phone ?>
                  <span class="caret"></span>
                </div>
                <ul class="dropdown-menu">
                  <?php 
                    $phones = menu_tree_all_data( "menu-phones");
                      foreach( $phones as $menu1 ){      
                             if ($menu1['link']['hidden']==0) {  
                        $child = $menu1[ "link" ];    
                        $link=explode(":", $child['link_title']);                        
                        $titulo=$link[0];
                        $numero=$link[1];
                        ?>
                        <li><span><?php print t($titulo); ?>:</span> <?php print $numero ?> </li>
                        <?php
                      }
                      }
                  ?>                
                </ul>
              </div>
            </li>
            <li>
              <div class="dropdown dropdown-idioma">
                <div data-toggle="dropdown">
                  ENG
                  <span class="caret"></span>
                </div>
                <ul class="dropdown-menu">
                  <li><a href="/en">ENG</a></li>
                  <li><a href="/es">ESP</a></li>
                </ul>
              </div>
            </li>
            <li>
              <div class="search_desktop"></div>
              <div class="search_input">
                <form class="search_form" id="buscador">
                  <input type="text" name="search_word" id="parametro_search" placeholder="Search">
                  <input type="submit" value="">
                </form>
                <div class="close">x</div>
              </div>
            </li>
          </ul>
        </div>
        <nav>
          <div class="close-back"></div>
          <div class="container-nav">
            <div class="close" id="closeMenu">x</div>
            <ul class="menu">
              <?php 

              if ($language->language=="en") {
            $menu_principal = menu_tree_all_data( "main-menu");
          }else{
            $menu_principal = menu_tree_all_data( "menu-main-menu-es");
          }  

            foreach ($menu_principal as $menu1) {
              $child = $menu1[ "link" ];     

              if (strtoupper($child['link_title'])=="RESORTS") {
                //inicio menú especial resorts
                $vocabulary = taxonomy_vocabulary_machine_name_load('marcas');
                $terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid,'language' => $language->language));
                $option="";
                foreach ($terms as $brand) {
                  $option.='<option value="'.$brand->tid.'">'.$brand->name.'</option>';
                }
                $vocabulary = taxonomy_vocabulary_machine_name_load('lugares');
                $lugares_terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid,'language' => $language->language));         
                $pos = strpos($child[ "href" ], "node");                
               if ($child[ "href" ]=="<front>") {
                $child[ "href" ]=$home;    
                }elseif ($pos !== false) {
                $child[ "href" ]="/".$language->language."/".drupal_get_path_alias($child[ "href" ], $language->language);
               }                                                      
                
                ?>                
                <li class="down">
                <a href="<?php print $child[ "href" ] ?>">Resorts</a>
                <div class="submenu">
                  <div class="triangulo"></div>
                  <div class="container">
                    <div class="col-md-3 col-sm-3 col-xs-12 filters">
                      <p class="title"><?php print t('BRANDS') ?></p>
                      <select id="brand-type">                        
                      <?php print $option ?>
                      <option value="0" selected><?php print t('View All') ?></option>
                      </select>
                      <p class="title"><?php print t('HOTEL TYPE') ?></p>
                      <select id="number-rooms">
                        <option value="100"><?php print t('Up to 100 rooms') ?></option>
                        <option value="400"><?php print t('101 - 400 rooms') ?></option>
                        <option value="401"><?php print t('+ 400 rooms') ?></option>
                        <option value="0" selected><?php print t('View All') ?></option>
                      </select>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12 search_results">
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <h3><?php print t('Destination and Resorts') ?></h3>
                        </div>
                      </div>
                      <div class="row" id="filter-content-resorts">
                        <?php
                        foreach ($lugares_terms as $lugar) {
                          $view = views_get_view('resort_menu');
                          $view->set_display('block_1');
                          $view->set_arguments(array($lugar->tid));
                          $view->execute(); 
                          ?>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                          <p class="title"><?php print $lugar->name ?></p>
                          <ul>
                            <?php 
                            foreach ($view->result as $room) {                                                  
                              $item=$room->_field_data['nid']['entity'];

                              ?>
                              <li>
                              <a href="<?php print $item->field_call_to_action['und'][0]['url'] ?>"><?php print $room->node_title ?></a>
                              <p class="number_rooms"><span><?php print $item->field_rooms['und'][0]['value'] ?></span> <?php print t('Rooms') ?></p>
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
                  </div>
                </div>
              </li>
                <?php
              }else{



              $pos = strpos($child[ "href" ], "node");                
               if ($child[ "href" ]=="<front>") {
                $child[ "href" ]=$home;    
                }elseif ($pos !== false) {
                $child[ "href" ]="/".$language->language."/".drupal_get_path_alias($child[ "href" ], $language->language);
               }                               
              ?>
                 <li class="down">
                      <a href="<?php print $child['href'] ?>"><?php print $child['link_title'] ?></a>
                      <?php 
                        if (!empty($menu1['below'])) {
                      ?>
                      <div class="submenu submenu-normal">
                        <div class="triangulo"></div>
                        <div class="container">
                          <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <h3><?php print $child['link_title'] ?></h3>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                              <ul>
                                <?php 
                                  foreach ($menu1['below'] as $menu2) {
                                    $children=$menu2['link'];
                                     $pos = strpos($children[ "href" ], "node");                
                                     if ($children[ "href" ]=="<front>") {
                                      $children[ "href" ]=$home;    
                                      }elseif ($pos !== false) {
                                      $children[ "href" ]="/".$language->language."/".drupal_get_path_alias($children[ "href" ], $language->language);
                                     }        
                                ?>
                                <li><a href="<?php print $children['href'] ?>"><?php print $children['link_title'] ?></a></li>                                
                                <?php 
                                  }
                                ?>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                      }
                      ?>
                    </li>

              <?php
            }
              }
              ?>                                            
            </ul>
            <?php 
              if ($language->language=="en") {
              $form=variable_get('url-boton-en');
            }else{
              $form=variable_get('url-boton-es');
            }

            ?>
            <a href="<?php print $form ?>" class="enlace request"><?php print t("Request for Proposal") ?></a>
            <div class="menu-redes">
              <ul>
                <li><a href=""><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon1.png"></a></li>
                <li><a href=""><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon2.png"></a></li>
                <li><a href=""><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon3.png"></a></li>
                <li><a href=""><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon4.png"></a></li>
                <li><a href=""><img src="<?= base_path().drupal_get_path('theme', 'mice') ?>/images/icon5.png"></a></li>
              </ul>
              <select>
                <option>ENG</option>
                <OPTION>ESP</OPTION>
              </select>
            </div>
          </div>
        </nav>
      </div>
    </div>