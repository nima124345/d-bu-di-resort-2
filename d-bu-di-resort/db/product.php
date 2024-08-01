<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT * FROM `tbl_product` where p_deleted=0");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'p_id' => $row['p_id'],
            'p_name' => $row['p_name'],
            'p_detail' => $row['p_detail'],
            'p_price' => $row['p_price'],
            'p_img' => $row['p_img'],
            'p_type_id' => $row['p_type_id'],
            'p_deleted' => $row['p_deleted'],
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $query = "SELECT p.* ,pt.name as productType FROM `tbl_product` p left join tbl_product_type pt on pt.id=p.p_type_id
   WHERE p.p_deleted=0 and p.p_id=  '" . $_GET['id'] . "'";
    $res = mysqli_query($con, $query);
    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo json_encode($result);
    mysqli_close($con);
}
