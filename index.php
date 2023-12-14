<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>新闻后台管理系统</title>
</head>
<style type="text/css">
	.wrapper {
	    width: 1000px;
	    margin: 20px auto;
	}
	h2 {
	    text-align: center;
	}
	.add {
	    margin-left: 350px;
	}
	.add a {
	    text-decoration: none;
	    color: #fff;
	    background-color: #4caf50;
	    padding: 6px 13px;	
	    border-radius: 5px;
	    transition: background-color 0.3s;
	}
	.add a:hover {
	    background-color: #45a049;
	}
	select, input[type="text"], input[type="submit"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select {
            width: 150px;
        }
        input[type="text"] {
            width: 200px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
	}
	.container {
            display: flex; 
	    align-items: center; 
	    margin-bottom: 5px;
	}
	form {
            margin-right: 10px; 
    	}
	td {
	    text-align: center;
    	}
</style>
<body>
        <div class="wrapper">
                <h2>新闻后台管理系统</h2>
                <div class="container">
                    <form method="get">
                        <label for="field">查询字段：</label>
                        <select name="field" id="field">
                                <option value="id">ID</option>
                                <option value="title">标题</option>
                                <option value="keywords">关键字</option>
                                <option value="autor">作者</option>
                                <option value="addtime">发布时间</option>
                                <option value="content">内容</option>
                        </select>
                        <input type="text" name="keyword" placeholder="输入查询关键词">
                        <input type="submit" value="查询">
		    </form>
		    <div class="add">
                        <a href="addnews.html">增加新闻</a>
                    </div>	
                </div>
                <table width="960" border="1">
                        <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>关键字</th>
                                <th>作者</th>
                                <th>发布时间</th>
                                <th>内容</th>
                                <th>操作</th>
                        </tr>

                        <?php
                                // 1. 导入配置文件
                                require "dbconfig.php";

                                // 2. 连接MySQL数据库
                                $link = @mysqli_connect(HOST,USER,PASS,DBNAME) or die("提示：数据库连接失败！");
                                // 编码设置
                                mysqli_set_charset($link,'utf8');

                                // 3. 判断是否进行查询
                                $sql = 'select * from news';
                                if(isset($_GET['field']) && isset($_GET['keyword'])){
                                    $field = $_GET['field'];
                                    $keyword = $_GET['keyword'];
                                    // 对查询字段进行判断和过滤
                                    if ($field == 'id' || $field == 'title' || $field == 'keywords' || $field == 'autor' || $field == 'addtime' || $field == 'content') {
                                        // 执行查询
                                        $sql = "select * from news where {$field} like '%{$keyword}%'";
                                    }
                                }

                                // 4. 执行SQL语句并获取结果集
                                $result = mysqli_query($link, $sql);
                                $newsNum = mysqli_num_rows($result);

                                // 5. 解析结果集并输出数据
                                for($i=0; $i<$newsNum; $i++){
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<tr>";
                                        echo "<td>{$row['id']}</td>";
                                        echo "<td>{$row['title']}</td>";
                                        echo "<td>{$row['keywords']}</td>";
                                        echo "<td>{$row['autor']}</td>";
                                        echo "<td>{$row['addtime']}</td>";
                                        echo "<td>{$row['content']}</td>";
                                        echo "<td>
                                                        <a href='javascript:del({$row['id']})'>删除</a>
                                                        <a href='editnews.php?id={$row['id']}'>修改</a>
                                                  </td>";
                                        echo "</tr>";
                                }
                                // 5. 释放结果集
                                mysqli_free_result($result);
                                mysqli_close($link);
                        ?>

                </table>
        </div>
        <script type="text/javascript">
                function del (id) {
                        if (confirm("确定删除这条新闻吗？")){
                                window.location = "action_del.php?id="+id;
                        }
                }
        </script>
</body>
</html>
