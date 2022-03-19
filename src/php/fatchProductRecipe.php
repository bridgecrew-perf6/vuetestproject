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

$sql = mysqli_query($conn,"SELECT p.name_product , p.price_product , r.id_product , r.id_ingre , i.name_ingre
FROM product p 
LEFT JOIN recipe r
ON p.id_product = r.id_product
LEFT JOIN ingredients i 
ON r.id_ingre = i.id_ingre
");
if(mysqli_num_rows($sql) > 0){
    $items = mysqli_fetch_all($sql,MYSQLI_ASSOC);
    echo json_encode($items);
}
else{ echo json_encode([["success"=>0]]); }



if (isset($_GET["deletetablee"])){
    $sql = mysqli_query($conn,"DELETE FROM product WHERE id_product=".$_GET["deletetablee"]);
    if($items){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

 ?>


