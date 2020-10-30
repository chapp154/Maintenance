<?php
    include_once "connect.php";

    $datum_org = $_POST['datum'];
   // $datum_replace_symb = str_replace('/"', '-', $datum_org);
    $datum_new = date("d.m Y", strtotime($datum_org));

    $sluzba = $_POST['sluzba'];
    $popis = $_POST['popis'];

    $month_arr = str_split($datum_new);
    $month = $month_arr[3] . $month_arr[4];

    $sql = "INSERT INTO tasks (datum, sluzba, popis, mesic, urgent, done) VALUES ('$datum_new', '$sluzba', '$popis', '$month', '2', '2');";
    mysqli_query($conn, $sql);

?>