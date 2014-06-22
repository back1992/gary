<?php
namespace App\Modules\Clcurl\Models;
class Clcurl
{
	public static function decodeAsciiHex($input) {
		$output = "";
		
		$isOdd = true;
		$isComment = false;
		
		for ($i = 0, $codeHigh = - 1; $i < strlen($input) && $input[$i] != '>'; $i++) {
			$c = $input[$i];
			
			if ($isComment) {
				if ($c == '\r' || $c == '\n') $isComment = false;
				continue;
			}
			
			switch ($c) {
				case '\0':
				case '\t':
				case '\r':
				case '\f':
				case '\n':
				case ' ':
				break;

				case '%':
				$isComment = true;
				break;

				default:
				$code = hexdec($c);
				if ($code === 0 && $c != '0') return "";

				if ($isOdd) $codeHigh = $code;
				else $output.= chr($codeHigh * 16 + $code);

				$isOdd = !$isOdd;
				break;
			}
		}

		if ($input[$i] != '>') return "";

		if ($isOdd) $output.= chr($codeHigh * 16);

		return $output;
	}
	public static function decodeAscii85($input) {
		$output = "";

		$isComment = false;
		$ords = array();

		for ($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {
			$c = $input[$i];

			if ($isComment) {
				if ($c == '\r' || $c == '\n') $isComment = false;
				continue;
			}

			if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ') continue;
			if ($c == '%') {
				$isComment = true;
				continue;
			}
			if ($c == 'z' && $state === 0) {
				$output.= str_repeat(chr(0) , 4);
				continue;
			}
			if ($c < '!' || $c > 'u') return "";

			$code = ord($input[$i]) & 0xff;
			$ords[$state++] = $code - ord('!');

			if ($state == 5) {
				$state = 0;
				for ($sum = 0, $j = 0; $j < 5; $j++) $sum = $sum * 85 + $ords[$j];
					for ($j = 3; $j >= 0; $j--) $output.= chr($sum >> ($j * 8));
				}
		}
		if ($state === 1) return "";
		elseif ($state > 1) {
			for ($i = 0, $sum = 0; $i < $state; $i++) $sum+= ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);
				for ($i = 0; $i < $state - 1; $i++) $ouput.= chr($sum >> ((3 - $i) * 8));
			}

		return $output;
	}
	public static function decodeFlate($input) {
		return @gzuncompress($input);
	}
	public static function getObjectOptions($object) {
		$options = array();
		if (preg_match("#<<(.*)>>#ismU", $object, $options)) {
			$options = explode("/", $options[1]);
			@array_shift($options);

			$o = array();
			for ($j = 0; $j < @count($options); $j++) {
				$options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));
				if (strpos($options[$j], " ") !== false) {
					$parts = explode(" ", $options[$j]);
					$o[$parts[0]] = $parts[1];
				} else $o[$options[$j]] = true;
			}
			$options = $o;
			unset($o);
		}

		return $options;
	}
	public static function getDecodedStream($stream, $options) {
		$data = "";
		if (empty($options["Filter"])) $data = $stream;
		else {
			$length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);
			$_stream = substr($stream, 0, $length);

			foreach ($options as $key => $value) {
				if ($key == "ASCIIHexDecode") $_stream = self::decodeAsciiHex($_stream);
				if ($key == "ASCII85Decode") $_stream = self::decodeAscii85($_stream);
				if ($key == "FlateDecode") $_stream = self::decodeFlate($_stream);
			}
			$data = $_stream;
		}
		return $data;
	}
	public static function getDirtyTexts(&$texts, $textContainers) {
		for ($j = 0; $j < count($textContainers); $j++) {
			if (preg_match_all("#\[(.*)\]\s*TJ#ismU", $textContainers[$j], $parts)) $texts = array_merge($texts, @$parts[1]);
			elseif (preg_match_all("#Td\s*(\(.*\))\s*Tj#ismU", $textContainers[$j], $parts)) $texts = array_merge($texts, @$parts[1]);
		}
	}
	public static function getCharTransformations(&$transformations, $stream) {
		preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);
		preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);

		for ($j = 0; $j < count($chars); $j++) {
			$count = $chars[$j][1];
			$current = explode("\n", trim($chars[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++) {
				if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]) , $map)) $transformations[str_pad($map[1], 4, "0") ] = $map[2];
			}
		}
		for ($j = 0; $j < count($ranges); $j++) {
			$count = $ranges[$j][1];
			$current = explode("\n", trim($ranges[$j][2]));
			for ($k = 0; $k < $count && $k < count($current); $k++) {
				if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]) , $map)) {
					$from = hexdec($map[1]);
					$to = hexdec($map[2]);
					$_from = hexdec($map[3]);

					for ($m = $from, $n = 0; $m <= $to; $m++, $n++) $transformations[sprintf("%04X", $m) ] = sprintf("%04X", $_from + $n);
				} elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]) , $map)) {
					$from = hexdec($map[1]);
					$to = hexdec($map[2]);
					$parts = preg_split("#\s+#", trim($map[3]));

					for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++) $transformations[sprintf("%04X", $m) ] = sprintf("%04X", hexdec($parts[$n]));
				}
		}
	}
}
public static function getTextUsingTransformations($texts, $transformations) {
	$document = "";
	for ($i = 0; $i < count($texts); $i++) {
		$isHex = false;
		$isPlain = false;

		$hex = "";
		$plain = "";
		for ($j = 0; $j < strlen($texts[$i]); $j++) {
			$c = $texts[$i][$j];
			switch ($c) {
				case "<":
				$hex = "";
				$isHex = true;
				break;

				case ">":
				$hexs = str_split($hex, 4);
				for ($k = 0; $k < count($hexs); $k++) {
					$chex = str_pad($hexs[$k], 4, "0");
					if (isset($transformations[$chex])) $chex = $transformations[$chex];
					$document.= html_entity_decode("&#x" . $chex . ";");
				}
				$isHex = false;
				break;

				case "(":
					$plain = "";
					$isPlain = true;
					break;

					case ")":
$document.= $plain;
$isPlain = false;
break;

case "\\":
$c2 = $texts[$i][$j + 1];
if (in_array($c2, array(
	"\\",
	"(",
		")"
	))) $plain.= $c2;
	elseif ($c2 == "n") $plain.= '\n';
elseif ($c2 == "r") $plain.= '\r';
elseif ($c2 == "t") $plain.= '\t';
elseif ($c2 == "b") $plain.= '\b';
elseif ($c2 == "f") $plain.= '\f';
elseif ($c2 >= '0' && $c2 <= '9') {
	$oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));
	$j+= strlen($oct) - 1;
	$plain.= html_entity_decode("&#" . octdec($oct) . ";");
}
$j++;
break;

default:
if ($isHex) $hex.= $c;
if ($isPlain) $plain.= $c;
break;
}
}
$document.= "\n";
}

