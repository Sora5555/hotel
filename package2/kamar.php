<?php 
include "./config/db_conn.php";

$sql = "SELECT r.room_type_name, f.nama_fasilitas FROM room_facilities AS rf JOIN facilities AS f ON rf.id_fasilitas = f.id_fasilitas INNER JOIN room_type as r ON rf.id_type = r.id_type";
$sql2 = "SELECT * FROM room_type";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

$room_facilities = mysqli_fetch_all($result, MYSQLI_ASSOC);
$room_names = mysqli_fetch_all($result2, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/room.css?v=<?php echo time(); ?>">
    <title>Kamar</title>
</head>
<body>
    <main>
        <?php include "./templates/guestNavbar.php" ?>
        <?php foreach ($room_names as $room_name):?>
            <div class="type">
                <div class="hero-image"><img src="./images/<?php echo $room_name["image"]; ?>.jpg" alt=""></div>
                <h1 class="type_header"><?php echo $room_name["room_type_name"]; ?></h1>
                <ul class="facilities">
                    <?php foreach($room_facilities as $room_facility): ?>
                        <?php if($room_facility["room_type_name"] == $room_name["room_type_name"]): ?>
                            <li><?php echo $room_facility["nama_fasilitas"]; ?></li>
                        <?php endif ?>
                    <?php endforeach?>
                <ul>
            </div>
            <?php endforeach ?>
    </main>
</body>
</html>