<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teowteow";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = mysqli_query($conn,"SELECT * FROM noodle ");
if(mysqli_num_rows($sql) > 0){
    $items = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($items);
}
else{ echo json_encode([["success"=>0]]); }

if (isset($_GET["deletenoodle"])){
    $sql = mysqli_query($conn,"DELETE FROM noodle WHERE id_noo=".$_GET["deletenoodle"]);
    if($items){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

 ?>