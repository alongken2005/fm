$(function(){
	//导航菜单
	$(".topnav li .father").click(function() {
		$(this).parent().find(".subnav a").width($(this).width()+46);
		$(this).parent().find(".subnav").slideDown('fast').show();
		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().find(".subnav").slideUp('slow');
		});
	}).hover(function() {
		$(this).addClass("subhover");
	}, function(){
		$(this).removeClass("subhover");
	});

	//第二菜单
	$(".tabsnav li span").click(function() {
		$(this).parent().find(".secnav").slideDown('fast').show();
		$(this).parent().hover(function() {
		}, function(){
			$(this).parent().find(".secnav").slideUp('fast');
		});
	}).hover(function() {
		$(this).addClass("sechover");
	}, function(){
		$(this).removeClass("sechover");
	});
});