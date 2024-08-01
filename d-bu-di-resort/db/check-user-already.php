<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $dataBody = json_decode($body, true);
    $res = mysqli_query($con, "SELECT COUNT(*) countValue FROM user where is_deleted=0 and user_name = '" . $dataBody['name'] . "' ");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'countValue' => $row['countValue']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
