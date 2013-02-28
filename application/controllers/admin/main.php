<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 视频教案管理
* @see Content
* @version 1.0.0 (Tue Feb 21 08:17:46 GMT 2012)
* @author ZhangHao
*/
class Main extends CI_Controller
{
	private $_data;

    public function __construct()
    {
		parent::__construct();
		$this->_data['thisClass'] = $this->input->get('kind') ? $this->input->get('kind') : 'video';
		$this->_data['kinds'] = array('video'=>'视频', 'stuff'=>'教案');
		$this->load->model('base_mdl', 'base');
		$this->permission->power_check();
    }

    /**
    * @deprecated 默认方法
    */
    public function index () {
        $this->load->view('admin/main', $this->_data);
    }

	public function intro() {
		$this->load->view('admin/intro');
	}
}