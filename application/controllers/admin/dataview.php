<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 视频教案管理
* @see Content
* @version 1.0.0 (Tue Feb 21 08:17:46 GMT 2012)
* @author ZhangHao
*/
class Dataview extends CI_Controller
{
	private $_data;

    public function __construct()
    {
		parent::__construct();
		$this->_data['thisClass'] = $this->input->get('kind') ? $this->input->get('kind') : 'video';
		$this->_data['kinds'] = array('video'=>'视频', 'stuff'=>'教案');
		$this->load->model('base_mdl', 'base');
		$this->permission->power_check();
		//$this->output->enable_profiler(TRUE);
    }

    /**
    * @deprecated 默认方法
    */
    public function index() {
        self::reg_list();
    }

    /**
    * @deprecated 文章管理
    */
    public function reg_list() {
		$this->config->load('common');
		$this->_data['channel'] = $this->config->item('channel');
		$this->_data['version'] = $this->config->item('version');

		$channel = $this->input->get('channel');
		$version = $this->input->get('version');
		$account = $this->input->get('account');
		$time_s = $this->input->get('time_s');
		$time_e = $this->input->get('time_e');

		$where = 'WHERE 1';
		$url = '?';
		if($channel) {
			$where .= ' AND channel='.$channel;
			$url .= '&channel='.$channel;
		}
		if($version) {
			$where .= ' AND version="'.$version.'"';
			$url .= '&version='.$version;
		}
		if($account) {
			$where .= ' AND account LIKE "%'.$account.'%"';
			$url .= '&account='.$account;
		}
		if($time_s) {
			$where .= ' AND reg_time >= '.strtotime($time_s);
			$url .= '&time_s='.$time_s;
		}
		if($time_e) {
			$where .= ' AND reg_time <= '.strtotime($time_e);
			$url .= '&time_e='.$time_e;
		}

		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->db->query('SELECT id FROM u_info '.$where)->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/dataview/reg_list'.$url));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->db->query('SELECT u.id,u.account,u.channel,u.version,u.reg_time,u.last_login_time,u.login_count,r.role_level,r.role_name FROM (SELECT id,account,channel,version,reg_time,last_login_time,login_count FROM u_info '.$where.' ORDER BY id DESC LIMIT '.$offset.', '.$limit.') u LEFT JOIN g_role r ON u.account=r.account')->result_array();
        $this->load->view('admin/reg_list', $this->_data);
    }

	/**
	 * 注册统计
	 */
	public function reg_tj() {
		$this->config->load('common');
		$this->_data['channel'] = $this->config->item('channel');
		$this->_data['version'] = $this->config->item('version');

		$channel	= $this->input->get('channel');
		$type		= $this->input->get('type');
		$time_s		= $this->input->get('time_s');
		$time_e		= $this->input->get('time_e');

		$where = 'WHERE 1';
		$url = '?type='.$type;
		if($channel) {
			$where .= ' AND channel='.$channel;
			$url .= '&channel='.$channel;
		}
		if($type == 2) {
			$dateformat = '%Y-%m';
		} else {
			$dateformat = '%Y-%m-%d';
		}

		if($time_s) {
			$where .= ' AND reg_time >= '.strtotime($time_s);
			$url .= '&time_s='.$time_s;
		}
		if($time_e) {
			$where .= ' AND reg_time <= '.strtotime($time_e);
			$url .= '&time_e='.$time_e;
		}

		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->db->query('SELECT COUNT(*) num, FROM_UNIXTIME(reg_time, "'.$dateformat.'") dateout FROM u_info '.$where.' GROUP BY FROM_UNIXTIME(reg_time, "'.$dateformat.'")')->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/dataview/reg_tj'));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->db->query('SELECT COUNT(*) num, FROM_UNIXTIME(reg_time, "'.$dateformat.'") dateout FROM u_info '.$where.' GROUP BY FROM_UNIXTIME(reg_time, "'.$dateformat.'") ORDER BY id DESC LIMIT '.$offset.', '.$limit)->result_array();
		$this->load->view('admin/reg_tj', $this->_data);
	}

