<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @deprecated 用户
 * @version 1.0.0 12-10-22 下午9:31
 * @author 张浩
 */

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
	}

	/**
	 * @deprecated 默认方法
	 */
	public function index() {
		$this->login();
	}

	/**
	 * 登录
	 */
	public function login() {

		$username		= $this->input->post('username');
		$password		= $this->input->post('password');
		$md5password	= md5($password);

		if($username == '' || $password == '') {
			output(1, FALSE);			//用户名或密码为空
		}

		$user = $this->base->get_data('account', array('email'=>$username), 'id,status,email,password')->row_array();

		if($user) {
			if($user['password'] != $md5password) {
				output(2, FALSE);		//密码错误
			} else {
				if($user['status'] == 1) {
					$this->session->set_userdata(array('uid'=>$user['id'], 'email'=>$user['email']));
					output(100, TRUE);
				} else {
					output(3, FALSE);	//账号被锁
				}
			}
		} else {
			output(4, FALSE);			//用户不存在
		}
	}

	/**
	 * 注册
	 */
	public function register() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');
		$timestamp = time();

		if(!is_email($email)) output(1, FALSE);			//邮箱格式错误
		if(strlen($password) < 6) output(2, FALSE);		//密码长度不能少于6位
		if($password != $password2) output(3, FALSE);	//两次密码输入不一致

		$insert_data = array(
			'username'		=> $email,
			'email'			=> $email,
			'password'		=> md5($password),
			'status'		=> 1,
			'date_orig'		=> $timestamp,
			'date_last'		=> $timestamp,
		);

		if($uid = $this->base->insert_data('account', $insert_data)) {
			output(100, TRUE);							//注册成功
		} else {
			output(4, FALSE);							//注册失败
		}
	}

	/**
	 * 获取国家列表
	 */
	public function counterys() {
		$this->base->get_data('country')->result_array();
	}

	public function tt() {
		//$this->session->set_userdata('some_name', 'some_value');
		echo $this->session->userdata('uid');

	}
}