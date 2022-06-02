<?php

include "./config/db_conn.php";
include "./config/facilities.php";
include "./config/room.php";

$rooms = Room::getRooms($conn);

$facilities = Facility::showFacilities($conn, "room");

$oneRoom = new Room();
$oneFacility = new Facility();

if(isset($_POST["existing"])){
    try {
        //code...
        $oneFacility->setName($_POST["facility"]);
        $facilityId = $oneFacility->getByName($conn);
        $oneRoom->id_type = $_POST["room"];
        $oneRoom->addToJoin($facilityId["id_fasilitas"], $conn);
        header("Location: facilitiesList.php");
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
}
if(isset($_POST["newFac"])){
    try {
        $oneFacility->setName($_POST["name"]);
        $oneFacility->description = $_POST["desc"];
        $id = $oneFacility->addNew($conn, "room");
        echo $id;
        $oneRoom->id_type = $_POST["room"];
        $oneRoom->addToJoin($id, $conn);
        header("Location: facilitiesList.php");
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
    <link rel="stylesheet" href="./public/list.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <form action="addFacilities.php" method="post">
        <select name="room" id="room">
            <?php foreach($rooms as $room): ?>
                <option value="<?php echo $room["id_type"] ?>"><?php echo $room["room_type_name"] ?></option>
                <?php endforeach ?>
        </select>
                <div class="cta">
                    <button type="button" class="new">Add new</button>
                    <button type="button" class="exist">Add from existing list</button>
                </div>
                <section class="existing hide">
                    <select name="facility" id="facility">
                        <?php foreach($facilities as $facility): ?>
                        <option value="<?php echo $facility["nama_fasilitas"] ?>"><?php echo $facility["nama_fasilitas"] ?></option>
                        <?php endforeach ?>
                    </select>
                    <button class="submit" type="submit" name="existing">Add</button>
                </section>
                <section class="newFac hide">
                    <label for="name">Nama fasilitas</label>
                    <input type="text" name="name" id="name">
                    <label for="desc">deskripsi</label>
                    <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
                    <button class="submit" type="submit" name="newFac">Add</button>
                </section>
    </form>

    <script>
        const cta = document.querySelector(".cta");
        const addNew = document.querySelector(".new");
        const addExist = document.querySelector(".exist");
        const existing = document.querySelector(".existing");
        const newFac = document.querySelector(".newFac");
        const submit = document.querySelector(".submit");

        addNew.addEventListener("click", () => {
            newFac.classList.toggle("hide");
            cta.classList.toggle("hide")
        })
        addExist.addEventListener("click", (e) => {
            existing.classList.toggle("hide");
            cta.classList.toggle("hide");
            e.preventDefault();
        })
    </script>
</body>
</html>