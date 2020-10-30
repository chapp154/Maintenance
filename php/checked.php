<?php
include_once "connect.php";

$urgent = $_POST['urgent'];
$done = $_POST['done'];
$id = $_POST['id'];

if (isset($_POST['urgent'])) {
    $sql_urgent = "UPDATE tasks SET urgent = '$urgent' WHERE id = $id;";
    mysqli_query($conn, $sql_urgent);
}

if (isset($_POST['done'])) {
    $sql_urgent = "UPDATE tasks SET done = '$done' WHERE id = $id;";
    mysqli_query($conn, $sql_urgent);
}

?>