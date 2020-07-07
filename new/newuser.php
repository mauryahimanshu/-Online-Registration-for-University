<?php
    session_start();
    $link = mysqli_connect("localhost","root");
    if(!$link){
        echo "<h1>Internal Server Error</h1>";
        return;
    }
    mysqli_select_db($link,"registration");
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $pass = $pswd;
    $name = $_POST['name'];
    $query = "select * from user where email = '$email'; ";
    $res = mysqli_query($link, $query);
    $rows = mysqli_num_rows($res);
    if(!$rows) {
        $query = "insert into user(email, pswd, name) values('$email', '$pass', '$name'); ";
        $status = mysqli_query($link, $query);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        //mysqli_close($link);
        header("location:http://localhost/swl/new/registration1.php");
    }
    else {
        echo "<h4>Email already in Use</h4><br>";
        echo "<h6>Try again with different email</h6><br><br><br><br>";
        echo "<i>Redirecting to Registration Page .........</i>";
        sleep(2000);
        mysqli_close($link);
        // header("location:http://localhost/swl/old/newuser.html");
    }
?>