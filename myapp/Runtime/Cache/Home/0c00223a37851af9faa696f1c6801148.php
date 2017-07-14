<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站前台登录界面</title>
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    input.type{
    height:20px;
    line-height:20px;
	width:20px;
	margin:0px;
	border:0px;
    text-align:center;
}
</style>
<script type="text/javascript">
    window.onload=function(){
          document.myForm.userid.focus();
    }
    function checkForm(){
          if(document.myForm.userid.value==""){
               alert('ID不能为空！！');
               document.myForm.userid.focus();
               return false;
          }
          if(document.myForm.password.value==""){
               alert('密码不能为空！！');
               document.myForm.password.focus();
               return false;
          }
    }
</script>
</head>
<body id="login">
<form action="__URL__/check_login" target='_self'id="loginForm" method="post" name="myForm" onSubmit="return checkForm();">
	<h3>专业选修课网站前台界面</h3>
	<label for="userid"><span>&nbsp;&nbsp;I  D：</span>
	<input id="userid" name="userid" type="text" /></label>
	<label for="password"><span>&nbsp;&nbsp;密码：</span>
	<input id="password" type="password" name="password"/></label>
	<center>
	   <input type="radio" name="type" class="type" value="stu" checked/>学生
	   <input type="radio" name="type" class="type" value="teac"/>教师</center>

	<div id="submit">
	   <input name="submit" type="submit" class="bt" value="登录" />
      <input type="reset" class="bt" value="重置"/>
	</div>
    
</form>
</body>
</html>