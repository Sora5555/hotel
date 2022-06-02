<?php 

include "./config/db_conn.php";
include "./config/room.php";
$room = new Room();



if(isset($_GET["id"])){
    $room->id_type = $_GET["id"];
    $room->conn = $conn;
    $details = $room->getRoomDetails();
    $room->setType($details[0]["room_type_name"]);
    $room->count = $details[0]["room_count"];
}
if(isset($_POST["submit"])){

    try {
        if($room->setType($_POST["type"])){
            $room->count = $_POST["count"];
            $room->changeRoom();
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
    <h1>edit info kamar</h1>
    <form action="change.php?id=<?php echo $room->id_type; ?>" method="post">
        <label for="type">Tipe Kamar</label>
        <input type="text" name="type" id="type" value="<?php echo $room->getType()?>">
        <label for="count">Jumlah kamar</label>
        <input type="number" name="count" id="count" value="<?php echo $room->count?>">
        <button type="submit" name="submit" value="submit" class="submit">Ubah</button>
    </form>
    
</body>
</html>