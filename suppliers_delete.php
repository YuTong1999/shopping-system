<?php
    require "suppliers.php";

    if(isset($_GET['sid'])){
        $sid = $_GET['sid'];
    }
    $_sql="DELETE FROM suppliers WHERE sid='{$sid}'"; 
    $_result = $conn->query($_sql);
    if($conn->affected_rows > 0)
    {
        date_default_timezone_set('Asia/Shanghai');
        $_sql="INSERT INTO logs VALUES(null,'root', '".date('Y-m-d H:i:s')."','suppliers', 'delete', '{$sid}')";
        echo $_sql;
        $_result = $conn->query( $_sql);
        echo '<script type="text/javascript">document.location.href = document.location.href</script>';
    }

?>
