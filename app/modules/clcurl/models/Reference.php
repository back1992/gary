<?php
namespace App\Modules\Clcurl\Models;
class Reference extends pdf_object
{
	function resolve() {
		return $this->parent->resolve($this);
	}
}
