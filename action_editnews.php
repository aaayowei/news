<?php
// 处理编辑操作的页面 
require "dbconfig.php";
// 连接mysql
$link = @mysqli_connect(HOST,USER,PASS,DBNAME) or die("提示：数据库连接失败！");
// 编码设置
mysqli_set_charset($link,'utf8');

// 获取修改的新闻
$id = $_POST['id'];
$title = $_POST['title'];
$keywords = $_POST['keywords'];
$autor = $_POST['autor'];
$addtime = $_POST['addtime'];
$content = $_POST['content'];
// 更新数据
mysqli_query($link,"UPDATE news SET title='$title',keywords='$keywords',autor='$autor',addtime='$addtime',content='$content' WHERE id=$id") or die('修改数据出错：'.mysqli_error($link)); 
header("Location:index.php");  
