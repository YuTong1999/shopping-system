<?php require 'connect.php'; ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content = "create/php; charset = gb2312"/>
        <title>连接百货公司数据库</title>
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
                font-size: 35px;
                font-family: KaiTi;
                margin: 20px auto 0 auto;
            }
            select {
                font-size: 25px;
                font-family: FZShuTi;
                height: 42px;
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
            a{
                text-align: center; 
            }
        </style>
    </head>
    <body bgcolor = "white" text='#ff0000'>
        <h1>百货公司管理系统</h1>
        <p><a href="employees.php">employees</a></p>
        <p><a href="customers.php">customers</a></p>
        <p><a href="suppliers.php">suppliers</a></p>
        <p><a href="products.php">products</a></p>
        <p><a href="purchases.php">purchases</a></p>
        <p><a href="logs.php">logs</a></p>
        <p><a href="index.php">返回登陆界面</a></p>
    </body>

<html>