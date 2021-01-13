<?php
    $title="修改";
?>

<form action="customers_editmodify.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">顾客ID</th>
        <td> <input name="cid" readonly value="<?php if (isset($_GET['cid'])) echo $_GET['cid'] ?>"></td>
    </tr>
    <tr>
        <th text-align = "center">顾客姓名</th>
        <td><input type="text" name="cname"></td>
    </tr>
    <tr>
        <th text-align = "center">所在城市：</th>
        <td><input type="text" name="city"></td>
    </tr>
    <tr>
        <th text-align = "center">购物次数</th>
        <td><input type="text" name="visits_made"></td>
    </tr>
    <tr>
        <th text-align = "center">最后一次购物时间</th>
        <td><input type="text" name="last_visit_time"></td>
    </tr>
    <tr>
        <td colspan="2" align="center" >
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "customers.php";
    $cid = $_POST["cid"];
    $_sql = "UPDATE customers SET cid='{$_POST['cid']}', cname='{$_POST['cname']}', city='{$_POST['city']}', visits_made='{$_POST['visits_made']}', last_visit_time='{$_POST['last_visit_time']}' WHERE cid='{$_POST['cid']}'";
    $_result = $conn->query( $_sql);
    if ($conn->affected_rows > 0) {
        echo '<script type="text/javascript">window.location.reload()</script>';
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','customers', 'modify', '{$cid}')";
        $_result = $conn->query( $_sql);
    }

?>