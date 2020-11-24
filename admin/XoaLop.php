<?php
session_start();
require '../db.php';
if (!isset($_SESSION['Username']) || $_SESSION['Role'] != 0) {
    header('location:../login.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $conn = open_database();
    $stmt1 = $conn->prepare("SELECT * from lop where IdLop =?");
    $stmt1->bind_param('i', $id);
    if($stmt1->execute()){
        $result = $stmt1->get_result();
        $row = $result->fetch_assoc();
        unlink($row['HinhLop']);

        $stmt = $conn->prepare("DELETE from lop where IdLop = ?");

        $stmt->bind_param('i', $id);
    
        if($stmt->execute()){
            header('location:dashboard.php');
        }
        else {
            die("Query error: " . $stmt->error);
        }
    }
    else {
        die("Query error: " . $stmt->error);
    }
    
}


?>