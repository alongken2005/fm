<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function debug($value, $type=1, $rr=0) {
	if(is_array($value) || is_object($value)) {
		if($rr) {
			echo print_r($value, true);
		}
		echo "<pre>";
		print_r($value);
	} else {
		echo $value;
	}

	if($type) {
		exit;
	}
}

function output($value, $result = TRUE) {
	echo json_encode(array('result'=>$result, 'msg'=>$value));
	exit;
}
?>