<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','<?php echo $data['add_url']; ?>','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">登录名</th>
				<th width="40">加入时间</th>
				<th width="90">是否已启用</th>
				<th width="150">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data['users'] as $user){ ?>
			<tr class="text-c">
				<!-- <td><input type="checkbox" value="<?php echo $user['user_id']; ?>" name="selected[]"></td>
				<td><?php echo $user['user_id']; ?></td>
				<td><?php echo $user['username']; ?></td>
				<td><?php echo $user['date_added']; ?></td>
				<td><span class="label label-success radius"><?php echo $user['status']; ?></span></td>
				<td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','admin-add.html','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a></td> -->
			</tr>
			<?php } ?>
		</tbody>
	</table>
	</div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/Public/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$(function(){
	$('.table-sort').dataTable({
		"columns": [
			{ "data": "check"},
			{ "data": "user_id" },
			{ "data": "username" },
			{ "data": "date_added" },
			{ "data": "status" },
			{ "data": "edit"},
		],
		"oLanguage": {  
            "sLengthMenu": "每页 _MENU_ 条数据",  
            "sZeroRecords": "没有数据",  
            "sInfo": "_START_ - _END_ 总(_TOTAL_)",  
            "sInfoEmpty": "0 - 0 总数： 0"  
        },  
        'sClass': "text-center",
        "sPaginationType": "full_numbers",
		// "aaSorting": [[ 2, "desc" ]],//默认第几个排序
		"bStateSave": false,//状态保存
		"bSort" : true,	
		// "bProcessing":true,
		// 'bPaginate':true,
		"bServerSide" : true,
		"iDisplayLength" : 10,// 每页显示行数
		"sAjaxSource": "<?php echo $data['url']; ?>",
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,2,4,5]}// 制定列不参与排序
		],
		"fnServerData": retrieveData
	});
	
});

function retrieveData( sSource,aoData, fnCallback) {
            //    alert(JSON.stringify(aoData));
    $.ajax({
        url : sSource,//这个就是请求地址对应sAjaxSource
        data : {"aoData":JSON.stringify(aoData)},//这个是把datatable的一些基本数据传给后台,比如起始位置,每页显示的行数
        type : 'post',
        dataType : 'json',
        async : false,
        success : function(result) {
            fnCallback(result,false);//把返回的数据传给这个方法就可以了,datatable会自动绑定数据的
        },
        error : function(msg) {
            //alert(JSON.stringify(msg));
        }
    });
}



/*用户-添加*/
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function datadel(){
	if(!$('input[type=checkbox]:checked').length>0) return;
		layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
			$.ajax({
				type: 'POST',
				url: "<?php echo $data['del_url']; ?>",
				data:$('input[type=checkbox]:checked'),			
				dataType: 'json',
				success: function(data){
					if(data.statu){
						layer.msg('删除成功');
						location.replace(location.href);
					}else{
						layer.msg(data.msg);
					}
				}
			});		
		});
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){

		$.ajax({
			type: 'POST',
			url: "<?php echo $data['statu_url'];?>",
			data:"status=0&id="+id,			
			dataType: 'json',
			success: function(data){
				if(data.statu){
					$(obj).parents("td").prepend('<a onClick="admin_start(this,'+id+')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
					$(obj).parents("td").prev().html('<span class="label label-default radius">已禁用</span>');
					$(obj).remove();
					layer.msg('已停用!',{icon: 5,time:1000});
				}
			}
		});		
	
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: "<?php echo $data['statu_url'];?>",
			data:"status=1&id="+id,			
			dataType: 'json',
			success: function(data){
				if(data.statu){
					$(obj).parents("td").prepend('<a onClick="admin_stop(this,'+id+')" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
					$(obj).parents("td").prev().html('<span class="label label-success radius">已启用</span>');
					$(obj).remove();
					layer.msg('已启用!', {icon: 6,time:1000});
				}
			}
		});		
		
	});
}
</script>