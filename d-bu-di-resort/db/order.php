<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && !isset($_GET['order_detail'])) {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);

    $query =
        "INSERT INTO `order_head` (o_total, mem_id) values ('" . $data['o_total'] . "','" . $data['mem_id'] . "')";

    if (mysqli_query($con, $query)) {
        $last_id = $con->insert_id;
        echo  $last_id;
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_GET['order_detail'])) {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query =
        "INSERT INTO `order_detail` (o_id, p_id,d_qty,d_subtotal) values ('" . (int)$data['o_id'] . "','" . (int)$data['p_id'] . "','" . $data['d_qty'] . "','" . (int)$data['d_subtotal'] . "')";
    if (mysqli_query($con, $query)) {
        $last_id = $con->insert_id;
        echo  $last_id;
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {

    global $con;
    $res = mysqli_query($con, "select o.o_id,o.o_date order_date,o.o_total totalPrice
    ,o.o_transport_no transport_no,o.o_status as status,o.o_img_name img_name
   from order_head o
   where 	mem_id = '" . $_GET['id'] . "' order by o.o_date DESC");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'order_date' => $row['order_date'],
            'totalPrice' => $row['totalPrice'],
            'transport_no' => $row['transport_no'],
            'status' => $row['status'],
            'img_name' => $row['img_name'],
            'Order_id' => $row['o_id'],
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
