<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站后台登录界面</title>
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    window.onload=function(){
          document.myForm.username.focus();
    }
    function checkForm(){
          if(document.myForm.username.value==""){
               alert('用户名不能为空！！');
               document.myForm.username.focus();
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
	<h3>专业选修课网站后台管理界面</h3>
	<label for="username"><span>用户名：</span><input id="username" name="username" type="text" /></label>
	<label for="password"><span>密&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input id="password" type="password" name="password"/></label>
	<div id="submit">
    <input name="submit" type="submit" class="bt" value="登录" />
    <input type="reset"name="reset" value="重置" class="bt" />
	</div>
</form>
</body>
</html>