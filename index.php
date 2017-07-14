<?php
if(file_exists("install.php")){
	header("Location:install.php");
	exit();
};
define('THINK_PATH','./ThinkPHP/');
define('APP_NAME','myapp');
define('APP_PATH','./myapp/');

require(THINK_PATH.'ThinkPHP.php');

App::run();
?>
