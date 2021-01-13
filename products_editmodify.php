<?php
    $title="修改";
?>

<form action="products_editmodify.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">商品ID</th>
        <td> <input name="pid" readonly value="<?php if (isset($_GET['pid'])) echo $_GET['pid'] ?>"></td>
    </tr>
    <tr>
        <th text-align = "center">商品名</th>
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
        <td colspan="2" align="center" >
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "products.php";
    $pid = $_POST["pid"];
    $_sql = "UPDATE products SET pid='{$_POST['pid']}', pname='{$_POST['pname']}', qoh='{$_POST['qoh']}', qoh_threshold='{$_POST['qoh_threshold']}', original_price='{$_POST['original_price']}', discnt_rate='{$_POST['discnt_rate']}', sid='{$_POST['sid']}' WHERE pid='{$_POST['pid']}'";
    $_result = $conn->query( $_sql);
    if ($conn->affected_rows > 0) {
        echo '<script type="text/javascript">window.location.reload()</script>';
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','produces', 'modify', '{$pid}')";
        $_result = $conn->query( $_sql);
    }

?>