<?php

include "./config/db_conn.php";

$sql = "SELECT * FROM facilities";

$result = mysqli_query($conn, $sql);

$facilities = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/fasilitas.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <?php include "./templates/guestNavbar.php" ?>
    <main>
    <div class="hero-image"><img src="./images/4528963.jpg" alt=""></div>
    <h1>Fasilitas yang tersedia</h1>
    <div class="grid-container">
        <?php foreach($facilities as $facility): ?>
            <div>
                <h1><?php echo $facility["nama_fasilitas"]; ?></h1>
            </div>
        <?php endforeach ?>
    </div>
    </main>
</body>
</html>