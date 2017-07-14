<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专业选修课网站后台管理界面</title>
<link href="__PUBLIC__/css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    table{
         width:600px;
         margin:0px;
         padding:0px;
    }
    table tr td{
       text-align:center;
       background-color:#0065AF;
       color:#fff;
       height:30px;
       line-height:30px;
       padding:0px;
       margin:0px;
       wdith:100px;
    }
    table tr.teac_info td{
       text-align:center;
       background-color:#fff;
       color:#0065AF;
       height:30px;
       line-height:30px;
       padding:0px;
       margin:0px;
       width:100px;

    }
    table tr.teac_info a,table tr.teac_info a:visited{
       text-decoration:none;
    }
    table tr.teac_info a:hover{
       text-decoration:underline;
    }
    table tr.teac_info input{
        width:100px;
        font-size:14px;
        height:30px;
        line-height:30px;
        text-align:center;

    }
    table tr.teac_info input.sex{
        width:18px;
        font-size:14px;
        height:30px;
        line-height:30px;
        border:0px;
        text-align:center;

    }
    #teacSqlForm input{
       height:20px;
       line-height:20px;
       font-size:14px;
       text-align:left;
    }
</style>
<script type="text/javascript">
     window.onload=function(){
         document.myform.id.focus();
     }
     function checkteacInfo(){
         if(document.myform.id.value==""){
             alert('工号不能为空');
             document.myform.id.focus();
             return false;
         }
         if(isNaN(document.myform.id.value)){
             alert('工号必须为数字');
             document.myform.id.focus();
             return false;
         }
         if(document.myform.name.value==""){
             alert('姓名不能为空');
             document.myform.name.focus();
             return false;
         }
         if(document.myform.zhicheng.value==""){
             alert('职称不能为空');
             document.myform.zhicheng.focus();
             return false;
         }
         if(document.myform.dept.value==""){
             alert('系名不能为空');
             document.myform.dept.focus();
             return false;
         }
     };
</script>
</head>
<body id="page">

<h2>添加教师信息</h2>
<form action="__URL__/addTeacInfo" method="post" name="myform" onsubmit="return checkteacInfo();">
<table>
  <tr>
      <td>工号</td><td>姓名</td><td>性别</td><td>职称</td><td>所在系</td><td>操作</td>
  </tr>
  <tr class="teac_info">
      <td><input type="text" name="id"></td><td><input type="text" name="name"></td>
      <td><input type="radio" name="sex" value='男' class="sex" checked>男<input type="radio" name="sex" value='女' class="sex">女</td>
      <td><input type="text" name="zhicheng"></td><td><input type="text" name="dept"></td>
      <td><input type="submit" name="submit" value="添加"></td>
  </tr>
</table>
</form>
<br>
<h2>批量导入教师信息</h2>
<form id="teacSqlForm" method="post" action="__URL__/importTeacSql" enctype="multipart/form-data">
选择sql文件：<input type="file" name="sqlTeacFile">
<input type="submit" value="导入"> （支持.sql .txt文件）
</form>
<br>
<font color="red"><b>注意导入教师信息时，sql语句不需包含创建表的语句了，只需包含插入语句，插入语句的结构要跟下面这条语句类似：insert into `info_teacher` (`id`, `name`, `dept`, `sex`, `zhicheng`) VALUES
('001', '赵景秀', '信息科学与工程学院', '男', '教授');
多条语句请用分号隔开。</b></font>
</html>