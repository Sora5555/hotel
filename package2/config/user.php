<?php class User{

    private $username;
    private $email;
    private $password;
    public $role;


    public function save_user($conn){
        $sql = "INSERT INTO user(`username`, `email`, `password`, `role`) VALUES ('$this->username', '$this->email', '$this->password', '$this->role')";
        try {
            //code...
            if(mysqli_query($conn, $sql)){
                header("Location: login.php");
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo "Error query " . mysqli_error($conn);
        }
    }
    public static function getUser($username, $conn){
       return mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM user WHERE `username` = '$username'"), MYSQLI_ASSOC);
    }
    public function setEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
        } else {
            throw new Exception("email isn't valid");
        }
    }
    public function setUsername($username){
        if(strlen($username) < 6){
           throw new Exception("username too short");
        }
        $this->username = $username;
    }
    public function setPassword($password){
        if(strlen($password) < 7){
            throw new Exception("password too short");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT, [10]);
    }
}
