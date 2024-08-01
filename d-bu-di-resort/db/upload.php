<?php
//upload.php
if ($_FILES["file"]["name"] != '') {
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $name = rand(100, 999) . '.' . $ext;
    $location = $_SERVER['DOCUMENT_ROOT'] . '/d-bu-di-resort/img/img-slip/' . $name;
    $newLocation = explode($_SERVER['DOCUMENT_ROOT'], $location)[1];
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
    $namesArray[] = array('path' => $newLocation);
    echo json_encode($namesArray);
}
