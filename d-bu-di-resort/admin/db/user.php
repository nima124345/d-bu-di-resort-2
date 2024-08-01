<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT   mem_id  user_id
    , m_group  user_group
    , m_name  name
    , m_user  user_name
    , m_addess   address
    , m_email email
    , m_tel  tel
    , is_deleted is_deleted
    ,data_save create_date
FROM tbl_Member
where is_deleted = 0");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'user_id' => $row['user_id'],
            'user_name' => $row['user_name'],
            'name' => $row['name'],
            'is_delete' => $row['is_deleted'],
            'address' => $row['address'],
            'create_date' => $row['create_date'],
            'user_group' => $row['user_group'],
            'email' => $row['email'],
            'tel' => $row['tel']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $query = "SELECT mem_id      user_id,
    m_group    user_group,
    m_name    name,
    m_user    user_name,
    m_addess     address,
    m_email   email,
    m_tel    tel,
    is_deleted   is_deleted,
    m_pass as password
    FROM tbl_Member WHERE mem_id =  '" . $_GET['id'] . "'";
    $res = mysqli_query($con, $query);
    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo json_encode($result);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "INSERT INTO tbl_Member (m_user, m_pass,m_name,m_addess,m_group,m_email,m_tel)
    values ('" . $data['user_name'] . "','" . $data['password'] . "','" . $data['name'] . "'
    ,'" . $data['address'] . "','" . $data['user_group'] . "','" . $data['email'] . "','" . $data['tel'] . "')";
    if (mysqli_query($con, $query)) {
        echo 'User Added...';
    } else {
        echo $query;
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'PUT') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    if ($data['id']) {
        $query = "UPDATE tbl_Member SET m_group = '" . $data['user_group'] . "',m_user = '" . $data['user_name'] . "'
        ,m_pass = '" . $data['password'] . "',m_name ='" .  $data['name'] . "',m_addess = '" . $data['address'] . "',m_email = '" . $data['email'] . "',m_tel = '" . $data['tel'] . "'
                    where mem_id = '" . $data['id'] . "'";
        if (mysqli_query($con, $query)) {
            echo 'User Update...';
        } else {
            echo  $query;
        }
    } else {
        echo 'please send id';
    }
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'DELETE') {
    global $con;
    $query = "UPDATE tbl_Member SET is_deleted=1 where mem_id = '" . $_GET['id'] . "'";
    if (mysqli_query($con, $query)) {
        echo 'User Delete...';
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
    mysqli_close($con);
}
