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
    table tr.teac_info td{
       text-align:center;
       background-color:#fff;
       color:#0065AF;
    }
    table tr.teac_info a,table tr.teac_info a:visited{
       text-decoration:none;
    }
    table tr.teac_info a:hover{
       text-decoration:underline;
    }
</style>
</head>
<body id="page">
<h2>管理教师信息</h2>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td>工号</td><td>姓名</td><td>性别</td><td>职称</td><td>所在系</td><td>操作</td>
  </tr>
 <?php if(is_array($teac_info)): $i = 0; $__LIST__ = $teac_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$teac_info): ++$i;$mod = ($i % 2 )?><tr class="teac_info">
      <td><?php echo ($teac_info['id']); ?></td><td><?php echo ($teac_info['name']); ?></td><td><?php echo ($teac_info['sex']); ?></td>
      <td><?php echo ($teac_info['zhicheng']); ?></td><td><?php echo ($teac_info['dept']); ?></td>
      <td><a href="__URL__/editTeacInfo/id/<?php echo ($teac_info["id"]); ?>">编辑</a>/<a href="__URL__/deleteTeacInfo/id/<?php echo ($teac_info["id"]); ?>">删除</a></td>
  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<div class="<?php echo ($pagestyle); ?>"><?php echo ($page); ?></div>
</body>
</html>