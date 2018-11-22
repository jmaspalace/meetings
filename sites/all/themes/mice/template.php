<?php 

function get_menu_language($tree,$langcode){
  $tree = menu_tree_all_data($tree);
  foreach ($tree as $index => $item) {     
    $link = $item['link'];
      if ($item['link']['language']!=$langcode) {            
        unset($tree[$index]);      
      } 
  }
  return $tree;
}


function mice_pre_render($element) {
  if (!empty($element['#bootstrap_ignore_pre_render'])) {
    return $element;
  }

  // Only add the "form-control" class for specific element input types.
  $types = array(
    // Core.
    'password',
    'password_confirm',
    'machine_name',
    'select',
    'textarea',
    'textfield',

    // Elements module (HTML5).
    'date',
    'datefield',
    'email',
    'emailfield',
    'number',
    'numberfield',
    'range',
    'rangefield',
    'search',
    'searchfield',
    'tel',
    'telfield',
    'url',
    'urlfield',

    // Webform module.
    'webform_email',
    'webform_number',
  );

  // Add necessary classes for specific types.
  if ($type = !empty($element['#type']) ? $element['#type'] : FALSE) {
    if (in_array($type, $types) || ($type === 'file' && empty($element['#managed_file']))) {
      $i=0;
      foreach ($element['#attributes']['class'] as $item) {        
        if ($item=="form-control") {
          unset($element['#attributes']['class'][$i]);
        }
        $i++;
      }
      
    }
    if ($type === 'machine_name') {
      $element['#wrapper_attributes']['class'][] = 'form-inline';
    }
  }

  // Add smart descriptions to the element, if necessary.
  bootstrap_element_smart_description($element);

  // Return the modified element.
  return $element;
}


function mice_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
    'info' => t('Informative message'),
  );

  // Map Drupal message types to their corresponding Bootstrap classes.
  // @see http://twitter.github.com/bootstrap/components.html#alerts
  $status_class = array(
    'status' => 'success',
    'error' => 'danger',
    'warning' => 'warning',
    // Not supported, but in theory a module could send any type of message.
    // @see drupal_set_message()
    // @see theme_status_messages()
    'info' => 'info',
  );

  // Retrieve messages.
  $message_list = drupal_get_messages($display);

  // Allow the disabled_messages module to filter the messages, if enabled.
  if (module_exists('disable_messages') && variable_get('disable_messages_enable', '1')) {
    $message_list = disable_messages_apply_filters($message_list);
  }

  foreach ($message_list as $type => $messages) {
    $class = (isset($status_class[$type])) ? ' alert-' . $status_class[$type] : '';
    $output .= "<div class=\"alert alert-block$class messages $type\">\n";
    $output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>\n";

    if (!empty($status_heading[$type])) {
      $output .= '<h4 class="element-invisible">' . filter_xss_admin($status_heading[$type]) . "</h4>\n";
    }

    if (count($messages) > 1) {
      $output .= " <ul>\n";
      foreach ($messages as $message) {
        $output .= '  <li>' . filter_xss_admin($message) . "</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
      $output .= filter_xss_admin($messages[0]);
    }

    $output .= "</div>\n";
  }
  return $output;
}

?>