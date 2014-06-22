<?php
namespace App\Modules\Clcurl\Models;
define('PDF_PATTERN_SEPARATOR', ' \n\r\/\()\[\]');
define('PDF_PATTERN_WHITESPACE', ' \n\r');

class Readstream
{
	var $data;
	var $offset;
	var $size;
	var $allow_references;
	
	function pdf_readstream(&$data, $offset = 0) {
		$this->data = trim($data);
		$this->offset = $offset;
		$this->size = strlen($this->data);
	}
	
	function read_object() {
		$this->skip_whitespace();
		//echo $this->offset."\n";
		
		switch ($this->get_next()) {
			case '0':
			case '1':
			case '2':
			case '3':
			case '4':
			case '5':
			case '6':
			case '7':
			case '8':
			case '9':
			case '.':
			case '-':
			case '+':
				// number, object, reference
				
				$number = $this->read_while("0123456789+-.");
				
				if ($this->allow_references) {
					if ($this->expect(' 0 R')) {
						return $this->mark(new pdf_reference($number . ' 0'));
					} else if ($this->expect(' 0 obj')) {
						$value = $this->read_object();
						
						$this->skip_whitespace();
						
						$this->offset+= 6;
						//$endobj = $this->read(6);
						
						//if( $endobj != 'endobj' )
						//{
						// echo 'Unknown object data:'.$this->get_next(20)." at offset ".$this->offset."\n";
						// exit;
						//}
						
						//$value = new pdf_indirect_object( $value );
						
						if (is_object($value)) return $this->mark($value);
						else return $value;
					}
				}
				
				return (float)$number;
			case '(':
				// string;
				
				$this->offset++;
				
				$value = '';
				
				$level = 1;
				while (true) {
					$next = $this->read();
					
					if ($next == '(') $level++;
					else if ($next == ')') {
						$level--;
						if ($level == 0) break;
					} else if ($next == '\\') {
						$next = $this->read();
						
						switch ($next) {
							case 'n':
								$value.= "\n";
								break;

							case 'r':
								$value.= "\r";
								break;

							case 't':
								$value.= "\t";
								break;

							case 'b':
								$value.= "\b";
								break;

							case 'f':
								$value.= "\f";
								break;

							case '(':
								$value.= "(";
								break;

							case ')':
								$value.= ")";
								break;

							case '\\':
								$value.= "\\";
								break;

							default:
								$next.= $this->read(2);
								$value.= chr(octdec($next));
								break;
						}
					} else $value.= $next;
				}
				
				return $value;
			case '/':
				// name;
				$this->offset++;
				return $this->read_until(PDF_PATTERN_SEPARATOR);
			case '[':
				// array;
				$this->offset++;
				
				$value = array();
				
				while (true) {
					$this->skip_whitespace();
					
					if ($this->get_next() == ']') break;

					
					$value[] = $this->read_object();
				}
				
				$this->offset++;
				return $value;
			case '%':
				// comment;
				$this->offset++;
				
				return $this->read_until(PDF_PATTERN_WHITESPACE);
			case 'read_dictionary() ) !== false )
{
$this->skip_whitespace();

if( $this->expect('stream') )
{
$data_length = $value['Length'];

if( is_object( $data_length ) )
$data_length = $data_length->resolve();

$this->skip_whitespace();
$data = $this->read($data_length);

$this->skip_whitespace();

$this->offset += 9;

#$endstream = $this->read(9);

#if( $endstream != 'endstream' )
#{
# echo 'Unknownobjectdata:
				'.$this->get_next(20)." at offset ".$this->offset."\n";
# exit;
#}

return $this->mark( new pdf_stream( $value, $data ) );
}
else
return $value;
}
else
{
// hex string
$this->offset++;

$hex = $this->read_until(' > ');

$value=pack("H*", $hex);

$this->offset++;

return $value;
}
break;

case 'f':

if( $this->expect('false') )
return false;

break;

case 'n':

if( $this->expect('null') )
return null;

break;

case 's':

if( $this->expect('startxref') )
{
$this->skip_whitespace();
$value = $this->read_while("0123456789");

return $this->mark( new pdf_startxref($value) );
}
break;

case 't':

if( $this->expect('true') )
return true;
else if( $this->expect('trailer') )
{
$value = $this->read_object();
$value = $this->mark( new pdf_trailer($value) );
}

break;
}

return new pdf_operator( $this->read_until(PDF_PATTERN_SEPARATOR) );
}

function read_dictionary()
{
if( $this->expect(' < skip_whitespace();
				
				if ($this->expect('>>')) break;

				
				$value[$this->read_object() ] = $this->read_object();
			}
			
			return $value;
		} else return false;
	}
	
	function mark($child) {
		$child->parent = $this;
		
		return $child;
	}
	
	function skip($count = 1) {
		$this->offset+= $count;
	}
	
	function read($count = 1) {
		$v = substr($this->data, $this->offset, $count);
		$this->offset+= $count;
		return $v;
	}
	
	function expect($str) {
		$l = strlen($str);
		
		if (substr($this->data, $this->offset, $l) == $str) {
			$this->offset+= $l;
			return true;
		} else return false;
	}
	
	function get_next($count = 1) {
		return substr($this->data, $this->offset, $count);
	}
	
	function skip_whitespace() {
		preg_match('/[' . PDF_PATTERN_WHITESPACE . ']*/', $this->data, $matches, 0, $this->offset);
		
		$this->offset+= strlen($matches[0]);
	}
	
	function skip_until($chars) {
		preg_match('/[^' . $chars . ']*/', $this->data, $matches, 0, $this->offset);
		
		$this->offset+= strlen($matches[0]);
	}
	
	function skip_while($chars) {
		preg_match('/[' . $chars . ']*/', $this->data, $matches, 0, $this->offset);
		
		$this->offset+= strlen($matches[0]);
	}
	
	function read_until($chars) {
		preg_match('/[^' . $chars . ']*/', $this->data, $matches, 0, $this->offset);
		
		$this->offset+= strlen($matches[0]);
		
		return $matches[0];
	}
	
	function read_while($chars) {
		preg_match('/[' . $chars . ']*/', $this->data, $matches, 0, $this->offset);
		
		$this->offset+= strlen($matches[0]);
		
		return $matches[0];
	}
	
	function jump($offset) {
		$this->offset = $offset;
	}
	
	function eof() {
		return $this->offset >= strlen($this->data);
	}
}

