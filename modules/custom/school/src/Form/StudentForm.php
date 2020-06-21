<?php

namespace Drupal\school\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;
use Drupal\school\Services\UserService;

/**
 * Class StudentForm.
 *
 * @package Drupal\school\Form
 */
class StudentForm extends FormBase {

  protected $userService;

  /**
   * {@inheritdoc}
   */
  public function __construct(UserService $userService) {
    $this->userService = $userService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('user.custom.service')
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // validate form values
    if ($form_state->getValue('username') == '' || $form_state->getValue('rollno') == '') {
      $msg = t('<strong>Username and Roll Number both are required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 150,
      '#required' => TRUE,
      '#default_value' => '',
    ];
    
    $form['rollno'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Roll Number'),
      '#maxlength' => 250,
      '#required' => TRUE,
      '#default_value' => '',
    ];

    
    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
      //'#attributes' => array('class' => "primary_btn")
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'student_form';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $this->userService->addStudentInfo($form_state);
    drupal_set_message($this->t("@message", ['@message' => 'Student Information Added Successfully.']));
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['user.custom.service'];
  }

}
