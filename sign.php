
<?php
echo '<link rel="stylesheet" href="FoodConnect/css/sing.css">';
include_once("functions.php");
//sign up
if (isset($_POST["username"])&&isset($_POST["password"])&&isset($_POST["email"])&&isset($_POST["number"]))
{
 
 
  


  if (strlen($_POST['username'])>=8&&strlen($_POST["password"])<=255&&strlen($_POST["password"])>=8&&strlen($_POST["password"])<=255&&email_check($_POST['email'])&&strlen($post["number"])==8)
    {
      $password=clean($_POST["password"]);
      $username=clean($_POST["username"]);
      $email=clean($_POST["email"]);
       
        if ($res) 
        {
         
          $req="INSERT INTO page VALUES( 'FoodConnect/data/images/default.png','".$_POST["age"]."' ,'1','$rand')"; 
          $res=mysqli_query($cn,$req);
          echo '
          <head>
          <link rel="stylesheet" href="FoodConnect/css/global.css">
          </head>
          <body class="body" onload="background('."'url(css/img/background/wood.jpg)'".')">
            <form action="FoodConnect/login.php" onsubmit="entry()" method="post" >
            <fieldset class="window">
            <legend><h3>Account created successfully!</h3></legend>
            <div>
            
            <input type="text" value="'.$_POST["username"].'" name="username" readonly>
            <input type="text" value="'.$_POST["password"].'" name="password" readonly>
            
            <input type="submit" value="login"  class="submit">
            </div>
            </fieldset>
            </form>
             
            </body>
          ';
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
    <link rel="stylesheet" href="FoodConnect/css/global.css">
  
    </head>
    <body class="body" >
      <form action="FoodConnect/initialize.php" onsubmit="return test()" method="post" >
      <fieldset class="window">
      <legend><h3>create account</h3></legend>
      <div>
      <input type="text" placeholder="Username" id="username" name="username">
      </br>
      <input type="password" placeholder="password(8charecters)" id="password" name="password">
      </br>
      <input type="password" placeholder="password(8charecters)" id="confirme" name="confirme">
      </br>
      <input type="text" placeholder="Email" id="email" name="email" >
      </br>
      <input type="number" placeholder="Phone Number" id="number" name="number" >
      </br>
      <label for="age">role:</label>
      <select name="role" id="role" onchange="showItems()" >
              <option value="client">client</option>
              <option value="restourent">restourent</option>
            </select>
            <br>
            <div id="restourentbox" style="display:none">
            <input type="text" placeholder="restourent description" id="restourentname" name="restourentname"><br><br>
            <input type="text" placeholder="restourent location" id="restourentlocation" name="restourentlocation"><br><br>
  <input type="text" placeholder="restourent phone number" id="restourentnumber" name="restourentnumber"><br><br>
  <input type="text" placeholder="restourent email" id="restourentemail" name="restourentemail">   <br><br>       
  
  <input type="text" placeholder="facebook page url" id="restourentopening" name="restourentopening"><br><br>
  <input type="text" placeholder="instagrame url" id="restourentclosing" name="restourentclosing"><br><br>
  <input type="text" placeholder="whatsapp url" id="restourentclosing" name="restourentclosing"><br>
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

      <input type="submit"  onsubmit="return test()" value="sign in" class="submit">
      </div>
      </fieldset>
      </form>
      
      
      <script src="FoodConnect/js/sign.js"></script>
      <a href="FoodConnect/login.php" class="submit">Got an account? login!</a>
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