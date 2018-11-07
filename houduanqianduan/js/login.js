$(function(){
	var $form = $("#form");
	var $btnlg = $(".btn-lg");
	
init();
function init(){
	$btnlg.click(function(){
		var username = $form.children("input").eq(0).val();
		var password = $form.children("input").eq(1).val();
		
		var data={
			'username':username,
			'password':password
		};
		initajax('post','examination/backgroundAPI/login',data,function(data){
			console.log(data);
			alert("登陆成功");
			window.location.href="index.html";
		},function(err){
			console.log(err);
			alert("登陆失败，请检查密码是否正确");
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