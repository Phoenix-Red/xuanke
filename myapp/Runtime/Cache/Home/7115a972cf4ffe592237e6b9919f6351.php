<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站前台管理界面</title>
<link href="__PUBLIC__/css/page.css" rel="stylesheet" type="text/css" />
<link href="__PUBLIC__/css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
     table{
        width:980px;
        margin:0px;
        padding:0px;
     }
     td{
       width:150px;
       padding:0px;
       margin:0px;
       height:20px;
       line-height:20px;
       text-align:center;
     }
     td.credit{
       width:50px;
     }
     td.edit{
       width:102px;
     }
     a,a:visited{
        text-decoration:none;
     }
     a:hover{
        text-decoration:underline;
     }
     .green-black {
	     padding-left:350px;
	     text-align:left;
}
</style>
</head>
<body id="page">
<h2>选课学生信息</h2>
<table>
  <tr><th>课程名</th><th>学号</th><th>学生姓名</th><th>专业</th><th>班级</th><th>性别</th></tr>
  <?php if(is_array($student_info)): $i = 0; $__LIST__ = $student_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$student_info): ++$i;$mod = ($i % 2 )?><tr>
    <td><?php echo ($student_info["course_name"]); ?></td>
    <td><?php echo ($student_info["stu_id"]); ?></td>
    <td><?php echo ($student_info["student_name"]); ?></td>
    <td><?php echo ($student_info["student_major"]); ?></td>
    <td><?php echo ($student_info["student_class"]); ?></td>
    <td><?php echo ($student_info["student_sex"]); ?></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>