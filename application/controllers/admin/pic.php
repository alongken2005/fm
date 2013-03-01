<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @deprecated 图片管理
* @see Pic
* @version 12-3-28 下午8:48
* @author ZhangHao
*/
class Pic extends CI_Controller
{
	private $_data;

    public function __construct()
    {
		parent::__construct();

		$this->_data['thisClass'] = __CLASS__;
		$this->load->model('base_mdl', 'base');
		$this->permission->power_check();
		$this->_data['typelist'] = array(1=>'首页焦点图');
    }

    /**
    * @deprecated 默认方法
    */
    public function index ()
    {
        self::pic();
    }

    /**
    * @deprecated 图片管理
    */
    public function lists ()
    {
		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->base->get_data('pics')->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/pic/lists'));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->base->get_data('pics', array(), '*', $limit, $offset, 'sort DESC,pid DESC')->result_array();
        $this->load->view('admin/pic_list', $this->_data);
    }

    /**
    * @deprecated 图片处理
    */
    public function op ()
    {
		if (!$_POST) {
			if ($id = $this->input->get('pid')) {
				$this->_data['pic'] = $this->base->get_data('pics', array('pid' => $id))->row_array();
			}
			$this->load->view('admin/pic_op', $this->_data);
		} else {
			$ac = $this->input->get_post('ac');

			$deal_data['title']		= $this->input->post('title');
			$deal_data['place']		= $this->input->post('place');
			$deal_data['sort']		= $this->input->post('sort');
			$deal_data['url']		= $this->input->post('url');

			if($_FILES['userfile']['size'] > 0) {
				$config['upload_path']		= './data/uploads/pics';
				$config['allowed_types']	= 'gif|jpg|png';
				$config['max_size']			= '5000';
				$config['max_width']		= '3000';
				$config['max_height']		= '3000';
				$config['encrypt_name']		= TRUE;
				$config['overwrite']		= FALSE;

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('pic')) {
					$this->_data['upload_err'] = $this->upload->display_errors();
					$this->load->view('admin/pic_op', $this->_data);
				}
				$upload_data = $this->upload->data();

				$config2['create_thumb']	= true;
				$config2['source_image']	= $upload_data['full_path'];
				$config2['maintain_ratio']	= FALSE;
				$config2['width']			= 140;
				$config2['height']			= 100;

				$this->load->library('image_lib', $config2);
				$this->image_lib->resize();

				$deal_data['filename'] = $upload_data['raw_name'];
				$deal_data['filetype'] = $upload_data['file_ext'];
			}

			if ($id = $this->input->get('pid')) {
				if ($this->base->update_data('pics', array('pid' => $id), $deal_data)) {
					$this->msg->showmessage('更新成功', site_url('admin/pic/lists?ac='.$ac));
				} else {
					$this->msg->showmessage('更新失败', site_url('admin/pic/pic_op?pid='.$id));
				}
			} else {
				if ($this->base->insert_data('pics', $deal_data)) {
					$this->msg->showmessage('添加成功', site_url('admin/pic/lists?ac='.$ac));
				} else {
					$this->msg->showmessage('添加失败', site_url('admin/pic/pic_op'));
				}
			}
		}
    }

    /**
    * @deprecated 文章删除
    */
    public function del () {
        $id = intval($this->input->get('pid'));
        if($id && $this->base->del_data('pics', array('pid' => $id))) {
        	exit('ok');
        } else {
        	exit('no');
        }
    }
}