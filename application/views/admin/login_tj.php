<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<form action="<?=site_url('admin/regdata/lists')?>" method="get">
<table cellspacing="0" cellpadding="0" border="0" class="condition">
	<tr>
		<th>渠道：</th>
		<td width="200">
			<select name="channel">
				<option value=''>请选择</option>
			<?php foreach($channel as $k=>$v):?>
				<option value="<?=$k?>" <?php if($this->input->get('channel') && $this->input->get('channel') == $k) { echo 'selected';}?>><?=$v?></option>
			<?php endforeach;?>
			</select>
		</td>
		<th>版本：</th>
		<td width="200">
			<select name="version">
				<option value=''>请选择</option>
			<?php foreach($version as $k=>$v):?>
				<option value="<?=$k?>" <?php if($this->input->get('version') && $this->input->get('version') == $k) { echo 'selected';}?>><?=$v?></option>
			<?php endforeach;?>
			</select>
		</td>
		<th>用户账号：</th>
		<td>
			<input type="text" name="account" class="input5" value="<?=$this->input->get('account')?>"/>
		</td>
	</tr>
	<tr>
		<th>开始时间：</th>
		<td>
			<input type="text" name="time_s" class="Wdate input5" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd 00:00:00'})" value="<?=$this->input->get('time_s')?>"/>
		</td>
		<th>结束时间：</th>
		<td>
			<input type="text" name="time_e" class="Wdate input5" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd 23:59:59'})" value="<?=$this->input->get('time_e')?>"/>
		</td>
		<td colspan="2">
			<input type="submit" value="查 询" class="but1"/>
		</td>
	</tr>
</table>
</form>

<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th>用户ID</th>
		<th width="180">用户账号</th>
		<th width="150">渠道名</th>
		<th width="100">等级</th>
		<th width="150">角色名</th>
		<th width="140">注册时间</th>
		<th width="140">最后登录</th>
		<th width="80">登录次数</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td><?=$v['id']?></td>
		<td><?=$v['account']?></td>
		<td><?=isset($channel[$v['channel']]) ? $channel[$v['channel']] : $v['channel']?></td>
		<td><?=$v['role_level']?></td>
		<td><?=$v['role_name']?></td>
		<td><?=date('Y-m-d H:i',$v['reg_time'])?></td>
		<td><?=date('Y-m-d H:i',$v['last_login_time'])?></td>
		<td><?=(int)$v['login_count']?></td>
	</tr>
<?php endforeach; endif;?>
</table>
<?=$pagination?>
<script language="javascript" type="text/javascript" src="<?=base_url('./common/datepicker/WdatePicker.js')?>"></script>
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