<?php
include "./config/db_conn.php";
include "./config/room.php";

$room = new Room();

if(isset($_POST["submit"])){
    try {
        if($room->setType($_POST["type"])){
            $room->count = $_POST["count"];
            $room->conn = $conn;
            $room->addRoom();
            header("Location: list.php");
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Kamar</h1>
    <form action="add.php" method="post">
        <label for="type">Tipe Kamar</label>
        <input type="text" name="type" id="type">
        <label for="count">Jumlah Kamar</label>
        <input type="number" name="count" id="count">
        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>