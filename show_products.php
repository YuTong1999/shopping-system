<?php
include("connect.php");

// 没有cid或者cid不正确，直接跳回登录界面
if (!isset($_GET["cid"]) || !right($_GET["cid"])) {
    header("Location: index.php");
}
// 获取cid的值
$cid_value = $_GET["cid"];


// 判断一个账号是否正确
function right($cid_value) {
    // 使用全局变量$conn
    global $conn;

    $sql = "select * from customers where cid='$cid_value'";
    if (mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
        return true;
    }
    return false;
}

// 构建一个员工选择器
function emp_selector() {
    // 使用全局变量$conn
    global $conn;

    // 获取所有记录
    $sql = "select * from employees";
    $allRecords = mysqli_query($conn, $sql);

    // 遍历记录，通过复选框进行显示
    echo "<select name='eid'>";
    while ($aRecord = mysqli_fetch_assoc($allRecords)) {
        // 获取员工id和名字
        $eid_value = $aRecord['eid'];
        $ename_value = $aRecord['ename'];
        // 构建复选框
        echo "<option value='$eid_value'>";
        echo "$ename_value ($eid_value)";
        echo "</option>";
    }
    echo "</select>";
}

// 展示一个商品
function show_mcd($aRecord) {
    // 使用全局变量
    global $cid_value;

    echo "<td valign='bottom' class='big-table-cell'>";    // 下端对齐
    
    // 设置图片
    $img_path = "./yutong/".$aRecord['pname'].".jpg";
    echo "<img src='$img_path' width='250px'>";

    // 再用表格显示相关信息
    echo 
    "<table class='small-table' align='center'><tbody>".
    "<tr><td class='small-table-cell'>名称</td><td class='small-table-cell en-text'>".$aRecord['pname']."</td></tr>".
    "<tr><td class='small-table-cell'>价格</td><td class='small-table-cell en-text'>$".$aRecord['original_price']."</td></tr>".
    "<tr><td class='small-table-cell'>折扣</td><td class='small-table-cell'><span class='en-text'>".(10 - $aRecord['discnt_rate'] * 10)."</span>折</td></tr>".
    "<tr><td class='small-table-cell'>库存</td><td class='small-table-cell en-text'>".$aRecord['qoh']."</td></tr>".
    "</tbody></table>";

    // 表单信息
    echo 
    "<form action='purchase.php' method='post'>".
    "<input type='hidden', name='pid' value='".$aRecord['pid']."'>".
    "<input type='hidden', name='cid' value='".$cid_value."'>".
    "<p>购买数量：<input type='number' name='qty' min='1' value='1' class='en-text'></p>".
    "<p title='请选择为您提供服务的服务员'>服务员："; emp_selector(); echo "</p>".
    "<input type='submit' value='购 买'>".
    "</form>";

    echo "</td>";
}

// 展示所有商品
function show_products() {
    global $conn;
    
    // 获取所有记录
    $sql = "select * from products";
    $allRecords = mysqli_query($conn, $sql);

    // 遍历记录，然后进行显示
    // 通过表格进行显示
    echo "<table align='center' class='big-table'><tbody>";
    $i = 1;     // 用于记录换行的位置
    while ($aRecord = mysqli_fetch_assoc($allRecords)) {
        if ($i % 3 == 1) {
            echo "<tr>";
        }
        show_mcd($aRecord);
        $i++;
        if ($i % 3 == 1) {
            echo "</tr>";
        }
    }
    echo "</table></tbody>";
}

?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>浏览商品</title>
        <style>
            body {
                background-image: url(./yutong/load.jpg);
                background-size: 100% 100%;
                background-attachment: fixed;
            }
            .big-table {
                border-spacing: 100px 50px;
            }
            tr first-child {
                border-spacing: 20px 0;
            }
            .big-table-cell {
                text-align: center;
                border-style: dashed;
                border-width: thin;
                border-color: gray;
                border-radius: 15px;
                padding: 10px 30px;
                background-color: white;
                font-family: KaiTi;
                font-size: 25px;
            }
            .small-table {
                border-style: solid;	/*实线*/
                border-width: thin;
                border-collapse: collapse;  /*直接消除单元格之间的距离*/
            }
            .small-table-cell {
                text-align: center;
                border-style: dashed;
                border-width: thin;
                padding: 15px 30px;
		    }
            .en-text {
                font-family: FZShuTi;
                font-size: 25px;
            }
            input[type='number'] {
                width: 50px;
                height: 24px;
            }
            select {
                font-size: 25px;
                font-family: FZShuTi;
                height: 30px;
            }
            input[type='submit'] {
                font-size: 25px;
                font-family: KaiTi;
                width: 150px;
                height: 42px;
                text-align: center;
                border-radius: 5px;
            }
            input[type='submit']:hover {
                font-weight: bold;
                cursor: pointer;
            }
            #buy h1{
				color: lemonchiffon;
				text-shadow:0 0 50px;
                text-size-adjust: 20px;
				text-align: center;
                font-size: 100px;
                font-family: FZShuTi;
                font-weight: bold;
            }
            a{
                text-size-adjust: 20px;
            }
        </style>
    </head>
    <body>
        <div id="buy">  
            <h1>商品列表</h1> 
            <?php
                // 显示商品
                show_products();
                // 判断购买是否成功
                if (isset($_GET["purchase_res"])) {
                    // 购买成功
                    if ($_GET["purchase_res"] == "true") {
                        echo "<script>alert('成功购买！继开心购物吧(*^▽^*)')</script>";
                    } else {
                        echo "<script>alert('抱歉，该商品的库存不足，购买失败o(╥﹏╥)o。小店会尽快上货')</script>";
                    }
                }
                echo '<center><a href="index.php">返回主页</a></center>';
            ?>
		</div> 
    </body>
</html>
