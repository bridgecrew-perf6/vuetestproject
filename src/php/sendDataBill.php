<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
$request = json_decode(file_get_contents("php://input"));
// $request_body = file_get_contents('php://input');
// $data = json_decode($request_body, true);

if ($request != null) {

  $totalbill = $request->totalbill;
  $menuAdd = $request->menuAdd;

  // var_dump($request);

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "teowteow";

  $conn = new PDO("mysql:host=$servername;dbname=teowteow;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo 'meneadd';


  foreach ($menuAdd as $obj) {
    echo $obj->id_product;
 }
  //sql insert tbl_member
  $stmt = $conn->prepare("INSERT INTO bill
    (totalbill)  VALUES ('" . $totalbill . "')");
  //bindParam data type
  $stmt->bindParam('totalbill', $totalbill, PDO::PARAM_STR);

  $result = $stmt->execute();

  // //Get Latest Primary Key Inserted
  $id_bill = $conn->lastInsertId();

  //echo id ล่าสุดออกมาดูหน่อย ได้ตัวเลขออกมาไหม 
  // echo $lastID;
 print_r($menuAdd);

  foreach ($menuAdd as $item) {
    $id_product = $item->id_product;
    $quantity = $item->quantity;
    $stmt2 = $conn->prepare("INSERT INTO bill_detail  (id_bill, id_product,quantity) 
    VALUES (?, ?,?)");
    // $stmt = $pdo->prepare("INSERT INTO users (name, pass, mail, created, timezone_name, hash_pass, salt) VALUES (?, ?, ?, ?, ?, ?, ?)") ;
    $values = [$id_bill, $id_product,$quantity];
    //bindParam data type
    // $stmt2->bindParam('id_product', $id_product, PDO::PARAM_STR);
    $stmt2->execute($values);
    // $result2 = $stmt2->execute();
  }

  foreach ($menuAdd as $item1) {
    $id_product = $item1->id_product;
    $quantity = $item1->quantity;
    $stmt3 = $conn->prepare("INSERT INTO queue_order  (id_bill, id_product,quantity) 
    VALUES (?, ?,?)");
    // $stmt = $pdo->prepare("INSERT INTO users (name, pass, mail, created, timezone_name, hash_pass, salt) VALUES (?, ?, ?, ?, ?, ?, ?)") ;
    $values1 = [$id_bill, $id_product,$quantity];
    //bindParam data type
    // $stmt2->bindParam('id_product', $id_product, PDO::PARAM_STR);
    $stmt3->execute($values1);
    // $result2 = $stmt2->execute();
  }



  // foreach ($menuAdd as $item3) {
  //   $id = $item3->id;
  //   $quantity_ingre = $item3->quantity_ingre;
  //   $stmt5 = $conn->prepare("INSERT INTO q_in (id,quantity_ingre) 
  //   VALUES (?,?)");
  //   // $stmt = $pdo->prepare("INSERT INTO users (name, pass, mail, created, timezone_name, hash_pass, salt) VALUES (?, ?, ?, ?, ?, ?, ?)") ;
  //   $values3 = [$id,$quantity_ingre];
  //   //bindParam data type
  //   // $stmt2->bindParam('id_product', $id_product, PDO::PARAM_STR);
  //   $stmt5->execute($values3);
  //   // $result2 = $stmt2->execute();
  // }

  
  // $stmt3 = $conn->prepare("INSERT INTO queue_order (id_bill) 
  // VALUES ($id_bill)");
  // //bindParam data type

  // $result3 = $stmt3->execute();

  $conn = null; //close connect db


  //ปล. อย่าก๊อบวางเพียงอย่างเดียว จงประยุกต์ใช้ด้วยครับ
  //ตรวจสอบการเพิ่มข้อมูลถ้าเพิ่มเข้าทั้ง 2 ตารางคือถูกต้อง

  //isset 
  //devbanban.com
}
