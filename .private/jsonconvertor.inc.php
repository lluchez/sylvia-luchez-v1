<?php

function my_array_map($callback, $array) {
	$res_array = Array();
	foreach($array as $key => $value) {
		$res_array[] = call_user_func_array($callback, Array($value, $key));
	}
	return $res_array;
}

function pair_to_json($value, $key) {
	$key2 = "\"$key\": ";
	if( is_string($value) ) return $key2.'"'.str_replace('"', '\"', $value).'"';
	if( is_bool($value) )   return $key2.($value ? 'true' : 'false');
	return $key2.$value;
}

function array_to_json($props) {
	return '{'.implode(", ", my_array_map('pair_to_json', $props)).'}';
}

function render_json($json) {
	header("Content-type: application/json");
	die(array_to_json($json));
}

function render_json_error($msg) {
	render_json(Array('error' => true, 'message' => $msg));
}

?>