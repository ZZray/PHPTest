<?php

// 1, 加载项目初始化文件
include '../init.php';

// 2, 加载数据库连接文件
include DIR_CORE . 'MySQLDB.php';

// 3, 提取publish表的数据
$sql = "select * from publish order by pub_time desc";
$result = my_query($sql); // 得到资源结果集

// 4,加载视图文件
include DIR_VIEW . 'list_father.html';