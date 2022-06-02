<?php
include "./config/user.php";
include "./config/room.php";
include "./config/db_conn.php";
if(isset($_POST["delete"])){
    $oneRoom = new Room();
    $oneRoom->id_type = $_POST["id_to_delete"];
    $oneRoom->conn = $conn;
    try{
        if(!$oneRoom->deleteRoom()){
            throw new Exception("something's wrong when deleting");
        }
        header("Location: list.php");
    } catch(\Throwable $th){
        echo $th->getMessage();
    }
}

$rooms = Room::getRooms($conn);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/list.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <?php include "./templates/adminNavbar.php";?>

    <table>
        <tr>
            <th>room type</th>
            <th>room count</th>
            <th>action</th>
        </tr>
        <?php foreach($rooms as $room): ?>
            <tr>
                <td><?php echo $room["room_type_name"]; ?></td>
                <td><?php echo $room["room_count"]; ?></td>
                <td class="delete"><a href="change.php?id=<?php echo $room["id_type"]; ?>">Edit</a>
                
                
            <form action="list.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $room["id_type"]; ?>">
                <button type="submit" name="delete">delete</button>
            </form>
            
            </td>
            </tr>
            <?php endforeach ?>
    </table>
    
    <a href="add.php">Tambah Kamar</a>
</body>
</html>