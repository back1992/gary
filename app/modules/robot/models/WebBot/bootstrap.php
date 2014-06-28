<?php
namespace App\Modules\Robot\Models\WebBot;
use App\Modules\Robot\Models\Request;
use App\Modules\Robot\Models\Response;
use App\Modules\Robot\Models\WebBot\WebBot;
use App\Modules\Robot\Models\WebBot\Document;


// set unlimited execution time
set_time_limit(0);

// set default timeout to 30 seconds
WebBot::$conf_default_timeout = 30;

// set delay between fetches to 1 seconds
WebBot::$conf_delay_between_fetches = 1;

// do not use HTTPS protocol (we'll use HTTP protocol)
WebBot::$conf_force_https = false;

// do not include document field raw values
WebBot::$conf_include_document_field_raw_values = false;