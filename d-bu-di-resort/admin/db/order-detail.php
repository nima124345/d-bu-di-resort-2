<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT p.p_name product_name, p.p_price price, pm.name as productModel, od.d_qty count, od.d_subtotal sum_price
    FROM `order_detail` od
             left join tbl_product p on p.p_id = od.p_id
             left join tbl_product_type pm on pm.id = p.p_type_id
    where od.o_id = '" . $_GET['id'] . "'");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'product_name' => $row['product_name'],
            'price' => $row['price'],
            'sum_price' => $row['sum_price'],
            'count' => $row['count'],
            'productModel' => $row['productModel']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
