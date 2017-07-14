<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站--教师管理中心</title>
<link href="__PUBLIC__/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/js/js2.js"></script>
<base target="frameBord" />
</head>

<body id="index">
<h1>专业选修课网站--教师管理中心</h1>
<div id="userInfo">你好，教师<?php echo ($username); ?>，今天是<?php echo ($date); ?></div>
<ul id="globalNav">
	<li><a href="javascript:ms=confirm('确定退出');ms?location.href='__URL__/admin_exit':history.go(0)" target="_self">退出</a></li>
	<li><a href="__URL__/editTeacPassword" target="frameBord">修改密码</a></li>
    <li><a href="__URL__/manageCourseStu" target="frameBord">选课学生</a></li>
	<li><a href="__URL__/manageCourse" target="frameBord">管理课程</a></li>
	<li><a href="__URL__/publishCourse" target="frameBord">发布课程</a></li>
	<li class="select"><a href="__URL__/teacher_page" target="frameBord">首页</a></li>
</ul>
<iframe id="frameBord" name="frameBord" frameborder="0" width="100%" height="100%" src="__URL__/teacher_page"></iframe>
</body>
</html>