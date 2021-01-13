<?php
    $title="修改";
?>

<form action="purchases_editmodify.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">订单ID</th>
        <td> <input name="pur" readonly value="<?php if (isset($_GET['pur'])) echo $_GET['pur'] ?>"></td>
    </tr>
    <tr>
        <th text-align = "center">顾客ID</th>
        <td><input type="text" name="cid"></td>
    </tr>
    <tr>
        <th text-align = "center">员工ID</th>
        <td><input type="text" name="eid"></td>
    </tr>
    <tr>
        <th text-align = "center">商品ID</th>
        <td><input type="text" name="pid"></td>
    </tr>
    <tr>
        <th text-align = "center">商品总数</th>
        <td><input type="text" name="qty"></td>
    </tr>
    <tr>
        <th text-align = "center">付款时间</th>
        <td><input type="text" name="ptime"></td>
    </tr>
    <tr>
        <th text-align = "center">总价钱</th>
        <td><input type="text" name="total_price"></td>
    </tr>

    <tr>
        <td colspan="2" align="center" >
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "purchases.php";
    $pur = $_POST["pur"];
    $_sql = "UPDATE purchases SET pur='{$_POST['pur']}', cid='{$_POST['cid']}', eid='{$_POST['eid']}', pid='{$_POST['pid']}', qty='{$_POST['qty']}', ptime='{$_POST['ptime']}', total_price='{$_POST['total_price']}' WHERE pur='{$_POST['pur']}'";
    $_result = $conn->query( $_sql);
    if ($conn->affected_rows > 0) {
        echo '<script type="text/javascript">window.location.reload()</script>';
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','purchases', 'modify', '{$pur}')";
        $_result = $conn->query( $_sql);
    }

?>