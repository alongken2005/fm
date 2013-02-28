<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2><?=intval($this->input->get('id')) ? '修改' : '添加'?><div class="operate"><a href="<?=site_url('admin/way/lists')?>">管理</a></div></h2>
<div class="slider3">
	<form action="<?=site_url('admin/way/op'.(intval($this->input->get('id')) ? '?id='.intval($this->input->get('id')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th><b>*</b> 标题：</th>
			<td>
				<input type="text" name="title" value="<?=set_value('title', isset($content['title']) ? $content['title'] : '')?>" class="input2"/>
				<?php if(form_error('title')) { echo form_error('title'); } ?>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 分类：</th>
			<td>
				<select name="type">
				<?php foreach($wayType as $k=>$v):?>
					<option value="<?=$k?>" <?=(isset($content['type']) && $content['type'] == $k) ? 'selected' : ''?>><?=$v?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<th> 相关产品：</th>
			<td>
				<div class="nearprod">
					<ul>
					<?php
					$pids = isset($content['pids']) && $content['pids'] ? explode(',', $content['pids']) : array();
					foreach($productes as $v):?>
						<li><input type="checkbox" name="pids[]" value="<?=$v['id']?>" <?=in_array($v['id'], $pids) ? 'checked' : ''?>/>&nbsp;<?=$v['title']?></li>
					<?php endforeach;?>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 发布时间：</th>
			<td>
				<input type="text" name="ctime" value="<?=set_value('ctime', isset($content['ctime']) ? date('Y-m-d H:i:s', $content['ctime']) : date('Y-m-d H:i:s', time()))?>" class="input1"/>
				<?php if(form_error('ctime')) { echo form_error('ctime'); } ?>
			</td>
		</tr>
		<tr>
			<th> 排序：</th>
			<td>
				<input type="text" name="sort" value="<?=set_value('sort', isset($content['sort']) ? $content['sort'] : 0)?>" class="input1"/>
			</td>
		</tr>
		<tr>
			<th>摘要：</th>
			<td>
				<textarea name="remark" style="width: 670px; height: 80px; margin-bottom: 5px;"><?=set_value('remark', isset($content['remark']) ? $content['remark'] : '')?></textarea>
			</td>
		</tr>
		<tr>
			<th><b>*</b> 内容：</th>
			<td>
				<textarea name="content" id="content"><?=set_value('content', isset($content['content']) ? $content['content'] : '')?></textarea>
				<?php if(form_error('content')) { echo form_error('content'); } ?>
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type="submit" name="submit" value="提 交" class="but2"/>
			</td>
		</tr>
	</table>
	</form>
</div>


<script type="text/javascript" src="<?=base_url('./common/kindeditor/kindeditor.js')?>"></script>
<script type="text/javascript">
$(function() {
	KindEditor.ready(function(K) {
		K.create('#content', {width : '670', height: '500', newlineTag:'br', filterMode : true});
	});

	$('.del').click(function() {
		if(confirm('确定删除？')) {
			$.get($('.del').attr('href'), '', function(data) {
				if(data == 'ok') {
					$('.tr_icon').hide();
				} else {
					alert('删除失败');
				}
			})
		}
		return false;
	})
})
</script>

<?php $this->load->view('admin/footer');?>