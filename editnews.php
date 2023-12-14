<!DOCTYPE html>
<html>
<head lang="en">  
    <meta charset="UTF-8">
    <title>修改新闻</title>
</head>
<style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            width: 300px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
</style>
<body>
<?php
    require "dbconfig.php";

    $link = @mysqli_connect(HOST,USER,PASS,DBNAME) or die("提示：数据库连接失败！");
    mysqli_set_charset($link,'utf8');
    
    $id = $_GET['id'];
    $sql = mysqli_query($link,"SELECT * FROM news WHERE id=$id");
    $sql_arr = mysqli_fetch_assoc($sql); 

?>
<div>
<h1 style="text-align: center; font-size: 24px;">修改新闻</h1>
<form action="action_editnews.php" method="post">
    <label>新闻ID: </label><input type="text" name="id" value="<?php echo $sql_arr['id']?>" readonly>
    <label>标题：</label><input type="text" name="title" value="<?php echo $sql_arr['title']?>">
    <label>关键字：</label><input type="text" name="keywords" value="<?php echo $sql_arr['keywords']?>">
    <label>作者：</label><input type="text" name="autor" value="<?php echo $sql_arr['autor']?>">
    <label>发布时间：</label><input type="date" name="addtime" value="<?php echo $sql_arr['addtime']?>">
    <label>内容：</label><input type="text"  name="content" value="<?php echo $sql_arr['content']?>">
    <input type="submit" value="提交">
</form>
</div>
</body>
</html>
