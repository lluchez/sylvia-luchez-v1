<?php

	// Include the necessary files
	include_once '../.private/works.data.php';
	include_once '../.private/jsonconvertor.inc.php';
	

	function get_image_from_id($id) {
		global $_work_pics;
		return $_work_pics[$id];
	}

	function tabs_array_to_json($pic_names, $key) {
		$images = my_array_map('get_image_from_id', $pic_names);
		return "\"{$key}\": [".implode(", ", my_array_map('array_to_json', $images))."]";
	}

	function images_array_to_json() {
		global $_work_tabs;
		return '{'.implode(", ", my_array_map('tabs_array_to_json', $_work_tabs)).'}';
	}

	Header("content-type: application/x-javascript");
?>
// Data init
document.pictures = <?php echo images_array_to_json(); ?>;
