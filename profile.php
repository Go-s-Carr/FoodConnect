
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resto profile</title>
    <link rel="stylesheet" href="FoodConnect/css/rprofile.css"></head>
<link rel="stylesheet" href="../css/rprofile.css"></head>
<body>
</html><?php
session_start();

if (!isset($_SESSION['id'])) {
   header('Location:login.php');
}
if ($_SESSION['type']=='restaurant')
{
    # code...
}
  echo '
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <!-- Profile Card -->
                <table width="900" cellpadding="20" cellspacing="0" border="1" bgcolor="#f9f9f9">
                    <tr>
                        <td align="center">
                            
                            <!-- Header Section -->
                            <h1> esm resto bl php ml session</h1>
                            <hr width="80%">
                            <br>
                            
                            <!-- Avatar / Profile Image (using a nice SVG avatar - pure HTML) -->
                            <img src=" "FoodConnect/data/images/".$_SESSION["image"]"
                                 alt="Profile Avatar"
                                 width="150"
                                 height="150"
                                 border="2">
                            
                            <br><br>
                            
                            <!-- Bio Section -->
                            <h3>description</h3>
                            <p>
                                aml description fl bd bch tajm tejbdha zede bl session(bl mo5tasar el session t3adi biha id ta user wl md te3o ijbed kolchy test7a9o)
                                resto mechewi 6 njom aban lablebi 3and zarga. 🌉
                            </p>
                            
                            <br>
                            <hr width="80%">
                            <br>
                            <fieldset>
                                <legend><h3>🍽️ Menu Highlights</h3></legend>
                                <ul>
                                    <li><?php echo "bd te3ek 5arj laswem w howa chnwe ybi3"; ?></li>
                                </ul>
                            </fieldset>
                            <br>
                            <hr width="80%">
                            <br>
                            
                            <!-- Contact Information -->
                            <h3>📫 Contact Info</h3>
                            <table width="80%" cellpadding="8" border="0">
                                <tr>
                                    <td align="right"><strong>📧 Email:'.$_SESSION["email"].' </strong></td>
                                    <td align="left">olivia.chen@devprofile.com</td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>📱 Phone:</strong></td>
                                    <td align="left"> (206) '.$_SESSION["telephone"].'</td>
                                </tr>
                                <tr>
                                    <td align="right"><strong>🌍 Location:</strong></td>
                                    <td align="left">Still in development</td>
                                </tr>
                               
                            </table>
                            
                            <br>
                            <hr width="80%">
                            <br>
                            
                           
                            
                           
                            <h3>🔗 Find Me Online</h3>
                            <p>
                                <a href="'.$_SESSION["facebook"].'">facebook</a> &nbsp;|&nbsp;
                                <a href="'.$_SESSION["instagram"].'">instagram</a> &nbsp;|&nbsp;
                                <a href="'.$_SESSION["whatsapp"].'">whatsapp</a> &nbsp;|&nbsp;
                            </p>
                            
                            <br>
                            <hr width="80%">
                            <br>
                            
                            <!-- Quote / Footer -->
                            <footer>
                                <p><em>"Code is poetry,easy to write but difficult to write well, and every application tells a story of agony."</em></p>
                                <p>📅 Last updated: April 2026</p>
                                <p>© ayoub~iheb , built in the dead of night</p>
                            </footer>
                            
                        </td>
                    </tr>
                </table>
                <br>
                <!-- End Profile Card -->
            </td>
        </tr>
    </table>

</body>';
?>
