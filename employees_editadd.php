<?php
    $title="添加";
    $view = TRUE;
?>

<form action="employees_editadd.php" method="post"> 
<table align="center" width="35%" border="0">
    <caption><h2><?php echo $title ?></h2></caption>
    <tr>
        <th text-align = "center">员工ID</th>
        <td><input type="text" name="eid"></td>
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
        <td colspan="2" align="center">
            <button type="submit" class = "btn btn-success">提交</button><button type="reset" class = "btn btn-success">重置</button>
        </td>
    </tr>
</table>
</from>

<?php
    require "employees.php";
    $eid=$_POST['eid'];
    if($eid!=""||$eid!=null)
    {
        $_sql = "INSERT INTO employees(eid, ename, city) VALUES ('{$_POST['eid']}', '{$_POST['ename']}', '{$_POST['city']}')";
        $_result = $conn->query($_sql);
        if ($_result) {
            echo '<script type="text/javascript">document.location.href = document.location.href</script>';
            date_default_timezone_set('Asia/Shanghai');
            $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','employees', 'add', '{$eid}')";
            $_result = $conn->query( $_sql);
        }
    }
?>
