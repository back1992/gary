<?php
namespace App\Modules\Navmenu\Models;
use Illuminate\Database\Eloquent\Model;
class Navmenu extends Model
{

	// Recursive function that builds the menu from an array or object of items
	// In a perfect world some parts of this function would be in a custom Macro or a View
	public function buildMenu($menu, $parentid = 0) 
	{ 
		$result = null;
		foreach ($menu as $item) 
			if ($item->parent_id == $parentid) { 
				$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
				<div class='dd-handle nested-list-handle'>
					<span class='glyphicon glyphicon-move'></span>
				</div>
				<div class='nested-list-content'>{$item->label}
					<div class='pull-right'>
						<a href='".url("admin/menu/edit/{$item->id}")."'>Edit</a> |
						<a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
					</div>
				</div>".$this->buildMenu($menu, $item->id) . "</li>"; 
			} 
			return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
		} 

	// Getter for the HTML menu builder
		public function getHTML($items)
		{
			return $this->buildMenu($items);
		}

		// In a perfect world some parts of this function would be in a custom Macro or a View
		public function buildNav3($menu, $parentid = 0) 
		{ 
			$result = null;
			foreach ($menu as $item) 
				if ($item->parent_id == $parentid ) { 
					if($parentid == 0) {

						$result .= "
						<li><label class=\"tree-toggler nav-header\">{$item->label}</label>

							".$this->buildNav($menu, $item->id) . "</li>"; 
						} else{

							$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
							<a href={$item->url}><div class='nested-list-content'>{$item->label}
							</div></a>".$this->buildNav($menu, $item->id) . "</li>"; 
						}
					} 
					return $result ?  "\n<ul id=\"menu-bar\" class=\"nav nav-list\">\n$result</ul>\n" : null; 
				} 
	// Getter for the HTML menu builder
				public function getNavHTML($items)
				{
					return $this->buildNav($items);
				}
		// In a perfect world some parts of this function would be in a custom Macro or a View
				public function buildNav4($menu, $parentid = 0) 
				{ 
					$result = null;
				// dd($menu->toArray());
					foreach ($menu as $item) 
						if ($item->parent_id == $parentid) { 
							$result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
							<a href={$item->url}><div class='nested-list-content'>{$item->label}
							</div></a>".$this->buildNav($menu, $item->id) . "</li>"; 
						} 
						return $result ?  "\n<ul id=\"menu-bar\" class=\"nav nav-stacked\">\n$result</ul>\n" : null; 
					} 

		// In a perfect world some parts of this function would be in a custom Macro or a View
				public function buildNav($menu, $parentid = 0) 
				{ 
					$result = null;
					foreach ($menu as $item) {
						$parentidArr[] = $item->parent_id;
					}

				// dd($parentidArr);
					foreach ($menu as $item) 
						if ($item->parent_id == $parentid) { 
							switch ($parentid) {
								case '0':
									# code...
								in_array($item->id, $parentidArr) ?
								$result .= "<li  data-order='{$item->order}' data-id='{$item->id}'>
							<label class=\"tree-toggler nav-header\">{$item->label}
							</label>".$this->buildNav($menu, $item->id) . "</li>" : $result .= "<li  data-order='{$item->order}' data-id='{$item->id}'>
							<a href={$item->url}><label class=\"tree-toggler nav-header\">{$item->label}
							</label></a>".$this->buildNav($menu, $item->id) . "</li>"; 
									break;
								
								default:
									# code...
								$result .="<li  data-order='{$item->order}' data-id='{$item->id}'>
							<a href={$item->url}>{$item->label}
							</a>".$this->buildNav($menu, $item->id) . "</li>"; 
									break;
							}

	/*						$result .=($parentid !== 0)? "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
							<a href={$item->url}><div class='nested-list-content'>{$item->label}
							</div></a>".$this->buildNav($menu, $item->id) . "</li>" : "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
							<div class='nested-list-content'><label class=\"tree-toggler nav-header\">{$item->label}
							</label></div>".$this->buildNav($menu, $item->id) . "</li>"; */
						} 
						return $result ?  "\n<ul id=\"menu-bar\" class=\"nav  nav-list tree\">\n$result</ul>\n" : null; 
					} 



				}


/*<ul class="nav nav-list">
			<li><label class="tree-toggler nav-header">Header 1</label>
				<ul class="nav nav-list tree">
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><label class="tree-toggler nav-header">Header 1.1</label>
						<ul class="nav nav-list tree">
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><label class="tree-toggler nav-header">Header 1.1.1</label>
								<ul class="nav nav-list tree">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="divider"></li>
			<li><label class="tree-toggler nav-header">Header 2</label>
				<ul class="nav nav-list tree">
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><label class="tree-toggler nav-header">Header 2.1</label>
						<ul class="nav nav-list tree">
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><label class="tree-toggler nav-header">Header 2.1.1</label>
								<ul class="nav nav-list tree">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><label class="tree-toggler nav-header">Header 2.2</label>
						<ul class="nav nav-list tree">
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
							<li><label class="tree-toggler nav-header">Header 2.2.1</label>
								<ul class="nav nav-list tree">
									<li><a href="#">Link</a></li>
									<li><a href="#">Link</a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>*/