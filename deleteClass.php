<?php
    include_once('connection.php');
    $sql = "DELETE FROM class where IdLop=".$_GET['id'];
    $result = $conn->query($sql);
    header('Location: index.php');
?>