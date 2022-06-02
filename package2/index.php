<?php
require "./config/db_conn.php";

//make the sql for the selection
$sql = "SELECT * FROM room_type";

$result = mysqli_query($conn, $sql);

$room_type = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);


$error;


if (isset($_POST["submit"]) && !empty($_POST["checkin"]) && !empty($_POST["checkout"]) && !empty($_POST["room"]) && !empty($_POST["checkout"]) && !empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["handphone"]) && !empty($_POST["checkout"]) && !empty($_POST["guest"])) :

    $checkin = mysqli_real_escape_string($conn, $_POST["checkin"]);
    $checkout = mysqli_real_escape_string($conn, $_POST["checkout"]);
    $room = mysqli_real_escape_string($conn, $_POST["room"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $handphone = mysqli_real_escape_string($conn, $_POST["handphone"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $guest = mysqli_real_escape_string($conn, $_POST["guest"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);

    echo $handphone;

    $sql = "INSERT INTO `order` (`check_in`, `check_out`, `nama_pemesan`, `email`, `no_handphone`, `nama_tamu`, `tipe_kamar`, `jumlah_kamar`) VALUES ('$checkin', '$checkout', '$name', '$email', '$handphone', '$guest', '$type', '$room');";

    try {
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo "error " . mysqli_error($conn);
    }


else:
    $error = "all fields must be inputted";
endif;
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/style.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <?php include "./templates/guestNavbar.php" ?>
    <main>
        <div class="hero-image"><img src="./images/4528963.jpg" alt=""></div>
        <form method="POST">
            <section class="start">
                <div class="input-group">
                    <label for="checkin">Tanggal Check-in</label>
                    <input type="date" name="checkin" id="checkin">
                </div>
                <div class="input-group">
                    <label for="checkout">Tanggal Check-out</label>
                    <input type="date" name="checkout" id="checkout">
                </div>
                <div class="input-group">
                    <label for="room">Jumlah kamar</label>
                    <input type="number" name="room" id="room" class="number">
                </div>
                <button type="button" class="form-trigger">Pesan</button>
            </section>
            <section class="hide form">
                <div class="h1">Form pemesanan</div>
                <table>
                    <tr>
                        <td><label for="name">Nama pemesan</label></td>
                        <td><input type="text" name="name" id="name"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><label for="handphone">Nomor handphone</label></td>
                        <td><input type="number" name="handphone" id="handphone"></td>
                    </tr>
                    <tr>
                        <td><label for="guest">Nama tamu</label></td>
                        <td><input type="text" name="guest" id="guest"></td>
                    </tr>
                    <tr>
                        <td><label for="type">Tipe kamar</label></td>
                        <td><select name="type" id="type">
                                <?php
                                foreach ($room_type as $room) : ?>
                                    <option value=<?php echo "{$room["id_type"]}" ?>><?php echo "{$room["room_type_name"]}" ?></option>
                                <?php endforeach ?>
                            </select></td>
                    </tr>
                </table>
                <button type="submit" class="submit" name="submit">Konfirmasi pemesanan</button>
            </section>
        </form>
        <section class="content">
            <h1>Tentang kami</h1>
            <p>Lepaskan diri Anda ke Hotel Hebat, dikelilingi oleh keindahan pegunungan yang indah, danau, dan sawah yang menghijau
                Nikmati sore yang hangat dengan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau; Kid's club yang luas- menawarkan berbagai macam fasilitas dan
                kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention center kami dilengkapi pelayanan lengkap dengan ruang konvensi terbesar yang bisa memuat hingga 3.000
                delegasi. Manfaatkan ruang penyelenggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan dengan adat yang mewah
            </p>
        </section>
    </main>
    <script>
        const cta = document.querySelector(".form-trigger");
        const content = document.querySelector(".content");
        const form = document.querySelector(".form");
        cta.addEventListener("click", () => {
            content.classList.toggle("hide");
            form.classList.toggle("hide");
        })
    </script>
</body>

</html>