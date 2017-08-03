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