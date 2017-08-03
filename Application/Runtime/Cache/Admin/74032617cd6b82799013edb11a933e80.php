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
 <input type="hidden" id="TenantId" name="TenantId" value="" />
<!-- <div class="header"></div> -->
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo $data['action']; ?>" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
    <!--   <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <img src=""> <a id="kanbuq" href="javascript:;">看不清，换一张</a> </div>
      </div> -->
      <?php if ($redirect) { ?>
      <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
      <?php } ?>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="ok" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
        </div>
      </div>
    </form>
  </div>
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