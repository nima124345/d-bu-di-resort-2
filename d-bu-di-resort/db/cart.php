<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "INSERT INTO cart (mem_id, p_id, qty) values ('" . $data['mem_id'] . "','" . $data['p_id'] . "','" . $data['qty'] . "')";
    if (mysqli_query($con, $query)) {
        echo 'Cart Added...';
    } else {
        echo $query;
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['countCart'])) {
    global $con;
    $res = mysqli_query($con, "select sum(qty) countCart
    from cart
    where mem_id  = '" . $_GET['countCart'] . "' ");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'countCart' => $row['countCart'],
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['countCart'])) {
    global $con;
    $res = mysqli_query($con, "select cart.id,tp.p_name,tp.p_price,sum(tp.p_price) sumPrice,sum(cart.qty) qty,tp.p_img,cart.mem_id,cart.p_id
    from cart
    left join tbl_product tp on cart.p_id = tp.p_id
    where mem_id ='" . $_GET['id'] . "'
    group by  p_name,p_img,p_price");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'p_id' => $row['p_id'],
            'p_name' => $row['p_name'],
            'p_price' => $row['p_price'],
            'p_img' => $row['p_img'],
            'sumPrice' => $row['sumPrice'],
            'qty' => $row['qty'],
            'mem_id' => $row['mem_id'],
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