return $document;
}
public static function pdf2text($filename) {
	$infile = @file_get_contents($filename, FILE_BINARY);
	if (empty($infile)) return "";

	$transformations = array();
	$texts = array();

	preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);
	$objects = @$objects[1];

	for ($i = 0; $i < count($objects); $i++) {
		$currentObject = $objects[$i];

		if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {
			$stream = ltrim($stream[1]);

			$options = self::getObjectOptions($currentObject);
			if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"]))) continue;

			$data = self::getDecodedStream($stream, $options);
			if (strlen($data)) {
				if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {
					$textContainers = @$textContainers[1];
					getDirtyTexts($texts, $textContainers);
				} else self::getCharTransformations($transformations, $data);
			}
		}
	}

	return self::getTextUsingTransformations($texts, $transformations);
}
public static function pdf2txt2($filename){

	$data = getFileData($filename);

// grab objects and then grab their contents (chunks)
	$a_obj = getDataArray($data,"obj","endobj");
	foreach($a_obj as $obj){

		$a_filter = getDataArray($obj,"<<",">>");
		if (is_array($a_filter)){
			$j++;
			$a_chunks[$j]["filter"] = $a_filter[0];

			$a_data = getDataArray($obj,"stream\r\n","endstream");
			if (is_array($a_data)){
				$a_chunks[$j]["data"] = substr($a_data[0],strlen("stream\r\n"),strlen($a_data[0])-strlen("stream\r\n")-strlen("endstream"));
			}
		}
	}

// decode the chunks
	foreach($a_chunks as $chunk){

// look at each chunk and decide how to decode it - by looking at the contents of the filter
		$a_filter = split("/",$chunk["filter"]);

		if ($chunk["data"]!=""){
// look at the filter to find out which encoding has been used	
			if (substr($chunk["filter"],"FlateDecode")!==false){
				$data =@ gzuncompress($chunk["data"]);
				if (trim($data)!=""){
					$result_data .= ps2txt($data);
				} else {

//$result_data .= "x";
				}
			}
		}
	}

	return $result_data;

}


// Function : ps2txt()
// Arguments : $ps_data - postscript data you want to convert to plain text
// Description : Does a very basic parse of postscript data to
// return the plain text
// Author : Jonathan Beckett, 2005-05-02
function ps2txt($ps_data){
	$result = "";
	$a_data = getDataArray($ps_data,"[","]");
	if (is_array($a_data)){
		foreach ($a_data as $ps_text){
			$a_text = getDataArray($ps_text,"(",")");
			if (is_array($a_text)){
				foreach ($a_text as $text){
					$result .= substr($text,1,strlen($text)-2);
				}
			}
		}
	} else {
// the data may just be in raw format (outside of [] tags)
		$a_text = getDataArray($ps_data,"(",")");
		if (is_array($a_text)){
			foreach ($a_text as $text){
				$result .= substr($text,1,strlen($text)-2);
			}
		}
	}
	return $result;
}


// Function : getFileData()
// Arguments : $filename - filename you want to load
// Description : Reads data from a file into a variable
// and passes that data back
// Author : Jonathan Beckett, 2005-05-02
function getFileData($filename){
	$handle = fopen($filename,"rb");
	$data = fread($handle, filesize($filename));
	fclose($handle);
	return $data;
}


// Function : getDataArray()
// Arguments : $data - data you want to chop up
// $start_word - delimiting characters at start of each chunk
// $end_word - delimiting characters at end of each chunk
// Description : Loop through an array of data and put all chunks
// between start_word and end_word in an array
// Author : Jonathan Beckett, 2005-05-02
function getDataArray($data,$start_word,$end_word){

	$start = 0;
	$end = 0;
	unset($a_result);

	while ($start!==false && $end!==false){
		$start = strpos($data,$start_word,$end);
		if ($start!==false){
			$end = strpos($data,$end_word,$start);
			if ($end!==false){
// data is between start and end
				$a_result[] = substr($data,$start,$end-$start+strlen($end_word));
			}
		}
	}
	return $a_result;
}
}
