<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站后台管理界面</title>
<link href="__PUBLIC__/css/page.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    table tr td{
       text-align:center;
       background-color:#0065AF;
       color:#fff;
    }
    table tr.stu_info td{
       text-align:center;
       background-color:#fff;
       color:#0065AF;
    }
    table tr.stu_info a,table tr.stu_info a:visited{
       text-decoration:none;
    }
    table tr.stu_info a:hover{
       text-decoration:underline;
    }
</style>
</head>
<body id="page">
<h2>管理学生信息</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>学号</td><td>姓名</td><td>性别</td><td>专业</td><td>班级</td><td>所在系</td><td>操作</td>
  </tr>
 <?php if(is_array($stu_info)): $i = 0; $__LIST__ = $stu_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stu_info): ++$i;$mod = ($i % 2 )?><tr class="stu_info">
      <td><?php echo ($stu_info["id"]); ?></td><td><?php echo ($stu_info["name"]); ?></td><td><?php echo ($stu_info["sex"]); ?></td>
      <td><?php echo ($stu_info["major"]); ?></td><td><?php echo ($stu_info["class"]); ?></td><td><?php echo ($stu_info["dept"]); ?></td>
      <td><a href="__URL__/editStuInfo/id/<?php echo ($stu_info["id"]); ?>">编辑</a>/<a href="__URL__/deleteStuInfo/id/<?php echo ($stu_info["id"]); ?>">删除</a></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="<?php echo ($pagestyle); ?>"><?php echo ($page); ?></div>
</body>
</html>