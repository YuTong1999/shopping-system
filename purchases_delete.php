<?php
    require "purchases.php";

    if(isset($_GET['pur'])){
        $pur = $_GET['pur'];
    }
    $_sql="DELETE FROM purchases WHERE pur='{$pur}'"; 
    $_result = $conn->query($_sql);

    if($conn->affected_rows > 0)
    {
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','purchases', 'delete', '{$pur}')";
        $_result = $conn->query( $_sql);
        echo '<script type="text/javascript">document.location.href = document.location.href</script>';
    }

?>
