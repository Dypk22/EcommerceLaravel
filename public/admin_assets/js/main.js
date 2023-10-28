function updateCatStats(slug, status, id) {
	jQuery.ajax({
		url:'/admin/updateCategoryStatus',
		data:'slug='+slug+'&status='+status,
		type:'post',
		success:function(result){
			if (result=='done') {
				jQuery('.'+slug).remove();
				if(status==0){
					var div='<span class="badge-item badge-status curHov '+slug+'" onclick="updateCatStats(\''+slug+'\', 1, '+id+')">Dective</span>';
				}else{
					var div='<span class="badge-item badge-status curHov '+slug+'" onclick="updateCatStats(\''+slug+'\', 0, '+id+')">Active</span>';
				}
				jQuery('.customStatus'+id).append(div);
			}
		}
	});	
}

function updateCatShowHomeStats(slug, status, id) {
	jQuery.ajax({
		url:'/admin/updateCatShowHomeStats',
		data:'slug='+slug+'&status='+status,
		type:'post',
		success:function(result){
			if (result=='done') {
				jQuery('#'+slug).remove();
				if(status==0){
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateCatShowHomeStats(\''+slug+'\', 0,'+id+')">Deactive</span>';
				}else{
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateCatShowHomeStats(\''+slug+'\', 1,'+id+')">Active</span>';
				}
				jQuery('.customStatusHome'+id).append(div);
			}
		}
	});	
}

function updateSubCatStats(slug, status, id) {
	// alert(slug+', '+status+', '+id);
	jQuery.ajax({
		url:'/admin/updateSubCatStats',
		data:'slug='+slug+'&status='+status,
		type:'post',
		success:function(result){
			if (result=='done') {
				jQuery('#'+slug).remove();
				if(status==0){
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateSubCatStats(\''+slug+'\', 1,'+id+')">Deactive</span>';
				}else{
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateSubCatStats(\''+slug+'\', 0,'+id+')">Active</span>';
				}
				jQuery('.customStatus'+id).append(div);
			}
		}
	});	
}

function updateProductStats(slug, status, id) {
	// alert(slug+', '+status+', '+id);
	jQuery.ajax({
		url:'/admin/updateProductStats',
		data:'slug='+slug+'&status='+status,
		type:'post',
		success:function(result){
			if (result=='done') {
				jQuery('#'+slug).remove();
				if(status==0){
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateProductStats(\''+slug+'\', 1,'+id+')">Deactive</span>';
				}else{
					var div='<span class="badge-item badge-status curHov" id="'+slug+'" onclick="updateProductStats(\''+slug+'\', 0,'+id+')">Active</span>';
				}
				jQuery('.customStatus'+id).append(div);
			}
		}
	});	
}