<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT o.o_id                                                                                       id
    , u.m_name                                                                                      first_name
    , u.m_name                                                                                       last_name
    , o.o_date                                                                                     order_date
    , o.o_transport_no
    , o.o_img_name                                                                                       img_name
    , o.o_total sumprice
    , (select count(*) from order_detail where order_detail.o_id = o.o_id)         sumamount
    , o.o_status as                                                                                status
FROM order_head o
        left join tbl_Member u on u.mem_id = o.mem_id
order by o.o_date DESC;");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'order_date' => $row['order_date'],
            'sumprice' => $row['sumprice'],
            'sumamount' => $row['sumamount'],
            'status' => $row['status'],
            'img_name' => $row['img_name']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $query = "select o.o_id        id
    , o.mem_id            order_by
    , u.m_name       first_name
    , u.m_name        last_name
    , u.m_tel       tel
    , u.m_email      email
    , u.m_addess     as address
    , o.o_status as status
    , o.o_date      order_date
    , o.o_img_name        img_name
    , o.o_transport_no transport_no
        from order_head o
        left join tbl_Member u on u.mem_id = o.mem_id
    WHERE o.o_id =  '" . $_GET['id'] . "'";
    $res = mysqli_query($con, $query);
    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo json_encode($result);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'PUT') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "UPDATE order_head SET  o_status = '" . $data['status'] . "'   where o_id = '" . $_GET['id'] . "'";
    if (mysqli_query($con, $query)) {
        echo 'order update...';
    } else {
        echo $query;
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $dataBody = json_decode($body, true);
    $res = mysqli_query($con, "SELECT o.o_id                                                                                       id
    , u.m_name                                                                                      first_name
    , u.m_name                                                                                       last_name
    , o.o_date                                                                                     order_date
    , o.o_transport_no
    , o.o_img_name                                                                                       img_name
    , o.o_total sumprice
    , (select count(*) from order_detail where order_detail.o_id = o.o_id)         sumamount
    , o.o_status as                                                                                status
FROM order_head o
        left join tbl_Member u on u.mem_id = o.mem_id
where CAST(o.o_date  as date) between '" . $dataBody['startDate'] . "' and '" . $dataBody['endDate'] . "'
order by o_date  DESC;");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'order_date' => $row['order_date'],
            'sumprice' => $row['sumprice'],
            'sumamount' => $row['sumamount'],
            'status' => $row['status'],
            'img_name' => $row['img_name']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
