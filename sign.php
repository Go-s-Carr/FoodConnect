<?php
// Start session BEFORE any output
session_start();

$host = "localhost";
$user = "admin";
$pass = "TOnFlores02:10.";
$db   = "foodconnect";

include_once("functions.php");

// ----- Helper function to check if email already exists (since functions.php has no check_email) -----
function email_exists_in_users($email, $host, $user, $pass, $db) {
    $cn = mysqli_connect($host, $user, $pass, $db);
    if (!$cn) return false;
    $stmt = mysqli_prepare($cn, "SELECT id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);
    mysqli_close($cn);
    return $exists;
}

// Process form submission
if (isset($_POST["email"], $_POST["password"], $_POST["telephone"], $_POST["confirme"])) {
    
    $email      = $_POST["email"];
    $password   = $_POST["password"];
    $confirm    = $_POST["confirme"];
    $phone      = $_POST["telephone"];
    $type       = $_POST["role"];          // form uses "role", but functions expect "type"
    $name       = $_POST["name"];
    $facebook   = $_POST["facebook"] ?? '';
    $instagram  = $_POST["instagram"] ?? '';
    $whatsapp   = $_POST["whatsapp"] ?? '';
    $url        = $_POST["url"] ?? '';
    
    // Validation (keep your original rules but fix typos)
    $emailValid    = strlen($email) >= 8;   // your original rule
    $passwordValid = strlen($password) >= 8 && strlen($password) <= 255;
    $passMatch     = $password === $confirm;
    $phoneValid    = strlen($phone) == 8;   // fixed: was $post["telephone"]
    $emailNotExist = !email_exists_in_users($email, $host, $user, $pass, $db);
    
    if ($emailValid && $passwordValid && $passMatch && $phoneValid && $emailNotExist) {
        
        // Create user – note: create_user expects ($email, $type, $password, ...)
        $id = create_user($email, $type, $password, $host, $user, $pass, $db);
        
        if ($id !== false && $id !== null) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;   // not secure, but keeping your logic
            $_SESSION['type'] = $type;
            
            $image = ''; // will be updated after file upload
            
            if ($type == 'client') {
                create_client($id, $name, $email, $phone, $image, $host, $user, $pass, $db);
            } else { // restaurant
                // create_resto order: id, name, email, phone, facebook, instagram, whatsapp, image, url, host...
                create_resto($id, $name, $email, $phone, $facebook, $instagram, $whatsapp, $image, $url, $host, $user, $pass, $db);
                create_menu($id, $name, '', $host, $user, $pass, $db);
            }
            
            // Handle profile image upload
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
                $upload_dir = "../FoodConnect/data/images/";
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $original = basename($_FILES["image"]["name"]);
                $ext = pathinfo($original, PATHINFO_EXTENSION);
                $base = pathinfo($original, PATHINFO_FILENAME);
                $target = $upload_dir . $base;
                $counter = 0;
                while (file_exists($target . $counter . "." . $ext)) {
                    $counter++;
                }
                $final_path = $target . $counter . "." . $ext;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $final_path)) {
                    // change_image order: address, host, user, pass, db, pos, tab, id
                    if ($type == 'client') {
                        change_image($final_path, $host, $user, $pass, $db, '', 'client', $id);
                    } else {
                        change_image($final_path, $host, $user, $pass, $db, '', 'restaurant', $id);
                    }
                }
            }
            
            header("Location: login.php");
            exit();
        } else {
            sign();
            warning('database_error');
        }
    } else {
        sign();
        warning('incorrect');
    }
} else {
    sign();
}

// ----- FORM DISPLAY FUNCTIONS (cleaned HTML) -----
function sign() {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../FoodConnect/css/sing.css">
    <link rel="stylesheet" href="../FoodConnect/css/global.css">
</head>
<body class="body">
    <form action="../FoodConnect/sign.php" method="post">
        <fieldset class="window">
            <legend><h3>Create Account</h3></legend>
            <div>
                <input type="text" placeholder="Username" name="name" required><br>
                <input type="password" placeholder="Password (8+ characters)" name="password" required><br>
                <input type="password" placeholder="Confirm Password" name="confirme" required><br>
                <input type="email" placeholder="Email" name="email" required><br>
                <input type="tel" placeholder="Phone Number (8 digits)" name="telephone" pattern="[0-9]{8}" required><br>
                <input type="file" name="image" accept="image/*"><br><br>
                <label>Role:</label>
                <select name="role" id="role" onchange="showItems()">
                    <option value="client">Client</option>
                    <option value="restaurant">Restaurant</option>
                </select><br>
                <div id="restaurantbox" style="display:none">
                    <input type="text" placeholder="Facebook URL" name="facebook"><br>
                    <input type="text" placeholder="Instagram URL" name="instagram"><br>
                    <input type="text" placeholder="WhatsApp URL" name="whatsapp"><br>
                    <input type="text" placeholder="Website URL" name="url"><br>
                </div>
                <a href="../FoodConnect/login.php">Already have an account? Login</a>
                <input type="submit" value="Sign In">
            </div>
        </fieldset>
    </form>
    <script>
        function showItems() {
            var role = document.getElementById("role").value;
            var box = document.getElementById("restaurantbox");
            box.style.display = (role === "restaurant") ? "block" : "none";
        }
    </script>
    <script src="../FoodConnect/js/sign.js"></script>
</body>
</html>';
}

function warning($case) {
    if ($case == 'exists') {      // fixed: comparison, not assignment
        echo '<div class="popup-negative">
                <h2>Failed to create account<br>(Email already exists. Try logging in.)</h2>
              </div>';
    } elseif ($case == 'incorrect') {
        echo '<div class="popup-negative">
                <h2>Invalid information<br>Check: email (≥8 chars), password (8-255 chars), phone (8 digits).</h2>
              </div>';
    } elseif ($case == 'database_error') {
        echo '<div class="popup-negative">
                <h2>Database error<br>Please try again later.</h2>
              </div>';
    }
}
?>