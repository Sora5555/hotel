<?php 

class Room{
    public $id_type;
    private $type;
    public $count;
    public $conn;

    public static function getRooms($conn){
        $sql = "SELECT * FROM room_type";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function getRoomDetails(){
        $sql = "SELECT * FROM room_type WHERE id_type = $this->id_type";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function addRoom(){
        $sql = "INSERT INTO `room_type` (`room_type_name`, `room_count`) VALUES ('$this->type', '$this->count')";
        return mysqli_query($this->conn, $sql);
    }
    public function deleteRoom(){
        $sql = "DELETE FROM room_type WHERE `id_type` = '$this->id_type'";
        return mysqli_query($this->conn, $sql);
    }
    public function changeRoom(){
        $sql = "UPDATE `room_type` SET `room_type_name`='$this->type',`room_count`='$this->count' WHERE `id_type` = $this->id_type";
        return mysqli_query($this->conn, $sql);
    }
    public function setType($type){
        if(preg_match("/\d\W*/", $type)){
            throw new Exception("name invalid");
        }
        $this->type = $type;
        return true;
    }
    public function getType(){
        return $this->type;
    }
    public function addToJoin($id_facilities, $conn){
        $sql = "INSERT INTO room_facilities (`id_type`, `id_fasilitas`) VALUES ('$this->id_type', '$id_facilities')";
        return mysqli_query($conn, $sql);
    }
}