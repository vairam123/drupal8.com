<?php
namespace Drupal\calculator\Controller;

class TestController {

	use simpleLog;
	private $height, $width;

	public function __construct( $h, $w ) {
		$this->height = $h;
		$this->width  = $w;
	}

	function printResult() {
		echo '( '.$this->height.' * '.$this->width. ' ) => '. $this->height * $this->width;
	}
}