<?php

namespace Drupal\school\Services;

use Drupal\Core\Database\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * CRUD operation for the custom configuration.
 *
 * @package Drupal\school\Services
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
  public function addStudentInfo($form_state)
  {
    //$conn = Database::getConnection();
    $this->database->insert('students')->fields(
      array(
        'uid'    => \Drupal::currentUser()->id(),
        'name'   => $form_state->getValue('username'),
        'rollno' => $form_state->getValue('rollno'),
        'status' => 1
      )
    )->execute();

    // $url = \Url::fromRoute('/thank-you');
    // $form_state->setRedirectUrl($url);
    $response = new RedirectResponse("/thank-you");
    $response->send();
    return;
  }
 
}
