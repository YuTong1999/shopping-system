<?php
    $title="添加";
    $view = TRUE;
?>

<form action="products_editadd.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">商品ID</th>
        <td><input type="text" name="pid"></td>
    </tr>
    <tr>
        <th text-align = "center">商品姓名</th>
        <td><input type="text" name="pname"></td>
    </tr>
    <tr>
        <th text-align = "center">总进货量</th>
        <td><input type="text" name="qoh"></td>
    </tr>
    <tr>
        <th text-align = "center">库存</th>
        <td><input type="text" name="qoh_threshold"></td>
    </tr>
    <tr>
        <th text-align = "center">正常价格</th>
        <td><input type="text" name="original_price"></td>
    </tr>
    <tr>
        <th text-align = "center">折扣率</th>
        <td><input type="text" name="discnt_rate"></td>
    </tr>
    <tr>
        <th text-align = "center">供应商ID</th>
        <td><input type="text" name="sid"></td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "products.php";

    // if(isset($_POST['pid'])){
    $pid=$_POST['pid'];
        $_sql = "INSERT INTO products(pid, pname, qoh, qoh_threshold, original_price, discnt_rate, sid) VALUES ('{$_POST['pid']}', '{$_POST['pname']}', '{$_POST['qoh']}', '{$_POST['qoh_threshold']}', '{$_POST['original_price']}', '{$_POST['discnt_rate']}', '{$_POST['sid']}')";

        $_result = $conn->query($_sql);
        if ($_result) {
            echo '<script type="text/javascript">document.location.href = document.location.href</script>';
            date_default_timezone_set('Asia/Shanghai');
            $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','products', 'add', '{$pid}')";
            $_result = $conn->query( $_sql);
            echo $_sql;
        } 
    // }
   
?>
