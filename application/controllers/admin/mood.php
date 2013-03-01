<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @deprecated 心情电台
* @see Content
* @version 1.0.0 (Tue Feb 21 08:17:46 GMT 2012)
* @author ZhangHao
*/
class Mood extends CI_Controller
{
	private $_data;

    public function __construct()
    {
		parent::__construct();
		$this->load->model('base_mdl', 'base');
		$this->permission->power_check();
    }

    /**
    * @deprecated 默认方法
    */
    public function index () {
        self::lists();
    }

    /**
    * @deprecated 文章管理
    */
    public function lists () {

		//分页配置
        $this->load->library('gpagination');
		$total_num = $this->base->get_data('mood')->num_rows();
		$page = $this->input->get('page') > 1 ? $this->input->get('page') : '1';
		$limit = 25;
		$offset = ($page - 1) * $limit;

		$this->gpagination->currentPage($page);
		$this->gpagination->items($total_num);
		$this->gpagination->limit($limit);
		$this->gpagination->target(site_url('admin/mood/lists'));

		$this->_data['pagination'] = $this->gpagination->getOutput();
		$this->_data['lists'] = $this->base->get_data('mood', array(), '*', $limit, $offset, 'sort DESC, ctime DESC')->result_array();
        $this->load->view('admin/mood_list', $this->_data);
    }

    /**
    * @deprecated 文章处理
    */
    public function op () {
    	//验证表单规则
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', '标题', 'required|trim');
		$this->form_validation->set_error_delimiters('<span class="err">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			if ($id = $this->input->get_post('id')) {
				$this->_data['row'] = $this->base->get_data('mood', array('id' => $id))->row_array();
			}
			$this->load->view('admin/mood_op', $this->_data);
		} else {
			$deal_data = array(
				'content'		=> $this->input->post('content'),
				'title'			=> $this->input->post('title'),
				'ctime'			=> strtotime($this->input->post('ctime')),
				'sort'			=> $this->input->post('sort')
			);

				$this->load->library('upload');

			if($_FILES['mp3']['size'] > 0) {

				//$this->load->library('upload', $config);
				$config['upload_path']		= './data/uploads/mood/';
				$config['allowed_types']	= 'mp3|gif|jpg|png';
				$config['max_size']			= '200000';
				$config['encrypt_name']		= TRUE;
				$config['overwrite']		= FALSE;
				$this->upload->initialize($config);

				if(!$this->upload->do_upload('mp3')) {
					$this->_data['mp3_err'] = $this->upload->display_errors();
					$this->load->view('admin/mood_op', $this->_data);
				}
				$upload_data = array();
				$upload_data = $this->upload->data();
				$deal_data['mp3'] = $upload_data['file_name'];
			}

			if($_FILES['pic']['size'] > 0) {
				$config['upload_path']		= './data/uploads/mood/';
				$config['allowed_types']	= 'mp3|gif|jpg|png';
				$config['max_size']			= '20000';
				$config['max_width']		= '3000';
				$config['max_height']		= '3000';
				$config['encrypt_name']		= TRUE;
				$config['overwrite']		= FALSE;
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('pic')) {
					$this->_data['pic_err'] = $this->upload->display_errors();
					$this->load->view('admin/mood_op', $this->_data);
				}
				$upload_data = $this->upload->data();

				$config2['create_thumb']	= true;
				$config2['source_image']	= $upload_data['full_path'];
				$config2['maintain_ratio']	= FALSE;
				$config2['width']			= 140;
				$config2['height']			= 100;

				$this->load->library('image_lib', $config2);
				$this->image_lib->resize();
				$deal_data['pic'] = $upload_data['file_name'];
			}



			if ($id = $this->input->get('id')) {
				$this->base->update_data('mood', array('id' => $id), $deal_data);
				$this->msg->showmessage('操作成功', site_url('admin/mood/lists'));
			} else {
				$this->base->insert_data('mood', $deal_data);
				$this->msg->showmessage('操作成功', site_url('admin/mood/lists'));
			}
		}
    }

    /**
    * @deprecated 文章删除
    */
    public function del () {
        $id = intval($this->input->get('cid'));
        if($id && $this->base->del_data('content', array('cid' => $id))) {
        	exit('ok');
        } else {
        	exit('no');
        }
    }
}