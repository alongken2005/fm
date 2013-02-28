<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 8tportal
 *
 *
 * @package
 * @author		Chi JianGang
 * @date		2009-08-11
 * @copyright	Copyright (c) 2009, Hexin Flush.
 * @link
 * @since		Version 1.0
 * @filesource
 */



function logger($message, $file_name='')
{
	if (!$file_name) $file_name = 'log' . date('ymd');
	$fp = fopen(BASEPATH . 'logs/' . $file_name . '.txt', 'a');
	fwrite($fp, date("Y-m-d H:i:s ") . $message . PHP_EOL);
	fclose($fp);
}

?>