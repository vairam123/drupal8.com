<?php

  namespace Drupal\calculator\Controller;

  class CalculatorController {

    public function add(int $first_val, int $second_val) {
      $sum = $first_val + $second_val;
      $printStr = '( '.$first_val.' + '. $second_val .' ) => '.$sum;
      return array(
        '#title' => 'Sum',
        '#markup' => sprintf('The sum of <strong>%s</strong> and <strong>%s</strong> is <strong>%s</strong> '.$printStr , $first_val, $second_val, $sum)
      );
    }

    public function subtract(int $first_val, int $second_val) {
      $difference = $first_val - $second_val;

      return array(
        '#title' => 'Difference',
        '#markup' => sprintf('The difference of <strong>%s</strong> and <strong>%s</strong> is <strong>%s</strong>', $first_val, $second_val, $difference)
      );
    }

    public function multiply(int $first_val, int $second_val) {
      $product = $first_val * $second_val;

      return array(
        '#title' => 'Product',
        '#markup' => sprintf('The product of <strong>%s</strong> and <strong>%s</strong> is <strong>%s</strong>', $first_val, $second_val, $product)
      );
    }

    public function divide(int $first_val, int $second_val) {
      $quotient = $first_val / $second_val;

      return array(
        '#title' => 'Quotient',
        '#markup' => sprintf('The quotient of <strong>%s</strong> and <strong>%s</strong> is <strong>%s</strong>', $first_val, $second_val, $quotient)
      );
    }

  }

 ?>
