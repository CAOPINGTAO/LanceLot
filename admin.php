<?php
/**
 * Created by PhpStorm.
 * User: Lancelot
 * Date: 2016/4/11
 * Time: 13:39
 */
if(version_compare(PHP_VERSION, '5.3.0', '<') && die('require PHP > 5.3'));

define('APP_DEBUG', True);

define('BIND_MODULE', 'Admin');

define('APP_PATH', './Application/');

require './ThinkPHP/ThinkPHP.php';