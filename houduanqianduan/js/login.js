$(function(){
	var $form_input = $(".form_input");
	var $btnlg = $(".btn-lg");
	
init();
function init(){
	$btnlg.click(function(){
		var username = $form.eq(0).children("input").val();
		var password = $form.eq(1).children("input").val();
		
		var data={
			'username':username,
			'password':password
		};
		initajax('post','http://localhost:8888/www.yeva.com/examination/background/login.php',data,function(data){
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