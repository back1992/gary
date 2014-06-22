<?php
namespace App\Modules\Clcurl\Models;
class Stream extends pdf_object
{
	var $data; function pdf_stream($value, &$data) {
		$this->value = $value; $this->data = $data;
	}
	
	function get_data() {
		$object = $this->resolve(); 
		$filter = $object->value['Filter']; 
		switch ($filter) {
			case false:
				return $object->data;
			case 'FlateDecode':
				
				$data = @gzuncompress($object->data); 
				if (!$data) {
					//file_put_contents('data.bin',$object->data);
					return false;
				}
				
				return $data;
			default:
				return false;
		}
	}
	
	function get_text() {
		return $this->get_content_stream()->get_text();
	}
}

