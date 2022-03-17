<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");

$request = json_decode(file_get_contents("php://input"));

if($request != null){

$name_ingre = $request->name_ingre;
$quantity_ingre = $request->quantity_ingre;
$date_ingre= $request->date_ingre;
$exp_ingre= $request->exp_ingre;


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

    $sql = "INSERT INTO ingredients (name_ingre,quantity_ingre,date_ingre,exp_ingre)
    VALUES ('".$name_ingre."','".$quantity_ingre."','".$date_ingre."','".$exp_ingre."')";

    if ($conn->query($sql) === TRUE) {
    var_dump( "New record created successfully");
    } else {
    var_dump( "Error: " . $sql . "<br>" . $conn->error);
    }

    $conn->close();

    if ($conn->query($sql) === "getAll") {
        $query="SELECT * FROM rawmaterial";
        $statement=$connect->preoare($query);
        $statement->execute();
        while($row=$statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$row;
        }
        echo json_encode($data);
        
    }

    
}
?>
