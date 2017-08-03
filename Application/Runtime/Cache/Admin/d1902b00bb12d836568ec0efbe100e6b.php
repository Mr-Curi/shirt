<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />

<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv"></script>
<script type="text/javascript" src="/Public/lib/respond.min"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/static/css/H-ui.admin" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/H-ui.min" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont" />
<link rel="stylesheet" type="text/css" href="/Public/static/skin/default/skin" />
<link rel="stylesheet" type="text/css" href="/Public/static/css/style" />
<?php if(isset($data['css'])){ ?>
<?php foreach($data['css'] as $css ){ ?>
<link href="<?php echo $css ?>" rel="stylesheet" type="text/css" />
<?php } ?>
<?php } ?>

<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min"></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php echo $data['title']; ?></title>
</head>
<body>
 <header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="javascript:void(0);">椰子姑娘管理后台</a> 
			<span class="logo navbar-slogan f-l mr-10 hidden-xs"></span> 
			<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
			<ul class="cl">
				<li>超级管理员</li>
				<li class="dropDown dropDown_hover">
					<a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
					<ul class="dropDown-menu menu radius box-shadow">
						<li><a href="#">切换账户</a></li>
						<li><a href="#">退出</a></li>
				</ul>
			</li>
			</ul>
		</nav>
	</div>
</div>
</header>
<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<?php if(!empty($data['menuname'])){ ?>
		<?php foreach($data['menuname'] as $k=> $name){ ?>
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i><?php echo $name; ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<?php if(!empty($data['menu'][$k])){ ?>
					<?php foreach($data['menu'][$k] as $menu){ ?>
					<li><a data-href="<?php echo $menu['url']; ?>" data-title="<?php echo $menu['name']; ?>" href="javascript:void(0)"><?php echo $menu['name']; ?></a></li>
					<?php } ?>
					<?php } ?>
					
				</ul>
			</dd>
		</dl>
		<?php } ?>
		<?php } ?>
		<!-- <dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 销售管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo U('Saler/lists'); ?>" data-title="人员列表" href="javascript:void(0)">人员列表</a></li>
			</ul>
		</dd>
	</dl>
	<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 店铺管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo U('Store/lists') ?>" data-title="店铺列表" href="javascript:void(0)">店铺列表</a></li>
			</ul>
		</dd>
	</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 权限管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="<?php echo U('PermissionUser/lists') ?>" data-title="销售人员列表" href="javascript:;">销售人员列表</a></li>
					<li><a data-href="<?php echo U('PermisionGroup/lists');?>" data-title="销售人员群组管理" href="javascript:void(0);">销售人员群组管理</a></li>
			</ul>
		</dd>
	</dl> -->
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<!-- <li class="active">
					<span title="我的桌面" data-href="welcome.html">我的桌面</span>
					<em></em>
				</li> -->
			</ul>
		</div>
	</div>
</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="welcome.html"></iframe>
	</div>
</div>
</section>

<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeall">关闭全部 </li>
</ul>
</div>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="/Public/lib/layer/2.4/layer"></script>
<script type="text/javascript" src="/Public/static/js/H-ui.min"></script>
<script type="text/javascript" src="/Public/static/js/H-ui.admin"></script>

 <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/jquery.contextmenu/jquery.contextmenu.r2"></script>
<script type="text/javascript">
$(function(){
	/*$("#min_title_list li").contextMenu('Huiadminmenu', {
		bindings: {
			'closethis': function(t) {
				console.log(t);
				if(t.find("i")){
					t.find("i").trigger("click");
				}		
			},
			'closeall': function(t) {
				alert('Trigger was '+t.id+'\nAction was Email');
			},
		}
	});*/
});
/*个人信息*/
function myselfinfo(){
	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: '查看信息',
		content: '<div>管理员信息</div>'
	});
}

/*资讯-添加*/
function article_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*产品-添加*/
function product_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}



</script> 
<?php if(isset($data['js'])){ ?>
<?php foreach($data['js'] as $js){ ?>
<script type="text/javascript" href="<?php echo $js; ?>"/>
<?php } ?>
<?php } ?>
</body>
</html>