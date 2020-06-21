<?php

  namespace Drupal\calculator\Form;

  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;

  class CalculatorForm extends FormBase {

    public function getFormId() {
      return 'calculator_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {
      $form['first_val'] = array(
        '#type' => 'textfield',
        '#title' => t('First Value'),
        '#required' => TRUE
      );
	  
	  $form['second_val'] = array(
        '#type' => 'textfield',
        '#title' => t('Second Value'),
        '#required' => TRUE
      );

      $form['operation'] = array(
        '#type' => 'select',
        '#title' => t('Select Operation'),
        '#options' => [
          'add' => t('Add'),
          'subtract' => t('Subtract'),
          'multiply' => t('Multiply'),
          'divide' => t('Divide')
        ],
        '#required' => TRUE
      );     

      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
      );
      return $form;
	  
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
      if(!is_numeric($form_state->getValue('first_val'))) {
        $form_state->setErrorByName('first_val', t('The first digit must be a valid numeric value'));
      }

      if(!is_numeric($form_state->getValue('second_val'))) {
        $form_state->setErrorByName('second_val', t('The second digit must be a valid numeric value'));
      }
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
      $op = $form_state->getValue('operation');
      switch ($op) {
        case 'add':
          $form_state->setRedirect('calculator_add', ['first_val' => $form_state->getValue('first_val'), 'second_val' => $form_state->getValue('second_val')]);
          break;
        case 'subtract':
          $form_state->setRedirect('calculator_subtract', ['first_val' => $form_state->getValue('first_val'), 'second_val' => $form_state->getValue('second_val')]);
          break;
        case 'multiply':
          $form_state->setRedirect('calculator_multiply', ['first_val' => $form_state->getValue('first_val'), 'second_val' => $form_state->getValue('second_val')]);
          break;
        case 'divide':
          $form_state->setRedirect('calculator_divide', ['first_val' => $form_state->getValue('first_val'), 'second_val' => $form_state->getValue('second_val')]);
          break;
        default:
          break;
      }
    }
  }

 ?>
