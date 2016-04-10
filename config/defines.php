<?php
//定义系统异常
defined('RUNTIME_EXCEPTION_ERROR_CODE') or define('RUNTIME_EXCEPTION_ERROR_CODE', 50001);
//定义文章发布类型
defined('ARTICLE_CREATE_TYPE_SYSTEM') or define('ARTICLE_CREATE_TYPE_SYSTEM', 1);//系统发布文章类型
defined('ARTICLE_CREATE_TYPE_USER') or define('ARTICLE_CREATE_TYPE_USER', 2);//定义用户发布文章类型

//定义错误代码
defined('ERROR_CODE_USER_NOT_LOGIN') or define('ERROR_CODE_USER_NOT_LOGIN', 40040);//用户未登录异常
defined('ERROR_CODE_DB_ERROR') or define('ERROR_CODE_DB_ERROR', 50002);//数据库错误