	/**
	 * 登录统计
	 */
	public function login_tj() {
		$this->load->view('admin/login_tj', $this->_data);
	}

	/**
	 * 销售清单
	 */
	public function sell_list() {
		$this->config->load('common');
		$this->_data['channel'] = $this->config->item('channel');
		$this->_data['version'] = $this->config->item('version');
		$this->_data['zone']	= $this->config->item('zone');
		$this->_data['paystatus']	= $this->config->item('paystatus');
		$channel = $this->input->get('channel');
		$version = $this->input->get('version');
		$zone = $this->input->get('zone');
		$account = $this->input->get('account');
		$paystatus = $this->input->get('paystatus');
		$time_s = $this->input->get('time_s');
		$time_e = $this->input->get('time_e');

		$where = 'WHERE 1';
		$url = '?';
		if($channel) {
			$where .= ' AND u.channel='.$channel;
			$url .= 'channel='.$channel.'&';
		}
		if($version) {
			$where .= ' AND u.version="'.$version.'"';
			$url .= 'version='.$version.'&';
		}
		if($zone) {
			$where .= ' AND od.server_id="'.$zone.'"';
			$url .= 'zone='.$zone.'&';
		}
		if($account) {
			$where .= ' AND od.account LIKE "%'.$account.'%"';
			$url .= 'account='.$account.'&';
		}
		if($paystatus != '') {
			$where .= ' AND od.status='.$paystatus;
			$url .= 'paystatus='.$paystatus.'&';
		}
		if($time_s) {
			$where .= ' AND od.order_time >= '.strtotime($time_s);
			$url .= 'time_s='.$time_s.'&';
		}
		if($time_e) {
			$where .= ' AND od.order_time <= '.strtotime($time_e);
			$url .= 'time_e='.$time_e.'&';
		}

		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->db->query('SELECT od.out_trade_no,od.total_fee,od.account,od.server_id,od.order_time,od.status,u.channel,u.id uid FROM pay_order od, u_info u '.$where.' AND od.account=u.account')->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/dataview/sell_list'.$url));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->db->query('SELECT od.out_trade_no,od.total_fee,od.account,od.server_id,od.order_time,od.status,u.channel,u.id uid FROM pay_order od, u_info u '.$where.' AND od.account=u.account ORDER BY od.order_time DESC LIMIT '.$offset.', '.$limit)->result_array();
        $this->load->view('admin/sell_list', $this->_data);
	}

	/**
	 * 销售统计
	 */
	public function sell_tj() {
		$this->config->load('common');
		$this->_data['channel'] = $this->config->item('channel');

		$channel	= $this->input->get('channel');
		$type		= $this->input->get('type');
		$time_s		= $this->input->get('time_s');
		$time_e		= $this->input->get('time_e');

		$where = 'WHERE u.account=od.account AND od.status=2';
		$url = '?type='.$type;
		if($channel) {
			$where .= ' AND u.channel='.$channel;
			$url .= '&channel='.$channel.'&';
		}
		if($type == 2) {
			$dateformat = '%Y-%m';
		} else {
			$dateformat = '%Y-%m-%d';
		}

		if($time_s) {
			$where .= ' AND od.order_time >= '.strtotime($time_s);
			$url .= '&time_s='.$time_s;
		}
		if($time_e) {
			$where .= ' AND od.order_time <= '.strtotime($time_e);
			$url .= '&time_e='.$time_e;
		}

		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->db->query('SELECT od.id FROM pay_order od, u_info u '.$where.' GROUP BY FROM_UNIXTIME(od.order_time, "'.$dateformat.'")')->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/dataview/sell_tj'.$url));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->db->query('SELECT COUNT(*) num, sum(total_fee) total_f, COUNT(DISTINCT(od.account)) pep, FROM_UNIXTIME(od.order_time, "'.$dateformat.'") dateout FROM pay_order od, u_info u '.$where.' GROUP BY FROM_UNIXTIME(od.order_time, "'.$dateformat.'") ORDER BY FROM_UNIXTIME(od.order_time, "'.$dateformat.'") DESC LIMIT '.$offset.', '.$limit)->result_array();
		$this->load->view('admin/sell_tj', $this->_data);
	}

}