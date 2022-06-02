<?php try {
    //code...
    $conn = mysqli_connect("localhost", "Sora", "aosora55", "hotel");
  } catch (\Throwable $th) {
    //throw $th;
      echo "error connecting " . mysqli_connect_error();
  }
?>