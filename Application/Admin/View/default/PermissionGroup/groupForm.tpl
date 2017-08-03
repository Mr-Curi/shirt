		    	
		    	
<article class="page-container">
	<form action="<?php echo $data['action'];?>" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $data['name']; ?>" placeholder="" id="roleName" name="name">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="" name="user-Character-0" id="user-Character-0">
							查看权限</label>
					</dt>
				<dd>
						<?php foreach ($data['permissions'] as $permission) { ?>
						<label class="">
							<?php if (in_array($permission, $data['access'])) { ?>
							<input type="checkbox" value="<?php echo $permission; ?>" name="permission[access][]" checked="checked"/ >
							
							<?php }else{ ?>
							<input type="checkbox" value="<?php echo $permission; ?>" name="permission[access][]" / >
							<?php } ?>

							<?php echo $data['menu'][$permission]; ?>
						</label>
						<?php } ?>
					</dd>
			
					
				</dl>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="" name="user-Character-0" id="user-Character-1">
							修改权限</label>
					</dt>
					<dd>
						<?php foreach ($data['permissions'] as $permission) { ?>
						<label class="">
							<?php if (in_array($permission, $data['modify'])) { ?>
							<input type="checkbox" value="<?php echo $permission; ?>" name="permission[modify][]" checked="checked"/ >
							
							<?php }else{ ?>
							<input type="checkbox" value="<?php echo $permission; ?>" name="permission[modify][]" / >
							<?php } ?>
							<?php echo $data['menu'][$permission] ?>
						</label>
						<?php } ?>
					</dd>
				</dl>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
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
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
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