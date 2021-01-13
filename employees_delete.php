<?php
    require "employees.php";

    if(isset($_GET['eid'])){
        $eid = $_GET['eid'];
    }
    $_sql="DELETE FROM employees WHERE eid='{$eid}'"; 
    $_result = $conn->query($_sql);

    if($conn->affected_rows > 0)
    {
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','employees', 'delete', '{$_eid}')";
        $_result = $conn->query( $_sql);
        echo '<script type="text/javascript">document.location.href = document.location.href</script>';
    }

?>
