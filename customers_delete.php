<?php
    require "customers.php";

    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
    }
    $_sql="DELETE FROM customers WHERE cid='{$cid}'"; 
    $_result = $conn->query($_sql);

    if($conn->affected_rows > 0)
    {
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date("Y-m-d H:i:s")."','customers', 'delete', '{$cid}')";
        $_result = $conn->query( $_sql);
        echo '<script type="text/javascript">document.location.href = document.location.href</script>';
    } 
?>