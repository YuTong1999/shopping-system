<!DOCTYPE html>  
<html lang="en">  
	<head>  
		<meta charset="UTF-8">  
		<title>登录</title>  
		<link rel="icon" href="data:;base64,=">
		<style>
			body {
				background-image: url(./yutong/load.jpg);
                background-size: 100% 100%;
                background-attachment: fixed;
			}   
			#login {
				position: absolute;
				top: 50%;
				left:50%;
				margin: -150px 0 0 -150px;
				width: 300px;
				height: 300px;
			}   
			#login h1{
				color: lemonchiffon;
				text-shadow:0 0 50px;
				text-align: center;
                font-family: FZShuTi;
                font-size: 70px;
                font-weight: bold;
			}
			input {
				width: 278px;
				height: 25px;
				margin-bottom: 20px;
				padding: 10px;
				font-size: 18px;
				border: 1px dashed;
				border-radius: 10px;
			}   
			.but {
				width: 300px;
				min-height: 30px;
				display: block;
                color: black;
				background-color: rgba(255, 255, 255, 0.3);
				border: 1px none #3762bc;
                padding: 10px 0;
				font-size: 25px;
				border-radius: 5px;
				margin: 0;
                font-family: KaiTi;
			}
            .but:hover {
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 0 10px;
            }
		</style>
	</head>

	<body>
		<div id="login">  
			<h1>Login</h1>  
			<form action="judge.php" method="post">  
				<input type="text" required="required" placeholder="用户ID" name="cid">
				<button class="but" type="submit">登 录</button>  
			</form>
			<?php
				if (isset($_GET["res"]) && $_GET["res"] == "false") {
					echo "<script>alert('抱歉，该用户不存在')</script>";
				}
			?>
		</div> 
	</body>  
</html>