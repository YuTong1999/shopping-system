<?php
    $title="添加";
    $view = TRUE;
?>

<form action="purchases_editadd.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">订单ID</th>
        <td><input type="text" name="pur"></td>
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
        <td colspan="2" align="center">
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "purchases.php";
    $pur=$_POST['pur'];
    // if($eid!=""||$eid!=null)
    // {
        $_sql = "INSERT INTO purchases(pur, cid, eid, pid, qty, ptime, total_price) VALUES ('{$_POST['pur']}', '{$_POST['cid']}', '{$_POST['eid']}', '{$_POST['pid']}', '{$_POST['qty']}', '{$_POST['ptime']}', '{$_POST['total_price']}')";
        $_result = $conn->query($_sql);
        if ($_result) {
            echo '<script type="text/javascript">document.location.href = document.location.href</script>';
            date_default_timezone_set('Asia/Shanghai');
            $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','purchases', 'add', '{$pur}')";
            $_result = $conn->query( $_sql);
        }
    // }
?>
