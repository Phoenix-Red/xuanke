<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导出课程表</title>
</head>
<body>
<table border=1>
 <tr><td></td><td>星期一</td><td>星期二</td><td>星期三</td><td>星期四</td><td>星期五</td><td>星期六</td><td>星期日</td></tr>
 <?php if(is_array($course_names)): $i = 0; $__LIST__ = array_slice($course_names,1,12);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$course_names): ++$i;$mod = ($i % 2 )?><tr><td><?php echo ($course_names["zero"]); ?></td><td><?php echo ($course_names["one"]); ?></td><td><?php echo ($course_names["two"]); ?></td><td><?php echo ($course_names["three"]); ?></td>
      <td><?php echo ($course_names["four"]); ?></td><td><?php echo ($course_names["five"]); ?></td><td><?php echo ($course_names["six"]); ?></td><td><?php echo ($course_names["seven"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>