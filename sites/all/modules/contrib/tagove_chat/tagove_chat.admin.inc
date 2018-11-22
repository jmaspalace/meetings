<?php

/**
 * @file
 * Administrative page callbacks for the Tagove chat module.
 */


/**
 * Builds the settings form for the tagovechat module.
 */
function tagove_chat_admin_settings_form($form, &$form_state) {
  $form['account']['tagove_chat_account'] = array(
    '#type' => 'textfield',
    '#title' => t('tagovechat account number'),
    '#description' => tagove_chat_account_number() == '' ? t("Don't have an account yet? <a href=\"!url\" target=\"_blank\">Register here.</a>", array('!url' => tagove_chat_registration_url())) : '',
    '#default_value' => tagove_chat_account_number(),
    '#size' => 15,
    '#maxlength' => 20,
    '#required' => TRUE,
  );

  // Allow users to restrict LiveChat by page path.
  $form['page_visibility'] = array(
    '#type' => 'fieldset',
    '#title' => t('Page based LiveChat visibility'),
  );
  $form['page_visibility']['tagove_chat_visibility'] = array(
    '#type' => 'radios',
    '#title' => t('Restrict the LiveChat widget to specific pages'),
    '#options' => array(
      0 => t('Add LiveChat to every page except the pages listed below.'),
      1 => t('Add LiveChat to only the pages listed below.'),
    ),
    '#default_value' => variable_get('tagove_chat_visibility', 0),
  );
  $form['page_visibility']['tagove_chat_pages'] = array(
    '#type' => 'textarea',
    '#title' => t('Pages'),
    '#default_value' => variable_get('tagove_chat_pages', ''),
    '#description' => t("Enter one page per line as Drupal paths. The '*' character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.", array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
    '#wysiwyg' => FALSE,
  );

  // Build an options list of roles to exclude from LiveChat.
  $options = array();

  foreach (user_roles() as $rid => $name) {
    $options[$rid] = check_plain($name);
  }

  $form['role_visibility'] = array(
    '#type' => 'fieldset',
    '#title' => t('Role based LiveChat visibility'),
  );
  $form['role_visibility']['tagove_chat_roles'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Do not show the LiveChat widget to users with any of these roles'),
    '#default_value' => variable_get('tagove_chat_roles', array()),
    '#options' => $options,
    '#description' => t('If no roles are selected, all users will see the LiveChat widget.'),
  );

  return system_settings_form($form);
}
