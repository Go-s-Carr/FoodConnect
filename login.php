<?php
include_once("sql_functions.php");



if (isset($_POST['email'])&&isset($_POST['password']))
{
    $email=$_POST['email'];
     $password=$_POST['password'];
   $res= check_user($email,$password,'localhost','admin',"TOnFlores02:10.",'foodconnect');
   if ($res!=false) {
    session_start();
    $row=mysqli_fetch_assoc($res);
    $_SESSION['id']=$row['id'];
    $_SESSION['type']=$row['type'];

    if ($_SESSION['type']=='restaurant')
    {
        $res=check_client( $_SESSION['id'],'localhost','admin',"TOnFlores02:10.",'foodconnect');
        $row-mysqli_fetch_assoc($res);
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['telephone']=$row['telephone'];
        $_SESSION['image']=$row['image'];
       header("Location: profile.php");
    }else {
        $res=check_resto( $_SESSION['id'],'localhost','admin',"TOnFlores02:10.",'foodconnect');
        $row-mysqli_fetch_assoc($res);
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['telephone']=$row['telephone'];
        $_SESSION['facebook']=$row['facebook'];
        $_SESSION['instagram']=$row['instagram'];
        $_SESSION['whatsapp']=$row['whatsapp'];

        $_SESSION['image']=$row['image'];
        $_SESSION['url']=$row['url'];
       header("Location: resto_dashboard.php");
    }
    header("Location: profile.php");
   }
   else 
    {
        login();
    }

}
else
    {
        login();
    }
function login()
{
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../FoodConnect/css/sing.css">
    <link rel="stylesheet" href="../FoodConnect/css/global.css">
</head>
<body class="body">
    <form action="../FoodConnect/profile.php" method="post">
        <fieldset class="window"> 
            <legend><h3>Login</h3></legend>
            <div>
                <input type="text" placeholder="Email" id="email" name="email">
                <br>
                <input type="password" placeholder="password (8 characters)" id="password" name="password">
                <br>
                <button type="submit" name="login">Login</button>
            </div>
        </fieldset>
    </form>
</body>
</html>';
}

   