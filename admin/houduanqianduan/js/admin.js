// JavaScript Document
$(function(){
	
init();
function init(){
	jiaoshiguanli();
}
function jiaoshiguanli(){
	leave();
	xiugai();
	remove();
}
function leave(){
	var $leave = $(".leave");
	$leave.click(function(){
		$(".erji_user").animate({'opacity':0,'z-index':-1},300);
	})
}
function xiugai(){
	$(".xiugai").each(function(){
		$(this).click(function(){
			$(".erji_user").animate({'opacity':1},300).css({'z-index':1});
		})
	})
}
function remove(){
	$(".remove").each(function(){
		$(this).click(function(){
			if(window.confirm("是否删除")){
			    $(this).parent().parent().remove();	
			}
		})
	})
}
function initajax(methods,url,data,fun,Err){
	$.ajax({
		type:methods,
		url:url,
		data:data,
		success:function(data){
			fun(data);
		},
		error:function(err){
			Err(err);
		}
	})
}	
})