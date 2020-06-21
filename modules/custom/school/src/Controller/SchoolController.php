<?php

namespace Drupal\school\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * SchoolController controller.
 *
 * @package Drupal\school\Controller
 */
class SchoolController extends ControllerBase {

  /**
   * Database connection class.
   *
   * @var Drupal\Core\Database\Database
   */
  private $database;

  /**
   * Controller construct.
   */
  public function __construct() {
    $this->database = Database::getConnection();
  }

  /**
   * Add student role to a user.
   */
  public function addStudentRole($userid) {

    //Load user with user ID 
    $user = User::load($userid);
    $user->addRole('student');
    $user->save();

    $response = new RedirectResponse("/student-request");
    $response->send();
    drupal_set_message(t('Student Role Added!'), 'status', TRUE);
    return;
  }

}
