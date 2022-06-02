<?php 

class Facility{
    public $id_fasilitas;
    private $name;
    public $description;
    public $messages;

    public function setName($name){
        if(!preg_match("/^[a-zA-z]/", $name)){
            throw new Exception("name invalid");
        }
        $this->name = $name;
        return true;
    }
    public function getName(){
        return $this->name;
    }
    public static function showFacilitiesJoin($conn){
        $sql = "SELECT * FROM facilities as f JOIN room_facilities as rf ON `f`.`id_fasilitas` = `rf`.`id_fasilitas` JOIN room_type ON `room_type`.`id_type` = `rf`.`id_type`";
        try {
            //code...
            $result = mysqli_query($conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
            echo "error " . mysqli_error($conn) . mysqli_errno($conn);
        }
    }
    public static function showFacilities($conn, $type){
        $sql = "SELECT * FROM facilities WHERE `type` = '$type'";
        try {
            //code...
            $result = mysqli_query($conn, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
            echo "error " . mysqli_error($conn) . mysqli_errno($conn);
        }
    }
    public function addNew($conn, $type){
        $sql = "INSERT INTO facilities(`nama_fasilitas`, `deskripsi`, `type`) VALUES ('$this->name', '$this->description', '$type')";
        try {
            //code...
            if(mysqli_query($conn, $sql)){
                $this->messages = "insert success";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo mysqli_error($conn);
        }
        return $conn->insert_id;
    }
    public function deleteFacilities($conn){
        $sql = "DELETE FROM facilities WHERE `id_fasilitas` = $this->id_fasilitas";
        return mysqli_query($conn, $sql);
    }
    public function getByName($conn){
        $sql = "SELECT id_fasilitas FROM facilities WHERE `nama_fasilitas` = '$this->name'";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_assoc($result);
    }

}


?>