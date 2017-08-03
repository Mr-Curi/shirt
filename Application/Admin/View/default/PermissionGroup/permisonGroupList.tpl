<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="admin_role_del()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo U('PermisionGroup/add'); ?>','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6">角色管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th width="200">角色名</th>
				<!-- <th>用户列表</th>
				<th width="300">描述</th> -->
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data['user_groups'] as $group) {?>
			<tr class="text-c">
				<td><input type="checkbox" value="<?php echo $group['user_group_id']; ?>" name="selected[]"></td>
				<td><?php echo $group['user_group_id']; ?></td>
				<td><?php echo $group['name']; ?></td>
				<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','<?php echo $group['edit']; ?>','1')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
				</td>
			</tr>
			<?php } ?>
			
		</tbody>
	</table>
</div>

<script>
	function admin_role_add(title,url,w,h){
		layer_show(title,url,w,h);
	}
/*管理员-角色-编辑*/
	function admin_role_edit(title,url,id,w,h){
		layer_show(title,url,w,h);
	}
/*管理员-角色-删除*/
	function admin_role_del(){
		if(!$('input[type=checkbox]:checked').length>0) return;
		layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
			$.ajax({
				type: 'POST',
				url: "<?php echo $data['action']['del']; ?>",
				data:$('input[type=checkbox]:checked'),			
				dataType: 'json',
				success: function(data){
					location.replace(location.href);
				},
				error:function(data) {
					console.log(data.msg);
				},
			});		
		});
	}
</script>