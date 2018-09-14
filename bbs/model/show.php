<?php

// 1, 加载项目初始化文件
include '../init.php';

// 2, 加载数据库连接文件
include DIR_CORE . 'MySQLDB.php';

// 3, 接收pub_id
$pub_id = $_GET['pub_id']; // 楼主的帖子的id号

// 6, 每点一次,楼主的publish表的pub_hits加1
$sql = "update publish set pub_hits = pub_hits + 1 where pub_id = $pub_id";
my_query($sql);

// 4, 提取楼主的帖子的信息
$sql = "select * from publish where pub_id=$pub_id";
$result = my_query($sql); // 得到了资源结果集
$row = mysql_fetch_assoc($result); // 楼主的帖子的信息

// 5,加载视图文件
include DIR_VIEW . 'show.html';
