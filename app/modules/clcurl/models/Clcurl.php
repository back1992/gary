<?php
namespace App\Modules\Clcurl\Models;
class Clcurl
{
	public static function filterUrl($origin, $regular) { 
		# code...
		// $regular 

	}
	public static function getDiv( $url, $element, $findAtt = null ) {
        // code...
		\phpQuery::newDocumentFile( $url );  
		$results = ( is_null($findAtt)) ? pq($element)->text() : pq($element)->find($findAtt)->text();
		return $results;
	}
	public static function useSnoopy( $div ) {
        // code...
		\phpQuery::newDocumentFile( $url );  
		$results = pq($element)->find($findAtt);  
		return $results;
	}
}