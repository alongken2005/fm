<!DOCTYPE html>
<html>
<head>
	<title>管理后台</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?=BASE_VIEW?>admin/css/style.css" type="text/css" />
    <link href="<?=base_url('./common/ligerUI/skins/Aqua/css/ligerui-all.css')?>" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?=base_url('./common/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('./common/ligerUI/js/ligerui.min.js')?>" ></script>
	<script type="text/javascript" src="<?=BASE_VIEW?>admin/js/common.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#mainbox").ligerLayout({ leftWidth: 190, height: '100%', heightDiff: -4 });
			$(".slider").ligerAccordion({ speed: 'fast' });

			$("#framecenter").ligerTab({height: '100%'});
			var tab = $("#framecenter").ligerGetTabManager();

			setTimeout(function() {
				$('.add_tab').first().click();
			}, 200);

			$(".add_tab").click(function() {
				var tid = $(this).attr('tabid');
				if(!tid) {
					tid = tab.getNewTabid();
					$(this).attr('tabid', tid);
				}
				if(tid == 'home') {
					tab.addTabItem({tabid: tid, text: $(this).text(), url: $(this).attr('href'), showClose: false});
				} else {
					tab.addTabItem({tabid: tid, text: $(this).text(), url: $(this).attr('href')});
				}
				$(this).parent().attr('class', 'active');
				$(this).parent().siblings().removeClass();
				return false;
			})
		})
	</script>
</head>
<body>
	<div id="topmenu" class="header">
		<?='欢迎你，'.get_cookie('username').'&nbsp;<a href="'.site_url('admin/login/login_out').'">退出</a>'?>
	</div>
	<div id="mainbox" style="width:99.3%; margin:0 auto; margin-top:4px; ">
		<div position="left"  title="主要菜单" class="slider">
			<div title="数据统计">
				<ul>
					<li>
						<a href="<?=site_url('admin/dataview/reg_list')?>" class="add_tab" tabid="home">注册清单</a>
					</li>
					<li>
						<a href="<?=site_url('admin/dataview/reg_tj')?>" class="add_tab">注册统计</a>
					</li>
					<li>
						<a href="<?=site_url('admin/dataview/sell_list')?>" class="add_tab">销售清单</a>
					</li>
					<li>
						<a href="<?=site_url('admin/dataview/sell_tj')?>" class="add_tab">销售统计</a>
					</li>
				</ul>
			</div>
		</div>
		<div position="center" id="framecenter"></div>
	</div>
</body>
</html>

