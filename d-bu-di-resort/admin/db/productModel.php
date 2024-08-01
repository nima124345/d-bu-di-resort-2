<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "SELECT * FROM `tbl_product_type`");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'is_deleted' => $row['is_deleted']

        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && isset($_GET['id'])) {
    global $con;
    $query = "SELECT id,name,`is_deleted`
    from tbl_product_type
    WHERE  id =  '" . $_GET['id'] . "'";
    $res = mysqli_query($con, $query);
    $result = mysqli_fetch_array($res, MYSQLI_ASSOC);
    echo json_encode($result);
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    $query = "INSERT INTO tbl_product_type (name) values ('" . $data['name'] . "')";
    if (mysqli_query($con, $query)) {
        echo 'Product Model Added...';
    } else {
        echo $query;
    }
    mysqli_close($con);
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'PUT') {
    global $con;
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    if ($data['id']) {
        $query = "UPDATE tbl_product_type SET name = '" . $data['name'] . "'  where id = '" . $data['id'] . "';";
        if (mysqli_query($con, $query)) {
            echo 'Product Model Update...';
        } else {
            echo  $query;
        }
    } else {
        echo 'please send id';
    }
} else if (strtoupper($_SERVER['REQUEST_METHOD']) == 'DELETE') {
    global $con;
    $query = "UPDATE tbl_product_type SET is_deleted=1 where id = '" . $_GET['id'] . "'";
    if (mysqli_query($con, $query)) {
        echo 'Product Model Delete...';
    } else {
        echo 'ERROR: ' . mysqli_error($con);
    }
    mysqli_close($con);
}
