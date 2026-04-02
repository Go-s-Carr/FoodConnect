<?php
include("sql_functions.php");
echo '<link rel="stylesheet" href="sing.css">';
require("functions.php");

if (isset($_POST['email'])&&isset($_POST['password']))
{
    $email=$_POST['email'];
     $password=$_POST['password'];
   $res= check_user($email,$password,'localhost','root','','foodconnect');
   if ($res!=false) {
    session_start();
    $row=mysqli_fetch_assoc($res);
    $_SESSION['id']=$row['id'];
    $_SESSION['type']=$row['type'];

    if ($_SESSION['type']=='restaurant')
    {
        $res=check_client( $_SESSION['id'],'localhost','root','','foodconnect');
        $row-mysqli_fetch_assoc($res);
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['telephone']=$row['telephone'];
        $_SESSION['image']=$row['image'];
       header("Location: profile.php");
    }else {
        $res=check_resto( $_SESSION['id'],'localhost','root','','foodconnect');
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
echo'   <head>
    <link rel="stylesheet" href="FoodConnect/css/global.css">
  
    </head>
    <body class="body" >
      <form action="FoodConnect/initialize.php" onsubmit="return test()" method="post" >
      <fieldset class="window">
      <legend><h3>Login</h3></legend>
      <div>
      <input type="text" placeholder="Email" id="email" name="email">
      </br>
      <input type="password" placeholder="password(8charecters)" id="password" name="password">
      </br>
      <button type="submit" placeholder="login"  name="login">Login</button>
      </div>
      </fieldset>
      </form>
      </body>';
}

   