<?php
    require "products.php";

    if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
    }
    $_sql="DELETE FROM products WHERE pid='{$pid}'"; 
    $_result = $conn->query($_sql);

    if($conn->affected_rows > 0)
    {
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date("Y-m-d H:i:s")."','products', 'delete', '{$pid}')";
        $_result = $conn->query( $_sql);
        echo '<script type="text/javascript">document.location.href = document.location.href</script>';
    }

?>