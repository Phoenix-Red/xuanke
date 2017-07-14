<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站后台管理界面</title>
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript">
    $(function(){
        $("li:has(ul)").find("ul").prev().click(function(){
             $(this).next().toggle();
        });
        $("li:has(ul)").find("ul").hide();
    });
</script>
</head>
<body id="index">
<h1>专业选修课网站后台管理界面</h1>
<div id="userInfo">你好，管理员<?php echo ($username); ?>，今天是<?php echo ($date); ?></div>
<ul id="globalNav">
	<h2>管理菜单</h2>
	<li><a href="#">学生管理</a>
	    <ul>
	         <li><a href="__URL__/manageStuInfo" target="frameBord">管理学生信息</a></li>
	         <li><a href="__URL__/importStuInfo" target="frameBord">添加学生信息</a></li>
	    </ul>
	</li>
	<li><a href="#">教师管理</a>
	    <ul>
	         <li><a href="__URL__/manageTeacInfo" target="frameBord">管理教师信息</a></li>
	         <li><a href="__URL__/importTeacInfo" target="frameBord">添加教师信息</a></li>
	    </ul>
	</li><li><a href="#">课程管理</a>
	    <ul>
	         <li><a href="__URL__/manageCourseInfo" target="frameBord">课程发布信息</a></li>
	    </ul>
	</li>
	<li><a href="__URL__/editPassword" target="frameBord">修改密码</a></li>
	<li><a href="javascript:ms=confirm('确定退出');ms?location.href='__URL__/admin_exit':history.go(0)" target="_self">安全退出</a></li>
</ul>
<iframe id="frameBord" name="frameBord" frameborder="0" width="100%" height="100%" src="__URL__/siteinfo"></iframe>
</body>
</html>