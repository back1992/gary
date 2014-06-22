<?php
namespace App\Modules\Clcurl\Models;
class ContentStream extends pdf_readstream
{
	var $operators; 
	function pdf_content_stream(&$data) {
		parent::pdf_readstream($data); 
		$this->allow_references = false; 
		$this->operators = array(); 
		$operands = array(); 
		$textarea = false; 
		while (!$this->eof()) {
			$object = $this->read_object(); 
			if (is_object($object)) {
				//if( is_a($object,'operator') )
				{
					if ($object->value == 'BT') $textarea = true;
					else if ($object->value == 'ET') $textarea = false; 
					if ($textarea) {
						$object->operands = $operands; $this->operators[] = $object;
					}
				}
				
				$operands = array();
			} else $operands[] = $object;
		}
	}
	
	function get_text() {
		$text = ''; 
		reset($this->operators); foreach ($this->operators as $operator) $text.= $operator->get_text(); 
		return $text;
	}
	
	function debug($level = 0) {
		$inset = str_repeat("\t", $level); 
		echo $inset . "content_stream\n"; echo $inset . "(\n"; 
		reset($this->operators); foreach ($this->operators as $operator) {
			echo $operator->debug($level + 1);
		}
		
		echo $inset . ")\n";
	}
}

function pdf_debug($value, $level = 0) {
	$inset = str_repeat("\t", $level); 
	if (is_object($value)) {
		return $value->debug($level);
	} else if (is_array($value)) {
		$str = ''; $str.= $inset . "Array\n"; $str.= $inset . "(\n"; 
		reset($value); while (list($key, $v) = each($value)) {
			if (is_object($v) or is_array($v)) {
				$str.= $inset . "\t" . $key . " =>\n"; $str.= pdf_debug($v, $level + 2);
			} else {
				$str.= $inset . "\t" . $key . " => " . pdf_debug($v);
			}
		}
		
		$str.= $inset . ")\n"; 
		return $str;
	} else if (is_bool($value)) {
		if ($value) return $inset . "true\n";
		else return $inset . "false\n";
	} else if (is_null($value)) {
		return $inset . "NULL\n";
	} else if (is_string($value)) {
		return $inset . "\"$value\"\n";
	} else {
		return $inset . $value . "\n";
	}
}
