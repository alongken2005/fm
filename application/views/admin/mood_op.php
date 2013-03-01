<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<h2><?=intval($this->input->get('id')) ? '修改' : '添加'?></h2>
<div class="slider3">
	<form action="<?=site_url('admin/mood/op'.(intval($this->input->get('cid')) ? '?cid='.intval($this->input->get('cid')) : ''))?>" method="POST" enctype="multipart/form-data">
	<table cellspacing="0" cellpadding="0" border="0" class="table1">
		<tr>
			<th><b>*</b> 标题：</th>
			<td>
				<input type="text" name="title" value="<?=set_value('title', isset($content['title']) ? $content['title'] : '')?>" class="input2"/>
				<?php if(form_error('title')) { echo form_error('title'); } ?>
			</td>
		</tr>
		<tr>
			<th>图片：</th>
			<td>
				<input type="file" name="pic"/>
				<?php if(isset($pic_err)):?><span class="err"><?=$pic_err?></span><?php endif;?>
			</td>
		</tr>
	<?php if(isset($row['pic'])):?>
		<tr>
			<th></th>
			<td>
				<img src="<?=get_thumb($row['pic'])?>"/>
			</td>
		</tr>
	<?php endif;?>
		<tr>
			<th>MP3：</th>
			<td>
				<input type="file" name="mp3"/>
				<?php if(isset($mp3_err)):?><span class="err"><?=$mp3_err?></span><?php endif;?>
			</td>
		</tr>

		<tr>
			<th>发布时间：</th>
			<td>
				<input type="text" name="ctime" value="<?=set_value('ctime', isset($content['ctime']) ? date('Y-m-d H:i:s', $content['ctime']) : date('Y-m-d H:i:s', time()))?>" class="input1"/>
				<?php if(form_error('ctime')) { echo form_error('ctime'); } ?>
			</td>
		</tr>
		<tr>
			<th>排序：</th>
			<td>
				<input type="text" name="sort" value="<?=set_value('sort', isset($content['sort']) ? $content['sort'] : 0)?>" class="input1"/>
			</td>
		</tr>
		<tr>
			<th>内容：</th>
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