<?php 

class order{
    private $name;
    public $id_order;
    public $check_in;
    public $check_out;
    private $email;
    private $handphone_num;
    private $guest_name;
    public $type;
    public $count;
    public $status;


    public static function getOrder($conn){
        $sql = "SELECT * FROM `order`";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function setName($name){
        if(preg_match("/(\d)\w*/g", $name)){
            throw new Exception("name invalid");
        }
        return $this->name = $name;
    }
    public function setGuestName($name){
        if(preg_match("/(\d)\w*/g", $name)){
            throw new Exception("name invalid");
        }
        return $this->guest_name = $name;
    }
    public function setEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $this->email = $email;
        } else {
            throw new Exception("email isn't valid");
        }
    }
    public function setHandphone($handphone){
        if(preg_match("/(\a)\w*/g", $handphone)){
            throw new Exception("number invalid");
        }
        return $this->handphone_num = $handphone;
    }
    public function newOrder($conn){
        $name = mysqli_real_escape_string($conn, $this->name);
        $check_in = mysqli_real_escape_string($conn, $this->check_in);
        $check_out = mysqli_real_escape_string($conn, $this->check_out);
        $room = mysqli_real_escape_string($conn, $this->count);
        $guest = mysqli_real_escape_string($conn, $this->guest_name);
        $type = mysqli_real_escape_string($conn, $this->type);
        $handphone = mysqli_real_escape_string($conn, $this->handphone_num);
        $email = mysqli_real_escape_string($conn, $this->email);

        $sql = "INSERT INTO `order` (`check_in`, `check_out`, `nama_pemesan`, `email`, `no_handphone`, `nama_tamu`, `tipe_kamar`, `jumlah_kamar`) VALUES ('$check_in', '$check_out', '$name', '$email', '$handphone', '$guest', '$type', '$room');";

        try {
            if(mysqli_query($conn, $sql)){
                header("Location: index.php");
    
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "error " . mysqli_error($conn);
        }
    }
    public function updateStatus($conn){
        $sql = "UPDATE `order` SET `status` = '$this->status' WHERE `order`.`id_order` = $this->id_order;";
        return mysqli_query($conn, $sql);
    }
}