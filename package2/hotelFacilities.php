<?php

include "./config/db_conn.php";
include "./config/facilities.php";

$facilities = Facility::showFacilities($conn, "hotel");
$facilityObj = new Facility();

if(isset($_POST["delete"])){
    $facilityObj->id_fasilitas = $_POST["id_to_delete"];
    try{
        if($facilityObj->deleteFacilities($conn)){
            header("Location: hotelFacilities.php");
        }
        
    } catch(\Throwable $th){
        echo "error deleting: " . mysqli_error($conn);
    }
}



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
<?php include "./templates/adminNavbar.php" ?>

<table>
    <tr>
        <th>Nama Fasilitas</th>
        <th>Aksi</th>
    </tr>
    <?php foreach($facilities as $facility): ?>
            <tr>
                <td><?php echo $facility["nama_fasilitas"]; ?></td>
                <td class="delete"><a href="details.php?id=<?php echo $facility["id_fasilitas"]; ?>">Edit</a>
                
                
            <form action="hotelFacilities.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $facility["id_fasilitas"]; ?>">
                <button type="submit" name="delete">delete</button>
            </form>
            
            </td>
            </tr>
            <?php endforeach ?>
</table>
<a href="addFacilitiesHotel.php">Tambah Fasilitas</a>
</body>
</html>