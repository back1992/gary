<?php
namespace App\Modules\Clcurl\Models;
class Object
{
	var $parent; var $value; 
	function pdf_object($value) {
		$this->value = $value;
	}
	
	function resolve() {
		return $this;
	}
	
	function get_value() {
		return $this->value;
	}
	
	function debug($level = 0) {
		$inset = str_repeat("\t", $level); 
		$str = $inset . get_class($this) . ' : ' . "\n"; 
		$str.= $inset . "(\n"; $str.= pdf_debug($this->value, $level + 1); $str.= $inset . ")\n"; 
		return $str;
	}
}
