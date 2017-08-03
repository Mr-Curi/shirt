<!DOCTYPE HTML>
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
<js href="/Public/lib/html5shiv"/>
<js href="/Public/lib/respond.min"/>
<![endif]-->
<css href="/Public/static/css/H-ui.admin"/>
<css href="/Public/static/css/H-ui.min"/>
<css href="/Public/lib/Hui-iconfont/1.0.8/iconfont"/>
<css href="/Public/static/skin/default/skin"/>
<css href="/Public/static/css/style"/>
<?php if(isset($data['css'])){ ?>
<?php foreach($data['css'] as $css ){ ?>
<link href="<?php echo $css ?>" rel="stylesheet" type="text/css" />
<?php } ?>
<?php } ?>

<js href="/Public/lib/jquery/1.9.1/jquery.min"/>
<!--[if IE 6]>
<js href="/Public/lib/DD_belatedPNG_0.0.8a-min"/>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title><?php echo $data['title']; ?></title>
</head>
<body>