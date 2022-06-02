<?php
session_start();
if(isset($_POST["logout"])){
    session_destroy();
    header("Location: login.php");
}
?>


<header>
    <div class="logo"><h1>HOTEL HEBAT</h1></div>
    <nav>
        <ul>
            <li><a href="list.php" class="Home">Kamar</a></li>
            <li><a href="facilitiesList.php" class="Kamar">Fasilitas Kamar</a></li>
            <li><a href="hotelFacilities.php" class="Fasilitas">Fasilitas Hotel</a></li>
            <li><form method="post">
                <button type="submit" name="logout">Logout</button>
            </form></li>
        </ul>
    </nav>
</header>