<?php
    $title="修改";
?>

<form action="suppliers_editmodify.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">供应商ID</th>
        <td> <input name="sid" readonly value="<?php if (isset($_GET['eid'])) echo $_GET['eid'] ?>"></td>
    </tr>
    <tr>
        <th text-align = "center">供应商名</th>
        <td><input type="text" name="sname"></td>
    </tr>
    <tr>
        <th text-align = "center">所在城市</th>
        <td><input type="text" name="city"></td>
    </tr>
    <tr>
        <th text-align = "center">电话号码</th>
        <td><input type="text" name="telephone_no"></td>
    </tr>

    <tr>
        <td colspan="2" align="center" >
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "suppliers.php";
    $sid = $_POST["sid"];
    $_sql = "UPDATE suppliers SET sid='{$_POST['sid']}', sname='{$_POST['sname']}', city='{$_POST['city']}', telephone_no='{$_POST['telephone_no']}' WHERE sid='{$_POST['sid']}'";
    $_result = $conn->query( $_sql);
    if ($conn->affected_rows > 0) {
        echo '<script type="text/javascript">window.location.reload()</script>';
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','suppliers', 'modify', '{$sid}')";
        $_result = $conn->query( $_sql);
    }
    else
    {
        echo $conn->error();
    }
?>