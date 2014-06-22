<?php
namespace App\Modules\Clcurl\Models;
class Operator extends pdf_object
{
	var $operands; 
	function debug($level = 0) {
		$inset = str_repeat("\t", $level); 
		echo $inset . "operator( " . $this->value . " )\n"; 
		if (count($this->operands)) {
			echo $inset . "(\n"; 
			reset($this->operands); foreach ($this->operands as $operand) {
				echo pdf_debug($operand, $level + 1);
			}
			
			echo $inset . ")\n";
		}
	}
	
	function get_text() {
		switch ($this->value) {
			case 'Tj':
				return $this->operands[0];
			case '\'':
				return "\n" . $this->operands[0];
			case '"':
				return "\n" . $this->operands[2];
			case 'TJ':
				
				$string = ''; 
				$parts = $this->operands[0]; 
				foreach ($parts as $part) if (is_string($part)) $string.= $part;
				else if ($partoperands[1];
				
				if ($delta_y != 0) return "\n";
				else return '';
			case 'Tm':
				
				$delta_y = $this->operands[5];
				
				if ($delta_y != 0) return "\n";
				else return '';
			case 'T*':
				return "\n";
			default:
				return '';
			}
		}
	}
	