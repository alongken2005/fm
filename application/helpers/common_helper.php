<?php
/**
 * 字符截取
 * @param $str 字符串
 * @param $len 截取长度
 * @param $char 截取后缀
 * @return string
 */
function cutstr($str, $len, $char = '...') {
	if(mb_strlen($str, 'utf-8') > $len) {
		return mb_substr($str, 0, $len, 'utf-8').$char;
	} else {
		return $str;
	}
}

/**
 * 邮箱格式验证
 * @param $value 邮箱地址
 * @return boolean
 */
function is_email($value) {
	return preg_match("/^[0-9a-zA-Z]+(?:[\_\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}

/**
 * 写日志
 * @param string $msg
 * @param type $level
 * @param type $filename
 */
function write_log($msg, $level='info', $filename = 'log') {
	$fname = $filename == 'log' ? 'log-'.date('Y-m-d') : $filename;
	$msg = $level.'-'.date('Y-m-d H:i:s'). ' --> '.$msg."\r\n";
	file_put_contents(APPPATH.'logs/'.$fname.'.log', $msg, FILE_APPEND);
}