<?php
    session_start();
    unset($_SESSION['admin-id']);
    echo "<script>window.location='index.php'</script>";
?>