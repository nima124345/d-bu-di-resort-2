<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);

    if ($data['id']) {
        $query = "UPDATE `order_head` SET o_img_name = '" . $data['o_img_name'] . "',o_status= 'กำลังตรวจสอบ' where o_id = '" . $data['id'] . "'";

        if (mysqli_query($con, $query)) {
            echo 'Order Update...';
        } else {
            echo  $con;
        }
    } else {
        echo 'please send id';
    }
}
