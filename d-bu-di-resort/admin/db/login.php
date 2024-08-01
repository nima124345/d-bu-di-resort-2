<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);

    $res = mysqli_query($con, "select u.mem_id as user_id,u.m_name first_name,u.m_name last_name,m_group
    from tbl_Member u
    where u.m_user = '" . $data['username'] . "'
    and u.m_pass = '" . $data['password'] . "'
");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'user_id' => $row['user_id'],
            'user_group' => $row['m_group'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
