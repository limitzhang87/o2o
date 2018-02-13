/*页面 全屏-添加*/
function o2o_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*添加或者编辑缩小的屏幕*/
function o2o_s_edit(title,url,w,h){
	layer_show(title,url,w,h);
}
/*-删除*/
function o2o_del(url){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href=url;
	});
}

/*-提示跳转-*/
function o2o_confirm(url,content){
	layer.confirm(content,function(index){
		window.location.href=url;
	});
}

/* 排序*/
$('.listorder input').blur(function(){
	var postData = {
		'id':$(this).data('id'),
		'listorder':$(this).val()
	}
	var url = SCOPE.listorder_url;
	$.post(url, postData, function(res){
		if(res.code == 1){
			history.go(0);
		}else{
			alert(res.msg);
		}
	})
});

/**获取城市*/
$('.cityId').change(function(){
	var cityid = $(this).val();
	var url = SCOPE.city_url;
	var data = {
		'id' : cityid
	}
	$.post(url,data,function(res){
		if(res.code == 1){
			var html = '<option value="0">--请选择--</option>';
			$.each(res.data,function(i,item){
				html += '<option value="'+item.id+'">'+item.name+'</option>';
			})
			$('.se_city_id').html(html);
		}else{
			$('.se_city_id').html('<option value="0">--请选择--</option>');
		}
	},'json');
})

/**获取分类*/
$('.categoryId').change(function(){
	var categoryId = $(this).val();
	var url = SCOPE.category_url;
	var data = {
		'id' : categoryId
	}
	$.post(url,data,function(res){
		if(res.code == 1){
			var html = '';
			$.each(res.data,function(i,item){
				html += '<input type="checkbox" name="se_category_id[]" value="'+item.id+'">';
				html += '<label>'+item.name+'</label>';
			})
			$('.se_category_id').html(html);
		}else{
			$('.se_category_id').html('');
		}
	},'json');
})


/**
 * 时间选择器
 * @param  {[type]} flag [description]
 * @return {[type]}      [description]
 */
function selecttime(flag){
    if(flag==1){
        var endTime = $("#countTimeend").val();
        if(endTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',maxDate:endTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }else{
        var startTime = $("#countTimestart").val();
        if(startTime != ""){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm',minDate:startTime})}else{
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})}
    }
 }