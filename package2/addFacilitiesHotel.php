<?php 

include "./config/db_conn.php";
include "./config/facilities.php";

$facility = new Facility;

if(isset($_POST["submit"])){
    $facility->setName($_POST["name"]);
    $facility->description = $_POST["desc"];
    $facility->addNew($conn, "hotel");
    header("Location: hotelFacilities.php");
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
    <form action="addFacilitiesHotel.php" method="post">
        <input type="text" name="name" id="name">
        <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
        <button type="submit" name="submit" value="submit">Add</button>
    </form>
</body>
</html>