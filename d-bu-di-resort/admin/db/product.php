<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT product.p_id     id
    , product.p_name   product_name
    , product.p_detail product_detail
    , pm.name as        product_model
    , product.p_price  price
    , product.p_img    img_name
    , product.p_deleted is_delete
FROM tbl_product product
        LEFT JOIN tbl_product_type pm on pm.id = product.p_type_id");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'product_detail' => $row['product_detail'],
            'price' => $row['price'],
            'img_name' => $row['img_name'],
            'is_delete' => $row['is_delete'],
            'create_date' => $row['create_date'],
            'product_model' => $row['product_model']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $query = "SELECT product.p_id     id
    , product.p_name   product_name
    , product.p_detail product_detail
    , product.p_type_id as  product_model_id
    , product.p_price  price
    , product.p_img    img_name
    , product.p_deleted is_delete
    FROM tbl_product product

   WHERE  product.p_id =  '" . $_GET['id'] . "'";
    $res = mysqli_query($con, $query);
    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo json_encode($result);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "INSERT INTO tbl_product (p_name, p_price, p_detail,p_img,p_type_id) values ('" . $data['p_name'] . "'
    ,'" . $data['p_price'] . "','" . $data['p_detail'] . "'
    ,'" . $data['p_img'] . "','" . $data['p_type_id'] . "')";
    if (mysqli_query($con, $query)) {
        echo $query;
    } else {
        echo 'success';
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'PUT') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    if ($data['id']) {
        $query = "UPDATE tbl_product SET p_name = '" . $data['p_name'] . "',p_price = '" . $data['p_price'] . "',p_detail='" . $data['p_detail'] . "',p_img = '" . $data['p_img'] . "',p_type_id = '" . $data['p_type_id'] . "',p_deleted = '" . $data['p_deleted'] . "' where p_id = '" . $data['id'] . "'";
        if (mysqli_query($con, $query)) {
            echo 'Product Update...';
        } else {
            echo  $query;
        }
    } else {
        echo 'please send id';
    }
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'DELETE') {
    global $con;
    $query = "UPDATE tbl_product SET p_deleted=1 where p_id = '" . $_GET['id'] . "'";
    if (mysqli_query($con, $query)) {
        echo 'Product Delete...';
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
    mysqli_close($con);
}
