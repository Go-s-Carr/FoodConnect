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
function create_client($id,$username,$email,$phone,$image,$host,$user,$pass,$db)
{   //returns $id if successful returns false otherwise


    //connection
    $cn=mysqli_connect("$host","$user","$pass","$db")or die("Connection failed");
    
    if ($image=='')
    {
            $image='default.png';
    }
    //insertion
    $req="INSERT into client values('$id','$username','$email','$phone','$image')  ";
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
 function create_user($email,$type,$password,$host,$user,$pass,$db)
 {
    //returns the id used
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");

    $req="INSERT into user values(NULL,'$email','$password','$type')";
    $res=mysqli_query($cn,$req);
     mysqli_close($cn);
    if (mysqli_num_rows($res)==0) {
        return false;
    
    }
    else
    {
        $id=mysqli_insert_id($cn);
       return $id;

    }
    
 }
  function create_resto($id,$name,$email,$phone,$facebook,$instagram,$whatsapp,$image,$url,$host,$user,$pass,$db,)
 {
    //returns the id is from the user
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");

        if ($image=='')
    {
            $image='default.png';
    }

    $req="INSERT into restaurant values('$id','$name','$email','$phone','$facebook','$instagram','$$whatsapp','$image','$url')";
    $res=mysqli_query($cn,$req);
     mysqli_close($cn);
    if (mysqli_num_rows($res)==0) {
        return false;
    
    }
    else
    {
        $id=mysqli_insert_id($cn);
       return $id;

    }
    
 }
  function create_menu($id,$name,$image,$host,$user,$pass,$db)
 {
    //returns the id is from the resto
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");

        if ($image=='')
    {
            $image='default.png';
    }

    $req="INSERT into menu values(NULL,'$id','$name','$image')";
    $res=mysqli_query($cn,$req);
     mysqli_close($cn);
    if (mysqli_num_rows($res)==0) {
        return false;
    
    }
    else
    {
        $id=mysqli_insert_id($cn);
       return $id;

    }
    
 }
  function create_item($id,$catigory,$name,$prix,$image,$host,$user,$pass,$db)
 {
    //returns the id is from the menu
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");

        if ($image=='')
    {
            $image='default.png';
    }

    $req="INSERT into item values(NULL,'$id','$catigory','$name','$prix','$image')";
    $res=mysqli_query($cn,$req);
     mysqli_close($cn);
    if (mysqli_num_rows($res)==0) {
        return false;
    
    }
    else
    {
        $id=mysqli_insert_id($cn);
       return $id;

    }
    
 }
 function change_image($adress,$host,$user,$pass,$db,$pos,$tab,$id)
 {
    $cn=mysqli_connect("$host","$user","$pass","$db") or die("Connection failed");
    $req='';
    switch ($tab) {
        case 'catagory':
        case 'post':
        
            switch ($pos) {
                case '0':
                     return false;
                    break;
                case '1':
                    
                    $req="UPDATE '$tab' SET image1='$adress' where id='$id' ";
                    break;
                case '2':
                    $req="UPDATE '$tab' SET image2='$adress' where id='$id' ";
                    break;
                case '3':
                    $req="UPDATE '$tab' SET image3='$adress' where id='$id' ";
                    break;
                
                default:
                    return "Errer";
                    
            }
            
            break;

        case 'restaurant':
        case 'client':
        case 'menu':
             $req="UPDATE '$tab' SET image='$adress' where id='$id' ";

        default:
            break;
    }
   
    $res=mysqli_query($cn,$req);
    mysqli_close($cn);
    if (mysqli_num_rows($res)==0) {
        return false;
    }else {
        return true;
    }
    
 }
