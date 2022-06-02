<?php
include "./config/user.php";
include "./config/db_conn.php";

if(isset($_POST["submit"])){
    if(!empty($_POST["username"] && $_POST["email"] && $_POST["password"])){
    $newUser = new User();
    try{
        $newUser->setEmail($_POST["email"]);
        $newUser->setPassword($_POST["password"]);
        $newUser->setUsername($_POST["username"]);
        $newUser->role = $_POST["role"];
        $newUser->save_user($conn);
        echo "all true";
    } catch(Exception $e){
        echo $e->getMessage();
    }
    }
    else{
        echo "error in the form";
    }
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/fasilitas.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <label for="role">role</label>
    <select name="role" id="role">
        <option value="admin">admin</option>
        <option value="cashier">cashier</option>
    </select>
    <button type="submit" name="submit">Register</button>
    </form>
</body>
</html>