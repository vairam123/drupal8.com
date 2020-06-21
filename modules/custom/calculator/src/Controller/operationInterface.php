<?php
namespace Drupal\calculator\Controller;

interface operationInterface {
	public function add($first_val, $second_val);
	public function subtract($first_val, $second_val);
	public function multiply($first_val, $second_val);
	public function divide($first_val, $second_val);
}