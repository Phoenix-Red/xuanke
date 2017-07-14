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
<h2>课程发布信息</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><th>课程编号</th><th>课程名</th><th>教师名</th><th>已选人数</th><th>课容量</th>  
 <th>上课教室</th><th>上课时间</th><th>学分</th><th>操作</th></tr>
  <?php if(is_array($course_info)): $i = 0; $__LIST__ = $course_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course_info): ++$i;$mod = ($i % 2 )?><tr>
    <td class="id"><?php echo ($course_info["no"]); ?></td>
    <td><?php echo ($course_info["name"]); ?></td>
    <td class="total"><?php echo ($course_info["teacher_name"]); ?></td>
     <td><?php echo ($course_info["selectedMan"]); ?></td>
      <td><?php echo ($course_info["capacity"]); ?></td>
    <td><?php echo ($course_info["place"]); ?></td>
    <td><?php echo ($course_info["time"]); ?>节</td>
    <td class="credit"><?php echo ($course_info["credit"]); ?></td>
   <td class="edit"><a href="__URL__/editCourseInfo/id/<?php echo ($course_info["id"]); ?>">编辑</a>/<a href="__URL__/deleteCourseInfo/id/<?php echo ($course_info["id"]); ?>">删除</td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<br>
<?php if(($displaypage)  >  "0"): ?><div class="<?php echo ($pagestyle); ?>"><?php echo ($page); ?></div>
<?php else: ?>
还没有发布课程!<?php endif; ?>
</body>
</html>