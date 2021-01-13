<?php
    $title="添加";
?>

<form action="customers_editadd.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">顾客ID</th>
        <td><input type="text" name="cid"></td>
    </tr>
    <tr>
        <th text-align = "center">顾客姓名</th>
        <td><input type="text" name="cname"></td>
    </tr>
    <tr>
        <th text-align = "center">所在城市</th>
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
        <td colspan="2" align="center">
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "customers.php";
    
    $cid=$_POST['cid'];
    // if(isset($_POST['cid']))
    // {
        $_sql = "INSERT INTO customers(cid, cname, city, visits_made, last_visit_time) VALUES ('{$_POST['cid']}', '{$_POST['cname']}', '{$_POST['city']}', '{$_POST['visits_made']}', '{$_POST['last_visit_time']}')";
        $_result = $conn->query($_sql);
        if ($_result) {
            echo '<script type="text/javascript">document.location.href = document.location.href</script>';
            date_default_timezone_set('Asia/Shanghai');
            $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','customers', 'add', '$cid')";
            $_result = $conn->query( $_sql);
        }
    // }
?>
