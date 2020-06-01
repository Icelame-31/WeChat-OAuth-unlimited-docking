<?php
return array(
    //数据库配置
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => '数据库名', // 数据库名
	'DB_USER'   => '用户名', // 用户名
	'DB_PWD'    => '密码', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PARAMS' =>  array(), // 数据库连接参数
	'DB_PREFIX' => 'wxlg_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
	
	//异常页面
	'SHOW_PAGE_TRACE'=>0,//页面调试
	'TMPL_EXCEPTION_FILE'   =>  './404.html',// 异常页面的模板文件

    //路由配置
    'URL_ROUTER_ON' => TRUE,
    //路由规则
    'URL_ROUTE_RULES' => array(
        'wxlogin'                       => 'Home/Api/wxlogin'
    ),

    //微信公众号配置
    'APP_ID' => '你的微信公众号APP_ID',
    'APP_SECRET' => '你的微信公众号APP_SECRET'
);