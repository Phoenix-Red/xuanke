<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站前台管理界面</title>
<link href="__PUBLIC__/css/index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
     table{
        width:900px;
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
     input{
        width:148px;
        margin:0px;
        padding:0px;
        height:20px;
        line-height:20px;
        text-align:center;
        font-size:14px;
     }
     input.publish{
        width:96px;
     }
     select{
        width:48px;
        margin:0px;
        padding:0px;
        height:20px;
        line-height:20px;
     }
     select.week{
        width:63px;
        float:left;
     }
     select.jie{
        width:87px;
     }
</style>
<script type="text/javascript">
     window.onload=function(){
          document.myform.no.focus();
     }
     function check(){
     if(document.myform.no.value==""){
          alert('课程编号不能为空！！');
          document.myform.no.focus();
          return false;
     }
     if(isNaN(document.myform.no.value)){
          alert('课程编号必须为数字！！');
          document.myform.no.focus();
          return false;
     }
     if(document.myform.name.value==""){
          alert('课程名不能为空！！');
          document.myform.name.focus();
          return false;
     }
     if(document.myform.capacity.value==""){
          alert('总人数不能为空！！');
          document.myform.capacity.focus();
          return false;
     }
     if(isNaN(document.myform.capacity.value)){
          alert('总人数必须为数字！！');
          document.myform.capacity.focus();
          return false;
     }
     if(document.myform.place.value==""){
          alert('上课教室不能为空！！');
          document.myform.place.focus();
          return false;
     }
   }
</script>
</head>
<body id="page">
<h2>修改课程</h2>
<form action="__URL__/updateCourse/id/<?php echo ($course_info["id"]); ?>" method="post" name="myform" onsubmit="return check();">
<table>
  <tr><th>课程编号</th><th>课程名</th>
  <th>总人数</th> 
  <th>上课教室</th><th>上课时间</th><th>学分</th><th>操作</th></tr>
  <tr>
    <td><input type="text" name="no" value="<?php echo ($course_info["no"]); ?>"></td>
    <td><input type="text" name="name" value="<?php echo ($course_info["name"]); ?>"></td>
    <td><input type="text" name="capacity" value="<?php echo ($course_info["capacity"]); ?>"></td>
    <td><input type="text" name="place" value="<?php echo ($course_info["place"]); ?>"></td>
    <td>
        <select class="week" name="week">
           <option value="星期一" <?php echo ($week1); ?>>星期一</option>
           <option value="星期二" <?php echo ($week2); ?>>星期二</option>
           <option value="星期三" <?php echo ($week3); ?>>星期三</option>
           <option value="星期四" <?php echo ($week4); ?>>星期四</option>
           <option value="星期五" <?php echo ($week5); ?>>星期五</option>
           <option value="星期六" <?php echo ($week6); ?>>星期六</option>
           <option value="星期日" <?php echo ($week7); ?>>星期日</option>
        </select>
        <select class="jie" name="jie">
           <option value="1--2" <?php echo ($jie1); ?>>1--2</option>
           <option value="2--3" <?php echo ($jie2); ?>>2--3</option>
           <option value="3--4" <?php echo ($jie3); ?>>3--4</option>
           <option value="5--6" <?php echo ($jie4); ?>>5--6</option>
           <option value="6--7" <?php echo ($jie5); ?>>6--7</option>
           <option value="7--8" <?php echo ($jie6); ?>>7--8</option>
           <option value="9--10" <?php echo ($jie7); ?>>9--10</option>
           <option value="10--11" <?php echo ($jie8); ?>>10--11</option>
           <option value="11--12" <?php echo ($jie9); ?>>11--12</option>
           <option value="1--2--3" <?php echo ($jie10); ?>>1--2--3</option>
           <option value="2--3--4" <?php echo ($jie11); ?>>2--3--4</option>
           <option value="5--6--7" <?php echo ($jie12); ?>>5--6--7</option>
           <option value="6--7--8" <?php echo ($jie13); ?>>6--7--8</option>
           <option value="9--10--11" <?php echo ($jie14); ?>>9--10--11</option>
           <option value="10--11--12" <?php echo ($jie15); ?>>10--11--12</option>
        </select>
    </td>
    <td class="credit">
        <select name="credit">
           <option value="1" <?php echo ($credit1); ?>>1</option>
           <option value="2" <?php echo ($credit2); ?>>2</option>
           <option value="3" <?php echo ($credit3); ?>>3</option>
           <option value="4" <?php echo ($credit4); ?>>4</option>
        </select>
   </td>
   <td><input type="submit" name="submit" value="修改" class="publish"></td>
  </tr>
</table>
</form>
</body>
</html>