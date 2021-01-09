<?php 
	function get_menu_array($menus=array())
	{
		$parent_array = [];
		foreach($menus as $menu):
			$menu_id = $menu->ID; 
			$parent_id = $menu->menu_item_parent;
			if($menu->menu_item_parent == 0):
				$parent_array[$menu_id] = (array)$menu;
			else:
				$parent_array[$parent_id]['sub_menu'][$menu_id] = (array)$menu;
			endif;	
		endforeach;
		foreach($parent_array as $key => $item)
		{
			if(!isset($item['ID']) && isset($item['sub_menu'])):
				foreach($parent_array as $parent_key => $menu_item):
					if(isset($menu_item['sub_menu']) && array_key_exists($key,$menu_item['sub_menu']) ):
					
						$parent_array[$parent_key]['sub_menu'][$key]['sub_menu'] = $item['sub_menu'];
					endif;
				endforeach;
				unset($parent_array[$key]);
			endif;
		}
		
		return $parent_array;
	}
	
 ?>
