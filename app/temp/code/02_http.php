<?php
/**
 * Example HTTP GET request
 */

// load HTTP package with bootstrap file
require_once './lib/HTTP/bootstrap.php';

// execute example HTTP GET request
$response = \HTTP\Request::get('http://www.google.com');

// display response status
if($response->success)
{
	echo 'Successful request <br />';
}
else
{
	echo 'Error: request failed, status code: ' 
	. $response->getStatusCode() . '<br />'; // prints status code
}

// print out HTTP response (\HTTP\Response object)
echo '<pre>' . print_r($response, true) . '</pre>';