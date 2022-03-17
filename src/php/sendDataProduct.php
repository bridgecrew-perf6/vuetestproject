<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");

$request = json_decode(file_get_contents("php://input"));

if($request != null){

$name_product = $request->name_product;
$price_product = $request->price_product;

var_dump($request);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teowteow";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO product (name_product,price_product)
    VALUES ('".$name_product."','".$price_product."')";

    if ($conn->query($sql) === TRUE) {
    var_dump( "New record created successfully");
    } else {
    var_dump( "Error: " . $sql . "<br>" . $conn->error);
    }

    $conn->close();

    if ($conn->query($sql) === "getAll") {
        $query="SELECT * FROM product ";
        $statement=$connect->preoare($query);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$row;
        }
        echo json_encode($data);
        
    }

    
}
?>
