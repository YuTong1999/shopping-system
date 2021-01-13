<?php
include("connect.php");

// 商家账号
define("Manager", "yutong");

// 没有账号自动跳回
if (!isset($_GET["mrc"]) || $_GET["mrc"] != Manager) {
    header("Location: index.php");
}

// 构建一个商品选择器
function mcd_selector() {
    // 使用全局变量$conn
    global $conn;

    // 获取所有记录
    $sql = "select * from products";
    $allRecords = mysqli_query($conn, $sql);

    // 遍历记录，通过复选框进行显示
    echo "<select name='pid'>";
    while ($aRecord = mysqli_fetch_assoc($allRecords)) {
        // 获取商品id和名称
        $pid_value = $aRecord['pid'];
        $pname_value = $aRecord['pname'];
        // 选中表单中指定的商品
        $selcted = "";
        if (isset($_POST['pid']) && $pid_value == $_POST['pid']) {
            $selcted = "selected='selected'";
        }
        // 构建复选框
        echo "<option value='$pid_value' $selcted>";
        echo "$pname_value ($pid_value)";
        echo "</option>";
    }
    echo "</select>";
}

// 查询
function report_monthly_sale($pid_value) {
    // 使用全局变量$conn
    global $conn;
    
    // 查询语句
    $sql =
    "select ".
    "year(ptime) as year, ".
    "month(ptime) as month, ".
    "pname, ".
    "sum(qty) as sum_qty, ".
    "round(sum(total_price), 2) as sum_price, ".
    "round(sum(total_price) / sum(qty), 2) as avg_price ".
    "from purchases, products where purchases.pid = products.pid ".
    "and purchases.pid='$pid_value' ".
    "group by extract(year_month from ptime)";
    // 查出所有数据备用
    $allRecords = mysqli_query($conn, $sql);

    // 通过表格进行显示
    // 表格显示的顺序
    $Chinese_fields = Array("年份", "月份", "商品名称", "月销售量", "月销售额", "月均价");
    $English_fields = Array("year", "month", "pname", "sum_qty", "sum_price", "avg_price");
    $fields_count = count($English_fields);

    echo 
    "<table  align='center'>".
    // 表格标题
    "<caption><span class='en-text'>$pid_value</span>"."的月销售情况如下表</caption>".
    "<tbody>";

    // 所有字段
    echo "<tr>";
    for ($i = 0; $i < $fields_count; $i++) {
        echo "<th>".$Chinese_fields[$i]."</th>";
    }
    echo "</tr>";

    // 月份的英文简写
    $English_month = Array(null, 'Jan.', "Feb.", "Mar.", "Apr.", "May", 
    "June.", "July.", "Aug.", "Sept.", "Oct.", "Nov.", "Dec.");
    // 显示所有数据
    while ($aRecord = mysqli_fetch_assoc($allRecords)) {
        echo "<tr>";
        for ($i = 0; $i < $fields_count; $i++) {
            // 月份区别对待，同时英文字体装饰一下
            if ($i == 1) {
                echo "<td class='en-text'>".$English_month[$aRecord[$English_fields[$i]]]."</td>";
                continue;
            }
            // 英文字体装饰
            echo "<td  class='en-text'>".$aRecord[$English_fields[$i]]."</td>";
        }
        echo "</tr>";
    }

    echo
    "</tbody>".
    "</table>";
}
?>


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
        <h1>查询</h1>  
        <!--将表单发送到本文件-->
        <form action=<?php echo "'report_monthly_sale.php?mrc=".Manager."'" ?>  method = 'post'>
            <!--查询商品与按钮-->
            <p>查询商品：<?php mcd_selector() ?>&emsp;&emsp;<input type='submit' value='查 询'></p>
            <p><a href="create.php">查询列表</a></p>
        </form>
        <?php
            // 检查是否含有表单数据
            if (isset($_POST['pid'])) {
                // 获取值，然后进行查询
                $pid_value = $_POST['pid'];
                report_monthly_sale($pid_value);
            }
        ?>
    </body>
</html>