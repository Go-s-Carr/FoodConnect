<?php

$host="localhost";
$user="rooy";
$pass="";
$db="account";

include("functions.php");
function check_user(string $username,$host,$user,$pass,$db)
{
    //sees if username exists in table if yes return true else return false
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("connection failed");
    $req="SELECT username from user WHERE username ='$username'";
    $res=mysqli_query($cn,$req);
    mysqli_close($cn);

    if (mysqli_num_rows($res)==0)
    {
        return false;
    }else 
    {
       return true;
    }
    
}   
function check_id(int $id,$host,$user,$pass,$db)
{
    //sees if id exists in table, if yes return true otherwise false
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("connection failed");
    $req="SELECT id from user WHERE id ='$id'";
    $res=mysqli_query($cn,$req);
    mysqli_close($cn);

    if (mysqli_num_rows($res)==0)
    {
        return false;
    }else 
    {
       return true;
    }
}
function create_account($username,$password,$email,$host,$user,$pass,$db)
{   //returns $id if successful returns false otherwise

    date_default_timezone_set('UTC');
    $id=0;
    //checks if id exists
    while ($id=rand(10000 ,99999) && check_id($id,$host,$user,$pass,$db)) {
        
    }

    //connection
    $cn=mysqli_connect("$host","$user","$pass","$db")or die("Connection failed");
    
    //insertion
    $req="INSERT into user values('$id','$username','$password','$email')  ";
    $res=mysqli_query($cn,$req);
    mysqli_close($cn);

    //return check
    if (mysqli_num_rows($res)==0) 
    {
        return false;
    }
    else {
        return $id;
    }

 }
 function create_profile($id,$host,$user,$pass,$db)
 {
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");
    change_image("default/images/default.png",$host,$user,$pass,$db,0);
    mysqli_close($cn);
 }
 function change_image($adress,$host,$user,$pass,$db,$pos)
 {
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");
    switch ($db) {
        case 'catagory':
            $req="INSERT into catagory value ";
            break;
        
        default:
            # code...
            break;
    }
   
    
    mysqli_close($cn);
 }
