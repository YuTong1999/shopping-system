<?php
include("connect.php");

// 成功购买
$cid_value = $_POST["cid"];
if (purchase($cid_value, $_POST["eid"], $_POST["pid"], $_POST["qty"])) {
    header("Location: show_products.php?cid=$cid_value&purchase_res=true");
} else {
    header("Location: show_products.php?cid=$cid_value&purchase_res=false");
}


// 增加一个购买记录
function add_purchase($pur_value, $cid_value, $eid_value, $pid_value, $qty_value) {
    // 使用全局变量$conn
    global $conn;
    
    // 获取商品真正的价格
    $sql = "select original_price, discnt_rate from products where pid = '$pid_value'";
    $allRecords = mysqli_query($conn, $sql);     // 得到的是一堆记录，但事实上只有一条
    $aRecord = mysqli_fetch_assoc($allRecords);
    $price_value = $aRecord['original_price'] * (1 - $aRecord['discnt_rate']);   

    // 计算总价
    $total_price_value = $qty_value * $price_value;
    $ptime_value = 'now()';

    // 插入记录
    $sql = 
    "INSERT INTO purchases ".
    "(pur, cid, eid, pid, qty, ptime, total_price)".
    "VALUES".
    "($pur_value, '$cid_value', '$eid_value', '$pid_value', $qty_value, $ptime_value, $total_price_value)";

    // 插入
    mysqli_query($conn, $sql);
}


// 购买函数
function purchase($cid_value, $eid_value, $pid_value, $qty_value) {
    // 使用全局变量$conn
    global $conn;

    // 获取库存
    $sql = "select qoh from products where pid = '$pid_value'";
    $allRecords = mysqli_query($conn, $sql);     // 得到的是一堆记录，但事实上只有一条
    $aRecord = mysqli_fetch_assoc($allRecords);
    $qoh_value = $aRecord['qoh'];                // 库存

    // 购买数量不合理，直接结束
    if ($qty_value > $qoh_value) {
        return false;
    }

    // 以下正常购买
    // 获取$pur_value，为增加记录做准备
    $sql = "select max(pur) as max from purchases";
    $allRecords = mysqli_query($conn, $sql);                // 得到的是一堆记录，但事实上只有一条
    $pur_value = mysqli_fetch_assoc($allRecords)['max'] + 1;
    // 增加一个购买记录
    add_purchase($pur_value, $cid_value, $eid_value, $pid_value, $qty_value);

    return true;
}

?>

