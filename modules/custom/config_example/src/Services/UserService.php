<?php

namespace Drupal\config_example\Services;

use Drupal\Core\Database\Connection;

/**
 * CRUD operation for the custom configuration.
 *
 * @package Drupal\config_example\Services
 */
class UserService {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;

  /**
   * {@inheritdoc}
   */
  public function __construct(Connection $conn) {
    $this->database = $conn;
  }

  /**
   * Save configuration.
   *
   * @param array $post
   *   It will hold the custom configuration value.
   *
   * @return array
   *   It will provide the message with the status.
   */
  public function addNewUser($form_state)
  {
    
    $user_list = file_get_contents('user.json');

    if($user_list && $user_list != '') {
      $user_list = json_decode($user_list);
      $uniqueId = count($user_list) + 1;
      echo '<pre>';print_r($user_list);die();
    } else {
      $uniqueId = 1;
      $user_list = [];
    }
     
    $user_list[$uniqueId] = [
      'id' => $uniqueId,
      'username' => $form_state->getValue('username'),
      'email' => $form_state->getValue('email'),
      'password' => $form_state->getValue('password')
    ];
    
    $fp = fopen('user.json', 'w');
    fwrite($fp, json_encode($user_list, JSON_PRETTY_PRINT));
    fclose($fp);
  }
  

  /**
   * Updating the value.
   *
   * @param array $post
   *   This will have the name, value and status in an array.
   *
   * @return array
   *   This  will have the status and message.
   */
  public function updateUser($form_state) {
    $user_list = file_get_contents('user.json');
    $user_list = json_decode($user_list, true);
    $confid_id = \Drupal::request()->get('config_id');
    $user_list[$confid_id] = [
      'username' => $form_state->getValue('username'),
      'email' => $form_state->getValue('email')
    ];
    
    $fp = fopen('user.json', 'w');
    fwrite($fp, json_encode($user_list, JSON_PRETTY_PRINT));
    fclose($fp);
  }

  
  public function getUserFile() {
    $user_list = file_get_contents('user.json');
    return json_decode($user_list, true);
  }
  
  
}
