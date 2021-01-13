<?php
    $title="添加";
?>

<form action="suppliers_editadd.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">供应商ID</th>
        <td><input type="text" name="sid"></td>
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
        <td colspan="2" align="center">
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "suppliers.php";
    $sid=$_POST['sid'];
    // if($pid!=""||$pid!=null)
    // {
        $_sql = "INSERT INTO suppliers(sid, sname, city, telephone_no) VALUES ('{$_POST['sid']}', '{$_POST['sname']}', '{$_POST['city']}', '{$_POST['telephone_no']}')";
        $_result = $conn->query($_sql);
        if ($_result) {
            echo '<script type="text/javascript">document.location.href = document.location.href</script>';
            date_default_timezone_set('Asia/Shanghai');
            $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','suppliers', 'add', '{$sid}')";
            $_result = $conn->query( $_sql);
        }
    // }
?>
