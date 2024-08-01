<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT * FROM `tbl_product_type` WHERE is_deleted = 0");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'name' => $row['name']

        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
