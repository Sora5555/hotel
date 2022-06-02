<?php
include "./config/db_conn.php";

include "./config/user.php";

if(isset($_POST["submit"])){
    $user = User::getUser($_POST["username"], $conn);
    print_r($user);
    try {
        if(password_verify($_POST["password"], $user[0]["password"])){
            $logacc = new User();
            $logacc->setEmail($user[0]["email"]);
            $logacc->setPassword($_POST["password"]);
            $logacc->setUsername($user[0]["username"]);
            $logacc->role = $user[0]["role"];
            session_start();
            $_SESSION["user"] = $logacc;
            if($user[0]["role"] === "admin"){
                header("Location: list.php");
            } else {
                header("Location: order.php");
            }
        }
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
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" class="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit" value="submit">Login</button>
    </form>
</body>
</html>