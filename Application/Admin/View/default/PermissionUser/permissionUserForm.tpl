<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add" action="<?php echo $data['action']; ?>" method='post' name="admin">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php echo $data['username']; ?>" placeholder="" id="adminName" name="username">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="user_group_id" size="1">
				<?php foreach ($data['user_groups'] as $user_group) { ?>
                <?php if ($user_group['user_group_id'] == $data['user_group_id']) { ?>
				 <option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                <?php } ?>
                <?php } ?>
			</select>
			</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓氏：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value="<?php echo $data['firstname']; ?>" placeholder="姓氏" id="firstname" name="firstname">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value="<?php echo $data['lastname']; ?>" placeholder="名称" id="lastname" name="lastname">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" name="email" id="email" value="<?php echo $data['email']; ?>">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="<?php echo $data['password']; ?>" placeholder="密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="confirm" name="confirm" value="<?php echo $data['confirm']; ?>">
		</div>
	</div>
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">状态：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="status" size="1">
				<?php if ($data['status']) { ?>
                <option value="0">禁用</option>
                <option value="1" selected="selected">启用</option>
                <?php } else { ?>
                <option value="0" selected="selected">禁用</option>
                <option value="1">启用</option>
                <?php } ?>
			</select>
			</span> </div>
	</div>
	
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer"></script>

<script>
$(function(){
	$("#form-admin-add").validate({
		rules:{
			username:{
				required:true,
			},
			firstname:{
				required:true,
			},
			lastname:{
				required:true,
			},
			email:{
				required:true,
			},
			password:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type:'post',
				url:$(this).attr('action'),
				dataType : 'json',
				success:function(data){
					if(data.statu){
						parent.location.replace(parent.location.href);
					}else{
						layer.msg(data.msg);
					}
				}
			});
		}
	});
});
</script>