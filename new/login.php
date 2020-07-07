<?php
    session_start();
    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "registration";
    $link = new mysqli($servername,$user,$password,$dbname);
    if($link->connect_error)
        die("Connection Error : "+ $link->connect_error);
    // mysqli_select_db($link,"registration");
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    // $sql = $link->prepare("select * from user where email = ? ;");
    // $sql->bind_param("s",$email);
    $sql = "select * from user where email = '$email' && pswd='$pswd' ;";
    $res = $link->query($sql);
    // $res = $sql->execute();
    // echo $res;
    if($res->num_rows < 1) {
        echo "<h1>Invalid Username or Password</h1><br><br>";
        //sleep(2000);
        //$link->close();
        header("location:http://localhost/swl/new/page2.html");
        //return;
    }
    
    // if(!($fpswd == $pswd)) {
        
    // }
    // $sql = "select * from user where email = '$email';";
    // $res = $link->query($sql);
    $row = mysqli_fetch_array($res);
    if($row['step2']=="ok") {
        $_SESSION['email'] = $email;
        // $link->close();
        header("location:http://localhost/swl/new/print.php");
    }
    else if($row['step1']=="ok") {
        // $link->close();
        $_SESSION['email'] = $email;
        header("location:http://localhost/swl/new/registration2.php");
    }
    else {
        $link->close();
        $_SESSION['email'] = $email;
        header("location:http://localhost/swl/new/registration1.php");
    }
?>