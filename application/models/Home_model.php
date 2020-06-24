<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{

	function get_categories_by_parent_id($parent_id)
	{
		$this->db->where('parent_id', $parent_id);
		return $this->db->get('category')->result_array();
	}
	
	function get_or_create_categories_by_parent_id($parent_id)
	{
		$categories = $this->get_categories_by_parent_id($parent_id);
		if(count($categories)==0){
			$category = $this->get_category_by_id($parent_id);
			for($i=1; $i<3; $i++){
				//If the length of the category name = 1 (eg. B) then append $i only, otherwise append dash with $i
				$category_name = strlen($category[0]['category_name'])!=1?$category[0]['category_name'].'-'.$i:$category[0]['category_name'].$i;
				$data = array(
					'category_name'=>$category_name,
					'parent_id' =>$category[0]['category_id'] //OR $parent_id
				);
				
				$this->db->insert('category', $data);
			}
			
			return $this->get_categories_by_parent_id($parent_id);
		}else{
			return $this->get_categories_by_parent_id($parent_id);
		}
	}
	
	function get_category_by_id($category_id)
	{
		$this->db->where('category_id', $category_id);
		return $this->db->get('category')->result_array();
	}
}

?>