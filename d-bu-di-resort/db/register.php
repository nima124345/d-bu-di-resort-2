<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "INSERT INTO tbl_Member (m_group, m_name,m_user,m_pass,m_addess,m_email,m_tel) values ('ผู้ใช้งานทั่วไป','" . $data['name'] . "','" . $data['user_name'] . "','" . $data['password'] . "','" . $data['address'] . "','" . $data['email'] . "','" . $data['tel'] . "')";
    if (mysqli_query($con, $query)) {
        echo 'User Added...';
    } else {
        echo $query;
    }
    mysqli_close($con);
}
