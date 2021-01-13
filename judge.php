<?php
include("connect.php");

// 商家账号
define("Manager", "yutong");

// 有表单数据
if (isset($_POST["cid"])) {
    // 获取用户id
    $cid_value = $_POST["cid"];
    // 商家跳转到查看销售量页面
    if ($cid_value == Manager) {
        header("Location: report_monthly_sale.php?mrc=".Manager);
    }
    // 普通用户需查看是否有该用户
    else {
        $sql = "select * from customers where cid='$cid_value'";
        if (mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
            header("Location: show_products.php?cid=$cid_value");
        } else {
            header("Location: index.php?&res=false");
        }
    }
}
// 没有时跳回登录界面
else {
    header("Location: index.php");
}
?>

