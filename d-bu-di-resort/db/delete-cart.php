<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $query = "delete from cart where id = '" . $_GET['id'] . "'";
    if (mysqli_query($con, $query)) {
        echo 'Cart Delete...';
    } else {
        echo $query;
    }
    mysqli_close($con);
}
