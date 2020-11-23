<?php
    require_once 'db.php';

    $conn = open_database();
    $stmt = $conn->prepare("INSERT INTO nguoidung (Birth) VALUES ?");
	// 6/10/2015 10:30:00
	$datetime = date("Y-m-d H:i:s", mktime(10, 30, 0, 6, 10, 2015));
	$stmt->bind_param("s", $datetime);
	$stmt->execute();
?>