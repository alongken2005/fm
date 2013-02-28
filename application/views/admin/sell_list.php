<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<form action="<?=site_url('admin/dataview/sell_list')?>" method="get">
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
		<th>游戏区：</th>
		<td width="100">
			<select name="zone">
				<option value=''>请选择</option>
			<?php foreach($zone as $k=>$v):?>
				<option value="<?=$k?>" <?php if($this->input->get('zone') && $this->input->get('zone') == $k) { echo 'selected';}?>><?=$v?></option>
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
		<th>状态：</th>
		<td>
			<select name="paystatus">
				<option value=''>请选择</option>
			<?php foreach($paystatus as $k=>$v):?>
				<option value="<?=$k?>" <?php if($this->input->get('paystatus') != '' && $this->input->get('paystatus') == $k) { echo 'selected';}?>><?=$v?></option>
			<?php endforeach;?>
			</select>
		</td>
		<td colspan="2">
			<input type="submit" value="查 询" class="but1"/>
		</td>
	</tr>
</table>
</form>

<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th>订单号</th>
		<th width="100">用户ID</th>
		<th width="180">用户账号</th>
		<th width="150">渠道名</th>
		<th width="100">游戏区</th>
		<th width="90">付费金额</th>
		<th width="80">支付状态</th>
		<th width="140">订单时间</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td><?=$v['out_trade_no']?></td>
		<td><?=$v['uid']?></td>
		<td><?=$v['account']?></td>
		<td><?=isset($channel[$v['channel']]) ? $channel[$v['channel']] : $v['channel']?></td>
		<td><?=isset($zone[$v['server_id']]) ? $zone[$v['server_id']] : $v['server_id']?></td>
		<td><?=$v['total_fee']?></td>
		<td><?=isset($paystatus[$v['status']]) ? $paystatus[$v['status']] : $v['status']?></td>
		<td><?=date('Y-m-d H:i',$v['order_time'])?></td>
	</tr>
<?php endforeach; endif;?>
</table>
<?=$pagination?>
<script language="javascript" type="text/javascript" src="<?=base_url('./common/datepicker/WdatePicker.js')?>"></script>
<?php $this->load->view('admin/footer');?>