<?php
namespace App\Modules\Robot\Models\WebBot2;

/**
 * Bootstrap file
 *
 * @package WebBot2
 */


use App\Modules\Robot\Models\Request;
use App\Modules\Robot\Models\Response;
use App\Modules\Robot\Models\WebBot2\WebBot2;
use App\Modules\Robot\Models\WebBot2\Document;

// set unlimited execution time
set_time_limit(0);

// set default timeout to 30 seconds
WebBot2::$conf_default_timeout = 30;

// set delay between fetches to 1 seconds
WebBot2::$conf_delay_between_fetches = 1;

// do not use HTTPS protocol (we'll use HTTP protocol)
WebBot2::$conf_force_https = false;

// do not include document field raw values
WebBot2::$conf_include_document_field_raw_values = false;

// storage directory for storing data
WebBot2::$conf_store_dir = './data/';