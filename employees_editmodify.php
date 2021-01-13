<?php
    $title="修改";
?>

<form action="employees_editmodify.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">员工ID</th>
        <td> <input name="eid" readonly value="<?php if (isset($_GET['eid'])) echo $_GET['eid'] ?>"></td>
    </tr>
    <tr>
        <th text-align = "center">员工姓名：</th>
        <td><input type="text" name="ename"></td>
    </tr>
    <tr>
        <th text-align = "center">所在城市：</th>
        <td><input type="text" name="city"></td>
    </tr>
    <tr>
        <td colspan="2" align="center" >
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "employees.php";
    $eid = $_POST["eid"];
    $_sql = "UPDATE employees SET eid='{$_POST['eid']}', ename='{$_POST['ename']}', city='{$_POST['city']}' WHERE eid='{$_POST['eid']}'";
    $_result = $conn->query( $_sql);
    if ($conn->affected_rows > 0) {
        echo '<script type="text/javascript">window.location.reload()</script>';
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','employees', 'modify', '{$eid}')";
        $_result = $conn->query( $_sql);
    }
    else
    {
        echo $conn->error();
    }
?>