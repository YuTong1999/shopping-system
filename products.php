<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>销售量</title>
        <style>
            h1{
				color: lemonchiffon;
				text-shadow:0 0 50px;
				text-align: center;
                font-family: FZShuTi;
                font-size: 70px;
                font-weight: bold;
			}
            body {
				background-image: url(./yutong/background.jpg);
                background-size: 100% 100%;
                background-attachment: fixed;
			}  
            p {
                text-align: center;
                font-size: 25px;
                font-family: KaiTi;
                margin: 20px auto 0 auto;
            }
            a {
                text-align: center;
                font-size: 25px;
                font-family: KaiTi;
                margin: 20px auto 0 auto;
            }
            select {
                font-size: 25px;
                font-family: FZShuTi;
                height: 42px;
            }
            input[type='submit'] {
                font-size: 25px;
                font-family: KaiTi;
                width: 150px;
                height: 42px;
                text-align: center;
            }
            input[type='submit']:hover {
                font-weight: bold;
                cursor: pointer;
            }
            caption {
                margin: 20px;
            }
            table{
                border-style: solid;	/*实线*/
                border-width: thin;
                border-collapse: collapse;  /*直接消除单元格之间的距离*/
                font-family: KaiTi;
                font-size: 25px;
            }
            th, td {
                text-align: center;
                border-style: dashed;
                border-width: thin;
                border-color: gray;
                padding: 12px;
		    }
            .en-text {
                font-family: FZShuTi;
                font-size: 25px;
            }
        </style>
    </head>
    <body>
    <?php
        include 'connect.php';
        error_reporting(0);
        $conn->query("set names gb2312");
        $result = $conn->query("SELECT * FROM products");
        echo '<table width = "90%" border = "1" align = "center">';
        echo '<caption><h1>商品</h1></caption>';
        echo '<th>商品ID</th><th>商品名</th><th>总进货量</th><th>库存</th><th>正常价格</th><th>折扣率</th><th>供应商ID</th><th>编辑</th>';
        while($row = $result->fetch_assoc()){
            echo '<tr align = center">';
            echo '<td>'.$row["pid"].'</td>';
            echo '<td>'.$row["pname"].'</td>';
            echo '<td>'.$row["qoh"].'</td>';
            echo '<td>'.$row["qoh_threshold"].'</td>';
            echo '<td>'.$row["original_price"].'</td>';
            echo '<td>'.$row["discnt_rate"].'</td>';
            echo '<td>'.$row["sid"].'</td>';
            echo '<td><a href="products_editmodify.php?pid='.$row["pid"].'">修改</a>
                <a href="products_delete.php?pid='.$row["pid"].'">删除</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<center><a href="products_editadd.php">添加</a></center>';
        echo '<center><a href="create.php">返回主页</a></center>';
    ?>
    </body>
</html>