<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @13-2-17 下午9:57
 * @author ZhangHao
 */

class Mood extends CI_Controller {
	private $_data;

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}

	/**
	 * 默认方法
	 */
	public function index() {
		$this->_data['mood'] = $this->base->get_data('mood', '')->row_array();
		$this->load->view(THEME.'/mood', $this->_data);
	}
}