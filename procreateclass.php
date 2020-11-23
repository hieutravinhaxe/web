<?php
$classname = $_POST["classname"];
$classroom = $_POST["classroom"];
$classproject = $_POST["classproject"];
$classGV = '';
$classcode = rand(1000, 99999);
$target_file = "uploads/" . $_FILES["fileToUpload"]["name"];

if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{
    die("Sorry, there was an error uploading your file.");
}

require "connection.php";

if (empty($_POST["id"]))
{
	$stmt = $conn->prepare("INSERT INTO class( TenLop, Phong, Mon, HinhLop, MaLop, IdGV ) VALUES (?, ?, ?, ?,?,?)");
} else 
{
	$id = $_POST["id"];
	$stmt = $conn->prepare("UPDATE class 
							SET TenLop=?, Phong=?, Mon=?, HinhLop=?, MaLop=?, IdGV=?
							WHERE IdLop=$id");
}

$stmt->bind_param('sssssi',$classname, $classroom, $classproject, $target_file,$classcode,$classGV);

if ($stmt->execute() === TRUE) {
  header("Location: index.php");
} else {
  echo "Error: " . "<br>" . $conn->error;
}
?>