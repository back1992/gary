<?php namespace Daniel\Phptidy\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Phptidy extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'phptidy'; }
 
}