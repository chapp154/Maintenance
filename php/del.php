<?php

include_once "connect.php";

$id = $_POST['id'];
$del = $_POST['del'];

$sql_del = "DELETE FROM tasks WHERE id = '$id';";
mysqli_query($conn, $sql_del);

?>