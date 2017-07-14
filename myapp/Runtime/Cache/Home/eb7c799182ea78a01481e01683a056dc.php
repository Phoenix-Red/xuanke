<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理界面</title>
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
<h2>已选课题</h2>
<table>
  <tr><th>课题编号</th><th>课题名</th><th>指导教师</th><th>上课教室</th><th>上课时间</th><th>学分</th><th>操作</th></tr>
  <?php if(is_array($course_info)): $i = 0; $__LIST__ = $course_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course_info): ++$i;$mod = ($i % 2 )?><tr>
    <td><?php echo ($course_info["no"]); ?></td>
    <td><?php echo ($course_info["name"]); ?></td>
    <td><?php echo ($course_info["teacher_name"]); ?></td>
    <td><?php echo ($course_info["place"]); ?></td>
    <td><?php echo ($course_info["time"]); ?>节</td>
    <td class="credit"><?php echo ($course_info["credit"]); ?></td>
   <td class="edit"><a href="__URL__/quitCourse/id/<?php echo ($course_info["id"]); ?>">退课</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<br>
<?php if(($export)  >  "0"): ?><a href="__URL__/exportCourse"><font color="blue">导出课程表</font></a>
<?php else: ?>还没有已选的课程<?php endif; ?>
</body>
</html>