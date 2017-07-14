<?php 
$install_config=include("install_config.php");  //安装的配置信息
$config2=array(

     'APP_DEBUG'=>false,
     'DB_TYPE'=>'mysql',
     'DB_PORT'=>3306,
     'DB_PREFIX'=>'info_',
    'APP_GROUP_LIST'=>'Admin,Home',
	'DEFAULT_GROUP'=>'Home',
	'URL_MODEL'=>1,
	'TMPL_L_DELIM'=>'{<',
	'TMPL_R_DELIM'=>'>}',
	'TOKEN_ON'=>false,
);
$config=array_merge($config2,$install_config);
return $config;
?>