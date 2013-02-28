<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<form action="<?=site_url('admin/dataview/sell_tj')?>" method="get">
<table cellspacing="0" cellpadding="0" border="0" class="condition">
	<tr>
		<th>渠道：</th>
		<td width="160">
			<select name="channel">
				<option value=''>请选择</option>
			<?php foreach($channel as $k=>$v):?>
				<option value="<?=$k?>" <?php if($this->input->get('channel') && $this->input->get('channel') == $k) { echo 'selected';}?>><?=$v?></option>
			<?php endforeach;?>
			</select>
		</td>
		<th>统计类型：</th>
		<td width="55">
			<select name="type">
				<option value='1' <?php if($this->input->get('type') && $this->input->get('type') == 1) { echo 'selected';}?>>按日</option>
				<option value="2" <?php if($this->input->get('type') && $this->input->get('type') == 2) { echo 'selected';}?>>按月</option>
			</select>
		</td>
		<th>开始时间：</th>
		<td width="190">
			<input type="text" name="time_s" class="Wdate input5" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd 00:00:00'})" value="<?=$this->input->get('time_s')?>"/>
		</td>
		<th>结束时间：</th>
		<td width="190">
			<input type="text" name="time_e" class="Wdate input5" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd 23:59:59'})" value="<?=$this->input->get('time_e')?>"/>
		</td>
		<td>
			<input type="submit" value="查 询" class="but1"/>
		</td>
	</tr>
</table>
</form>

<table cellpadding="0" cellspacing="0" border="0" class="table2">
	<tr>
		<th>时间段</th>
		<th width="300">支付总额</th>
		<th width="300">订单数</th>
		<th width="300">人数</th>
	</tr>
<?php if($lists): foreach($lists as $v):?>
	<tr>
		<td><?=$v['dateout']?></td>
		<td><?=$v['total_f']?></td>
		<td><?=$v['num']?></td>
		<td><?=$v['pep']?></td>
	</tr>
<?php endforeach; endif;?>
</table>
<?=$pagination?>
<script language="javascript" type="text/javascript" src="<?=base_url('./common/datepicker/WdatePicker.js')?>"></script>
<?php $this->load->view('admin/footer');?>