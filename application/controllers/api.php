<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @deprecated API
 * @version 1.0.0 12-10-22 下午9:39
 * @author 张浩
 */

class Api extends CI_Controller {

	private $_data = array();

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}

	/**
	 * 默认方法
	 */
	public function index() {
		$this->login();
	}

	/**
	 * 登录
	 */
	public function login() {
		if(!defined("SESS_LOGGED")) define ('SESS_LOGGED', $this->session->userdata('logged'));
		if(!defined("SESS_ACCOUNT")) define ('SESS_ACCOUNT', $this->session->userdata('uid'));
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->load->view('api/login', $this->_data);
	}

	/**
	 * 注册
	 */
	public function register() {
		$this->_data['countrys'] = $this->base->get_data('country')->result_array();
		$this->_data['slider'] = $this->load->view('api/slider', array('active'=>__FUNCTION__), TRUE);
		$this->load->view('api/register', $this->_data);
	}
}