<?php

/**
 * @file
 * Provides an additional config form for theme settings.
 */

use Drupal\Core\Form\FormStateInterface;

function training_form_system_theme_settings_alter(array &$form, FormStateInterface $form_state) {
  $form['training_settings']= array(
    '#type' => 'details',
    '#title' => t('Training Settings'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#group' => 'bootstrap',
    '#weight' => 10,
  );

  #social links    
    
  $form['training_settings']['social_links']['facebook_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook'),
    '#description' => t('Please enter your facebook url'),
    '#default_value' => theme_get_setting('facebook_url'),
  );
   $form['training_settings']['social_links']['twitter_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter'),
    '#description' => t('Please enter your twitter url'),
    '#default_value' => theme_get_setting('twitter_url'),
  );
  $form['training_settings']['social_links']['instagram_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Instagram'),
    '#description' => t('Please enter your instagram url'),
    '#default_value' => theme_get_setting('instagram_url'),
  );
  $form['training_settings']['social_links']['google_plus_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Plus'),
    '#description' => t('Please enter your google-plus url'),
    '#default_value' => theme_get_setting('google_plus_url'),
  );

  //footer custom text
  $form['training_settings']['secondary_footer'] = array(
    '#type' => 'details',
    '#title' => t('Footer Section'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $sub_footer = theme_get_setting('sub_footer');
  $form['training_settings']['secondary_footer']['sub_footer'] = array(
    '#type' => 'text_format',
    '#title' => t('Footer Description'),
    '#description' => t('Please enter footer description...'),
    '#default_value' => $sub_footer['value'],
    '#foramt'        => $sub_footer['format'],
  );
    
}
 
