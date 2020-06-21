<?php

namespace Drupal\config_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\Core\Entity\t;
use Drupal\config_example\Services\UserService;

/**
 * Class EditUser.
 *
 * @package Drupal\config_example\Form
 */
class EditUser extends FormBase {

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
    if ($form_state->getValue('username') == '' || $form_state->getValue('email') == '') {
      $msg = t('<strong>Username and Email both are required!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
    $email = $form_state->getValue('email');
    if ($email !== '' && !\Drupal::service('email.validator')->isValid($email)) {
      $msg = t('<strong>Enter valid email!</strong>');
      $form_state->setErrorByName('form', $msg);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $user_list = $this->userService->getUserFile();
    $confid_id = \Drupal::request()->get('config_id');
    // echo '<pre>';print($user_list);die();
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#maxlength' => 150,
      '#required' => TRUE,
      '#default_value' => $user_list[$confid_id]['username'],
    ];
    
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#maxlength' => 250,
      '#required' => TRUE,
      '#default_value' => $user_list[$confid_id]['email'],
    ];

    // $form['password'] = [
    //   '#type' => 'password',
    //   '#title' => $this->t('Password'),
    //   '#maxlength' => 150,
    //   '#minlength' => 5,
    //   '#required' => TRUE,
    //   '#default_value' => $user_list[$confid_id]['password'],
    // ];

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
    return 'new_user_form';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $this->userService->updateUser($form_state);
    drupal_set_message($this->t("@message", ['@message' => 'User Updated Successfully.']));
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['user.custom.service'];
  }

}
