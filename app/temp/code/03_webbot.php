<?php
/**
 * WebBot example
 */

// load WebBot library with bootstrap
require_once './lib/WebBot/bootstrap.php';

// URLs to fetch data from
$urls = [
	'search' => 'www.google.com',
	'chrome' => 'www.google.com/intl/en/chrome/browser/',
	'products' => 'www.google.com/intl/en/about/products/'
];

// document fields [document field ID => document field regex pattern, [...]]
$document_fields = [
	'title' => '<title.*>(.*)<\/title>',
	'h2' => '<h2[^>]*?>(.*)<\/h2>',
];

// set WebBot object
$webbot = new \WebBot\WebBot($urls, $document_fields);

// execute fetch data from URLs
$webbot->execute();

// display documents summary
echo $webbot->total_documents . ' total documents <br />';
echo $webbot->total_documents_success . ' total documents fetched successfully <br />';
echo $webbot->total_documents_failed . ' total documents failed to fetch <br /><br />';


// check if fetch(es) successful
if($webbot->success)
{
	// display each document
	foreach($webbot->getDocuments() as /* \WebBot\Document */ $document)
	{
		if($document->success) // was document data fetched successfully?
		{
			// display document meta data
			echo 'Document: ' . $document->id . '<br />';
			echo 'URL: ' . $document->url . '<br />';

			// display/print document fields and values
			$fields = $document->getFields();
			echo '<pre>' . print_r($fields, true) . '</pre>';
		}
		else // failed to fetch document data, display error
		{
			echo 'Document error: ' . $document->error . '<br />';
		}
	}
}
else // not successful, display error
{
	echo 'Failed, error: ' . $webbot->error;
}
