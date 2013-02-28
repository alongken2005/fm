<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2>业主资料订阅管理</h2>
<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th width="90">姓名</th>
		<th width="90">移动电话</th>
		<th width="200">通讯地址</th>
		<th width="180">电子邮箱</th>
		<th width="110">发布日期</th>
		<th>备注</th>
		<th>操作</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td><?=$v['name']?></td>
		<td><?=$v['mobile']?></td>
		<td><?=$v['address']?></td>
		<td><?=$v['email']?></td>
		<td><?=date('Y-m-d H:i', $v['ctime'])?></td>
		<td><?=$v['remark']?></td>
		<td><a href="<?=site_url('admin/content/ding_del?did='.$v['did'])?>" class="del">删除</a></td>
	</tr>
<?php endforeach; endif;?>
</table>
<?=$pagination?>
<script type="text/javascript">
$(function() {
	$('.del').click(function() {
		if(confirm('确认删除？')){
			var po = $(this).parent().parent();
			$.get($(this).attr('href'), '', function(data) {
				if(data == 'ok'){
					po.hide();
				} else {
					alert('删除失败！');
				}
			})
		}
		return false;
	})
})
</script>
<?php $this->load->view('admin/footer');?>