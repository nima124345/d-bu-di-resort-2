<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT * from tbl_Member where mem_id= '" . $_GET['id'] . "'");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'user_id' => $row['mem_id'],
            'm_name' => $row['m_name'],
            'user_name' => $row['m_user'],
            'password' => $row['m_pass'],
            'address' => $row['m_addess'],
            'email' => $row['m_email'],
            'tel' => $row['m_tel'],
        );
    }

    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    echo $data['id'];

    if ($data['id']) {
        $query = "UPDATE tbl_Member SET m_name = '" . $data['name'] . "',m_user='" . $data['user_name'] . "',m_pass = '" . $data['password'] . "',m_addess = '" . $data['address'] . "',m_email = '" . $data['email'] . "',m_tel = '" . $data['tel'] . "' where mem_id = '" . $data['id'] . "'";
        echo $query;
        if (mysqli_query($con, $query)) {
            echo 'Member Update...';
        } else {
            echo  $con;
        }
    } else {
        echo 'please send id';
    }
}
