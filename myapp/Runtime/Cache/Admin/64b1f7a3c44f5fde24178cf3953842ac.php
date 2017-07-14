<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站后台管理界面</title>
<link href="__PUBLIC__/css/page.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    table tr th{
       text-align:center;
       background-color:#0065AF;
       color:#fff;
    }
    table tr.course_info td{
       text-align:center;
       background-color:#fff;
       color:#0065AF;
    }
    table tr.course_info a,table tr.course_info a:visited{
       text-decoration:none;
    }
    table tr.course_info a:hover{
       text-decoration:underline;
    }
</style>
</head>
<body id="page">
<h2>选课学生信息</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><th>课程名</th><th>学号</th><th>学生姓名</th><th>专业</th><th>班级</th><th>性别</th><th>操作</th></tr>
  <?php if(is_array($student_info)): $i = 0; $__LIST__ = $student_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$student_info): ++$i;$mod = ($i % 2 )?><tr>
    <td><?php echo ($student_info["course_name"]); ?></td>
    <td><?php echo ($student_info["student_id"]); ?>           </td>
    <td><?php echo ($student_info["student_name"]); ?></td> 
    <td><?php echo ($student_info["student_major"]); ?></td>
     <td><?php echo ($student_info["student_class"]); ?></td>
     <td><?php echo ($student_info["student_sex"]); ?></td>
     <td class="edit"><a href="__URL__/editCourseStuInfo/id/<?php echo ($student_info["id"]); ?>">编辑</a>/<a href="__URL__/deleteCourseStuInfo/id/<?php echo ($student_info["id"]); ?>">删除</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<br>
<?php if(($displaypage)  >  "0"): ?><div class="<?php echo ($pagestyle); ?>"><?php echo ($page); ?></div>
<?php else: ?>
还没有选课学生!<?php endif; ?>
</body>
</html>