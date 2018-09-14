<?php
include '../init.php';
/**
 * 数据库连接文件
 */

/**
 * 数据库连接函数
 */
// function my_connect($arr) {
//  	$host = isset($arr['host']) ? $arr['host'] : 'localhost';
//  	$port = isset($arr['port']) ? $arr['port'] : '3306';
//  	$user = isset($arr['user']) ? $arr['user'] : 'bbs';
//  	$pass = isset($arr['pass']) ? $arr['pass'] : 'bbs';
// 	$link = @ mysql_connect("$host:$port", $user, $pass);
// 	if(!$link) {
// 		echo "数据库连接失败！<br />";
// 		echo "错误编号：", mysql_errno(), "<br />";
// 		echo "错误信息：", mysql_error(), '<br />';
// 		die;
// 	}
// }
//1 连接到 MySQL
function my_connect($arr) {
     	$host = isset($arr['host']) ? $arr['host'] : 'localhost';
 	    $port = isset($arr['port']) ? $arr['port'] : '3306';
 	    $user = isset($arr['user']) ? $arr['user'] : 'bbs';
    	$pass = isset($arr['pass']) ? $arr['pass'] : 'bbs';
    	$dbname = isset($arr['dbname']) ? $arr['dbname'] : 'bbs';
       try {
        $user = 'bbs';
        $name = 'bbs';
        $link = new PDO("mysql:host=$host;dbname=$dbname", $user, $name);
        // echo 'connect success';
        return $link;
        //关闭连接
        // $db = null;
    }
    catch (PDOException $e) {
        print 'Error'.$e->getMessage()."<br/>";
    } 
}

/**
 * 封装错误调试函数
 * @param string $sql 一条sql语句
 * @return mixed(true|resource) sql语句的执行结果
 */ 
function my_query($sql, $link) {
// 	// 先执行sql语句
// 	$result = mysql_query($sql);
// 	// 再判断执行的结果
// 	if(!$result) {
// 		// sql语句执行失败
// 		// 给出相关的提示信息
// 		echo "SQL语句执行失败！<br />";
// 		echo "错误编号：", mysql_errno(), "<br />";
// 		echo "错误信息：", mysql_error(), '<br />';
// 		die;	
// 	}
// 	// 返回执行结果
// 	return $result;
	try{
        $result = $link->query($sql);
    }catch (PDOException $e){
        die ( "Error!: " . $e->getMessage());
    }
    return $result;
    //$line = $result->fetchAll(PDO::FETCH_NUM);
   // $rows = count($line);//获取查询结果条数
   // $result->getColumnMeta(0)['name']; //获取列名
}

/**
 * 选择默认的字符集
 */
function my_charset($arr, $link) {
	$charset = isset($arr['charset']) ? $arr['charset'] : 'utf8';
	$sql = "set names $charset";
	my_query($sql, $link);
}
 /**
 * 选择默认的数据库
 */
function my_dbname($arr, $link) {
	$dbname = isset($arr['dbname']) ? $arr['dbname'] : '';
	$sql = "use $dbname";
	my_query($sql, $link);
}

// 加载配置文件
$config = include DIR_CONFIG . 'config.php';
$arr = $config['db'];

// 数据库连接三步曲
// 连接数据库
$link = my_connect($arr);
// 选择默认字符集
my_charset($arr, $link);
// 选择默认的数据库
// my_dbname($arr);