
<?php
$host="localhost";
$user="admin";
$pass="TOnFlores02:10.";
$db="foodconnect";
echo '<link rel="stylesheet" href="../FoodConnect/css/sing.css">';
include_once("functions.php");
//sign up
if (isset($_POST["email"])&&isset($_POST["password"])&&isset($_POST["email"])&&isset($_POST["number"])&&isset($_POST["confirme"]))
{
 
 
  


  if (strlen($_POST['email'])>=8&&strlen($_POST["password"])<=255&&strlen($_POST["password"])>=8&&strlen($_POST["password"])<=255&&$_POST["password"]==$_POST["confirme"]&&email_check($_POST['email'])&&strlen($post["number"])==8)
    {
     # $password=clean($_POST["password"]);
     # $username=clean($_POST["username"]);
     # $email=clean($_POST["email"]);
       $email=$_POST['email'];
       $passw=$_POST['password'];
        if (!check_email($_POST['email'],$host,$user,$pass,$db)) 
        {
         $id=create_user($_POST['email'],$_POST['password'],$_POST['type'],$host,$user,$pass,$db);
         $image='';
         session_start();
         $_SESSION['email']=$_POST['email'];
          $_SESSION['password']=$_POST['password'];
           $_SESSION['type']=$_POST['type'];
         if ($_POST['type']=='client')
        {

            create_client($id,$_POST['name'],$email,$_POST["number"],$image,$host,$user,$pass,$db);
         }else {
           create_resto($id,$_POST['name'],$email,$_POST["number"],$_POST["facebook"],$_POST["instagram"],$_POST["whatsapp"],$_POST["url"],$image,$host,$user,$pass,$db);
           create_menu($id,$_POST['name'],'',$host,$user,$pass,$db);
         }
         if (isset($_FILES["image"]))
{
    foreach( $_FILES as $x =>$y){
       
        $name= (basename($_FILES[$x]["name"]));
        $target="../FoodConnect/data/images".$x."";
        $type= substr($name,strpos($name,"."),strlen($name));
        $name=substr($name,0,strpos($name,"."));
        $target=$target.$name;
        $num=0;
    
       while(file_exists($target.$num.$type)) 
        {
            $num++;
        }
        
        $target=$target.$num.$type;
          if (move_uploaded_file($_FILES["image"]["tmp_name"],$target)) 
        {
    
            
            if ($_POST['type']=='client') {
               change_image($target,$host,$user,$pass,$db,'','client',$id);
            }else {
                change_image($target,$host,$user,$pass,$db,'','restaurant',$id);
            }
        } 
        
        
            
    
        }
}
    header("Location:login.php");
          
        }
        //account exists
        else
        {
            sign();
            warning('exists');
           
        }       
 
    }
    //incorrect parameters
    else
    {
        sign();
        warning('incorrect');
       
    }
}
else
{
  sign();
}

//creating the account
function sign()
{
    echo '
    <head>
    <link rel="stylesheet" href="../FoodConnect/css/global.css">
  
    </head>
    <body class="body" >
      <form action="../FoodConnect/sign.php" onsubmit="return test()" method="post" >
      <fieldset class="window">
      <legend><h3>create account</h3></legend>
      <div>
      <input type="text" placeholder="Username" id="username" name="name">
      </br>
      <input type="password" placeholder="password(8charecters)" id="password" name="password">
      </br>
      <input type="password" placeholder="password(8charecters)" id="confirme" name="confirme">
      </br>
      <input type="text" placeholder="Email" id="email" name="email" >
      </br>
      <input type="number" placeholder="Phone Number" id="number" name="telephone" >
      </br>
      <input type="file" placeholder="profile image" id="image" name="image" accept="image/*"><br><br>
      <label for="age">role:</label>
      <select name="role" id="role" onchange="showItems()" >
              <option value="client">client</option>
              <option value="restaurant">restourent</option>
            </select>
            <br>
            <div id="restourentbox" style="display:none">
           <br><br>
            

  <input type="text" placeholder="facebook page url" id="facebook" name="facebook"><br><br>
  <input type="text" placeholder="instagrame url" id="instagram" name="instagram"><br><br>
  <input type="text" placeholder="whatsapp url" id="whatsapp" name="whatsapp"><br>
    <input type="text" placeholder="site url" id="url" name="url"><br>
  </div>    
  <script>
function showItems() {
  let value = document.getElementById("role").value;

  document.getElementById("restourentbox").style.display = "none";

  if (value === "restourent") {
    document.getElementById("restourentbox").style.display = "block";
  } 
    
}
</script>
        <a href="FoodConnect/login.php" class="herf">Got an account? login!</a>
      <input type="submit"  onsubmit="return test()" value="sign in" class="submit">
      </div>
      
      </fieldset>
      
      </form>
      
      
      <script src="FoodConnect/js/sign.js"></script>
      
      </body>
    ';
}
function warning($case)
{
  if ($case='exists') {
    echo'
    <div class="popup-negative" >
       <h2>failed to create an account<br>
      (Sorry it seems the Username is taken, Try something else)
      </h2>
    </div>
    ';
  }
    
}

?>