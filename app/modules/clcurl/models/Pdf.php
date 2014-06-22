<?php
namespace App\Modules\Clcurl\Models;
class Pdf extends pdf_readstream
{
	var $catalog;
	var $xref_table;
	
	function pdf($filename) {
		parent::pdf_readstream(file_get_contents($filename));
		
		$this->xref_table = array();
		$this->objects_at_offsets = array();
		
		$this->allow_references = true;
		
		$this->jump(strrpos($this->data, 'startxref'));
		
		$this->expect('startxref');
		
		$offset = $this->read_object();
		
		$this->parse_xref($offset);
		
		if (isset($this->catalog)) $this->catalog = $this->catalog->resolve();
	}
	
	function parse_xref($offset) {
		$this->jump($offset);
		
		$this->expect('xref');
		
		while (true) {
			$this->skip_whitespace();
			
			if ($this->expect('trailer')) break;

			
			$start = $this->read_while('0123456789');
			
			$this->skip_whitespace();
			$count = $this->read_while('0123456789');
			
			for ($n = 0; $nskip_whitespace(); $line = $this->read_while('0123456789 fn'); 
			list($offset, $generation, $type) = explode(' ', $line); 
			$generation = (int)$generation; 
			$this->xref_table[$number . ' ' . $generation] = (int)$offset;
		}
	}
	
	$this->skip_whitespace(); $trailer = $this->read_dictionary(); 
	if (isset($trailer['Root'])) $this->catalog = $trailer['Root']; 
	if (isset($trailer['Prev'])) $this->parse_xref($trailer['Prev']);
}

function get_pages() {
	$pages = array(); 
	$this->add_pages($this->catalog['Pages']->resolve() , $pages); 
	return $pages;
}

function add_pages($array, &$pages) {
	$type = $array['Type']; 
	if ($type == 'Pages') {
		$kids = $array['Kids']; 
		foreach ($kids as $kid) $this->add_pages($kid->resolve() , $pages);
	} else if ($type == 'Page') {
		$pages[] = new pdf_page($array);
	}
}

function get_dimensions($array = false) {
	$pages = $this->get_pages(); 
	return $pages[0]->get_dimensions();
}

function debug() {
	return pdf_debug($this->catalog);
}

function resolve($reference) {
	$old_offset = $this->offset; 
	$this->offset = $this->xref_table[$reference->value]; 
	$value = $this->read_object(); 
	$this->offset = $old_offset; 
	return $value;
}
}
