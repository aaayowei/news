<?php
// 处理增加操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysqli_connect(HOST,USER,PASS,DBNAME) or die("提示：数据库连接失败！");
// 编码设置
mysqli_set_charset($link,'utf8');

// 获取增加的新闻
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$autor = $_POST['autor'];
$addtime = $_POST['addtime'];
$content = $_POST['content'];
// 插入数据
mysqli_query($link,"INSERT INTO news(title,keywords,autor,addtime,content) VALUES ('$title','$keywords','$autor','$addtime','$content')") or die('添加数据出错：'.mysqli_error($link)); 
header("Location:index.php");  
